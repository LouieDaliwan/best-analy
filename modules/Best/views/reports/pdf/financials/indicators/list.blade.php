<?php
    $details = $data['indicators:productivity']['detail'];
    $cols = [];
    
    array_push($cols, [
        [
            $details[0], 
            $details[1]
        ],
        [
            $details[15], 
            $details[16]
        ]
    ]);

    array_push($cols, [
        [
            $details[3], 
            $details[4]
        ],
        [
            $details[18], 
            $details[19]
        ]
    ]);
    
    array_push($cols, [
        [
            $details[6], 
            $details[7]
        ],
        [
            $details[21], 
            $details[22]
        ]
    ]);

    array_push($cols, [
        [
            $details[9], 
            $details[10]
        ],
        [
            $details[24], 
            $details[25]
        ]
    ]);

    array_push($cols, [
        [
            $details[12], 
            $details[13]
        ],
        [
            $details[27], 
            $details[28]
        ]
    ]);
?>

<style>
    table .row1 {
        vertical-align: inherit !important;
        align-self: auto;
        width: 25% !important;
    }

    .eachIndicators {
        /*background-color: #e5e3e3 !important;*/
    }

    #listTable td {
        border-top: 0 !important; 
    }

    .row1 .otherRows{
        /*background-color:  #dbd9d9; */
    }

    
    .otherRows {        
        /*padding: 0 !important;
        padding-top: 20px !important;
        text-align: center;
        vertical-align: top;
        margin-top: 10px;*/
    }
</style>


<table class="table" id="listTable">
  <tbody>
    <tr>
      <td>
        <h2 class="dt-secondary mb-0">@lang('Productivity Indicators')</h2>
        <hr>
      </td>
    </tr>
    @foreach($cols as $col)
    <tr>
      @foreach($col as $items)
      <td>
        <table width="100%" class="eachIndicators">
          <tbody style="border: 1px solid #868e96;">
              <?php $countItems = 1; ?>
              @foreach($items as $item)
              <tr>
                <?php $count = 1; ?>
                @foreach($item as $data)
                @if($countItems == 1)
                  @if($data != null && $count == 1)
                    <td bgcolor="#edf2f9" class="row1" rowspan="2">{{ $data }}</td>
                  @else
                    <td class="otherRows">{{ $data }}</td>
                  @endif
                @endif
                @if($countItems == 2)
                  @if($data != null && $count == 3)
                    <td bgcolor="#edf2f9" colspan="4" class="description">{{$data}}</td>
                  @endif
                @endif
                <?php $count++; ?>
                @endforeach
              </tr>
              <?php $countItems++; ?>
              @endforeach
            </tbody>
          </table>
        </td>
      @endforeach
    </tr>
    @endforeach
  </tbody>
</table>

<style>
  .otherRows:nth-child(4) {
    border-right: 1px solid #868e96;
  }
</style>
