<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'contactUsId';

    protected $fillable = [
        'name',
        'phone',
        'email' .
        'message',
    ];

}
