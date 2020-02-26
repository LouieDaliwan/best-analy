<section class="section">
  <h1 class="section__title text-center section__subtitle--lead">
    @lang('Key Enablers')
  </h1>

  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="220" valign="center">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <canvas width="220" class="my-3" id="key-enablers"></canvas>
            </td>
          </tr>
        </table>
      </td>
      <td style="font-size: 0; line-height: 0;" width="20">
        &nbsp;
      </td>
      <td valign="top">
        <table cellpadding="0" cellspacing="0" width="100%" class="mb-3">
          <tr>
            <td>
              <p>@lang("The Financial management practices and procedures were further analysed based on how well the documentation procedures, personnel, ICT and work processes were being managed.")</p>
            </td>
          </tr>
          <tr>
            <td>
              <div class="card">
                <table class="striped" cellpadding="0" cellspacing="0" width="100%">
                  @foreach ($data['key:enablers']['data'] as $key => $enabler)
                    <tr>
                      <th class="pa-3">@lang($key)</th>
                      <td class="pa-3 border-left">@lang($enabler['comment'])</td>
                    </tr>
                  @endforeach
                </table>
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
  var ctx = document.getElementById("key-enablers").getContext('2d');
  var chartColors = {
    primary:           'rgba(22, 123, 195, 1)',
    primaryLighten1:   'rgba(22, 123, 195, 0.8)',
    primaryLighten2:   'rgba(22, 123, 195, 0.5)',
    primaryLighten3:   'rgba(22, 123, 195, 0.3)',
  };
  var barChart = new Chart(ctx, {
    type: 'radar',
    data: {
      labels: {!! json_encode(collect($data['key:enablers']['chart']['labels'])->values()->toArray()) !!},
      datasets: [
        {
          data: {!! json_encode(collect($data['key:enablers']['chart']['dataset'])->values()->toArray()) !!},
          backgroundColor: [
            chartColors.primary,
            chartColors.primaryLighten1,
            chartColors.primaryLighten2,
            chartColors.primaryLighten3,
          ]
        }
      ],
    },
    options: {
      animation: {
        duration: 0
      },
      legend: {
        display: false,
        fullWidth: false,
        position: 'bottom',
        labels: {
          display: true,
          fontColor: '#000000',
          fontSize: 7,
        }
      },
    },
  });
});
</script>
