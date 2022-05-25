<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use App\Models\mst_customers;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = mst_customers::all();
        return view('customer.index', compact('customers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:mst_customers,email',
            'phone' => 'required|numeric',
            'address' => 'required',

        ], [
            'name.required' => 'Vui lòng nhập tên khách hàng',
            'name.min' => 'Tên khách hàng phải lớn hơn 5 ký tự',
            'email.required' => 'Email không thể bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được đăng ký',
            'phone.required' => 'Điện thoại không thể bỏ trống',
            'phone.numeric' => 'Điện thoại phải là số',
            'phone.size' => 'Điện thoại phải có 10 số',
            'address.required' => 'Địa chỉ không thể bỏ trống',
        ]);
        $customer = new mst_customers();
        $customer->customer_name = $request->name;
        $customer->email = $request->email;
        $customer->tel_num = $request->phone;
        $customer->address = $request->address;
        if ($request->status == 'on') {
            $customer->is_active = 1;
        } else {
            $customer->is_active = 0;
        }
        $customer->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $customer->save();
        return redirect()->route('customers')->with('success', 'Thêm khách hàng thành công');
    }
    public function destroy($id)
    {
        $customer = mst_customers::where('customer_id', $id)->first();
        $customer->delete();
        return redirect()->route('customers')->with('success', 'Xóa khách hàng thành công');
    }
    public function search()
    {
        $name = $_GET['name'];
        $status = $_GET['status'];
        $email = $_GET['email'];
        $address = $_GET['address'];
        Session::put('name', $name);
        Session::put('status', $status);
        Session::put('email', $email);
        Session::put('address', $address);
        if ($name == '' && $status == '' && $email == '' && $address == '') {
            $customers = [];
        } else if ($name != '' && $status == '' && $email == '' && $address == '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->get();
        } else if ($name == '' && $status != '' && $email == '' && $address == '') {
            $customers = mst_customers::where('is_active', $status)->get();
        } else if ($name == '' && $status == '' && $email != '' && $address == '') {
            $customers = mst_customers::where('email', 'like', '%' . $email . '%')->get();
        } else if ($name == '' && $status == '' && $email == '' && $address != '') {
            $customers = mst_customers::where('address', 'like', '%' . $address . '%')->get();
        } else if ($name != '' && $status != '' && $email == '' && $address == '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->where('is_active', $status)->get();
        } else if ($name != '' && $status == '' && $email != '' && $address == '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->where('email', 'like', '%' . $email . '%')->get();
        } else if ($name != '' && $status == '' && $email == '' && $address != '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->where('address', 'like', '%' . $address . '%')->get();
        } else if ($name == '' && $status != '' && $email != '' && $address == '') {
            $customers = mst_customers::where('is_active', $status)->where('email', 'like', '%' . $email . '%')->get();
        } else if ($name == '' && $status != '' && $email == '' && $address != '') {
            $customers = mst_customers::where('is_active', $status)->where('address', 'like', '%' . $address . '%')->get();
        } else if ($name == '' && $status == '' && $email != '' && $address != '') {
            $customers = mst_customers::where('email', 'like', '%' . $email . '%')->where('address', 'like', '%' . $address . '%')->get();
        } else if ($name != '' && $status != '' && $email != '' && $address == '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->where('is_active', $status)->where('email', 'like', '%' . $email . '%')->get();
        } else if ($name != '' && $status != '' && $email == '' && $address != '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->where('is_active', $status)->where('address', 'like', '%' . $address . '%')->get();
        } else if ($name != '' && $status == '' && $email != '' && $address != '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->where('email', 'like', '%' . $email . '%')->where('address', 'like', '%' . $address . '%')->get();
        } else if ($name == '' && $status != '' && $email != '' && $address != '') {
            $customers = mst_customers::where('is_active', $status)->where('email', 'like', '%' . $email . '%')->where('address', 'like', '%' . $address . '%')->get();
        } else if ($name != '' && $status != '' && $email != '' && $address != '') {
            $customers = mst_customers::where('customer_name', 'like', '%' . $name . '%')->where('is_active', $status)->where('email', 'like', '%' . $email . '%')->where('address', 'like', '%' . $address . '%')->get();
        }
        return view('customer.index', compact('customers'));
    }

    public function importCustomer(Request $request)
    {
        Excel::import(new CustomersImport,  $request->file('file'));
        return redirect()->back()->with('success', 'User Imported Successfully.');
    }
    public function exportCustomer()
    {
        return Excel::download(new CustomersExport, 'customer.xlsx');
    }
}
