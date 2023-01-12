<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\cart;
use App\Models\item;
use App\Models\User;
use App\Models\user_one;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViweCart(Request $request){

        $userData = $request->get('userData');
        $user_id = $userData['user_id'];
        $ViweProductCount=$this->ViweProductCount($user_id );
        $Total_price=$this->Total_price($user_id);



        $ViweCart= app('db')->table('carts')

       // ->join('carts', 'user_ones.id', '=', 'carts.user_id')
        ->join('items', 'carts.item_id', '=', 'items.id')

         ->select('carts.id','total_price' ,'carts.qty',
         'items.item_name','items.price as one_item_price','items.description',
         'items.Image','items.updated_at as item_upload_day')

         ->where('user_id',$user_id)

         ->get();

        $emptyArray = array();


        if ($ViweCart) {
            return response()->json(["ViweCart"=>$ViweCart,"ViweProductCount"=>$ViweProductCount,"totalPrice"=>$Total_price]);
        } else if (!$ViweCart) {
            return response()->json($emptyArray,);
        }
    }
 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViweProductCount($user_id ){

        $ViweProductCount= app('db')->table('carts')->where('user_id',$user_id )->SUM('qty');
        $empty =0;


        if ($ViweProductCount) {
        return response()->json($ViweProductCount);
        } else if (!$ViweProductCount) {
            return response()->json($empty);

   }

}
        public function Total_price($user_id ){

        $Total_price= app('db')->table('carts')->where('user_id',$user_id)->sum('total_price');
        $empty =0;
        //dd($Total_price);
       if ($Total_price) {
        return response()->json($Total_price);
        } else if (!$Total_price) {
            return response()->json($empty);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddCart(Request $request)
    {

     try{

    $userData = $request->get('userData');
    $user_id = $userData['user_id'];


     $user_id=$request->user_id;
     $item_id=$request->item_id;
     $card_id= cart::where('user_id',$user_id)->where('item_id',$item_id)->count();
     $get_item_id= cart::where('user_id',$user_id)->where('item_id',$item_id)->value('id');

      if( $card_id <= 0 ){

        $add_item = new cart();
        $add_item->item_id=$request->item_id;
        $add_item->user_id=$request->user_id;
        $add_item->qty=$request->qty;
        $qty=$request->qty;
        $price=$request->price;
        $total_prices=$price*$qty;
       // dd($total_prices);
        $add_item->total_price=$total_prices;
        $add_item->type=1;

         $add_item->save();

         return response()->json(['status' => 1,'data' => "Successfully save"], 201);

          //$get_item_valus= item::where('id',$item_id)->value('qty');

            //$item = item::findorfail($item_id);
           // $qty=$request->qty;
           // $lower_valus= $get_item_valus - $qty;
           // dd($lower_valus);
           // $item->qty=$lower_valus;
          //  $item->save();




        }else{

        if($request->qty>0){
        $update_item = cart::findorfail($get_item_id);
        $update_item->qty=$request->qty;
        $qty=$request->qty;
        $price=$request->price;
        $totalprice=$price*$qty;
        $update_item->total_price=$totalprice;

        $carts_tabel_qty_values = cart::where('user_id',$user_id)->where('item_id',$item_id)->value('qty');
        $get_item_valuss= item::where('id',$item_id)->value('qty');

         $data = item::findorfail($item_id);
         $recall_qty=$get_item_valuss+$carts_tabel_qty_values;
         $data->qty=$recall_qty;
         $data->save();

        $update_item->save();
          //  $get_item_valus= item::where('id',$item_id)->value('qty');

          //  $item = item::findorfail($item_id);
          //  $qty=$request->qty;
           // $lower_valus= $get_item_valus - $qty;
           // dd($lower_valus);
           // $item->qty=$lower_valus;
           // $item->save();
           return response()->json(['status' => 1,'data' => "Successfully update"], 200);


      //  $get_item_valus= item::where('id',$item_id)->value('qty');

      //  $car_tabel_qty_value = cart::where('user_id',$user_id)->where('item_id',$item_id)->value('qty');

        //dd($car_tabel_qty_value);

       // $items = item::findorfail($item_id);
      //  $recall_data=$get_item_valus+$car_tabel_qty_value;
      //  $items->qty=$recall_data;
      //  $items->save();
        }
        $delete_item = cart::findorfail($get_item_id);

        if($delete_item->delete()){
            return response()->json(['stutus','message'=>'item deleted '],202);
        }else{
            return response()->json(['stutus','message'=>'item not delete ']);
        }


     }
    } catch (Exception $e) {
        return response()->json(['status' => 0,'data' => $e ], 403);

    }

  }

    public function QtyAvailblecheck(){
        $id=2;//change this
        $user_add_item_one_by_one= app('db')->table('carts')->where('user_id',$id);


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
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function one_item_delete($id)
    {
        try{
        $delete_item = cart::findorfail($id);
        $delete_item->delete();
        return response()->json(['status' => 1,'data' => "Successfully Deleted"], 204);
        } catch (Exception $e) {return response()->json(['status' => 0,'data' => $e], 403);
        }
        }


}
