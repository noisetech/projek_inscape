<?php

namespace App\Http\Controllers;

use App\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunController extends Controller
{
    public function index()
    {
        return view('pages.master.tahun.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Tahun::all();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
                <a class="dropdown-item" href="' . route('tahun.edit', $data->id) . '"><i class="uil-pen"></i><span> Ubah </span></a>';

                    $button .= '<a class="dropdown-item hapus" id="' . $data->id . '" href="#"><i class="uil-trash-alt"></i><span> Hapus </span></a>
                </div>
            </div>';

                    return $button;
                })


                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function create()
    {
        return view('pages.master.tahun.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required'
        ], [
            'tahun.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $tahun = new Tahun();
        $tahun->tahun = $request->tahun;
        $tahun->save();

        if ($tahun) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function edit($id)
    {
        $tahun = Tahun::find($id);

        return view('pages.master.tahun.edit', [
            'tahun' => $tahun
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required'
        ], [
            'tahun.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $tahun = Tahun::find($request->id);
        $tahun->tahun = $request->tahun;
        $tahun->save();

        if ($tahun) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $tahun = Tahun::find($request->id);

        $hapus = $tahun->delete();

        if ($hapus) {
            return response()
                ->json([
                    'status' => 'success',
                    'message' => 'Data dihapus',
                    'title' => 'Berhasil'
                ]);
        }
    }
}
