<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f9fbfd;">
  <center style="width: 100%; background-color: #f9fbfd;">
    <!-- Visually Hidden Preheader Text : BEGIN -->
    <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: 'Rubik', sans-serif;">
        {{-- (Optional) This text will appear in the inbox preview, but not the email body. It can be used to supplement the email subject line or even summarize the email's contents. Extended text preheaders (~490 characters) seems like a better UX for anyone using a screenreader or voice-command apps like Siri to dictate the contents of an email. If this text is not included, email clients will automatically populate it using the text (including image alt text) at the start of the email's body. --}}
        <h3 style="margin: 0 0 10px; line-height: 30px; color: #333333; font-weight: 500;">{{ $data['pindex'] }} ({{ $data['pindex:code'] }})</h3>
        <h3 style="margin: 0 0 10px; line-height: 30px; color: #333333; font-weight: 500;">Diagnostic Report</h3>
        <p style="margin: 0 0 10px;">@lang('Lorem ipsum dolor sit amet, consectetur adipisicing.')</p>
    </div>
    <!-- Visually Hidden Preheader Text : END -->

    <!-- Preview Text Spacing Hack : BEGIN -->
    <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: 'Rubik', sans-serif;">
      &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <!-- Preview Text Spacing Hack : END -->

    <div style="max-width: 680px; margin: 0 auto; padding: 50px;" class="email-container">
      <!-- Email Body : BEGIN -->
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
        <!-- Email Header : BEGIN -->
        <tr>
          <td style="padding: 20px 0;">
            <table>
              <tbody>
                <tr>
                  <td v-align="center">
                    <table>
                      <tr>
                        <td>
                          <a style="margin-right: 1.5rem;"><img height="48" src="{{ asset('logo.png') }}"></a>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td v-align="center">
                    <table>
                      <tr>
                        <td>
                          <h4 style="font-weight: 500; color: #167bc3; margin: 0; margin-bottom: 4px;">{{ settings('app:fulltitle') }} (BEST) @lang('Report')</h4>
                          <small>@lang('Empowered by') {{ settings('app:author') }}</small>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Email Header : END -->

        <tr>
          <td>
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border: 1px solid rgba(0,0,0,.125);
    border-radius: 8px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); overflow: hidden;">
              <!-- Hero Image, Flush : BEGIN -->
              <tr>
                <td style="background-color: #ffffff; padding-bottom: 40px; padding-top: 40px;">
                  <img src="{{ asset('reports/assets/analysis_.svg') }}" width="220" height="" alt="alt_text" border="0" style="width: 100%; max-width: 220px; height: auto; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img">
                </td>
              </tr>
              <!-- Hero Image, Flush : END -->

              <!-- 1 Column Text : BEGIN -->
              <tr>
                <td style="background-color: #ffffff;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="padding: 20px; font-family: 'Rubik', sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <div style="text-align: center;">
                          <h3 style="margin: 0 0 10px; line-height: 30px; color: #333333; font-weight: 500;">{{ $data['pindex'] }} ({{ $data['pindex:code'] }})</h3>
                          <h3 style="margin: 0 0 10px; line-height: 30px; color: #333333; font-weight: 500;">Diagnostic Report</h3>
                          <p style="margin: 0 0 10px;">@lang('Lorem ipsum dolor sit amet, consectetur adipisicing.')</p>
                        </div>
                        <div style="margin-top: 40px;">
                          {{-- Details --}}
                          <table align="left" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                              <th align="right">@lang('Date Generated')</th>
                              <td>{{ __('February 03, 2020') }}</td>
                            </tr>
                            <tr>
                              <th align="right">@lang('Organisation Name')</th>
                              <td>{{ __($data['customer:name']) }}</td>
                            </tr>
                            <tr>
                              <th align="right">@lang('Organisation No.')</th>
                              <td>{{ __($data['customer:refnum']) }}</td>
                            </tr>
                            <tr>
                              <th align="right">@lang('Industry')</th>
                              <td>{{ __($data['customer:industry']) }}</td>
                            </tr>
                            <tr>
                              <th align="right">@lang('Staff Strength')</th>
                              <td>{{ __($data['customer:staffstrength']) }}</td>
                            </tr>
                          </table>
                          {{-- Details --}}
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <!-- 1 Column Text : END -->
            </table>
          </td>
        </tr>
      </table>
      <!-- Email Body : END -->

      <!-- Email Footer : BEGIN -->
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 680px;">
        <tr>
          <td style="padding: 20px; font-family: 'Rubik', sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
            <div>{{ __('Copyright') }} &copy; {{ settings('app:year') }} <cite>{{ settings('app:author') }}</cite></small></div>
          </td>
        </tr>
      </table>
      <!-- Email Footer : END -->
    </div>
  </center>
</body>
