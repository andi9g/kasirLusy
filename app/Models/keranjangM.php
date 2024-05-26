<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjangM extends Model
{
    use HasFactory;
    protected $table = 'keranjang';
    protected $primaryKey = 'idkeranjang';
    protected $connection = 'mysql';
    protected $guarded = [];
}
