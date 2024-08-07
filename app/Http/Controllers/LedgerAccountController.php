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
            'balance' => 'required|numeric',
        ]);

        $ledgerAccount = GeneralLedgers::create($request->all());

        return response()->json(['success' => true, 'ledgerAccount' => $ledgerAccount]);
    }

    public function edit($id)
    {
        $ledgerAccount = GeneralLedgers::find($id);
        
        if ($ledgerAccount) {
            return response()->json(['success' => true, 'ledgerAccount' => $ledgerAccount]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ledger Account not found']);
        }
    }


    public function update(Request $request, $id)
    {
        $ledgerAccount = GeneralLedgers::find($id);
        $ledgerAccount->update($request->all());

        return response()->json(['success' => true, 'ledgerAccount' => $ledgerAccount]);
    }

    public function destroy($id)
    {
        $ledgerAccount = GeneralLedgers::find($id);
        
        if ($ledgerAccount) {
            $ledgerAccount->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ledger Account not found']);
        }
    }
}




