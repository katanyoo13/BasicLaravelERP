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
        $salesData = JournalEntryDetails::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(credit) as amount')
                                            ->where('created_at', '>=', Carbon::now()->startOfYear())
                                            ->whereHas('ledgerAccount', function ($query) {
                                                $query->where('account_type', 'Revenue');
                                            })
                                            ->groupBy('year', 'month')
                                            ->get();

        $purchasesData = JournalEntryDetails::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(debit) as amount')
                                                ->where('created_at', '>=', Carbon::now()->startOfYear())
                                                ->whereHas('ledgerAccount', function ($query) {
                                                    $query->where('account_type', 'Expenses');
                                                })
                                                ->groupBy('year', 'month')
                                                ->get();

        // Prepare data for the chart
        $salesByMonth = array_fill(1, 12, 0);
        $purchasesByMonth = array_fill(1, 12, 0);

        foreach ($salesData as $data) {
            $salesByMonth[$data->month] = $data->amount;
        }

        foreach ($purchasesData as $data) {
            $purchasesByMonth[$data->month] = $data->amount;
        }

        $salesSummary = array_sum($salesByMonth);
        $purchasesSummary = array_sum($purchasesByMonth);

        // Alerts
        $lowInventoryAlerts = InventoryManagement::where('quantity', '<', 10)->get();
        $paymentDueAlerts = AccountsPayables::where('due_date', '<=', Carbon::now()->addDays(7))
                            ->where('status', '!=', 'Paid')
                            ->get();

        return view('dashboard.index', compact(
            'totalIncome', 'totalExpense', 'totalAssets', 
            'salesByMonth', 'purchasesByMonth', 
            'salesSummary', 'purchasesSummary',
            'lowInventoryAlerts', 'paymentDueAlerts'
        ));
    }
}
