@extends('layouts.bootstrap')

@section('content')
    <div id="chart-container"></div>
@endsection

@push('script')
    <script>
        var datas = {{ json_encode($datas) }};

        Highcharts.chart('chart-container', {
            title: {
                text: 'New User Growth, 2020',
            },
            subtitle: {
                text: 'Source: Azmilink Media'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Okt', 'Nov', 'Des']
            },
            yAxis: {
                title: {
                    text: 'Number of New User'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New User',
                data: datas
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500,
                    },
                    chartOpyions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        })
    </script>
@endpush

@push('library')
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
