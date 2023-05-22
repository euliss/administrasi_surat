<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Riwayat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-masuk.index', [
            'title' => 'Surat Masuk',
            'suratmasuk' => SuratMasuk::all(),
            'tasks' => Task::all(),
            'riwayat' => Riwayat::where('jenis', 'Surat Masuk')->latest()->get(),
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
        return view('surat-masuk.create', [
            'title' => 'Tambah Surat Masuk',
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
        $suratMasuk = SuratMasuk::max('id');
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nomor_surat' => 'required',
            'tanggal' => 'required',
            'asal_surat' => 'required',
            'perihal' => 'required',
            'berkas' => 'nullable|file|max:16384'
        ]);

        if ($request->file('berkas')) {
            $validatedData['berkas'] = $request->file('berkas')->store('surat-masuk');
        }

        $user = User::find($request->user_id);
        DB::table('riwayats')->insert([
            'surat_id' => ++$suratMasuk,
            'pembuat_id' => $user->id,
            'nama' => $user->name,
            'nomor' => $request->nomor_surat,
            'keterangan' => $user->nama . ' Menambahkan Surat Masuk ' . $request->nomor_surat,
            'status' => 'Disetujui',
            'jenis' => 'Surat Masuk',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SuratMasuk::create($validatedData);

        return redirect('/surat-masuk')->with('success', 'Data berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratMasuk)
    {
        // return $suratMasuk;
        return view('surat-masuk.show', [
            'title' => 'Surat Masuk',
            'suratmasuk' => $suratMasuk,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('surat-masuk.edit', [
            'title' => 'Ubah Surat Masuk',
            'suratmasuk' => $suratMasuk,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $rules = [
            'user_id' => 'required',
            'nomor_surat' => 'required',
            'tanggal' => 'required',
            'asal_surat' => 'required',
            'perihal' => 'required',
            'berkas' => 'nullable|file|max:16384'
        ];

        $validatedData = $request->validate($rules);

        $user = User::find($request->user_id);

        $keterangan = array();

        if ($request->nomor_surat != $suratMasuk->nomor_surat) {
            array_push($keterangan, 'nomor surat : ' . $request->nomor_surat);
        }

        if ($request->tanggal != $suratMasuk->tanggal) {
            array_push($keterangan, 'tanggal : ' . $request->tanggal);
        }

        if ($request->asal_surat != $suratMasuk->asal_surat) {
            array_push($keterangan, 'asal surat : ' . $request->asal_surat);
        }

        if ($request->perihal != $suratMasuk->perihal) {
            array_push($keterangan, 'perihal : ' . $request->perihal);
        }

        if ($request->file('berkas')) {
            if ($request->oldBerkas) {
                Storage::delete($request->oldBerkas);
            }
            $validatedData['berkas'] = $request->file('berkas')->store('surat-masuk');
            array_push($keterangan, 'berkas');
        }
        $akhir = implode(', ', $keterangan);

        DB::table('riwayats')->insert([
            'surat_id' => $suratMasuk->id,
            'pembuat_id' => $user->id,
            'nomor' => $suratMasuk->nomor_surat,
            'nama' => $user->name,
            'keterangan' => $user->nama . ' Mengubah Surat Masuk ' . $suratMasuk->nomor_surat,
            'detail' => $akhir,
            'jenis' => 'Surat Masuk',
            'created_at' => $suratMasuk->created_at,
            'updated_at' => now(),
        ]);

        SuratMasuk::where('id', $suratMasuk->id)->update($validatedData);

        return redirect('/surat-masuk')->with('success', 'Data Surat Masuk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SuratMasuk $suratMasuk)
    {
        $user = User::find($request->user_id);
        DB::table('riwayats')->insert([
            'surat_id' => $suratMasuk->id,
            'pembuat_id' => $user->id,
            'nomor' => $user->name,
            'nama' => $user->name,
            'keterangan' => $user->nama . ' Menghapus Surat Masuk ' . $suratMasuk->nomor_surat,
            'jenis' => 'Surat Masuk',
            'created_at' => $suratMasuk->created_at,
            'updated_at' => now()
        ]);
        if ($suratMasuk->berkas) {
            Storage::delete($suratMasuk->berkas);
        }
        SuratMasuk::destroy($suratMasuk->id);
        return redirect('/surat-masuk')->with('success', 'Data surat masuk telah dihapus');
    }
}
