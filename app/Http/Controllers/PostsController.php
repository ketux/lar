<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //$s = $request->input('s');
        //$posts=Post::latest ()
        //  ->search($s)
        //  ->paginate(5);
        //return view ('posts.index')->with('posts', $s);

        //use any of the model function to fetch data from tis model (table)
        //$posts = Post::orderBy('pavadinimas', 'desc')->get();
        //$posts = Post::orderBy('title', 'desc')->take(1)->get();

        //$post = Post::where ('title', 'Post Two')->get();
        //$post = DB::select ('SELECT * FROM posts');
        //$post = Post::all (); //fetch all data in this model

        
        //$posts = Post::sortable()->paginate(5);
        //$posts = Post::select('*')->paginate(5);
        //return view('posts',compact('posts'));

        
        //$posts = Post::with('urls')->whereId($id)->firstOrFail();
        // or just $posts = Post::findOrFail($id);
        //$posts = App\Post::paginate(15);
         //$posts = DB::table('posts')->simplePaginate(15);
          //return view('posts.index', ['posts' => $posts]);
        //$posts = $post->urls()->paginate(10);     
        //return view ('posts.index', compact('posts', 'urls'));

        //geras
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        //loads the view
        return view ('posts.index')->with('posts', $posts);
    }

	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $this->validate($request, [
            'pavadinimas' => 'required',
            'aprasymas' => 'required',
            'kaina' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            
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
            $path = $request->file('cover_image')->storeAS('public/cover_images', $fileNameToStore);
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
        
        return redirect ('/posts')->with('success', 'Sukurta');
    }

	
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         //
        $post = Post::find($id);
        
        //check for correct user <!-- Paslepia edit mygtuka nuo vartotojo, jei tai nera jo zinute gudruojant koreguojant nuorod1-->
       // if (auth()->user()->id !==$post->user_id){
         //   return redirect('/posts')->with('error', 'Neautorizuotas puslapis');
        //}
        $post=Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

	
	
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //
        $this->validate($request, [
            'pavadinimas' => 'required',
            'aprasymas' => 'required',
            'kaina' => 'required'

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
            $path = $request->file('cover_image')->storeAS('public/cover_images', $fileNameToStore);
        } 
        
        //create post
        $post = Post::find($id); //lyginant su store, keiciasi tik sita eilute
        $post->pavadinimas = $request->input('pavadinimas');
        $post->aprasymas = $request->input('aprasymas');
        $post->kaina = $request->input('kaina');
        if ($request->hasFile('cover_image') ){
        $post->cover_image = $fileNameToStore;
        }
        $post->save();
        
        return redirect ('/table')->with('success', 'Atnaujinta');
    }

	
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //
        $post = Post::find($id);
        
        //check for correct user
        //if (auth()->user()->id !==$post->user_id){
          //  return redirect('/posts')->with('error', 'Unautherized page');
        //}
        
        if($post->cover_image != 'noimage.jpg') {
            // Delete the image
            Storage::delete('/cover_images/'.$post->cover_image);
        
        }
        
        $post->delete();
        
        return redirect ('/table')->with('success', 'Įrašas pašalintas');
}

 
	
	public function search(Request $request) {
		//return $request->input('search');
		
		$posts = Post::all();
		$keyword = $request->input('search');
		$posts = Post::where('pavadinimas', 'LIKE', '%'.$keyword.'%')
			->orWhere('aprasymas', 'LIKE', '%'.$keyword.'%')
			->get();
		return view('posts.search', ['posts' => $posts, 'posts' => $posts]);
		
	}
}