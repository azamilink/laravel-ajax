@extends('layouts.bootstrap')

@section('content')
    <div style="height: 400px; width: 900px; margin: auto;">
        <canvas id="barchart"></canvas>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            var datas = {{ json_encode($datas) }}
            var barcanvas = $("#barchart");
            var barchart = new Chart(barcanvas, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'New User Growth, 2020',
                        data: datas,
                        backgroundColor: ["red", "orang", "yellow", "green", "blue", "indigo", "violet", "purple", "pink", "silver", "gold", "brown"]
                    }]
                },
                options: {
                    scales: {
                        yAxis: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        })
    </script>
@endpush

@push('library')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js" integrity="sha512-CQBWl4fJHWbryGE+Pc7UAxWMUMNMWzWxF4SQo9CgkJIN1kx6djDQZjh3Y8SZ1d+6I+1zze6Z7kHXO7q3UyZAWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
