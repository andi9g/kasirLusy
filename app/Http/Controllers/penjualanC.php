<?php

namespace App\Http\Controllers;

use App\Models\penjualanM;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class penjualanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("pages.admin.laporan");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cetak(Request $request)
    {
        $request->validate([
            'tanggalawal'=>'required|date',
            'tanggalakhir'=>'required|date',
        ]);

        // try{

            $tanggalawal = date("Y-m-d H:i:s", strtotime($request->tanggalawal." 03:00:00"));
            $tanggalakhir = date("Y-m-d H:i:s", strtotime($request->tanggalakhir." 23:00:00"));

            if(date("Y-m-d", strtotime($tanggalawal)) == date("Y-m-d", strtotime($tanggalakhir))) {
                $tanggal = \Carbon\Carbon::parse($tanggalawal)->isoFormat("DD MMMM Y");
            }else {
                $tanggal = \Carbon\Carbon::parse($tanggalawal)->isoFormat("DD/MMMM/Y") . " s.d ". \Carbon\Carbon::parse($tanggalakhir)->isoFormat("DD/MMMM/Y");
            }

            $penjualan = penjualanM::orderBy("tanggal", "desc")
            ->whereBetween("created_at", [$tanggalawal, $tanggalakhir])
            ->get();

            $pdf = Pdf::loadView("pages.laporan.penjualan", [
                "penjualan" => $penjualan,
                "tanggal" => $tanggal,
            ]);

            return $pdf->stream("laporan.pdf");


        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
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
