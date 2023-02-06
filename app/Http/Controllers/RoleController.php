<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.manage-users.roles.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Role::orderBy('name', 'ASC')->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
            <a class="dropdown-item" href="' . route('role.edit', $data->id) . '"><i class="uil-pen"></i><span> Ubah </span></a>';

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
        return view('pages.manage-users.roles.create');
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        $simpan = $role->syncPermissions($request->input('permission'));

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function permissions(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Permission::select("id", "name")
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function permissionsByRole(Request $request)
    {
        $role = Role::find($request->id);

        $permission = Permission::whereHas('roles', function ($q)
        use ($role) {
            return $q->where('role_has_permissions.role_id', $role->id);
        })->get();

        return response()->json($permission);
    }



    public function edit($id)
    {
        $role = Role::find($id);
        return view('pages.manage-users.roles.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->save();

        $simpan = $role->syncPermissions($request->input('permission'));

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data diubah'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $role = Role::find($request->id_role);

        $permissions = Permission::find($request->id_permission);
        $role->revokePermissionTo($permissions);
    }

    public function destroyPermissionByRole(Request $request)
    {
        $id_role = $request->id_role;
        $id_permission = $request->id_permission;

        $role = Role::find($id_role);
        $permission = Permission::find($id_permission);

        $delete =  $role->revokePermissionTo($permission);

        if ($delete) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
