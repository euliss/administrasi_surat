<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agenda.index', [
            'title' => 'Agenda',
            'agenda' => Agenda::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Agenda.create', [
            'title' => 'Tambah Agenda'
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
            'tanggal' => 'required',
            'nama' => 'required',
            'target' => 'required',
        ]);

        Agenda::create($validatedData);

        return redirect('/agenda')->with('success', 'Data berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return view('agenda.show', [
            'title' => 'Agenda',
            'agenda' => $agenda
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', [
            'title' => 'Ubah Agenda',
            'agenda' => $agenda
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $rules = [
            'user_id' => 'required',
            'tanggal' => 'required',
            'nama' => 'required',
            'target' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Agenda::where('id', $agenda->id)->update($validatedData);

        return redirect('/agenda')->with('success', 'Data Agenda berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        Agenda::destroy($agenda->id);
        return redirect('/agenda')->with('success', 'Data Akun telah dihapus');
    }
}
