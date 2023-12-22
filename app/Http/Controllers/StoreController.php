<?php

namespace App\Http\Controllers;
use App\Helper\RedirectHelper;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function create_store(){
        return view('admin.store.create_store');
    }
    public function manage($id = null) {
        if ($data['store'] = Store::all()->find($id)) {
          //$data['roles'] = Role::select('id', 'name')->orderby('name', 'asc')->get();
          return view('admin.store.manage', $data);
          
        }
      }
    public function store_list(){
        $showData = Store::all();
        return view('admin.store.store_list', compact('showData'));
    }
    public function store_data(Request $request)
{
    auth()->user()->id;
    // Define validation rules
    $message = '<strong>Congratulations!!!</strong> Store successfully ';
    $rules = [
        'name' => 'required|max:20',
    ];

    // Validate the request data
    $this->validate($request, $rules);


    // for manage
    if ($request->has('id')) {
      $store = Store::find($request->id);
      $store->store_name = $request->name;
      $store->status = $request->status;
      $user=auth()->user();
      $store->updated_by=$user->name;
      $message = $message . ' updated';
      $store->save();
      return RedirectHelper::routeSuccess('admin.store.list', $message);
    } else {
    $store = new Store();
    $store->store_name = $request->name;
    $store->status = $request->status;
    $user=auth()->user();
    $store->created_by=$user->name;
    $store->save();
    $message = $message .  'created';
    return RedirectHelper::routeSuccess('admin.store.list', $message);
    }

}
public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $store = Store::find($id);
      if ($store->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
