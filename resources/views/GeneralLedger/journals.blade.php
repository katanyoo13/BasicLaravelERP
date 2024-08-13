@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Journal Entries</h1>
    <button id="addJournalEntryBtn" class="btn btn-success mb-3">Add New Journal Entry</button>
    <table class="table">
        <thead>
            <tr>
                <th>Journal ID</th>
                <th>Entry Date</th>
                <th>Description</th>
                <th>Total Debit</th>
                <th>Total Credit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journals as $journal)
            <tr data-id="{{ $journal->journal_id }}">
                <td>{{ $journal->journal_id }}</td>
                <td>{{ $journal->entry_date }}</td>
                <td>{{ $journal->description }}</td>
                <td>{{ $journal->total_debit }}</td>
                <td>{{ $journal->total_credit }}</td>
                <td class="action-buttons">
                    <button class="editJournalBtn btn-edit action-btn" data-id="{{ $journal->journal_id }}">Edit</button>
                    <button class="deleteJournalBtn deleteJournalBtn action-btn" data-id="{{ $journal->journal_id}}">Delete</button>               
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add New Journal Entry Modal -->
<div class="modal fade" id="addJournalEntryModal" tabindex="-1" aria-labelledby="addJournalEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJournalEntryModalLabel">Add New Journal Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addJournalEntryForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="entry_date">Entry Date</label>
                        <input type="date" class="form-control" id="entry_date" name="entry_date" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="total_debit">Total Debit</label>
                        <input type="number" class="form-control" id="total_debit" name="total_debit" required>
                    </div>
                    <div class="form-group">
                        <label for="total_credit">Total Credit</label>
                        <input type="number" class="form-control" id="total_credit" name="total_credit" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Journal Entry Modal -->
<div class="modal fade" id="editJournalEntryModal" tabindex="-1" aria-labelledby="editJournalEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJournalEntryModalLabel">Edit Journal Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editJournalEntryForm" >
                    <input type="hidden" id="edit_journal_id" name="id">
                    <div class="form-group">
                        <label for="edit_entry_date">Entry Date</label>
                        <input type="date" class="form-control" id="edit_entry_date" name="entry_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_total_debit">Total Debit</label>
                        <input type="number" class="form-control" id="edit_total_debit" name="total_debit" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_total_credit">Total Credit</label>
                        <input type="number" class="form-control" id="edit_total_credit" name="total_credit" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/js/general_ledger/journals.js'])
@endsection
