// public/js/dashboard-chart.js

document.addEventListener('DOMContentLoaded', function () {
    // Get the chart canvas
    var ctx = document.getElementById('defectTrendChart').getContext('2d');

    // Prepare the data
    var labels = JSON.parse(document.getElementById('chart-data').dataset.labels);
    var data = JSON.parse(document.getElementById('chart-data').dataset.data);

    // Create the chart
    new Chart(ctx, {
        type: 'bar', // Type of chart: 'line', 'bar', 'radar', etc.
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Defects by Size',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Light background color
                borderColor: 'rgba(75, 192, 192, 1)', // Dark border color
                borderWidth: 1,
                hoverBackgroundColor: 'rgba(75, 192, 192, 0.7)', // Hover color
                hoverBorderColor: 'rgba(75, 192, 192, 1)', // Hover border color
                barPercentage: 0.6, // Adjust the bar thickness
                categoryPercentage: 0.8 // Adjust the space between bars
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Ensure chart resizes well
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false // Hide grid lines for x-axis
                    },
                    ticks: {
                        font: {
                            size: 14 // Increase font size for x-axis labels
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)', // Light grid line color
                        borderDash: [5, 5] // Dashed grid lines
                    },
                    ticks: {
                        font: {
                            size: 14 // Increase font size for y-axis labels
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top', // Position of the legend
                    labels: {
                        font: {
                            size: 16 // Increase font size for legend
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw + ' units'; // Custom tooltip format
                        }
                    }
                }
            }
        }
    });
});
