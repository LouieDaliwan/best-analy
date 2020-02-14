<section class="section">
  <h1 class="section__title section__title--lead">@lang('Organisation Profile')</h1>
  <div class="section__body mx-4 font-weight-bold">
    <table class="table table-sm table-borderless table-vcenter mb-3">
      <thead>
        <tr>
          <td>@lang('Organisation Name')&nbsp; ::</td>
          <td>@lang('Barakah Services LLC')</td>
          <td>@lang('Industry')&nbsp; ::</td>
          <td></td>
        </tr>
        <tr>
          <td width="280">@lang('Organisation Registration No.')&nbsp; ::</td>
          <td>12345</td>
          <td width="160">@lang('Staff Strength')&nbsp; ::</td>
          <td>30</td>
        </tr>
      </thead>
      <tbody>
        <tr>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<section class="section">
  <h1 class="section__title section__title--lead">
    @lang('FMPI :: Financial Management Perfomrmance Index')
  </h1>
  <div class="section__body mx-4">
    <div class="card">
      <table>
        <tbody>
          <tr>
            <td width="50%">
              <div class="card-body">
                <canvas id="fmpi-doughnut"></canvas>
              </div>
            </td>
            <td>
              <div class="card-body">
                <ul>
                  <li>@lang('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam ab recusandae quam nisi vero, illum pariatur hic error consequatur eveniet inventore officiis eos non distinctio. Consequatur illo accusantium officiis, odit.')</li>
                  <li>@lang('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam ab recusandae quam nisi vero, illum pariatur hic error consequatur eveniet inventore officiis eos non distinctio. Consequatur illo accusantium officiis, odit.')</li>
                </ul>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="section">
  <table class="mb-3">
    <tbody>
      <tr>
        <td width="50%" style="vertical-align: top;">
          <h1 class="section__title section__title--lead best-primary text-uppercase mb-3">
            @lang('Overall Findings')
          </h1>
          <div class="section__body mx-4">
            <p>@lang('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis distinctio eius voluptate dolore quae placeat nulla voluptatibus hic modi. Illo sed, at. Mollitia a, animi minus! Magni, quaerat odio error!')</p>
            <p>@lang('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis distinctio eius voluptate dolore quae placeat nulla voluptatibus hic modi. Illo sed, at. Mollitia a, animi minus! Magni, quaerat odio error!')</p>
          </div>
        </td>
        <td width="50%">
          <h1 class="section__title section__title--lead best-primary text-uppercase mb-3">
            @lang('FINANCIAL MANAGEMENT ELEMENT\'S SCORE')
          </h1>
          <div class="section__body mx-4">
            <canvas id="fmpi-overall-findings"></canvas>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</section>

