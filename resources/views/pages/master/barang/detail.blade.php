@extends('layouts.admin')

@section('title', 'Barang')
@section('content')
    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Detail Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-cols-1">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="font-weight-bold text-dark">Detail barang {{ $barang->nama_barang }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <span style="font-size: 10px;">Deskripsi: {{ $barang->deskripsi }}</span>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size: 10px;">List sub Barang:</span>
                        <a href="{{ route('barang.create_sub_barang', $barang->slug) }}" class="btn btn-sm btn-primary"
                            title="tambah sub barang">
                            <i class="uil-plus-circle" title="tambah sub barang"></i>
                        </a>
                    </div>


                    <div class="card shadow mt-3">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($sub_barang as $sb)
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 py-1 mx-0 mt-0 mb-0">
                                        <span style="font-size: 10px;">{{ Str::ucfirst($sb->sub_barang) }}</span>
                                        <div class="row mt-2">
                                            <div class="d-flex justify-content-start align-items-center mx-2">
                                                <a href="{{ route('sub_barang.edit', $sb->slug) }}"
                                                    class="btn btn-sm btn-outline-warning mx-1" style="font-size: 10px;"><i
                                                        class="uil-pen text-dark"></i></a>
                                                <a class="btn btn-sm btn-outline-danger hapus_sub_barang mx-1"
                                                    style="font-size: 10px;" id="{{ $sb->id }}"><i
                                                        class="uil-trash-alt text-dark"></i></a>
                                            </div>
                                        </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 mx-3">
                        <span style="font-size: 10px;">List parameter barang:</span>
                        <a href="{{ route('barang.createparameter', $barang->slug) }}" class="btn btn-sm btn-primary">
                            <i class="uil-plus-circle"></i>

                        </a>
                    </div>

                    <div class="card shadow mt-3">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($parameter as $p)
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 py-1 mx-0 mt-0 mb-0">
                                        <div class="d-flex justify-content-start align-items-center mt-2">
                                            <span style="font-size: 10px;">{{ Str::ucfirst($p->parameter) }}
                                                <div class="row">
                                                    <div class="d-flex justify-content-start align-items-center mx-2 mt-2">
                                            </span> <sup class="mx-2">
                                                <a href="{{ route('edit_parameter_barang', $p->slug) }}"
                                                    class="btn btn-sm btn-outline-warning mx-1" style="font-size: 10px;"><i
                                                        class="uil-pen text-dark"></i></a>
                                                <a class="btn btn-sm btn-outline-danger hapus_parameter mx-1"
                                                    style="font-size: 10px;" id="{{ $p->id }}"><i
                                                        class="uil-trash-alt text-dark"></i></a>
                                                <a class="btn btn-sm btn-outline-success" style="font-size: 10px;"
                                                    data-bs-toggle="collapse"
                                                    href="<?= '#multiCollapseExample2' . $p->id ?>" role="button"
                                                    aria-expanded="false" aria-controls="multiCollapseExample2">
                                                    <i class="uil-folder-plus"></i>
                                                </a>
                                        </div>
                                    </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="<?= 'multiCollapseExample2' . $p->id ?>">
                                        <div class="card shadow">
                                            <div class="card-header" style="font-size: 10px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>spesifikasi
                                                    </span>

                                                    <a style="font-size: 10px;"
                                                        href="{{ route('paramter.create_spesifikasi_parameter', $p->slug) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="uil-plus-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @php
                                                    $spesifikasi_parameter = DB::table('spesifikasi_parameter')
                                                        ->select('spesifikasi_parameter.*')
                                                        ->join('parameter_barang', 'parameter_barang.id', '=', 'spesifikasi_parameter.parameter_barang_id')
                                                        ->orderBy('level', 'ASC')
                                                        ->where('spesifikasi_parameter.parameter_barang_id', $p->id)
                                                        ->get();

                                                @endphp

                                                <div class="table-responsive">
                                                    <table class="table table-striped" cellspacing="0" width="100%"
                                                        style="font-size: 10px;">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Spesifikasi</th>
                                                                <th>Level</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($spesifikasi_parameter as $sp)
                                                                <tr>
                                                                    <td>{{ $sp->spesifikasi }}</td>
                                                                    <td>{{ $sp->level }}</td>
                                                                    <td>
                                                                        <div
                                                                            class="d-flex justify-content-start align-items-center">
                                                                            <a href="{{ route('spesfiikasi_parameter.edit', $sp->slug) }}"
                                                                                class="btn btn-sm btn-outline-warning mx-1">
                                                                                <i class="uil-pen"></i>
                                                                            </a>


                                                                            <a href="#"
                                                                                class="btn btn-sm btn-outline-danger hapus_spesifikasi_parameter"
                                                                                id="{{ $sp->id }}">
                                                                                <i class="uil-trash-alt"></i>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- .container-fluid -->
@endsection

@push('checkall')
    <script src="{{ asset('backend/assets/js/jquery-check-all.js') }}"></script>
@endpush

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



        $(document).on('click', '.hapus_sub_barang', function(e) {
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
                                    timer: 1500,
                                    showConfirmButton: false,
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            }
                        },
                    })
                }
            })
        });


        $(document).on('click', '.hapus_spesifikasi_parameter', function(e) {
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
                        url: "{{ route('hapus_spesifikasi_parameter') }}",
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
                                    timer: 1500,
                                    showConfirmButton: false,
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            }
                        },
                    })
                }
            })
        });

        $(document).on('click', '.hapus_parameter', function(e) {
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
                                    timer: 1500,
                                    showConfirmButton: false,
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            }
                        },
                    })
                }
            })
        });
    </script>
@endpush
