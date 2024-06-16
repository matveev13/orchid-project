<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

//use Orchid\Platform\Traits\MultiLanguageTrait;


class Product extends Model
{
    use HasFactory;
    use AsSource;
    //use MultiLanguageTrait;

protected $fillable = [
    'category',
    'sex',
    'color', 
    'size',
    'price',
    'count',
    'title',
    'description',
    'quantity_in_stock'
];

}
