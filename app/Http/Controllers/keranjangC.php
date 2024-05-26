<?php

namespace App\Http\Controllers;

use App\Models\keranjangM;
use App\Models\penjualanM;
use Illuminate\Http\Request;

class keranjangC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $keranjang = keranjangM::get();
        $title = "Delete";
        $text = "Hapus data?";
        confirmDelete($title, $text);
        return view("pages.admin.transaksi", [
            "keranjang" => $keranjang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selesai(Request $request)
    {
        try{
            $totalbayar = $request->totalbayar;
            $bayar = $request->bayar;

            $hasil = $totalbayar - $bayar;
            if($hasil <= 0) {
                $metodepembayaran = $request->metodepembayaran;
                $data = keranjangM::get();

                if(count($data) == 0) {
                    return redirect()->back()->with('warning', 'Belum ada barang belanjaan');
                }
                foreach ($data as $item) {
                    penjualanM::create([
                        "namabarang" => $item->namabarang,
                        "harga" => $item->harga,
                        "jumlah" => $item->jumlah,
                        "tanggal" => $item->tanggal,
                        "metodepembayaran" => $metodepembayaran,
                        "created_at" => $item->created_at,
                        "updated_at" => $item->updated_at,
                    ]);

                    keranjangM::where("idkeranjang", $item->idkeranjang)->delete();
                }

                return redirect()->back()->with('success', 'Pembelian telah berhasil dilakukan!');
            }else {
                return redirect()->back()->with('error', 'Maaf uang yang dibayarkan kurang!');
            }

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namabarang'=>'required',
            'harga'=>'required',
            'jumlah'=>'required',
        ]);

        try{
            $data = $request->all();
            $data["tanggal"] = date("Y-m-d");

            keranjangM::create($data);
            return redirect()->back()->with('toast_success', 'Berhasil ditambahkan');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\keranjangM  $keranjangM
     * @return \Illuminate\Http\Response
     */
    public function show(keranjangM $keranjangM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\keranjangM  $keranjangM
     * @return \Illuminate\Http\Response
     */
    public function edit(keranjangM $keranjangM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\keranjangM  $keranjangM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, keranjangM $keranjangM, $idkeranjang)
    {
        $request->validate([
            'namabarang'=>'required',
            'harga'=>'required',
            'jumlah'=>'required',
        ]);

        try{
            $data = $request->all();

            keranjangM::where("idkeranjang", $idkeranjang)->first()->update($data);
            return redirect()->back()->with('toast_success', 'Berhasil ditambahkan');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\keranjangM  $keranjangM
     * @return \Illuminate\Http\Response
     */
    public function destroy(keranjangM $keranjangM, $idkeranjang)
    {
        try{
            keranjangM::destroy($idkeranjang);
            return redirect()->back()->with('success', 'data berhasil dihapus');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
