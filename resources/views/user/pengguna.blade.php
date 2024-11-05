@auth
    @extends('app')
    @section('content')
        <div class="card-body">
            <a href="{{ route('register') }}" class="btn btn-md btn-success float-right">+ Pengguna</a></td>
            <br>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $n=1; @endphp
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $post->NamaUser }}</td>
                            <td>{{ $post->username }}</td>
                            <td>
                                <a href="{{ route('editregister', $post->UserID) }}" class="btn btn-md btn-primary">edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" align="center">
                                Data User belum Tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
@endauth
