<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'note' => 'nullable|string'
        ]);

        auth()->user()->expenses()->create($validated);

        return redirect()->back()->with('success', 'Pengeluaran berhasil dicatat!');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }
        $expense->delete();
        return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
