<section class="section">
  <h1 class="section__title section__title--lead">@lang('Organisation Profile')</h1>
  <div class="section__body font-weight-bold">
    <table class="table table-sm table-borderless table-vcenter mb-3">
      <tr>
        <td>
          <table>
            <tr>
              <td>
                @lang('Organisation Name')
              </td>
              <td style="padding-left: 10px; padding-right: 10px;">:</td>
              <td>{{ __($data['customer:name']) }}</td>
            </tr>
            <tr>
              <td>
                @lang('Organisation No.')
              </td>
              <td style="padding-left: 10px; padding-right: 10px;">:</td>
              <td>{{ __($data['customer:refnum']) }}</td>
            </tr>
          </table>
        </td>

        <td>
          <table>
            <tr>
              <td>
                @lang('Industry')
              </td>
              <td style="padding-left: 10px; padding-right: 10px;">:</td>
              <td>{{ __($data['customer:industry']) }}</td>
            </tr>
            <tr>
              <td>
                @lang('Staff Strength')
              </td>
              <td style="padding-left: 10px; padding-right: 10px;">:</td>
              <td>{{ __($data['customer:staffstrength']) }}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</section>
