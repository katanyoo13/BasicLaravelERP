document.addEventListener("DOMContentLoaded", function() {
    var salesSummary = parseFloat(window.salesSummary);
    var purchasesSummary = parseFloat(window.purchasesSummary);

    console.log("Sales Summary: ", salesSummary);
    console.log("Purchases Summary: ", purchasesSummary);

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
