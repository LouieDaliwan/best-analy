<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-3 dt-secondary">@lang('Debt Ratio Score')</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 chart-analysis">
      <div class="card mb-5">
        <div class="card-body">
          <canvas height="100" id="debt_ratio"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-12 comment-analysis">
        <div class="row">
          <div class="col-auto mt-1">
            {{-- SVG arrow --}}
            <span style="font-size: 17px;">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-bottom: 6px;" xml:space="preserve" width="17px" height="17px"><g><g>
                <g>
                  <path d="M508.875,248.458l-160-160c-3.063-3.042-7.615-3.969-11.625-2.313c-3.99,1.646-6.583,5.542-6.583,9.854v21.333    c0,2.833,1.125,5.542,3.125,7.542l109.792,109.792H10.667C4.771,234.667,0,239.437,0,245.333v21.333    c0,5.896,4.771,10.667,10.667,10.667h432.917L333.792,387.125c-2,2-3.125,4.708-3.125,7.542V416c0,4.313,2.594,8.208,6.583,9.854    c1.323,0.552,2.708,0.813,4.083,0.813c2.771,0,5.5-1.083,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#107E7D"/>
                </g>
              </g></g> </svg>
            </span>
            {{-- SVG arrow --}}
             &nbsp;
          </div>
          <div class="col">
            <p>{{ $data['analysis:financial']['debt_ratio']['comment'][0] }}</p>
          </div>
        </div>
    </div>
  </div>
</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script>
$(document).ready(function() {
  var ctx = document.getElementById("debt_ratio").getContext('2d');
  var chartColors = {
    primary:           'rgb(4, 75, 127, 1)',
    primaryLighten1:   'rgb(4, 75, 127, 0.8)',
    primaryLighten2:   'rgb(4, 75, 127, 0.5)',
    muted:              'rgb(239, 244, 250)'
  };
  var dataset = {!! json_encode($data['analysis:financial']['debt_ratio']['chart']['dataset']) !!}
  dataset = dataset.map(function (item) {
    var gradient = ctx.createLinearGradient(0, 0, 0, 200);
        gradient.addColorStop(0, item.backgroundColor[0]);
        gradient.addColorStop(1, item.backgroundColor[1]);

    return Object.assign({}, item, {
      backgroundColor: gradient,
      hoverBackgroundColor: chartColors.primary
    })
  });
  var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      {{-- labels: {!! json_encode(collect(
        $data['analysis:financial']['debt_ratio']['chart']['labels'])->values()->toArray()
      ) !!}, --}}
      labels: [
        ['{{ __("Debt Ratio") }}'],
      ],
      datasets: dataset,
    },
    options: {
      cornerRadius: 20,
      legend: {
        position: 'bottom',
        display: true,
        labels: {
          padding: 50,
          usePointStyle: true,
          boxWidth: 5,
          fontColor: '#044b7f',
          fontFamily: 'Rubik, sans-serif',
          fontSize: 15,
        }
      },
      scales: {
        xAxes: [{
          barPercentage: 0.3,
          gridLines: {
            zeroLineColor: chartColors.primaryLighten2,
            display: false,
            color: chartColors.muted,
          },
          ticks: {
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 15,
          },
        }],
        maxBarThickness: 3,
        yAxes: [{
          gridLines: {
            zeroLineColor: chartColors.primaryLighten2,
            display: true,
            borderDash: [8, 4],
            color: chartColors.muted,
          },
          ticks: {
            beginAtZero: true,
            padding: 20,
            maxTicksLimit: 5,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 12,
            // min: -100,
            // max: 100,
            callback: function(value){return value}
          }
        }]
      }
    },
  });
});
</script>
