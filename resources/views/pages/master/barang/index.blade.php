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


    {{-- modal tambah barang --}}
    <div id="modal_tambah_barang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
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
            </div>
        </div>
    </div>
    {{-- akhir modal tambah barang --}}


    {{-- modal edit barang --}}
    <div id="modal_edit_barang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Edit Barang</h4>
                    <button type="button" class="btn-close" id="close_atas_edit_barang"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="update_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="id_barang">

                        <div class="mb-3">
                            <label for="" class="form-label">Nama Barang:</label> <sup
                                class="text-danger">*</sup>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang">
                            <span class="text-danger error-text nama_barang_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Gambar Barang:</label> <sup class="text-danger">*
                                <span class="mx text-dark">Isi jika ingin diubah</span></sup>
                            <input type="file" name="gambar" class="form-control">
                            <span class="text-danger error-text gambar_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi Barang:</label> <sup
                                class="text-danger">*</sup>
                            <textarea name="deskripsi" cols="30" rows="10" class="form-control" id="deskripsi_barang"></textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" id="close_bawah_edit_barang">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn_edit_barang">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir modal edit barang --}}


    {{-- awal modal  sub barang --}}
    <div id="modal_sub_barang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Sub barang</h4>
                    <button type="button" class="btn-close" id="close_atas_sub_barang"></button>
                </div>

                <div class="row mt-2 mx-2">
                    <div class="col-sm-4">
                        <button class="btn btn-sm btn-primary" id="bahan_id_barang_untuk_tambah_sub_barang"
                            data-id="">
                            <i class="uil-plus-circle"></i> Tambah Sub Barang
                        </button>
                    </div>
                </div>


                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table datatables dt-responsive nowrap" style="width: 100%"; id="dataTableSubBarang"
                            role="grid" aria-describedby="dataTable-1_info">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Sub Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir modal sub_barang --}}


    {{-- awal modal tambah sub barang --}}
    <div id="modal_tambah_sub_barang" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Tambah Sub Barang</h4>
                    <button type="button" class="btn-close" id="close_atas_tambah_sub_barang"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="tambah_sub_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="barang_id" id="id_barang_pada_tambah_sub_barang"
                            class="form-control" readonly>

                        <div class="mb-3">
                            <label for="" class="form-label">Nama Barang:</label> <sup
                                class="text-danger">*</sup>
                            <input type="text" id="nama_barang_pada_tambah_sub_barang" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Sub Barang:</label> <sup class="text-danger">*</sup>
                            <input type="text" name="sub_barang" class="form-control">
                            <span class="text-danger error-text sub_barang_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                id="close_bawah_tambah_sub_barang">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn_tambah_sub_barang">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir modal tambah sub barang --}}


    {{-- awal modal edit sub barang --}}
    <div id="modal_edit_sub_barang" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Edit Sub Barang</h4>
                    <button type="button" class="btn-close" id="close_atas_edit_sub_barang"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_sub_barang" enctype="multipart/form-data">
                        @csrf


                        <input type="hidden" name="id" id="id" class="form-control" readonly>

                        <input type="hidden" name="barang_id" id="id_barang_pada_edit_sub_barang" class="form-control"
                            readonly>

                        <div class="mb-3">
                            <label for="" class="form-label">Nama Barang:</label> <sup
                                class="text-danger">*</sup>
                            <input type="text" id="nama_barang_pada_edit_sub_barang" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Sub Barang:</label> <sup class="text-danger">*</sup>
                            <input type="text" name="sub_barang" class="form-control"
                                id="nama_sub_barang_pada_edit_sub_barang">
                            <span class="text-danger error-text sub_barang_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" id="close_bawah_edit_sub_barang">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn_edit_sub_barang">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir modal edit sub barang --}}


    {{-- modal parameter barang --}}
    <div id="modal_parameter_barang" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Parameter barang</h4>
                    <button type="button" class="btn-close" id="close_atas_parameter_barang"></button>
                </div>

                <div class="row mt-2 mx-2">
                    <div class="col-sm-4">
                        <button class="btn btn-sm btn-primary" id="bahan_id_barang_untuk_tambah_parameter_barang"
                            data-id="">
                            <i class="uil-plus-circle"></i> Tambah Parameter Barang
                        </button>
                    </div>
                </div>


                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table datatables dt-responsive nowrap" style="width: 100%"; id="dataTableParameter"
                            role="grid" aria-describedby="dataTable-1_info">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Parameter</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir modal parameter barang --}}

    {{-- modal tambah parameter --}}
    <div id="modal_tambah_parameter_barang" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Tambah Parameter Barang</h4>
                    <button type="button" class="btn-close" id="close_atas_tambah_parameter_barang"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="tambah_parameter_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="barang_id" id="id_barang_pada_tambah_parameter_barang"
                            class="form-control" readonly>

                        <div class="mb-3">
                            <label for="" class="form-label">Nama Barang:</label> <sup
                                class="text-danger">*</sup>
                            <input type="text" id="nama_barang_pada_tambah_parameter_barang" class="form-control"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Parameter Barang:</label> <sup
                                class="text-danger">*</sup>
                            <input type="text" name="parameter" class="form-control">
                            <span class="text-danger error-text parameter_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Bobot Parameter:</label> <sup
                                class="text-danger">*</sup>
                            <input type="text" name="bobot" class="form-control">
                            <span class="text-danger error-text bobot_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                id="close_bawah_tambah_parameter_barang">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn_tambah_paramer_barang">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir modal parameter --}}
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
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

        // awal bagian tambah barang

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

        // akhir tambah barang


        //    bagian edit barang

        $(document).on('click', '#close_atas_edit_barang', function(e) {
            $('#modal_edit_barang').modal('hide');
        });

        $(document).on('click', '#close_bawah_edit_barang', function(e) {
            $('#modal_edit_barang').modal('hide');
        });

        $('#modal_edit_barang').on('hidden.bs.modal', function(e) {
            $("#modal_edit_barang").modal('hide');
            $('#update_barang')[0].reset();
            $("#btn_edit_barang").text('Simpan');
            $(document).find('span.error-text').empty();

        });

        $(document).on('click', '.edit', function(e) {
            e.preventDefault();

            let id = $(this).attr('id');

            $('#modal_edit_barang').modal('show');

            $.ajax({
                url: '{{ route('barangById') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id_barang').val(data.id);
                    $('#nama_barang').val(data.nama_barang);
                    $('#deskripsi_barang').val(data.deskripsi);


                }
            });
        })

        $("#update_barang").submit(function(e) {
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

                        $("#modal_edit_barang").modal('hide');
                        $('#update_barang')[0].reset();
                        $("#btn_edit_barang").text('Simpan');
                        $(document).find('span.error-text').empty();

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        // akhir edit barang


        //    bagian hapus barang
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

        // akhir hapus barang


        // awal modal sub barang

        $(document).on('click', '.sub_barang', function(e) {
            e.preventDefault();

            let bahan_barang_id = $(this).attr('id');

            // sisipkan id barang ke tombol tambah sub barang
            $('#tambah_sub_barang').attr('data-id', bahan_barang_id);


            $('#bahan_id_barang_untuk_tambah_sub_barang').attr('data-id', bahan_barang_id);
            $('#modal_sub_barang').modal('show');


            $('#dataTableSubBarang').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],
                ajax: {
                    url: "{{ route('sub_barang.data') }}",
                    data: {
                        barang_id: bahan_barang_id
                    },
                },
                columns: [{
                        data: 'barang',
                        name: 'barang',
                    },
                    {
                        data: 'sub_barang',
                        name: 'sub_barang',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    },
                ]
            });
        });

        $(document).on('click', '#close_atas_tambah_sub_barang', function() {
            $("#modal_tambah_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax.reload();
            $("#btn_tambah_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });

        //    bagian close modal tambah sub barang dan table sub barang
        $(document).on('click', '#close_bawah_tambah_sub_barang', function() {
            $("#modal_tambah_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax.reload();
            $("#btn_tambah_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });

        $(document).on('click', '#close_atas_tambah_sub_barang', function() {
            $("#modal_tambah_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax.reload();
            $("#btn_tambah_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });



        $('#modal_tambah_sub_barang').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax.reload();
            $("#btn_tambah_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });


        $(document).on('click', '#close_atas_sub_barang', function() {
            $("#modal_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax().reload()
        });

        $('#modal_sub_barang').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax.reload();
            $("#btn_tambah_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });



        $(document).on('click', '#bahan_id_barang_untuk_tambah_sub_barang', function(e) {
            e.preventDefault();


            $('#modal_sub_barang').modal('hide');

            $('#modal_tambah_sub_barang').modal('show');

            // barang_id
            let barang_id = $(this).attr('data-id');

            $.ajax({
                url: '{{ route('barangById') }}',
                method: 'get',
                data: {
                    id: barang_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id_barang_pada_tambah_sub_barang').val(data.id);
                    $('#nama_barang_pada_tambah_sub_barang').val(data.nama_barang.toUpperCase());
                }
            });
        })

        $("#tambah_sub_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('sub_barang.store') }}',
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
                        $("#modal_tambah_sub_barang").modal('hide');
                        $('#dataTableSubBarang').DataTable().ajax.reload();
                        $('#tambah_sub_barang')[0].reset();
                        $("#btn_tambah_sub_barang").text('Simpan');
                        $(document).find('span.error-text').empty();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });


        // bagian edit sub barang
        $(document).on('click', '#close_atas_edit_sub_barang', function() {
            $("#modal_edit_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax().reload();
            $("#btn_edit_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });

        $(document).on('click', '#close_bawah_edit_sub_barang', function() {
            $("#modal_edit_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax().reload();
            $("#btn_edit_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });

        $('#modal_edit_sub_barang').on('hidden.bs.modal', function(e) {
            $("#modal_edit_sub_barang").modal('hide');
            $('#dataTableSubBarang').DataTable().ajax.reload();
            $("#btn_edit_sub_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });

        $(document).on('click', '.edit_sub_barang', function(e) {
            e.preventDefault();

            $('#modal_sub_barang').modal('hide');

            $('#modal_edit_sub_barang').modal('show');

            let id_sub_barang = $(this).attr('id');

            $.ajax({
                url: '{{ route('subBarangById') }}',
                method: 'get',
                data: {
                    id: id_sub_barang,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id').val(data.sub_barang_id);
                    $('#id_barang_pada_edit_sub_barang').val(data.barang_id);
                    $('#nama_barang_pada_edit_sub_barang').val(data.nama_barang.toUpperCase());
                    $('#nama_sub_barang_pada_edit_sub_barang').val(data.sub_barang.toUpperCase());
                }
            });
        })

        $("#edit_sub_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('update.sub_barang') }}',
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
                        $("#modal_edit_sub_barang").modal('hide');
                        $('#dataTableSubBarang').DataTable().ajax.reload();
                        $('#edit_sub_barang')[0].reset();
                        $("#btn_edit_sub_barang").text('Simpan');
                        $(document).find('span.error-text').empty();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        // akhir edit sub barang

        // bagian hapus sub barang
        $(document).on('click', '.hapus_sub_barang', function(e) {
            e.preventDefault();

            let id = $(this).attr('id');
            console.log(id);
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
                        url: "{{ route('sub_barang.hapus') }}",
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
                                $('#dataTableSubBarang').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        });

        // bagian parameter barang



        $(document).on('click', '.parameter_barang', function(e) {
            e.preventDefault();


            $('#modal_parameter_barang').modal('show');
            let barang_id = $(this).attr('id');

            $('#dataTableParameter').DataTable({
                destroy: true,
                serverSide: true,
                processing: true,
                order: [],
                ajax: {
                    url: "{{ route('parameter.data') }}",
                    data: {
                        barang_id: barang_id
                    },
                },
                columns: [{
                        data: 'nama_barang',
                        name: 'nama_barang',
                    },
                    {
                        data: 'parameter',
                        name: 'parameter',
                    },
                    {
                        data: 'bobot',
                        name: 'bobot'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    },
                ]
            });


            $('#bahan_id_barang_untuk_tambah_parameter_barang').attr('data-id', barang_id);


        });

        $(document).on('click', '#bahan_id_barang_untuk_tambah_parameter_barang', function(e) {
            e.preventDefault();

            let barang_id = $(this).attr('data-id');

            $('#modal_parameter_barang').modal('hide');
            $('#modal_tambah_parameter_barang').modal('show');

            $.ajax({
                url: '{{ route('barangById') }}',
                method: 'get',
                data: {
                    id: barang_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    $('#id_barang_pada_tambah_parameter_barang').val(data.id);
                    $('#nama_barang_pada_tambah_parameter_barang').val(data.nama_barang.toUpperCase());
                }
            });

        });

        $("#tambah_parameter_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('parameter_barang.store') }}',
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
                        $("#modal_tambah_parameter_barang").modal('hide');
                        $('#dataTableParameter').DataTable().ajax.reload();
                        $('#tambah_parameter_barang')[0].reset();
                        $("#btn_tambah_parameter_barang").text('Simpan');
                        $(document).find('span.error-text').empty();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        $(document).on('click', '#close_atas_parameter_barang', function(e) {
            $("#modal_parameter_barang").modal('hide');
            $('#dataTableParameter').DataTable().ajax.reload();
        });


        $('#modal_parameter_barang').on('hidden.bs.modal', function(e) {
            $("#modal_parameter_barang").modal('hide');
            $('#dataTableParameter').DataTable().ajax.reload();
        });

        // bagian close modal tambah parameter barang

        $(document).on('click', '#close_atas_tambah_parameter_barang', function(e) {
            $("#modal_parameter_barang").modal('hide');
            $('#dataTableParameter').DataTable().ajax.reload();
            $("#btn_tambah_parameter_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });

        $(document).on('click', '#close_bawah_tambah_parameter_barang', function(e) {
            $("#modal_tambah_parameter_barang").modal('hide');
            $('#dataTableParameter').DataTable().ajax.reload();
            $("#btn_tambah_parameter_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });


        $('#modal_tambah_parameter_barang').on('hidden.bs.modal', function(e) {
            $("#modal_parameter_barang").modal('hide');
            $('#dataTableParameter').DataTable().ajax.reload();
            $("#btn_tambah_parameter_barang").text('Simpan');
            $(document).find('span.error-text').empty();
        });

        $(document).on('click', '.hapus_parameter', function(e) {
            e.preventDefault();

            let id = $(this).attr('id');
            console.log(id);
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
                        url: "{{ route('hapus_parameter') }}",
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
                                $('#dataTableParameter').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        });
    </script>
@endpush
