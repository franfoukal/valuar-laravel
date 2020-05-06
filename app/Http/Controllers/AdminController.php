<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateUser;
use App\Http\Requests\ValidatedUser;
use App\Order;
use App\Product;
use App\User;
use App\Photo;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = '';
        $totalIncome = '';
        // $orders = Order::count(); 
        // $totalIncome = Order::sum('subtotal');
        $bestSellers = Product::orderBy('amount_sold', 'desc')->limit(4)->get();

        $products = Product::where('active', 1)->count();       // Productos activos
        $totalProducts = Product::count();                      // Total de productos
        $totalUsers = User::count();                            // Total de usuarios
        $usersOnline = 0;                                       // Contador de users online
        $users = User::all();                                   //
        foreach ($users as $user) {                             // Pedimos todos los usuarios
            if (Cache::has('user-is-online-' . $user->id)) {    // y llamamos a la cache a ver  
                $usersOnline += 1;                              // si están logueados.  
            }                                                   // Si están, ++usersonline.
        }
        
        return view('admin.admin-index', compact('products', 'totalProducts', 'totalUsers',
        'usersOnline', 'orders', 'totalIncome', 'bestSellers'));
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


    private function addUserPhotos(array $request){

        if(array_key_exists('photos', $request)){
            
            foreach($request['photos'] as $photos){
                
                $photo = new Photo();

                $photoUser = User::where('id', $request['id'])->get();
                $path = $photos->store('/public/img/users');
                $filename = basename($path);
                $extension = $photos->getClientOriginalExtension();
                
                $photo->user_id = $photoUser[0]->id; 
                $photo->path = $filename;
                $photo->extension = $extension;

                $photo->save();
            }
        }
    }


    public function users(){

        $roles = Role::all();
        
        if(isset($_GET['search'])){

            $search = $_GET['search'];
            $allUsers = User::where('name', 'like', "%$search%")->orWhere('surname', 'like', "%$search%")->paginate(12);

        } else {

            $allUsers = User::paginate(12);

        }
        return view("admin.users-admin", compact('allUsers', 'roles'));

        
    }

    public function getEditUsers(int $id){

        $user = User::find($id);

        $photo = Photo::where('user_id', $id)->get()->last();

        return view('admin.edit-user', compact('user', 'photo'));

    }

    public function editUsers(UpdateUser $request, int $id) {

        /*
        *   Ver Controllers/ProductController línea 130
        */

        $user = $request->validated();

        User::find($id)->update([

            'name' => $user['name'],
            'surname' => $user['surname'],
            'email' => $user['email'],
            'phone' => $user['phone']

        ]);

        $this->addUserPhotos($user);
        
        return $this->getEditUsers($id);
    }

    public function getAddUser() {
        return view('admin.add-user');
    }

    public function addUser(ValidatedUser $validated) {

        $request = $validated->validated();
        
        $user = new User();

        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->phone = $request['phone'];
        $user->active = 1;
        $user->roles_id = $request['role'];

        $user->save();

        $this->addUserPhotos($request);

        return $this->users();
        
    }

    public function getOrder(int $id){

        $order = Order::find($id);

        return view('admin.order-admin', compact('order'));
    }

    public function sells(){

        $totalIncome = Order::sum('subtotal');
        $sells = Order::all();
        $totalWithTaxes = 0;
        $totalWithInterests = 0;
        $totalSells = Order::count();
        foreach($sells as $order){
            if(!is_null($order->tax_percentage)){
                $totalWithTaxes += $order->subtotal + $order->subtotal * $order->tax_percentage;
            } else {
                $totalWithTaxes += $order->subtotal;
            }
            if(!is_null($order->interest_percentage)){
                $totalWithInterests += $order->subtotal + $order->subtotal * $order->tax_percentage;
            } else {
                $totalWithInterests += $order->subtotal;
            }
        }
        
        return view('admin.sells-admin', compact('totalWithTaxes', 'totalWithInterests', 'sells', 'totalSells', 'totalIncome'));
    }
}
