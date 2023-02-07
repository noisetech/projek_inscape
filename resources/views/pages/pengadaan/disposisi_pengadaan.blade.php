@extends('layouts.admin')

@section('title', 'Pengadaan')
@section('content')
    <style>
        .previous {
            font-size: 14px !important;
        }

        .next {
            font-size: 14px !important;
        }
    </style>

    <div class="container-fluid mt-3">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pengadaan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Disposisi Pengadaan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">
            <div class="card-body">
                <form action="#" method="POST" id="form_disposisi">
                    @csrf

                    <input type="hidden" name="id" value="{{ $pengadaan->id }}">

                    <div class="mb-3">
                        <label for="" class="form-label">List Disposisi</label>
                        <select name="disposisi" class="form-select">
                            <option value="bidang pku">Bidang PKU</option>
                            <option value="pejabat pelaksana">Pejabat Pelaksana</option>
                        </select>
                    </div>

                    <button class="btn btn-sm btn-primary" type="submit">
                        Simpan
                    </button>
                </form>
            </div> <!-- end card body-->


        </div> <!-- end card -->

    </div>
@endsection


@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#form_disposisi").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('pengadaan_disposisi.update') }}',
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
                            window.top.location =
                                "{{ route('pengdaan.detail', $pengadaan->id) }}"
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
