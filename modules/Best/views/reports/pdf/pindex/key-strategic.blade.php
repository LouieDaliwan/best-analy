{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
@if ($data['pindex:code'] != 'SDMI')
<section class="strategic mt-2">
  <div class="row">
    <div class="col-md-12">
      <div class="mb-3">
        <h4 class="mb-0 dt-secondary">@lang('Key Strategic Recommendations')</h4>
        <p><span style="color:#F48B3C">*</span> Denotes immediate intervention</p>
      </div>
    </div>
  </div>

  <table width="100%">
    @foreach (collect($data['key:recommendations'])->chunk(2) as $chunk)
      <tr>
        @foreach ($chunk as $key => $recommendation)
          <td valign="top">
            <div class="img{{ $key }} circular mr-3 card">
              <div class="p-3">
                <img height="15" src="{{ $recommendation['icon:path'] ?? null }}">
              </div>
            </div>
          </td>
          <td valign="top">
            <div class="dt-recommendation-title mb-3">
              <h4 class="mb-0">@lang($key)</h4>
              @foreach ($recommendation['comments'] as $comment)
                <p class="mb-0">@lang($comment)</p>
              @endforeach
            </div>
          </td>
        @endforeach
      </tr>
    @endforeach
  </table>
</section>
@endif
