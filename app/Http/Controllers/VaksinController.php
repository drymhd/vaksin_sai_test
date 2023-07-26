<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Vaksin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per = (($request->per) ? $request->per : 10);
        $page = (($request->page) ? $request->page-1 : 0);
        DB::statement('set @angka=0+'.$per*$page);
        $data = Vaksin::where(function($q) use ($request) {
            $q->where('nm_vaksin', 'LIKE', '%'.$request->search.'%');
        })->orderBy('id','asc')->paginate($per, ['*', DB::raw('@angka  := @angka  + 1 AS angka')]);

        return view('vaksin.index', compact('data'));
    }

    public function laporan()
    {
        if(Auth::check())
        {
            $provinsis = Provinsi::get();

            return view('laporan.index', compact('provinsis'));
        }

        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vaksin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_vaksin' => 'required|string|max:250',
        ]);

        $data = Vaksin::create([
            'nm_vaksin' => $request->nm_vaksin,
        ]);

        if($data){
            return redirect('vaksin');
        }

        return redirect('vaksin.create')->withErrors('Sesuatu Error Terjadi');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Vaksin::get();

        return $data;
    }
    public function get()
    {
        $data = Vaksin::get();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Vaksin::findByUuid($id);

        return view('vaksin.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nm_vaksin' => 'required|string|max:250',
        ]);

        $data = Vaksin::findByUuid($id);


        if($data->update([
            'nm_vaksin' => $request->nm_vaksin,
        ])){
            return redirect('vaksin');
        }

        return redirect()->route('vaksin.edit', $data)->withErrors('Sesuatu Error Terjadi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Vaksin::findByUuid($id);

        if(!isset($data->id)){
            return redirect()->route('vaksin.index')->withErrors('Data Tidak Ada / Sudah Dihapus');
        }

        if($data->delete()){
            return redirect('vaksin')->withSuccess('Sukses Menghapus Data');
        }

        return redirect('vaksin.index')->withErrors('Sesuatu Error Terjadi');
    }
}
