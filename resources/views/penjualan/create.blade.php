@auth
    @extends('app')
    @section('content')
        <div class="card-body">
            <div class="login-logo">
                <b>Penjualan</b>
            </div>
            <div class="card">
                @if (session('success'))
                    <p class="alert alert-success">
                        {{ session('success') }}</p>
                @endif
                <div class="card-body login-card-body">
                    <form action="{{ route('penjualan.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="idpelanggan" onchange="idpelangganinput();" placeholder="ID Pelanggan">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-tape"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Pelanggan">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-tape"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" id="datePicker">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-tag"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="total" placeholder="Total Harga">
                                    <input type="hidden" name="totalharga" id="grandTotalField" value="0">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-truck-loading"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('penjualan.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-2">
                                        ID Barang
                                    </div>
                                    <div class="col-3">
                                        Nama Barang
                                    </div>
                                    <div class="col-2">
                                        Quantitas
                                    </div>
                                    <div class="col-2">
                                        Harga
                                    </div>
                                    <div class="col-3">
                                        Total
                                    </div>
                                </div>
                                <div class="field_wrapper">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="idbarang[]" id="idbarang1" onchange="idbaranginput(1);">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="barang[]" id="barang1">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control text-center" name="jumlah[]" id="jumlah1" onchange="hitotal(1);">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control text-right" name="harga[]" id="harga1" onchange="hitotal(1);">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input type="number" class="totalprice form-control text-right" name="total[]" id="total1" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="add_button btn btn-success btn-xl float-right" title="Add field"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function() {
        if (document.getElementById('datePicker')) {
            document.getElementById('datePicker').valueAsDate = new Date();
        }

        var maxField = 3;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var x = 1;

        var fieldHTML = function(index) {
            return `<div class="row dynamic-row">
                    <div class="col-2">
                        <div class="form-group">
                            <input type="text" class="form-control idbarang" name="idbarang[]" id="idbarang${index}" onchange="idbaranginput(${index});">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="barang[]" id="barang${index}">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="number" class="form-control text-center" name="jumlah[]" id="jumlah${index}" onchange="hitotal(${index});">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="number" class="form-control text-right" name="harga[]" id="harga${index}" onchange="hitotal(${index});">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="number" class="totalprice form-control text-right" name="total[]" id="total${index}" readonly>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="float-right remove_button" title="Remove field"><i class="fa fa-minus"></i></a>
                </div>`;
        };

        $(addButton).click(function() {
            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML(x));
            } else {
                alert('Jumlah barang: ${maxField} telah terlampaui.');
            }
        });

        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('.dynamic-row').remove();
            x--;
            totalakhir();
        });
    });

    function idbaranginput(index) {
        $.ajax({
            url: "{{ route('penjualan.databarang') }}",
            type: "POST",
            cache: false,
            data: {
                "idbarang": $("#idbarang" + index).val(),
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            success: function(response) {
                $('#harga' + index).val(response.harga);
                $('#barang' + index).val(response.barang);
                hitotal(index);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("Barang tidak ditemukan!");
            },
        });
    }

    function idpelangganinput() {
        $.ajax({
            url: "{{ route('penjualan.datapelanggan') }}",
            type: "POST",
            cache: false,
            data: {
                "idpelanggan": $("input[name=idpelanggan]").val(),
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            success: function(response) {
                $('input[name=nama]').val(response.nama);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("Nama Pelanggan tidak ditemukan!");
            },
        });
    }

    function hitotal(index) {
        var harga = parseFloat($("#harga" + index).val()) || 0;
        var jumlah = parseInt($("#jumlah" + index).val()) || 0;
        var total = harga * jumlah;

        $('#total' + index).val(total);
        totalakhir();
    }

    function totalakhir() {
        var grandTotal = 0;
        $(".totalprice").each(function() {
            grandTotal += parseFloat($(this).val()) || 0;
        });
        $("#grandTotalField").val(grandTotal);
        $("input[name=total]").val(grandTotal);
    }
</script>
@endsection
@endauth
