<?php

namespace App\Http\Controllers;

use App\Voucher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::paginate(15);

        return response()->json([
            'vouchers'=> $vouchers,
            'msg' => 'success',
        ], 200);
    
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
        $validator = $request->validate([
            'valid_since' => 'required|date|after_or_equal:today',
            'valid_to' => 'required|date|after_or_equal:valid_since',
            'type' => [
                'required',
                Rule::in(['voucher', 'discount']),
            ],
            'value' => 'required|numeric|min:0'
        ]);

        try {
            for($i = 0 ; $i < $request->units ; $i++){
                $voucher = new Voucher();
                $voucher->code = Str::random(10);
                $voucher->valid_since = $request->valid_since;
                $voucher->valid_to = $request->valid_to;
                $voucher->type = $request->type;
                $voucher->value = $request->value;
                $voucher->save();
            }
    
            return response()->json([
                'msg' => 'Los vouchers fueron creados',
            ],200);


        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Ha ocurrido un error al crear los vouchers',
                'error' => $e->getMessage()
            ], 400);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        try {
            $voucher->delete();
            return response()->json([
                'msg' => 'El voucher fue eliminado',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Ha ocurrido un error',
                'error' => $e->getMessage()
            ], 400);
        }
    }


    public function isValid(Request $request){

        if(!Voucher::where('code', $request->code)->exists()){
            return response()->json([
                'msg' => 'El código ingresado no existe'
            ], 400);
        }
        $voucher = Voucher::where('code', $request->code)->first();
        if($voucher->valid_since > now()){
            return response()->json([
                'msg' => 'El código es válido a partir de la fecha ' . $voucher->valid_since,
            ], 400);
        }
        if ($voucher->valid_to < now()) {
            return response()->json([
                'msg' => 'El código está vencido',
            ], 400);
        }

        return response()->json([
                    'voucher' => $voucher
                ], 200);
    }
}
