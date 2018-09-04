<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Menu;
use App\Http\Requests\Admin\StoreMenuPost;
use App\Http\Requests\Admin\UpdateMenuPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Menu::where('is_admin', '=', false)
            ->orderBy('menu.urutan')
            ->get();

        return view ('admin.menu.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view ('admin.menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuPost $request)
    {
        $menu = new Menu();
        $menu->nama         = $request->get('nama');
        $menu->url          = $request->get('url');
        $menu->urutan       = $request->get('urutan');
        $menu->icon         = $request->get('icon');
        $menu->level        = $request->get('level');
        $menu->parrent_id   = $request->get('parent_id');
        $menu->aktif        = $request->get('aktif') == 'on' ? true : false;
        $menu->save();

        try {
            $permission = Permission::findByName(create_permission_name($menu->nama));
        } catch (PermissionDoesNotExist $e) {
            Permission::create(['name' => create_permission_name($menu->nama)]);
        }


        return redirect()->route('menu.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Menu berhasil disimpan.',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Menu::findOrFail($id);
        $menus = Menu::where('id', '<>', $id)->get();
        return view('admin.menu.edit', compact('item', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuPost $request, $id)
    {
        $menu               = Menu::findOrFail($id);
        $menu->nama         = $request->get('nama');
        $menu->url          = $request->get('url');
        $menu->urutan       = $request->get('urutan');
        $menu->icon         = $request->get('icon');
        $menu->level        = $request->get('level');
        $menu->parrent_id   = $request->get('parent_id');
        $menu->aktif        = $request->get('aktif') == 'on' ? true : false;
        $menu->save();

        try {
            $permission = Permission::findByName(create_permission_name($menu->nama));
        } catch (PermissionDoesNotExist $e) {
            Permission::create(['name' => create_permission_name($menu->nama)]);
        }

        return redirect()->route('menu.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Menu berhasil diperbarui.',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id)->delete();

        return redirect()->route('menu.index')
            ->with('alert', [
               'type'    => 'sucess',
               'alert'   => 'Berhasil !',
               'message' => 'Menu berhasil dihapus.'
            ]);
    }
}
