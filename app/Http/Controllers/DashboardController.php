<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralLedgers;
use App\Models\AccountsReceivables;
use App\Models\AccountsPayables;
use App\Models\InventoryManagement;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIncome = GeneralLedgers::where('account_type', 'Income')->sum('balance');
        $totalExpense = GeneralLedgers::where('account_type', 'Expense')->sum('balance');
        $totalAssets = GeneralLedgers::sum('balance');
        
        $salesSummary = AccountsReceivables::where('created_at', '>=', Carbon::now()->startOfMonth())
                            ->sum('amount');

        $purchasesSummary = AccountsPayables::where('created_at', '>=', Carbon::now()->startOfMonth())
                            ->sum('amount');

        $lowInventoryAlerts = InventoryManagement::where('quantity', '<', 10)->get();

        $paymentDueAlerts = AccountsPayables::where('due_date', '<=', Carbon::now()->addDays(7))
                            ->where('status', '!=', 'Paid')
                            ->get();

        return view('dashboard.index', compact('totalIncome', 'totalExpense', 'totalAssets', 'salesSummary', 'purchasesSummary', 'lowInventoryAlerts', 'paymentDueAlerts'));
    }
}
