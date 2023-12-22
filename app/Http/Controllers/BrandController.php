<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Contracts\Session\Session as Session;
//use Session;
class BrandController extends Controller
{
    public function create_brand(){
        return view('admin.brand.create_brand');
    }
    public function manage($id = null) {
        if ($data['brand'] = Brand::all()->find($id)) {
          //$data['roles'] = Role::select('id', 'name')->orderby('name', 'asc')->get();
          return view('admin.brand.manage', $data);
          
        }
      }
    public function brand_list(){
        $showData = Brand::all();
        return view('admin.brand.brand_list', compact('showData'));
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


    // for manage
    if ($request->has('id')) {
      $brand = Brand::find($request->id);
      $brand->name = $request->name;
      $user=auth()->user();
      $brand->updated_by=$user->name;
      $message = $message . ' updated';
      $brand->save();
      //session()->now('success', 'Data Successfully Updated.');
      //return redirect()->back()->with('success', 'Data Successfully Updated');
      //return redirect()->route('admin.brand.list')
        //->with('success', 'Brand Name Successfully Updated');
      //return redirect()->route('admin.brand.list');
      return RedirectHelper::routeSuccess('admin.brand.list', $message);
    } else {
    $brand = new Brand();
    $brand->name = $request->input('name');
    $user=auth()->user();
    $brand->created_by=$user->name;
    $brand->save();
    $message = $message .  'created';
    return RedirectHelper::routeSuccess('admin.brand.list', $message);
    }

}
public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $brand = Brand::find($id);
      if ($brand->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
