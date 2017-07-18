<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{

    public function index()
    {
        $user= User::paginate(2);
        return view('user-management.index',compact('user'));
    }
    public function create()
    {

        $user= new User();
        return view('user-management.create',compact('user'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|unique:users|max:255',
        'password' => 'required',
        'user_type' => 'required',
    ]);

        $input=$request->all();
        $input["password"] = Hash::make($input["password"]);
        User::create($input);
        $request->session()->flash('flash_message', 'User is successfully added!');
        return redirect('user-management/index');
    }
    public function delete($id,Request $request)
    {
        $user=User::findorfail($id);
        $user->delete();
        $request->session()->flash('flash_message', 'User deleted successfully!');

        return redirect('user-management/index');
    }
    public function edit($id)
    {
        $user=User::findorfail($id);
        return view('user-management.create',compact('user'));
    }
    public function update($id,Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'user_type' => 'required',
        ]);
        $input=$request->all();
        $user=User::findorfail($id);
        $input["password"] = Hash::make($input["password"]);
        $user->fill($input)->save();
        $request->session()->flash('flash_message', 'User updated successfully!');
        return redirect('user-management/index');
    }
    public function view($id)
    {
        $user=User::findorfail($id);
        return view('user-management.single-view',compact('user'));
    }
    public function search(Request $request)
    {
        $user = $request->get('Username');
        $user = User::where('name', 'LIKE', '%'.$user.'%')->paginate(2);
        return view('user-management.index', compact('user'));
    }



    }
