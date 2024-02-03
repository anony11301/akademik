<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\DataPelanggaran;
use Illuminate\Support\Carbon;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $jumlahTidakHadir = [];

        foreach ($kelas as $item) {
            $tanggalSekarang = now()->toDateString();

            $count = Absensi::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->whereNotIn('status', ['hadir'])
                ->count();

            $jumlahTidakHadir[$item->id] = $count;
        }
        foreach ($kelas as $item) {
            $tanggalSekarang = now()->toDateString();

            $count = Absensi::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->count();

            $jumlahAbsen[$item->id] = $count;
        }

        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();

        $now = carbon::now();

        $bulanSekarang = $now->month;
        $tahunSekarang = $now->year;


        $absensi = Absensi::whereYear('tanggal', $tahunSekarang)
            ->whereMonth('tanggal', $bulanSekarang)
            ->get();


        $totalKehadiran = $absensi->where('status', 'hadir')->count();
        $totalSiswa = $absensi->count();

        if ($totalKehadiran == 0) {
            $persentaseKehadiran = 0;
        } else {
            $persentaseKehadiran = ($totalKehadiran / $totalSiswa) * 100;
        }

        $labels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
        ];

        $data = array_fill(0, 12, 0);

        $tahun = Carbon::now()->year;

        for ($i = 1; $i <= 12; $i++) {
            $data[$i - 1] = DataPelanggaran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->count();
        }

        //data chart untuk kehadiran kelas per bulan
        $kelassemua = Kelas::all();
        $labelkelas = [];
        $persentasekelas = [];

        foreach ($kelassemua as $k) {
            $labelsementara = Kelas::where('id', $k->id)->pluck('nama_kelas')->first();
            $datatotal = Absensi::where('id_kelas', $k->id)->whereMonth('tanggal', $bulanSekarang)->count();
            $datapersentase = Absensi::where('id_kelas', $k->id)->where('status', 'hadir')->whereMonth('tanggal', $bulanSekarang)->count();

            if ($datatotal != 0) {
                $persentasesementara = ($datapersentase / $datatotal) * 100;
            } else {
                $persentasesementara = 0;
            }
            $labelkelas[] = $labelsementara;
            $persentasekelas[] = $persentasesementara;
        }

        //Data absensi hadir
        $absensiquery = Absensi::where('status', 'hadir');

        //Kalo ngga ada input, maka default nya hari ini
        if (!$request->date_from && !$request->date_to) {
            $absensidate = $absensiquery->whereDate('tanggal', today())->count();
            $totalabsen = Absensi::whereDate('tanggal', today())->count();
            $kelas = Kelas::all();
            $labelKelasDate = [];
            $persentaseKelasDate = [];

            foreach ($kelas as $item) {
                $labelsementara2 = Kelas::where('id', $item->id)->pluck('nama_kelas')->first();
                $datatotal2 = Absensi::where('id_kelas', $item->id)->whereDate('tanggal', today())->count();
                $datapersentase2 = Absensi::where('id_kelas', $item->id)->where('status', 'hadir')->whereDate('tanggal', today())->count();

                if ($datatotal2 != 0) {
                    $persentasesementaraDate = ($datapersentase2 / $datatotal2) * 100;
                } else {
                    $persentasesementaraDate = 0;
                }
                $labelKelasDate[] = $labelsementara2;
                $persentaseKelasDate[] = $persentasesementaraDate;
            }

            if ($absensidate != 0) {
                $persentaseDate = ($absensidate / $totalabsen) * 100;
            } else {
                $persentaseDate = 0;
            }
            //kalo ada input, maka akan melakukan query sesuai tanggal yang di input
        } else if ($request->date_from && $request->date_to) {
            $absensidate = $absensiquery->whereBetween('tanggal', [$request->date_from, $request->date_to])->count();
            $totalabsen = Absensi::whereBetween('tanggal', [$request->date_from, $request->date_to])->count();
            $kelas = Kelas::all();
            $labelKelasDate = [];
            $persentaseKelasDate = [];

            foreach ($kelas as $item) {
                $labelsementara2 = Kelas::where('id', $item->id)->pluck('nama_kelas')->first();
                $datatotal2 = Absensi::where('id_kelas', $item->id)->whereBetween('tanggal', [$request->date_from, $request->date_to])->count();
                $datapersentase2 = Absensi::where('id_kelas', $item->id)->where('status', 'hadir')->whereBetween('tanggal', [$request->date_from, $request->date_to])->count();

                if ($datatotal2 != 0) {
                    $persentasesementaraDate = ($datapersentase2 / $datatotal2) * 100;
                } else {
                    $persentasesementaraDate = 0;
                }
                $labelKelasDate[] = $labelsementara2;
                $persentaseKelasDate[] = $persentasesementaraDate;
            }

            if ($absensidate != 0) {
                $persentaseDate = ($absensidate / $totalabsen) * 100;
            } else {
                $persentaseDate = 0;
            }
        }

        return view('pages.guest.index', [
            'request' => $request,
            'kelas' => $kelas,
            'jumlahTidakHadir' => $jumlahTidakHadir,
            'persentaseKehadiran' => $persentaseKehadiran,
            'labels' => $labels,
            'data' => $data,
            'jumlahAbsen' => $jumlahAbsen,
            'labelkelas' => $labelkelas,
            'persentasekelas' => $persentasekelas,
            'persentaseDate' => $persentaseDate,
            'labelKelasDate' => $labelKelasDate,
            'persentaseKelasDate' => $persentaseKelasDate
        ]);
    }

    public function show($kelas_id, Request $request)
    {
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();

        $statusFilter = $request->input('status_filter');

        $query = Absensi::where('id_kelas', $kelas_id);

        // Filter berdasarkan tanggal hari ini jika tidak ada rentang tanggal yang diberikan
        if (!$request->date_from && !$request->date_to) {
            $query->whereDate('tanggal', today());
        }

        // Filter berdasarkan rentang tanggal jika ada date_from dan date_to
        if ($request->date_from && $request->date_to) {
            $query->whereBetween('tanggal', [$request->date_from, $request->date_to]);
        }

        if ($statusFilter === 'tidak-hadir') {
            $query->where('status', '!=', 'hadir');
        } elseif (!empty($statusFilter)) {
            $query->where('status', $statusFilter);
        }

        $absen = $query->orderBy('tanggal', 'desc')->get();

        $kehadiran = $absen->where('status', 'hadir')->count();
        $total_siswa = $absen->count();
        if ($kehadiran == 0) {
            $persentasi_kehadiran = 0;
        } else {
            $persentasi_kehadiran = $kehadiran / $total_siswa * 100;
        }

        $kelas = Kelas::where('id', $kelas_id)->get();
        // $data = compact('absen', 'siswa', 'kelas_id', 'request', 'absend');
        $data = [
            'absen' => $absen,
            'siswa' => $siswa,
            'kelas_id' => $kelas_id,
            'request' => $request,
            'persentasi_kehadiran' => $persentasi_kehadiran,
            'kelas' => $kelas,
        ];
        return view('pages.guest.detail', $data);
        // return dd($data)->get();
    }
}
