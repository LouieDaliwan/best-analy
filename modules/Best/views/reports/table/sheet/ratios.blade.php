<table class="table">
  <tbody>
    <tr>
      <td valign="top">
        <h1 class="section__title text-center section__subtitle--lead">
          @lang('Financial Ratios')
        </h1>
        <table class="table" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            @foreach ($data as $key => $d)
              <tr class="title title1{{ $key }}">
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
      </td>
    </tr>
  </tbody>
</table>
