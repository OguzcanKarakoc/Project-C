@extends('layout.adminLayout.admin_design')

@section("content")
    <div id="content">
        <section>

            @include ('component.flash-message')
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left">Create Product</h1>
                    </div>
                </div>
            </div>

            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Add images</label>
                                <input type="file" name="productImages[]" class="form-control-file" multiple>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" class="form-control" type="text" name="title" placeholder=""/>
                                <label for="description">Description</label>
                                <input id="description" class="form-control" type="text" name="description" placeholder=""></textarea>
                                <label for="price">Price</label>
                                <input id="price" class="form-control" type="number" name="price" step="0.01"/>
                                <label for="quantity">Quantity</label>
                                <input id="quantity" class="form-control" type="number" name="quantity" step="1"/>
                            </div>
                            <div class="form-group">
                                <label>
                                    Status
                                    <select name="productStatus" class="form-control">
                                        @foreach($productStatuses as $productStatus)
                                            <option value="{{ $productStatus->id }}">{{ $productStatus->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label>
                                    Supplier
                                    <select name="supplier" class="form-control">
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->full_name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    Categories
                                    <select name="categories[]" id="categories" class="form-control" multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label>
                                    Tags
                                    <select name="tags[]" id="tags" class="form-control" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="col-12 cell">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </section>
    </div>

@endsection