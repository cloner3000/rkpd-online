<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserPost;
use App\Http\Requests\Admin\UpdateUserPost;
use App\JenisOpd;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::orderBy('name', 'ASC')->get();

        return view('admin.user.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        $user               = new User();
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->alamat       = '';
        $user->no_hp       = '';
        $user->photo       = '';

        $user->password = Hash::make($request->input('password'));

        $roles              = $request->input('role', []);
        $opd                = $request->input('opd', []);
        $user->save();
        $user->roles()->sync($roles);
        $user->opd()->sync($opd);

        return redirect()->route('user.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'User berhasil disimpan.'
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
        $item       = User::findOrFail($id);
        $roles      = Role::orderBy('name', 'ASC')->pluck('name', 'id');
        $user_role  = $item->roles->first();
        $opd        = $item->opd->first();
        $jenis_opd  = null;

        if ($user_role) {
            $jenis_opd = JenisOpd::where('nama', 'LIKE', '%'.$user_role->name.'%')->first();
        }

        return view('admin.user.edit', compact('item', 'roles', 'user_role', 'jenis_opd', 'opd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPost $request, $id)
    {
        $user               = User::find($id);
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->nama_lengkap = $request->input('nama_lengkap');
        $roles              = $request->input('role', []);
        $opd                = $request->input('opd', []);
        $user->save();
        $user->roles()->sync($roles);
        $user->opd()->sync($opd);

        return redirect()->route('user.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'User berhasil diperbarui.'
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
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'User berhasil dihapus.',
            ]);
    }

    public function listOpd(Request $request)
    {
        $data      = [];
        $name      = '';
        $jenis     = $request->get('jenis');
        $jenis_opd = JenisOpd::where('nama', 'LIKE', '%'.$jenis.'%')->first();

        if (!$jenis_opd) {
            return response()->json(['message' => 'No Data !'], 404);
        }

        $items = $jenis_opd->opd;
        foreach ($items as $item) {
            if (!empty($item->village->district))
                $name = ' KECAMATAN ' .$item->village->district->name;

            $data[] = [
                'id'   => $item->id,
                'nama' => $item->nama. $name
            ];
        }

        return response()->json($data, 200);
    }

    public function list()
    {
        $items = User::orderBy('name', 'ASC')->get();

        return response()->json($items, 200);
    }

    /**
     * Update Password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword($id,Request $request)
    {
        $this->validate($request, [
            'new' => 'required|min:6|confirmed',
        ]);

        $user           = User::findOrFail($id);
        $user->password = Hash::make($request->input('new'));
        $user->save();

        return redirect()->route('user.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Kata Sandi baru berhasil disimpan.',
                'password' => 'password.'
            ]);
    }
}
