<?php

namespace App\Http\Controllers;

use App\Barang;
use App\ParameterBarang;
use App\Pengadaan;
use App\SpesifikasiParameter;
use App\SpesifikasiSubBarang;
use App\SubBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BarangController extends Controller
{

    // bagian barang
    public function index()
    {
        return view('pages.master.barang.index');
    }

    public function data()
    {
        if (request()->ajax()) {

            $data = Barang::orderBy('nama_barang', 'ASC')->get();

            return datatables()->of($data)
                ->editColumn('gambar', function ($data) {
                    return "<img src=" . Storage::disk('s3')->temporaryUrl($data->gambar, now()->addMinutes(5)) . " class='img-thumbnail' width='100'>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
                <a class="dropdown-item edit" href="#" id="' . $data->id . '"><i class="uil-pen"></i><span> Ubah </span></a>';
                    $button .= '<a class="dropdown-item sub_barang" id="' . $data->id . '" href="#"><i class="uil-book"></i><span> Sub barang </span></a>
               ';
                    $button .= '<a class="dropdown-item hapus" id="' . $data->id . '" href="#"><i class="uil-trash-alt"></i><span> Hapus </span></a>
                    </div>
                </div>';


                    return $button;
                })
                ->rawColumns(['aksi', 'gambar'])
                ->make('true');
        }
    }

    public function create()
    {
        return view('pages.master.barang.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'gambar' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required'
        ], [
            'nama_barang.required' => 'tidak boleh kosong',
            'gambar.required' => 'tidak boleh kosong',
            'deskripsi.required' => 'tidak boleh kosong',
            'gambar.file' => 'harus berupa file',
            'gambar.mimes' => 'harus file gambar berupa png, jpg, jpeg',
            'gambar.max' => 'maksimal 2MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $file = $request->file('gambar');

        $path = Storage::disk('s3')->put('gambar_barang', $file, $file->hashName());

        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->gambar = $path;
        $barang->slug = Str::slug($request->nama_barang);
        $barang->deskripsi = $request->deskripsi;
        $finish =  $barang->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function detail($id)
    {
        $barang = Barang::find($id);

        $sub_barang = SubBarang::whereHas('barang', function ($q) use ($barang) {
            return $q->where('barang_id', $barang->id);
        })->get();

        $parameter = ParameterBarang::whereHas('barang', function ($q) use ($barang) {
            return $q->where('barang_id', $barang->id);
        })->get();

        return view('pages.master.barang.detail', [
            'barang' => $barang,
            'sub_barang' => $sub_barang,
            'parameter' => $parameter
        ]);
    }

    public function barangById(Request $request)
    {
        $barang = Barang::find($request->id);

        return response()->json($barang);
    }



    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'gambar' => 'file|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required'
        ], [
            'nama_barang.required' => 'tidak boleh kosong',
            'deskripsi.required' => 'tidak boleh kosong',
            'gambar.file' => 'harus berupa file',
            'gambar.mimes' => 'harus file gambar berupa png, jpg, jpeg',
            'gambar.max' => 'maksimal 2MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        if (!empty($request->gambar)) {

            $file = $request->file('gambar');

            $path = Storage::disk('s3')->put('gambar_barang', $file, $file->hashName());

            $barang = Barang::find($request->id);
            $barang->nama_barang = $request->nama_barang;
            $barang->gambar = $path;
            $barang->slug = Str::slug($request->nama_barang);
            $barang->deskripsi = $request->deskripsi;
            $finish =  $barang->save();

            if ($finish) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data diubah',
                    'title' => 'Berhasil'
                ]);
            }
        }

        $barang = Barang::find($request->id);
        $barang->nama_barang = $request->nama_barang;
        $barang->slug = Str::slug($request->nama_barang);
        $barang->deskripsi = $request->deskripsi;
        $finish =  $barang->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus_barang(Request $request)
    {
        $barang = Barang::find($request->id);

        $finish =  $barang->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }

    // akhir barang


    // awal sub barang

    public function data_sub_barang(Request $request)
    {
        if (request()->ajax()) {

            $data = DB::table('sub_barang')->where('barang_id', $request->barang_id)
                ->select('sub_barang.*', 'barang.*')
                ->join('barang', 'barang.id', '=', 'sub_barang.barang_id')
                ->get();

            // dd($data);

            return datatables()->of($data)
                ->addColumn('barang', function ($data) {
                    return $data->nama_barang;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
                <a class="dropdown-item edit_sub_barang" href="#" id="' . $data->id . '"><i class="uil-pen"></i><span> Ubah </span></a>';

                    $button .= '<a class="dropdown-item hapus_sub_barang" id="' . $data->id . '" href="#"><i class="uil-trash-alt"></i><span> Hapus </span></a>
                    </div>
                </div>';


                    return $button;
                })
                ->rawColumns(['aksi', 'barang'])
                ->make('true');
        }
    }

    public function create_sub_barang($slug)
    {
        $barang = Barang::where('slug', $slug)->first();

        return view('pages.master.barang.create_sub_barang', [
            'barang' => $barang
        ]);
    }



    public function store_sub_barang(Request $request)
    {
        $sub_barang = new SubBarang();
        $sub_barang->barang_id = $request->barang_id;
        $sub_barang->sub_barang = $request->sub_barang;
        $sub_barang->slug = Str::slug($request->sub_barang);
        $finish =    $sub_barang->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function edit_sub_barang($slug)
    {
        $sub_barang = SubBarang::where('slug', $slug)->first();

        return view('pages.master.barang.edit_sub_barang', [
            'sub_barang' => $sub_barang
        ]);
    }

    public function update_sub_barang(Request $request)
    {

        $sub_barang = SubBarang::find($request->id);
        $sub_barang->barang_id = $request->barang_id;
        $sub_barang->sub_barang = $request->sub_barang;
        $sub_barang->slug = Str::slug($request->sub_barang);
        $finish =    $sub_barang->save();


        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus_sub_barang(Request $request)
    {
        $sub_barang = SubBarang::find($request->id);

        $finish = $sub_barang->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function create_parameter_barang($slug)
    {
        $barang = Barang::where('slug', $slug)->first();

        return view('pages.master.barang.create_parameter', [
            'barang' => $barang
        ]);
    }

    public function store_parameter_barang(Request $request)
    {

        $parameter = new ParameterBarang();
        $parameter->barang_id = $request->barang_id;
        $parameter->parameter = $request->parameter;
        $parameter->bobot = $request->bobot;
        $parameter->slug = Str::slug($request->parameter);
        $finish =  $parameter->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function edit_parameter_barang($slug)
    {

        $parameter = ParameterBarang::where('slug', $slug)->first();

        return view('pages.master.barang.edit_parameter', [
            'parameter' => $parameter
        ]);
    }

    public function updateParameterBarang(Request $request)
    {
        $parameter = ParameterBarang::find($request->id);
        $parameter->barang_id = $request->barang_id;
        $parameter->parameter = $request->parameter;
        $parameter->bobot = $request->bobot;
        $parameter->slug = Str::slug($request->parameter);
        $finish =  $parameter->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus_parameter(Request $request)
    {
        $parameter = ParameterBarang::find($request->id);

        $finish = $parameter->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
                'title' => 'Berhasil'
            ]);
        }
    }



    public function create_spesifikasi_parameter($slug)
    {
        $parameter = ParameterBarang::where('slug', $slug)->first();

        return view('pages.master.barang.create_spesifikasi_parameter', [
            'parameter' => $parameter
        ]);
    }

    public function store_spesifikasi_parameter(Request $request)
    {
        $spesifikasi_parameter = new SpesifikasiParameter();
        $spesifikasi_parameter->parameter_barang_id = $request->parameter_barang_id;
        $spesifikasi_parameter->spesifikasi = $request->spesifikasi;
        $spesifikasi_parameter->level = $request->level;
        $spesifikasi_parameter->slug = Str::slug($request->spesifikasi);
        $finish = $spesifikasi_parameter->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function edit_spesifikasi_paremeter($slug)
    {
        $spesifikasi_parameter = SpesifikasiParameter::where('slug', $slug)->first();

        // dd($spesifikasi_parameter);

        return view('pages.master.barang.edit_sepesifikasi_parameter_barang', [
            'spesifikasi_parameter' => $spesifikasi_parameter
        ]);
    }

    public function update_spesfikasi_parameter(Request $request)
    {
        $spesifikasi_parameter = SpesifikasiParameter::find($request->id);
        $spesifikasi_parameter->parameter_barang_id = $request->parameter_barang_id;
        $spesifikasi_parameter->level = $request->level;
        $spesifikasi_parameter->spesifikasi = $request->spesifikasi;
        $spesifikasi_parameter->slug = Str::slug($request->spesifikasi);
        $finish = $spesifikasi_parameter->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data diubah'
            ]);
        }
    }

    public function hapus_spesifikasi_parameter(Request $request)
    {
        $spesifikasi_parameter = SpesifikasiParameter::find($request->id);

        $finish = $spesifikasi_parameter->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
