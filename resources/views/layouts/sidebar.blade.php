<!-- resources/views/layouts/sidebar.blade.php -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light sidebar" style="width: 250px; min-height: 100vh;">
    <div class="logo-container">
        <a href="/" class="col-md-6">
            <img src="{{ asset('images/new_logo.png') }}" alt="ERP Logo" class="logo">
        </a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#dashboardSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link link-dark">
                Dashboard
            </a>
            <div class="collapse" id="dashboardSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#ledgerSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link link-dark">
                General Ledger
            </a>
            <div class="collapse" id="ledgerSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Ledger Accounts</a></li>
                    <li><a href="#" class="nav-link link-dark">Journal Entries</a></li>
                    <li><a href="#" class="nav-link link-dark">Journal Entry Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#receivableSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link link-dark">
                Accounts Receivable
            </a>
            <div class="collapse" id="receivableSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Customers</a></li>
                    <li><a href="#" class="nav-link link-dark">Invoices</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#payableSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link link-dark">
                Accounts Payable
            </a>
            <div class="collapse" id="payableSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Suppliers</a></li>
                    <li><a href="#" class="nav-link link-dark">Purchase Orders</a></li>
                    <li><a href="#" class="nav-link link-dark">Purchase Order Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#salesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link link-dark">
                Sales
            </a>
            <div class="collapse" id="salesSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Sales Orders</a></li>
                    <li><a href="#" class="nav-link link-dark">Sales Order Details</a></li>
                    <li><a href="#" class="nav-link link-dark">Products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#inventorySubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link link-dark">
                Inventory Management
            </a>
            <div class="collapse" id="inventorySubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Inventory Transactions</a></li>
                    <li><a href="#" class="nav-link link-dark">Products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#hrSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link link-dark">
                Human Resources
            </a>
            <div class="collapse" id="hrSubmenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link link-dark">Employees</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<!-- Include Vite and the sidebar script -->
@vite(['resources/js/app.js', 'resources/js/sidebar.js'])
