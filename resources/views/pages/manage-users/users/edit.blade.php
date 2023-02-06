@extends('layouts.admin')

@section('title', 'Role')
@section('content')

    <style>
        .select2-container {
            max-width: 100%;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit User</h4>
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
                <form action="#" method="POST" id="user_form">
                    @csrf

                    <input type="hidden" name="id" value="{{ $user->id }}" id="id_user">

                    <div class="mb-3">
                        <label class="form-label">Email:</label> <sup class="text-danger">*</sup>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        <div class="invalid-feedback"> Please use a valid email </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label> <sup class="text-danger">*</sup>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        <div class="invalid-feedback"> Please use a valid email </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label> <sup class="text-danger">*</sup>
                        <input type="password" class="form-control" name="password">
                        <div class="invalid-feedback"> Please use a valid email </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role:</label> <sup class="text-danger">*</sup>
                        <select class="role select2 form-control" name="role_id">
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
        $("#user_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('users.update') }}',
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
                            window.top.location = "{{ route('users') }}"
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
            $('.role').select2({
                placeholder: '--Pilih Role',
                allowClear: true,
                // containerCssClass: ':all',
                ajax: {
                    url: "{{ route('users.role') }}",
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
            url: "{{ route('users.roleByUser') }}",
            data: {
                id: $('#id_user').val(),
            }
        }).then(function(data) {
            console.log(data);
            for (i = 0; i < data.length; i++) {
                // selected
                var newOption = new Option(data[i].name, data[i].id, true,
                    true);

                $('.role').append(newOption).trigger('change');
            }
        });
    </script>
@endpush
