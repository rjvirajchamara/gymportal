<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use App\Models\AdditionalServiceCar;
use App\Models\PurchaseAdditionalService;
use App\Models\PurchaseAdditionlServiceOder;

class PurchaseAdditionalServiceController extends Controller
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
    public function SavePurchaseAdditionalService(Request $request)
    {
        try{
            //$wallet=Http::get('https://')->json();

            $userData = $request->get('userData');
            $user_id = $userData['user_id'];

            $wallet=5000;
             $service_total_price=$request->service_total_price;
             if($wallet<=$service_total_price){
             $total_price=$request->service_total_price;

                 DB::beginTransaction();

                // $all_aty=$request->allaty;
              
                 $PurchaseAdditionalService=new PurchaseAdditionalService();
                 $PurchaseAdditionalService->user_id=$user_id;
                 $PurchaseAdditionalService->total_price=$total_price;
                 if($PurchaseAdditionalService->save()){



                 $get_services_id = app('db')->table('purchase_additional_services')->where('user_id',$user_id)->orderBy('id', 'desc')->first()->id;
                 $allservices = app('db')->table('additional_service_cars')->where('user_id',$user_id)->get();
                // dd($allservices);

                     foreach($allservices as $allservices_data){
                        $allservices_datas= new PurchaseAdditionlServiceOder();
                        $allservices_datas->oder_id=$get_services_id;
                        $allservices_datas->service_id=$allservices_data->service_id;
                        $allservices_datas->user_id=$allservices_data->user_id;
                        $allservices_datas->price=$allservices_data->total_price;

                        $allservices_datas->save();


                        $get_delete_cart_id = AdditionalServiceCar::where('service_id',$allservices_data->service_id)->where('user_id',$allservices_data->user_id)->value('id');
                       // dd($get_delete_cart_id);
                       // print_r($get_delete_cart_id);
                      // echo ' "p"';
                       AdditionalServiceCar::where('id',$get_delete_cart_id)->delete();

                 }
                 DB::commit();
                 return response()->json(['stutus','message'=>'Add sussessfully']);
                // }else{
                // return response()->json([['status' => 0,'data' =>  ], 403]);
                 }
                 }else{
             return response()->json(['stutus','message'=>'Please top up your wallet']);
            }

            } catch (Exception $e) {
             DB::rollBack();
            return response()->json(['status' => 0,'data' => $e ], 403);

         }

         }



    /**
     * Display the d resource.
     *
     * @param  \App\Models\PurchaseAdditionalService  $purchaseAdditionalService
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseAdditionalService $purchaseAdditionalService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseAdditionalService  $purchaseAdditionalService
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseAdditionalService $purchaseAdditionalService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseAdditionalService  $purchaseAdditionalService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseAdditionalService $purchaseAdditionalService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseAdditionalService  $purchaseAdditionalService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseAdditionalService $purchaseAdditionalService)
    {
        //
    }
}
