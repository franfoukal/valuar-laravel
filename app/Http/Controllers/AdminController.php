<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateUser;
use App\Http\Requests\ValidatedUser;
use App\Order;
use App\Product;
use App\User;
use App\Photo;
use App\Role;
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
        $soldItems = $this->getAllOrders(true);
        $orders = count($soldItems); 
        $bestSellers = Product::orderBy('amount_sold', 'desc')->limit(4)->get();
        $totalIncome = 0;
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
        foreach ($soldItems as $soldItem){
            $decoded = json_decode($soldItem['billing_info'], true);
            $totalIncome += $decoded['total'];
        }
        return view('admin.admin-index', compact('products', 'totalProducts', 'totalUsers',
        'usersOnline', 'orders', 'totalIncome', 'bestSellers'));
    }

    private function getAllOrders(bool $billingInfoOnly = false)
    {
        if($billingInfoOnly){
            return json_decode(Order::all(['billing_info']), true);
        }
        else{
            return json_decode(Order::all());
        }
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

        $sells = $this->getAllOrders();
        $totalIncome = 0;  
        $totalVouchersDiscount = 0;
        $usedVouchers = 0;
        $soldItems = [];

        foreach ($sells as $sell){
            $soldItems[] = json_decode($sell->billing_info, true);
        }

        $totalSells = count($soldItems);
        
        foreach ($soldItems as $soldItem){
            $totalIncome += $soldItem['total'];
            
            if(count($soldItem['voucher']) > 0){
                $usedVouchers++;
                $totalVouchersDiscount += $soldItem['descuento'];
            }
        }  
        $netIncome = $totalIncome - $totalVouchersDiscount;

        return view('admin.sells-admin', compact('totalVouchersDiscount', 'usedVouchers', 'netIncome', 'totalSells', 'sells', 'totalIncome'));
    }
}
