<table>
    <thead>
        <tr>
            <th>nama</th>
            <th>instansi</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tamu as $t)
        <tr>
            <td>{{ $t->nama }}</td>
            <td>{{ $t->instansi }}</td>
            <td>{{ $t->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
