<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AdditionServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_additionalservice_add_to_cart(){

        $AddAdditionalserviceCart=[
                "service_id"=>1,
                "user_id"=>1,
                "total_price"=>100.00
               ];

            $response=$this->post("/api/AddAdditionalserviceCart",$AddAdditionalserviceCart);
            $response->assertResponseStatus(201);
    }

    public function test_can_additionalservice_delete_to_cart(){

             $id=51;

            $response=$this->delete("/api/DeleteAdditionalserviceCart/$id");
            $response->assertResponseStatus(202);
    }
}
