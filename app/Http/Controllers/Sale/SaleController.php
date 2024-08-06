<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sale\SaleCollection;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new SaleCollection( Sale::all() );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // GENERAR LA DESCRIPCION DE VENTA
        $sale = new Sale();

        $sale->clientName = $request->clientName;
        $sale->userName = $request->userName;
        $sale->userEmail = $request->userEmail;
        $sale->user_id = $request->user_id;
        $sale->total = $request->total;

        $sale->save();

        // OBTENER LOS DETALLES DE LA VENTA
        $products = $request->details;
        $details = [];

        // ASIGNAR ENCABEZADO
        foreach( $products as $product )
        {
            $details[] = [
                "sale_id" => $sale->id,
                ...$product,

                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];

            // Validar Stock
            $productUpdated = Product::find( $product["product_id"] );
            
            if( $product["quantity"] > $productUpdated["stock"] )
            {
                $sale->delete();

                return response()->json([
                    "message" => "Stock insuficiente"
                ]);
            }
            
            // Actualizar el Stock
            $productUpdated["stock"] -= $product["quantity"];
            $productUpdated->update();

        }

        // GUARDAR DETALLES DE VENTA
        DB::table("sale_details")->insert($details);

        
        return response()->json([
            "message" => "Se registro la venta"
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
