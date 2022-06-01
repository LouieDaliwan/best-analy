      <td colspan="50%">
        {{-- @include('best::reports.pdf.overall.charts.fmpi') --}}
      </td>
    </tr>
    <tr>
      <td colspan="50%">
        @include('best::reports.pdf.overall.charts.bspi')
      </td>
      <td colspan="50%">
        @include('best::reports.pdf.overall.charts.pmpi')
      </td>
    </tr>
    <tr>
      <td colspan="50%">
        {{-- @include('best::reports.pdf.overall.charts.hrpi') --}}
      </td>
      <td colspan="50%">
        {{-- @include('best::reports.pdf.overall.charts.fifth') --}}
      </td>
    </tr>
  </table>

  @include('best::reports.pdf.overall.charts.enablers')
</section>
