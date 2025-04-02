<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Filter extends Model
{
    protected $fillable = ['id', 'type', 'value'];
}
