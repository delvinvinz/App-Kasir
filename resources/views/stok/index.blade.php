@auth
    @extends('app')
    @section('content')
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Produk</th>
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
                            <td>{{ $post->Stok }}</td>
                            <td>
                                <button data-id="{{ $post->id }}" onclick="ambilattr(this);" class="btn btn-md btn-primary"
                                    data-toggle="modal" data-target="#tambahstok"><i class="fa fa-plus"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="modal fade bd-example-modal-md" id="tambahstok" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <form action="{{ route('stok.store') }}" method="post">
                                        @csrf
                                        <h5 class="modal-title">&nbsp; Stok</h5>
                                        <div class="modal-body">
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="idproduk">
                                                <input type="number" class="form-control" name="tmbstok"
                                                    placeholder="Tambah Stok">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-plus"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
@endauth

<script>
    function ambilattr(obj) {
        var id = $(obj).attr('data-id');
        $("input[name=idproduk]").val(id);
    }
</script>
