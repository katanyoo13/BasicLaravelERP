@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Create Journal Entry</h1>
        <form action="{{ route('journals.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="entry_date" class="form-label">Entry Date</label>
                <input type="date" class="form-control" id="entry_date" name="entry_date" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="total_debit" class="form-label">Total Debit</label>
                <input type="number" step="0.01" class="form-control" id="total_debit" name="total_debit" required>
            </div>
            <div class="mb-3">
                <label for="total_credit" class="form-label">Total Credit</label>
                <input type="number" step="0.01" class="form-control" id="total_credit" name="total_credit" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection
