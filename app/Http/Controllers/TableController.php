<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class TableController extends Controller
{
    
    public function index()

    {
    		//geras
		$posts = Post::sortable()->paginate(7);
		//loads the view
		        return view('posts/table',compact('posts'));
		//return view ('posts.table')->with('posts', $posts);
    }

   
    public function create()
    {
        //
		return view('posts.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
			'pavadinimas' => 'required',
			
			'aprasymas' => 'required',
			'kaina' => 'required',
			'cover_image' => 'image|nullable|max:1999'
		]);
		
		//handle file upload
		if ($request->hasFile('cover_image') ){
			//get filename with the extension
			$filenameWithExt = $request->file('cover_image')->getClientOriginalName();
			// get just filename
			$filename = pathinfo ($filenameWithExt, PATHINFO_FILENAME);
			//get just extension
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			// Filename to store
			$fileNameToStore = $filename.'_'.time().'.'.$extension;
			//upload image
			$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
		} else {
			$fileNameToStore = 'noimage.jpg';
		}
		
		//sukurti nauja
		$post = new Post;
		$post->pavadinimas = $request->input('pavadinimas');
		$post->aprasymas = $request->input('aprasymas');
		$post->kaina = $request->input('kaina');
		$post->cover_image = $fileNameToStore;
		$post->save();
		
		return redirect ('/pradinis')->with('success', 'Sukurta');

		
		//return 123;
    }
   
    public function show($id)
    {
        // is Model
		$post = Post::find($id);
		return view('posts.show')->with('post', $post);
    }

   
    public function edit($id)
    {
        //
		$post = Post::find($id);	
		//check for correct user <!-- Paslepia edit mygtuka nuo vartotojo, jei tai nera jo zinute gudruojant koreguojant nuorod1-->
		return view('posts.edit')->with('post', $post);
    }
   
    public function update(Request $request, $id)
    {
        //
		$this->validate($request, [
			'pavadinimas' => 'required',
			'aprasymas' => 'required',
			'kaina' => 'required'
		]);
		
		//handle file upload
		if ($request->hasFile('cover__image') ){
			//get filename with the extension
			$filenameWithExt = $request->file('cover_image')->getClientOriginalName();
			// get just filename
			$filename = pathinfo ($filenameWithExt, PATHINFO_FILENAME);
			//get just extension
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			// Filename to store
			$fileNameToStore = $filename.'_'.time().'.'.$extension;
			//upload image
			$path = $request->file('cover_image')->storeAS('http://localhost/laravelis/svari8/public/cover_images', $fileNameToStore);
		} 
		
		//create post
		$post = Post::find($id); //lyginant su store, keiciasi tik sita eilute
		$post->pavadinimas = $request->input('pavadinimas');
		$post->aprasymas = $request->input('aprasymas');
		$post->kaina = $request->input('kaina');
		if ($request->hasFile('cover__image') ){
		$post->cover_image = $fileNameToStore;
		}
		$post->save();
		
		return redirect ('/pradinis')->with('success', 'Atnaujinta');	
    }
   
   public function destroy($id)
    {
        //
		$post = Post::find($id);
		if($post->cover_image != 'noimage.jpg') {
		// Delete the image
		Storage::delete('cover_images/'.$post->cover_image);		
		}
		$post->delete();
		return redirect ('/table')->with('success', 'Post Removed');
    }
}