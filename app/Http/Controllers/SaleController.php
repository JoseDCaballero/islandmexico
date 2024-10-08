<?php

// app/Http/Controllers/SaleController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tour_name' => 'required|string|max:50',
            'pax' => 'required|integer',
            'price' => 'required|numeric',
            'fecha' => 'required|string',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:15',
            'comments' => 'nullable|string|max:255',
            'nombre' => 'required|string|max:50',
        ]);

        $sale = Sale::create($validatedData);

        return response()->json(['message' => 'Sale created successfully', 'sale' => $sale], 201);
    }
}
