<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Brand;
use App\Models\Category;
use App\Models\DiscountPolicy;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\ProductHasPrice;
use App\Models\SubCategories;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Helper\CustomHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;

class ProductController extends Controller
{
    public function index() {
        $data['products'] = Product::all();
         return view('admin.product.list', $data);
      }

      public function create() {
        $data['products'] = Product::select('id', 'name')->orderby('name', 'asc')->get();
        $data['brands'] = Brand::select('id', 'name')->orderby('name', 'asc')->get();
        $data['category'] = Category::select('id', 'name')->orderby('name', 'asc')->get();
        $data['sub_category'] = SubCategories::select('id', 'name')->orderby('name', 'asc')->get();
        $data['measurement_purchase'] = Measurement::select('id', 'name')->orderby('name', 'asc')->get();
        $data['measurement_sale'] = Measurement::select('id', 'name')->orderby('name', 'asc')->get();
        $data['discount_amount'] = DiscountPolicy::select('id', 'disc_amount')->orderby('disc_amount', 'asc')->get();;

        return view('admin.product.create', $data);
      }

      public function store(Request $request){

        $message = '<strong>Congratulations!!!</strong> Customer successfully';
        $rules = [
          'name' => 'required|string',
          'brand_id' => 'required|string',
          'barcode' => 'string|nullable',
          'category_id' => 'required|string',
          'subcategory_id' => 'required|string',
          'product_image' => 'nullable|mimes:png,jpg,jpeg',
          'measure_purchase_id' => 'required|string',
          'measure_sale_id' => 'required|string',
          'discount_id' => 'nullable|string',
          'status' => ['required',ValidationRule::in(Product::$statusArrays)],
        ];
        if ($request->has('id')) {
          $product = Product::find($request->id);
           $user1=auth()->user();
           $product->updated_by=$user1->id;  
          $message = $message . ' updated';
        } else {
          $product = new Product();
           $user2=auth()->user();
           $product->created_by=$user2->id;
          $message = $message . ' created';
        }
        $request->validate($rules);
        DB::beginTransaction();
        try {     
            $product->name = $request->name;
            $product->brand_id = $request->brand_id;
            $product->barcode = $request->barcode;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
          //   if ($request->hasFile('product_image')) {
          //     $imagePath = $request->file('product_image')->store('product_images', 'public');
          //     $product->product_image = $imagePath; // Update the product's image

          // }
            $product->measure_purchase_id = $request->measure_purchase_id;
            $product->measure_sale_id = $request->measure_sale_id;
            $product->discount_id = $request->discount_id;
            //$product->price = $request->price;
            $product->status = strtolower($request->status);
            

            $oldImage = $product->product_image;
            if ($request->hasFile('product_image')) {

                $logo = CustomHelper::storeImage($request->file('product_image'), '/products/');
                if ($logo != false) {
                    $product->product_image = $logo;
                }
            }
            
            //$product->save();
            if ($product->save()) {

              $price = $request->price;

              // Check if a price record for the product already exists
              $existingPrice = ProductHasPrice::where('product_id', $product->id)->first();
          
              if ($existingPrice) {
                  // If a price record exists, update it
                  $existingPrice->update(['price' => $price]);
              } else {
                  // If no price record exists, create a new one
                  ProductHasPrice::create([
                      'product_id' => $product->id,
                      'price' => $price,
                  ]);
              }
          }
            
            DB::commit();
            return RedirectHelper::routeSuccess('admin.product.list', $message);
          
          DB::rollBack();
          return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
          DB::rollBack();
          return $e;
          return RedirectHelper::backWithInputFromException();
        }
    
     }
}
