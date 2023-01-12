<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ItemAddToCartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_item_add_to_cart(){

        $AddAdditionalserviceCart=[
                "item_id"=>2,
                "user_id"=>2,
                "qty"=>10,
                "price"=>100.00
               ];

            $response=$this->post("/api/AddCart",$AddAdditionalserviceCart);
            $response->assertResponseStatus(201);
    }


    public function test_can_item_update_to_cart(){

        $UpdateAdditionalserviceCart=[
                "item_id"=>2,
                "user_id"=>2,
                "qty"=>5,
                "price"=>100.00
               ];

            $response=$this->post("/api/AddCart",$UpdateAdditionalserviceCart);
            $response->assertResponseStatus(200);
    }
    public function test_can_item_delete_to_cart(){

        $DeleteAdditionalserviceCart=[
                "item_id"=>2,
                "user_id"=>2,
                "qty"=>0,
                "price"=>500
               ];

            $response=$this->post("/api/AddCart",$DeleteAdditionalserviceCart);
            $response->assertResponseStatus(202);
    }
}
