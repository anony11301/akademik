<table>
    <thead>
        <tr>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">No</th>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">Nama Pelanggaran</th>
            <th style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">Poin</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($pelanggaran as $pelanggaran)
        <tr>
            <td style="border: 1px solid black;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $pelanggaran->nama_pelanggaran }}</td>
            <td style="border: 1px solid black;">{{ $pelanggaran->poin }}</td>

        </tr>
    @endforeach
    </tbody>
</table>