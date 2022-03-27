<div class="py-1 px-2 mb-2" style="background-color: rgba(0,0,0,0.3); font-weight: bold">@lang('ROI Score')</div>

<div class="mb-3 w-100" style="height: 450px;">
  <div style="width: 500px; height: 450px;">
    <canvas id="roi" style="width: 500px; height: 450px;"></canvas>
  </div>
</div>

<p class="mb-1" style="text-indent: 40px; font-size: 20px; line-height: 1.5;">
  @if (app()->getLocale() == 'ar')
        <span style="font-size: 17px;">
          <svg width="17px" height="17px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
              <g>
                <path fill="#107E7D" d="M501.333,234.667H68.417l109.792-109.792c2-2,3.125-4.708,3.125-7.542V96c0-4.313-2.594-8.208-6.583-9.854
                  c-1.323-0.552-2.708-0.813-4.083-0.813c-2.771,0-5.5,1.083-7.542,3.125l-160,160c-4.167,4.167-4.167,10.917,0,15.083l160,160
                  c3.063,3.042,7.615,3.969,11.625,2.313c3.99-1.646,6.583-5.542,6.583-9.854v-21.333c0-2.833-1.125-5.542-3.125-7.542
                  L68.417,277.333h432.917c5.896,0,10.667-4.771,10.667-10.667v-21.333C512,239.438,507.229,234.667,501.333,234.667z"/>
              </g>
            </g>
          </svg>
        </span>
    @endif
    @if (app()->getLocale() == 'en')
      <span style="font-size: 17px;">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-bottom: 6px;" xml:space="preserve" width="17px" height="17px"><g><g>
          <g>
            <path d="M508.875,248.458l-160-160c-3.063-3.042-7.615-3.969-11.625-2.313c-3.99,1.646-6.583,5.542-6.583,9.854v21.333    c0,2.833,1.125,5.542,3.125,7.542l109.792,109.792H10.667C4.771,234.667,0,239.437,0,245.333v21.333    c0,5.896,4.771,10.667,10.667,10.667h432.917L333.792,387.125c-2,2-3.125,4.708-3.125,7.542V416c0,4.313,2.594,8.208,6.583,9.854    c1.323,0.552,2.708,0.813,4.083,0.813c2.771,0,5.5-1.083,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#107E7D"/>
          </g>
        </g></g> </svg>
      </span>
    @endif

  {{ $data['analysis:financial']['roi']['comment'][0] }}
</p>
  
  <script>
  $(document).ready(function() {
    var ctx = document.getElementById("roi").getContext('2d');
    var dataset = {!! json_encode($data['analysis:financial']['roi']['chart']['dataset']) !!}
    console.log(dataset)
  
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          ['{{ __("ROI") }}', ],
        ],
        datasets: [
          {
            data: dataset[0]['data'],
            backgroundColor: '#a2d5ac',
          },
        ],
      },
      options: {
        animation: false,
        legend: false,
        scales: {
          xAxes: [{
            barPercentage: 0.3,
            gridLines: {
              display: false,
            },
            ticks: {
              beginAtZero: true,
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
            },
          }],
          maxBarThickness: 5,
          yAxes: [{
            barPercentage: 0.1,
            gridLines: {
              display: false,
            },
            ticks: {
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
              callback: function(value){return value}
            }
          }]
        }
      },
    });
  });
  </script>
  