<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataPelanggaranController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        
        return view('pages.management.data pelanggaran.index', [
            'kelas' => $data,
        ]);
    }

    public function show(string $id)
    {
        $data = Siswa::where('id_kelas', $id)->get();
        $kelas = Kelas::where('id', $id)->first();
        $pelanggaran = Pelanggaran::all();
        return view('pages.management.data pelanggaran.add',[
            'siswa' => $data,
            'kelas' => $kelas,
            'pelanggaran' => $pelanggaran,
        ]);
    }

    public function store(Request $request, string $id)
    {
        $nis = $request->nis;
        $id_pelanggaran = $request->id_pelanggaran;
        $date = Carbon::today();

        DataPelanggaran::create([
            'NIS' => $nis,
            'id_pelanggaran' => $id_pelanggaran,
            'tanggal' => $date,
        ]);

        return redirect()->route('data-pelanggaran-kelas', $id);
    }

    public function detail($kelas_id, Request $request)
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

        // $data = compact('absen', 'siswa', 'kelas_id', 'request', 'absend');
        $data = [
            'absen' => $absen,
            'siswa' => $siswa,
            'kelas_id' => $kelas_id,
            'request' => $request,
            'persentasi_kehadiran' => $persentasi_kehadiran,
        ];
        Session::put('absen_data', $absensi);
        return view('pages.guru.absen.detail', $data);
        // return Excel::download(new AbsenExport($absen), 'export-absen.xlsx');
        // return dd($absen)->get();
    }
}
