
<table class="">
    <thead>
        <tr>
            <th class="">#</th>
            <th>Kode</th>
            <th>Nama</th>
            <th class="">Outlet</th>
            <th>Petugas</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i=1;
        @endphp
        @forelse ($donaturs as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->kode }} </td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->nama_outlet }}</td>
                <td>
                    {{ $d->name }}
                </td>
                <td> @currency($d->nominal)</td>
            </tr>
        @empty
            <tr>
                <td colspan="6"> Kosong</td>
            </tr>
        @endforelse
        <tr>
            <td colspan="5"> Total :</td>
            <td> @currency($transaction[0]->sum ?? 0) </td>
        </tr>

    </tbody>

</table>
