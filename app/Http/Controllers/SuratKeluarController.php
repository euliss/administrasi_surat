<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Task;
use App\Models\User;
use App\Models\Riwayat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.index', [
            'title' => 'Surat Keluar',
            'suratkeluar' => SuratKeluar::where('status', 'Disetujui')->orWhere('status', 'Tindaklanjuti')->orWhere('status', 'Ditolak')->get(),
            'tasks' => Task::all(),
            'riwayat' => Riwayat::where('jenis', 'Surat Keluar')->latest('id')->get(),
            'notif' => Riwayat::notif()
        ]);
    }

    public function print()
    {
        $suratKeluar = SuratKeluar::find($id);
        return view('surat-keluar.print', [
            'title' => $suratKeluar,
            'surat' => $suratKeluar,
            'tanggal' => SuratKeluar::tanggal_indonesia($suratKeluar->tanggal),
            'ketuplak' => User::find($suratKeluar->ttd1),
            'sekretaris' => User::find($suratKeluar->ttd2),
            'kahim' => User::find($suratKeluar->ttd3),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nomor = SuratKeluar::max('id');
        $nomor++;
        if ($nomor > 99) {
            $nomor = $nomor . '/';
        } elseif ($nomor > 9) {
            $nomor = '0' . $nomor . '/';
        } else {
            $nomor = '00' . $nomor . '/';
        }

        return view('surat-keluar.create', [
            'title' => 'Tambah Surat Keluar',
            'nomor' => $nomor,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'ketuplak' => User::where('jabatan', 'Pengurus')->orderBy('name', 'asc')->get(),
            'kahim' => User::where('jabatan', 'Ketua')->orderBy('name', 'asc')->get(),
            'sekretaris' => User::where('jabatan', 'Sekretaris')->orderBy('name', 'asc')->get(),
        ]);
    }

    public function tambah($id)
    {
        $pengajuan = Pengajuan::find($id);
        $nomor = SuratKeluar::max('id');
        $nomor++;
        if ($nomor > 99) {
            $nomor = $nomor . '/';
        } elseif ($nomor > 9) {
            $nomor = '0' . $nomor . '/';
        } else {
            $nomor = '00' . $nomor . '/';
        }
        return view('surat-keluar.tambah', [
            'title' => 'Tambah Surat Keluar',
            'pengajuan' => $pengajuan,
            'nomor' => $nomor,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'ketuplak' => User::where('jabatan', 'Pengurus')->orderBy('name', 'asc')->get(),
            'kahim' => User::where('jabatan', 'Ketua')->orderBy('name', 'asc')->get(),
            'sekretaris' => User::where('jabatan', 'Sekretaris')->orderBy('name', 'asc')->get(),
        ]);
    }

    public function simpan(Request $request)
    {
        $suratKeluar = SuratKeluar::max('id');
        $nomor = $suratKeluar;
        $nomor++;
        if ($nomor > 99) {
            $nomor = $nomor . '/';
        } elseif ($nomor > 9) {
            $nomor = '0' . $nomor . '/';
        } else {
            $nomor = '00' . $nomor . '/';
        }
        $validatedData = $request->validate([
            'user_id' => 'required',
            'pengajuan_id' => 'required',
            'status' => 'nullable',
            'komentar' => 'nullable',
            'nomor_surat' => 'required',
            'kategori' => 'nullable',
            'tanggal' => 'required',
            'tujuan_surat' => 'required',
            'perihal' => 'required',
            'isi' => 'nullable',
            'berkas' => 'nullable|file|max:16384',
            'ttd1' => 'nullable',
            'ttd2' => 'nullable',
            'ttd3' => 'nullable'
        ]);

        $pengajuan = Pengajuan::find($request->surat_id);

        if ($request->file('berkas')) {
            $validatedData['berkas'] = $request->file('berkas')->store('surat-keluar');
        } else {
            $validatedData['berkas'] = $pengajuan->berkas;
        }
        $validatedData['nomor_surat'] = $nomor . $request->nomor_surat;
        $validatedData['status'] = 'Tindaklanjuti';
        $validatedData['kategori'] = $request->kategori;

        $user = User::find($request->user_id);

        DB::table('riwayats')->insert([
            'surat_id' => ++$suratKeluar,
            'pembuat_id' => $user->id,
            'nama' => $user->name,
            'nomor' => $request->nomor_surat,
            'keterangan' => $user->nama . ' Menambahkan Surat Keluar ' . $request->nomor_surat,
            'status' => 'Tindaklanjuti',
            'jenis' => 'Surat Keluar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pengajuan::find($pengajuan->id)->update(['suratMasuk_id' => $validatedData['nomor_surat']]);
        SuratKeluar::create($validatedData);

        return redirect('/surat-keluar')->with('success', 'Data berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suratKeluar = SuratKeluar::max('id');
        $nomor = $suratKeluar;
        $nomor++;
        if ($nomor > 99) {
            $nomor = $nomor . '/';
        } elseif ($nomor > 9) {
            $nomor = '0' . $nomor . '/';
        } else {
            $nomor = '00' . $nomor . '/';
        }
        $validatedData = $request->validate([
            'user_id' => 'required',
            'status' => 'nullable',
            'komentar' => 'nullable',
            'nomor_surat' => 'required',
            'kategori' => 'nullable',
            'tanggal' => 'required',
            'tujuan_surat' => 'required',
            'perihal' => 'required',
            'isi' => 'nullable',
            'berkas' => 'nullable|file|max:16384',
            'ttd1' => 'nullable',
            'ttd2' => 'nullable',
            'ttd3' => 'nullable'
        ]);

        if ($request->file('berkas')) {
            $validatedData['berkas'] = $request->file('berkas')->store('surat-keluar');
        }
        $validatedData['nomor_surat'] = $nomor . $request->nomor_surat;

        $user = User::find($request->user_id);

        DB::table('riwayats')->insert([
            'surat_id' => ++$suratKeluar,
            'pembuat_id' => $user->id,
            'nama' => $user->name,
            'nomor' => $request->nomor_surat,
            'keterangan' => $user->nama . ' Menambahkan Surat Keluar ' . $request->nomor_surat,
            'status' => 'Tindaklanjuti',
            'jenis' => 'Surat Keluar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        SuratKeluar::create($validatedData);

        return redirect('/surat-keluar')->with('success', 'Data berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar)
    {
        $kahim = User::find($suratKeluar->ttd3);
        $ketuplak = User::find($suratKeluar->ttd1);
        $sekretaris = User::find($suratKeluar->ttd2);
        if ($suratKeluar->pengajuan_id) {
            $pengajuan = Pengajuan::find($suratKeluar->pengajuan_id ?? $suratKeluar->user_id);
            $orang = User::find($pengajuan->user_id);
            $pengaju = $orang->name;
        } else {
            $pengaju = '-';
        }
        return view('surat-keluar.show', [
            'title' => 'Surat Keluar',
            'suratkeluar' => $suratKeluar,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'kahim' => $kahim,
            'ketuplak' => $ketuplak,
            'sekretaris' => $sekretaris,
            'pengaju' => $pengaju
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        $ket = User::find($suratKeluar->ttd1);
        $sek = User::find($suratKeluar->ttd2);
        $kah = User::find($suratKeluar->ttd3);
        return view('surat-keluar.edit', [
            'title' => 'Ubah Surat Keluar',
            'suratkeluar' => $suratKeluar,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'ketuplak' => User::where('jabatan', 'Pengurus')->orderBy('name', 'asc')->get(),
            'kahim' => User::where('jabatan', 'Ketua')->orderBy('name', 'asc')->get(),
            'sekretaris' => User::where('jabatan', 'Sekretaris')->orderBy('name', 'asc')->get(),
            'ket' => $ket,
            'sek' => $sek,
            'kah' => $kah
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $rules = [
            'surat_id' => 'nullable',
            'user_id' => 'nullable',
            'status' => 'nullable',
            'komentar' => 'nullable',
            'nomor_surat' => 'nullable',
            'tanggal' => 'nullable',
            'tujuan_surat' => 'nullable',
            'perihal' => 'nullable',
            'ketuplak' => 'nullable',
            'sekretaris' => 'nullable',
            'kahim' => 'nullable',
            'isi' => 'nullable',
            'berkas' => 'nullable|file|max:16384'
        ];

        $validatedData = $request->validate($rules);


        $user = User::find($request->user_id);

        $keterangan = array();

        if ($request->status != $suratKeluar->status) {
            array_push($keterangan, 'Status : ' . $request->status);
        }

        if ($request->komentar != $suratKeluar->komentar) {
            array_push($keterangan, 'Komentar : ' . $request->komentar);
        }

        if ($request->nomor_surat != $suratKeluar->nomor_surat) {
            array_push($keterangan, 'Nomor surat : ' . $request->nomor_surat);
        }

        if ($request->tanggal != $suratKeluar->tanggal) {
            array_push($keterangan, 'tanggal : ' . $request->tanggal);
        }

        if ($request->tujuan_surat != $suratKeluar->tujuan_surat) {
            array_push($keterangan, 'tujuan surat : ' . $request->tujuan_surat);
        }

        if ($request->perihal != $suratKeluar->perihal) {
            array_push($keterangan, 'perihal : ' . $request->perihal);
        }

        if (auth()->user()->jabatan !== 'Pembina') {
            if ($request->ketuplak != $suratKeluar->ketuplak) {
                $ketuplak = User::find($request->ketuplak);
                array_push($keterangan, 'ketua pelaksana : ' . $ketuplak->name);
            }

            if ($request->sekretaris != $suratKeluar->sekretaris) {
                $sekretaris = User::find($request->sekretaris);
                array_push($keterangan, 'sekretaris : ' . $sekretaris->name);
            }

            if ($request->kahim != $suratKeluar->kahim) {
                $kahim = User::find($request->kahim);
                array_push($keterangan, 'ketua himpunan : ' . $kahim->name);
            }
        }


        if ($request->isi != $suratKeluar->isi) {
            array_push($keterangan, 'Isi surat');
        }

        if ($request->file('berkas')) {
            if ($request->oldBerkas) {
                Storage::delete($request->oldBerkas);
            }
            $validatedData['berkas'] = $request->file('berkas')->store('surat-keluar');
            array_push($keterangan, 'berkas');
        }

        $validatedData['user_id'] = $suratKeluar->user_id;

        $akhir = implode(', ', $keterangan);

        DB::table('riwayats')->insert([
            'surat_id' => $suratKeluar->id,
            'pembuat_id' => $suratKeluar->user_id,
            'nama' => $user->name,
            'nomor' => $request->nomor_surat,
            'keterangan' => $user->nama . ' Mengubah Surat Keluar ' . $suratKeluar->nomor_surat,
            'detail' => $akhir,
            'status' => $request->status,
            'jenis' => 'Surat Keluar',
            'created_at' => $suratKeluar->created_at,
            'updated_at' => now(),
        ]);


        SuratKeluar::where('id', $suratKeluar->id)->update($validatedData);

        return redirect('/surat-keluar')->with('success', 'Data Surat Keluar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SuratKeluar $suratKeluar)
    {
        $user = User::find($request->user_id);

        DB::table('riwayats')->insert([
            'surat_id' => $suratKeluar->id,
            'pembuat_id' => $suratKeluar->user_id,
            'nama' => $user->name,
            'nomor' => $suratKeluar->nomor_surat,
            'keterangan' => $user->nama . ' Menghapus Surat Keluar ' . $suratKeluar->nomor_surat,
            'status' => $suratKeluar->status,
            'jenis' => 'Surat Keluar',
            'created_at' => $suratKeluar->created_at,
            'updated_at' => now(),
        ]);


        if ($suratKeluar->berkas) {
            Storage::delete($suratKeluar->berkas);
        }
        SuratKeluar::destroy($suratKeluar->id);
        return redirect('/surat-keluar')->with('success', 'Data surat keluar telah dihapus');
    }
}
