@auth
    @extends('app')
    @section('content')
        <div class="card-body">
            <a href="{{ route('penjualan.create') }}" class="btn btn-md btn-success float-right">+ Data Penjualan</a>
            <br><br>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n=1; @endphp
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $post->TanggalPenjualan }}</td> <!-- Menampilkan Tanggal Penjualan -->
                            <td>{{ $post->pelanggan ? $post->pelanggan->NamaPelanggan : 'N/A' }}</td> <!-- Menampilkan Nama Pelanggan -->
                            <td>{{ $post->TotalHarga }}</td> <!-- Menampilkan Total Harga -->
                            <td>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('penjualan.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-md btn-danger">hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center">Data Pelanggan belum Tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
@endauth
