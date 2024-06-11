@extends('layouts.admin')

@section('activehome', "active")

@section('judul', "home")


@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 class="text-dark">{{ $penjualan }}</sup>
                </h3>
                <p class="text-dark text-lg text-bold">JUMLAH TRANSAKSI (HARI INI)</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 class="text-dark">Rp{{ number_format($pendapatan->sum("subtotal"),0, ",", ".") }}</sup>
                </h3>
                <p class="text-dark text-lg text-bold">TOTAL PENDAPATAN (HARI INI)</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>

        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <div class="">
                <canvas id="myChart" style="max-height: 500px"></canvas>
            </div>

        </div>
    </div>


@endsection

@section('myScript')
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulan) !!},
            datasets: [{
                label: 'Penjualan',
                data: {!! json_encode($data) !!},
                backgroundColor: 'pink',
                borderColor:'black',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@endsection
