<table>
  {{-- <thead>
    <tr>
      <td>{{ __('Member') }}</td>
      <td>{{ __('Customers') }}</td>
      <td>{{ __('Reports') }}</td>
    </tr>
  </thead> --}}
  <tbody>
    @foreach ($data as $team)
      <tr>
        <td colspan="3">{{ $team->name }}</td>
      </tr>
      @foreach ($team->members as $member)
        <tr>
          <td colspan="3">{{ $member->displayname }}</td>
        </tr>
        @if ($member->reports->isEmpty())
          <tr>
            <td></td>
            <td colspan="2"><em>{{ __('No reports generated') }}</em></td>
          </tr>
        @else
          <tr>
            <td></td>
            <td><strong>{{ __('Report Type') }}</strong></td>
            <td><strong>{{ __('Company') }}</strong></td>
            <td><strong>{{ __('Score') }}</strong></td>
          </tr>
        @endif

        @foreach ($member->reports as $report)
          <tr>
            <td></td>
            <td>{{ $report->key }}</td>
            <td>{{ $report->customer->name }}</td>
            <td>{{ $report->value['current:index']['overall:total'] ?? '' }}</td>
          </tr>
        @endforeach
      @endforeach
    @endforeach
  </tbody>
</table>
