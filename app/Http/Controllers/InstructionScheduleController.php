<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\InstructionSchedule;

class InstructionScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Instruction_schedules_viwe(Request $request){

        $userData = $request->get('userData');
        $user_id = $userData['user_id'];


        $Instruction_schedules_viwe = InstructionSchedule::with(['libraries.libraries_icons'])
        ->where('user_id',$user_id)
         ->get()
         ->map(function($InstructionSchedule){
          return[
            'name' => $InstructionSchedule->libraries->name,
            'description'=>$InstructionSchedule->libraries->description,
            'count'=>$InstructionSchedule->libraries->count,
            'duration'=>$InstructionSchedule->libraries->duration,
            'libraries_icons'=>$InstructionSchedule->libraries->libraries_icons,

          ];

         }
        );

            $emptyArray = array();
            if ($Instruction_schedules_viwe ) {
           return response()->json(["ibraries_views"=>$Instruction_schedules_viwe ]);
           } else if (!$Instruction_schedules_viwe ) {
           return response()->json($emptyArray,);
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
    public function instruction_schedules(Request $request)
    {
        try{
        $this->validate($request,[

        'libraries_id' => 'required'

        ]);

        $userData = $request->get('userData');
        $user_id = $userData['user_id'];


         $instruction_schedules= new InstructionSchedule();
         $instruction_schedules->user_id=$user_id;
         $instruction_schedules->libraries_id=$request->libraries_id;
         $instruction_schedules->save();

         $instruction_schedules->save();

            return response()->json(['status' => 1,'data' => "Successfully Saved"], 201);

    } catch (Exception $e) {
        return response()->json(['status' => 0,'data' => $e ], 403);

    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstructionSchedule  $instructionSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(InstructionSchedule $instructionSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstructionSchedule  $instructionSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(InstructionSchedule $instructionSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstructionSchedule  $instructionSchedule
     * @return \Illuminate\Http\Response
     */
    public function Updateinstruction_schedule(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstructionSchedule  $instructionSchedule
     * @return \Illuminate\Http\Response
     */
    public function  Instruction_schedules_delete($id)
    {

        try{
            $InstructionSchedule = InstructionSchedule::findorfail($id);

            $InstructionSchedule->delete();
            return response()->json(['status' => 1,'data' => "Successfully Deleted"], 204);
            } catch (Exception $e) {return response()->json(['status' => 0,'data' => $e], 403);
             }
              }
               }

