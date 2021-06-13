<?php

namespace App\Http\Controllers;
use Illuminate\support\Facades\Session;
use Illuminate\Http\Request;
use App\Group;

class UserGroupsController extends Controller
{
    public function index()
    {
      $this->data['Groups'] = Group::all();
      return view('groups.groups',$this->data);
    }


  //insert..............................
    public function create()
    {
      return view('groups.create');
    }


    public function store(Request $request)
    {
      $formData = $request->all();

      if (Group::create($formData)) {
        Session::flash('message', 'Group created Successfully!');
      }
      return redirect()->to('groups');
    }


    //delete.........................

    public function destroy($id)
    {
      if( Group::find($id)->delete())
      {
          Session::flash('message', 'Group deleted Successfully!');
      }
      return redirect()->to('groups');
    }

}
