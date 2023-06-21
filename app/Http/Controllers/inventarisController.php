<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\inventaris;
use Illuminate\Support\Facades\DB;
class inventarisController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:inventaris-list|inventaris-create|inventaris-edit|inventaris-delete', ['only' => ['index','show']]);
         $this->middleware('permission:inventaris-create', ['only' => ['create','store']]);
         $this->middleware('permission:inventaris-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:inventaris-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Event::all();
        $inventaris = inventaris::orderBy('jenis_barang')->get();
        // $data = inventaris::orderBy('jenis_barang')->get();
        $data = inventaris::orderBy('jenis_barang')->orderBy('nama_barang')->get(); // mengambil data barang dari database, diurutkan berdasarkan jenis dan nama

        $groupedData = $data->groupBy('jenis_barang');
        // dd($data);
        // dd($inventaris);
        // $inventaris = inventaris::all();
       
        // $data = inventaris::where('jenis_barang', $inventaris->jenis_barang)->count(); 
        // dd($result);
        return view('inventaris.index',compact('inventaris','jadwals','groupedData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            // 'jumlah' => 'required',
        ]);
        // $data['tags'] = implode(",", $request->tags);
        // $data['jenis_barang'] = json_encode($request->Nama_barang);
        $post = inventaris::create($data);
        // dd($post);
        return redirect()->back()->with('success','pemakaian created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        request()->validate([
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
        ]);
        $update['nama_barang'] = $request->get('nama_barang');
        $update['jenis_barang'] = $request->get('jenis_barang');
       
     
        inventaris::where('id',$id)->update($update);

        return redirect()->route('inventaris.index')
                        ->with('success','inventaris updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("inventaris")->where('id',$id)->delete();

        return redirect()->route('inventaris.index')
                        ->with('success','inventaris deleted successfully');
    }
}
