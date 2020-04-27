<section class="table-ratio">
  <table>
    <tr>
      <td valign="top" width="60%">
        <div>@include('best::reports.pdf.table.sheet.ratios', ['data' => $data['ratios:financial']])</div>
      </td>
      <td valign="top" width="40%">
        <div>@include('best::reports.pdf.table.sheet.indicators', ['data' => $data['indicators:productivity']])</div>
      </td>
    </tr>
  </table>
</section>


