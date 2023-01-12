<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\AdditionalServiceCar;
use Response;



class AdditionalServiceCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViweCart(Request $request){

        $userData = $request->get('userData');
        $userId = $userData['user_id'];

        $ViweServiceCount=$this-> ViweServiceCount($userId);
        $Total_price=$this->Total_price($userId);


        $id=$userId;
        $additional_service_cars= app('db')->table('additional_service_cars')

        //->join('additional_service_cars', 'user_ones.id', '=', 'additional_service_cars.user_id')
        ->join('additional_services', 'additional_service_cars.service_id', '=', 'additional_services.id')

         ->select('additional_services.service_name','additional_services.service_photo' ,'additional_services.description',
         'additional_services.duration','additional_service_cars.total_price')

         ->where('user_id',$id)
          ->get();

        $emptyArray = array();


        if ($additional_service_cars) {
            return response()->json(["ViweCart"=>$additional_service_cars,"ViweServiceCount"=>$ViweServiceCount,"TotalPrice"=>$Total_price]);
        } else if (!$ViweServiceCount) {
            return ($emptyArray);
        }

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
    public function AddCart(Request $request)
    {
        $this->validate($request,[
            'service_id' =>'required',
            'total_price' =>'required'
          ]);

         try{

        $userData = $request->get('userData');
        $user_id = $userData['user_id'];

        $additional_service = new AdditionalServiceCar();
        $additional_service->service_id=$request->service_id;
        $additional_service->user_id=$user_id;
        $additional_service->total_price=$request->total_price;
        $additional_service->type=1;

        if($additional_service->save()){
        return response()->json(['status' => 1, 'data' => " add to card sussessfully"], 201);
        }
        } catch (Exception $e) {
        return response()->json(['status' => 0,'data' => $e ], 403);

    }

}


    public function ViweServiceCount($userId){

    $ViweProductCount= app('db')->table('additional_service_cars')->where('user_id',$userId)->count('user_id');
    $empty =0;


    if ($ViweProductCount) {
    return response()->json($ViweProductCount);
    } else if (!$ViweProductCount) {
        return response()->json($empty);

    }
}

    public function Total_price($userId){

        $Total_price= app('db')->table('additional_service_cars')->where('user_id',$userId)->sum('total_price');
        $empty =0;
        //dd($Total_price);
       if ($Total_price) {
        return response()->json($Total_price);
        } else if (!$Total_price) {
            return response()->json($empty);
        }

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalServiceCar  $additionalServiceCar
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalServiceCar $additionalServiceCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalServiceCar  $additionalServiceCar
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalServiceCar $additionalServiceCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdditionalServiceCar  $additionalServiceCar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdditionalServiceCar $additionalServiceCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalServiceCar  $additionalServiceCar
     * @return \Illuminate\Http\Response
     */
    public function DeleteserviceCart($id){

        try {
        $AdditionalServiceCar = AdditionalServiceCar::findorfail($id);

        $AdditionalServiceCar->delete();

        return response()->json(['status' => 1,'data' => "Successfully Deleted"], 202);

       } catch (Exception $e) {return response()->json(['status' => 0,'data' => $e], 403);
          }
           }
            }

