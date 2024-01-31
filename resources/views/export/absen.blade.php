<table>
    <thead>
        <tr>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                No</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                NISN</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Nama Siswa</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Nama Kelas</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Status</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Keterangan</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($absen as $absen)
            <tr>
                <td style="border: 1px solid black;">{{ $no++ }}</td>
                <td style="border: 1px solid black;">{{ $absen->NISN }}</td>
                <td style="border: 1px solid black;">{{ $absen->siswa->nama }}</td>
                <td style="border: 1px solid black;">{{ $absen->kelas->nama_kelas }}</td>
                <td style="border: 1px solid black;">{{ $absen->status }}</td>
                <td style="border: 1px solid black;">{{ $absen->keterangan }}</td>
                <td style="border: 1px solid black;">{{ $absen->tanggal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
