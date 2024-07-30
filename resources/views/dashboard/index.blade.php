<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">ERP Dashboard</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3>Total Assets</h3>
                </div>
                <div class="card-body">
                    <h2>{{ $totalAssets }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Sales Summary</h3>
                </div>
                <div class="card-body">
                    <canvas id="salesSummaryChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3>Purchases Summary</h3>
                </div>
                <div class="card-body">
                    <canvas id="purchasesSummaryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var salesSummary = {{ $salesSummary }};
        var purchasesSummary = {{ $purchasesSummary }};

        var salesCtx = document.getElementById('salesSummaryChart').getContext('2d');
        var salesSummaryChart = new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: ['Sales'],
                datasets: [{
                    label: 'Sales Summary',
                    data: [salesSummary],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var purchasesCtx = document.getElementById('purchasesSummaryChart').getContext('2d');
        var purchasesSummaryChart = new Chart(purchasesCtx, {
            type: 'bar',
            data: {
                labels: ['Purchases'],
                datasets: [{
                    label: 'Purchases Summary',
                    data: [purchasesSummary],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection