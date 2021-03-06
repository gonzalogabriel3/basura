<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Punto extends Model
{
    protected $table="recorrido_playa_vuelta";

    public function scopeBuscar(){

        $recorrido = DB::table('recorrido_playa_vuelta')->select(DB::raw(' ST_AsText(ST_LineMerge(geom)) as puntos'))->get();
        
        $puntos = explode(",", $recorrido);
        /*Quito el 'LineString' y los '{()}' devuelto en la consulta, para que unicamente queden los puntos*/
        $puntos[0]=substr($puntos[0],23);
        $puntos[count($puntos)-1]=substr($puntos[count($puntos)-1],0,-4);
        
        return $puntos;
    }
}
