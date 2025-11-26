<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Transaksi Barang {{ $type == 'in' ? 'Masuk' : 'Keluar' }}</h2>

@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif
@if($errors->any())
<p style="color:red;">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('transactions.store', $type) }}">
    @csrf
    <table>
        <tr>
            <th>Produk</th>
            <th>Qty</th>
        </tr>
        <tr>
            <td>
                <select name="items[0][product_id]">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} (stok: {{ $p->stock_current }})</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="items[0][quantity]" min="1"></td>
        </tr>
    </table>
    <button type="submit">Simpan Transaksi</button>
</form>

<hr>
<h3>Daftar Transaksi</h3>
<table border="1">
<tr><th>No</th><th>No Transaksi</th><th>Status</th><th>Aksi</th></tr>
@foreach($transactions as $t)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $t->transaction_number }}</td>
    <td>{{ $t->status }}</td>
    <td>
        @if($t->status=='pending' && auth()->user()->role != 'staff')
        <form action="{{ route('transactions.approve',$t->id) }}" method="POST">
            @csrf
            <button type="submit">Approve</button>
        </form>
        @endif
    </td>
</tr>
@endforeach
</table>

</body>
</html>