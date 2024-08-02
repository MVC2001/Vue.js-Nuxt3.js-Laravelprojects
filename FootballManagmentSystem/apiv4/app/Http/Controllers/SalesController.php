<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
     public function index()
    {
        return Sales::orderBy('id', 'desc')->get();
    }

    public function show($id)
    {
        return Sales::findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'item' => 'required',
                'category' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                 'customerName'  => 'required',
                 'paymentMethod' => 'required',

            ]);

            $sales = Sales::create($data);

            return response()->json(['message' => 'New Sale added successfully', 'sales' => $sales], 200);

        } catch (\Exception $e) {
            // Handle exceptions here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $sales = Sales::findOrFail($id);

        $data = $request->validate([
            'item' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required',
             'customerName'  => 'required',
             'paymentMethod' => 'required',
        ]);

        $sales->update($data);

        return $sales;
    }

    public function destroy($id)
    {
        $sales = Sales::findOrFail($id);
        $sales->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
