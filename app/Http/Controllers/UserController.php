<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    const _PER_PAGE = 10;

    private $groups;

    public function __construct()
    {
        $this->groups = Group::orderBy('name', 'ASC')->get();
    }

    public function index(Request $request){
        $title = 'Danh sách người dùng';

        $groups = $this->groups;

        $users = User::latest();

        //Xử lý lọc
        $wheres = [];

        if ($request->status && $request->status!=='all'){
            $status = $request->status=='active'?1:0;

            $wheres[] = ['status', $status];
        }

        if ($request->group_id){
            $groupId = $request->group_id;
            $wheres[] = ['group_id', $groupId];
        }

        if ($request->keyword){
            $keywords = $request->keyword;

            $users->where(function($query) use ($keywords){
                $query->orWhere('name', 'like', '%'.$keywords.'%');
                $query->orWhere('email', 'like', '%'.$keywords.'%');
                $query->orWhere('phone', 'like', '%'.$keywords.'%');
            });
        }

        if (!empty($wheres)){
            $users->where($wheres);
        }

        $users = $users->paginate(self::_PER_PAGE);

        return view('users.lists', compact(
            'title',
            'users',
            'groups'
        ));
    }

    public function add(){
        $title = 'Thêm người dùng';

        $groups = $this->groups;

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

        $title = 'Cập nhật người dùng';

        $groups = $this->groups;

        return view('users.edit', compact(
            'title',
            'user',
            'groups'
        ));

    }

    public function postEdit(User $user, UserRequest $request){
        $user->fill($request->all());
        $user->save();
        return redirect()->route('users.edit', $user->id)->with('msg', trans('message.update_msg'));
    }

    public function delete($id){
        User::destroy($id);
        return redirect()->route('users.index')->with('msg', trans('message.delete_msg'));
    }
}
