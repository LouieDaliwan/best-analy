{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section class="mt-2">
  <div class="row">
    <div class="col-md-12">
      <div>
        <h4 class="mb-3 dt-primary text-uppercase">
          @lang('best::reports.:appcode Score', ['appcode' => __(settings('app:code'))])
        </h4>
      </div>
    </div>
  </div>

  <table>
    <tr>
      <td>
        <div>
          <span class="badge badge-soft-{{ $data['overall:result'] }} font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 20px;">
            {{ $data['overall:percentage'] }}
          </span>
        </div>
      </td>
      <td>
        <div class="overall-label ml-md-4 ml-0 m-3">
          <span class="badge-bg-{{ $data['overall:result'] }}" style="width: 32px; height: 32px; display: inline-block; border-radius: 100%;">
          </span>
        </div>
      </td>
      <td>
        <p class="mb-0">@lang($data['overall:comment'])</p>
      </td>
    </tr>
  </table>
</section>
