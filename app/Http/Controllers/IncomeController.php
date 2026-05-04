<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'source' => 'required|string|max:255',
            'note' => 'nullable|string'
        ]);

        // Menyimpan data pemasukan terkait user yang sedang login
        auth()->user()->incomes()->create($validated);

        return redirect()->back()->with('success', 'Pemasukan berhasil dicatat!');
    }

    public function destroy(Income $income)
    {
        if ($income->user_id !== auth()->id()) {
            abort(403);
        }
        $income->delete();
        return redirect()->back()->with('success', 'Pemasukan berhasil dihapus!');
    }
}