<?php

namespace App\Api;

use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\Sales;

class SellersApi
{
    public function getSellers()
    {
        $sellers = Sellers::all();
        return $sellers;
    }

    public function getSellersById(string $id)
    {
        $sellers = Sellers::find($id);
        return $sellers;
    }

    public function postSellers(Request $request)
    {
        $nome = $request['nome'];
        $email = $request['email'];

        $validate_email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$validate_email) {
            return response()->json(['message' => 'E-mail inválido'], 401);
        }

        $email_exists = Sellers::where('email', $email)->exists();

        if($email_exists) {
            return response()->json(['message' => 'E-mail já está cadastrado'], 401);
        }

        Sellers::create([
            'nome' => $nome,
            'email' => $email
        ]);

        return response()->json(['message' => 'Seller cadastrado com sucesso'], 200);
    }
}
