<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('agenda.index', [
            'title' => 'Tambah Agenda',
            'tasks' => $tasks,
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
        return view('agenda.create', [
            'title' => 'Tambah Agenda',
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
        Task::create($request->all());
        return redirect('/agenda')->with('success','Data Agenda berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Task::find($id);
        return view('agenda.show', [
            'title' => 'Agenda ' . $agenda->name,
            'agenda' => $agenda,
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = Task::all();
        $tk = Task::find($id);
        return view('agenda.edit', [
            'title' => 'Ubah Agenda',
            'tasks' => $tasks,
            'tk' => $tk,
            'notif' => Riwayat::notif()
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
        Task::find($id)->update($request->all());
        return redirect('/agenda')->with('success','Data Agenda berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect('/agenda')->with('success','Data Agenda berhasil Dihapus');
    }
}
