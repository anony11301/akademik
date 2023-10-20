<?php

namespace App\Http\Controllers;

use App\Exports\AbsenExport;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
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
        $jumlahTidakHadir = [];

        foreach ($kelas as $item) {
            $tanggalSekarang = now()->toDateString();
            
            $count = Absensi::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->whereNotIn('status', ['hadir']) 
                ->count();

            $jumlahTidakHadir[$item->id] = $count;
        }
        return view('pages.guru.absen.index', [
            'kelas' => $kelas,
            'jumlahTidakHadir' => $jumlahTidakHadir,
        ]);
    }

    //Create Absen
    public function create($kelas_id)
    {
        $siswa = Siswa::where('id_kelas', $kelas_id)->get();
        return view('pages.guru.absen.add', compact('siswa', 'kelas_id'));
    }

    public function store(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');
        $nis = $request->input('nis');
        $kelas_id = $request->input('kelas_id');


        foreach ($nis as $key => $n) {
            $absen = new Absensi();
            $absen->tanggal = $tanggal;
            $absen->status = $status[$key];
            $absen->keterangan = $keterangan[$key];
            $absen->NIS = $n;
            $absen->id_kelas = $kelas_id;
            $absen->save();
        }


        return redirect()->route('absen.index');
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

        $kehadiran = $absen->where('status','hadir')->count();
        $total_siswa = $absen->count();
        if ($kehadiran == 0){
            $persentasi_kehadiran = 0;
        } else {
        $persentasi_kehadiran = $kehadiran / $total_siswa * 100;
        }

        $absensi = $siswa->map(function ($item, $key) use ($absen, $kelas_id) {
            $siswaAbsen = $absen->where('NIS', $item->NIS)->first();
            $nama_kelas = Kelas::where('id', $kelas_id)->first();

            return [
                'no' => $key+1,
                'NIS' => $item->NIS,
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
    
    public static function export()
    {
        $absen = Session::get('absen_data');

        // return dd($absen)->get();

        // Pastikan data ada sebelum melakukan ekspor
        if ($absen) {
            return Excel::download(new AbsenExport($absen), 'export-absen.xlsx');
        } else {
            // Handle jika data tidak tersedia di session
        }
    }

}
