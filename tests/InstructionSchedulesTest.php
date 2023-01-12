<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class InstructionSchedulesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_create_instruction_schedules(){

    $InstructionSchedules=[
            "user_id"=>1,
            "libraries_id"=>9,
           ];

        $response=$this->post("/api/Instruction_schedules",$InstructionSchedules);
        $response->assertResponseStatus(201);
}
}
