{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section>
  <h4 class="mb-1 dt-secondary text-capitalize">@lang("Overall Organisation's Enablers Metrics")</h4>
  @foreach ($data['overall:enablers']['comment:first'] as $comment)
    <p class="mb-1">@lang($comment)</p>
  @endforeach
  @foreach ($data['overall:enablers']['comment:second'] as $comment)
    <p class="mb-1">@lang($comment)</p>
  @endforeach

  <div class="mt-2" style="width: 1000px; height: 100px;">
    <canvas id="overall-enablers" style="width: 1000px; height: 100px;"></canvas>
  </div>

  <table>
    <tr>
      <td>
        <table>
          <tr>
            <td>
              <tr>
                <td valign="top">
                  <div class="imgDocumentation circular mr-3">
                    <div class="p-3">
                      <img height="15" src="{{ public_path('reports/assets/icons/documentation.svg') }}">
                    </div>
                  </div>
                </td>
                <td valign="top">
                  <h4 class="mb-0">@lang('Documentation')</h4>
                  @foreach ($data['overall:enablers']['enablers']['Documentation'] as $comment)
                    <p class="mb-2">{{ $comment }}</p>
                  @endforeach
                </td>
              </tr>
            </td>
            <td>
              <tr>
                <td valign="top">
                  <div class="imgTalent circular mr-3">
                    <div class="p-3">
                      <img height="15" src="{{ public_path('reports/assets/icons/talent.svg') }}">
                    </div>
                  </div>
                </td>
                <td valign="top">
                  <h4 class="mb-0">@lang('Talent')</h4>
                  @foreach ($data['overall:enablers']['enablers']['Talent'] as $comment)
                    <p class="mb-2">{{ $comment }}</p>
                  @endforeach
                </td>
              </tr>
            </td>
          </tr>
        </table>
      </td>

      <td>
        <table>
          <tr>
            <td>
              <tr>
                <td valign="top">
                  <div class="imgTechnology circular mr-3">
                    <div class="p-3">
                      <img height="15" src="{{ public_path('reports/assets/icons/technology.svg') }}">
                    </div>
                  </div>
                </td>
                <td valign="top">
                  <h4 class="mb-0">@lang('Technology')</h4>
                  @foreach ($data['overall:enablers']['enablers']['Technology'] as $comment)
                    <p class="mb-2">{{ $comment }}</p>
                  @endforeach
                </td>
              </tr>
            </td>

            <td>
              <tr>
                <td valign="top">
                  <div class="imgWorkflow Processess circular mr-3">
                    <div class="p-3">
                      <img height="15" src="{{ public_path('reports/assets/icons/workflow-processes.svg') }}">
                    </div>
                  </div>
                </td>
                <td valign="top">
                  <h4 class="mb-0">@lang('Workflow Processess')</h4>
                  @foreach ($data['overall:enablers']['enablers']['Workflow Processess'] as $comment)
                    <p class="mb-2">{{ $comment }}</p>
                  @endforeach
                </td>
              </tr>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</section>

<script>
  $(document).ready(function() {
    var ctx = document.getElementById("overall-enablers").getContext('2d');
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
      type: 'bar',
      data: {
        labels: {!! json_encode(collect($data['overall:enablers']['chart']['label'])->values()->toArray()) !!},
        datasets: [
          {
            data: {!! json_encode(collect($data['overall:enablers']['chart']['data'])->values()->toArray()) !!},
            backgroundColor: "rgba(16, 126, 125, 1)",
            hoverBackgroundColor: chartColors.primary,
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
              min: 0,
              max: 100,
              callback: function(value){return value+ "%"}
            }
          }]
        }
      },
    });
  });
</script>
