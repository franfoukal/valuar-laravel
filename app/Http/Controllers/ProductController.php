<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProduct;
use App\Http\Requests\ValidatedProduct;
use Illuminate\Http\Request;
use App\Product;
use App\Material;
use App\Photo;
use Illuminate\Support\Facades\Session;
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
        $recomended = Product::orderBy('amount_sold', 'DESC')->limit(4)->get();
        return view('product', compact('product', 'photos', 'recomended'));
    }

    public function productList(){
        $products = Product::orderBy('created_at')
        ->paginate(12);
        return view("product-list", compact('products'));
    }

    public function bestSellers()
    {
        $products = Product::orderBy('amount_sold', 'DESC')->limit(4)->get();
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
    public function getEditProduct(int $id) {

        $product = Product::find($id);
        return view('admin.edit-product', compact('product'));

    }

    /*
    *
    *   Carga de fotos 
    *
    */
    private function addProductPhotos(array $request){

        if(array_key_exists('photos', $request)){
            
            foreach($request['photos'] as $photos){

                $photo = new Photo();

                $photoProduct = Product::where('name', $request['name'])->get();
                $path = $photos->store('/storage/products');
                $filename = basename($path);
                $extension = $photos->getClientOriginalExtension();
                
                $photo->product_id = $photoProduct[0]->id; 
                $photo->path = $filename;
                $photo->extension = $extension;

                $photo->save();
            }
        }
    }

    public function editProduct(UpdateProduct $request, int $id) {

        /*
        *   En vez de validar todo en cada metodo, 
        *   lo cual lleva a la duplicación de código,
        *   se pasa un parámetro de tipo %Nombre del request%
        *   el cual está dentro de app/controllers/requests.
        *
        *   Este Request hace la validación y se pueden obtener los datos validados
        *   de esta forma:
        */
        
        $product = $request->validated();

        
            
        Product::findOrFail($id)->update([

            'name' => $product['name'],
            'price' => $product['price'],
            'barcode' => $product['barcode'],
            'description' => $product['description']

        ]);

        
        $this->addProductPhotos($product);

        return $this->getEditProduct($id);

    }

    public function getAddProduct() {
        return view('admin.add-product');
    }

    public function addProduct(ValidatedProduct $validated) {
        
        $request = $validated->validated();
        
        $product = new Product();

        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->barcode = $request['barcode'];
        $product->has_size = 1;
        $product->description = $request['description'];
        $product->stock = $request['stock'];
        $product->active = $request['active'];
        $product->category_id = $request['category_id'];
        $product->material_id = $request['material_id'];
        $product->save();

        
        $this->addProductPhotos($request);

        return $this->adminProducts()->with('success', 'Producto creado con éxito!');

    }

    public function search(){
        if(empty($_GET['search'])){
            return redirect('/products');
        }else{

            switch ($_GET['search']) {
                case (preg_match('/[0-9]+/', $_GET['search']) ? true : false):
                    $products = Product::where('price', '<=', $_GET['search'])
                    ->orderBy('price', 'DESC')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
                case 'aros':
                    $products = Product::where('category_id', 'LIKE', 1)
                    ->orderBy('created_at')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
                case 'colgantes':
                    $products = Product::where('category_id', 'LIKE', 2)
                    ->orderBy('created_at')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
                case 'anillos':
                    $products = Product::where('category_id', 'LIKE', 3)
                    ->orderBy('created_at')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
                case 'pulseras':
                    $products = Product::where('category_id', 'LIKE', 4)
                    ->orderBy('created_at')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
                case 'oro':
                    $products = Product::where('material_id', 'LIKE', 1)
                    ->orderBy('created_at')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
                case 'plata':
                    $products = Product::where('material_id', 'LIKE', 2)
                    ->orderBy('created_at')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
                default:
                    $products = Product::
                    where(
                        'name','LIKE', '%'.$_GET['search'].'%')
                    ->orderBy('created_at')
                    ->paginate(12);
                    return view('product-list', compact('products'));
                    break;
            }
        }
    }

    public function filter(string $filter){

        switch ($filter) {
            // filtrar por precio entre X e Y  /filter/x_y
            case (preg_match('/[0-9]+_[0-9]+/', $filter)?true:false):
                $filter = explode('_' , $filter);
                $products = Product::where('price', '>=', $filter[0])
                ->where('price', '<=', $filter[1])
                ->orderBy('created_at')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'aros':
                $products = Product::where('category_id', 'LIKE', 1)
                ->orderBy('created_at')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'colgantes':
                $products = Product::where('category_id', 'LIKE', 2)
                ->orderBy('created_at')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'anillos':
                $products = Product::where('category_id', 'LIKE', 3)
                ->orderBy('created_at')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'pulseras':
                $products = Product::where('category_id', 'LIKE', 4)
                ->orderBy('created_at')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'oro':
                $products = Product::where('material_id', 'LIKE', 1)
                ->orderBy('created_at')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'plata':
                $products = Product::where('material_id', 'LIKE', 2)
                ->orderBy('created_at')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;

            default:
                return redirect('/products');
                break;
        }
        
    }

    public function orderBy(string $orderBy){


        switch ($orderBy) {
            case 'relevantes':
                $products = Product::orderBy('stock', 'DESC')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'aZ':
                $products = Product::orderBy('name', 'ASC')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'Za':
                $products = Product::orderBy('name', 'DESC')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'menorPrecio':
                $products = Product::orderBy('price', 'ASC')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            case 'menorPrecio':
                $products = Product::orderBy('price', 'DESC')
                ->paginate(12);
                return view('product-list', compact('products'));
                break;
            default:
                return redirect('/products');
                break;
        }

        
    }


    public function addToCart(Request $request){
        $product = Product::find($request->id); 
        $product->units = $request->units;
        $product->size = $request->size;
        $product->firstPhoto;
        $product->material;
        $product->unique_id = uniqid();

        $request->session()->push('cart', $product);

        return response()->json([
            'msg' => 'Added to cart',
            'check' => session('cart')
        ], 201);
    }

    public function deleteFromCart(Request $request)
    {
        $cart = $request->session()->pull('cart');
        foreach ($cart as $key => $item) {
            if($item['unique_id'] == $request->unique_id){
                unset($cart[$key]);
            }
        }
        session()->put('cart', $cart);
        return response()->json([
            'msg' => 'Added to cart',
            'check' => session('cart')
        ]);
    }

    public function getCart(Request $request){
        $cart = $request->session()->get('cart') ?? [];
        return json_encode([
            'cart' =>  $cart,
            'units' => count($cart)
            ]);
    }

    public function refreshCart(Request $request){
        $request->session()->forget('cart');
        session()->put('cart', $request->cart);

        return response()->json(["msg" => "change"], 200);
    }


    public function deleteCart(Request $request){
        return $request->session()->forget('cart');
    }

    

}
