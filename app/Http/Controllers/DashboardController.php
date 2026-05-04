<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Total keseluruhan
        $totalIncome = $user->incomes()->sum('amount');
        $totalExpense = $user->expenses()->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // Total bulan ini
        $monthlyIncome = $user->incomes()
                              ->whereMonth('date', $currentMonth)
                              ->whereYear('date', $currentYear)
                              ->sum('amount');
                              
        $monthlyExpense = $user->expenses()
                               ->whereMonth('date', $currentMonth)
                               ->whereYear('date', $currentYear)
                               ->sum('amount');

        // Data transaksi untuk CRUD di dashboard
        $incomes = $user->incomes()->orderBy('date', 'desc')->limit(10)->get();
        $expenses = $user->expenses()->with('category')->orderBy('date', 'desc')->limit(10)->get();
        
        // Data kategori untuk dropdown
        $categories = $user->categories()->orderBy('name')->get();

        return view('dashboard', compact('balance', 'monthlyIncome', 'monthlyExpense', 'incomes', 'expenses', 'categories'));
    }
}