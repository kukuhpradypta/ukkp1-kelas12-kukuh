<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class UserprofileController extends Controller
{
    public function index(Request $request)
    {
        return view('user.index');
    }

    public function update(Request $request)
    {
        $user1 = Auth::user();

        if (Str::length($user1) > 0) {
            $this->validate($request, [
                'name'     => 'required',
                'email'     => 'required',
                'nik'     => 'required',
            ]);

            //get data user by ID
            $user = User::where('id', $user1->id);

            if ($request->file('foto') == "") {

                $user->update([
                    'name'     => $request->name,
                    'nik'     => $request->nik,
                    'email'     => $request->email,
                ]);
            } else if ($request->email == $user->email) {
                Storage::disk('local')->delete('assets/images/' . Auth::user()->foto);

                //upload new image
                $foto = $request->file('foto');
                $foto->storeAs('assets/images', $foto->getOriginalName());

                $user->update([
                    'name' => $request->name,
                    'foto'     => $foto->getOriginalName(),
                    'nik' => $request->nik,
                ]);
            } else if ($request->nik == $user->nik) {

                Storage::disk('local')->delete('assets/images/' . Auth::user()->foto);

                //upload new image
                $foto = $request->file('foto');
                $foto->storeAs('assets/images', $foto->getOriginalName());

                $user->update([
                    'name'     => $request->name,
                    'foto'     => $foto->getOriginalName(),
                    'email'     => $request->email,
                ]);
            } else {
                //hapus old image
                Storage::disk('local')->delete('assets/images/' . Auth::user()->foto);

                //upload new image
                $foto = $request->file('foto');
                $foto->storeAs('assets/images', $foto->getOriginalName());

                $user->update([
                    'name'     => $request->name,
                    'foto'     => $foto->getOriginalName(),
                    'nik'     => $request->nik,
                    'email'     => $request->email,
                ]);
            }

            if ($user) {
                //redirect dengan pesan sukses
                return redirect()->route('user.index')->with([Alert::success('success', 'Data Edit Successfull!')]);
            } else {
                //redirect dengan pesan error¿¿¿¿¿¿¿¿¿¿¿¿¿¿
                return redirect()->route('user.index')->with(['error' => 'Data Gagal Diupdate!']);
            }
        }
    }
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();

        return redirect()->intended('userprofile')->with([
            Alert::success('Success', 'Change Password Successfull!')
        ]);
    }
}
