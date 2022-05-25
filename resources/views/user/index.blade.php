@extends('layout.layout')
@section('content')

    <div class="products">
        <div class="product-title">
            <span class="title">Danh sách Users</span>
            <a href="#" class="float-right">Users</a>
        </div>
        <hr>
        <div class="product-form-search">
            <form action="{{ route('search-user') }}" method="get">
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
                            <label for="">Nhóm</label>
                            <select name="group" id="" class="form-control">
                                <option value="">Tất cả</option>
                                <option value="Admin">Admin</option>
                                <option value="Reviewer">Reviewer</option>
                                <option value="Editor">Editor</option>
                            </select>
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
                    </div>
                </div>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-primary "><i
                        class="fa-solid fa-user-plus mr-2"></i>Thêm
                    mới</a>
                <button class="btn btn-primary float-right ml-4 btn-danger" id="btnCancelUser"><i
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
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Trạng thái</th>
                            <th>Ngày thêm</th>
                            <th>Ngày cập nhật</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td >{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->group_role }}</td>
                                    <td>
                                        @if ($user->isActive == 0)
                                            <span class="badge badge-danger">Bị khóa</span>
                                        @else
                                            <span class="badge badge-success">Đang hoạt động</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"
                                            class="btn btn-primary btn-sm"><i class="fa-solid fa-edit"></i></a>
                                        <a href="{{ route('delete-user', $user->id) }}"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"
                                            class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-alt"></i></a>
                                        @if ($user->isActive == 0)
                                            <a href="{{ route('active-user', $user->id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản này không?')">
                                                <button class="btn btn-primary btn-sm"><i
                                                        class="fa-solid fa-key"></i></button>
                                            </a>
                                        @else
                                            <a href="{{ route('active-user', $user->id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này không?')">
                                                <button class="btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-key"></i></button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Không có dữ liệu</td>
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
                    <h4 class="modal-title">Thêm User</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="u-name" class="product-label">Họ tên</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" id="u-name" placeholder="Nhập họ tên">
                                @if ($errors->has('name'))
                                    <span id="nameError"
                                        class="text-danger font-weight-bold">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="u-email" class="product-label">Email</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" id="u-email"
                                    placeholder="Nhập email">
                                @if ($errors->has('email'))
                                    <span id="EmailError"
                                        class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="u-password" class="product-label">Mật khẩu</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="u-password"
                                    placeholder="Nhập mật khẩu">
                                @if ($errors->has('password'))
                                    <span id="passwordError"
                                        class="text-danger font-weight-bold">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="c-confirm" class="product-label">Xác nhận</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="confirm" id="u-confirm"
                                    placeholder="Nhập lại mật khẩu">
                                @if ($errors->has('confirm'))
                                    <span id="confirmError"
                                        class="text-danger font-weight-bold">{{ $errors->first('confirm') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form group row mt-4">
                            <div class="col-md-4">
                                <label for="u-group" class="product-label">Nhóm</label>
                            </div>
                            <div class="col-sm-8">
                                <select class="custom-select" name="group">
                                    <option selected value="">Nhóm</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Reviewer">Reviewer</option>
                                    <option value="Editor">Editor</option>
                                </select>
                                @if ($errors->has('group'))
                                    <span id="groupError"
                                        class="text-danger font-weight-bold">{{ $errors->first('group') }}</span>
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
