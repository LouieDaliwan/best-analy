<table width="100%">
  <tr>
    <td>
      <table width="100%">
        <tr>
          <td width="25%"><h4 class="mb-1">@lang('Organisation Name'):</h4></td>
          <td><p class="mb-1 mx-3">{{ __($data['organisation:profile']['name']) }}</p></td>
        </tr>
      </table>
    </td>
    <td>
      <table width="100%">
        <tr>
          <td width="30%"><h4 class="mb-1">@lang('File Number') :</h4></td>
          <td><p class="mb-1 mx-3">{{ __($data['organisation:profile']['refnum']) }}</p></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%">
        <tr>
          <td width="25%"><h4>@lang('Site Visit Date') :</h4></td>
          <td><p class="mb-1 mx-3">{{ $data['month:formatted'] }}</p></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
