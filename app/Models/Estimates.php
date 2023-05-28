<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimates extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'project',
        'email',
        'tax',
        'client_address',
        'billing_address',
        'estimate_date',
        'expiry_date',
        'total',
        'tax_1',
        'discount',
        'grand_total',
        'other_information',
    ];
}
