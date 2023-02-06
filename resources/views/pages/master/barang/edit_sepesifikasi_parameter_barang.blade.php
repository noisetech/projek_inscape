@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="text-dark">Dashboard</a></li>
                                <li class="breadcrumb-item active text-dark" aria-current="page">Edit Spesifikasi</li>
                            </ol>
                        </nav>
                    </div>

                </div>

                <a href="{{ route('barang.detail', $spesifikasi_parameter->parameter_barang->barang->id) }}"
                    class="btn btn-sm btn-secondary mb-3">
                    <i class="fe fe-12 fe-arrow-left"></i> Kembali
                </a>
                <div class="mb-2 align-items-center">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="font-weight-bold text-dark">Form Tambah</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- table -->
                            <form action="#" method="POST" id="sub_barang_form">
                                @csrf
                                <input type="hidden" name="parameter_barang_id"
                                    value="{{ $spesifikasi_parameter->parameter_barang_id }}">
                                <input type="hidden" name="id" value="{{ $spesifikasi_parameter->id }}">

                                <div class="row">
                                    <div class="col-sm 12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                        <label>Nama Spesisifikasi</label>
                                        <input type="text" class="form-control" name="spesifikasi"
                                            value="{{ $spesifikasi_parameter->spesifikasi }}">
                                        <div class="invalid-feedback"> Please use a valid email </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm 12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                        <label>Level</label>
                                        <input type="text" class="form-control" name="sub_barang"
                                            value="{{ $spesifikasi_parameter->level }}">
                                        <div class="invalid-feedback"> Please use a valid email </div>
                                    </div>
                                </div>




                                <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div> <!-- .card -->
                </div>

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#sub_barang_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('spesifikasi_parameter.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {

                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            window.top.location =
                                "{{ route('barang.detail', $spesifikasi_parameter->parameter_barang->barang->id) }}"
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
