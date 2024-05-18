"use strict";


// var label = JSON.parse('<?php echo json_encode($labels); ?>');
// var total_sales = JSON.parse('<?php echo json_encode($totalSales); ?>');

// <?php
// $encodedLabels = json_encode($labels);
// $encodedTotalSales = json_encode($totalSales);
// ?>

// var encodedLabels = <?php echo $encodedLabels; ?>;
// var encodedTotalSales = <?php echo $encodedTotalSales; ?>;



// var statistics_chart = document.getElementById("myChart").getContext('2d');

// var myChart = new Chart(statistics_chart, {
//     type: 'line',
//     data: {
//         labels: encodedLabels,
//         // labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
//         datasets: [{
//             label: 'Statistics',
//             data: encodedTotalSales,
//         //   data: [840, 387, 530, 302, 430, 270, 488],
//             borderWidth: 5,
//             borderColor: '#6777ef',
//             backgroundColor: 'transparent',
//             pointBackgroundColor: '#fff',
//             pointBorderColor: '#6777ef',
//             pointRadius: 4
//         }]
//     },
//     options: {
//         legend: {
//             display: false
//         },
//         scales: {
//             yAxes: [{
//                 gridLines: {
//                     display: false,
//                     drawBorder: false,
//                 },
//                 ticks: {
//                     stepSize: 150
//                 }
//             }],
//             xAxes: [{
//                 gridLines: {
//                     color: '#fbfbfb',
//                     lineWidth: 2
//                 }
//             }]
//         },
//     }
// });

// var ctx = document.getElementById('transactionChart').getContext('2d');
// var transactionChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: label,
//         datasets: [{
//             label: 'Total Sales',
//             data: total_sales,
//             borderWidth: 2,
//             backgroundColor: 'rgba(63,82,227,.8)',
//             borderColor: 'rgba(63,82,227,.8)',
//             pointBorderWidth: 0,
//             pointRadius: 3.5,
//             pointBackgroundColor: 'rgba(63,82,227,.8)',
//             pointHoverBackgroundColor: 'rgba(63,82,227,.8)'
//         }]
//     },
//     options: {
//         legend: {
//             display: false
//         },
//         scales: {
//             yAxes: [{
//                 gridLines: {
//                     drawBorder: false,
//                     color: '#f2f2f2',
//                 },
//                 ticks: {
//                     beginAtZero: true,
//                     stepSize: 200,
//                     callback: function(value, index, values) {
//                         return '$' + value;
//                     }
//                 }
//             }],
//             xAxes: [{
//                 gridLines: {
//                     display: false
//                 }
//             }]
//         },
//     }
// });

// $('#visitorMap').vectorMap(
// {
//     map: 'world_en',
//     backgroundColor: '#ffffff',
//     borderColor: '#f2f2f2',
//     borderOpacity: .8,
//     borderWidth: 1,
//     hoverColor: '#000',
//     hoverOpacity: .8,
//     color: '#ddd',
//     normalizeFunction: 'linear',
//     selectedRegions: false,
//     showTooltip: true,
//     pins: {
//         id: '<div class="jqvmap-circle"></div>',
//         my: '<div class="jqvmap-circle"></div>',
//         th: '<div class="jqvmap-circle"></div>',
//         sy: '<div class="jqvmap-circle"></div>',
//         eg: '<div class="jqvmap-circle"></div>',
//         ae: '<div class="jqvmap-circle"></div>',
//         nz: '<div class="jqvmap-circle"></div>',
//         tl: '<div class="jqvmap-circle"></div>',
//         ng: '<div class="jqvmap-circle"></div>',
//         si: '<div class="jqvmap-circle"></div>',
//         pa: '<div class="jqvmap-circle"></div>',
//         au: '<div class="jqvmap-circle"></div>',
//         ca: '<div class="jqvmap-circle"></div>',
//         tr: '<div class="jqvmap-circle"></div>',
//     },
// });

// // weather
// getWeather();
// setInterval(getWeather, 600000);

// function getWeather() {
//     $.simpleWeather({
//     location: 'Bogor, Indonesia',
//     unit: 'c',
//     success: function(weather) {
//         var html = '';
//         html += '<div class="weather">';
//         html += '<div class="weather-icon text-primary"><span class="wi wi-yahoo-' + weather.code + '"></span></div>';
//         html += '<div class="weather-desc">';
//         html += '<h4>' + weather.temp + '&deg;' + weather.units.temp + '</h4>';
//         html += '<div class="weather-text">' + weather.currently + '</div>';
//         html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
//         html += '<li> <i class="wi wi-strong-wind"></i> ' + weather.wind.speed+' '+weather.units.speed + '</li></ul>';
//         html += '</div>';
//         html += '</div>';

//         $("#myWeather").html(html);
//     },
//     error: function(error) {
//         $("#myWeather").html('<div class="alert alert-danger">'+error+'</div>');
//     }
//     });
// }
