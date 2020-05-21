<table width="100%">
  @foreach ($data as $team)
    <tr>
      <td colspan="3">{{ $team->name }}</td>
    </tr>

    <tr></tr>

    <tr>
      <td><strong>{{ __('Peer BC') }}</strong></td>
      <td><strong>{{ __('Report Type') }}</strong></td>
      <td><strong>{{ __('Site Visit Date') }}</strong></td>
      <td><strong>{{ __('Report Date') }}</strong></td>
      <td><strong>{{ __('Company') }}</strong></td>
      <td><strong>{{ __('File No.') }}</strong></td>
      <td><strong>{{ __('Score') }}</strong></td>
      <td><strong>{{ __('BC') }}</strong></td>
    </tr>

    @foreach ($team->members as $member)
      <tr>
        <td>{{ $member->displayname }}</td>
      </tr>
      @if ($member->reports->where('month', date('m-Y'))->isEmpty())
        <tr colspan="6">
          <td></td>
          <td><em>{{ __('No reports generated') }}</em></td>
        </tr>
      @else
        @foreach ($member->reports as $report)
          <tr>
            <td></td>
            <td>{{ $report->key }}</td>
            <td>{{ $report->remarks->format('d-M Y') }}</td>
            <td>{{ $report->created_at->format('d-M Y') }}</td>
            <td>{{ $report->customer->name }}</td>
            <td>{{ $report->value['organisation:profile']['refnum'] ?? '' }}</td>
            <td>{{ $report->value['current:index']['overall:total'] ?? '' }}</td>
            <td>{{ $report->customer->metadata['BusinessCounselorName'] ?? '' }}</td>
          </tr>
        @endforeach
      @endif
    @endforeach

    <tr></tr>
  @endforeach
</table>
