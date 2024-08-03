<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JournalEntryDetails;
use App\Models\Journals;
use App\Models\GeneralLedgers;

class JournalEntryDetailController extends Controller
{
    public function index()
    {
        $journalEntryDetails = JournalEntryDetails::with('journal', 'ledgerAccount')->get();
        return view('GeneralLedger.journal_entry_details', compact('journalEntryDetails'));
    }

    public function create()
    {
        $journals = Journals::all();
        $ledgerAccounts = GeneralLedgers::all();
        return view('GeneralLedger.journal_entry_details_create', compact('journals', 'ledgerAccounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'journal_id' => 'required|exists:journals,journal_id',
            'account_number' => 'required|exists:general_ledgers,account_number',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'description' => 'required'
        ]);

        JournalEntryDetails::create($request->all());
        return redirect()->route('journal_entry_details.index')->with('success', 'Journal Entry Detail created successfully.');
    }

    public function edit(JournalEntryDetails $journalEntryDetail)
    {
        $journals = Journals::all();
        $ledgerAccounts = GeneralLedgers::all();
        return view('GeneralLedger.journal_entry_details_edit', compact('journalEntryDetail', 'journals', 'ledgerAccounts'));
    }

    public function update(Request $request, JournalEntryDetails $journalEntryDetail)
    {
        $request->validate([
            'journal_id' => 'required|exists:journals,journal_id',
            'account_number' => 'required|exists:general_ledgers,account_number',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'description' => 'required'
        ]);

        $journalEntryDetail->update($request->all());
        return redirect()->route('journal_entry_details.index')->with('success', 'Journal Entry Detail updated successfully.');
    }

    public function destroy(JournalEntryDetails $journalEntryDetail)
    {
        $journalEntryDetail->delete();
        return redirect()->route('journal_entry_details.index')->with('success', 'Journal Entry Detail deleted successfully.');
    }
}
