<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        try {
            $expenses = Expenses::orderBy('id', 'desc')->get();
            return response()->json($expenses, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'expense' => 'required|max:255',
                'category' => 'required|max:255',
                'totalpayed' => 'required|numeric',
                'description' => 'required|max:255',
            ]);

            $expense = Expenses::create($validated);
            return response()->json(['message' => 'Expense created successfully', 'data' => $expense], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $expense = Expenses::findOrFail($id);
            return response()->json($expense, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'expense' => 'sometimes|required|max:255',
                'category' => 'sometimes|required|max:255',
                'totalpayed' => 'sometimes|required|numeric',
                'description' => 'sometimes|required|max:255',
            ]);

            $expense = Expenses::findOrFail($id);
            $expense->update($validated);

            return response()->json(['message' => 'Expense updated successfully', 'data' => $expense], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $expense = Expenses::findOrFail($id);
            $expense->delete();
            return response()->json(['message' => 'Expense deleted successfully', 'data' => $expense], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
