<table>
    <thead>
        <tr>
            <th style="font-size: 30px; font-family: calibri; text-align: center;" colspan="3">DATA SISWA</th>
        </tr>
        <tr>
            <th
                style="font-family: calibri;font-size: 16px; font-weight: bold; text-align: center; background-color: yellow; border: 1px solid black;">
                No</th>
            <th
                style="font-family: calibri;font-size: 16px; font-weight: bold; text-align: center; background-color: yellow; border: 1px solid black;">
                Nama</th>
            <th
                style="font-family: calibri;font-size: 16px; font-weight: bold; text-align: center; background-color: yellow; border: 1px solid black;">
                NISN</th>
            <th
                style="font-family: calibri;font-size: 16px; font-weight: bold; text-align: center; background-color: yellow; border: 1px solid black;">
                Poin</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($siswa as $siswa)
            <tr>
                <td style="border: 1px solid black;">{{ $no++ }}</td>
                <td style="border: 1px solid black;">{{ $siswa->NISN }}</td>
                <td style="border: 1px solid black;">{{ $siswa->nama }}</td>
                <td style="border: 1px solid black;">{{ $siswa->poin }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
