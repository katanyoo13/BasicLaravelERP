<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journals;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journals::all();
        return view('GeneralLedger.journals', compact('journals'));
    }

    public function create()
    {
        return view('GeneralLedger.journals_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'entry_date' => 'required|date',
            'description' => 'required',
            'total_debit' => 'required|numeric',
            'total_credit' => 'required|numeric'
        ]);

        $journal = Journals::create($request->all());
        return response()->json(['success' => true, 'message' => 'Journal Entry created successfully.', 'data' => $journal]);
    }


    public function edit($id)
    {
        \Log::info('Attempting to fetch journal entry with ID: ' . $id);
    
        try {
            $journalEntry = Journals::findOrFail($id);
            \Log::info('Journal entry found: ' . $journalEntry->description);
            return response()->json($journalEntry);
        } catch (\Exception $e) {
            \Log::error('Error fetching journal entry: ' . $e->getMessage());
            return response()->json(['error' => 'Journal entry not found'], 404);
        }
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'entry_date' => 'required|date',
            'description' => 'required',
            'total_debit' => 'required|numeric',
            'total_credit' => 'required|numeric'
        ]);

        $journal = Journals::findOrFail($id);
        $journal->update($request->all());

        return response()->json(['success' => true, 'message' => 'Journal Entry updated successfully.']);
    }

    public function destroy($id)
    {
        $journal = Journals::find($id);
        
        if ($journal) {
            $journal->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Journal Entry not found']);
        }
    }
    


}

