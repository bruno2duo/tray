<?php

namespace App\Api;

use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\Sales;
use App\Models\SalesCommission;

class SalesApi
{
    public function postSale(Request $request)
    {
        $seller_id = $request['seller_id'];
        $amount = $request['amount'];
        $sale_date = $request['sale_date'];

        $sellerExiste = Sellers::where('id', $seller_id)->exists();

        if(!$sellerExiste) {
            return response()->json(['message' => 'Seller não encontrado'], 401);
        }

        $commission = SalesCommission::all();

        $total_commission = (float) $amount * ((float) $commission[0]['percentual_commission']/100);

        Sales::create([
            'seller_id' => $seller_id,
            'amount' => $amount,
            'sale_date' => $sale_date,
            'applied_commission' => $commission[0]['percentual_commission'],
            'total_commission' => $total_commission
        ]);

        return response()->json(['message' => 'Venda enviada com sucesso'], 200);
    }

    public function getSales()
    {
        $sales = Sales::all();
        return $sales;
    }

    public function getSalesBySellerId(string $id)
    {
        $seller = Sellers::find($id);
        $sales = Sales::where('seller_id', $id)->get();
        return [$seller, $sales];
    }
}
