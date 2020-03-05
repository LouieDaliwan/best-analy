<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-5 dt-secondary text-capitalize">@lang('Overall Organisations Enablers Metrics')</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-sm-12">
      <p>@lang($data['overall:enablers']['comment:first'])</p>
      <p>@lang($data['overall:enablers']['comment:second'])</p>

      <div class="card">
        <div class="card-body">
          <canvas id="overall-enablers"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12">
      <div class="mb-3">
        <div class="row four-tec">
          <div class="col-auto">
            <div class="imgWorkflow card">
              <div class="card-body p-3">
                <img height="32" src="{{ asset('reports/assets/icons/workflow-processes.svg') }}">
              </div>
            </div>
          </div>
          <div class="col">
            <h4>@lang('Workflow Processess')</h4>
            <p class="mb-0">@lang($data['overall:enablers']['enablers']['Workflow Processess'])</p>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <div class="row four-tec">
          <div class="col-auto">
            <div class="imgTalent card">
              <div class="card-body p-3">
                <img height="32" src="{{ asset('reports/assets/icons/talent.svg') }}">
              </div>
            </div>
          </div>
          <div class="col">
            <h4>@lang('Talent')</h4>
            <p class="mb-0">@lang($data['overall:enablers']['enablers']['Talent'])</p>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <div class="row four-tec">
          <div class="col-auto">
            <div class="imgDocumentation card">
              <div class="card-body p-3">
                <img height="32" src="{{ asset('reports/assets/icons/documentation.svg') }}">
              </div>
            </div>
          </div>
          <div class="col">
            <h4>@lang('Documentation')</h4>
            <p class="mb-0">@lang($data['overall:enablers']['enablers']['Documentation'])</p>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <div class="row four-tec">
          <div class="col-auto">
            <div class="imgTechnology card">
              <div class="card-body p-3">
                <img height="32" src="{{ asset('reports/assets/icons/technology.svg') }}">
              </div>
            </div>
          </div>
          <div class="col">
            <h4>@lang('Technology')</h4>
            <p class="mb-0">@lang($data['overall:enablers']['enablers']['Technology'])</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
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
      type: 'radar',
      data: {
        labels: {!! json_encode(collect($data['overall:enablers']['chart']['label'])->values()->toArray()) !!},
        datasets: [
          {
            backgroundColor: "rgba(16, 126, 125, 0.3)",
            borderCapStyle: "butt",
            borderColor: "rgba(16, 126, 125, 1)",
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: "miter",
            data: {!! json_encode(collect($data['overall:enablers']['chart']['data'])->values()->toArray()) !!},
            fill: true,
            lineTension: 0,
            pointBorderColor: "rgba(16, 126, 125, 1)",
            pointBorderWidth: 2,
            pointHitRadius: 10,
            pointHoverBackgroundColor: "rgba(16, 126, 125, 1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 8,
            pointRadius: 4,
            spanGaps: false,
            pointBackgroundColor: "rgba(16, 126, 125, 0.5)",
          }
        ],
      },
      options: {
        legend: {
          display: false,
        },
      }
    });
  });
</script>
