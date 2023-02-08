@extends('layouts.admin')

@section('title', 'Barang')
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
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>List Barang</h4>

                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_barang">
                        <i class="uil-plus-circle"></i> Tambah Barang
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- table -->
                <div id="dataTable-1_wrapper" class="dataTables_wrapper" cellspacing="0" width="100%">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table datatables dt-responsive nowrap" style="width: 100%"; id="dataTable"
                                    role="grid" aria-describedby="dataTable-1_info">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Gambar</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- .card -->
    </div> <!-- .container-fluid -->


    <div id="modal_tambah_barang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Tambah Barang</h4>
                    <button type="button" class="btn-close" id="close_atas_tambah_barang"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="tambah_barang" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Barang:</label> <sup class="text-danger">*</sup>
                            <input type="text" name="nama_barang" class="form-control">
                            <span class="text-danger error-text nama_barang_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Gambar Barang:</label> <sup class="text-danger">*</sup>
                            <input type="file" name="gambar" class="form-control">
                            <span class="text-danger error-text gambar_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi Barang:</label> <sup
                                class="text-danger">*</sup>
                            <textarea name="deskripsi" cols="30" rows="10" class="form-control"></textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" id="close_bawah_tambah_barang">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn_tambah_barang">Simpan</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                // responsive: true,
                order: [],
                ajax: {
                    url: "{{ route('barang.data') }}"
                },
                columns: [{
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        });

        $('#close_atas_tambah_barang').on('click', function() {
            $('#modal_tambah_barang').modal('hide');
        });


        $('#close_bawah_tambah_barang').on('click', function() {
            $('#modal_tambah_barang').modal('hide');
            $(document).find('span.error-text').empty();
        });

        $('#modal_tambah_barang').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_barang").modal('hide');
            $('#tambah_barang')[0].reset();
            $("#btn_tambah_barang").text('Simpan');
            $(document).find('span.error-text').empty();

        });


        $("#tambah_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('barang.store') }}',
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
                            icon: 'success',
                            text: 'Data telah disimpan',
                            title: 'Berhasil',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $("#modal_tambah_barang").modal('hide');
                        $('#dataTable').DataTable().ajax.reload();
                        $('#tambah_barang')[0].reset();
                        $("#btn_tambah_barang").text('Simpan');
                        $(document).find('span.error-text').empty();


                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('hapus.barang') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $('#dataTable').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        });
    </script>
@endpush
