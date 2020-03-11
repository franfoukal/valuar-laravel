<?php

namespace App\Http\Controllers;

use App\Photo;
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
        $request->validate([
            'user_profile' => ['required', 'mimes:jpeg, png, jpg, svg, bmp', 'max:10000000']
        ]);

        $userImage = public_path(). "/storage/{Auth::user()->photo}"; // get previous image from folder
        if (File::exists($userImage)) { // unlink or remove previous image from folder
            unlink($userImage);
            File::delete($userImage);
        }

        $path = $request->file('user_profile')->store('public');
        $filename = basename($path);
        $extension = $request->file('user_profile')->getClientOriginalExtension();
        


        $photo = new Photo();
        $photo->user_id = Auth::user()->id; 
        $photo->path = $filename;
        $photo->extension = $extension;
        try {
            $photo->save();
            File::delete(Auth::user()->photo);
        } catch (\Exception $e) {
            
        }

        return view('profile');
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
