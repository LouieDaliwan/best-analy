<div class="dt-divider" style="height: 50px;"></div>
<h1 class="dt-primary">@lang('Productivity Indicators')</h1>

<h3>@lang('PRODUCTIVITY ANALYSIS - LABOUR COST COMPETITIVENESS')</h3>
<canvas height="100" id="productivity-analysis"></canvas>
<ul>
  <li>Overall labour cost competitiveness has seen a significant downward trend over the years.</li>
  <li>Experienced a year on year decrease by -5.54% from the recent year to the previous year.</li>
  <li>Records have also indicated that from Year 1 to Year 2, the per unit labour cost saw a significant year on year increase by -12.21%.</li>
</ul>
<style>
  td[colspan=3], td.colspan-text, .colspan-text {
    border-right: 1px solid #868e96 !important;
  }
  .empty-1:empty {
    display: none;
  }
</style>
<table class="table table-indicator-main">
  <tbody>
    @foreach ($data as $key => $d)
      <tr class="title table-indicator">
        <td colspan="5">{{ __($key) }}</td>
      </tr>
      @foreach ($d as $i => $vs)
        <tr class="ratio{{ $key }}-{{ $i }}">
          @php
          $l = 0;
          @endphp
          @foreach ($vs as $j => $v)
            @if (strpos($v, 'This measures') !== false || strpos($v, 'This indicates') !== false)
              @php
              $l = 1;
              @endphp
              <td style="border-right: 1px solid #868e96 !important;" colspan="3" class="colspan-text {{ empty($v) ? 'empty' : null }} {{ $key }}-{{ $i }}">{{ __($v) }}</td>
            @else
              <td class="{{ empty($v) ? "empty-$l" : null }} {{ $key }}-{{ $i }}">{{ __($v) }}</td>
            @endif
          @endforeach
        </tr>
      @endforeach
    @endforeach
  </tbody>
</table>

<script>
$(document).ready(function() {
  var ctx = document.getElementById("productivity-analysis");
  var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Label 1'],
      datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        backgroundColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    },
    options: {
      tooltips: {
        enabled: true,
        mode: 'single',
        callbacks: {
          label: function(tooltipItems, data) {
            return tooltipItems.yLabel+'%';
          }
        }
      },
      legend: {
        display: false,
      },
      scales: {
        maxBarThickness: 3,
        yAxes: [{
          ticks: {
            // beginAtZero: true,
            padding: 20,
            maxTicksLimit: 5,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 12,
            // min: -100,
            // max: 100,
            callback: function(value){return value+ "%"}
          }
        }]
      }
    },
  });
});
</script>
