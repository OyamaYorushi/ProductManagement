import $ from 'jquery';
import Highcharts from 'highcharts';

$(document).ready(function() {

    $.ajax({
        url: '/top-products',
        method: 'GET',
        success: function(data) {
            renderChart(data);
        }
    });

});

function renderChart(products) {

    Highcharts.chart('topProductsChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: products.labels
        },
        yAxis: {
            title: {
                text: 'Saídas'
            },
            min: 0
        },
        series: [{
            name: 'Quantidade',
            data: products.quantities.map(str => parseInt(str, 10)),
            color: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    });

}
