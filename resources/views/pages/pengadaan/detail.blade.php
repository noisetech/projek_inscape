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
                    <h4 class="page-title">Detail Pengadaan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">

                    @if ($pengadaan->disposisi == null)
                        <a href="{{ route('pengadaan.disposisi', $pengadaan->id) }}" class="btn btn-sm btn-primary">
                            <i class="uil-plus-circle"></i>
                        </a>
                    @else
                    @endif


                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Detail pengadaan</span>

                            @if ($pengadaan->jenis == null)
                                <a href="{{ route('pengadaan.edit_jenis', $pengadaan->id) }}"
                                    class="btn btn-sm btn-primary"><i class="uil-edit"></i> jenis pengadaan</a>
                            @else
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <span>No Nota Dinas: {{ $pengadaan->no_nota_dinas }}</span>
                        </div>
                        <div class="mb-2">
                            <span>Unit: {{ $pengadaan->unit->unit }}</span>
                        </div>
                        <div class="mb-2">
                            <span>Angaran: {{ number_format($pengadaan->anggaran) }}</span>
                        </div>
                        <div class="mb-2">
                            <span>Tahun: {{ $pengadaan->tahun->tahun }}</span>
                        </div>

                        <div class="mb-2">
                            <span>Dokumen Nota Dinas: <a href="{{ route('download_file_nota_dinas', $pengadaan->id) }}">
                                    Dokumen Nota
                                    Dinas</a></span>
                        </div>

                        <div class="mb-2">
                            <span>Disposisi Pengadaan:
                                {{ $pengadaan->disposisi != null ? Str::upper($pengadaan->disposisi) : '-' }}</span>
                        </div>

                        <div class="mb-2">
                            <span>Jenis Pengadaan:
                                {{ $pengadaan->jenis != null ? Str::upper($pengadaan->jenis) : '-' }}</span>
                        </div>



                        <div class="mb-2">
                            <span><a href="" class="btn btn-sm btn-primary"><i class="uil-eye"></i> hasil shortlist
                                    screening</a></span>
                        </div>

                    </div>
                </div>


                @php
                    $direksi_pengadaan = DB::table('direksi_pengadaan')
                        ->select('direksi_pengadaan.id', 'direksi_pengadaan.nama', 'direksi_pengadaan.dokumen', 'direksi_pengadaan.status')
                        ->join('pengadaan', 'pengadaan.id', '=', 'direksi_pengadaan.pengadaan_id')
                        ->where('direksi_pengadaan.pengadaan_id', $pengadaan->id)
                        ->get();
                @endphp


                <div class="card">
                    <div class="card-header">
                        <span>List direksi yang dimiliki</span>
                    </div>
                    <div class="card-body">
                        <ul>
                            <div class="row">
                                @foreach ($direksi_pengadaan as $dp)
                                    <div class="col-sm-4">
                                        <li class="mb-2">
                                            <div class="mb-1">
                                                <span>Nama Direksi : {{ $dp->id }}</span>
                                            </div>

                                            <div class="mb-1">
                                                <span>Dokumen Direksi: <a
                                                        href="{{ route('download_dokumen_direksi', $dp->id) }}">Lihat
                                                        Dokumen Direksi</a></span>
                                            </div>

                                            <div class="mb-1">
                                                <span>Status:</span>
                                                <div class="mt-1">
                                                    <div class="form-check">
                                                        <input type="radio" id="customRadio1" name="status-<?= $dp->id ?>"
                                                            onclick="w(this, '<?= $dp->id ?>')" class="form-check-input"
                                                            value="ada" {{ $dp->status == 'ada' ? 'checked' : '-' }}>
                                                        <label class="form-check-label" for="customRadio1">Ada</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" id="customRadio2" name="status-<?= $dp->id ?>"
                                                            onclick="w(this, '<?= $dp->id ?>')" class="form-check-input"
                                                            value="tidak ada"
                                                            {{ $dp->status == 'tidak ada' ? 'checked' : '-' }}>
                                                        <label class="form-check-label" for="customRadio2">Tidak Ada</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input type="radio" id="customRadio3" name="status-<?= $dp->id ?>"
                                                            onclick="w(this, '<?= $dp->id ?>')" class="form-check-input"
                                                            value="expired"
                                                            {{ $dp->status == 'expired' ? 'checked' : '-' }}>
                                                        <label class="form-check-label" for="customRadio3">Expired</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                @endforeach
                            </div>
                        </ul>
                    </div>
                </div>

                @php
                    $cek_pengadaan_detail = DB::table('pengadaan_detail')
                        ->select('pengadaan_detail.*')
                        ->join('pengadaan', 'pengadaan.id', '=', 'pengadaan_detail.pengadaan_id')
                        ->where('pengadaan_detail.pengadaan_id', $pengadaan->id)
                        ->first();
                @endphp

                @if ($cek_pengadaan_detail == null)
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Shortlist Screening</span>

                                <a href="{{ route('barang') }}" class="btn btn-sm btn-primary">Halaman Barang</a>
                            </div>
                        </div>
                        <div class="card-body">


                            <form action="#" method="POST" id="form_hitung">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="mb-2">
                                            <label for="" class="form-label">
                                                Barang
                                            </label>
                                            <select name="barang_id" class="barang form-select select2"></select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="mb-2">
                                            <label for="" class="form-label">
                                                Sub Barang
                                            </label>
                                            <select name="sub_barang_id" class="sub_barang form-select select2" disabled>
                                                <option value="">--Pilih Barang Dahulu--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form_spesifikasn_sub_barang_inputan">



                                </div>



                                <div class="button_hitung">

                                </div>


                            </form>

                            <form action="#" method="POST" id="simpan_hasil">
                                @csrf

                                <div class="spesifikasi_parameter">

                                </div>

                                <div class="hasil_ss mt-3">

                                </div>

                                <div class="button_simpan">

                                </div>
                            </form>

                        </div>
                    </div>
                @endif


            </div>
        </div> <!-- end card body-->


    </div> <!-- end card -->

    </div>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });
    </script>
    <script>
        function w(data, id) {

            status = $(data).val();
            id = id;
            $.ajax({
                type: 'get',
                url: "{{ route('ceklist_direksi') }}",
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    Swal.fire({
                        icon: data.status,
                        text: data.message,
                        title: data.title,
                        toast: true,
                        position: 'top-end',
                        timer: 1800,
                        showConfirmButton: false,
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                },
            });

        }
    </script>

    <script>
        $("#simpan_hasil").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('pengadaan.simpan_pengadaan_detail') }}',
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
                    console.log(data);
                }
            });
        });

        $("#form_hitung").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('hitung') }}',
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
                    if (data.jenis_barang == "lampu") {
                        if (data.score < '3') {
                            $('.spesifikasi_parameter').empty();
                            $('.hasil_ss').empty();
                            $('.hasil_ss').append(
                                '<div class="mb-2"><label class="form-label">Score Shortlist Screening:</label><input class="form-control" readonly value="' +
                                data.score +
                                '"></div><div class="mb-2"><label class="form-label">Likehood Shortlist Level Screening:</label><input class="form-control" readonly value="' +
                                data.likelihood_level +
                                '"></div><div class="mb-2"><label class="form-label">Rekomendasi Screening:</label><input class="form-control" readonly value="' +
                                data.rekomendasi + '"></div>');
                            $('.button_simpan').empty();
                        }

                        if (data.score == '3') {
                            $('.hasil_ss').empty();
                            $('.button_simpan').empty();
                            $('.button_simpan').append(
                                '<button class="btn mt-2 btn-sm btn-primary simpan_detail_pengadaan" type="submit">Simpan</button>'
                            );
                            $('.hasil_ss').append(
                                '<div class="mb-2"><label class="form-label">Score Shortlist Screening:</label><input class="form-control" name="score_ss" readonly value="' +
                                data.score +
                                '"></div><div class="mb-2"><label class="form-label">Likehood Shortlist Level Screening:</label><input name="like_hood_ss" class="form-control" readonly value="' +
                                data.likelihood_level +
                                '"></div><div class="mb-2"><label class="form-label">Rekomendasi Screening:</label><input name="rekomendasi.ss" class="form-control" readonly value="' +
                                data.rekomendasi + '"></div>');


                            for (let index = 0; index < data.spesifikasi_parameter_id.length; index++) {
                                $('.spesifikasi_parameter').append(
                                    '<input type="hidden" name="spesifikasi[]" value="' + data
                                    .spesifikasi_parameter_id[index] + '"></input>')
                            }
                        }
                    }

                    if (data.jenis_barang == "baterai") {
                        if (data.score <= '1') {

                            $('.spesifikasi_parameter').empty();
                            $('.hasil_ss').empty();
                            $('.hasil_ss').append(
                                '<div class="mb-2"><label class="form-label">Score Impact Level:</label><input class="form-control" name="score_impact_level" readonly value="' +
                                data.score +
                                '"></div><div class="mb-2"><label class="form-label">Impact Level:</label><input name="impact_level" class="form-control" readonly value="' +
                                data.impact_level +
                                '"></div><div class="mb-2"><label class="form-label">Rekomendasi Screening:</label><input name="rekomendasi.ss" class="form-control" readonly value="' +
                                data.rekomendasi + '"></div>');
                            $('.button_simpan').empty();
                        }

                        if (data.score >= '1.1') {
                            $('.spesifikasi_parameter').empty();
                            $('.hasil_ss').empty();

                            $('.hasil_ss').append(
                                '<div class="mb-2"><label class="form-label">Score Impact Level:</label><input class="form-control" name="score_impact_level" readonly value="' +
                                data.score +
                                '"></div><div class="mb-2"><label class="form-label">Impact Level:</label><input name="impact_level" class="form-control" readonly value="' +
                                data.impact_level +
                                '"></div><div class="mb-2"><label class="form-label">Rekomendasi Screening:</label><input name="rekomendasi.ss" class="form-control" readonly value="' +
                                data.rekomendasi + '"></div>');
                            $('.button_simpan').empty();
                        }

                        if (data.score >= '2.1') {
                            $('.spesifikasi_parameter').empty();
                            $('.hasil_ss').empty();
                            $('.hasil_ss').append(
                                '<div class="mb-2"><label class="form-label">Score Impact Level:</label><input class="form-control" name="score_impact_level" readonly value="' +
                                data.score +
                                '"></div><div class="mb-2"><label class="form-label">Impact Level:</label><input name="impact_level" class="form-control" readonly value="' +
                                data.impact_level +
                                '"></div><div class="mb-2"><label class="form-label">Rekomendasi Screening:</label><input name="rekomendasi.ss" class="form-control" readonly value="' +
                                data.rekomendasi + '"></div>');
                            $('.button_simpan').empty();
                        }

                        if (data.score > '3.1') {
                            $('.spesifikasi_parameter').empty();
                            $('.hasil_ss').empty();

                            $('.hasil_ss').append(
                                '<div class="mb-2"><label class="form-label">Score Impact Level:</label><input class="form-control" name="score_impact_level" readonly value="' +
                                data.score +
                                '"></div><div class="mb-2"><label class="form-label">Impact Level:</label><input name="impact_level" class="form-control" readonly value="' +
                                data.impact_level +
                                '"></div><div class="mb-2"><label class="form-label">Rekomendasi Screening:</label><input name="rekomendasi.ss" class="form-control" readonly value="' +
                                data.rekomendasi + '"></div>');
                            $('.button_simpan').empty();
                        }

                        if (data.score > '4.1') {
                            $('.spesifikasi_parameter').empty();
                            $('.hasil_ss').empty();
                            $('.button_simpan').empty();
                            $('.button_simpan').append(
                                '<button class="btn mt-2 btn-sm btn-primary simpan_detail_pengadaan" type="submit">Simpan</button>'
                            );
                            $('.hasil_ss').append(
                                '<div class="mb-2"><label class="form-label">Score Impact Level:</label><input class="form-control" name="score_impact_level" readonly value="' +
                                data.score +
                                '"></div><div class="mb-2"><label class="form-label">Impact Level:</label><input name="impact_level" class="form-control" readonly value="' +
                                data.impact_level +
                                '"></div><div class="mb-2"><label class="form-label">Rekomendasi Screening:</label><input name="rekomendasi.ss" class="form-control" readonly value="' +
                                data.rekomendasi + '"></div>');

                        }
                    }


                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.barang').select2({
                placeholder: '--Pilih Barang',
                allowClear: true,
                // containerCssClass: ':all',
                ajax: {
                    url: "{{ route('pengadaan.list_barang') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_barang,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });



        $('.barang').change(function() {

            let bahan_barang_id = $('.barang').val();
            $('.button_simpan').empty();


            $('.button_hitung').empty();
            $('.button_hitung').append('<button class="btn btn-sm btn-success">Hitung</button>');
            $('.hasil_ss').empty();

            $.ajax({
                type: "get",
                url: "{{ route('form_spesifikasi_sub_barang.pengadaan') }}",
                data: {
                    barang_id: bahan_barang_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('.form_spesifikasn_sub_barang_inputan').empty();
                    $('.form_spesifikasn_sub_barang_inputan').append(data);
                },
            })

            $('.sub_barang').removeAttr('disabled');

            $(document).ready(function() {
                $('.sub_barang').select2({
                    placeholder: '--Pilih Sub Barang',
                    allowClear: true,
                    // containerCssClass: ':all',
                    ajax: {
                        url: "{{ route('pengadaan.list_sub_barang') }}",
                        data: {
                            barang_id: bahan_barang_id
                        },
                        dataType: 'json',
                        delay: 500,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.sub_barang,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
            });

        });
    </script>
@endpush
