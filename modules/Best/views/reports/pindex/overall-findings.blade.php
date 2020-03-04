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
        <canvas id="overall-findings"></canvas>
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

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>

<script>
  var value = {!! json_encode(collect($data['overall:total'])->values()->toArray()) !!};
  var data = {
    labels: ["Test"],
    datasets: [
      {
        data: [value, 100-value],
        backgroundColor: [
          "#ed8a3b",
        ],
      }]
  };
  var myChart = new Chart(document.getElementById('overall-findings'), {
    type: 'doughnut',
    data: data,
    options: {
      animation: {
        duration: 0.1
      },
      responsive: true,
      legend: {
        display: false
      },
      cutoutPercentage: 60,
    }
  });
  textCenter(value);
  function textCenter(val) {
    Chart.pluginService.register({
      beforeDraw: function(chart) {
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
