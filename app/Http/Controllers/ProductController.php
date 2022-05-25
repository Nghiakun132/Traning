<?php
/*
Decription fuctions:
* @copyright Copyright (c) 2022 Rivercrane. All rights reserved
* @author    Bui Huu Nghia <bui.nghia.rcvn2012@gmail.com>
* @version   1.0
*/

namespace App\Http\Controllers;

use App\Models\mst_products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Date;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *param none
     *return view
     *author Bui.Nghia
     *lastest update: 24/05/2020 by Bui.Nghia
     */
    public function index()
    {
        $products = mst_products::orderBy('created_at', 'desc')->get();
        return view('product.index', compact('products'));
    }
    public function create()
    {
        return view('product.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|integer|not_in:0',
            'status' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.integer' => 'Giá sản phẩm phải là số nguyên',
            'price.not_in' => 'Giá sản phẩm không được để trống',
            'status.required' => 'Trạng thái sản phẩm không được để trống',
            'images.image' => 'Hình ảnh sản phẩm không đúng định dạng',
            'images.mimes' => 'Hình ảnh sản phẩm không đúng định dạng',
            'images.max' => 'Hình ảnh sản phẩm không được quá 1MB',
        ]);
        $name = $request->name;
        $price = $request->price;
        $status = $request->status;
        $images = $request->images;
        $firstCharProduct = mb_substr($name, 0, 1);
        $id = IdGenerator::generate(['table' => 'mst_products', 'field' => 'product_id', 'length' => 10, 'prefix' => $firstCharProduct]);
        $product = new mst_products();
        $product->product_id = $id;
        $product->product_name = $name;
        $product->product_price = $price;
        $product->is_sales = $status;
        $product->description = $request->description;
        if ($request->file('images')) {
            $file = $request->file('images');
            $name = $file->getClientOriginalName();
            $images = Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHis') . $name;
            $file->move("upload/product", $images);
            $product->product_image = $images;
        }
        $product->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $product->save();
        return redirect()->route('products')->with('success', 'Thêm sản phẩm thành công');
    }
    public function edit($id)
    {
        $product = mst_products::where('product_id', $id)->first();
        return view('product.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|integer|not_in:0',
            'status' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.integer' => 'Giá sản phẩm phải là số nguyên',
            'price.not_in' => 'Giá sản phẩm không được để trống',
            'status.required' => 'Trạng thái sản phẩm không được để trống',
            'images.image' => 'Hình ảnh sản phẩm không đúng định dạng',
            'images.mimes' => 'Hình ảnh sản phẩm không đúng định dạng',
            'images.max' => 'Hình ảnh sản phẩm không được quá 1MB',
        ]);
        $name = $request->name;
        $price = $request->price;
        $status = $request->status;
        $images = $request->images;
        $product = mst_products::where('product_id', $id)->first();
        $product->product_name = $name;
        $product->product_price = $price;
        $product->is_sales = $status;
        $product->description = $request->description;
        if ($request->file('images')) {
            $file = $request->file('images');
            $name = $file->getClientOriginalName();
            $images = Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHis') . $name;
            $file->move("upload/product", $images);
            $product->product_image = $images;
        }
        $product->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $product->save();
        return redirect()->route('products')->with('success', 'Sửa sản phẩm thành công');
    }
    public function destroy($id)
    {
        $product = mst_products::where('product_id', $id)->first();
        $product->delete();
        return redirect()->route('products')->with('success', 'Xóa sản phẩm thành công');
    }
    public function search(Request $request)
    {
        //kiem tra có các request có null hay không
        $products = [];
        $name = $request->pro_name;
        $status = $request->pro_status;
        $priceFrom = $request->pro_price_from;
        $priceTo = $request->pro_price_to;
        if ($name != null && $status != null && $priceFrom != null && $priceTo != null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->where('is_sales', $status)
                ->whereBetween('product_price', [$priceFrom, $priceTo])
                ->get();
        } elseif ($name != null && $status != null && $priceFrom != null && $priceTo == null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->where('is_sales', $status)
                ->where('product_price', '>=', $priceFrom)
                ->get();
        } elseif ($name != null && $status != null && $priceFrom == null && $priceTo != null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->where('is_sales', $status)
                ->where('product_price', '<=', $priceTo)
                ->get();
        } elseif ($name != null && $status == null && $priceFrom != null && $priceTo != null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->whereBetween('product_price', [$priceFrom, $priceTo])
                ->get();
        } elseif ($name != null && $status == null && $priceFrom == null && $priceTo != null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->where('product_price', '<=', $priceTo)
                ->get();
        } elseif ($name != null && $status != null && $priceFrom == null && $priceTo == null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->where('is_sales', $status)
                ->get();
        } elseif ($name != null && $status == null && $priceFrom != null && $priceTo == null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->where('product_price', '>=', $priceFrom)
                ->get();
        } elseif ($name == null && $status != null && $priceFrom != null && $priceTo != null) {
            $products = mst_products::where('is_sales', $status)
                ->whereBetween('product_price', [$priceFrom, $priceTo])
                ->get();
        } elseif ($name == null && $status != null && $priceFrom == null && $priceTo != null) {
            $products = mst_products::where('is_sales', $status)
                ->where('product_price', '<=', $priceTo)
                ->get();
        } elseif ($name == null && $status != null && $priceFrom != null && $priceTo == null) {
            $products = mst_products::where('is_sales', $status)
                ->where('product_price', '>=', $priceFrom)
                ->get();
        } elseif ($name == null && $status == null && $priceFrom != null && $priceTo != null) {
            $products = mst_products::whereBetween('product_price', [$priceFrom, $priceTo])
                ->get();
        } elseif ($name == null && $status == null && $priceFrom == null && $priceTo != null) {
            $products = mst_products::where('product_price', '<=', $priceTo)
                ->get();
        } elseif ($name == null && $status != null && $priceFrom == null && $priceTo == null) {
            $products = mst_products::where('is_sales', $status)
                ->get();
        } elseif ($name != null && $status == null && $priceFrom == null && $priceTo == null) {
            $products = mst_products::where('product_name', 'like', '%' . $name . '%')
                ->get();
        } elseif ($name == null && $status == null && $priceFrom == null && $priceTo == null) {
            $products = [];
        } elseif ($name == null && $status == null && $priceFrom != null && $priceTo == null) {
            $products = mst_products::where('product_price', '>=', $priceFrom)
                ->get();
        }
        if (count($products) > 0) {
            return view('product.index', compact('products'));
        } else {
            $products = [];
            return view('product.index', compact('products'));
        }
    }
}
