<table>
    <thead>
        <tr>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">No</th>
            <th style="font-family: calibri; font-size: 12px; text-align: center; border: 1px solid black; background-color: yellow;">Nama Kelas</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($kelas as $kelas)
        <tr>
            <td style="border: 1px solid black;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $kelas->nama_kelas }}</td>
        </tr>
    @endforeach
    </tbody>
</table>