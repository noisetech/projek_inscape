@extends('layouts.admin')

@section('title', 'Pengadaan')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tambah Pengadaan</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="font-weight-bold text-dark">Form Tambah</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- table -->
                        <form action="#" method="POST" id="tahun_form" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">No Nota Dinas</label>
                                <input type="number" name="no_nota_dinas" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Unit</label>
                                <select name="unit_id" class="unit select2 form-control" data-toggle="select2"></select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Tahun</label>
                                <select name="tahun_id" class="tahun select2 form-control" data-toggle="select2"></select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">File Nota Dinas</label>
                                <input type="file" name="file" class="form-control" accept="application/pdf">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Anggaran</label>
                                <input type="number" name="anggaran" class="form-control">
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-2 mt-4 mb-4">
                                    <i class="uil-plus-circle addAlokasiTahun"></i> Inputan Direksi
                                </div>
                            </div>


                            <div id="wew">

                            </div>


                            <button class="btn btn-sm btn-primary mt-3" type="submit" id="simpan">Simpan</button>

                            <button class="btn btn-primary" type="button" disabled id="spinner">
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
                            </button>
                        </form>
                    </div>
                </div> <!-- .card -->

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.unit').select2({
                minimumInputLength: 2,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Unit--',
                ajax: {
                    url: "{{ route('list_unit.pengadaan') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.unit,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });

        $(document).ready(function() {
            hide_spinner();
        });

        function hide_spinner() {
            $('#spinner').hide();
        }

        function show_spinner() {
            $('#spinner').show();
        }

        $(document).ready(function() {
            $('.tahun').select2({
                minimumInputLength: 2,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Tahun--',
                ajax: {
                    url: "{{ route('list_tahun.pengadaan') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.tahun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });

        $("#tahun_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('pengadaan.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('#simpan').hide();
                    show_spinner();
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('#simpan').show();
                        hide_spinner();
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            window.top.location = "{{ route('pengadaan') }}"
                        }, 1500);
                    }
                },
                error: function(data) {
                    $('#simpan').show();
                    hide_spinner();
                }
            });
        });
    </script>

    <script>
        var inputan_nama_direksi = 0;
        var validasi_nama_direksi = 0;

        var inputan_dokumen_direksi = 0;
        var validasi_dokumen_direksi = 0;

        var inputan_nama_direksi = 0;
        var validasi_nama_direksi = 0;

        var inputan_dokumen_direksi = 0;
        var validasi_dokumen_direksi = 0;

        $(".addAlokasiTahun").click(function() {
            var test = (
                '<div class="row justify-content-center my-2"><div class="col-sm-4 imgUp"><div class="mb-3"><label class="form-label">Nama Direksi</label><input type="text" id="nama_direksi_' +
                inputan_nama_direksi +
                '" class="form-control nama_direksi_control" name="nama_direksi[]" placeholder="Nama Direksi"><span  class="gg text-danger error-text nama_direksi_' +
                validasi_nama_direksi +
                '_error" style="font-size: 12px;"></span></div></div><div class="col-sm-4 imgUp"><div class="mb-3"><label class="form-label">Dokumen Direksi</label><input type="file" id="dokumen_direksi_' +
                inputan_dokumen_direksi +
                '" class="form-control nama_direksi_control" name="dokumen_direksi[]" multiple="multiple" required  accept="application/pdf"><span  class="cc text-danger error-text dokumen_direksi_' +
                validasi_dokumen_direksi +
                '_error" style="font-size: 12px;"></span></div></div><div class="col-sm-2"><i class="fa fa-times del my-3"></i> </div></div>'
            );
            $('#wew').append(test);
            inputan_nama_direksi++;
            validasi_nama_direksi++;
            inputan_dokumen_direksi++;
            validasi_dokumen_direksi++;
        });
        $(document).on("click", "i.del", function() {
            $(this).parent().parent().remove();
            validasi_nama_direksi--;
            inputan_nama_direksi--;
            inputan_dokumen_direksi--;
            validasi_dokumen_direksi--;
            reset();
        });

        function reset() {
            var inputan_nama_direksi = 0;
            var validasi_nama_direksi = 0;

            var inputan_dokumen_direksi = 0;
            var validasi_dokumen_direksi = 0;


            $(".nama_direksi_control").each(function() {
                $(this).attr('id', 'nama_direksi_' + inputan_nama_direksi);
                inputan_nama_direksi++;
            });


            $(".dokumen_direksi_control").each(function() {
                $(this).attr('id', 'dokumen_direksi_' + inputan_dokumen_direksi);
                inputan_dokumen_direksi++;
            });

            $("span.gg").each(function() {
                $(this).attr('class', 'gg' + ' ' + 'nama_direksi_' +
                    validasi_nama_direksi + '_error');
                validasi_nama_direksi++;
            });
            $('span.gg').addClass('text-danger');

            $("span.cc").each(function() {
                $(this).attr('class', 'cc' + ' ' + 'dokumen_direksi_' +
                    validasi_dokumen_direksi + '_error');
                validasi_dokumen_direksi++;
            });
            $('span.cc').addClass('text-danger');

        }
    </script>
@endpush
