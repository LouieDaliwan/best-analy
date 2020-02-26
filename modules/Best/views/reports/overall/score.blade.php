<section class="section">
  <h1 class="section__title section__title--lead">
    @lang('Best Score')
  </h1>

  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="50" valign="center">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <span class="badge badge-soft-{{ $data['overall:result'] }} mx-2 font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 20px;">
                {{ $data['overall:score'] }}
              </span>
            </td>
          </tr>
        </table>
      </td>
      <td width="50">
        <div class="traffic-light__light traffic-light__light--{{ $data['overall:result'] }} mx-4"></div>
      </td>
      <td valign="center">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <p>@lang($data['overall:comment'])</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</section>
