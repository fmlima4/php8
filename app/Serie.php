<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome','capa'];

    public function getCapaUrlAttribute(){
        if($this->capa){
            return 'http://127.0.0.1:8000/storage/' . $this->capa;
        } else {
            return 'http://127.0.0.1:8000/storage/serie/default.png' ;
        }

    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
