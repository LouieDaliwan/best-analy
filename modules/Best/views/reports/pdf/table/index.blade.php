<section class="table-ratio" style="zoom: 0.7; line-height: 1;">
  <table>
    <tr>
      <td valign="top" width="60%">
        <div>@include('best::reports.table.sheet.ratios', ['data' => $data['ratios:financial']])</div>
      </td>
      <td valign="top" width="40%">
        <div>@include('best::reports.table.sheet.indicators', ['data' => $data['indicators:productivity']])</div>
      </td>
    </tr>
  </table>
</section>


