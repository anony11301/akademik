<table>
    <thead>
        <tr>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">No</th>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">Nama</th>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">Kelas</th>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">Pelanggaran</th>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">Poin</th>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">Tanggal</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($pelanggaran as $pelanggaran)
        <tr>
            <td style="border: 1px solid black;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $pelanggaran->nama }}</td>
            <td style="border: 1px solid black;">{{ $pelanggaran->kelas }}</td>
            <td style="border: 1px solid black;">{{ $pelanggaran->pelanggaran }}</td>
            <td style="border: 1px solid black;">{{ $pelanggaran->poin }}</td>
            <td style="border: 1px solid black;">{{ $pelanggaran->tanggal }}</td>
        </tr>
    @endforeach
    </tbody>
</table>