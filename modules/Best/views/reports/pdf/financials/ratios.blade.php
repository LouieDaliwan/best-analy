<?php
  $cols = [];
  
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
            {{-- title title1{{ $key }}" --}}
              @if($key != '')
              <div class="child-resp-table-row">
                <span class="child-table-cell" style="padding-top: 10px; padding-left: 5px;">
                    <h3> {{ __($key) }}</h6>
                </span>
                <span class="child-table-cell" style="border: solid 1px;"></span>
                <span class="child-table-cell" style="border: solid 1px;"></span>
                <span class="child-table-cell" style="border: solid 1px;"></span>
              </div>
              @endif
              @foreach($d as $i => $vs)
              {{-- ratio{{ $key }}-{{ $i }} --}}
              <div class="child-resp-table-row2 ">
                @foreach ($vs as $v)
                {{-- {{ $key }}-{{ $i }} --}}
                  <span  class="child-table-cell">{{ __($v) }}</span>
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
    background-color: #95aac9 !important;
  }

  .child-resp-table-row2{
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
