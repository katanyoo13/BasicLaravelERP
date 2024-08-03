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

        Journals::create($request->all());
        return redirect()->route('journals.index')->with('success', 'Journal Entry created successfully.');
    }

    public function edit(Journals $journal)
    {
        return view('GeneralLedger.journals_edit', compact('journal'));
    }

    public function update(Request $request, Journals $journal)
    {
        $request->validate([
            'entry_date' => 'required|date',
            'description' => 'required',
            'total_debit' => 'required|numeric',
            'total_credit' => 'required|numeric'
        ]);

        $journal->update($request->all());
        return redirect()->route('journals.index')->with('success', 'Journal Entry updated successfully.');
    }

    public function destroy(Journals $journal)
    {
        $journal->delete();
        return redirect()->route('journals.index')->with('success', 'Journal Entry deleted successfully.');
    }
}
