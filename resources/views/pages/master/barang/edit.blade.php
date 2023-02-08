@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Barang</h4>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-dark">Form Edit</p>
                </div>
            </div>
            <div class="card-body">
                <!-- table -->
                <form action="#" method="POST" id="tahun_form">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}">
                    </div>

                    <div class="row">
                        <div class="col-sm 12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                            <div class="invalid-feedback"> Please use a valid email </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm 12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10">{{ $barang->deskripsi }}</textarea>
                            <div class="invalid-feedback"> Please use a valid email </div>
                        </div>
                    </div>


                    <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div> <!-- .card -->
    </div> <!-- .container-fluid -->
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#tahun_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('barang.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                // beforeSend: function() {
                //     $(document).find('span.error-text').text('');
                // },
                success: function(data) {
                    if (data.status == 'success') {

                        Swal.fire({
                            icon: 'success',
                            text: 'Data telah disimpan',
                            title: 'Berhasil',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            window.top.location = "{{ route('barang') }}"
                        }, 1500);
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });
    </script>
@endpush
