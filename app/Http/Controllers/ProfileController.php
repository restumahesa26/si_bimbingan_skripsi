<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        $item = User::findOrFail(Auth::user()->id);

        return view('pages.profile', [
            'item' => $item
        ]);
    }

    public function update(Request $request)
    {
        $item = User::findOrFail(Auth::user()->id);
        if (Auth::user()->role === 'MAHASISWA') {
            $request->validate([
                'username' => ['required', 'string', 'max:255'],
            ]);

            if ($request->email != $item->email) {
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }

            if ($request->password) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
            }

            $item->username = $request->username;
            $item->email = $request->email;
            if ($request->password) {
                $item->password = Hash::make($request->password);
            }
            $item->save();
        }elseif (Auth::user()->role === 'DOSEN') {
            $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'jabatan' => ['required', 'string', 'max:255'],
                'prodi' => ['required', 'string', 'max:255'],
                'fakultas' => ['required', 'string', 'max:255'],
                'status' => ['required', 'in:1,0'],
            ]);

            if ($request->email != $item->email) {
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }

            if ($request->password) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
            }

            $dosen = Dosen::where('user_id', Auth::user()->id)->first();

            $item->username = $request->username;
            $item->email = $request->email;
            if ($request->password) {
                $item->password = Hash::make($request->password);
            }
            $item->save();

            $dosen->update([
                'jabatan' => $request->jabatan,
                'prodi' => $request->prodi,
                'fakultas' => $request->fakultas,
                'status' => $request->status
            ]);
        }elseif (Auth::user()->role === 'ADMIN') {
            $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
            ]);

            if ($request->email != $item->email) {
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }

            if ($request->password) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
            }

            $item->username = $request->username;
            $item->nama = $request->nama;
            $item->email = $request->email;
            if ($request->password) {
                $item->password = Hash::make($request->password);
            }
            $item->save();
        }

        return redirect()->route('profile.edit');
    }
}
