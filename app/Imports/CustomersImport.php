<?php

namespace App\Imports;

use Illuminate\Support\Collection;
// use App\Imports\mst_customers;
use App\Models\mst_customers as ModelsMst_customers;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class CustomersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.name' => 'required|min:5',
            '*.email' => 'required|email|unique:mst_customers,email',
            '*.tel_num' => 'required|numeric',
            '*.address' => 'required',
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
        ])->validate();

        foreach ($rows as $row) {
            $customer = new ModelsMst_customers();
            $customer->customer_name = $row['name'];
            $customer->email = $row['email'];
            $customer->tel_num = $row['tel_num'];
            $customer->address = $row['address'];
            $customer->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $customer->save();
        }
    }
}
