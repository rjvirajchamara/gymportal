<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_create_item(){

        Storage::fake('local');
        $image = UploadedFile::fake()->create('avatar.jpg');

        $item=[
            "item_name"=>"apple",
            "qty"=>5,
            "price"=>5,
            "description"=>"hh",
            "img_upload1" => $image,

        ];

        $response=$this->post("api/ItemStore",$item);
        $response->assertResponseStatus(201);

    }
}


