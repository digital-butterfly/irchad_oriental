"use strict";

// Class definition
var KTDashboard = function() {

    // Programme de Financement Chart.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var financePogram = function() {        
        if (!KTUtil.getByID('chart_finance_program')) {
            return;
        }

        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        136, 104, 202
                    ],
                    backgroundColor: [
                        KTApp.getStateColor('success'),
                        KTApp.getStateColor('warning'),
                        KTApp.getStateColor('brand')
                    ]
                }],
                labels: [
                    'Fonds propres',
                    'Emprunts',
                    'Cautionnement'
                ]
            },
            options: {
                cutoutPercentage: 75,
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Technology'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10, 
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: KTApp.getStateColor('brand'),
                    titleFontColor: '#ffffff', 
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                }
            }
        };

        var ctx = KTUtil.getByID('chart_finance_program').getContext('2d');
        var myDoughnut = new Chart(ctx, config);
    }

    // Programme d'investissement Chart.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var investmentPogram = function() {        
        if (!KTUtil.getByID('chart_investment_program')) {
            return;
        }

        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        80, 80, 80, 120
                    ],
                    backgroundColor: [
                        KTApp.getStateColor('success'),
                        KTApp.getStateColor('warning'),
                        KTApp.getStateColor('brand'),
                        KTApp.getStateColor('danger')
                    ]
                }],
                labels: [
                    'Terrain',
                    'Construction',
                    'Équipement',
                    'Fond de roulement'
                ]
            },
            options: {
                cutoutPercentage: 75,
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Technology'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10, 
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: KTApp.getStateColor('brand'),
                    titleFontColor: '#ffffff', 
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                }
            }
        };

        var ctx = KTUtil.getByID('chart_investment_program').getContext('2d');
        var myDoughnut = new Chart(ctx, config);
    }

    return {
        // Init demos
        init: function() {
            // init charts
            financePogram();
            investmentPogram();
        }
    };
}();

// Class initialization on page load
jQuery(document).ready(function() {
    KTDashboard.init();
});
