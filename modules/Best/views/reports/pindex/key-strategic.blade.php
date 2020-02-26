<section class="section">
  <h1 class="section__title text-center section__subtitle--lead">
    @lang('KEY STRATEGIC RECOMMENDATIONS')
  </h1>
  <div class="card">
    <table cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td>
          <table class="border-bottom border-right" cellpadding="0" cellspacing="0" width="100%">
            @foreach (collect($data['key:recommendations'])->chunk(2) as $chunk)
              <tr class="fe">
                @foreach ($chunk as $key => $recommendation)
                  <th class="pa-2">
                    <p>@lang($key)</p>
                    <div><img height="32" src="{{ $recommendation['icon'] }}" alt="Note"></div>
                  </th>
                  <td class="pa-2">@lang($recommendation['comment'])</td>
                @endforeach
              </tr>
            @endforeach
          </table>
        </td>
      </tr>
    </table>
  </div>
</section>
