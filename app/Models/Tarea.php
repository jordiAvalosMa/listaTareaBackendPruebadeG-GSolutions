<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //
    protected $fillable = ['titulo', 'descripcion', 'completada'];

    public static function pendientes()
    {
        return self::where('completada', false)->get();
    }
    public function completar()
    {
        $this->completada = true;
        $this->save();
    }
    public function descompletar()
    {
        $this->completada = false;
        $this->save();
    }
}
