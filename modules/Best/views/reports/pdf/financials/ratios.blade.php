<?php
  $cols = [];
  
  array_push($cols, array_merge(array_slice($data, 0, 2), array_slice($data, 4,1), array_slice($data, 3, 1)));
  
  array_push($cols, array_merge(array_slice($data, 2, 1),array_slice($data, 5, 1)));  
?>

<h1 class="dt-primary">@lang('Financial Analysis')</h1>

<div id="resp-table">
  <div id="resp-table-row">
    @foreach ($cols as $col)
      <div class="resp-table-cell">
          <div class="child-table">
            @foreach($col as $key => $d)
              <div class="child-resp-table-row title title1{{ $key }}">
                <span class="child-table-cell">
                    <h6> {{ __($key) }}</h6>
                </span>
              </div>
              @foreach($d as $i => $vs)
              <div class="child-resp-table-row ratio{{ $key }}-{{ $i }}">
                @foreach ($vs as $v)
                  <span  class="child-table-cell {{ $key }}-{{ $i }}">{{ __($v) }}</span>
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
  #resp-table {
    width: 100%;
    display: table;
  }

  #resp-table-row {
    display: table-row-group;
  }

  .resp-table-cell {
    valign: top;
    width: 50%;
    display: table-cell;
  }

  .child-table {
    display:table;
    margin-bttom: 20px;
  }

  .child-resp-table-row{
    display: table-row-group;
  }

  .child-table-cell{
    display: table-cell;
  }
</style>


<?php dd('test'); ?>

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
