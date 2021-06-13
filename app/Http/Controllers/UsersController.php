<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Session;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use App\Group;
class UsersController extends Controller
{

//  public function __construct()
//  {
  //  $this->data['tab_menu'] = 'user_info';
//  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = User::all();
        return view('users.users', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $this->data['groups']   = Group::arrayForSelect();
       $this->data['mode']     = 'create';
       $this->data['headline'] = 'Add new User';
       return view('users.form', $this->data);

    }



    public function store(CreateUserRequest $request)
    {
        $data =  $request->all();
        if (User::create($data)) {
          Session::flash('message', 'User created Successfully!');
        }
        return redirect()->to('users');
    }

    public function show($id)
    {
      $this->data['user'] = User::find($id);
      $this->data['tab_menu'] = 'user_info';
      return view('users.show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['user']     = User::findOrFail($id);
        $this->data['groups']   = Group::arrayForSelect();
        $this->data['mode']     = 'edit';
        $this->data['headline'] ='Update Information of';
        return view('users.form',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data =$request->all();

        $user             = User::find($id);
        $user->group_id   = $data['group_id'];
        $user->name       = $data['name'];
        $user->email      = $data['email'];
        $user->phone      = $data['phone'];
        $user->address    = $data['address'];

        if($user->save())
        {
            Session::flash('message', 'User updated Successfully!');
        }
        return redirect()->to('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::find($id)->delete()) {
           Session::flash('message', 'User deleted Successfully!');
        }

          return redirect()->to('users');
    }
}
