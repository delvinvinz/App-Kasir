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
                                    <input type="text" class="form-control" name="idpelanggan" placeholder="ID Pelanggan">
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
                                                <input type="text" class="form-control" name="idbarang[]" id="idbarang1"
                                                    onchange="idbaranginput(1);">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="barang[]" id="barang1">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control text-center" name="jumlah[]"
                                                    id="jumlah1" onchange="hitotal(1);">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control text-right" name="harga[]"
                                                    id="harga1">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input type="number" class="totalprice form-control text-right" name="total[]"
                                                    id="total1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="add_button btn btn-success btn-xl float-right"
                                        title="Add field"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@endauth

<script>
    $(document).ready(function() {
        // Set current date to datePicker field if available
        if (document.getElementById('datePicker')) {
            document.getElementById('datePicker').valueAsDate = new Date();
        }

        var maxField = 3; // Maximum fields allowed
        var addButton = $('.add_button'); // Add button selector
        var wrapper = $('.field_wrapper'); // Wrapper for new fields
        var x = 1; // Initial field counter

        // Field template for dynamic row creation
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
                            <input type="number" class="form-control text-right" name="harga[]" id="harga${index}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="number" class="totalprice form-control text-right" name="total[]" id="total${index}">
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="float-right remove_button" title="Remove field"><i class="fa fa-minus"></i></a>
                </div>`;
        };

        // Add button on click event
        $(addButton).click(function() {
            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML(x)); // Add field HTML
            } else {
                alert(`Jumlah barang: ${maxField} telah terlampaui.`);
            }
        });

        // Remove button event listener
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('.dynamic-row').remove(); // Remove the specific row
            x--;
            totalakhir();
        });
    });

    // Function to handle AJAX request for barang data
    function idbaranginput(index) {
    console.log("Index: ", index); // Debugging index
    console.log("ID Barang: ", $("#idbarang" + index).val()); // Debugging idbarang
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
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("Barang tidak ditemukan!");
        },
    });
}


    // Function to calculate total for each item and update grand total
    function hitotal(index) {
        var harga = parseFloat($("#harga" + index).val()) || 0;
        var jumlah = parseInt($("#jumlah" + index).val()) || 0;
        var total = harga * jumlah;

        $('#total' + index).val(total); // Set individual total
        totalakhir(); // Update grand total
    }

    // Function to calculate the final total of all items
    function totalakhir() {
        var grandTotal = 0;
        $(".totalprice").each(function() {
            grandTotal += parseFloat($(this).val()) || 0;
        });
        $("#grandTotalField").val(grandTotal); // Assuming there’s a grand total field
    }
</script>
