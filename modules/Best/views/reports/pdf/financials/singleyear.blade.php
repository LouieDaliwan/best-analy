<table style="border-spacing: 15px;">
  <tbody>
      <tr>      
        <td colspan="50%" style="vertical-align: top;">
          @include('best::reports.pdf.analysis.singleperiod.gross')
        </td>
        <td colspan="50%" style="vertical-align: top;">
          @include('best::reports.pdf.analysis.singleperiod.netmargin')
        </td>       
      </tr>
      
      <tr>
        <td colspan="50%" style="vertical-align: top;">
          @include('best::reports.pdf.analysis.singleperiod.currentratio')
        </td>
        <td colspan="50%" style="vertical-align: top;">
          @include('best::reports.pdf.analysis.singleperiod.debtratio')
        </td>
      </tr>

      <tr>
        <td colspan="50%" style="vertical-align: top;">
          @include('best::reports.pdf.analysis.singleperiod.roi')
        </td>
        <td colspan="50%" style="vertical-align: top;">
          @include('best::reports.pdf.analysis.singleperiod.rawmaterials')
        </td>
      </tr>
  </tbody>
</table>
</div>