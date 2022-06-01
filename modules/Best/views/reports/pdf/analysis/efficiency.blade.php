<section class="mt-3">
  <h3 class="dt-secondary">@lang('Efficiency Analysis')</h3>

  <table width="100%">
    <tr>
      <td valign="top" width="50%">
        <div class="chart-analysis">
          <div style="width: 700px; height: 200px;">
            <canvas id="efficiency" style="width: 700px; height: 200px;"></canvas>
          </div>
        </div>

        {{-- label --}}
        <div style="height: 20px;"></div>
        <table align="center" width="50%">
          <tr>
            @foreach ($data['analysis:financial']['efficiency']['charts']['dataset'] as $resource)
              <td>
                <span class="circular p-2" style="background: {{ $resource['bg'] }};"></span>
                &nbsp;
                <span>{{ $resource['label'] }}</span>
              </td>
            @endforeach
          </tr>
        </table>
        {{-- label --}}
      </td>
      <td valign="top" width="50%">
        <div class="comment-analysis">
          <table>
            @foreach ($data['analysis:financial']['efficiency']['comments'] as $key => $comments)
              @if(! empty($data['analysis:financial']['efficiency']['comments'][$key]))
                <tr>
                  <td valign="top">
                    <div class="mr-3">
                      @if (app()->getLocale() == 'ar' && $comments[2] != '')
                        <div class="ml-3">
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
                        </div>
                      @endif
                      @if (app()->getLocale() == 'en' && $comments[2] != '')
                        <span style="font-size: 17px;">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-bottom: 6px;" xml:space="preserve" width="17px" height="17px"><g><g>
                            <g>
                              <path d="M508.875,248.458l-160-160c-3.063-3.042-7.615-3.969-11.625-2.313c-3.99,1.646-6.583,5.542-6.583,9.854v21.333    c0,2.833,1.125,5.542,3.125,7.542l109.792,109.792H10.667C4.771,234.667,0,239.437,0,245.333v21.333    c0,5.896,4.771,10.667,10.667,10.667h432.917L333.792,387.125c-2,2-3.125,4.708-3.125,7.542V416c0,4.313,2.594,8.208,6.583,9.854    c1.323,0.552,2.708,0.813,4.083,0.813c2.771,0,5.5-1.083,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#107E7D"/>
                            </g>
                          </g></g> </svg>
                        </span>
                      @endif
                    </div>
                  </td>
                  <td valign="top">
                    @foreach ($comments as $comment)
                      <p class="mb-1">{{ $comment }}</p>
                    @endforeach
                  </td>
                </tr>
              @endif
            @endforeach
          </table>
        </div>
      </td>
    </tr>
  </table>
</section>

<script>
$(document).ready(function() {
  var ctx = document.getElementById("efficiency").getContext('2d');
  var dataset = {!! json_encode($data['analysis:financial']['efficiency']['charts']['dataset']) !!}

  var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        ['{{ __("Trade") }}', '{{ __("Receivables - days") }}'],
        ["Trade", "Payable - days"],
        ["Asset", "Turnover"],
        ["Inventory", "Turnover"],
      ],
      datasets: dataset
    },
    options: {
      animation: {
        duration: 1,
        onComplete: function () {
            var chartInstance = this.chart,
                ctx = chartInstance.ctx;
            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';

            this.data.datasets.forEach(function (dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                meta.data.forEach(function (bar, index) {
                    var data = dataset.data[index] + '%';
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                });
            });
        }
      },
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
