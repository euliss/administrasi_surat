<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absensi.index', [
            'title' => 'Absensi',
            'absensi' => Absensi::paginate(10),
            'tasks' => Task::all(),
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
        $absensi = User::where('jabatan', '<>', 'Pembina')->orderBy('name', 'asc')->get();
        return view('absensi.create', [
            'title' => 'Tambah Absensi',
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'absensi' => $absensi
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
            'tanggal' => 'required',
        ]);

        $absensi = Absensi::max('id');
        $absensi++;
        for ($ab = 1; $ab <= $request->jumlah; $ab++) {
            DB::table('absensi_details')->insert([
                'absensi_id' => $absensi,
                'user_id' => $request['anggota' . $ab],
                'kehadiran' => $request['kehadiran' . $ab],
                'keterangan' => $request['keterangan' . $ab],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $akhir = AbsensiDetail::max('absensi_id');

        $validatedData['hadir'] = AbsensiDetail::where([
            ['absensi_id', '=', $akhir],
            ['kehadiran', '=', 'hadir']
        ])->count();
        $validatedData['tidak_hadir'] = AbsensiDetail::where([
            ['absensi_id', '=', $akhir],
            ['kehadiran', '=', 'tidak hadir']
        ])->count();

        Absensi::create($validatedData);

        return redirect('/absensi')->with('success', 'Data berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        $detail = AbsensiDetail::where('absensi_id', $absensi->id)->get();
        return view('absensi.show', [
            'title' => 'Absensi',
            'absensi' => $absensi,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'detail' => $detail
        ]);
    }

    public function print($id)
    {
        $absensi = absensi::find($id);
        $detail = AbsensiDetail::where('absensi_id', $absensi->id)->get();
        return view('absensi.print', [
            'title' => 'Absensi',
            'absensi' => $absensi,
            'detail' => $detail,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        return view('absensi.edit', [
            'title' => 'Ubah Absensi',
            'absensi' => $absensi,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif(),
            'absensi' => $absensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $rules = [
            'user_id' => 'required',
            'nama' => 'required',
            'tanggal' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Absensi::where('id', $absensi->id)->update($validatedData);

        return redirect('/absensi')->with('success', 'Data Absensi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        DB::table('absensi_details')->where('absensi_id', $absensi->id)->delete();
        Absensi::destroy($absensi->id);
        return redirect('/absensi')->with('success', 'Data Absensi telah dihapus');
    }
}
