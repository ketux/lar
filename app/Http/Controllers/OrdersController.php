<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Order;
use App\Post;
//use App\Product;
use DB;

class OrdersController extends Controller
{
    
    public function index()
    {
       
           $orders = Order::sortable()->paginate(5);
		   //$orders = Order::orderBy('kaina', 'asc')->paginate(5);
            return view('orders.index')->with('orders', $orders);
    }
	
	public function edit($id)
    {
       
       // $order = Order::find($id);
                //check for correct user <!-- Paslepia edit mygtuka nuo vartotojo, jei tai nera jo zinute gudruojant koreguojant nuorod1-->
     //  if (auth()->user()->id !==$order->user_id){
           // return redirect('/orders')->with('error', 'Neautorizuotas puslapis');
       // }
        $order=Order::find($id);
        return view('orders.edit')->with('order', $order);
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
        $order = Order::find($id); //lyginant su store, keiciasi tik sita eilute
        $order->pavadinimas = $request->input('pavadinimas');
        $order->aprasymas = $request->input('aprasymas');
        $order->kaina = $request->input('kaina');
			if ($request->hasFile('cover_image') ){
        $order->cover_image = $fileNameToStore;
        }
        $order->save();
        
        return redirect ('/orders')->with('success', 'Atnaujinta');
	}

    public function destroy($id)
    {
        //
        $order = Order::find($id);
        $order->delete();
        return redirect ('/orders')->with('success', 'Pašalinta');
    }
	
	public function show($id)
    {
        //
		$order = Order::find($id);
        return view('orders.show')->with('order', $order);
    }

	public function searchOrders(Request $request) {
		//return $request->input('search');
		
		$orders = Order::all();
		$keyword = $request->input('search');
		$orders = Order::where('pavadinimas', 'LIKE', '%'.$keyword.'%')
			->orWhere('aprasymas', 'LIKE', '%'.$keyword.'%')
			->get();
		return view('orders.search', ['orders' => $orders, 'orders' => $orders]);
		
	}

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getClone($id) {
	  // find post with given ID
	  $post = Post::findOrFail($id);
	  // get all Post attributes
	  $data = $post->attributesToArray();
	  // remove given attributes
	  $data = array_except($data, ['id']);
	  // create new Order based on Post's data
	  $order = Order::create($data);

  return redirect ('/orders')->with('success', 'Success');
  
	}
}