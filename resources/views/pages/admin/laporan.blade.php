@extends('layouts.admin')

@section('activelaporan', "active")

@section('judul', "LAPORAN")


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><b><h3>FORM CETAK LAPORAN</h3></b></h5>
                </div>
                <form action="{{ route('laporan.cetak', []) }}" method="post" target="blank">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggalawal">Tanggal Awal</label>
                            <input id="tanggalawal" class="form-control" type="date" name="tanggalawal">
                        </div>
                        <div class="form-group">
                            <label for="tanggalakhir">Tanggal Akhir</label>
                            <input id="tanggalakhir" class="form-control" type="date" name="tanggalakhir">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">LIHAT LAPORAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
