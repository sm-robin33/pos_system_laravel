<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\SubCategories;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function create_subcategories(){
        $showData = Category::all();
        return view('admin.subcategories.create_subcategories', compact('showData'));
    }
    public function manage($id = null) {
        if ($data['subcategories'] = SubCategories::all()->find($id)) {
          $data['subcat'] = Category::select('id', 'name')->get();
          return view('admin.subcategories.manage', $data);
          
        }
      }
    public function subcategories_list(){
        $showData = SubCategories::all();
        return view('admin.subcategories.subcategories_list', compact('showData'));
    }
    public function store_data(Request $request)
{
    //auth()->user()->id;
    // Define validation rules
    $message = '<strong>Congratulations!!!</strong> Sub-Category successfully ';
    $rules = [
        'name' => 'required|max:20',
    ];

    // Validate the request data
    $this->validate($request, $rules);



    // for manage
    if ($request->has('id')) {
      $subcategories = SubCategories::find($request->id);
      $subcategories->name = $request->name;
      $subcategories->category = $request->parent;
      $user=auth()->user();
      $subcategories->updated_by=$user->name;
      $message = $message . ' updated';
      $subcategories->save();
      //session()->now('success', 'Data Successfully Updated.');
      //return redirect()->back()->with('success', 'Data Successfully Updated');
      return RedirectHelper::routeSuccess('admin.sub-categories.list', $message);
    } else {
    $subcategories = new SubCategories();
    $subcategories->name = $request->input('name');
    $subcategories->category = $request->parent;
    $user=auth()->user();
    $subcategories->created_by=$user->name;
    $subcategories->save();
    $message = $message . ' created';
    return RedirectHelper::routeSuccess('admin.sub-categories.list', $message);
    }

}
public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $sub_categories = SubCategories::find($id);
      if ($sub_categories->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
