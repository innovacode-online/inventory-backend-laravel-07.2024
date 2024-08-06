<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $quantity = $this->pivot->quantity;
        $subTotal = $this->pivot->subTotal;

        return [
            "productId" => $this->id,
            "productName" => $this->name,
            "productSlug" => $this->slug,
            "productPrice" => $this->price,
            "productImage" => $this->image,

            "quantity" => $quantity,
            "subTotal" => $subTotal,
        ];
    }
}
