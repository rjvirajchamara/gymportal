<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\cart;
use App\Models\item;
use App\Models\ItemOder;
use App\Models\OderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ItemOderController extends Controller
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
    //gym purchase item
    public function SaveItemOder(Request $request)
    {
       try{
       // $wallet=Http::get('https://')->json();

       $wallet=5000;
        $oder_tatal_price=$request->oder_tatal_price;
        if($wallet<=$oder_tatal_price){
            $address=$request->address;
            $total_price=$request->oder_tatal_price;

            $userData = $request->get('userData');
            $user_id = $userData['user_id'];

            DB::beginTransaction();


            $user_id=$request->user_id;
            $item_oders=new OderItem();
            $item_oders->user_id=$user_id;
            $item_oders->address=$address;
            $item_oders->total_price=$total_price;
            $item_oders->save();



            $get_oder_id = app('db')->table('oder_items')->where('user_id',$user_id)->orderBy('id', 'desc')->first()->id;
            $allcrd = app('db')->table('carts')->where('user_id',$user_id)->get();

                foreach($allcrd as $oderItem){
                    $item_oder= new ItemOder();
                    $item_oder->oder_id=$get_oder_id;
                    $item_oder->item_id=$oderItem->item_id;
                    $item_oder->user_id=$oderItem->user_id;
                    $item_oder->qty=$oderItem->qty;
                    $item_oder->total_price=$oderItem->total_price;

                    $item_oder->save();


                 $get_item_valus= item::where('id',$oderItem->item_id)->value('qty');
                 $car_tabel_qty_value = cart::where('item_id',$oderItem->item_id)->value('qty');
                //dd($car_tabel_qty_value );

                 $item = item::findorfail($oderItem->item_id);
                 $lower_valus = ($get_item_valus) - ($car_tabel_qty_value) ;
                 $item->qty=$lower_valus;
                 $item->save();

                $get_delete_cart_id = cart::where('item_id',$oderItem->item_id)->where('user_id',$oderItem->user_id)->value('id');

                cart::where('id',$get_delete_cart_id)->delete();

            }
            DB::commit();
            return response()->json(['status' => 1,'data' => "Oder  Successfully Saved"], 201);
           }else{
        return response()->json(['stutus'=>0,'message'=>'Please top up your wallet']);
       }

       } catch (Exception $e) {
        DB::rollBack();
        return response()->json(['status' => 0,'data' => $e ], 403);

    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemOder  $itemOder
     * @return \Illuminate\Http\Response
     */
    public function show(ItemOder $itemOder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemOder  $itemOder
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemOder $itemOder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemOder  $itemOder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemOder $itemOder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemOder  $itemOder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemOder $itemOder)
    {
        //
    }
}
