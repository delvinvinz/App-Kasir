@auth
    @extends('app')
    @section('content')
        <div class="card-body">
         <a href="{{ route('pelanggan.create') }}" class="btn btn-md btn-success float-right">+ Data Pelanggan</a>
        </td>
          <br>
          <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n=1; @endphp
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $post->NamaPelanggan }}</td>
                            <td>{{ $post->NomorTelepon }}</td>
                            <td>{{ $post->Alamat }}</td>
                            <td>
                                <a href="{{ route('pelanggan.edit', $post->id) }}" class="btn btn-md btn-primary">Edit</a>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pelanggan.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-md btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" align="center">
                                Data Pelanggan belum Tersedia.
                          </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
@endauth
