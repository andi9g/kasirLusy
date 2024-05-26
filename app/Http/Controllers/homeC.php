<?php

namespace App\Http\Controllers;

use App\Models\penjualanM;
use App\Models\keranjangM;
use Illuminate\Http\Request;

class homeC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggal = date("Y-m-d");
        $penjualan = penjualanM::where("tanggal", $tanggal)->count();
        $pendapatan = penjualanM::where("tanggal", $tanggal)->selectRaw("jumlah * harga as subtotal")->get();

        $bulan = [];
        $data = [];
        for ($i=1; $i <= 12; $i++) {
            $awal = date("Y")."-".sprintf("%02s", $i)."-01";
            $bulan[] = \Carbon\Carbon::parse($awal)->isoFormat("MMMM");

            $tanggal = date("Y-m", strtotime($awal));
            $datapenjualan = penjualanM::where("tanggal", "like", "$tanggal%")
            ->count();
            $data[] = $datapenjualan;
        }

        return view("pages.admin.home", [
            "penjualan" => $penjualan,
            "pendapatan" => $pendapatan,
            "bulan" => $bulan,
            "data" => $data,
        ]);
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
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function show(penjualanM $penjualanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function edit(penjualanM $penjualanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penjualanM $penjualanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(penjualanM $penjualanM)
    {
        //
    }
}
