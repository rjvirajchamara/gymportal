<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\additional_service;

class AdditionalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AdditionalServiceController_viwe()
    {
        $Additional_Services =additional_service::get();

        $emptyArray = array();

        if($Additional_Services){
        return response()->json($Additional_Services);

        }elseif(!$Additional_Services){
        return response()->json($emptyArray);
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
    public function AdditionalServiceController_store(Request $request)

    {

        $this->validate($request,[
            'service_name' =>'required',
            'img_upload1' =>'required',
            'description' =>'required',
            'price' =>'required',
            'duration' =>'required'


        ]);


       try{

        $additional_service = new additional_service();
            $additional_service ->service_name=$request->service_name;

            if($request->hasFile('img_upload1')){
                if ($request->file('img_upload1')->isValid()) {
                    $image_name = date('mdYHis') . uniqid() . $request->file('img_upload1')->getClientOriginalName();
                    $path = base_path() . '/public/images';
                    $request->file('img_upload1')->move($path,$image_name);
                    $images1="images/";
                    $img_upload = $images1.$image_name;
                }
            }

            $additional_service ->service_photo=$img_upload;// Modified upon request
            $additional_service ->description=$request->description;
            $additional_service ->Price=$request->price;
            $additional_service ->duration=$request->duration;
            $additional_service->save();

            return response()->json(['status' => 1,'data' => "Successfully Saved"], 201);
           } catch (Exception $e) {
            return response()->json(['status' => 0,'data' => $e ], 403);
           }
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\additional_service  $additional_service
     * @return \Illuminate\Http\Response
     */
    public function SeachService($id)
    {
        try{
        $Seach_Service = app('db')->table('additional_services')->where('id',$id)->first();
        return response()->json($Seach_Service);

    } catch (Exception $e) {
        return response()->json(['status' => 0,'data' => $e ], 403);

    }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\additional_service  $additional_service
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id )
    {


    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\additional_service  $additional_service
     * @return \Illuminate\Http\Response
     */
    public function AdditionalServiceController_update(Request $request, $id)
    {
        try{
        $additional_service = additional_service::findorfail($id);

            $additional_service ->service_name=$request->service_name;

            if($request->hasFile('img_upload1')){
                if ($request->file('img_upload1')->isValid()) {
                    $image_name = date('mdYHis') . uniqid() . $request->file('img_upload1')->getClientOriginalName();
                    $path = base_path() . '/public/images';
                    $request->file('img_upload1')->move($path,$image_name);
                    $images1="images/";
                    $img_upload = $images1.$image_name;
                }
            }

            $additional_service ->service_photo=$img_upload;


            $additional_service ->description=$request->descriptione;
            $additional_service ->Price=$request->price;
            $additional_service ->duration=$request->duration;

            $additional_service->save();
            return response()->json(['status' => 1,'data' => "Successfully Updated"], 200);
            } catch (Exception $e) {
            return response()->json(['status' => 0,'data' => $e ], 403);
            }
          }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\additional_service  $additional_service
     * @return \Illuminate\Http\Response
     */
    public function AdditionalServiceControllerDelete($id)
    {
        try{
        $additional_service = additional_service::findorfail($id);

        $additional_service->delete();

        return response()->json(['status' => 1,'data' => "Successfully Deleted"], 204);

        } catch (Exception $e) {return response()->json(['status' => 0,'data' => $e], 403);
         }
          }
           }




