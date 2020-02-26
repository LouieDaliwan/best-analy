<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

  {{-- Theme CSS --}}
  <style>{{ theme()->inlined(public_path('reports/css/ratios.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/indicators.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/custom.css')) }}</style>

  <style>
    html, body, * {
      font-family: 'Rubik', sans-serif;
      font-size: 7px;
    }
    h1, h2, h3, h4, h5, h6 {
      font-weight: 500 !important;
    }
    th {
      padding-right: 30px;
      font-weight: 500 !important;
    }
    th, td {
      padding: 6px;
      font-size: 7px;
    }
    table {
      width: 100%;
    }
    .half-width-table {
      width: 50%;
    }
  </style>
</head>

<body>
  <main>
    @include('best::reports.overall-cover')
    @include('best::reports.overall.score')
    @include('best::reports.overall.pindex')
    <div class="page-break"></div>

    <div class="page-break"></div>
    @include('best::reports.header')
    @include('best::reports.summary.about')
    @include('best::reports.summary.report-objectives')
    @include('best::reports.summary.key-benefits')
    @include('best::reports.summary.what-is-in-report')
    @include('best::reports.summary.data-reliability-validity')
    @include('best::reports.summary.data-privacy')
    @include('best::reports.footer')
    <div class="page-break"></div>

    @include('best::reports.header')
    @include('best::reports.organisation-profile')
    @include('best::reports.pindex.performance-index')
    @include('best::reports.disclaimer')
    @include('best::reports.footer')
    <div class="page-break"></div>

    @include('best::reports.analysis.profitability')
    @include('best::reports.analysis.liquidity')
    @include('best::reports.analysis.eficiency')
    @include('best::reports.analysis.solvency')
    @include('best::reports.analysis.productivity')
    @include('best::reports.disclaimer')
    @include('best::reports.footer')
    <div class="page-break"></div>

    @include('best::reports.header')
    @include('best::reports.organisation-profile')
    @include('best::reports.table.index')
    @include('best::reports.disclaimer')
    @include('best::reports.footer')
  </main>
</body>
</html>
