<table width="100%">
  <tr>
    <td valign="top" width="50%">
      @include('best::reports.pdf.analysis.singleperiod.gross')
    </td>
    <td valign="top" width="50%">
      @include('best::reports.pdf.analysis.singleperiod.netmargin')
    </td>
  </tr>
  <tr>
    <td valign="top" width="50%">
      @include('best::reports.pdf.analysis.singleperiod.currentratio')
    </td>
    <td valign="top" width="50%"  >
      @include('best::reports.pdf.analysis.singleperiod.debtratio')
    </td>
  </tr>
  <tr>
    <td valign="top" width="50%">
      @include('best::reports.pdf.analysis.singleperiod.roi')
    </td>
    <td valign="top" width="50%">
      @include('best::reports.pdf.analysis.singleperiod.rawmaterials')
    </td>
  </tr>
</table>
