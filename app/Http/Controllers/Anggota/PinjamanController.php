<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $opsi_jurusan = [
        //     ['kode' => 'S1-PTIK', 'nama' => 'S1 - Pendidikan Teknik Informatika dan Komputer',],
        //     ['kode' => 'S1-PTE', 'nama' => 'S1 - Pendidikan Teknik Elektronika',],
        //     ['kode' => 'D3-PTE', 'nama' => 'D3 - Teknik Elekronika',],
        // ];

        // $pinjaman = Pinjaman::all();


        // $pinjaman = Pinjaman::latest()->get();

        $pinjaman = DB::table('pinjamans')
            // ->join('seksis', 'seksis.id', '=', 'participants.id_seksi')
            // ->join('users', 'users.id', '=', 'participants.user_id')
            ->latest()
            ->get();

        // $hitung_jurusan = Jurusan::all()->where('status', '1')->count();
        // $jurusan = Jurusan::all()->where('status', '1');

        return view('anggota.pinjaman.index', compact('pinjaman'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }
}
