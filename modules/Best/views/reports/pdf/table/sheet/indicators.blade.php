<div class="dt-divider" style="height: 50px;"></div>
<h1 class="dt-primary">@lang('Productivity Indicators')</h1>
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
