<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Material;
use phpDocumentor\Reflection\Types\Integer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($search=null)
    {
       $products = Product::all();
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Retorna el producto solicitado a la vista producto
     * @param int $id
     */
    public function displayProduct(int $id){
        $product = Product::findOrFail($id);
        $photos = $product->photos;
        $recomended = Product::limit(4)->get();
        return view('product', compact('product', 'photos', 'recomended'));
    }

    public function productList(){
        $products = Product::paginate(12);
        return view("product-list", compact('products'));
    }
    public function bestSellers()
    {
        $products = Product::limit(4)->get();
        return view("home", compact('products'));
    }

    public function adminProducts(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $products = Product::where('name', 'like', "%$search%")->paginate(12);
            return view("admin.product-admin", compact('products'));
        }else{
            $products = Product::paginate(12);
            return view("admin.product-admin", compact('products'));
        }
    }

    public function isFavBy($product_id, $user_id){
        $resp = Product::whereHas('users', function ($q) use ($product_id, $user_id) {
            $q->where([['product_id','=', $product_id],
                        ['user_id', '=', $user_id]]);
        })->exists();

        return $resp ? 'true' : 'false';
    }
    

}
