<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\item;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthenticateUser;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item_viwe()
    {
        $All_Item =app('db')->table('items')->get();

        $emptyArray = array();

        if($All_Item){
        return response()->json($All_Item );

        }elseif(!$All_Item ){
        return response()->json($emptyArray);
        }

       //return item::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function item_store(Request $request)
    {

        $this->validate($request,[

            'item_name' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'description' => 'required',
            'img_upload1' => 'required'
            ]);

        try{
           // dd($request);
            $item = new item();
            $item->item_name=$request->item_name;
            $item->qty=$request->qty;
            $item->price=$request->price;
            $item->description=$request->description;

            if($request->hasFile('img_upload1')){
                if ($request->file('img_upload1')->isValid()) {
                    $image_name = date('mdYHis') . uniqid() . $request->file('img_upload1')->getClientOriginalName();
                    $path = base_path() . '/public/images';
                    $request->file('img_upload1')->move($path,$image_name);
                    $images1="images/";
                    $img_upload = $images1.$image_name;
                }
            }
                    $item->Image=$img_upload;


            if($item->save()){
                return response()->json(['status' => 1,'data' => "Successfully Saved"], 201);

            }
        } catch (Exception $e) {
            return response()->json(['status' => 0,'data' => $e ], 403);

        }


     // }catch (\Exception $e) {
        //  return response()-join(['stutus','err' ,'message'=>$e->getMessage()]);
       //}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function itemSeach($id)
    {

       // $item = item::findorfail($id);
       try{

        $item_search_result = app('db')->table('items')->where('id',$id)->first();
        return response()->json($item_search_result);

      } catch (Exception $e) {
        return response()->json(['status' => 0,'data' => $e ], 403);

    }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function item_update(Request $request, $id)
    {
           // dd($request->all());
        try{
        $item = item::findorfail($id);
        $item->item_name=$request->item_name;
        $item->qty=$request->qty;
        $item->price=$request->price;
        $item->description=$request->description;

        if($request->hasFile('img_upload1')){
            if ($request->file('img_upload1')->isValid()) {
                $image_name = date('mdYHis') . uniqid() . $request->file('img_upload1')->getClientOriginalName();
                $path = base_path() . '/public/images';
                $request->file('img_upload1')->move($path,$image_name);
                $images1="images/";
                $img_upload = $images1.$image_name;
            }
        }
                $item->Image=$img_upload;


            $item->save();
            return response()->json(['status' => 1,'data' => "Successfully Updated"], 200);

    }catch (Exception $e) {
        return response()->json(['status' => 0,'data' => $e ], 403);

    }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function itemDelete($id)
    {
        try{
        $item = item::findorfail($id);

               $item->delete();
               return response()->json(['status' => 1,'data' => "Successfully Deleted"], 204);
                } catch (Exception $e) {return response()->json(['status' => 0,'data' => $e], 403);
                 }
                   }
}
