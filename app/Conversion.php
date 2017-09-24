<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    //
	protected $table = 'Conversion';
	
	protected $fillable = array('cnt_ini_prd', 'cnt_fin_prd');

	public function producto()
    	{
	        return $this->belongsTo('Producto');
	}

	public function unidad_inicial()
    	{
	        return $this->hasMany('Unidad');
	}

	public function unidad_final()
    	{
	        return $this->hasMany('Unidad');
	}
}