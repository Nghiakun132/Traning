@extends('layout.layout')
@section('content')

    <div class="products">
        <div class="product-title">
            <span class="title">Danh sách khách hàng</span>
            <a href="#" class="float-right">Khách hàng</a>
        </div>
        <hr>
        <div class="product-form-search">
            <form action="{{ route('search-customer') }}" method="get">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Họ tên</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập họ tên">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Nhập email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="status" id="" class="form-control">
                                <option value="">Tất cả</option>
                                <option value="0">Bị khóa</option>
                                <option value="1">Hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ">
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-primary "><i
                        class="fa-solid fa-user-plus mr-2"></i>Thêm
                    mới</a>
                <a href="{{ route('export-customer') }}" class="btn btn-success ml-4">Export CSV</a>
                <a href="" class="btn btn-success ml-4" data-toggle="modal" data-target="#myModal2">Import CSV</a>

                <button class="btn btn-primary float-right ml-4 btn-danger" id="btnCancelCustomer"><i
                        class="fa-solid fa-x mr-2"></i> Xóa tìm</button>
                <button type="submit" class="btn btn-primary float-right btn-success"> <i
                        class="fa-solid fa-magnifying-glass mr-2"></i>Tìm kiếm</button>
            </form>

        </div>
        <div class="product-table mt-4 card">
            <div class="card-body">
                <table id="example" class="table table-hover table-bordered" style="width:100%">
                    <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Mã khách hàng</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Ngày thêm</th>
                            <th>Ngày cập nhật</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($customers) > 0)
                            @foreach ($customers as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->customer_id }}</td>
                                    <td class="cm_name">{{ $value->customer_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->tel_num }}</td>
                                    <td>
                                        @if ($value->is_active == 1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Bị khóa</span>
                                        @endif
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->updated_at }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary"><i class="fa-solid fa-edit mr-2"></i>Sửa</a>
                                        <a href="{{ route('delete-customer', $value->customer_id) }}"
                                            class="btn btn-danger"
                                            onclick="
                                                                                    return confirm('Bạn có chắc chắn muốn xóa khách hàng #{{ $value->customer_id }} không?')"><i
                                                class="fa-solid fa-trash mr-2"></i>Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center font-weight-bold">Không có dữ liệu</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm khách hàng</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="c-name" class="product-label">Họ tên</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" id="c-name" placeholder="Nhập họ tên">
                                @if ($errors->has('name'))
                                    <span id="nameError"
                                        class="text-danger font-weight-bold">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="c-email" class="product-label">Email</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" id="c-email"
                                    placeholder="Nhập email">
                                @if ($errors->has('email'))
                                    <span id="EmailError"
                                        class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="c-phone" class="product-label">Điện thoại</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone" id="c-phone"
                                    placeholder="Nhập số điện thoại">
                                @if ($errors->has('phone'))
                                    <span id="phoneError"
                                        class="text-danger font-weight-bold">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="c-address" class="product-label">Địa chỉ</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address" id="c-address"
                                    placeholder="Nhập địa chỉ">
                                @if ($errors->has('address'))
                                    <span id="addressError"
                                        class="text-danger font-weight-bold">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="c-status" class="product-label">Trạng thái</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="checkbox" class="form-check-input" name="status" id="c-status"
                                    placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>
                        <button class="btn btn-primary float-right ml-2">Lưu</button>
                        <button class="btn btn-primary float-right" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Excel</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import-customer') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="c-name" class="product-label">Chọn file</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="file" class="form-control mb-4" name="file" id="c-file">
                                @if (count($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                        <span class="text-danger font-weight-bold">{{ $error }}</span></br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary float-right ml-2">Lưu</button>
                        <button class="btn btn-primary float-right" data-dismiss="modal">Hủy</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    $success = Session::get('success');
    $errors = Session::get('errors');
    if ($success) {
        echo '<script>alert("' . $success . '")</script>';
        Session::forget('success');
    }
    if ($errors) {
        echo '<script>alert("' . $errors . '")</script>';
        Session::forget('errors');
    }
    ?>
    <style>
        .form-check-input {
            margin-left: 0 !important;
        }

        .mytooltip {
            display: inline;
            position: relative;
            z-index: 999
        }

        .mytooltip .tooltip-item {
            /* background: rgba(0, 0, 0, 0.1); */
            cursor: pointer;
            display: inline-block;
            font-weight: 500;
            padding: 0 10px
        }

        .mytooltip .tooltip-content {
            position: absolute;
            z-index: 9999;
            /* width: 360px; */
            left: 150%;
            margin: 0 0 20px -180px;
            bottom: 100%;
            text-align: left;
            font-size: 14px;
            line-height: 30px;
            -webkit-box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
            box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
            background: #2b2b2b;
            opacity: 0;
            cursor: default;
            pointer-events: none
        }

        .mytooltip .tooltip-content::after {
            content: '';
            top: 100%;
            left: 50%;
            border: solid transparent;
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: #2a3035 transparent transparent;
            border-width: 10px;
            margin-left: -10px
        }

        .mytooltip .tooltip-content img {
            position: relative;
            height: 140px;
            display: block;
            float: left;
            margin-right: 1em
        }

        .mytooltip .tooltip-item::after {
            content: '';
            position: absolute;
            width: 360px;
            height: 20px;
            bottom: 100%;
            left: 50%;
            pointer-events: none;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%)
        }

        .mytooltip:hover .tooltip-item::after {
            pointer-events: auto
        }

        .mytooltip:hover .tooltip-content {
            pointer-events: auto;
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0) rotate3d(0, 0, 0, 0deg);
            transform: translate3d(0, 0, 0) rotate3d(0, 0, 0, 0deg)
        }

        .mytooltip:hover .tooltip-content2 {
            opacity: 1;
            font-size: 18px
        }

        .mytooltip .tooltip-text {
            font-size: 14px;
            line-height: 24px;
            display: block;
            padding: 1.31em 1.21em 1.21em 0;
            color: #fff
        }

    </style>
@stop
