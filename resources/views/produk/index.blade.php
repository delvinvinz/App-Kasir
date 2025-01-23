@auth
    @extends('app')
    @section('content')
        <div class="card-body">
          <a href="{{ route('produk.create') }}" class="btn btn-md btn-success float-right">+ Data Barang</a>
          <br>
          <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n=1; @endphp
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $post->NamaProduk }}</td>
                            <td>Rp. {{ $post->Harga }}</td>
                            <td id="stok-{{ $post->id }}">{{ $post->Stok }}</td>
                            <td>
                                <a href="{{ route('produk.edit', $post->id) }}" class="btn btn-md btn-primary">Edit</a>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('produk.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-md btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center">
                                Data produk belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
@endauth


