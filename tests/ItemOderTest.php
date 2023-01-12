<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ItemOderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_create_oderitem(){

        $OderItem=[
                "oder_tatal_price"=>1000,
                "address"=>'matara',
                "user_id"=>3
               ];

            $response=$this->post("/api/SaveItemOder",$OderItem);
            $response->assertResponseStatus(200);
    }
}

