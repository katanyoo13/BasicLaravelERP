<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralLedgers;

class LedgerAccountController extends Controller
{
    public function index()
    {
        $ledgerAccounts = GeneralLedgers::all();
        return view('GeneralLedger.ledger_accounts', compact('ledgerAccounts'));
    }

    public function create()
    {
        $accountTypes = ['Assets', 'Liabilities', 'Equity', 'Revenue', 'Expenses'];
        return view('GeneralLedger.ledger_accounts_create', compact('accountTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required|unique:general_ledgers',
            'account_name' => 'required',
            'account_type' => 'required',
            'balance' => 'required|numeric'
        ]);

        GeneralLedgers::create($request->all());
        return redirect()->route('ledger_accounts.index')->with('success', 'Ledger Account created successfully.');
    }

    public function edit(GeneralLedgers $ledgerAccount)
    {
        $accountTypes = ['Assets', 'Liabilities', 'Equity', 'Revenue', 'Expenses'];
        return view('GeneralLedger.ledger_accounts_edit', compact('ledgerAccount', 'accountTypes'));
    }

    public function update(Request $request, GeneralLedgers $ledgerAccount)
    {
        $request->validate([
            'account_number' => 'required|unique:general_ledgers,account_number,' . $ledgerAccount->ledger_id . ',ledger_id',
            'account_name' => 'required',
            'account_type' => 'required',
            'balance' => 'required|numeric'
        ]);

        $ledgerAccount->update($request->all());
        return redirect()->route('ledger_accounts.index')->with('success', 'Ledger Account updated successfully.');
    }

    public function destroy(GeneralLedgers $ledgerAccount)
    {
        $ledgerAccount->delete();
        return redirect()->route('ledger_accounts.index')->with('success', 'Ledger Account deleted successfully.');
    }
}
