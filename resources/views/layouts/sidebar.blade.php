<!-- resources/views/layouts/sidebar.blade.php -->
<div class="d-flex flex-column flex-shrink-0 p-3 sidebar" style="width: 250px; min-height: 100vh;">
    <div class="logo-container mb-3">
        <a href="/" class="w-100 d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/new_logo.png') }}" alt="ERP Logo" class="logo">
        </a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link link-dark @if(request()->routeIs('dashboard.index')) active @endif">
                Dashboard
            </a>
        </li>
        @php
            $isGeneralLedgerActive = $isGeneralLedgerActive ?? (request()->routeIs('ledger_accounts.*') || request()->routeIs('journals.*') || request()->routeIs('journal_entry_details.*'));
        @endphp
        <li class="nav-item">
            <a href="#ledgerSubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isGeneralLedgerActive ? 'true' : 'false' }}" class="nav-link link-dark @if($isGeneralLedgerActive) active @endif">
                General Ledger
            </a>
            <div class="collapse @if($isGeneralLedgerActive) show @endif" id="ledgerSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('ledger_accounts.index') }}" class="nav-link link-dark @if(request()->routeIs('ledger_accounts.*')) active @endif">Ledger Accounts</a></li>
                    <li><a href="{{ route('journals.index') }}" class="nav-link link-dark @if(request()->routeIs('journals.*')) active @endif">Journal Entries</a></li>
                    <li><a href="{{ route('journal_entry_details.index') }}" class="nav-link link-dark @if(request()->routeIs('journal_entry_details.*')) active @endif">Journal Entry Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#receivableSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('receivable.*') ? 'true' : 'false' }}" class="nav-link link-dark @if(request()->routeIs('receivable.*')) active @endif">
                Accounts Receivable
            </a>
            <div class="collapse @if(request()->routeIs('receivable.*')) show @endif" id="receivableSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Customers</a></li>
                    <li><a href="#" class="nav-link link-dark">Invoices</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#payableSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('payable.*') ? 'true' : 'false' }}" class="nav-link link-dark @if(request()->routeIs('payable.*')) active @endif">
                Accounts Payable
            </a>
            <div class="collapse @if(request()->routeIs('payable.*')) show @endif" id="payableSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Suppliers</a></li>
                    <li><a href="#" class="nav-link link-dark">Purchase Orders</a></li>
                    <li><a href="#" class="nav-link link-dark">Purchase Order Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#salesSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('sales.*') ? 'true' : 'false' }}" class="nav-link link-dark @if(request()->routeIs('sales.*')) active @endif">
                Sales
            </a>
            <div class="collapse @if(request()->routeIs('sales.*')) show @endif" id="salesSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Sales Orders</a></li>
                    <li><a href="#" class="nav-link link-dark">Sales Order Details</a></li>
                    <li><a href="#" class="nav-link link-dark">Products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#inventorySubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('inventory.*') ? 'true' : 'false' }}" class="nav-link link-dark @if(request()->routeIs('inventory.*')) active @endif">
                Inventory Management
            </a>
            <div class="collapse @if(request()->routeIs('inventory.*')) show @endif" id="inventorySubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Inventory Transactions</a></li>
                    <li><a href="#" class="nav-link link-dark">Products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#hrSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('hr.*') ? 'true' : 'false' }}" class="nav-link link-dark @if(request()->routeIs('hr.*')) active @endif">
                Human Resources
            </a>
            <div class="collapse @if(request()->routeIs('hr.*')) show @endif" id="hrSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Employees</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<!-- Include Vite and the sidebar script -->
@vite(['resources/js/app.js', 'resources/js/sidebar.js'])
