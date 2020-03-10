{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-3 dt-secondary">@lang('Overall Findings')</h1>
      </div>
    </div>
  </div>

  <div class="row align-items-center justify-content-center">
    <div class="col-md-3 col-sm-12">
      <canvas id="overall-{{ $data['taxonomy']['id'] }}"></canvas>
    </div>

    <div class="col">
      <p class="mb-0">@lang($data['overall:comment'])</p>
    </div>
  </div>
</section>

<script>
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
      responsive: true,
      legend: {
        display: false
      },
      cutoutPercentage: 70,
    }
  });
  textCenter(overallFindings, myChart);
  function textCenter(val, chart) {
    Chart.pluginService.register({
      afterDraw: function(chartx) {
        var width = chart.chart.width,
            height = chart.chart.height,
            ctx = chart.chart.ctx;
        ctx.restore();
        var fontSize = (height / 100).toFixed(2);
        ctx.font = fontSize + "em sans-serif";
        ctx.textBaseline = "middle";
        var text = val+"%",
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;
        ctx.fillText(text, textX, textY);
        ctx.save();
      }
    });
  }
</script>
