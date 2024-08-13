@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ledger Accounts</h1>
    <button id="addLedgerAccountBtn" class="btn btn-success mb-3">Add New Ledger Account</button>
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
            <tr data-id="{{ $ledgerAccount->ledger_id }}">
                <td>{{ $ledgerAccount->account_number }}</td>
                <td>{{ $ledgerAccount->account_name }}</td>
                <td>{{ $ledgerAccount->account_type }}</td>
                <td>{{ $ledgerAccount->balance }}</td>
                <td class="action-buttons">
                    <button class="editBtn btn-edit action-btn" data-id="{{ $ledgerAccount->ledger_id }}">Edit</button>
                    <button class="btn btn-delete action-btn" data-id="{{ $ledgerAccount->ledger_id }}">Delete</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<!-- Add New Ledger Account Modal -->
<div class="modal fade" id="addLedgerAccountModal" tabindex="-1" aria-labelledby="addLedgerAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLedgerAccountModalLabel">Add New Ledger Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLedgerAccountForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" required>
                    </div>
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input type="text" class="form-control" id="account_name" name="account_name" required>
                    </div>
                    <div class="form-group">
                        <label for="account_type">Account Type</label>
                        <select class="form-control" id="account_type" name="account_type" required>
                            <option value="Assets">Assets</option>
                            <option value="Liabilities">Liabilities</option>
                            <option value="Equity">Equity</option>
                            <option value="Revenue">Revenue</option>
                            <option value="Expenses">Expenses</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="balance">Balance</label>
                        <input type="number" class="form-control" id="balance" name="balance" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Ledger Account Modal -->
<div class="modal fade" id="editLedgerAccountModal" tabindex="-1" aria-labelledby="editLedgerAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLedgerAccountModalLabel">Edit Ledger Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLedgerAccountForm">
                    <input type="hidden" id="edit_ledger_id" name="id">
                    <div class="form-group">
                        <label for="edit_account_number">Account Number</label>
                        <input type="text" class="form-control" id="edit_account_number" name="account_number" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_account_name">Account Name</label>
                        <input type="text" class="form-control" id="edit_account_name" name="account_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_account_type">Account Type</label>
                        <select class="form-control" id="edit_account_type" name="account_type" required>
                            <option value="Assets">Assets</option>
                            <option value="Liabilities">Liabilities</option>
                            <option value="Equity">Equity</option>
                            <option value="Revenue">Revenue</option>
                            <option value="Expenses">Expenses</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_balance">Balance</label>
                        <input type="number" class="form-control" id="edit_balance" name="balance" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@vite(['resources/js/general_ledger/ledger_accounts.js'])
@endsection
