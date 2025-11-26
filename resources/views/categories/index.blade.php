<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Data Kategori</h2>
<a href="{{ route('categories.create') }}">Tambah Kategori</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
    @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->name }}</td>
            <td>
                <a href="{{ route('categories.edit',$cat->id) }}">Edit</a>
                <form action="{{ route('categories.destroy',$cat->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>