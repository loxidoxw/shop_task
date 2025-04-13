@extends('layouts.shop')
@section('content')
    <form style="margin-left: 20px" action="{{route('product.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="productTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="productTitle" name="name">
            <div id="titleHelp" class="form-text">Title should not contain any special chars.</div>
        </div>
        <div class="mb-3">
            <label for="productDescription" class="form-label">Description</label>
            <textarea class="form-control" id="productDescription" name="description"></textarea>
            <div id="descriptionHelp" class="form-text">Maximum 200 symbols.</div>
        </div>
        <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="productPrice" name="price">
            <div id="titlePrice" class="form-text">Price should be in US dollars</div>
        </div>

{{--        Category radio--}}
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="category_id" id="inlineRadioFurniture" value="1">
            <label class="form-check-label" for="inlineRadioFurniture">Furniture</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="category_id" id="inlineRadioDevice" value="2">
            <label class="form-check-label" for="inlineRadioDevice">Device</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="category_id" id="inlineRadioFun" value="3">
            <label class="form-check-label" for="inlineRadioFun">Fun</label>
        </div>

        <div class="mb-3">
            <label for="productImage" class="form-label">Image</label>
            <input type="text" class="form-control" id="productImage" name="image">
            <div id="titlePrice" class="form-text">Maximum size of 5mb</div>
        </div>
{{--        <div class="mb-3">--}}
{{--            <label for="productImage" class="form-label">Image</label>--}}
{{--            <input type="file" class="form-control" id="productImage" accept="image/png, image/jpeg">--}}
{{--            <div id="ImageHelp" class="form-text">Maximum size of 5mb</div>--}}
{{--        </div>--}}
        <button type="submit" class="btn btn-primary" style="margin-left: 20px">Submit</button>
    </form>
@endsection
