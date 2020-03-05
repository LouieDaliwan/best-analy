{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-5 dt-secondary">@lang('Overall Findings')</h1>
      </div>
    </div>
  </div>

  <div class="row align-items-center justify-content-center">
    <div class="col-md-3 col-sm-12">
      <div class="mb-3">
        <canvas id="overall-{{ $data['taxonomy']['id'] }}"></canvas>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <div class="card-body">
          <p>@lang($data['overall:comment'])</p>
        </div>
      </div>
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
            "#ed8a3b",
          ],
        }
      ],
    },
    options: {
      responsive: true,
      legend: {
        display: false
      },
      cutoutPercentage: 60,
    }
  });
  textCenter(overallFindings, myChart);
  function textCenter(val, chart) {
    Chart.pluginService.register({
      beforeDraw: function(chartx) {
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
