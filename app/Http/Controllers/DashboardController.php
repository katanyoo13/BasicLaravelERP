<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralLedgers;
use App\Models\JournalEntryDetails;
use App\Models\InventoryManagement;
use App\Models\AccountsPayables;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary data
        $totalIncome = GeneralLedgers::where('account_type', 'Revenue')->sum('balance');
        $totalExpense = GeneralLedgers::where('account_type', 'Expenses')->sum('balance');
        $totalAssets = GeneralLedgers::where('account_type', 'Assets')->sum('balance');

        // Sales and Purchases data
        $salesData = JournalEntryDetails::selectRaw('DATE(created_at) as date, SUM(credit) as amount')
                                            ->where('created_at', '>=', Carbon::now()->startOfMonth())
                                            ->whereHas('ledgerAccount', function ($query) {
                                                $query->where('account_type', 'Revenue');
                                            })
                                            ->groupBy('date')
                                            ->get();

        $purchasesData = JournalEntryDetails::selectRaw('DATE(created_at) as date, SUM(debit) as amount')
                                                ->where('created_at', '>=', Carbon::now()->startOfMonth())
                                                ->whereHas('ledgerAccount', function ($query) {
                                                    $query->where('account_type', 'Expenses');
                                                })
                                                ->groupBy('date')
                                                ->get();

        $salesSummary = $salesData->sum('amount');
        $purchasesSummary = $purchasesData->sum('amount');

        // Alerts
        $lowInventoryAlerts = InventoryManagement::where('quantity', '<', 10)->get();
        $paymentDueAlerts = AccountsPayables::where('due_date', '<=', Carbon::now()->addDays(7))
                            ->where('status', '!=', 'Paid')
                            ->get();

        return view('dashboard.index', compact(
            'totalIncome', 'totalExpense', 'totalAssets', 
            'salesData', 'purchasesData', 
            'salesSummary', 'purchasesSummary',
            'lowInventoryAlerts', 'paymentDueAlerts'
        ));
    }
}


