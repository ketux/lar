<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderProduct;
use App\Post;
use App\Product;
use DB;

class OrdersControllerProduct extends Controller
{  
    public function index()
    {     
           $orders = OrderProduct::sortable()->paginate(5);
		   //$orders = Order::orderBy('kaina', 'asc')->paginate(5);
            return view('ordersp.index')->with('orders', $orders);
    }
	
	public function edit($id)
    {
        //
         //
        $order = OrderProduct::find($id);
        
        //check for correct user <!-- Paslepia edit mygtuka nuo vartotojo, jei tai nera jo zinute gudruojant koreguojant nuorod1-->
      // if (auth()->user()->id !==$product->user_id){
         //   return redirect('/kita')->with('error', 'Neautorizuotas puslapis');
     //   }
      //  $product=Product::find($id);
        return view('ordersp.edit')->with('order', $order);
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
        $order = OrderProduct::find($id); //lyginant su store, keiciasi tik sita eilute
        $order->pavadinimas = $request->input('pavadinimas');
        $order->aprasymas = $request->input('aprasymas');
        $order->kaina = $request->input('kaina');
        if ($request->hasFile('cover_image') ){
        $order->cover_image = $fileNameToStore;
        }
        $order->save();
        
        return redirect ('/ordersp')->with('success', 'Atnaujinta');
	}

    public function destroy($id)
    {
        //
        $order = OrderProduct::find($id);
        
        $order->delete();
        
        return redirect ('/ordersp')->with('success', 'Pašalinta');
    }
	
	public function search(Request $request) {
		//return $request->input('search');
		
		$orders = OrderProduct::all();
		$keyword = $request->input('search');
		$orders = OrderProduct::where('pavadinimas', 'LIKE', '%'.$keyword.'%')
			->orWhere('aprasymas', 'LIKE', '%'.$keyword.'%')
			->get();
		return view('ordersp.search', ['orders' => $orders, 'orders' => $orders]);		
	}
	
	public function create()
    {
        return view('products.create');

    }
		
	public function show($id)
    {
        //
		$order = OrderProduct::find($id);
        return view('ordersp.show')->with('order', $order);
    }
	
		public function getClone($id) {
			  // find post with given ID
			  $post = Product::findOrFail($id);
			  // get all Post attributes
			  $data = $post->attributesToArray();
			  // remove given attributes
			  $data = array_except($data, ['']);
			  // create new Order based on Post's data
			  $order = OrderProduct::create($data);

		  return redirect ('/ordersp')->with('success', 'Success');
		}
}