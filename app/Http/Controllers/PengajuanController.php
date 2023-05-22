<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Riwayat;
use App\Models\Pengajuan;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->jabatan === 'Sekretaris' || auth()->user()->jabatan == 'Pembina') {
            return view('pengajuan.index', [
                'title' => 'Pengajuan',
                'pengajuan' => Pengajuan::all(),
                'tasks' => Task::all(),
                'riwayat' => Riwayat::where('pembuat_id', auth()->user()->id)->latest()->get(),
                'notif' => Riwayat::notif()
            ]);
        } else {
            return view('pengajuan.index', [
                'title' => 'Pengajuan',
                'pengajuan' => Pengajuan::where('user_id', auth()->user()->id)->get(),
                'tasks' => Task::all(),
                'riwayat' => Riwayat::where('pembuat_id', auth()->user()->id)->latest()->get(),
                'notif' => Riwayat::notif()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nomor = Pengajuan::max('id');
        $nomor++;
        if ($nomor > 99) {
            $nomor = $nomor . '/';
        } elseif ($nomor > 9) {
            $nomor = '0' . $nomor . '/';
        } else {
            $nomor = '00' . $nomor . '/';
        }
        return view('pengajuan.create', [
            'title' => 'Tambah Pengajuan',
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'nomor' => $nomor,
            'tanggal' => now()->format('Y-m-d')
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
        $pengajuan = Pengajuan::max('id');
        $validatedData = $request->validate([
            'user_id' => 'required',
            'kategori' => 'required',
            'status' => 'nullable',
            'komentar' => 'nullable',
            'tanggal' => 'required',
            'tujuan_surat' => 'required',
            'perihal' => 'required',
            'berkas' => 'nullable|file|max:16384',
        ]);

        if ($request->file('berkas')) {
            $validatedData['berkas'] = $request->file('berkas')->store('pengajuan');
        }

        $user = User::find($request->user_id);

        DB::table('riwayats')->insert([
            'surat_id' => ++$pengajuan,
            'pembuat_id' => $user->id,
            'nama' => $user->name,
            'nomor' => $request->kategori,
            'keterangan' => $user->nama . ' Menambahkan Pengajuan Surat Keluar ' . $request->nomor_surat,
            'jenis' => 'Pengajuan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pengajuan::create($validatedData);

        return redirect('/pengajuan')->with('success', 'Data Pengajuan berhasil Dikirimkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan)
    {
        return view('pengajuan.show', [
            'title' => 'Lihat Pengajuan',
            'pengajuan' => $pengajuan,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        return view('pengajuan.edit', [
            'title' => 'Ubah Pengajuan',
            'pengajuan' => $pengajuan,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        $rules = [
            'surat_id' => 'nullable',
            'user_id' => 'nullable',
            'status' => 'nullable',
            'komentar' => 'nullable',
            'kategori' => 'nullable',
            'tanggal' => 'nullable',
            'tujuan_surat' => 'nullable',
            'perihal' => 'nullable',
            'berkas' => 'nullable|file|max:16384'
        ];

        $validatedData = $request->validate($rules);

        $user = User::find($request->user_id);

        $keterangan = array();

        if (($request->status ?? $pengajuan->status) != $pengajuan->status) {
            array_push($keterangan, 'Status : ' . $request->status);
        }

        if (($request->komentar ?? $pengajuan->komentar)  != $pengajuan->komentar) {
            array_push($keterangan, 'Komentar : ' . $request->komentar);
        }

        if ($request->kategori != $pengajuan->kategori) {
            array_push($keterangan, 'Kategori : ' . $request->kategori);
        }

        if ($request->tanggal != $pengajuan->tanggal) {
            array_push($keterangan, 'tanggal : ' . $request->tanggal);
        }

        if ($request->tujuan_surat != $pengajuan->tujuan_surat) {
            array_push($keterangan, 'tujuan surat : ' . $request->tujuan_surat);
        }

        if ($request->perihal != $pengajuan->perihal) {
            array_push($keterangan, 'perihal : ' . $request->perihal);
        }

        if ($request->file('berkas')) {
            if ($request->oldBerkas) {
                Storage::delete($request->oldBerkas);
            }
            $validatedData['berkas'] = $request->file('berkas')->store('surat-keluar');
            array_push($keterangan, 'berkas');
        }

        $validatedData['user_id'] = $pengajuan->user_id;

        $akhir = implode(', ', $keterangan);

        DB::table('riwayats')->where('surat_id', $pengajuan->id)->update(['status' => 'Tindaklanjuti']);

        DB::table('riwayats')->insert([
            'surat_id' => $pengajuan->id,
            'pembuat_id' => $pengajuan->user_id,
            'nama' => $user->name,
            'nomor' => $request->kategori,
            'keterangan' => $user->nama . ' Mengubah Pengajuan ' . $pengajuan->nomor_surat,
            'detail' => $akhir,
            'status' => $request->status ?? $pengajuan->status,
            'jenis' => 'Surat Keluar',
            'created_at' => $pengajuan->created_at,
            'updated_at' => now(),
        ]);

        pengajuan::where('id', $pengajuan->id)->update($validatedData);

        if ($request->status === 'Tindaklanjuti' && auth()->user()->jabatan === 'Sekretaris') {
            return redirect('/surat-keluar/tambah/' . $pengajuan->id)->with('success', 'Data Surat Keluar berhasil diubah');
        }
        return redirect('/pengajuan')->with('success', 'Data Pengajuan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pengajuan $pengajuan)
    {
        $user = User::find($request->user_id);
        DB::table('riwayats')->insert([
            'surat_id' => $pengajuan->id,
            'pembuat_id' => $pengajuan->user_id,
            'nama' => $user->name,
            'nomor' => $pengajuan->nomor_surat,
            'keterangan' => $user->nama . ' Menghapus Pengajuan ' . $pengajuan->nomor_surat,
            'status' => 'Dihapus',
            'jenis' => 'Pengajuan',
            'created_at' => $pengajuan->created_at,
            'updated_at' => now(),
        ]);

        if ($pengajuan->berkas) {
            Storage::delete($pengajuan->berkas);
        }
        Pengajuan::destroy($pengajuan->id);
        return redirect('/pengajuan')->with('success', 'Data surat keluar telah dihapus');
    }
}
