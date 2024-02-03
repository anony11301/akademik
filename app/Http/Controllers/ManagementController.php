<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\DataPelanggaran;
use Illuminate\Support\Carbon;

class ManagementController extends Controller
{
    public function index(Request $request)
    {
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();

        $now = Carbon::now();

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

        $pelanggaran = DataPelanggaran::whereYear('tanggal', $tahunSekarang)
            ->whereMonth('tanggal', $bulanSekarang)
            ->get();

        $totalPelanggaran = $pelanggaran->count();

        //chart pelanggaran
        // Ambil data pelanggaran dari database
        $dataPelanggaran = DataPelanggaran::all();

        // Buat array asosiatif untuk label bulan dan setel nilai awalnya ke 0
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
        $kelas = Kelas::all();
        $labelkelas = [];
        $persentasekelas = [];

        foreach ($kelas as $kelas) {
            $labelsementara = Kelas::where('id', $kelas->id)->pluck('nama_kelas')->first();
            $datatotal = Absensi::where('id_kelas', $kelas->id)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
            $datapersentase = Absensi::where('id_kelas', $kelas->id)->where('status', 'hadir')->whereYear('tanggal', $tahunSekarang)->whereMonth('tanggal', $bulanSekarang)->count();

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

        return view(
            'pages.management.dashboard',
            [
                'request' => $request,
                'jumlahSiswa' => $jumlahSiswa,
                'jumlahKelas' => $jumlahKelas,
                'persentaseKehadiran' => $persentaseKehadiran,
                'totalPelanggaran' => $totalPelanggaran,
                'labels' => $labels,
                'data' => $data,
                'labelkelas' => $labelkelas,
                'persentasekelas' => $persentasekelas,
                'persentaseDate' => $persentaseDate,
                'labelKelasDate' => $labelKelasDate,
                'persentaseKelasDate' => $persentaseKelasDate
            ]
        );
    }
}
