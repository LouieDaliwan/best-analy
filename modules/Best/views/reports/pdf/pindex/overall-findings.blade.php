{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <p class="font-weight-bold mb-1 dt-secondary">@lang('Overall Findings')</p>
      </div>
    </div>
  </div>

  <table>
    <tr>
      <td v-align="middle">
        <div class="mr-3" style="width: 80px; height: 80px;">
          <canvas id="overall-{{ $data['taxonomy']['id'] }}"></canvas>
        </div>
      </td>
      <td v-align="middle"><p class="mb-0">@lang($data['overall:comment'])</p></td>
    </tr>
  </table>
</section>

<script>
  Chart.pluginService.register({
    afterUpdate: function (chart) {
      if (chart.config.options.elements.center) {
        var helpers = Chart.helpers;
        var centerConfig = chart.config.options.elements.center;
        var globalConfig = Chart.defaults.global;
        var ctx = chart.chart.ctx;

        var fontStyle = helpers.getValueOrDefault(centerConfig.fontStyle, globalConfig.defaultFontStyle);
        var fontFamily = helpers.getValueOrDefault(centerConfig.fontFamily, globalConfig.defaultFontFamily);

        if (centerConfig.fontSize)
          var fontSize = centerConfig.fontSize;
          // figure out the best font size, if one is not specified
        else {
          ctx.save();
          var fontSize = helpers.getValueOrDefault(centerConfig.minFontSize, 1);
          var maxFontSize = helpers.getValueOrDefault(centerConfig.maxFontSize, 256);
          var maxText = helpers.getValueOrDefault(centerConfig.maxText, centerConfig.text);

          do {
            ctx.font = helpers.fontString(fontSize, fontStyle, fontFamily);
            var textWidth = ctx.measureText(maxText).width;

            // check if it fits, is within configured limits and that we are not simply toggling back and forth
            if (textWidth < chart.innerRadius * 2 && fontSize < maxFontSize)
              fontSize += 1;
            else {
              // reverse last step
              fontSize -= 1;
              break;
            }
          } while (true)
          ctx.restore();
        }

        // save properties
        chart.center = {
          font: helpers.fontString(fontSize, fontStyle, fontFamily),
          fillStyle: helpers.getValueOrDefault(centerConfig.fontColor, globalConfig.defaultFontColor)
        };
      }
    },
    afterDraw: function (chart) {
      if (chart.center) {
        var centerConfig = chart.config.options.elements.center;
        var ctx = chart.chart.ctx;

        ctx.save();
        ctx.font = chart.center.font;
        ctx.fillStyle = chart.center.fillStyle;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        var centerX = (chart.chartArea.left + chart.chartArea.right) / 2;
        var centerY = (chart.chartArea.top + chart.chartArea.bottom) / 2;
        ctx.fillText(centerConfig.text, centerX, centerY);
        ctx.restore();
      }
    },
  })
  var overallFindings = parseInt('{!! $data['overall:total'] !!}').toFixed(0);
  var myChart = new Chart(document.getElementById('overall-{{ $data['taxonomy']['id'] }}'), {
    type: 'doughnut',
    data: {
      labels: ["Overall Findings"],
      datasets: [
        {
          data: [overallFindings, 100-overallFindings],
          backgroundColor: [
            "{{ $data['pindex:color'] }}",
          ],
        }
      ],
    },
    options: {
      animation: false,
      responsive: true,
      legend: {
        display: false
      },
      cutoutPercentage: 70,
      elements: {
        arc: {
          roundedCornersFor: 0
        },
        center: {
          text: overallFindings + '%',
          fontColor: "{{ $data['pindex:color'] }}",
          fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
          fontStyle: 'bold',
          fontSize: 15,
        }
      },
    }
  });
</script>
