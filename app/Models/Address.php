<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    
    use HasFactory;

    public $table = 'n_addresses';
    public $timestamps = false;
}
