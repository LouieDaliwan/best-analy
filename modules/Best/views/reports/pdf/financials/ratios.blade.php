<?php
  $cols = [];

  $statements_count = $data['financialStatementCount'];
  $data = $data['ratios:financial'];


  array_push($cols, array_merge(array_slice($data, 0, 2), array_slice($data, 4,1), array_slice($data, 3, 1)));
  
  array_push($cols, array_merge(array_slice($data, 0,1), array_slice($data, 2, 1),array_slice($data, 5, 1)));  
?>

<h1 class="dt-primary">@lang('Financial Analysis')</h1>

<div id="resp-table">
  <div id="resp-table-row">
    @foreach ($cols as $col)
      <div class="resp-table-cell">
          <div class="child-table">
            @foreach($col as $key => $d)
              @if($key != '')
              <div class="child-resp-table-row title title1{{ $key }}">
                <span class="child-table-cell">
                  <h3 class="mb-0" style="padding: 5px; font-weight: regular;">{{ __($key) }}</h3>
                </span>
                <span style="padding: 5px;" class="child-table-cell"></span>
                <span style="padding: 5px;" class="child-table-cell"></span>
                
                @if($statements_count == 3)
                <span style="padding: 5px;" class="child-table-cell"></span>
                @endif

              </div>
              @endif
              @foreach($d as $i => $vs)
              {{-- ratio{{ $key }}-{{ $i }} --}}
              <div class="child-resp-table-row2">
                @foreach ($vs as $v)
                  <span style="padding: 5px;" class="child-table-cell {{ $key }}-{{ $i }}">{{ __($v) }}</span>
                @endforeach
              </div>
              @endforeach
            @endforeach
          </div>
      </div>
    @endforeach
  </div>
</div>

<style>
  .EFFICIENCY-4,
  .EFFICIENCY-11,
  .LIQUIDITY-20 {
    padding: 0 !important;
  }

  .child-table-cell -0 {
    font-weight: bold;
  }

/*  .EFFICIENCY-5,
  .EFFICIENCY-12,
  .LIQUIDITY-21 {
    border-top: 1px solid #edf2f9 !important;
  }*/

  #resp-table {
    width: 100%;
    display: table;
    /*padding: 1em;*/
  }

  #resp-table-row {
    display: table-row-group;
  }

  .resp-table-cell {
    /* valign: top; */
    /* width: 50%; */
    display: table-cell;
  }

  .child-table {
    display:table;
    /*margin-bttom: 20px;*/
    display: table;
    width: -webkit-fill-available;
    width: 97%;
    margin: 0 20px 0 0;
  }

  .child-resp-table-row{
    display: table-row-group;
    background-color: #95aac9 !important;
  }

  .child-resp-table-row2{
    display: table-row-group;
  }

  .child-table-cell{
    display: table-cell;
  }

  .bottom-right {
    border-right: 1px solid #868e96;
  }
</style>

{{-- <table>
  <tr>
    @foreach ($cols as $col)
      <td valign="top" width="50%"> 
        <table class="table">
          <tbody>
            @foreach ($col as $key => $d)
              <tr class="title title1{{ $key }}">
                <td colspan="5">{{ __($key) }}</td>
              </tr>
              @foreach ($d as $i => $vs)
                <tr class="ratio{{ $key }}-{{ $i }}">
                  @foreach ($vs as $v)
                    <td  class="{{ $key }}-{{ $i }}">{{ __($v) }}</td>
                  @endforeach
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </td>
    @endforeach
  </tr>
</table> --}}


