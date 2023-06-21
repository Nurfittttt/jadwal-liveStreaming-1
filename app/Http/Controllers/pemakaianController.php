<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\inventaris;
use App\Models\pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class pemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:pemakaian-list|pemakaian-create|pemakaian-edit|pemakaian-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pemakaian-create', ['only' => ['create','store']]);
         $this->middleware('permission:pemakaian-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pemakaian-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Event::all();
        $pemakaian = pemakaian::all();
       
        $barang = inventaris::all();
        return view('pemakaians.index',compact('pemakaian','barang','jadwals'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemakaians.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'Nama_Pemakaian' => 'required',
            'Nama_barang' => 'required',
            'tanggal_pakai' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan' => 'required'
            // 'pj_pemakaian' => 'required'
        ]);
        // dd($data);
        // $data['tags'] = implode(",", $request->tags);
        $data['Nama_barang'] = json_encode($request->Nama_barang);
        $data['pj_pemakaian'] = Auth::user()->name;

        $post = pemakaian::create($data);
        return redirect()->route('pemakaians.index')
                        ->with('success','pemakaian created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function show(pemakaian $pemakaian)
    {
        return view('pemakaian.show',compact('pemakaian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function edit(pemakaian $pemakaian)
    {
        return view('pemakaians.edit',compact('pemakaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemakaian $pemakaian)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $pemakaian->update($request->all());

        return redirect()->route('pemakaians.index')
                        ->with('success','pemakaian updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemakaian $pemakaian)
    {
        $pemakaian->delete();

        return redirect()->route('pemakaians.index')
                        ->with('success','pemakaian deleted successfully');
    }
}
