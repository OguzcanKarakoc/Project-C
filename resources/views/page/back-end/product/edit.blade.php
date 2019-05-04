@extends('layout.adminLayout.admin_design')

@section("content")
  <div id="content">
    <section>
      @include('component.flash-message')

      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="separator-left">Edit Product</h1>
          </div>
        </div>
      </div>

      <form action="{{ route('products.update', $product->id) }}" method="post"
            enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Edit product images</label>
                @foreach($product->productImages as $productImage)
                  <input type="file" name="updateProductImages[{{ $productImage->id }}]" class="form-control-file">
                  <img class="img-thumbnail" style="width: 15rem;" src="{{ \Illuminate\Support\Facades\URL::asset($productImage->url) }}"
                       alt=""/>
                @endforeach
              </div>
              <div class="form-group">
                <label>Add new product images</label>
                <input type="file" name="productImages[]" class="form-control-file" multiple>
              </div>
              <div class="form-group">
                <label for="title"> Title </label>
                <input type="text" name="title" placeholder="Lorum Ipsum" class="form-control"
                       value="{{ $product->title }}"/>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"
                          placeholder="lorum ipsum description">{{ $product->description }}</textarea>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input id="price" class="form-control" type="number" name="price" step="0.01"
                       value="{{ $product->price }}"/>
              </div>
              <div class="form-group">
                <label> Quantity </label>
                <input class="form-control" type="number" name="quantity" step="1"
                       value="{{ $product->quantity }}"/>
              </div>
              <div class="form-group">
                <label> Status </label>
                <select class="form-control" name="productStatus">
                  @foreach($productStatuses as $productStatus)
                    @if($productStatus->id == $product->product_status_id)
                      <option value="{{ $productStatus->id }}"
                              selected>{{ $productStatus->name }}</option>
                    @else
                      <option value="{{ $productStatus->id }}">{{ $productStatus->name }}>
                      </option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label> Supplier </label>
                <select class="form-control" name="supplier">
                  @foreach($suppliers as $supplier)
                    @if($supplier->id == $product->supplier_id)
                      <option value="{{ $supplier->id }}"
                              selected>{{ $supplier->full_name }}</option>
                    @else
                      <option value="{{ $supplier->id }}">{{ $supplier->full_name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-12 cell">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>
          </div>
        </div>
      </form>

    </section>
  </div>

@endsection