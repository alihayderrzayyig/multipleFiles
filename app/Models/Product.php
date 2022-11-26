<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

use Illuminate\Support\Facades\File;



class Product extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function images(){
        return $this->hasMany(Image::class);
    }

    public function deleteProduct(){
        $images = $this->images()->get();

        foreach ($images as $am) {
            echo $am->image . '<br>';
            if (file_exists('product_images/' . $am->image)) {
                File::delete('product_images/' . $am->image);
            }
            if ($am) {
                $am->delete();
            }
        }

        $this->delete();
    }
}
