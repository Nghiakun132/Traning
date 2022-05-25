@extends('layout.layout')
@section('content')
    <div class="products">
        <div class="product-title">
            <span class="title">Chi tiết sản phẩm</span>
            <span class="float-right">&nbsp;&nbsp;> Chi tiết sản phẩm</span> <a href="#" class="float-right">Sản phẩm
            </a>
        </div>
        <hr>
        <div class="container-fluid card">
            <div class="product-add">
                <form action="{{ route('add-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form group row">
                                <div class="col-md-4">
                                    <label for="pro-name" class="product-label">Tên sản phẩm</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" id="pro-name"
                                        placeholder="Nhập tên sản phẩm">
                                    @if ($errors->has('name'))
                                        <span id="nameError"
                                            class="text-danger font-weight-bold">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class=" form group row mt-4">
                                <div class="col-md-4">
                                    <label for="pro-price" class="product-label">Giá bán</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="price" id="pro-price"
                                        placeholder="Nhập giá bán">
                                    @if ($errors->has('price'))
                                        <span id="priceError"
                                            class="text-danger font-weight-bold">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>

                            </div>

                            <div class=" form group row mt-4">
                                <div class="col-md-4">
                                    <label for="pro-description" class="product-label">Mô tả sản phẩm</label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea name="description" id="pro-description" cols="30" rows="5" class="form-control"
                                        placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                            </div>
                            <div class=" form group row mt-4">
                                <div class="col-md-4">
                                    <label for="pro-status" class="product-label">Trạng thái</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select class="custom-select" id="inputGroupSelect04"
                                            aria-label="Example select with button addon" name="status" id="pro-status">
                                            <option selected value="">Chọn trạng thái</option>
                                            <option value="0">Đang bán</option>
                                            <option value="1">Ngừng bán</option>
                                            <option value="2">Hết hàng</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"><i
                                                    class="fa-solid fa-angle-down"></i></button>
                                        </div>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span id="statusError"
                                            class="text-danger font-weight-bold">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="pro-image" class="product-label">Hình ảnh</label>
                                <div class="text-center">
                                    <img src="{{ asset('images/images.png') }}" class=" m-4 text-center" alt="">
                                </div>
                                <div class="input-group mb-4 mt-2">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary btn-primary text-light" type="button"
                                            id="btnUpload">Upload</button>
                                        <button class="btn btn-outline-secondary btn-danger" type="button"
                                            id="btnDeleteFile"><i class="fa-solid fa-xmark text-light"></i></button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="images" class="custom-file-input" id="inputGroupFile03">
                                        <label class="custom-file-label" for="inputGroupFile03">Chọn ảnh</label>
                                    </div>
                                </div>
                                @if ($errors->has('images'))
                                    <span id="imagesError"
                                        class="text-danger font-weight-bold">{{ $errors->first('images') }}</span>
                                @endif
                            </div>
                            <button class="btn btn-danger float-right ml-3" tyle="submit" id="btnSave">Lưu</button>
                            <a href="{{ route('products') }}" class="btn btn-primary float-right"
                                id="btnCancelAdd">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
