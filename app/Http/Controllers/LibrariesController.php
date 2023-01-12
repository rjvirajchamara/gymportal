<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\libraries;

use Illuminate\Http\Request;
use App\Models\libraries_icon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class LibrariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Libraries_views()
    {

        $libraries_views = libraries::with(['libraries_icons'])->get();

         $emptyArray = array();

         if ($libraries_views) {
             return response()->json(["ibraries_views"=>$libraries_views]);
         } else if (!$libraries_views) {
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
    public function LibrariesStore(Request $request){

         $this->validate($request,[

           'name' => 'required',
           'description' => 'required',
           'count' => 'required',
           'duration' => 'required',
           'galley_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048'
    ]);
        try{
        DB::beginTransaction();

         $libraries = new libraries();
         $libraries->name=$request->name;
         $libraries->description=$request->description;
         $libraries->count=$request->count;
         $libraries->duration=$request->duration;

         $libraries->save();

         $ibrsries_id = DB::table('libraries')->select('id')->orderBy('id', 'desc')->first()->id;

         $images=$request->galley_images;


         foreach($images as $libraries_icon) {
            $galleries = $libraries_icon;

            $g_file_name = $galleries ->getClientOriginalName();
            $g_file = $galleries ;
            $g_file->move("assets/img/", $g_file_name);



             $libraries_icon = new libraries_icon();
             $libraries_icon->images=$g_file_name ;
             $libraries_icon->libraries_id=$ibrsries_id;
             $libraries_icon->save();
         }


         DB::commit();
         return response()->json(['status' => 1, 'data' => "Successfully add"], 200);
         } catch (Exception $e) {
         DB::rollBack();
         return response()->json(['status' => 0,'data' => $e ], 403);


    }
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function show(libraries $libraries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function edit(libraries $libraries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function UpdateIbrarie(Request $request,$id){

        try{

        DB::beginTransaction();
        $libraries = libraries::findorfail($id);
        $libraries->name=$request->name;
        $libraries->description=$request->description;
        $libraries->count=$request->count;
        $libraries->duration=$request->duration;
        $libraries->save();


       $libraries_ids=$request->libraries_icon_id;

             foreach($libraries_ids as $libraries_icon_update) {

              $galleries = $libraries_icon_update['images'];

               $all_libraries_icon=libraries_icon::where('id',$libraries_icon_update['id'])->first();

              $g_file_name = $galleries ->getClientOriginalName();
              $g_file = $galleries ;
              $g_file->move("assets/img/", $g_file_name);

             $img_upload=$g_file_name;
             $all_libraries_icon->images=$img_upload;
             $all_libraries_icon->update();
       }
       DB::commit();
       return response()->json(['status' => 1, 'data' => "UpdateIbrarie updated "], 200);
       } catch (Exception $e) {
       DB::rollBack();
       return response()->json(['status' => 0,'data' => $e ], 403);
       }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function Deletelibrarie($id){

           try{
           DB::beginTransaction();
           $delete_libraries = libraries::findorfail($id);

           $libraries_id = libraries_icon::where('libraries_id',$id)->pluck('id');


         // $libraries_date = libraries_icon::where('libraries_id',$id)->get();


           foreach($libraries_id as $libraries_date ){

                $libraries_ids = libraries_icon::findorfail($libraries_date);

                $libraries_ids->delete();

           }

            $delete_libraries->delete();
            DB::commit();
           return response()->json(['status' => 1,'data' => "Successfully Deleted"], 204);
         } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 0,'data' => $e ], 403);

        }

    }
}
