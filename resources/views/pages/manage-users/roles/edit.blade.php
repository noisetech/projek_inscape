@extends('layouts.admin')

@section('title', 'Role')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Role</h4>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="font-weight-bold text-dark">Form Ubah</p>
                </div>
            </div>
            <div class="card-body">
                <!-- table -->
                <form action="#" method="POST" id="role_form">
                    @csrf

                    <input type="hidden" name="id" value="{{ $role->id }}" id="id_role">


                    <div class="mb-3">
                        <label class="form-label">Role:</label> <sup class="text-danger">*</sup>
                        <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                        <div class="invalid-feedback"> Please use a valid email </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-group" for="multi-select2">Permissions:</label> <sup class="text-danger">*</sup>
                        <select class="permissions form-control select2 select2-multiple select2-hidden-accessible"
                            data-toggle="select2" name="permission[]">
                        </select>
                    </div>


                    <button class="btn btn-sm btn-warning text-white" type="submit">Simpan</button>
                </form>
            </div>
        </div> <!-- .card -->
    </div> <!-- .container-fluid -->
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.permissions').select2({
                multiple: true,
                placeholder: '--Pilih Permissions',
                allowClear: true,
                // containerCssClass: ':all',
                ajax: {
                    url: "{{ route('role.permissions') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });


        $.ajax({
            type: 'GET',
            url: "{{ route('role.permissionsByRole') }}",
            data: {
                id: $('#id_role').val(),
            }
        }).then(function(data) {
            console.log(data);
            for (i = 0; i < data.length; i++) {
                // selected
                var newOption = new Option(data[i].name, data[i].id, true,
                    true);

                $('.permissions').append(newOption).trigger('change');
            }
        });


        $("#role_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('role.update') }}',
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
                            window.top.location = "{{ route('role') }}"
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
