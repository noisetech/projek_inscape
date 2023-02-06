@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Spesifikasi Sub Barang</li>
                    </ol>
                </div>
                <h4 class="page-title">Tambah Spesifikasi Sub Barang</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST" id="tahun_form">
                        @csrf

                        <input type="hidden" name="sub_barang_id" value="{{ $sub_barang->id }}">

                        <div class="row">
                            @foreach ($bahan_parameter as $bahan_parameter)
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">{{ $bahan_parameter->parameter }}</label>
                                        <select name="spesifikasi[]" class="form-select">
                                            @foreach ($bahan_parameter->spesifikasi_parameter as $spesifikasi_parameter)
                                                <option value="{{ $spesifikasi_parameter->id }}">
                                                    {{ $spesifikasi_parameter->spesifikasi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#tahun_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('simpan.spesifikasi_sub_barang') }}',
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
                                "{{ route('barang.detail', $bahan_parameter->barang_id) }}"
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
