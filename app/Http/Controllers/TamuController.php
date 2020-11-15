<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tamu;
use App\Exports\TamuExport;
use App\Imports\TamuImport;
use Maatwebsite\Excel\Facades\Excel;

class TamuController extends Controller
{
    public function index() {
        $tamu = Tamu::get();
        $hadir = Tamu::where('status', 'Hadir')->get();
        $tidak_hadir = Tamu::where('status', 'Tidak Hadir')->get();
        $belum_konfirmasi = Tamu::where('status', 'Belum Konfirmasi')->get();
        return view('index', compact('tamu', 'hadir', 'tidak_hadir', 'belum_konfirmasi'));
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        Tamu::create([
            'nama' => $request->get('nama'),
            'instansi' => $request->get('instansi'),
            'status' => $request->get('status'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil!',
        ]);
    }

    public function edit($id) {
        $tamu = Tamu::find($id);
        return view('edit', compact('tamu'));
    }

    public function update(Request $request, $id) {
        $tamu = Tamu::find($id)->update([
            'nama' => $request->get('nama'),
            'instansi' => $request->get('instansi'),
            'status' => $request->get('status'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil!',
        ]);
    }

    public function delete($id) {
        $tamu = Tamu::find($id);
        $tamu->delete();
        return redirect('/');
    }

    public function export() {
        $nama_file = 'Tamu-'.date('Y-m-d').'.xlsx';
    	return Excel::download(new TamuExport, $nama_file);
    }

    public function import(Request $request) {
        $file = $request->file('import');
        $nama_file = uniqid().".".$file->getClientOriginalExtension();
        $file->move('import', $nama_file);
        Excel::import(new TamuImport, public_path('import/'.$nama_file));

        return redirect('/');
    }
}