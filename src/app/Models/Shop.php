<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = ['name','area_id','genre_id','description','image_url',];

    public function areas()
    {
        return $this->belongsTo('App\Models\Area', "area_id");
    }

    public function genres()
    {
        return $this->belongsTo('App\Models\Genre', "genre_id");
    }

    public function getArea(){
        return ($this->areas)->name;
    }

    public function getGenre(){
        return ($this->genres)->name;
    }
}
