@extends('layouts.admin')

@section('activetransaksi', "active")

@section('judul', "TRANSAKSI")


@section('content')
@php
    $subtotal = 0;
@endphp
@foreach ($keranjang as $item)
    @php
        $subtotal = $subtotal + ($item->jumlah * $item->harga);
    @endphp
@endforeach

<div class="container-fluid">

    <div class="row">
        <div class="col-md-5">
            <div class="card card-outline card-secondary">
                <div class="card-body">
                    <form action="{{ route('transaksi.store', []) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-4 col-form-label">Tgl. Transaksi</label>
                            <div class="col-sm-8">
                              <input class="form-control" type="text" disabled  value="{{ \Carbon\Carbon::parse(date('Y-m-d'))->isoFormat("DD MMMM Y") }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namabarang" class="col-sm-4 col-form-label">Nama Barang</label>
                            <div class="col-sm-8">
                              <input class="form-control text-capitalize" id="namabarang" type="text" name="namabarang"  value="" placeholder="Masukan nama barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                              <input class="form-control" id="harga" type="number" name="harga"  value="" placeholder="Masukan harga">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-4 col-form-label">Quantity</label>
                            <div class="col-sm-8">
                              <input class="form-control" id="jumlah" type="number" name="jumlah"  value="1" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subtotal" class="col-sm-4 col-form-label">Sub Total</label>
                            <div class="col-sm-8">
                              <input class="form-control" id="subtotal" type="text" readonly>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7"></div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success btn-block text-bold">
                                        <i class="fa fa-plus text-bold"></i>
                                        TAMBAH</button>
                                </div>
                            </div>
                        </div>

                    </form>




                    <hr>

                    <form action="{{ route('transaksi.selesai', []) }}" method="post">
                        @csrf
                        <input class="form-control" id="totalbayar" type="text" hidden name="totalbayar" value="{{ $subtotal }}">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Total Bayar</label>
                            <div class="col-sm-8">
                              <input class="form-control text-bold text-lg" id="" type="text" readonly value="Rp{{ number_format($subtotal, 0, ",", ".") }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bayar" class="col-sm-4 col-form-label">Jumlah Bayar</label>
                            <div class="col-sm-8">
                              <input class="form-control" id="bayar" type="number" name="bayar">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kembalian" class="col-sm-4 col-form-label">Kembalian</label>
                            <div class="col-sm-8">
                              <input class="form-control text-bold text-lg" id="kembalian" type="text" readonly name="kembalian">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="metodepembayaran" class="col-sm-4 col-form-label">Metode Pembayaran</label>
                            <div class="col-sm-8">
                              <select name="metodepembayaran" id="" onchange="pembayaran(this)" class="form-control">
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Qris">Qris</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group text-center" style="display:none" id="barcode">
                            <img src="{{ url('gambar', ['barcode.jpeg']) }}" width="130px" alt="">
                        </div>
                        <div class="form-group text-center" style="display:none" id="bca">
                            <img src="{{ url('gambar', ['BCA.jpeg']) }}" height="90px" alt="">
                        </div>

                        <script>
                            function pembayaran(params) {
                                var value = params.value;
                                var barcode = document.getElementById("barcode");
                                var bca = document.getElementById("bca");
                                barcode.style="display:none";
                                bca.style="display:none"
                                if(value=="Transfer") {
                                    barcode.style="display:none";
                                    bca.style="display:block"
                                }else if(value=="Qris") {
                                    barcode.style="display:block";
                                    bca.style="display:none"
                                }
                            }
                        </script>



                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7"></div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-danger btn-block">
                                        <i class="fa fa-cart-shopping"></i>
                                        BAYAR</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>


            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-outline card-secondary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center mb-3">
                            <h3 class="mb-0 pb-0">VANSESCO BOUTIQUE</h3>
                            <p>Jl. Teladan No.02 Tanjungpinang Barat</p>
                        </div>


                        <div class="col-6">
                            <p>
                                KASIR : {{ strtoupper(Auth::user()->name) }}
                            </p>
                        </div>
                        <div class="col-6 text-right" style="">
                            <table  class="float-right">
                                <tr>
                                    <td>TGL</td>
                                    <td>&emsp;: </td>
                                    <td>{{ \Carbon\Carbon::parse(date('Y-m-d'))->isoFormat("DD MMMM Y") }}</td>
                                </tr>
                                <tr>
                                    <td>JAM</td>
                                    <td>: </td>
                                    <td><span id="clock">??:??</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>



                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Action</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($keranjang as $item)
                                    <tr>
                                        <td>{{ ucwords($item->namabarang) }}</td>
                                        <td nowrap>
                                           <form action='{{ route('transaksi.destroy', [$item->idkeranjang]) }}' method='post' class='d-inline'>
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class='badge badge-danger badge-btn border-0' onclick="return confirm('Hapus data?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                           </form>

                                           <button class="badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#ubahdata{{ $item->idkeranjang }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                        </td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>Rp{{ number_format($item->harga, 0, ",", ".") }}</td>
                                        <td>
                                            <b>
                                                @php
                                                    $sub = $item->jumlah * $item->harga;
                                                @endphp
                                                Rp{{ number_format($sub, 0, ",", ".") }}
                                            </b>
                                        </td>
                                    </tr>

                                    <div id="ubahdata{{ $item->idkeranjang }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="my-modal-title">Ubah Data Barang</h5>
                                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('transaksi.update', [$item->idkeranjang]) }}" method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="card-body">

                                                        <div class="form-group row">
                                                            <label for="tanggal" class="col-sm-4 col-form-label">Tgl. Transaksi</label>
                                                            <div class="col-sm-8">
                                                              <input class="form-control" type="text" disabled  value="{{ \Carbon\Carbon::parse(date('Y-m-d'))->isoFormat("DD MMMM Y") }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="namabarang" class="col-sm-4 col-form-label">Nama Barang</label>
                                                            <div class="col-sm-8">
                                                              <input class="form-control text-capitalize" id="namabarang" type="text" name="namabarang"  value="{{ $item->namabarang }}" placeholder="Masukan nama barang">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="harga" class="col-sm-4 col-form-label">Harga</label>
                                                            <div class="col-sm-8">
                                                              <input class="form-control" id="harga" type="number" name="harga"  value="{{ $item->harga }}" placeholder="Masukan harga">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jumlah" class="col-sm-4 col-form-label">Quantity</label>
                                                            <div class="col-sm-8">
                                                              <input class="form-control" id="jumlah" type="number" name="jumlah"  value="{{ $item->jumlah }}" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer text-right">
                                                        <button type="submit" class="btn btn-success btn-block text-bold">
                                                        UPDATE</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <table width="100%" class="text-lg">
                        <tr>
                            <th><h2>Total Bayar</h2></th>
                            <th class="text-right"><h2>Rp{{ number_format($subtotal, 0, ",", ".") }}</h2></th>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('myScript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hargaInput = document.getElementById('harga');
        const jumlahInput = document.getElementById('jumlah');
        const subtotalInput = document.getElementById('subtotal');
        const totalbayarInput = document.getElementById('totalbayar');
        const bayarInput = document.getElementById('bayar');
        const kembalianInput = document.getElementById('kembalian');

        function formatRupiah(angka) {
            let rupiah = '';
            let angkarev = angka.toString().split('').reverse().join('');
            for (let i = 0; i < angkarev.length; i++) {
                if (i % 3 === 0 && i !== 0) rupiah += '.' + angkarev[i];
                else rupiah += angkarev[i];
            }
            return 'Rp ' + rupiah.split('').reverse().join('');
        }

        function calculateSubtotal() {
            let harga = parseFloat(hargaInput.value);
            let jumlah = parseFloat(jumlahInput.value);

            if (isNaN(harga) || isNaN(jumlah)) {
                alert('Masukkan nilai numerik yang valid untuk harga dan jumlah.');
                return;
            }

            let subtotal = Math.trunc(harga * jumlah); // Mengubah nilai desimal ke integer
            subtotalInput.value = formatRupiah(subtotal);
        }

        function calculateKembalian() {
            let bayar = parseFloat(bayarInput.value);
            let totalbayar = parseFloat(totalbayarInput.value);

            if (isNaN(bayar) || isNaN(totalbayar)) {
                kembalianInput.value = "0";
                return;
            }

            let kembalian = Math.trunc(totalbayar - bayar); // Mengubah nilai desimal ke integer
            if(kembalian < 0) {
                kembalian = kembalian * -1;
                kembalianInput.value = formatRupiah(kembalian);
                kembalianInput.style="color:green";
            }else if(kembalian > 0) {
                kembalianInput.value = "-"+formatRupiah(kembalian);
                kembalianInput.style="color:red";
            }else {
                kembalianInput.value = "Lunas";
                kembalianInput.style="color:green";
            }

        }

        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds}`;
        }

        updateClock(); // initial call
        setInterval(updateClock, 1000); // update every second

        hargaInput.addEventListener('keyup', calculateSubtotal);
        jumlahInput.addEventListener('keyup', calculateSubtotal);
        bayarInput.addEventListener('keyup', calculateKembalian);
    });
    </script>
@endsection
