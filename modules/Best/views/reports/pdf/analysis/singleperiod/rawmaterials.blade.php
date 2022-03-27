<div class="py-1 px-2 mb-2" style="background-color: rgba(0,0,0,0.3); font-weight: bold">@lang('Raw Materials Score')</div>

<div class="mb-3 w-100" style="height: 200px;">
  <div style="width: 500px; height: 200px;">
    <canvas id="raw_materials" style="width: 500px; height: 200px;"></canvas>
  </div>
</div>

<p class="mb-1" style="text-indent: 40px;">{{ $data['analysis:financial']['raw_materials']['comment'][0] }}</p>
  
  <script>
  $(document).ready(function() {
    var ctx = document.getElementById("raw_materials").getContext('2d');
    var dataset = {!! json_encode($data['analysis:financial']['raw_materials']['chart']['dataset']) !!}
    console.log(dataset)
  
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          ['{{ __("Raw Materials Margin") }}', ],
        ],
        datasets: [
          {
            data: dataset[0]['data'],
            backgroundColor: '#a2d5ac',
          },
        ],
      },
      options: {
        animation: false,
        legend: false,
        scales: {
          xAxes: [{
            barPercentage: 0.3,
            gridLines: {
              display: false,
            },
            ticks: {
              beginAtZero: true,
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
            },
          }],
          maxBarThickness: 5,
          yAxes: [{
            barPercentage: 0.1,
            gridLines: {
              display: false,
            },
            ticks: {
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
              callback: function(value){return value}
            }
          }]
        }
      },
    });
  });
  </script>
  