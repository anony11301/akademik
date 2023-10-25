<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Poin</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($siswa as $siswa)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $siswa->NIS }}</td>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->poin }}</td>
        </tr>
    @endforeach
    </tbody>
</table>