<section class="section">
  <h1 class="section__title section__title--lead best-primary text-uppercase mb-3">@lang('KEY ENABLERS')</h1>
  <div class="section__body mx-4">
    <p>@lang('The Financial management practices and procedures were further analysed based on how well the documentation procedures, personnel, ICT and work processes were being managed.')</p>
    <table class="mb-3">
      <tbody>
        <tr>
          <td width="50%">
            <canvas id="fmpi-key-enablers"></canvas>
          </td>
          <td width="50%">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td><p class="mr-3"><strong>Documentation</strong></p></td>
                  <td><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore mollitia, error nihil corporis. Nemo officiis sapiente maiores minus, tempora dolorum laborum ipsa neque, necessitatibus doloremque consequuntur. Animi, alias facere dolorum!</p></td>
                </tr>
                <tr>
                  <td><p class="mr-3"><strong>Talent</strong></p></td>
                  <td><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempora, perspiciatis reiciendis quo aut voluptatem obcaecati nihil, eos rerum? Voluptas pariatur inventore reprehenderit. Ratione repellat, doloribus facilis qui cupiditate.</p></td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<section class="section">
  <h1 class="section__title section__title--lead best-primary text-uppercase mb-3">@lang('KEY STRATEGIC RECOMMENDATIONS')</h1>
  <div class="section__body mx-4">
    <table>
      <tbody>
        <tr>
          <td>
            <td>
              <div class="mr-4 mb-3"><img height="48" src="{{ asset('reports/assets/icons/note.svg') }}" alt="Note"></div>
            </td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
          </td>

          <td width="30%">
            <td>
              <div class="mr-4 mb-3"><img height="48" src="{{ asset('reports/assets/icons/report.svg') }}" alt="Note"></div>
            </td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
          </td>
        </tr>
        <tr>
          <td>
            <td>
              <div class="mr-4 mb-3"><img height="48" src="{{ asset('reports/assets/icons/team.svg') }}" alt="Note"></div>
            </td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
          </td>

          <td width="30%">
            <td>
              <div class="mr-4 mb-3"><img height="48" src="{{ asset('reports/assets/icons/pyramid.svg') }}" alt="Note"></div>
            </td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<script>
  // fmpi-doughnut
  $(document).ready(function() {
    var ctx = document.getElementById("fmpi-doughnut").getContext('2d');
    var chartColors = {
      primary:           'rgba(22, 123, 195, 1)',
      primaryLighten1:   'rgba(22, 123, 195, 0.8)',
      primaryLighten2:   'rgba(22, 123, 195, 0.5)',
    };
    var barChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: [
          "Data 1",
          "Data 2",
          "Data 3",
        ],
        datasets: [
          {
            data: [60, 25, 15],
            backgroundColor: [
              chartColors.primary,
              chartColors.primaryLighten1,
              chartColors.primaryLighten2,
            ]
          }
        ],
      },
      options: {
        animation: {
          duration: 0
        },
        cutoutPercentage: 80,
        legend: {
          display: true,
          position: 'bottom',
          labels: {
            fontColor: '#95aac9',
            fontFamily: 'Rubik, sans-serif',
            usePointStyle: true,
            pointRadius: 1,
          }
        },
      },
    });
  });

  // fmpi-overall-findings
  $(document).ready(function() {
    var ctx = document.getElementById("fmpi-overall-findings").getContext('2d');
    var chartColors = {
      primary:           'rgba(22, 123, 195, 1)',
      primaryLighten1:   'rgba(22, 123, 195, 0.8)',
      primaryLighten2:   'rgba(22, 123, 195, 0.5)',
      muted:             'rgb(239, 244, 250)',
      font:              'rgb(151, 172, 203)',
    };
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          "Data 1",
          "Data 2",
          "Data 3",
        ],
        datasets: [
          {
            data: [30, 25, 20],
            backgroundColor: [
              chartColors.primary,
              chartColors.primaryLighten1,
              chartColors.primaryLighten2,
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
          position: 'bottom',
          labels: {
            fontColor: '#95aac9',
            fontFamily: 'Rubik, sans-serif',
            usePointStyle: true,
            pointRadius: 1,
          }
        },
        scales: {
          xAxes: [{
            barPercentage: 0.4,
            gridLines: {
              display: false,
              color: chartColors.muted,
            },
            ticks: {
            fontColor: chartColors.font,
            },
          }],
          maxBarThickness: 5,
          yAxes: [{
            gridLines: {
              display: true,
              borderDash: [8, 4],
              color: chartColors.muted,
            },
            ticks: {
              beginAtZero: true,
              fontColor: chartColors.font,
            }
          }]
        }
      },
    });
  });

  // fmpi-key-enablers
  $(document).ready(function() {
    var ctx = document.getElementById("fmpi-key-enablers").getContext('2d');
    var chartColors = {
      primary:           'rgba(22, 123, 195, 1)',
      primaryLighten1:   'rgba(22, 123, 195, 0.8)',
      primaryLighten2:   'rgba(22, 123, 195, 0.5)',
      primaryLighten3:   'rgba(22, 123, 195, 0.3)',
    };
    var barChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [
          "Documentation",
          "Talent",
          "Workflow Process",
          "Technoloy",
        ],
        datasets: [
          {
            data: [60, 25, 15, 22],
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
          fullWidth: false,
          display: true,
          position: 'bottom',
          labels: {
            fontColor: '#95aac9',
            fontFamily: 'Rubik, sans-serif',
            usePointStyle: true,
            pointRadius: 1,
          }
        },
      },
    });
  });
</script>
