<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::get();
        return view('add_user',$data);
        //print_r($data['users']);
    }
    public function store(Request $request)
    {
        // Validate the request...
        $user = new User;

        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->country = $request->country;

        $user->save();

        //return redirect('user');
        return json_encode(['status'=>200,'reason'=>'success','user'=>$user]);
    }

    public function edit(Request $request){
        $user_id = $request->id;
        $user = new User;
        $data['user'] = $user->find($user_id);

        return view('edit_user',$data);
    }

    public function update(Request $request){
        $user = User::find($request->user_id);
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->country = $request->country;

        $user->update();

        return json_encode(['status'=>200,'reason'=>'successfully updated','user'=>$user]);
    }

    public function delete(Request $request){
        $user_id = $request->user_id;
        $user = new User;
        $user = $user->find($user_id);
        $user->delete();

        return json_encode(['status'=>200,'reason'=>'successfully deleted','user'=>'']);
    }

    public function testGet(Request $request){
        print_r($request->all());
    }

    public function testPost(Request $request){
        print_r($request->all());
    }
}