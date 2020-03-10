<div class="dt-divider" style="height: 50px;"></div>
<h1 class="dt-primary">@lang('Productivity Indicators')</h1>
<table class="table table-indicator-main">
  <tbody>
    @foreach ($data as $key => $d)
      <tr class="title table-indicator">
        <td colspan="5">{{ $key }}</td>
      </tr>
      @foreach ($d as $i => $vs)
        <tr class="ratio{{ $key }}-{{ $i }}">
          @foreach ($vs as $v)
            <td class="{{ $key }}-{{ $i }}">{{ $v }}</td>
          @endforeach
        </tr>
      @endforeach
    @endforeach
  </tbody>
</table>
