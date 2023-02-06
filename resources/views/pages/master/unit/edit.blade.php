@extends('layouts.admin')

@section('title', 'Unit')
@section('content')

    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
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
                    <h4 class="page-title">Edit Unit</h4>
                </div>
            </div>
        </div>


        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="font-weight-bold text-dark">Form edit</p>
                </div>
            </div>
            <div class="card-body">
                <!-- table -->
                <form action="#" method="POST" id="unit_form">
                    @csrf

                    <input type="hidden" name="id" id="id_unit" value="{{ $unit->id }}">

                    <div class="mb-3">
                        <label class="form-label">Unit:</label> <sup class="text-danger">*</sup>
                        <input type="text" class="form-control" name="unit" value="{{ $unit->unit }}">
                        <div class="invalid-feedback"> Please use a valid email </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label> <sup class="text-danger">*</sup>
                        <select class="users form-control select2 select2-multiple select2-hidden-accessible"
                            data-toggle="select2" name="users_id[]">
                        </select>
                    </div>

                    <button class="btn btn-sm btn-warning text-white" type="submit">Ubah</button>
                </form>
            </div>
        </div> <!-- .card -->
    </div> <!-- .container-fluid -->
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // console.log($('#id_unit').val());
        $.ajax({
            type: 'GET',
            url: "{{ route('unit.userByUnit') }}",
            data: {
                id: $('#id_unit').val(),
            }
        }).then(function(data) {
            console.log(data);
            for (i = 0; i < data.length; i++) {
                // selected
                var newOption = new Option(data[i].email, data[i].id, true,
                    true);

                $('.users').append(newOption).trigger('change');
            }

        });

        $("#unit_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('unit.update') }}',
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
                            icon: data.status,
                            text: data.message,
                            title: data.title,
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
