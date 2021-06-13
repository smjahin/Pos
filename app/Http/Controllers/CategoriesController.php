<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryRequest;
use Illuminate\support\Facades\Session;
use Illuminate\Http\Request;
use App\Category;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = Category::all();
        return view('category.categories', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->data['headline'] = 'Add New Categories';
      $this->data['mode'] = 'Create';

      return view('category.form',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
      $data =  $request->all();
      if (Category::create($data)) {
        Session::flash('message', $data['title'].' Category created Successfully!');
      }
      return redirect()->to('categories');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['category'] = Category::findOrFail($id);
        $this->data['mode']     = 'edit';
        $this->data['headline'] ='Update Information of';
        return view('category.form',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data              =$request->all();
        $category          = Category::find($id);
        $category->title   = $data['title'];

        if($category->save())
        {
            Session::flash('message', 'Category updated Successfully!');
        }
        return redirect()->to('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          if (Category::find($id)->delete()) {
             Session::flash('message', 'Category deleted Successfully!');
          }

            return redirect()->to('categories');
      }
    
}
