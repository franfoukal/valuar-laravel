<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatedUser;
use App\Product;
use App\User;
use Carbon\Carbon;
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
        return view('admin.admin-index', compact('products', 'totalProducts', 'totalUsers', 'usersOnline'));
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
    public function users(){

        if(isset($_GET['search'])){

            $search = $_GET['search'];
            $allUsers = User::where('name', 'like', "%$search%")->orWhere('surname', 'like', "%$search%")->paginate(12);
            return view("admin.users-admin", compact('allUsers'));

        } else {

            $allUsers = User::paginate(12);
            return view("admin.users-admin", compact('allUsers'));
        }
        
    }

    public function getEditUsers(int $id){

        $user = User::find($id);
        return view('admin.edit-user', compact('user'));

    }

    public function editUsers(ValidatedUser $request, int $id) {

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

        return $this->users();
        
    }

    public function sells(){
        return view('admin.sells-admin');
    }
}
