<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

  {{-- Chart --}}
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>

  {{-- Theme CSS --}}
  {{-- <style>{{ theme()->inlined(public_path('reports/css/report.css')) }}</style> --}}
  <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/ratios.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/indicators.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/paper.css')) }}</style>
</head>

<body class="A4">
  <main>
    <div class="sheet container">
      <div class="main-body">
        <div class="main-content">
          @include('best::reports.partials.cover', ['data' => $data['current:pindex']])
        </div>
      </div>
    </div>

    <div class="sheet container">
      <div class="main-body">
        <div class="main-content">
          @include('best::reports.partials.header')
          @include('best::reports.summary.about')
          @include('best::reports.summary.report-objectives')
          @include('best::reports.summary.key-benefits')
          @include('best::reports.summary.what-is-in-report')
          @include('best::reports.summary.data-reliability-validity')
          @include('best::reports.summary.data-privacy')
          @include('best::reports.partials.footer')
          <div class="text-right">
            @if ($data['current:index']['pindex:code'] == 'FMPI')
              <div style="font-size: 12px;">{{ __('Page 1 of 4') }}</div>
            @else
              <div style="font-size: 12px;">{{ __('Page 1 of 2') }}</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="sheet container">
      <div class="main-body">
        <div class="main-content">
          @include('best::reports.partials.header')
          @include('best::reports.partials.organisation-profile')
          @include('best::reports.pindex.performance-index', ['data' => $data['current:pindex'], 'orig' => $data['overall:enablers:orig'] ?? null])
          @include('best::reports.partials.disclaimer')
          @include('best::reports.partials.footer')
          <div class="text-right">
            @if ($data['current:index']['pindex:code'] == 'FMPI')
              <div style="font-size: 12px;">{{ __('Page 2 of 4') }}</div>
            @else
              <div style="font-size: 12px;">{{ __('Page 2 of 2') }}</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    @if ($data['current:index']['pindex:code'] == 'FMPI')
      <div class="sheet container">
        <div class="main-body">
          <div class="main-content">
            @include('best::reports.partials.header')
            @include('best::reports.partials.organisation-profile')
            @include('best::reports.analysis.profitability')
            @include('best::reports.analysis.liquidity')
            @include('best::reports.analysis.efficiency')
            @include('best::reports.analysis.solvency')
            @include('best::reports.analysis.productivity')
            @include('best::reports.partials.disclaimer')
            @include('best::reports.partials.footer')
            <div class="text-right">
              <div style="font-size: 12px;">{{ __('Page 3 of 4') }}</div>
            </div>
          </div>
        </div>
      </div>

      <div class="sheet container">
        <div class="main-body">
          <div class="main-content">
            @include('best::reports.partials.header')
            @include('best::reports.partials.organisation-profile')
            @include('best::reports.table.index')
            @include('best::reports.partials.disclaimer')
            @include('best::reports.partials.footer')
            <div class="text-right">
              <div style="font-size: 12px;">{{ __('Page 4 of 4') }}</div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </main>
</body>
</html>
