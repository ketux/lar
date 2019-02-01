<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Post;
use DB;

class PostControllerKopinam extends Controller
{
    
   	
	public function getClonePost($id) {
		$item = Post::find($id);
		$clone = $item->replicate();
		//unset($clone['pavadinimas'], $clone['aprasymas'], $clone['kaina'],$clone['cover_image']);
		$data = json_decode($clone, true);
		Post::create($data);

		$posts = Post::orderBy('pavadinimas', 'asc')->paginate(5);
		return redirect ('/posts')->with('success', 'Nukopijuota');
	}
	
}