<table>
    <thead>
        <tr>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">Nom</th>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">Nama</th>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">Kelas</th>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">Pelanggaran</th>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">Poin</th>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">Tanggal</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach ($data_pelanggaran as $data_pelanggaran)
        <tr>
            <td style="font-family: calibri; border: 1px solid black;">{{ $no++ }}</td>
            <td style="font-family: calibri; border: 1px solid black;">{{ $data_pelanggaran->siswa->nama }}</td>
            <td style="font-family: calibri; border: 1px solid black;">{{ $data_pelanggaran->kelas->nama_kelas }}</td>
            <td style="font-family: calibri; border: 1px solid black;">{{ $data_pelanggaran->pelanggaran->nama_pelanggaran }}</td>
            <td style="font-family: calibri; border: 1px solid black;">{{ $data_pelanggaran->pelanggaran->poin }}</td>
            <td style="font-family: calibri; border: 1px solid black;">{{ $data_pelanggaran->tanggal }}</td>
        </tr>
    @endforeach
    </tbody>
</table>