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
            <tr data-id="{{ $ledgerAccount->id }}">
                <td>{{ $ledgerAccount->account_number }}</td>
                <td>{{ $ledgerAccount->account_name }}</td>
                <td>{{ $ledgerAccount->account_type }}</td>
                <td>{{ $ledgerAccount->balance }}</td>
                <td class="action-buttons">
                    <button class="btn btn-edit action-btn" data-id="{{ $ledgerAccount->id }}">Edit</button>
                    <button class="btn btn-delete action-btn" data-id="{{ $ledgerAccount->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add New Ledger Account Modal -->
<div class="modal" id="addLedgerAccountModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Ledger Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addLedgerAccountForm">
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
                        <input type="text" class="form-control" id="balance" name="balance" required>
                    </div>
                    <button type="submit" class="btn btn-edit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Ledger Account Modal -->
<div class="modal" id="editLedgerAccountModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Ledger Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editLedgerAccountForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_ledger_id" name="ledger_id">
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
                        <input type="text" class="form-control" id="edit_balance" name="balance" required>
                    </div>
                    <button type="submit" class="btn btn-edit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/js/ledger_accounts.js', 'resources/js/add_ledger_accounts.js', 'resources/js/edit_ledger_accounts.js'])
@endsection
