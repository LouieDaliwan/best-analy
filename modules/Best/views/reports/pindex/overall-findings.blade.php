<section class="section">
  <h1 class="section__title text-center section__subtitle--lead">
    @lang('Overall Findings')
  </h1>

  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="220" valign="center">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <canvas width="220" height="100" id="overall-findings"></canvas>
            </td>
          </tr>
        </table>
      </td>
      <td style="font-size: 0; line-height: 0;" width="20">
        &nbsp;
      </td>
      <td valign="center">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <div class="card">
                <div class="card-body">
                  <p>@lang($data['overall:comment'])</p>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
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
          "rgba(22, 123, 195, 1)",
          "#c4d1de"
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
      cutoutPercentage: 80,
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
        var fontSize = (height / 60).toFixed(2);
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
