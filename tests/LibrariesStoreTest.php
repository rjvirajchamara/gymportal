<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LibrariesStoreTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_create_librariesstore(){



        $LibrariesStore=[
            "name"=>"Push_ups",
            "description"=>"If done correctly, the push-up can strengthen the chest, shoulders, triceps, and even the core trunk muscles, all at one time",
            "count"=>5,
            "duration"=>23


        ];

        $response=$this->post("api/LibrariesStore",$LibrariesStore);
        $response->assertResponseStatus(201);

    }
}
