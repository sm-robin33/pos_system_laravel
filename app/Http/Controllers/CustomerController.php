<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    public function index() {
        $data['customers'] = Customer::with('user.roles')->orderby('id', 'desc')->paginate(20);
        return view('admin.customer.list', $data);
      }
    
      
      public function create() {
        $data['customers'] = Customer::select('id', 'name')->orderby('name', 'asc')->get();
        return view('admin.customer.create', $data);
      }

    public function store(Request $request){

    $message = '<strong>Congratulations!!!</strong> Customer successfully';
    $rules = [
      'name' => 'required|string',
      'phone' => 'nullable|string',
      'email' => 'string|required',
      'address' => 'nullable|string',
      'password' => 'required|string|min:'. Customer::$minimumPasswordLength,
      'gender' => ['required', Rule::in(Customer::$genderArrays)],
      'status' => ['required', Rule::in(User::$statusArrays)],
    ];
    if ($request->has('id')) {
      $customer = Customer::find($request->id);
      $user = User::find($customer->user_id);
       $user1=auth()->user();
       $customer->updated_by=$user1->id;  
      $message = $message . ' updated';
    } else {
      $user = new User();
      $customer = new Customer();
       $user2=auth()->user();
       $customer->created_by=$user2->id;
      $message = $message . ' created';
    }
    $request->validate($rules);
    DB::beginTransaction();
    try {
      $user->name = $request->name;
      $user->email = $request->email;
      $user->phone = $request->phone;
      if ($request->password != null) {
        $user->password = bcrypt($request->password);
      }
      $user->status = strtolower($request->status);
      
      $role = Role::find(3);
      if ($user->save()) {
        if (isset($user->roles) && count($user->roles) > 0) {
          CustomHelper::removeUsersRole($user);
        }
        $user->assignRole($role);
        
        $customer->user_id = $user->id;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->password = $request->password;
        $customer->gender = strtolower($request->gender);
        $customer->status = strtolower($request->status);
        $customer->save();

        
        DB::commit();
        return RedirectHelper::routeSuccess('admin.customer.list', $message);
     }
      
      DB::rollBack();
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      DB::rollBack();
      return $e;
      return RedirectHelper::backWithInputFromException();
    }

 }

 public function manage ($id = null){
if($data['customers']=Customer::with('user.roles')->find($id)){
  $data['roles'] = Role::select('id', 'name')->orderby('name', 'asc')->get();
  return view('admin.customer.manage',$data);
}
return RedirectHelper::routeWarning('admin.customer.list', '<strong>Sorry!!!</strong> Customer not found');
 }

 public function destroy(Request $request) {
  $id = $request->post('id');
  try {
    $customer = Customer::find($id);
    if ($customer->delete()) {
      return 'success';
    }
  } catch (\Exception $e) {

  }
}


}