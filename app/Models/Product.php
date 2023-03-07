<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function getImagenAttribute(){
        if($this->image != null)
            return (file_exists('storage/products/' . $this->image) ? $this->image : 'noimage.png');
        else
           return 'noimage.png';
    }


    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }


}
