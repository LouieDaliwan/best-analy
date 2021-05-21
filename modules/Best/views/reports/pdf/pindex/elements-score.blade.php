{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section class="mt-2">
  <div class="row">
    <div class="col-md-12">
      <div>
        <h4 class="mb-3 dt-secondary">@lang($data['pindex']) @lang("Element's Score")</h4>
      </div>
    </div>
  </div>

  <table>
    <tr>
      <td valign="top">
        <table>
          <tr>
            <td>
              @foreach ($data['box:comments'] as $comments)
              @if (count($comments) > 0)
                <tr>
                  <td valign="top">
                    <div class="mr-3">
                      {{-- SVG arrow --}}
                      @if (app()->getLocale() == 'ar')
                      <div class="ml-3">
                        <span style="font-size: 15px;">
                          <svg width="16" height="16" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                      @if (app()->getLocale() == 'en')
                        <span style="font-size: 15px;">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-bottom: 6px;" xml:space="preserve" width="15px" height="15px"><g><g>
                            <g>
                              <path d="M508.875,248.458l-160-160c-3.063-3.042-7.615-3.969-11.625-2.313c-3.99,1.646-6.583,5.542-6.583,9.854v21.333    c0,2.833,1.125,5.542,3.125,7.542l109.792,109.792H10.667C4.771,234.667,0,239.437,0,245.333v21.333    c0,5.896,4.771,10.667,10.667,10.667h432.917L333.792,387.125c-2,2-3.125,4.708-3.125,7.542V416c0,4.313,2.594,8.208,6.583,9.854    c1.323,0.552,2.708,0.813,4.083,0.813c2.771,0,5.5-1.083,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#107E7D"/>
                            </g>
                          </g></g> </svg>
                        </span>
                      @endif
                      {{-- SVG arrow --}}
                    </div>
                  </td>
                  <td valign="top">
                    @php($comments = (array) $comments)
                    @foreach ($comments ?? [] as $comment)
                      <p class="mb-1">@lang($comment)</p>
                    @endforeach
                  </td>
                </tr>
              @endif
              @endforeach
            </td>
          </tr>
        </table>
      </td>
      <td valign="top">
        <table>
          <tr>
            <td>
              <div class="mr-3" style="width: 400px; height: 200px;">
                <canvas id="elements-score-{{ $data['pindex:code'] }}"></canvas>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</section>

<script>
$(document).ready(function() {
  var ctx = document.getElementById("elements-score-{{ $data['pindex:code'] }}").getContext('2d');
  var chartColors = {
    primary:           'rgba(22, 123, 195, 1)',
    primaryLighten1:   'rgba(22, 123, 195, 0.8)',
    primaryLighten2:   'rgba(22, 123, 195, 0.5)',
    muted:             'rgb(239, 244, 250)',
    font:              'rgb(151, 172, 203)',
  };
  var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, '#B721FF');
      gradient.addColorStop(1, '#21D4FD');
  var barChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: {!! json_encode(collect($data['elements:charts']['labels'])->values()->toArray()) !!},
      datasets: [
        {
          data: {!! json_encode(collect($data['elements:charts']['data'])->values()->toArray()) !!},
          backgroundColor: gradient,
          hoverBackgroundColor: chartColors.primary,
          // hoverBorderWidth: 1,
        }
      ],
    },
    options: {
      animation: false,
      cornerRadius: 20,
      responsive: true,
      tooltips: {
        enabled: true,
        mode: 'single',
        callbacks: {
          label: function(tooltipItems, data) {
            return tooltipItems.xLabel+'%';
          }
        }
      },
      layout: {
        padding: {
          right: 20
        }
      },
      legend: {
        display: false,
        position: 'bottom',
        labels: {
          fontColor: '#044b7f',
          fontFamily: 'Rubik, sans-serif',
          fontSize: 12,
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          },
          ticks: {
            beginAtZero: true,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 12,
            max: 100,
            callback: function(value){return value+ "%"}
          },
        }],
        maxBarThickness: 5,
        yAxes: [{
          barPercentage: 0.3,
          gridLines: {
            display: false,
          },
          ticks: {
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 12,
          }
        }]
      }
    },
  });
});
</script>
