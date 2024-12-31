<?php
//
//use App\Models\Category;
//use App\Models\ParentCategory;
//use App\Models\User;
//
//it('tests the home route', function () {
//    $response = $this->get('/');
//    $response->assertStatus(200);
//});
//
//
//it('tests the register user', function(){
//   $response = $this->post('/api/register',[
//       'name'=>'John Doe',
//       'email'=>'johndoe1@ex.com',
//       'password'=>'password',
//       'password_confirmation'=>'password'
//       ]);
//   $response->assertStatus(201);
//   $response->assertJson([
//        'message' => 'User created successfully',
//   ]);
//});
//
//
//it('tests login route',function(){
//
//     User::factory()->create([
//        'email' => 'johndoe1@ex.com',
//        'password' => bcrypt('johndoe1'),
//    ]);
//    $response = $this->post('/api/login',[
//        'email' => 'johndoe1@ex.com',
//        'password' => 'johndoe1',
//    ]);
//
//
//    $response->assertStatus(200);
//    $response->assertJson([
//        'message'=>'Successfully logged in'
//    ]);
//});
//
//it('tests create category route', function(){
//
//    $user = User::factory()->create([
//        'email' => 'johndoe1@ex.com',
//        'password' => bcrypt('johndoe1'),
//    ]);
//
//    Category::create([
//    'type'=>'Expense'
//]);
//
//    $response = $this->actingAs($user)
//    ->post('/api/category/create',[
////        'user_id'=>1,
//        'type'=>'Expense',
//        'parent_category_id'=>1,
//        'name'=>'rent',
//        'description'=>'Rental Expense',
//        'image_url'=>'rentalexpense.jpg',
//    ]);
//
//    $response->assertStatus(201);
//    $response->assertJson([
//        'message'=>'Category saved Successfully'
//    ]);
//});
