<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function create
    (
        Request $request
    )
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:clients'
        ]);

        $client = Client::firstOrNew(['name' => $validatedData['name']]);

        if (!$client->exists) {
            $client->save();
            return response()->json([], 200);
        } else {
            return response()->json([
                'error' => 'Client with the same name already exists'
            ], 409);
        }
    }

}
