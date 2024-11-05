@auth
    @extends('app')
    @section('content')
        <div class="card-body">
            <div class="login-logo">
                <b>Produk Baru</b>
            </div>
            <div class="card">
                @if (session('success'))
                    <p class="alert alert-success">
                        {{ session('success') }}</p>
                @endif
                <div class="card-body login-card-body">
                    <form action="{{ route('produk.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Produk">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-tape"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="harga" placeholder="Harga">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-tag"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="stock" placeholder="Stock">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-truck-loading"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('produk.index') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@endauth
