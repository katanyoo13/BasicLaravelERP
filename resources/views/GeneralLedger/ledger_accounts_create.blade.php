@extends('layouts.app')

@section('content')
<div class="main-content">
    <h1>Create Ledger Account</h1>
    <div class="container centered-container ">
        <form action="{{ route('ledger_accounts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="account_number" class="form-label">Account Number</label>
                <input type="text" class="form-control" id="account_number" name="account_number" required>
            </div>
            <div class="mb-3">
                <label for="account_name" class="form-label">Account Name</label>
                <input type="text" class="form-control" id="account_name" name="account_name" required>
            </div>
            <div class="mb-3">
                <label for="account_type" class="form-label">Account Type</label>
                <select class="form-select" id="account_type" name="account_type" required>
                    @foreach($accountTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="balance" class="form-label">Balance</label>
                <input type="number" class="form-control" id="balance" name="balance" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection

@section('sidebar')
    @php
        $isGeneralLedgerActive = true;
    @endphp
@endsection
