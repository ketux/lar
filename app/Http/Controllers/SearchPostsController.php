<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Product;
use App\Order;
use App\Post;
use DB;

class SearchPostsController extends Controller
{
    //
	
	public function create()
    {
        return view('products.create');

    }
	
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
        $product = new Product;
        $product->pavadinimas = $request->input('pavadinimas');
        $product->aprasymas = $request->input('aprasymas');
        $product->kaina = $request->input('kaina');
        $product->cover_image = $fileNameToStore;
        $product->save();
        
        return redirect ('/kita')->with('success', 'Sukurta');
    }
	
	public function show($id)
    {
        //
		$products = Product::find($id);
        return view('products.show')->with('product', $products);
    }
	
	public function edit($id)
    {
        //
        $product=Product::find($id);
        return view('products.edit')->with('product', $product);
    }
	
	
	
	public function destroy($id)
    {
        $product = Product::find($id);
                
			if($product->cover_image != 'noimage.jpg') {
				// Delete the image
				Storage::delete('/cover_images/'.$product->cover_image);
        
        }
        
        $product->delete();
        return redirect ('/kita')->with('success', 'Įrašas pašalintas');
}

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
        $product = Product::find($id); //lyginant su store, keiciasi tik sita eilute
        $product->pavadinimas = $request->input('pavadinimas');
        $product->aprasymas = $request->input('aprasymas');
        $product->kaina = $request->input('kaina');
        if ($request->hasFile('cover_image') ){
        $product->cover_image = $fileNameToStore;
        }
        $product->save();
        
        return redirect ('/ieskau')->with('success', 'Atnaujinta');
    }



}
