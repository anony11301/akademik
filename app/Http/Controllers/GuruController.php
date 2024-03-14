<?php

namespace App\Http\Controllers;

use App\Exports\AbsenExport;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class GuruController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.guru.dashboard', [
            'kelas' => $kelas,
        ]);
    }

    public function select()
    {
        $kelas = Kelas::all();
        $jumlahAbsen = [];
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
        return view('pages.guru.absen.index', [
            'kelas' => $kelas,
            'jumlahTidakHadir' => $jumlahTidakHadir,
            'jumlahAbsen' => $jumlahAbsen
        ]);
    }

    //Create Absen
    public function create($kelas_id)
    {
        $siswa = Siswa::where('id_kelas', $kelas_id)->orderBy('nama')->get();
        return view('pages.guru.absen.add', compact('siswa', 'kelas_id'))->with(['tanggal' => '']);
    }

    public function store(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');
        $nisn = $request->input('nisn');
        $kelas_id = $request->input('kelas_id');

        $kondisi = false;

        foreach ($nisn as $key => $n) {

            //cek tanggal pada tabel, dan nis pada tabel dimana tanggal yang sama dengan inputan tanggal
            $cektanggal = Absensi::where('NISN', $n)->where('tanggal', $tanggal)->value('tanggal');
            $ceknis = Absensi::where('NISN', $n)->where('tanggal', $tanggal)->value('NISN');

            // cek data nis dan tanggal sudah ada atau belum
            if (($tanggal == $cektanggal) && ($n == $ceknis)) {
                //bakal balik ke halaman absen lagi beserta alert modal
                return redirect()->route('absen.create', ['kelas_id' => $kelas_id])->with(['modal' => true, 'tanggal' => $tanggal]);
            } else {
                $absen = new Absensi();
                $absen->tanggal = $tanggal;
                $absen->status = $status[$key];
                $absen->keterangan = $keterangan[$key];
                $absen->NISN = $n;
                $absen->id_kelas = $kelas_id;
                $absen->created_by = Auth::user()->id;
                $absen->save();

                $kondisi = true;
            }
        }

        if ($kondisi) {
            return redirect()->route('absen.index');
        }
    }

    public function show($kelas_id, Request $request)
    {
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();
        $statusFilter = $request->input('status_filter');
        $query = Absensi::with('siswa')->where('id_kelas', $kelas_id);

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

        $absensi = $siswa->map(function ($item, $key) use ($absen, $kelas_id) {
            $siswaAbsen = $absen->where('NISN', $item->NISN)->first();
            $nama_kelas = Kelas::where('id', $kelas_id)->first();

            return [
                'no' => $key + 1,
                'NISN' => $item->NISN,
                'nama' => $item->nama,
                'nama_kelas' => $nama_kelas->nama_kelas,
                'status' => $siswaAbsen ? $siswaAbsen->status : null,
                'keterangan' => $siswaAbsen ? $siswaAbsen->keterangan : null,
                'tanggal' => $siswaAbsen ? $siswaAbsen->tanggal : null,
            ];
        });

        $nama_kelas = Kelas::where('id', $kelas_id)->first();
        $data = [
            'absen' => $absen,
            'siswa' => $siswa,
            'kelas_id' => $kelas_id,
            'request' => $request,
            'persentasi_kehadiran' => $persentasi_kehadiran,
            'nama_kelas' => $nama_kelas->nama_kelas,
        ];
        Session::put('absen_data', $absensi);
        return view('pages.guru.absen.detail', $data);
    }

    public static function export($id_kelas)
    {
        $dari = request('date_from');
        $sampai = request('date_to');
        $filter = request('status_filter');
        $export = new AbsenExport($id_kelas, $dari, $sampai, $filter);
        return Excel::download($export, 'absen.xlsx');
    }
}
