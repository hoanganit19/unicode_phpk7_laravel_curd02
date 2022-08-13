<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $title = 'Danh sách người dùng';

        return view('users.lists', compact(
            'title'
        ));
    }

    public function add(){
        $title = 'Thêm người dùng';

        $groups = Group::all();

        return view('users.add', compact(
            'title',
            'groups'
        ));
    }

    public function postAdd(UserRequest $request){
        $user = new User();

        $user->fill($request->all());

        $user->save();

        return redirect()->route('users.index')->with('msg', trans('message.add_msg'));
    }

    public function edit(User $user){
        //$user = User::find($id);
        dd($user);
    }

    public function postEdit(){

    }

    public function delete(){

    }
}
