<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    const DEFAULT_GUARD_NAME = 'web';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Role::where('name', '<>', 'Administrator')
            ->get();

        return view('admin.roles.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'   => 'required|max:255|unique:roles',
        ]);
        $role               = new Role();
        $role->name         = $request->get('name');
        $role->guard_name   = $request->get('guard_name') ?? self::DEFAULT_GUARD_NAME;
        $role->save();

        return redirect()->route('role.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Role berhasil disimpan.',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Role::findOrFail($id);
        return view ('admin.roles.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,'.$id
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->get('name');
        $role->guard_name   = $request->get('guard_name') ?? self::DEFAULT_GUARD_NAME;
        $role->save();

        return redirect()->route('role.index')->with('alert', [
            'type'    => 'success',
            'alert'   => 'Berhasil !',
            'message' => 'Role berhasil diperbarui.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id)->delete();

        return redirect()->route('role.index')->with('alert', [
            'type'    => 'success',
            'alert'   => 'Berhasil !',
            'message' => 'Role berhasil dihapus.',
        ]);
    }

    /**
     * @param $roleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permission($roleId)
    {
        $role = Role::findById($roleId, 'web');
        if (!$role) {
            return error_pages(400, 'Opps... Role Tidak Ditemukan');
        }
        $items = Menu::all();
        return view ('admin.roles.permission.index', compact('items'));
    }
}
