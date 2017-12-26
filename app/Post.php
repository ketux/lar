<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Post extends Model
{
	use Sortable;
    protected $fillable = [ 'pavadinimas', 'aprasymas', 'kaina' ];
	public $sortable = ['id', 'pavadinimas', 'kaina', 'aprasymas', 'created_at', 'updated_at'];	
	
    //Table name
	protected $table = 'posts';
	//Primary key
	public $primaryKey = 'id';
	//Timestamps
	public $timestamps = true;
	
	//relationaship
		public function user () {
		return $this->belongsTo('App\User');
	}
}
