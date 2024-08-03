@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Create Journal Entry Detail</h1>
        <form action="{{ route('journal_entry_details.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="journal_id" class="form-label">Journal ID</label>
                <select class="form-select" id="journal_id" name="journal_id" required>
                    @foreach($journals as $journal)
                        <option value="{{ $journal->journal_id }}">{{ $journal->journal_id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="account_number" class="form-label">Account Number</label>
                <select class="form-select" id="account_number" name="account_number" required>
                    @foreach($ledgerAccounts as $ledgerAccount)
                        <option value="{{ $ledgerAccount->account_number }}">{{ $ledgerAccount->account_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="debit" class="form-label">Debit</label>
                <input type="number" step="0.01" class="form-control" id="debit" name="debit" required>
            </div>
            <div class="mb-3">
                <label for="credit" class="form-label">Credit</label>
                <input type="number" step="0.01" class="form-control" id="credit" name="credit" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection
