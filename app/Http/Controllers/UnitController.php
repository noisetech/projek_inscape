<?php

namespace App\Http\Controllers;

use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        return view('pages.master.unit.index');
    }

    public function data()
    {
        if (request()->ajax()) {

            $data = Unit::all();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
            <a class="dropdown-item" href="' . route('unit.edit', $data->id) . '"><i class="uil-pen"></i><span> Ubah </span></a>';

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
        return view('pages.master.unit.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit' => 'required'
        ], [
            'unit.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $unit = new Unit();
        $unit->unit = $request->unit;
        $unit->save();

        $unit->users()->attach($request->users_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data ditambah',
            'title' => 'Berhasil'
        ]);
    }

    public function edit($id)
    {
        $unit = Unit::find($id);

        return view('pages.master.unit.edit', [
            'unit' => $unit
        ]);
    }

    public function update(Request $request)
    {
        $unit = Unit::find($request->id);
        $unit->unit = $request->unit;
        $unit->save();

        $unit->users()->sync($request->users_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data diubah',
            'title' => 'Berhasil'
        ]);
    }

    public function destroy(Request $request)
    {
        $unit = Unit::find($request->id);

        $hapus =  $unit->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'berhasil'
            ]);
        }
    }

    public function users(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = User::select("id", "email")
                ->Where('email', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function userByUnit(Request $request)
    {
        $users = DB::table('unit')
            ->select('users.id', 'users.email')
            ->join('unit_users', 'unit_users.unit_id', '=', 'unit.id')
            ->join('users', 'users.id', '=', 'unit_users.users_id')
            ->where('unit.id', $request->id)
            ->get();

        return response()->json($users);
    }
}
