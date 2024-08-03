@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">ERP Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    <h3>Total Income</h3>
                </div>
                <div class="card-body">
                    <h2>{{ number_format($totalIncome, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    <h3>Total Expenses</h3>
                </div>
                <div class="card-body">
                    <h2>{{ number_format($totalExpense, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    <h3>Total Assets</h3>
                </div>
                <div class="card-body">
                    <h2>{{ number_format($totalAssets, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Sales Performance</h3>
                </div>
                <div class="card-body">
                    <canvas id="salesSummaryChart"></canvas>
                    <h4>Total Sales: {{ number_format($salesSummary, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Purchases Performance</h3>
                </div>
                <div class="card-body">
                    <canvas id="purchasesSummaryChart"></canvas>
                    <h4>Total Purchases: {{ number_format($purchasesSummary, 2) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Notifications</h3>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($lowInventoryAlerts as $alert)
                            <li>Low Inventory: Product ID {{ $alert->product_id }} - Quantity: {{ $alert->quantity }}</li>
                        @endforeach
                        @foreach($paymentDueAlerts as $alert)
                            <li>Payment Due: Invoice Number {{ $alert->invoice_number }} - Due Date: {{ $alert->due_date->format('Y-m-d') }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@vite(['resources/js/dashboard.js'])
<script>
    window.salesSummary = {{ number_format($salesSummary, 2, '.', '') }};
    window.purchasesSummary = {{ number_format($purchasesSummary, 2, '.', '') }};
</script>
@endsection
