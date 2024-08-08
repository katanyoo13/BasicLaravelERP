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
        \Log::info('Attempting to fetch ledger account with ID: ' . $id);

        try {
            $ledgerAccount = GeneralLedgers::findOrFail($id);
            \Log::info('Ledger account found: ' . $ledgerAccount->account_name);
            return response()->json($ledgerAccount);
        } catch (\Exception $e) {
            \Log::error('Error fetching ledger account: ' . $e->getMessage());
            return response()->json(['error' => 'Ledger account not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $ledgerAccount = GeneralLedgers::findOrFail($id);
        $request->validate([
            'account_number' => 'required|unique:general_ledgers,account_number,' . $id . ',ledger_id',
            'account_name' => 'required',
            'account_type' => 'required',
            'balance' => 'required|numeric',
        ]);

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
