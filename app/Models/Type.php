<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Type extends Model
{
    use HasFactory;
    use AsSource;
   

protected $fillable = [
    'type',
    //'type_id'
];

}