@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Journal Entry Details</h1>
    <button id="addJournalEntryDetailBtn" class="btn btn-success mb-3">Add New Journal Entry Detail</button>
    <table class="table">
        <thead>
            <tr>
                <th>Journal ID</th>
                <th>Account Number</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Description</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journalEntryDetails as $detail)
            <tr data-id="{{ $detail->detail_id }}">
                <td>{{ $detail->journal_id }}</td>
                <td>{{ $detail->account_number }}</td>
                <td>{{ $detail->debit }}</td>
                <td>{{ $detail->credit }}</td>
                <td>{{ $detail->description }}</td>
                <td>{{ $detail->created_at->format('Y-m-d') }}</td>
                <td class="action-buttons">
                    <button class="editJournalEntryDetailBtn btn-edit action-btn" data-id="{{ $detail->detail_id }}">Edit</button>
                    <button class="deleteJournalDetailsBtn deleteJournalDetailsBtn action-btn" data-id="{{ $detail->detail_id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add New Journal Entry Detail Modal -->
<div class="modal fade" id="addJournalEntryDetailModal" tabindex="-1" aria-labelledby="addJournalEntryDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJournalEntryDetailModalLabel">Add New Journal Entry Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addJournalEntryDetailForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="journal_id">Journal ID</label>
                        <select class="form-select" id="journal_id" name="journal_id" required>
                            @foreach($journals as $journal)
                                <option value="{{ $journal->journal_id }}">{{ $journal->journal_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <select class="form-select" id="account_number" name="account_number" required>
                            @foreach($ledgerAccounts as $ledgerAccount)
                                <option value="{{ $ledgerAccount->account_number }}">{{ $ledgerAccount->account_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="debit">Debit</label>
                        <input type="number" step="0.01" class="form-control" id="debit" name="debit" required>
                    </div>
                    <div class="form-group">
                        <label for="credit">Credit</label>
                        <input type="number" step="0.01" class="form-control" id="credit" name="credit" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Journal Entry Detail Modal -->
<div class="modal fade" id="editJournalEntryDetailModal" tabindex="-1" aria-labelledby="editJournalEntryDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJournalEntryDetailModalLabel">Edit Journal Entry Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editJournalEntryDetailForm">
                    <input type="hidden" id="edit_detail_id" name="id">
                    <div class="form-group">
                        <label for="edit_journal_id">Journal ID</label>
                        <select class="form-select" id="edit_journal_id" name="journal_id" required>
                            @foreach($journals as $journal)
                                <option value="{{ $journal->journal_id }}">{{ $journal->journal_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_account_number">Account Number</label>
                        <select class="form-select" id="edit_account_number" name="account_number" required>
                            @foreach($ledgerAccounts as $ledgerAccount)
                                <option value="{{ $ledgerAccount->account_number }}">{{ $ledgerAccount->account_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_debit">Debit</label>
                        <input type="number" step="0.01" class="form-control" id="edit_debit" name="debit" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_credit">Credit</label>
                        <input type="number" step="0.01" class="form-control" id="edit_credit" name="credit" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@vite(['resources/js/general_ledger/journal_entry_details.js'])
@endsection
