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
  <h1 class="section__title section__title--lead best-primary text-uppercase mb-3">@lang('PROFITABILITY ANALYSIS')</h1>
  <div class="section__body mx-4">
    <table>
      <tbody>
        <tr>
          <td width="50%">
            <p>@lang('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis distinctio eius voluptate dolore quae placeat nulla voluptatibus hic modi. Illo sed, at. Mollitia a, animi minus! Magni, quaerat odio error!')</p>
            <p>@lang('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis distinctio eius voluptate dolore quae placeat nulla voluptatibus hic modi. Illo sed, at. Mollitia a, animi minus! Magni, quaerat odio error!')</p>
          </td>
          <td>
            <canvas id="fmpi-profitability-analysis"></canvas>

            <div class="border-top">
              <table class="table-striped-even table table-borderless table-sm table-vcenter mb-0">
                <thead class="border-bottom">
                  <tr>
                    <th>Year</th>
                    <th>Current Ratio</th>
                    <th>Cash Ratio</th>
                    <th>Working K to <br>Total Assets</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>Year 1</th>
                    <td id="cell1">0.00</td>
                    <td id="cell2">0.00</td>
                    <td id="cell3">0.00</td>
                  </tr>
                  <tr>
                    <th>Year 2</th>
                    <td id="cell4">0.00</td>
                    <td id="cell5">0.00</td>
                    <td id="cell6">0.00</td>
                  </tr>
                  <tr>
                    <th>Year 3</th>
                    <td id="cell7">0.00</td>
                    <td id="cell8">0.00</td>
                    <td id="cell9">0.00</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
  $(document).ready(function() {
    var ctx = document.getElementById("fmpi-profitability-analysis").getContext('2d');
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
</script>
