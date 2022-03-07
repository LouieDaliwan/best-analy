<div class="dt-divider" style="height: 50px;"></div>
<h1 class="dt-primary">@lang('Financial Ratios')</h1>
<table class="table">
  <tbody>
    @foreach ($data as $key => $d)
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
