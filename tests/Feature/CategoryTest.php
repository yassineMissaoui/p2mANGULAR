<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $category= new Category(['title'=>'1','description'=>'1']);
        $this->assertEquals('1',$category->title);
        $this->assertEquals('1',$category->description);
    }
    public function test_show_category()
    {
        $this->get('api/category')
        ->assertStatus(200)  ;}
    public function test_create_category(){
        $response = $this->postJson('/api/category', ['title' => 'Sally','description'=>'gg']);

        $response
            ->assertStatus(200);

    }
    //
    public function test_update_category(){
        $category=['title'=>'jihene','description'=>'jihene@gmail.com'];
        $this->json('PUT','api/category/5',$category,['Accept'=>'application/json'] )->assertStatus(200);
    }

    public function test_destroy_category (){

        $this->json('DELETE','api/category/6',['Accept'=>'application/json'] )->assertStatus(200);
    }
    public function test_get_by_id_category(){
        $this->get('api/category/8')
        ->assertStatus(200)  ;
    }
    }

