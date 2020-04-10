<table width="100%">
  <tr>
    <td>
      <table>
        <tr>
          <td><h4 class="mb-1">@lang('Organisation Name'):</h4></td>
          <td><p class="mb-1 mx-3">{{ __($data['organisation:profile']['name']) }}</p></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td><h4 class="mb-1">@lang('File Number') :</h4></td>
          <td><p class="mb-1 mx-3">{{ __($data['organisation:profile']['refnum']) }}</p></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
