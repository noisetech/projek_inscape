<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('pages.manage-users.permission.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Permission::orderBy('name', 'ASC')->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
            <a class="dropdown-item" href="' . route('permission.edit', $data->id) . '"><i class="uil-pen"></i><span> Ubah </span></a>';

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
        return view('pages.manage-users.permission.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $permissions = new Permission();
        $permissions->name = $request->name;
        $simpan =    $permissions->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function edit($id)
    {

        $permissions = Permission::find($id);
        return view('pages.manage-users.permission.edit', [
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $permissions = Permission::find($request->id);
        $permissions->name = $request->name;
        $ubah =  $permissions->save();

        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $permissions = Permission::find($request->id);

        $hapus =  $permissions->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
