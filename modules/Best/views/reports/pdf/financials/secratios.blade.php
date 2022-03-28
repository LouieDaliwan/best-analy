<?php

  $cols = [];

  $maxItem = round((count($data) + 1) / 2);

  array_push($cols, array_merge(array_slice($data, 0, 1), array_slice($data, 2, 1)));
  array_push($cols, array_merge(array_slice($data, 0, 1), array_slice($data, 3, 1)));
?>


<h1 class="dt-primary">@lang('Financial Analysis')</h1>
<table>
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
</table>
