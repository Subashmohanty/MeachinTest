<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Products;

class ProductsController extends Controller
{
    public function productView(Request $request)
    {
        return view('product-view');
    }
    public function editProductSave(Request $request){
        $products = new Products;
        $id = $request->id;
        $file_names = $products->where('id',$id)->select('product_images')->first();
        $product_images = $file_names->product_images;
        $product_images = explode(',',$product_images);
        if ($request->hasFile('images')) {
            foreach($product_images as $key1){
                unlink(public_path('uploads/').$key1);
            }
            $file = $request->file('images');
            foreach($file as $key => $val){
            // dd($val);
                $file_name[] = time().$val->getClientOriginalName();
                $val->move(public_path('uploads/'),time().$val->getClientOriginalName());
            }
            $product_image = implode(',',$file_name);
            $result = $products->where('id',$id)->update(['product_name'=>$request->product_name,'product_description'=>$request->product_desc,'product_price'=>$request->product_price,'product_images'=>$product_image]);
        }else{
            $result = $products->where('id',$id)->update(['product_name'=>$request->product_name,'product_description'=>$request->product_desc,'product_price'=>$request->product_price]);
        }
        if($result){
            echo 'Datasave SuccessFull';
        }else{
            echo 'Datasave Filed';
        }
    }
    public function productSave(Request $request){
        $products = new Products;
        $products->product_name = $request->product_name;
        $products->product_description = $request->product_desc;
        $products->product_price = $request->product_price;
        $file = $request->file('images');
        foreach($file as $key => $val){
           // dd($val);
            $file_name[] = time().$val->getClientOriginalName();
            $val->move(public_path('uploads/'),time().$val->getClientOriginalName());
        }
        $products->product_images = implode(',',$file_name);
        if($products->save()){
            echo 'Datasave SuccessFull';
        }else{
            echo 'Datasave Filed';
        }
    }
    public function fetchProducts(){
        $products = new Products;
        $products = $products->get();
        return response()->json(['data' =>$products]);
    }
    public function deleteProduct(Request $request)
    {
        $file_names = Products::where('id',$request->id)->select('product_images')->first();
        if(!empty($file_names->product_images)){
            $product_images = $file_names->product_images;
            $product_images = explode(',',$product_images);
            foreach($product_images as $key1){
                unlink(public_path('uploads/').$key1);
            }
        }
        Products::find($request->id)->delete();
        echo 'SuccessFull';
    }
    public function fetchProductByid(Request $request){
        $products = Products::where('id',$request->id)->first();
        return response()->json($products);
    }
}
