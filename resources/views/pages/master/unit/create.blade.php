@extends('layouts.admin')

@section('title', 'Tambah Unit')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Unit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Tambah Unit</h4>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="font-weight-bold text-dark">Form Tambah</p>
                </div>
            </div>
            <div class="card-body">
                <!-- table -->
                <form action="#" method="POST" id="unit_form">
                    @csrf

                    <div class="mb-3">
                        <label for="simpleinput" class="form-label">Unit:</label> <sup class="text-danger">*</sup>
                        <input type="text" class="form-control" name="unit">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Email:</label> <sup class="text-danger">*</sup>
                        <select class="users select2 select2-hidden-accessible form-control"
                            name="users_id[]" data-toggle="select2">
                        </select>
                    </div>

                    <button class="btn btn-sm btn-primary mt-3" type="submit">Simpan</button>
                </form>
            </div>
        </div> <!-- .card -->
    </div> <!-- .container-fluid -->
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#unit_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('unit.store') }}',
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
                            window.top.location = "{{ route('unit') }}"
                        }, 1500);
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        $(document).ready(function() {
            $('.users').select2({
                multiple: true,
                placeholder: '--Pilih Email',
                allowClear: true,
                minimumInputLength: 3,
                // containerCssClass: ':all',
                ajax: {
                    url: "{{ route('unit.users') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.email,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush
