<section>
  <table align="center" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td>
        <table align="center" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center">
              <table>
                <tbody>
                  <tr>
                    <td v-align="center">
                      <table>
                        <tr>
                          <td>
                            <a class="navbar-brand" href="" class="mr-4"><img height="32" src="{{ asset('logo.png') }}"></a>
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td v-align="center">
                      <table>
                        <tr>
                          <td>
                            <h1 class="my-0 mb-1 font-weight-bold text-uppercase" style="color: #167bc3;">{{ __('Organisational Health') }}</h1>
                            @lang('Empowered by') {{ settings('app:author') }}
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td align="center" width="100%" style="padding: 40px 0;">
        <img width="150" src="{{ asset('gradient/1.png') }}">
      </td>
    </tr>
    <tr>
      <td align="center" width="100%">
        <h1 style="font-size: 19px; margin-bottom: 7px;" class="my-0">{{ $data['pindex'] }}</h1>
        <h1 style="font-size: 19px; margin-bottom: 7px; font-weight: 400;" class="my-0">({{ $data['pindex:code'] }})</h1>
        <h1 style="font-size: 19px;" class="font-weight-normal text-muted">Diagnostic Report</h1>
        {{-- <h1 style="font-size: 19px;" class="font-weight-normal text-muted">{{ $data['pindex:report'] }}</h1> --}}
      </td>
    </tr>

    <tr>
      <td width="100%">
        <table cellpadding="0" cellspacing="0" width="100%" style="margin-top: 40px;">
          <tr>
            <td width="45%" valign="top">
              <table width="100%">
                <tr>
                  <td>
                    <p>@lang($data['cover:description'])</p>
                  </td>
                </tr>
              </table>
            </td>
            <td width="10%"></td>
            <td width="45%" valign="top">
              <ul>
                @foreach ($data['elements:charts']['labels'] as $label)
                  <li>@lang($label)</li>
                @endforeach
              </ul>
              {{-- <table align="center" cellpadding="0" cellspacing="0" width="100%">
                <tr align="center">
                  <td><p>Cost Management</p></td>
                  <td><p>Cost Management</p></td>
                  <td><p>Cost Management</p></td>
                </tr>
                <tr align="center">
                  <td><p>Cost Management</p></td>
                  <td><p>Cost Management</p></td>
                </tr>
              </table> --}}
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td width="100%">
        <table cellpadding="0" cellspacing="0" width="100%" style="margin-top: 40px;">
          <tr>
            <td>
              <p>{{ __('Prepared for:') }}</p>
            </td>
          </tr>
          <tr>
            <td>
              <h1>{{ $data['customer:name'] }}</h1>
              <p>{{ $data['cover:date'] }}</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</section>
