<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Datatables;

use DB;
use App\Post;


class PostController extends Controller

{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
       
        //geras
        $posts = Post::paginate(5);
        return view('datatable',compact('posts'));
    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function datatable()

    {

        return view('datatable');

    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function getPosts()

    {

    	$users = DB::table('posts')->select('*');

        return Datatables::of($users)

            ->make(true);

    }

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
        
        return redirect ('/table')->with('success', 'Post Removed');
}

}