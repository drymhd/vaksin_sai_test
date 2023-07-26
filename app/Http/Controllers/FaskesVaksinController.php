<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use App\Models\FaskesVaksin;
use App\Models\User;
use App\Models\Vaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaskesVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per = (($request->per) ? $request->per : 10);
        $page = (($request->page) ? $request->page-1 : 0);
        DB::statement('set @angka=0+'.$per*$page);
        $data = FaskesVaksin::where(function($q) use ($request) {
            // $q->where('nm_provinsi', 'LIKE', '%'.$request->search.'%');
        })->orderBy('id','asc')->paginate($per, ['*', DB::raw('@angka  := @angka  + 1 AS angka')]);

        return view('faskes.kuota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $faskes = Faskes::findByUuid($id);
        $vaksin = Vaksin::get();

        return view('faskes.kuota.create', compact('vaksin', 'faskes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kuota' => 'required|numeric',
        ]);

        $check = FaskesVaksin::where('faskes_id', $request->faskes_id)->where('vaksin_id', $request->vaksin_id)->first();
        if(isset($check->id)){
            $faskes = Faskes::find($check->id);
            return redirect()->route('faskes.kuota.index', $faskes->uuid)->withErrors('Jenis Vaksin Sudah Ada Dikuota');
        }

        $data = FaskesVaksin::create($request->all());
        $faskes = Faskes::find($data->faskes_id);

        if($data){
            return redirect()->route('faskes.kuota.index', $faskes->uuid)->withSuccess('Sukses Menambah data');
        }

        return redirect()->route('faskes.kuota.create', $faskes->uuid)->withErrors('Sesuatu Error Terjadi');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = FaskesVaksin::get();

        return $data;
    }
    public function get()
    {
        $data = FaskesVaksin::get();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vaksin = Vaksin::get();
        $data = FaskesVaksin::findByUuid($id);

        return view('faskes.kuota.edit', compact('vaksin', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kuota' => 'required|numeric',
        ]);

        $data = FaskesVaksin::findByUuid($id);


        if($data->update($request->all())){
            $faskes = Faskes::find($data->faskes_id);
            return redirect()->route('faskes.kuota.index', $faskes->uuid)->withSuccess('Sukses Mengubah data');
        }

        return redirect()->route('faskes.kuota.edit', $data)->withErrors('error', 'Sesuatu Error Terjadi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = FaskesVaksin::findByUuid($id);

        $faskes = Faskes::find($data->faskes_id);
        if(!isset($data->id)){
            return redirect()->route('vaskes.kuota.index', $faskes->uuod)->withErrors('Data Tidak Ada / Sudah Dihapus');
        }

        if($data->delete()){
            return redirect()->route('provinsi')->withSuccess('Sukses Menghapus data');
        }


        return view('faskes.kuota.index', $faskes->uuid)->with('error', 'Sesuatu Error Terjadi');
    }
}
