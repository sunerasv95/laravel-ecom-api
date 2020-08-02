<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\ProductStock;

class ProductController extends Controller
{

    protected
        $product,
        $user,
        $productStock;


    public function __construct(
        Product $product,
        User $user,
        ProductStock $productStock)
    {
        $this->product = $product;
        $this->user = $user;
        $this->productStock = $productStock;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsData = $this->product
            ->with('category', 'product_stock')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            "success" => true,
            "message" => "OK",
            "data" => $productsData,
            "statusCode" => 200
        ]);
    }


    public function getProductsBySeller($sid)
    {
        //$user = new User();
        $products = $this->user::find($sid)
            ->products()
            ->get();

        return response()->json([
            "success" => true,
            "message" => "OK",
            "data" => $products,
            "statusCode" => 200
        ]);
    }


    public function getSellerDetailsForProduct($id, $sid)
    {
        $seller = $this->product::find($id)
            ->users()
            ->where('user_id', $sid)
            ->get();

        return response()->json([
            "success" => true,
            "message" => "OK",
            "data" => $seller,
            "statusCode" => 200
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "title"         => "required|string|max:100",
            "description"   => "required|string|max:255",
            "is_featured"   => "required|integer",
            "status"        => "required|integer",
            "category_id"   => "required|integer",
            "user_id"       => "required|integer",
        ]);

        $newProduct     = $this->product;
        $productStock   = $this->productStock;

        $newProduct->title          = $request->title;
        $newProduct->description    = $request->description;
        $newProduct->sku            = "SKU-".time();
        $newProduct->is_featured    = $request->is_featured;
        $newProduct->status         = $request->status;
        $newProduct->category_id    = $request->category_id;

        $newProduct->save();
        $newProduct->users()->attach($request->user_id);

        $productStock->total_stock      = $request->total_stock;
        $productStock->regular_price    = $request->regular_price;
        $productStock->sale_price       = $request->sale_price;
        $productStock->image_url        = $request->image_url;
        $productStock->product_id       = $newProduct->id;

        $result = $newProduct->product_stock()->save($productStock);

        if ($result) {

            return response()->json([
                "success" => true,
                "message" => "Product created successfully!",
                "statusCode" => 201
            ]);

        }else{

            return response()->json([
                "success" => true,
                "message" => "Something went wrong!",
                "statusCode" => 409
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "No Product found for that ID!",
                "data" => null,
                "statusCode" => 404
            ]);
        }

        $productData = $product->with('category', 'product_stock')
            ->first();

        return response()->json([
            "success" => true,
            "message" => "OK",
            "data" => $productData,
            "statusCode" => 200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
