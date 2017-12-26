<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Product;
use App\Order;
use App\Post;
use DB;

class ProductController extends Controller
{
      /**
     * Display the products dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()

    {
        $products = Product::sortable()->paginate(2);
        return view('products.index',compact('products'));
    }
	
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
	
	public function edit($id)
    {
        //
         //
        $product = Product::find($id);
        
        //check for correct user <!-- Paslepia edit mygtuka nuo vartotojo, jei tai nera jo zinute gudruojant koreguojant nuorod1-->
       if (auth()->user()->id !==$product->user_id){
            return redirect('/kita')->with('error', 'Neautorizuotas puslapis');
        }
        $product=Product::find($id);
        return view('/kita')->with('product', $product);
    }
	
	public function update(Request $request, $id)
    {
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
        
        return redirect ('/kita')->with('success', 'Atnaujinta');
	}
	
	public function show($id)
    {
        //
		$products = Product::find($id);
        return view('products.show')->with('product', $products);
    }
	
	public function destroy($id)
    {
        //
        $product = Product::find($id);
        
        $product->delete();
        
        return redirect ('/kita')->with('success', 'Paðalinta');
    }
	
	public function getClone($id) {
			  // find post with given ID
			  $product = Product::findOrFail($id);
			  // get all Post attributes
			  $data = $product->attributesToArray();
			  // remove given attributes
			  $data = array_except($data, ['']);
			  // create new Order based on Post's data
			  $order = OrderProduct::create($data);

		  return redirect ('/ordersp')->with('success', 'Success');
		}
			
	public function search(Request $request) {
		//return $request->input('search');
		
		$posts = Product::all();
		$keyword = $request->input('search');
		$products = Product::where('pavadinimas', 'LIKE', '%'.$keyword.'%')
			->orWhere('aprasymas', 'LIKE', '%'.$keyword.'%')
			->orWhere('kaina', 'LIKE', '%'.$keyword.'%')
			->orWhere('id', 'LIKE', '%'.$keyword.'%')
			->get();
		return view('products.ieskau', ['posts' => $posts, 'products' => $products]);	
	}
}