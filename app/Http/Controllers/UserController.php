<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.manage-users.users.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = User::orderBy('email', 'ASC')->get();

            return datatables()->of($data)
                ->addColumn('role', function ($data) {
                    foreach ($data->roles as $key => $value) {
                        return $value->name;
                    }
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
                <a class="dropdown-item" href="' . route('user.edit', $data->id) . '"><i class="uil-pen"></i><span> Ubah </span></a>';

                    $button .= '<a class="dropdown-item hapus" id="' . $data->id . '" href="#"><i class="uil-trash-alt"></i><span> Hapus </span></a>
                </div>
            </div>';

                    return $button;
                })
                ->rawColumns(['aksi', 'role'])
                ->make('true');
        }
    }

    public function create()
    {
        return view('pages.manage-users.users.create');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $role = Role::find($request->role_id);

        $finish =  $user->assignRole($role->name);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.manage-users.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        if ($request->password == null) {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $user->password;
            $user->save();

            $role = Role::find($request->role_id);

            $finish = $user->assignRole($role->name);

            if ($finish) {
                return response()->json([
                    'status' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Data disimpan',
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);

        $hapus = $user->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function role(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Role::select("id", "name")
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function roleByUser(Request $request)
    {
        $user = User::find($request->id);

        // dapetin seluruh name user yang berelasi
        $relasi_user_by_role = $user->getRoleNames();

        // get all data by role yang berelasi
        $role = Role::whereIn('name', $relasi_user_by_role)->get();

        return response()->json($role);
    }
}
