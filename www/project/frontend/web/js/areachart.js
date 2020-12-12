$(document).ready(function() {
    let areaChartOptions = {
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                stacked: true,
                gridLines: {
                    display: false,
                }
            }]
        }
    }

    // use chart.js to make cool graphics
    let charter = $('.sensorchart[data-topic]');
    let chartTopic = []; // topics array with objects chart.js and lineCharts for chartjs
    let chartOptions = {
        legend:false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:false
                }
            }],
            xAxes: [{
                display: false
            }]
        },
    };

    function renderDate(charter, date, chartTopic){
        charter.map(function (key, value) {
            if(!date){
                date = 'current';
            }

            var nameTopic = $(value).data('topic');
            var topic = value['id'];
            var ctx = document.getElementById(topic);

            if (date === 'current') {
                $.get('/api/chart', {'date': 'current', 'topic': nameTopic}).done(function (dataChart) {
                    chartTopic[nameTopic] = new Chart(ctx, {
                        type: 'line',
                        data:  dataChart,
                        options: chartOptions,
                    });
                });
            }
            else {
                $.get('/api/chart', {'date': date, 'topic': nameTopic}).done(function (dataChart) {
                    // addData(chartTopic[nameTopic],dataChart['labels'],dataChart['datasets'])
                    // chartTopic[nameTopic].clear();
                    chartTopic[nameTopic].config.data = dataChart;
                    chartTopic[nameTopic].update();
                });
            }

        });
    }

    renderDate(charter, 'current', chartTopic);

    function isCurrentDateForm() {
        if ($('#isDate').val() == 'current') {
            $('#isDate').val(0);
        }
    }

    function prevDate() {
        //http://momentjs.com/docs/#/parsing/date/
        isCurrentDateForm();
        var date = $('#isDate').val();
        date--;
        $('#isDate').val(date);
        date = date * (-1);
        date = moment().subtract(date, 'days').format('YYYY-MM-DD');
        console.log(date);
        $(".dateIs").html(date);
        renderDate(charter, date, chartTopic);
    }

    function nextDate() {
        //http://momentjs.com/docs/#/parsing/date/
        isCurrentDateForm();
        var date = $('#isDate').val();
        date++;
        $('#isDate').val(date);
        date = moment().add(date, 'days').format('YYYY-MM-DD');
        console.log(date);
        $('.dateIs').html(date);
        renderDate(charter, date, chartTopic);
    }

    $('#prev-date').click(function(){ prevDate(); });
    $('#next-date').click(function(){ nextDate(); });

});