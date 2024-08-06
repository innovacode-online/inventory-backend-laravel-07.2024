<?php

namespace App\Http\Resources\Sale;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{

    public static $wrap = "sale";

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $products = Sale::find($this->id)->products;



        return [
            "id" => $this->id,
            "clientName" => $this->clientName,
            "user" => $this->user_id,
            "details" => new DetailsCollection($products),
            "createdAt" => $this->created_at
        ];
    }
}
