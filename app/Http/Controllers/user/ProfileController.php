<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * ProfileController constructor.
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
        ]);

        $user         = $request->user();
        $user->email  = $request->get('email');
        $user->alamat = $request->get('alamat');
        $user->no_hp  = $request->get('no_hp');

        if ($request->file('photo')) {
            Storage::disk('public')->delete($user->photo);
            $this->imageService->imageUpload($request->file('photo'), $user, 'photo');
        }

        $user->save();

        return redirect()->route('profile.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data berhasil disimpan.',
                'profile' => 'profile.'
            ]);
    }

    /**
     * Update Password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old' => 'required',
            'new' => 'required|min:6|confirmed',
        ]);

        $user     = $request->user();
        $password = $user->password;

        if (Hash::check($request->input('new'), $password)) {
            return redirect()->route('profile.index')
                ->with('alert', [
                    'type'    => 'warning',
                    'alert'   => 'Gagal !',
                    'message' => 'Kata Sandi baru Anda sama dengan kata sandi lama.',
                    'password' => 'password.'
                ]);
        }

        if (Hash::check($request->input('old'), $password)) {
            $user           = $request->user();
            $user->password = Hash::make($request->input('new'));
            $user->save();

            return redirect()->route('profile.index')
                ->with('alert', [
                    'type'    => 'warning',
                    'alert'   => 'Berhasil !',
                    'message' => 'Kata Sandi baru berhasil disimpan.',
                    'password' => 'password.'
                ]);
        }

        return redirect()->route('profile.index')
            ->with('alert', [
                'type'    => 'warning',
                'alert'   => 'Gagal !',
                'message' => 'Kata Sandi lama Anda salah.',
                'password' => 'password.'
            ]);
    }
}
