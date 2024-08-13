<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journals;
use App\Models\JournalEntryDetails;
use App\Models\GeneralLedgers;

class JournalEntryDetailController extends Controller
{
    public function index()
    {
        // Retrieve all JournalEntryDetails
        $journalEntryDetails = JournalEntryDetails::all();
        // Retrieve all Journals and GeneralLedgers for the dropdowns
        $journals = Journals::all();
        $ledgerAccounts = GeneralLedgers::all();

        // Return the view with the necessary data
        return view('GeneralLedger.journal_entry_details', compact('journalEntryDetails', 'journals', 'ledgerAccounts'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'journal_id' => 'required|exists:journals,journal_id',
            'account_number' => 'required|exists:general_ledgers,account_number',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'description' => 'required|string'
        ]);

        try {
            // Create the JournalEntryDetail
            $journalEntryDetail = JournalEntryDetails::create($request->all());
            return response()->json(['success' => true, 'message' => 'Journal Entry Detail created successfully.', 'data' => $journalEntryDetail]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create Journal Entry Detail.']);
        }
    }

    public function edit($id)
    {
        try {
            // Find the JournalEntryDetail by ID
            $journalEntryDetail = JournalEntryDetails::findOrFail($id);
            return response()->json($journalEntryDetail);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Journal Entry Detail not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'journal_id' => 'required|exists:journals,journal_id',
            'account_number' => 'required|exists:general_ledgers,account_number',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'description' => 'required|string'
        ]);

        try {
            // Find the JournalEntryDetail by ID and update it
            $journalEntryDetail = JournalEntryDetails::findOrFail($id);
            $journalEntryDetail->update($request->all());
            return response()->json(['success' => true, 'message' => 'Journal Entry Detail updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update Journal Entry Detail.']);
        }
    }

    public function destroy($id)
    {
        try {
            // Find the JournalEntryDetail by ID and delete it
            $journalEntryDetail = JournalEntryDetails::findOrFail($id);
            $journalEntryDetail->delete();
            return response()->json(['success' => true, 'message' => 'Journal Entry Detail deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete Journal Entry Detail.'], 500);
        }
    }
}
