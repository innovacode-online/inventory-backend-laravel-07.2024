<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();

        $request["slug"] = $this->createSlug($request["name"]);

        $product = Product::create($request->all());

        return response()->json([
            "message" => "Producto creado con exito",
            new ProductResource($product),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $term)
    {
        $product = Product::where("id", $term)
            ->orWhere("slug", $term)
            ->get();

        if (count($product) == 0) {
            return response()->json([
                "message" => "El producto no se encontro"
            ], 404);
        }

        return new ProductResource($product[0]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);

        if ( !$product ) {
            return response()->json([
                "message" => "El producto no se encontro"
            ], 404);
        }

        if( $request["name"] )
        {
            $request["slug"] = $this->createSlug($request["name"]);
        }

        $product->update( $request->all() );

        return response()->json([
            "message" => "Producto actualizado con exito",
            new ProductResource($product),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ( !$product ) {
            return response()->json([
                "message" => "El producto no se encontro"
            ], 404);
        }

        $product->delete();

        return response()->json([
            "message" => "El producto ".$product["name"]." fue eliminado"
        ]);
    }

    private function createSlug($text)
    {
        $text = strtolower($text);

        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        $text = trim($text, '-');

        $text = preg_replace('/_+/', '-', $text);

        return $text;
    }
}
