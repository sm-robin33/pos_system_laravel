<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\DiscountPolicy;
use Illuminate\Http\Request;

class DiscountPolicyController extends Controller
{
    public function create_discount(){
        $showData = DiscountPolicy::all();
        return view('admin.discount.create_discount_policy', compact('showData'));
    }
    public function manage($id = null) {
        if ($data['discount'] = DiscountPolicy::all()->find($id)) {
          return view('admin.discount.manage', $data);
          
        }
      }
    public function discount_list(){
        $showData = DiscountPolicy::all();
        return view('admin.discount.discount_policy_list', compact('showData'));
    }
    public function store_data(Request $request)
{
    //auth()->user()->id;
    // Define validation rules
    $message = '<strong>Congratulations!!!</strong> Discount Policy successfully ';
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
      $discountpolicy = DiscountPolicy::find($request->id);
      $discountpolicy->policy_name = $request->name;
      $discountpolicy->disc_amount = $request->amount;
      $discountpolicy->start_date = $request->sdate;
      $discountpolicy->end_date = $request->edate;
      
      $user=auth()->user();
      $discountpolicy->updated_by=$user->name;
      $message = $message . ' updated';
      $discountpolicy->save();
      //session()->now('success', 'Data Successfully Updated.');
      //return redirect()->back()->with('success', 'Data Successfully Updated');
        return RedirectHelper::routeSuccess('admin.discount.list', $message);
      //return redirect()->route('admin.brand.list');
    } else {
    $discountpolicy = new DiscountPolicy();
    $discountpolicy->policy_name = $request->input('name');
    $discountpolicy->disc_amount = $request->input('amount');
    $discountpolicy->start_date = $request->input('sdate');
    $discountpolicy->end_date = $request->input('edate');
    //$discountpolicy->category = $request->parent;
    $user=auth()->user();
    $discountpolicy->created_by=$user->name;
    $discountpolicy->save();
    $message = $message . ' created';
    return RedirectHelper::routeSuccess('admin.discount.list', $message);
    }

}
public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $discount = DiscountPolicy::find($id);
      if ($discount->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
