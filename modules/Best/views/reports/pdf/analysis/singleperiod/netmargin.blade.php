<div class="mx-4 mb-5">
  <div class="py-2" style="font-weight: bold; border-bottom: 1px solid #f5f5f5;">@lang('Net Margin Score')</div>
    <div class="mb-3 text-center">
      <canvas height="360" width="400" id="net_margin" style="margin: auto;" class="mt-5 mb-2"></canvas>
    </div>
    <p class="mb-0 px-5" style="font-size: 12px; line-height: 1.5;">
      @if (app()->getLocale() == 'ar')
        <span style="font-size: 17px;">
          <svg width="17px" height="17px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
              <g>
                <path fill="#107E7D" d="M501.333,234.667H68.417l109.792-109.792c2-2,3.125-4.708,3.125-7.542V96c0-4.313-2.594-8.208-6.583-9.854
                  c-1.323-0.552-2.708-0.813-4.083-0.813c-2.771,0-5.5,1.083-7.542,3.125l-160,160c-4.167,4.167-4.167,10.917,0,15.083l160,160
                  c3.063,3.042,7.615,3.969,11.625,2.313c3.99-1.646,6.583-5.542,6.583-9.854v-21.333c0-2.833-1.125-5.542-3.125-7.542
                  L68.417,277.333h432.917c5.896,0,10.667-4.771,10.667-10.667v-21.333C512,239.438,507.229,234.667,501.333,234.667z"/>
              </g>
            </g>
          </svg>
        </span>
        @endif
        @if (app()->getLocale() == 'en')
          <span style="font-size: 17px;">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-bottom: 6px;" xml:space="preserve" width="17px" height="17px"><g><g>
              <g>
                <path d="M508.875,248.458l-160-160c-3.063-3.042-7.615-3.969-11.625-2.313c-3.99,1.646-6.583,5.542-6.583,9.854v21.333    c0,2.833,1.125,5.542,3.125,7.542l109.792,109.792H10.667C4.771,234.667,0,239.437,0,245.333v21.333    c0,5.896,4.771,10.667,10.667,10.667h432.917L333.792,387.125c-2,2-3.125,4.708-3.125,7.542V416c0,4.313,2.594,8.208,6.583,9.854    c1.323,0.552,2.708,0.813,4.083,0.813c2.771,0,5.5-1.083,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#107E7D"/>
              </g>
            </g></g></svg>
          </span>
        @endif
      {{ $data['analysis:financial']['net_margin']['comment'][0] }}
    </p>
</div>

<script>
  $(document).ready(function() {
    var ctx = document.getElementById("net_margin").getContext('2d');
    var chartColors = {
      primary:           'rgb(4, 75, 127, 1)',
      primaryLighten1:   'rgb(4, 75, 127, 0.8)',
      primaryLighten2:   'rgb(4, 75, 127, 0.5)',
      muted:              'rgb(239, 244, 250)'
    };
    var dataset = {!! json_encode($data['analysis:financial']['net_margin']['chart']['dataset']) !!}
    var labels = {!!  json_encode(collect($data['analysis:financial']['net_margin']['chart']['labels']['pdf'])->values()->toArray()); !!}

    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: dataset,
      },
      options: {
        cornerRadius: 20,
        animation: {
          duration: 1,
          onComplete: function () {
            var ctx = this.chart.ctx;
            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';
            this.data.datasets.forEach(function (dataset) {
              for (var i = 0; i < dataset.data.length; i++) {
                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                    scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                ctx.fillStyle = '#2F4858';
                var y_pos = model.y - 5;
                // Make sure data value does not get overflown and hidden
                // when the bar's value is too close to max value of scale
                // Note: The y value is reverse, it counts from top down
                if ((scale_max - model.y) / scale_max >= 0.93)
                    y_pos = model.y + 20;
                var data = dataset.data[i] + '%';
                // ctx.fillText(data, model.x, y_pos);
              }
            });
          }
        },
        legend: {
          display: false,
        },
        scales: {
          xAxes: [{
            barPercentage: 0.5,
            ticks: {
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 15,
            },
          }],
          maxBarThickness: 3,
          yAxes: [{
            ticks: {
              beginAtZero: true,
              padding: 20,
              maxTicksLimit: 5,
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
              callback: function( value ){ return value + "%" },
            },
          }]
        },
        plugins: {
          autocolors: false,
          annotation: {
            type: 'line',
            borderColor: 'red',
            borderWidth: 3,
            scaleID: 'y-axis-0',
            value: 20,
          }
        }
      },
    });
  });
</script>
