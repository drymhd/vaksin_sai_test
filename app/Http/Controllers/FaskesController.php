<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per = (($request->per) ? $request->per : 10);
        $page = (($request->page) ? $request->page-1 : 0);
        DB::statement('set @angka=0+'.$per*$page);
        $data = Faskes::where(function($q) use ($request) {
            $q->where('nm_faskes', 'LIKE', '%'.$request->search.'%');
        })->join('kotas', 'faskes.kota_id', '=', 'kotas.id')->orderBy('faskes.id','asc')->paginate($per, ['faskes.*', 'kotas.nm_kota', DB::raw('@angka  := @angka  + 1 AS angka')]);

        $data->map(function($a){
            $a->aksi = '<a class="btn btn-success btn-sm" href="'.route('faskes.kuota.index', $a->uuid).'">Lihat Kuota</a>';
            return $a;
        });
        return view('faskes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsicontroller = new ProvinsiController();
        $provinsis = $provinsicontroller->get();
        return view('faskes.create', compact('provinsis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'nm_faskes' => 'required|string|max:250',
            'alamat' => 'required|string|max:250',
            'telepon' => 'required',
            'tipe' => 'required|string|max:250',
            'kota_id' => 'required',
        ]);


        $data = Faskes::create($request->all());

        if($data){
            return redirect('faskes');
        }

        return redirect('faskes.create')->withErrors('error', 'Sesuatu Error Terjadi');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }


    public function kuota(string $id)
    {
        $data = Faskes::findByUuid($id, ['kuota','kuota.vaksin', 'kota']);

        return view('faskes.kuota.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Faskes::findByUuid($id);
        $provinsicontroller = new ProvinsiController();
        $provinsis = $provinsicontroller->get();

        return view('faskes.edit', compact('data', 'provinsis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nm_faskes' => 'required|string|max:250',
            'alamat' => 'required|string|max:250',
            'telepon' => 'required',
            'tipe' => 'required|string|max:250',
            'kota_id' => 'required',
        ]);

        $data = Faskes::findByUuid($id, 'kota');


        if($data->update($request->all())){
            return redirect('faskes');
        }

        return redirect()->route('faskes.edit', $data)->withErrors('Sesuatu Error Terjadi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Faskes::findByUuid($id);

        if(!isset($data->id)){
            return redirect()->route('faskes.index')->withErrors('Data Tidak Ada / Sudah Dihapus');
        }

        if($data->delete()){
            return redirect('faskes')->withSuccess('Sukses Menghapus Data');
        }

        return redirect()->route('faskes.index')->withErrors('Sesuatu Error Terjadi');

    }
}
