<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create_categories(){
        $showData = Category::all();
        return view('admin.categories.create_categories', compact('showData'));
    }
    public function manage($id = null) {
        if ($data['categories'] = Category::all()->find($id)) {
          $data['cat'] = Category::select('id', 'name')->get();
          return view('admin.categories.manage', $data);
          
        }
      }
    public function categories_list(){
        $showData = Category::all();
        return view('admin.categories.categories_list', compact('showData'));
    }
    public function store_data(Request $request)
{
    auth()->user()->id;
    // Define validation rules
    $message = '<strong>Congratulations!!!</strong> Brand successfully ';
    $rules = [
        'name' => 'required|max:20',
    ];

    // Validate the request data
    $this->validate($request, $rules);

    // Create a new Brand instance and assign the name
    // $brand = new Brand();
    // $brand->name = $request->input('name');
    // $user=auth()->user();
    
    // $brand->created_by=$user->name;
    
    // Save the Brand instance to the database
    // $brand->save();


    // for manage
    if ($request->has('id')) {
      $categories = Category::find($request->id);
      $categories->name = $request->name;
      $categories->parent = $request->parent;
      $user=auth()->user();
      $categories->updated_by=$user->name;
      //$message = $message . ' updated';
      $categories->save();
      $message = $message .  'updated';
      return RedirectHelper::routeSuccess('admin.categories.list', $message);
    } else {
    $categories = new Category();
    $categories->name = $request->input('name');
    $categories->parent = $request->parent;
    $user=auth()->user();
    $categories->created_by=$user->name;
    $categories->save();
    $message = $message .  'created';
    return RedirectHelper::routeSuccess('admin.categories.list', $message);

    }

}
public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $categories = Category::find($id);
      if ($categories->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
