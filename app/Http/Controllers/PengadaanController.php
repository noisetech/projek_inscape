<?php

namespace App\Http\Controllers;

use App\Barang;
use App\DireksiPengadaan;
use App\ParameterBarang;
use App\Pengadaan;
use App\PengadaanDetail;
use App\SpesifikasiParameter;
use App\SpesifikasiSubBarang;
use App\StepPengadaan;
use App\SubBarang;
use App\Tahun;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengadaanController extends Controller
{
    public function index()
    {
        return view('pages.pengadaan.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Pengadaan::all();

            return datatables()->of($data)
                ->addColumn('unit', function ($data) {
                    return $data->unit->unit;
                })
                ->addColumn('tahun', function ($data) {
                    return $data->tahun->tahun;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
                <a class="dropdown-item" href="' . route('pengdaan.detail', $data->id) . '"><i class="uil-pen"></i><span> Detail </span></a>';

                    $button .= '<a class="dropdown-item hapus" id="' . $data->id . '" href="#"><i class="uil-trash-alt"></i><span> Hapus </span></a>
                </div>
            </div>';

                    return $button;
                })


                ->rawColumns(['aksi', 'unit', 'tahun'])
                ->make('true');
        }
    }

    public function create()
    {
        return view('pages.pengadaan.create');
    }

    public function list_unit(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Unit::select("id", "unit")
                ->Where('unit', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = Unit::all();
        }
        return response()->json($data);
    }

    public function list_tahun(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Tahun::select("id", "tahun")
                ->Where('tahun', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = Tahun::all();
        }
        return response()->json($data);
    }

    public function store_pengadaan(Request $request)
    {

        $data = $request->all();

        $file_nota_dinas = $request->file('file');

        $path_nota_dinas = Storage::disk('s3')->put('nota_dinas_pengadaan', $file_nota_dinas, $file_nota_dinas->hashName());

        $pengadaan = new Pengadaan();
        $pengadaan->no_nota_dinas   = $request->no_nota_dinas;
        $pengadaan->unit_id = $request->unit_id;
        $pengadaan->tahun_id = $request->tahun_id;
        $pengadaan->file = $path_nota_dinas;
        $pengadaan->anggaran = $request->anggaran;
        $pengadaan->save();

        $files = [];
        $file_direksi = $request->file('dokumen_direksi');

        // inser direksit
        foreach ($file_direksi as $d_direksi) {
            $path_dokumen_direksi = Storage::disk('s3')->put('dokumen_direksi', $d_direksi,  $d_direksi->hashName());

            $files[] = $path_dokumen_direksi;
        }

        foreach ($data['nama_direksi'] as $item => $value) {
            $direksi = new DireksiPengadaan();
            $direksi->pengadaan_id = $pengadaan->id;
            $direksi->nama = $data['nama_direksi'][$item];
            $direksi->dokumen = $files[$item];
            $direksi->save();
        }

        $bahan = [
            [
                'pengadaan_id' => $pengadaan->id,
                'step' => 'B.1',
                'deskripsi' => Auth::user()->name . ' ' . 'membuat pengadaan barang',
                'status' => '0'
            ],
            [
                'pengadaan_id' => $pengadaan->id,
                'step' => 'B.1',
                'dreskripsi' => Auth::user()->name . '' . 'membuat pengadaan barang',
                'status' => '1'
            ]
        ];

        $finish =   $step =   StepPengadaan::insert($bahan);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function detail($id)
    {
        $pengadaan = Pengadaan::find($id);
        return view('pages.pengadaan.detail', [
            'pengadaan' => $pengadaan
        ]);
    }

    public function download_file_pengadaan($id)
    {
        $pengadaan = Pengadaan::where('id', $id)->first();

        return Storage::disk('s3')->download($pengadaan->file);
    }

    public function download_file_direksi($id)
    {
        $direksi =  DireksiPengadaan::where('id', $id)->first();

        // dd($direksi);

        return Storage::disk('s3')->download($direksi->dokumen);
    }

    public function hapus_pengadaan(Request $request)
    {
        $pengadaan = Pengadaan::find($request->id);

        $finish = $pengadaan->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function list_barang(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $data = Barang::select("id", "nama_barang")
                ->Where('nama_barang', 'LIKE', "%$search%")
                ->get();

            return response()->json($data);
        }
        $data = Barang::all();

        return response()->json($data);
    }

    public function list_sub_barang(Request $request)
    {
        $barang_id = $request->barang_id;

        $data = SubBarang::where('barang_id', $barang_id)->where('sub_barang', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function form_spesifikasi_sub_barang(Request $request)
    {
        $parameter = ParameterBarang::where('barang_id', $request->barang_id)->get();

        $html = '<div class="row mt-2">';
        foreach ($parameter as $p) :
            $html .= '<div class="col-sm-6">
            <div class="mb-3">
            <label for="simpleinput" class="form-label">' . $p->parameter . '</label>';

            $html .= '<select class="form-select" name="spesifikasi_parameter[]">';
            foreach ($p->spesifikasi_parameter as $sp) :
                $html .= '<option value="' . $sp->id . '"> ' . $sp->spesifikasi . ' </option>';
            endforeach;
            $html .= '</select>';
            $html .= '</div>

            </div>';
        endforeach;
        $html .= '</div>';
        $html .= '<div></div>';

        return response()->json($html);
    }

    public function hitung(Request $request)
    {

        $barang = Barang::where('id', $request->barang_id)->first();

        if ($barang->nama_barang == 'lampu' || $barang->nama_barang == 'Lampu' || $barang->nama_barang == 'LAMPU' ) {
            $bahan_id_parameter = SpesifikasiParameter::whereIn('id', ($request->spesifikasi_parameter))->pluck('parameter_barang_id');

            $parameter = ParameterBarang::whereIn('id', $bahan_id_parameter)->get();

            $spesifikasi = SpesifikasiParameter::whereIn('id', $request->spesifikasi_parameter)->get();



            $bahan_hitung_bobot = [];
            foreach ($parameter as $key => $value) {
                $bahan_hitung_bobot[] = $value['bobot'];
            }

            $bahan_hitung_sepsifikasi = [];

            foreach ($spesifikasi as $key2 => $value2) {
                $bahan_hitung_sepsifikasi[] = $value2['level'];
            }


            $perkalian = array_map(function ($v1, $v2) {
                return $v1 * $v2;
            }, $bahan_hitung_bobot, $bahan_hitung_sepsifikasi);


            $total_hitung_perkalian = array_sum($perkalian);
            $total_bobot = array_sum($bahan_hitung_bobot);
            $hasil_akhir_perhitungan  =  json_encode($total_hitung_perkalian / $total_bobot);


            if ($hasil_akhir_perhitungan > "2") {
                $score = $hasil_akhir_perhitungan;
                $Likelihoodlevel = 'Tinggi';
                $rekomendasi = 'Hasil memuaskan silahkan simpan';
            } elseif ($hasil_akhir_perhitungan > "1") {
                $score = $hasil_akhir_perhitungan;
                $Likelihoodlevel = 'Sedang';
                $rekomendasi = 'Hasil belum memuaskan silahkan lakukan perhitungan kembali';
            } else {
                $score = $hasil_akhir_perhitungan;
                $Likelihoodlevel = 'Rendah';
                $rekomendasi = 'Hasil belum memuaskan silahkan lakukan perhitungan kembali';
            }

            $spesifikasi = $request->spesifikasi_parameter;


            return response()->json(['spesifikasi_parameter_id' => $spesifikasi, 'score' => $score, 'likelihood_level' => $Likelihoodlevel, 'rekomendasi' => $rekomendasi]);
        }
    }

    public function ceklist_direksi(Request $request)
    {

        $id = $request->id;

        $direksi = DireksiPengadaan::find($id);

        $data = [
            'status' => $request->status
        ];

        $direksi->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Melakukan ceklist',
            'title' => 'Berhasil'
        ]);
    }

    public function simpan_pengadaan_detail(Request $request)
    {
        dd($request->all());

        $pengadaan_detail = new PengadaanDetail();
        $pengadaan_detail->sub_barang_id = $request->sub_barang_id;
        $pengadaan_detail->score_ss = $request->score_ss;
        $pengadaan_detail->like_hood_ss = $request->like_hood_ss;
        $pengadaan_detail->rekomendasi_ss = $request->rekomendasi_ss;
        $pengadaan_detail->save();
    }

    public function disposisi(Request $request){

    }
}
