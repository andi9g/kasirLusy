<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <style>
        @page {
            margin-top: 30px;
        }
        table {
            /* border: 1px solid rgb(80, 80, 80); */
            border-collapse: collapse;
            margin: 5px 0px;
        }
        tr th {
            padding: 5px;
        }
        tr td {
            padding: 5px;
        }
        .h2 {
            font-weight: bold;
            font-size: 15pt;
        }
        h1 {
            padding: 0;
            margin: 0;
        }
        h2 {
            padding: 0;
            margin: 0;
        }
        h3 {
            padding: 0;
            margin: 0;
        }
        h4 {
            padding: 0;
            margin: 0;
        }
        p {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>


    <table width="100%" style="border-bottom: 2px double black">
        <tr>
            <td width="100px">
                <img src="{{ url('gambar/logo', ['logo.png']) }}" width="100%" alt="">
            </td>
            <td valign="middle">
                <h1 style="text-transform: uppercase">Vansesco Boutique</h1>
                <h3>Jl. Teladan No.02 Tanjungpinang Barat</h3>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <h4 style="">LAPORAN PENDAPATAN</h4>

                <p>
                   {{ $tanggal }}</td>
                </p>
            <td width="50%" valign="top"></td>
        </tr>
    </table>

    <table width="100%" border="1">
        <tr>
            <th width="5px">No</th>
            <th>Nama Barang</th>
            <th width="5px">Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Metode Pembayaran</th>
        </tr>

        @php
            $totalpendapatan = 0;
        @endphp
        @foreach ($penjualan as $item)
            <tr>
                <td><center>{{ $loop->iteration }}</center></td>
                <td>{{ ucwords($item->namabarang )}}</td>
                <td>x{{ $item->jumlah }}</td>
                <td>Rp{{ number_format($item->harga, 0, ",", ".") }}</td>
                @php
                    $subtotal = $item->harga * $item->jumlah;
                    $totalpendapatan = $totalpendapatan + $subtotal;
                @endphp
                <td>Rp{{ number_format($subtotal, 0, ",", ".") }}</td>
                <td>{{ $item->metodepembayaran }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="h2">TOTAL PENJUALAN</td>
            <td colspan="2" class="h2">Rp{{ number_format($totalpendapatan, 0, ",", ".") }}</td>
        </tr>
    </table>


    <br>
    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td align="center">
                <p>Tanjungpinang, {{ \Carbon\Carbon::parse(date("Y-m-d"))->isoFormat("DD MMMM Y") }}</p>
                <p>Pemilik</p>
                <br>
                <br>
                <br>
                <p>.............................</p>
            </td>
        </tr>
    </table>


</body>
</html>
