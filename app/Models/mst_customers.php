<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mst_customers extends Model
{
    use HasFactory;
    protected $table = 'mst_customers';
    protected $primaryKey = 'customer_id';
    public $timestamps = false;
}
