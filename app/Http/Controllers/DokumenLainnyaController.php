<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Riwayat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DokumenLainnya;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenLainnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dokumen-lainnya.index', [
            'title' => 'Dokumen Lainnya',
            'dokumen' => DokumenLainnya::all(),
            'tasks' => Task::all(),
            'riwayat' => Riwayat::where('jenis', 'Dokumen Lainnya')->latest()->get(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokumen-lainnya.create', [
            'title' => 'Tambah Dokumen Lainnya',
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'berkas' => 'nullable|file|max:16384'
        ]);

        if ($request->file('berkas')) {
            $validatedData['berkas'] = $request->file('berkas')->store('dokumen-lainnya');
        }
        $user = User::find($request->user_id);
        $dokumen = DokumenLainnya::max('id');
        $nama = Str::of($request->nama)->slug('-');
        DB::table('riwayats')->insert([
            'surat_id' => ++$dokumen,
            'pembuat_id' => $user->id,
            'nama' => $user->name,
            'nomor' => $nama . '-' . ++$dokumen,
            'keterangan' => $user->nama . ' Menambahkan Dokumen Lainnya ' . $request->nama,
            'status' => 'Disetujui',
            'jenis' => 'Dokumen Lainnya',
            'created_at' => now()
        ]);
        DokumenLainnya::create($validatedData);

        return redirect('/lainnya')->with('success', 'Data berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DokumenLainnya  $dokumenLainnya
     * @return \Illuminate\Http\Response
     */
    public function show(DokumenLainnya $dokumenLainnya)
    {
        return view('dokumen-lainnya.show', [
            'title' => 'Dokumen Lainnya',
            'dokumen' => $dokumenLainnya,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DokumenLainnya  $dokumenLainnya
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lainnya = DokumenLainnya::find($id);
        return view('dokumen-lainnya.edit', [
            'title' => 'Ubah Dokumen Lainnya',
            'dokumen' => $lainnya,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DokumenLainnya  $dokumenLainnya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dokumenLainnya = DokumenLainnya::find($id);
        $rules = [
            'user_id' => 'required',
            'nama' => 'required',
            'berkas' => 'nullable|file|max:16384'
        ];

        $validatedData = $request->validate($rules);

        $user = User::find($request->user_id);

        $keterangan = array();

        if ($request->nama != $dokumenLainnya->nama) {
            array_push($keterangan, 'nama : ' . $request->nama);
        }

        if ($request->file('berkas')) {
            if ($request->oldBerkas) {
                Storage::delete($request->oldBerkas);
            }
            $validatedData['berkas'] = $request->file('berkas')->store('dokumen-lainnya');
            array_push($keterangan, 'berkas');
        }
        $akhir = implode(', ', $keterangan);
        $dokumen = DokumenLainnya::max('id');
        $nama = Str::of($request->nama)->slug('-');
        DB::table('riwayats')->insert([
            'surat_id' => $dokumenLainnya->id,
            'pembuat_id' => $user->id,
            'nomor' => $nama . '-' . $dokumenLainnya->id,
            'nama' => $user->name,
            'keterangan' => $user->nama . ' Mengubah Dokumen Lainnya ' . $dokumenLainnya->nama,
            'detail' => $akhir,
            'jenis' => 'Dokumen Lainnya',
            'created_at' => now()
        ]);

        DokumenLainnya::where('id', $dokumenLainnya->id)->update($validatedData);

        return redirect('/lainnya')->with('success', 'Data Dokunmen Lainnya berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DokumenLainnya  $dokumenLainnya
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $dokumenLainnya = DokumenLainnya::find($id);
        $nama = Str::of($dokumenLainnya->nama)->slug('-');
        DB::table('riwayats')->insert([
            'surat_id' => $dokumenLainnya->id,
            'pembuat_id' => $dokumenLainnya->user_id,
            'nama' => $dokumenLainnya->user->name,
            'nomor' => $nama . '-' . $dokumenLainnya->id,
            'keterangan' => $dokumenLainnya->name . ' Menghapus Dokumen Lainnya ' . $dokumenLainnya->nama,
            'jenis' => 'Dokumen Lainnya',
            'created_at' => now()
        ]);
        if ($dokumenLainnya->berkas) {
            Storage::delete($dokumenLainnya->berkas);
        }
        DokumenLainnya::destroy($dokumenLainnya->id);
        return redirect('/lainnya')->with('success', 'Data dokumen lainnya telah dihapus');
    }
}
