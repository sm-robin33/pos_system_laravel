<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;

class MeasurementController extends Controller
{
    //
    public function index(){
        $data['measurements'] =Measurement::all();
        return view('admin.measurement.list',$data);
    }

    public function create(){
        $data['measurements'] = Measurement::select('id', 'name')->orderby('name', 'asc')->get();
        return view('admin.measurement.create', $data);
    }

    public function store(Request $request){
    $message = '<strong>Congratulations!!!</strong> Measurement successfully';
    $rules = [
      'name' => 'required|string',
      'status' => ['required', ValidationRule::in(Measurement::$statusArrays)],
    ];
    if ($request->has('id')) {
      $measurement = Measurement::find($request->id);
      $user1=auth()->user();
      $measurement->updated_by=$user1->id;  
      $message = $message . ' updated';
    } else {
      $measurement = new Measurement();
      $user=auth()->user();
      $measurement->created_by=$user->id;
      $message = $message . ' created';
    }
    $request->validate($rules);
    DB::beginTransaction();
    try {
      $measurement->name = $request->name;
      $measurement->status = strtolower($request->status);
      $measurement->save();   
      DB::commit();
      return RedirectHelper::routeSuccess('admin.measurement.list', $message);
      
      DB::rollBack();
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      DB::rollBack();
      return $e;
      return RedirectHelper::backWithInputFromException();
    }

 }

 public function manage($id=NULL){
   if($data['measurements']=Measurement::all()->find($id)){
    return view('admin.measurement.manage', $data);

   }

    return RedirectHelper::routeWarning('admin.measurement.list', '<strong>Sorry!!!</strong> Customer not found');
 }

 public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $measurement = Measurement::find($id);
      if ($measurement->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
  
    }
  }
}
