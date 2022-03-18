<?php

namespace App\Http\Controllers;

use App\Models\Catatanperjalanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class CatatanperjalananController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $catatanperjalanans = Catatanperjalanan::latest()->where('id_user', $id)->paginate(3);
        return view('catatanperjalanan.index', compact('catatanperjalanans'));
    }

    public function store(Request $request)
    {
        $userg = Auth::user()->id;

        $foto = $request->file('foto');
        $foto->storeAs('public/catatanperjalanans', $foto->hashName());
        $catatanperjalanan = Catatanperjalanan::create([
            'id_user'     => $userg,
            'tgl'     => $request->tgl,
            'jam'   => $request->jam,
            'lokasi'     => $request->lokasi,
            'suhu'   => $request->suhu,
            'foto'     => $foto->hashName(),
        ]);
        if ($catatanperjalanan) {
            //redirect dengan pesan sukses
            return redirect()->route('catatanperjalanan.index')->with([Alert::success('success', 'Data Create Successfull!')]);
        } else {
            //redirect dengan pesan error
            return redirect()->route('catatanperjalanan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function search(Request $request)
    {
        $id = Auth::user()->id;
        $keyword = $request->search;
        $catatanperjalanans = Catatanperjalanan::latest()->where('id_user', $id)->where('lokasi', 'like', "%" . $keyword . "%")->orWhere('tgl', 'like', "%" . $keyword . "%")->paginate(3);
        return view('catatanperjalanan.index', compact('catatanperjalanans'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function edit(Catatanperjalanan $catatanperjalanan)
    {
        // $id = Auth::user()->id;
        // $catatanperjalanans = Catatanperjalanan::where('id_user', $id)->where('id_user', Auth::user()->id)->first();


        // if ($catatanperjalanan) {
        //     //redirect dengan pesan sukses
        //     return view('catatanperjalanan.edit', compact('catatanperjalanan'));
        // } else {
        //     //redirect dengan pesan error
        //     return redirect()->route('catatanperjalanan.index')->with([Alert::success('Failed', 'Data Not Found!')]);
        // }
        return view('catatanperjalanan.edit', compact('catatanperjalanan'));
    }

    public function update(Request $request, Catatanperjalanan $catatanperjalanan)
    {
        $this->validate($request, [
            'tgl'     => '',
            'jam'   => '',
            'lokasi'   => '',
            'suhu'   => '',
            'foto'     => '|image|mimes:png,jpg,jpeg',
        ]);

        //get data Catatanperjalanan by ID
        $catatanperjalanan = Catatanperjalanan::findOrFail($catatanperjalanan->id);

        if ($request->file('foto') == "") {

            $catatanperjalanan->update([
                'tgl'     => $request->tgl,
                'jam'   => $request->jam,
                'lokasi'     => $request->lokasi,
                'suhu'     => $request->suhu,
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/catatanperjalanans/' . $catatanperjalanan->foto);

            //upload new foto
            $foto = $request->file('foto');
            $foto->storeAs('public/catatanperjalanans', $foto->hashName());

            $catatanperjalanan->update([
                'tgl'     => $request->tgl,
                'jam'   => $request->jam,
                'lokasi'     => $request->lokasi,
                'suhu'   => $request->suhu,
                'foto'     => $foto->hashName(),
            ]);
        }
        if ($catatanperjalanan) {
            //redirect dengan pesan sukses
            return redirect()->route('catatanperjalanan.index')->with([Alert::success('success', 'Data Edit Successfull!')]);
        } else {
            //redirect dengan pesan error
            return redirect()->route('catatanperjalanan.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $catatanperjalanan = Catatanperjalanan::findOrFail($id);
        Storage::disk('local')->delete('public/catatanperjalanans/' . $catatanperjalanan->foto);
        $catatanperjalanan->delete();

        if ($catatanperjalanan) {
            //redirect dengan pesan sukses
            return redirect()->route('catatanperjalanan.index')->with([Alert::success('success', 'Data Delete Successfull!')]);
        } else {
            //redirect dengan pesan error
            return redirect()->route('catatanperjalanan.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
