<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Test</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <link rel="stylesheet" href="//unpkg.com/gutenberg-css" media="print" charset="utf-8">
  <link rel="stylesheet" href="//unpkg.com/gutenberg-css/dist/themes/modern.min.css" media="print" charset="utf-8">
  <style>{{ theme()->inlined(public_path('reports/css/critical.css')) }}</style>
  {{-- Theme CSS --}}
  <style>{{ theme()->inlined(public_path('reports/css/pdf.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/report.css')) }}</style>
  {{-- <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style> --}}
  <style>{{ theme()->inlined(public_path('reports/css/ratios.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/indicators.css')) }}</style>
  <style>
    @page { size: A4; margin: 10mm; }
    html { font-family: 'Rubik', sans-serif; }
    body { font-family: 'Rubik', sans-serif; }
    h1 { font-family: 'Rubik', sans-serif; }
    h2 { font-family: 'Rubik', sans-serif; }
    body.A4 .sheet { page-break-after: always; }
    .sheet { zoom: 0.95; scale: 90%; }

    /* john's edits; to be discussed */
    body, p, td, td, th, li, strong { font-size: 9pt; }
    h1, h2, h3, h4 { font-size: 9pt; margin-bottom: 3pt; }
    .mb-3 { margin-bottom: 3pt !important; }
    td { font-size: 8pt !important; }
    p, .global p { line-height: 1.2; margin-bottom: 3pt; }
    .global .dt-divider { height: 8px !important; }
    .card-body { padding: 6pt; }
    .dt-primary { font-size: 8pt; text-transform: uppercase; background-color: rgba(0,0,0,0.10); padding: 3pt; }
    .data-block, .data-block p { font-size: 6pt; }
    .data-block, .data-block .dt-primary { font-size: 6pt; }
    .global .pindex h1 { margin-top: 3pt; margin-bottom: 2pt !important; }
    .key-enablers p { font-size: 7.5pt; }
    cite { font-size: 6pt; }
    .col { padding-left: 2pt; padding-right: 2pt; }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm cover">
    <article>
      @include('best::reports.partials.cover', ['data' => $data['current:pindex']])
    </article>
  </section>

  {{-- Page 1 --}}
  <section class="sheet padding-10mm page1 global">
    <article>
      @include('best::reports.partials.header')
      @include('best::reports.summary.about')
      @include('best::reports.summary.report-objectives')
      @include('best::reports.summary.key-benefits')
      @include('best::reports.summary.what-is-in-report')
      <div class="data-block">
        @include('best::reports.summary.data-reliability-validity')
        @include('best::reports.summary.data-privacy')
      </div>
      @include('best::reports.partials.footer')
      <div class="text-right">
        <div style="font-size: 12px;">{{ __('Page 1 of 4') }}</div>
      </div>
    </article>
  </section>

  {{-- Page 2 --}}
  <section class="sheet padding-10mm page2 global">
    <article>
      @include('best::reports.partials.header')
      @include('best::reports.partials.organisation-profile')
      @include('best::reports.pindex.performance-index', ['data' => $data['current:pindex']])
      @include('best::reports.partials.disclaimer')
      @include('best::reports.partials.footer')
      <div class="text-right">
        <div style="font-size: 12px;">{{ __('Page 2 of 4') }}</div>
      </div>
    </article>
  </section>

  {{-- Page 3 --}}
  <section class="sheet padding-10mm page3 global">
    <article>
      @include('best::reports.partials.header')
      @include('best::reports.partials.organisation-profile')
      @include('best::reports.analysis.pdf.profitability')
      @include('best::reports.analysis.pdf.liquidity')
      @include('best::reports.analysis.pdf.efficiency')
      @include('best::reports.analysis.pdf.solvency')
      @include('best::reports.analysis.pdf.productivity')
      @include('best::reports.partials.disclaimer')
      @include('best::reports.partials.footer')
      <div class="text-right">
        <div style="font-size: 12px;">{{ __('Page 3 of 4') }}</div>
      </div>
    </article>
  </section>

  {{-- Page 4 --}}
  <section class="sheet padding-10mm page4 global">
    <article>
      @include('best::reports.partials.header')
      @include('best::reports.partials.organisation-profile')
      @include('best::reports.table.index')
      @include('best::reports.partials.disclaimer')
      @include('best::reports.partials.footer')
      <div class="text-right">
        <div style="font-size: 12px;">{{ __('Page 4 of 4') }}</div>
      </div>
    </article>
  </section>
</body>
</html>
