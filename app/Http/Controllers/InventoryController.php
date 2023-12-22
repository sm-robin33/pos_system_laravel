<?php

namespace App\Http\Controllers;
use App\Helper\RedirectHelper;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function create_inventory(){
        $showData = Inventory::all();
        $category = Category::all();
        $brand = Brand::all();
        $store = Store::all();
        $product = Product::all();
        return view('admin.inventory.create_inventory', compact('showData','category','brand','store','product'));
    }
    public function manage($id = null) {
        if ($data['categories'] = Inventory::all()->find($id)) {
          $data['cat'] = Inventory::select('id', 'name')->get();
          return view('admin.categories.manage', $data);
          
        }
      }
    public function inventory_list(){
        $showData = Inventory::all();
        return view('admin.inventory.inventory_list', compact('showData'));
    }
    
    public function store(Request $request)
{


  

    // //auth()->user()->id;
    // // Define validation rules
    // $message = '<strong>Congratulations!!!</strong> Inventory successfully';
    // $rules = [
    //     'name' => 'required|max:20',
    // ];

    // // Validate the request data
    // $request->validate($rules);

    // // Create a new Brand instance and assign the name
    // // $brand = new Brand();
    // // $brand->name = $request->input('name');
    // // $user=auth()->user();
    
    // // $brand->created_by=$user->name;
    
    // // Save the Brand instance to the database
    // // $brand->save();


    // // for manage
    // // if ($request->has('id')) {
    // //   $inventory = Inventory::find($request->id);
    // //   $inventory->name = $request->name;
    // //   $inventory->parent = $request->parent;
    // //   $user=auth()->user();
    // //   $inventory->updated_by=$user->name;
    // //   $message = $message . ' updated';
    // //   $inventory->save();
    // //   //session()->now('success', 'Data Successfully Updated.');
    // //   //return redirect()->back()->with('success', 'Data Successfully Updated');
    // //   return redirect()->route('admin.inventory.list')
    // //     ->with('success', 'Categories Name Successfully Updated');
    // //   //return redirect()->route('admin.brand.list');
    // // } else {
    // $inventory = new Inventory();
    // $inventory->product_id = $request->product;
    // $inventory->category_id = $request->category;
    // $inventory->brand_id = $request->brand;
    // $inventory->store_id = $request->store;
    // $inventory->quantity = $request->quantity;
    // $inventory->status = $request->status;
    // $user=auth()->user();
    // $inventory->created_by=$user->name;
    // $message = $message . ' Created';
    // $inventory->save();
    // // return redirect()->route('admin.inventory.list')
    // // ->with('success', 'Inventory Name Successfully Added');
    // return RedirectHelper::routeSuccess('admin.inventory.list', $message);
    // // }

}

public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $inventory = Inventory::find($id);
      if ($inventory->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
