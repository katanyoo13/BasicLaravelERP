@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ledger Accounts</h1>
    <a href="{{ route('ledger_accounts.create') }}" class="btn btn-success mb-3">Add New Ledger Account</a>
    <table class="table">
        <thead>
            <tr>
                <th>Account Number</th>
                <th>Account Name</th>
                <th>Account Type</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ledgerAccounts as $ledgerAccount)
            <tr>
                <td>{{ $ledgerAccount->account_number }}</td>
                <td>{{ $ledgerAccount->account_name }}</td>
                <td>{{ $ledgerAccount->account_type }}</td>
                <td>{{ $ledgerAccount->balance }}</td>
                <td class="action-buttons">
                    <a href="{{ route('ledger_accounts.edit', $ledgerAccount->ledger_id) }}" class="btn btn-primary action-btn">Edit</a>
                    <form action="{{ route('ledger_accounts.destroy', $ledgerAccount->ledger_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger action-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
