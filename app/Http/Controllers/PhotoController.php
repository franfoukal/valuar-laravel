<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

       $photo = new Photo();

        if (!empty($request->file('avatar'))) {
            $avatar = $request->file('avatar');
            $name = 'avatar_' . time() . '.' . $request->type;
            $path = public_path() . '/storage/profile';
        }
       
        $photo->path = $name;
        $photo->extension = $request->type;
        $photo->user_id = Auth::user()->id;

        try {
            if (isset(Auth::User()->photo)) {
                $this->deletePhoto(Auth::User()->photo->path);
            }
            $photo->save();
            $avatar->move($path, $name);
            return response()->json([
                "msg" => "image upload"
            ], 201);
            
        } catch (Exception $e) {
            $error = $e->getMessage();

            return response()->json([
                "msg" => "error uploading image",
                "error" => $error
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }
    public function profilePhoto(){
        $photo = Auth::user()->photo;
        
        return view('profile', compact('photo'));
    }

    public function deleteProfilePhotos($user){

        Photo::where('user_id', $user)->delete();

        return back();
    }

    public function deleteProductPhotos($productID, $path){

        Photo::where('product_id', $productID)->delete();

    }
    public function deletePhoto(string $path){
        
        Photo::where('path', $path)->delete();

        return back();
    }
     
}
