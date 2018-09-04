<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;
use App\Opd;
use App\Bidang;
use App\BidangPermission;
use App\Enum\Roles;
use Illuminate\Support\Facades\DB;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
    	$items = \Spatie\Permission\Models\Permission::all();
    	$roles = Bidang::all();
    	$all_bidang_permission = BidangPermission::orderBy('opd_id')->get();

    	$opds = Opd::whereBetween('jenis_opd_id', [1,2])->get();
    	$length = count($opds);

    	if (!empty($request->opd[1])) { // jika buka halaman dr submit form maka if berjalan
    		for ($i=1; $i<$length+1 ; $i++) { 
	 			$target_bidang = DB::table('bidang_permissions')
	    							->where('opd_id', $i)
	    							->update(['bidang_id' => $request->opd[$i]]);
	    	}

	    	$all_bidang_permission = BidangPermission::orderBy('opd_id')->get();
    	}

    	$count = 1;

// print_r($opds[0]->nama);
    	return view('admin.bidang.index', compact('items', 'roles', 'opds', 'length', 'all_bidang_permission', 'count'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param $roleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function listOpd(Request $request)
    {
        $bidangId = $request->get('bidangId');
        if (!$bidangId) {
            // return response()->json(['message' => 'bidangId wajib diisi!'], 400);
            return response()->json($opd->permissions, 200);
        }
        $opd = Bidang::findById($bidangId, 'web');
        return response()->json($opd->permissions, 200);

    }

    public function attachPermission(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required'
        ]);

        try {
            $role = Role::findById($request->role_id, 'web');
        } catch (RoleDoesNotExist $e) {
            return error_pages(400, 'ROLE tidak ditemukan, hubungi Administrator!');
        }

        $permissions = $request->except('_token', 'role_id');

        try {
            // Cek eksisting permission
            $allPermission = \Spatie\Permission\Models\Permission::pluck('name')->toArray();
            foreach ($allPermission as $perm) {
                // hilangkan permission dari role
                $role->revokePermissionTo($perm);
            }
            $arr = array_keys($permissions);
            $formated = array_map(function ($arr) {
                return 'menu ' . $arr;
            }, $arr);
            // attach permission ke user
            $role->givePermissionTo($formated);
        } catch (PermissionDoesNotExist $e) {
            return error_pages(500, 'Permission tidak ditemukan, hubungi Administrator!');
        }

        return redirect()->route('permission.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Permission berhasil disimpan.',
            ]);
    }
}
