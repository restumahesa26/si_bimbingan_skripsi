<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Mahasiswa::all();

        return view('pages.admin.data-mahasiswa.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.data-mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => 'MAHASISWA',
            'password' => Hash::make($request->password),
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'npm' => $request->npm
        ]);

        return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Menambah Data Mahasiswa']);
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
        $item = Mahasiswa::findOrFail($id);

        return view('pages.admin.data-mahasiswa.edit', [
            'item' => $item
        ]);
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
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
        ]);

        $item = Mahasiswa::findOrFail($id);
        $item2 = User::where('id', $item->user_id)->first();

        if ($item2->email != $request->email) {
            $request->validate([
                'email' => ['required', 'string', 'max:255', 'unique:users']
            ]);
        }

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        $item->update([
            'npm' => $request->npm
        ]);

        $item2->nama = $request->nama;
        $item2->username = $request->username;
        $item2->email = $request->email;
        if ($request->password) {
            $item2->password = Hash::make($request->password);
        }
        $item2->save();

        return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Mengubah Data Mahasiswa']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Mahasiswa::findOrFail($id);

        $item->delete();

        return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Menghapus Data Mahasiswa']);
    }
}
