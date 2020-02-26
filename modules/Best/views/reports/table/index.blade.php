<table class="table" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td valign="top" class="half-width-table">
      @include('best::reports.table.sheet.ratios', ['data' => $data['ratios:financial']])
    </td>
    <td valign="top" class="half-width-table">
      @include('best::reports.table.sheet.indicators', ['data' => $data['indicators:productivity']])
    </td>
  </tr>
</table>
