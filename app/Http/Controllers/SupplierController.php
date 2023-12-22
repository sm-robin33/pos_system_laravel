<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Brand;

class SupplierController extends Controller
{
    public function create_supplier(){
        $showData = Supplier::all();
        $brand = Brand::all();
        return view('admin.supplier.create_supplier', compact('showData','brand'));
    }
    public function manage($id = null) {
        if ($data['supplier'] = Supplier::all()->find($id)) {
          $data['brand'] = Brand::select('id', 'name')->get();
          return view('admin.supplier.manage', $data);
          
        }
      }
    public function supplier_list(){
        $showData = Supplier::all();
        $brand = Brand::all();
        return view('admin.supplier.supplier_list', compact('showData','brand'));
    }
    public function store_data(Request $request)
{
    //auth()->user()->id;
    // Define validation rules
    $message = '<strong>Congratulations!!!</strong> Supplier successfully ';
    $rules = [
        'name' => 'required|max:20',
        'phone'=>'nullable|string'
    ];

    // Validate the request data
    $this->validate($request, $rules);



    // for manage
    if ($request->has('id')) {
      $supplier = Supplier::find($request->id);
      $supplier->supplier_name = $request->name;
      $supplier->phone = $request->phone;
      $supplier->email = $request->email;
      $supplier->address = $request->address;
      $supplier->brand_id = $request->brand_id;
      $supplier->status = $request->status;
      $user=auth()->user();
      $supplier->updated_by=$user->name;
      $message = $message . ' updated';
      $supplier->save();
      //session()->now('success', 'Data Successfully Updated.');
      //return redirect()->back()->with('success', 'Data Successfully Updated');
      return RedirectHelper::routeSuccess('admin.supplier.list', $message);
    } else {
    $supplier = new Supplier();
    $supplier->supplier_name = $request->name;
    $supplier->phone = $request->phone;
    $supplier->email = $request->email;
    $supplier->address = $request->address;
    $supplier->brand_id = $request->brand_id;
    $supplier->status = $request->status;
    $user=auth()->user();
    $supplier->created_by=$user->name;
    $supplier->save();
    $message = $message . ' created';
    return RedirectHelper::routeSuccess('admin.supplier.list', $message);
    }

}
public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $supplier = Supplier::find($id);
      if ($supplier->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
