@extends('layout.layout')
@section('content')

    <div class="products">
        <div class="product-title">
            <span class="title">Danh sách sản phẩm</span>
            <a href="#" class="float-right">Sản phẩm</a>
        </div>
        <hr>
        <div class="product-form-search">
            <form action="{{ route('search-product') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" name="pro_name" class="form-control" placeholder="Nhập tên sản phẩm">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="pro_status" id="" class="form-control">
                                <option value="">Tất cả</option>
                                <option value="0">Dừng bán</option>
                                <option value="1">Có hàng bán</option>
                                <option value="2">Hết hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Giá bán từ</label>
                            <input type="number" name="pro_price_from" class="form-control"
                                placeholder="Tìm kiếm sản phẩm">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Giá bán đến</label>
                            <input type="number" name="pro_price_to" class="form-control" placeholder="Tìm kiếm sản phẩm">
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
                <a href="{{ route('add-product') }}" class="btn btn-primary "><i
                        class="fa-solid fa-user-plus mr-2"></i>Thêm
                    sản phẩm</a>
                <button class="btn btn-primary float-right ml-4 btn-danger" id="btnCancel"><i
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
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Giá bán</th>
                            <th>Tình trạng</th>
                            <th>Ngày thêm</th>
                            <th>Ngày cập nhật</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <span class="mytooltip tooltip-effect-1">
                                            <span class="tooltip-item">{{ $value->product_id }}</span>
                                            <span class="tooltip-content clearfix">
                                                @if ($value->product_image)
                                                    <img src="{{ asset('upload/product/' . $value->product_image) }}"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset('images/images.png') }}" alt="">
                                                @endif
                                            </span>
                                    </td>
                                    <td>{{ $value->product_name }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ number_format($value->product_price, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        @if ($value->is_sales == 1)
                                            <span class="text-success">Có hàng</span>
                                        @elseif($value->is_sales == 0)
                                            <span class="text-danger">Dừng bán</span>
                                        @else
                                            <span class="text-danger">Hết hàng</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('edit-product', $value->product_id) }}"
                                            class="btn btn-primary"><i class="fa-solid fa-pen"></i></i></a>
                                        <a href="{{ route('delete-product', $value->product_id) }}"
                                            onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->product_id }} này không ?')"
                                            class="btn btn-danger">
                                            <i class="fa-solid fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    $success = Session::get('success');
    if ($success) {
        echo '<script>alert("' . $success . '")</script>';
        Session::forget('success');
    }
    ?>
    <style>
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
