<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Exports\DataPelanggaranExport;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class DataPelanggaranController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        $jumlahPelanggaran = [];

        foreach ($data as $item) {
            $tanggalSekarang = now()->toDateString();

            $count = DataPelanggaran::where('tanggal', $tanggalSekarang)
                ->where('id_kelas', $item->id)
                ->count();

            $jumlahPelanggaran[$item->id] = $count;
        }

        return view('pages.management.data pelanggaran.index', [
            'kelas' => $data,
            'jumlahPelanggaran' => $jumlahPelanggaran,
        ]);
    }

    public function show(string $id)
    {
        $data = Siswa::where('id_kelas', $id)->orderBy('nama')->get();
        $kelas = Kelas::where('id', $id)->first();
        $pelanggaran = Pelanggaran::all();
        return view('pages.management.data pelanggaran.add', [
            'siswa' => $data,
            'kelas' => $kelas,
            'pelanggaran' => $pelanggaran,
            'kelas_id' => $id
        ]);
    }

    public function store(Request $request, string $id)
    {
        $nisn = $request->nisn;
        $id_pelanggaran = $request->id_pelanggaran;
        $kelas_id = $id;
        $keterangan = $request->keterangan;
        $date = Carbon::today();

        $pelanggaran = Pelanggaran::find($id_pelanggaran);
        $poin_pelanggaran = $pelanggaran->poin;

        $siswa = Siswa::where('NISN', $nisn)->first();
        $poin_siswa = $siswa->poin;
        $poin_siswa += $poin_pelanggaran;

        $siswa->update(['poin' => $poin_siswa]);

        DataPelanggaran::create([
            'NISN' => $nisn,
            'id_pelanggaran' => $id_pelanggaran,
            'id_kelas' => $kelas_id,
            'tanggal' => $date,
            'created_by' => Auth::user()->id,
            'keterangan' => $keterangan
        ]);

        return redirect()->route('data-pelanggaran-kelas', $id);
    }

    public function detail(Request $request)
    {
        $siswa = DataPelanggaran::with('siswa', 'kelas')->get();

        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $search = $request->input('search');
        $filteredSiswa = DataPelanggaran::query();

        // Cek apakah rentang tanggal sudah diatur
        if ($dateFrom && $dateTo) {
            // Jika rentang tanggal sudah diatur, gunakan filter date range
            $filteredSiswa->whereBetween('tanggal', [$dateFrom, $dateTo]);
        } else {
            // Jika rentang tanggal tidak diatur, gunakan data hanya untuk hari ini
            $today = Carbon::now()->toDateString();
            $filteredSiswa->whereDate('tanggal', $today);
        }

        if (!empty($search)) {
            $filteredSiswa->where(function ($query) use ($search) {
                $query->whereHas('siswa', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                })->orWhereHas('kelas', function ($query) use ($search) {
                    $query->where('nama_kelas', 'like', '%' . $search . '%');
                })->orWhereHas('pelanggaran', function ($query) use ($search) {
                    $query->where('nama_pelanggaran', 'like', '%' . $search . '%');
                });
            });
        }

        $filteredSiswa = $filteredSiswa->get();

        return view('pages.management.data pelanggaran.detail', compact('siswa', 'filteredSiswa', 'request'));
    }

    public static function export()
    {
        return Excel::download(new DataPelanggaranExport, 'data_pelanggaran.xlsx');
    }
}
