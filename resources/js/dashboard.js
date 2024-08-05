document.addEventListener("DOMContentLoaded", function() {
    var salesByMonth = window.salesByMonth;
    var purchasesByMonth = window.purchasesByMonth;

    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    console.log("Sales Data: ", salesByMonth);
    console.log("Purchases Data: ", purchasesByMonth);

    var salesCtx = document.getElementById('salesSummaryChart').getContext('2d');
    var salesSummaryChart = new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Sales Summary',
                data: Object.values(salesByMonth),
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
            labels: months,
            datasets: [{
                label: 'Purchases Summary',
                data: Object.values(purchasesByMonth),
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
