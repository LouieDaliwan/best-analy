{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <p class="font-weight-bold mb-1 dt-secondary">@lang('Overall Findings')</p>
      </div>
    </div>
  </div>

  <table width="100%">
    <tr>
      <td v-align="middle">
        <div class="mx-3" style="width: 200px; height: 200px;">
          <svg width="100%" height="100%" viewBox="0 0 42 42" class="donut">
            <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff"></circle>
            <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#eeeeee" stroke-width="3"></circle>
            <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="{{ $data['pindex:color'] }}" stroke-dasharray="{{ round($data['overall:total']) }} {{ 100 - round($data['overall:total']) }}" stroke-dashoffset="25" stroke-width="3"></circle>
            <g class="chart-text">
              <text x="50%" y="55%" class="chart-number" fill="{{ $data['pindex:color'] }}">
                {{ round($data['overall:total']) }}%
              </text>
            </g>
          </svg>
          <!-- <canvas id="overall-{{ $data['taxonomy']['id'] }}" style="display: none; width: 100%;"></canvas> -->
        </div>
      </td>
      <td v-align="middle">
        <canvas id="elements-score-{{ $data['pindex:code'] }}" width="500px"></canvas>
      </td>
    </tr>
  </table>
</section>

@push('js')
<script>
  // Chart.pluginService.register({
  //   afterUpdate: function (chart) {
  //     if (chart.config.options.elements.center) {
  //       var helpers = Chart.helpers;
  //       var centerConfig = chart.config.options.elements.center;
  //       var globalConfig = Chart.defaults.global;
  //       var ctx = chart.chart.ctx;

  //       var fontStyle = helpers.getValueOrDefault(centerConfig.fontStyle, globalConfig.defaultFontStyle);
  //       var fontFamily = helpers.getValueOrDefault(centerConfig.fontFamily, globalConfig.defaultFontFamily);

  //       if (centerConfig.fontSize)
  //         var fontSize = centerConfig.fontSize;
  //         // figure out the best font size, if one is not specified
  //       else {
  //         ctx.save();
  //         var fontSize = helpers.getValueOrDefault(centerConfig.minFontSize, 1);
  //         var maxFontSize = helpers.getValueOrDefault(centerConfig.maxFontSize, 256);
  //         var maxText = helpers.getValueOrDefault(centerConfig.maxText, centerConfig.text);

  //         do {
  //           ctx.font = helpers.fontString(fontSize, fontStyle, fontFamily);
  //           var textWidth = ctx.measureText(maxText).width;

  //           // check if it fits, is within configured limits and that we are not simply toggling back and forth
  //           if (textWidth < chart.innerRadius * 2 && fontSize < maxFontSize)
  //             fontSize += 1;
  //           else {
  //             // reverse last step
  //             fontSize -= 1;
  //             break;
  //           }
  //         } while (true)
  //         ctx.restore();
  //       }

  //       // save properties
  //       chart.center = {
  //         font: helpers.fontString(fontSize, fontStyle, fontFamily),
  //         fillStyle: helpers.getValueOrDefault(centerConfig.fontColor, globalConfig.defaultFontColor)
  //       };
  //     }
  //   },
  //   afterDraw: function (chart) {
  //     if (chart.center) {
  //       var centerConfig = chart.config.options.elements.center;
  //       var ctx = chart.chart.ctx;

  //       ctx.save();
  //       ctx.font = chart.center.font;
  //       ctx.fillStyle = chart.center.fillStyle;
  //       ctx.textAlign = 'center';
  //       ctx.textBaseline = 'middle';
  //       var centerX = (chart.chartArea.left + chart.chartArea.right) / 2;
  //       var centerY = (chart.chartArea.top + chart.chartArea.bottom) / 2;
  //       ctx.fillText(centerConfig.text, centerX, centerY);
  //       ctx.restore();
  //     }
  //   },
  // })
  // var overallFindings = parseInt('{!! $data['overall:total'] !!}').toFixed(0);
  // var myChart = new Chart(document.getElementById('overall-{{ $data['taxonomy']['id'] }}'), {
  //   type: 'bar',
  //   data: {
  //     labels: ["Overall Findings"],
  //     datasets: [
  //       {
  //         data: [overallFindings, 100-overallFindings],
  //         backgroundColor: [
  //           "{{ $data['pindex:color'] }}",
  //         ],
  //       }
  //     ],
  //   },
  //   options: {
  //     animation: false,
  //     responsive: false,
  //     legend: {
  //       display: false
  //     },
  //     cutoutPercentage: 70,
  //     elements: {
  //       arc: {
  //         roundedCornersFor: 0
  //       },
  //       center: {
  //         text: overallFindings + '%',
  //         fontColor: "{{ $data['pindex:color'] }}",
  //         fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
  //         fontStyle: 'bold',
  //         fontSize: 15,
  //       }
  //     },
  //   }
  // });
</script>
@endpush
