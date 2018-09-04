<?php

namespace App\Http\Controllers\Admin;

use App\BidangUrusan;
use App\JenisOpd;
use App\Opd;
use App\RoleOpd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleOpdController extends Controller
{
    public function index(Request $request)
    {
        $q_jenis    = $request->get('jenis_opd');
        $q_role     = $request->get('role_id');
        $items      = Opd::whereJenisOpdId($q_jenis)->get();
        $roles      = Role::where('name', 'LiKE', 'Bidang%')->pluck('name', 'id');
        $role_opd   = RoleOpd::whereIn('opd_id', $items->pluck('id'))->pluck('opd_id')->toArray();
        $jenis_opd  = JenisOpd::where('nama', 'OPD')
            ->orWhere('nama', 'Kecamatan')
            ->pluck('nama', 'id');

        return view('admin.role_opd.index', compact(
            'jenis_opd',
            'items',
            'q_jenis',
            'roles',
            'role_opd', 'q_role'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['role' => 'required']);

        $role      = $request->input('role');
        $jenis_opd = $request->input('jenis_opd');
        $input     = $request->except('_token', 'role', 'jenis_opd');
        $opd       = Opd::whereJenisOpdId($jenis_opd)->pluck('id');

        RoleOpd::whereRoleId($role)->whereIn('opd_id', $opd)->delete();

        foreach ($input as $key => $value){
            $item          = New RoleOpd();
            $item->role_id = $role;
            $item->opd_id  = $key;
            $item->save();
        }

        return redirect()->route('role-opd.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data berhasil disimpan.'
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listOpd(Request $request)
    {
        $roleId = $request->get('roleId');

        if (!$roleId) {
            return response()->json(['message' => 'roleId wajib diisi!'], 400);
        }

        $role = RoleOpd::whereRoleId($roleId)->pluck('opd_id');

        return response()->json($role, 200);
    }
}
