<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class jadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:jadwal-list|jadwal-create|jadwal-edit|jadwal-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:jadwal-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:jadwal-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:jadwal-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jadwals = Event::all();
        return view('jadwals.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jadwals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['title'] = $request->get('title');
        $data['start_date'] = $request->get('start_date');
        // $data['end_date'] = $request->get('end_date');
        $data['description'] = $request->get('description');
        $data['jam_acara'] = $request->get('jam_acara');
        Event::create($data);

        return redirect()->route('jadwals.index')
                        ->with('success','jadwal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(jadwal $jadwal)
    {
        return view('jadwal.show',compact('jadwals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $jadwal)
    {
        return view('jadwals.edit',compact('jadwal'));
    }
    public function update(Request $request,$id)
    {

        request()->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ]);
        $update['title'] = $request->get('title');
        $update['start_date'] = $request->get('start_date');
        $update['end_date'] = $request->get('end_date');
        $update['description'] = $request->get('description');
        $update['jam_acara'] = $request->get('jam_acara');
     
        Event::where('id',$id)->update($update);

        return redirect()->route('jadwals.index')
                        ->with('success','inventaris updated successfully');
    }
    public function destroy($id)
    {
        DB::table("events")->where('id',$id)->delete();
        return redirect()->route('jadwals.index')
                        ->with('success','jadwal deleted successfully');
    }
}
