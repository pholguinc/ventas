<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function getImagenAttribute(){
        if($this->image != null)
            return (file_exists('storage/brands/' . $this->imagen) ? $this->image : 'noimage.png');
        else
           return 'noimage.png';
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
