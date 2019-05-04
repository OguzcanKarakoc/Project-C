<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\ProductStatus;
use App\Supplier;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::paginate(5)->onEachSide(3);

        if ($request->ajax()) {
            return view('page.back-end.product.paginate', compact('products'));
        }

        return view('page.back-end.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productStatuses = ProductStatus::all();
        $suppliers = Supplier::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('page.back-end.product.create', compact('productStatuses', 'suppliers', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $productValidatedData = $this->validate($request, [
            'productImages' => 'required',
            'productImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required|string|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required|string|max:5000',
            'supplier' => 'required|string|max:255',
            'productStatus' => 'required|string|max:255',
            'tags' => 'required|array',
            'categories' => 'required|array',
        ]);

        $product = new Product();
        $product->title = $productValidatedData['title'];
        $product->description = $productValidatedData['description'];
        $product->supplier_id = $productValidatedData['supplier'];
        $product->price = $productValidatedData['price'];
        $product->quantity = $productValidatedData['quantity'];
        $product->product_status_id = $productValidatedData['productStatus'];
        $product->save();

        $product->tags()->attach($productValidatedData['tags']);
        $product->categories()->attach($productValidatedData['categories']);

        foreach ($productValidatedData['productImages'] as $productImage) {
            $productImageModel = new ProductImage();

            $filename = $productImage->getClientOriginalName();
            $clientFilePath = 'public/product/';

            $productImage->storeAs($clientFilePath, $filename);

            $productImageModel->url = 'storage/product/' . $filename;
            $productImageModel->product_id = $product->id;
            $productImageModel->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $productStatuses = ProductStatus::all();
        $suppliers = Supplier::all();

        return view('page.back-end.product.edit', compact('product', 'productStatuses', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {

        $validatedData = $this->validate($request, [
            'updateProductImages' => 'sometimes|required',
            'updateProductImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'productImages' => '',
            'productImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required|string|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required|string|max:5000',
            'supplier' => 'required|string|max:255',
            'productStatus' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->supplier_id = $validatedData['supplier'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];
        $product->product_status_id = $validatedData['productStatus'];
        $product->save();

        if (isset($validatedData['updateProductImages'])) {
            foreach ($validatedData['updateProductImages'] as $id => $value) {
                if ($productImage = ProductImage::find($id)) {
                    $filePath = str_replace("public", "storage", $productImage->url);
                    if (Storage::disk('local')->exists($filePath)) {
                        Storage::delete($filePath);
                    };

                    $filename = $value->getClientOriginalName();
                    $filePath = 'public/product/';

                    $value->storeAs($filePath, $filename);

                    $productImage->url = 'storage/product/' . $filename;
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }
            }
        }
        if (isset($validatedData['productImages'])) {
            foreach ($validatedData['productImages'] as $productImage) {
                $productImageModel = new ProductImage();

                $filename = $productImage->getClientOriginalName();
                $filePath = 'public/product/';

                $productImage->storeAs($filePath, $filename);

                $productImageModel->url = 'storage/product/' . $filename;
                $productImageModel->product_id = $product->id;
                $productImageModel->save();
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
