'use strict';

function return_options(categories, open, close) {
    return {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Открытие/закрытие клиентов по дням'
        },
        xAxis: {
            categories: categories/*['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']*/
        },
        yAxis: {
            min: Math.min.apply(Math, close),
            max: Math.max.apply(Math, open),
            title: {
                text: 'Кол-во клиентов'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Открыли',
            data: open
        }, {
            name: '??',
            data: [0, 0, 0, 0, 0]
        }, {
            name: 'Заркыли',
            data: close
        }]
    };
}

fetch('/get_data')
    .then(function(response) {
        return response.json()
    })
    .then(function (input) {

        var data_o = input["dates_o"];
        var open = input["open"];
        var close = input["close"];
        //console.log(Math.min.apply(Math, close));
        if (data_o !== null && open !== null && close !== null)
            Highcharts.chart('container1', return_options(data_o, open, close));
    });
