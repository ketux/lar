<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class OrderProduct extends Model
{
   use Sortable;
	
    
    protected $fillable = [ 'id', 'pavadinimas', 'aprasymas', 'kaina'];
	public $sortable = ['id', 'pavadinimas', 'aprasymas', 'kaina'];


    //Table name
	protected $table = 'ordersp';
	//Primary key
	public $primaryKey = 'id';
	//Timestamps
	public $timestamps = true;
	
	//relationaship
		public function user () {
		return $this->belongsTo('App\User');
	}
}
