{{-- <div class="dt-divider" style="height: 50px;"></div> --}}

<?php

  $cols = array();

  $maxItem = round((count($data) + 1) / 2);

  array_push($cols, array_slice($data, 0, $maxItem));
  array_push($cols, array_merge(
      array(
        '' => array(array('', 'Year 1', 'Year 2', 'Year 3'))
      ),
      array_slice($data, $maxItem)
    ));
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
                      <td class="{{ $key }}-{{ $i }}">{{ __($v) }}</td>
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
</div>
