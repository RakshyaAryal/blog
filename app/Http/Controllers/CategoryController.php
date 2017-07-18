<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 public function index()
 {
     $category= Category::all();
     return view('category.index',compact('category'));
 }
 public function create()
 {
     $category=new category();
     return view('category.create',compact('category'));
 }
 public function store(Request $request)
 {
     $this->validate($request, [
         'title' => 'required|unique:category|max:255',
     ]);
     $input=$request->all();
     Category::create($input);
     $request->session()->flash('flash_message', 'Category is successfully added!');
     return redirect('category/index');
 }
 public function delete($id,Request $request)
 {
     $category=Category::findorfail($id);
     $category->delete();
     $request->session()->flash('flash_message', 'Category deleted successfully!');

     return redirect('category/index');
 }
    public function edit($id)
    {
        $category=Category::findorfail($id);
        return view('category.create',compact('category'));
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input=$request->all();
        $category=Category::findorfail($id);
        $category->fill($input)->save();
        $request->session()->flash('flash_message', 'categories updated successfully!');
        return redirect('category/index');
    }
    public function view($id)
    {
        $category=Category::findorfail($id);
        return view('category.single-view',compact('category'));
    }

    public function ajaxSearch(Request $request)
    {
        $category = $request->get('cname');
        $category = Category::where('title', 'LIKE', '%' . $category . '%')->get();

        return view('category.search-result', compact('category'));


    }

}
