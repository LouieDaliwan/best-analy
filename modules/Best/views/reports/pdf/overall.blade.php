<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ app()->getLocale() }}">
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  {{-- Chart --}}
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>

  {{-- Theme CSS --}}
  <style>{{ theme()->inlined(public_path('reports/css/basic.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style>

  {{-- RTL --}}
  @if (app()->getLocale() == 'ar')
    <style>{{ theme()->inlined(public_path('reports/css/rtlpdf.css')) }}</style>
  @endif

  <style>
    html { background: #ffffff !important; }
    @page { size: legal; margin: 0; }
    body { margin: 0; overflow: visible; float: none; background: #ffffff !important; }
    /*body.A4 { width: 210mm }*/
    div.sheet {
      margin: 0;
      display: block;
      overflow: hidden;
      position: relative;
      box-sizing: border-box;
      page-break-after: always;
    }
    h1, h2, h3, h4, h5, h6 {
      font-weight: 700;
    }
  </style>
</head>

<body class="A4 lang-{{ app()->getLocale() ?: 'en' }}">
  <div class="sheet">
    @include('best::reports.pdf.overall.cover')
  </div>

  <div class="sheet">
    @include('best::reports.pdf.partials.header')
    <div class="my-2 border-bottom"></div>
    @include('best::reports.pdf.summary.about')
    @include('best::reports.pdf.summary.report-objectives')
    @include('best::reports.pdf.summary.key-benefits')
    @include('best::reports.pdf.summary.what-is-in-report')
    @include('best::reports.pdf.summary.data-reliability-validity')
    @include('best::reports.pdf.summary.data-privacy')
    @include('best::reports.pdf.partials.footer')
    <div class="text-right">
      <div style="font-size: 12px;">{{ __('Page 1 of 7') }}</div>
    </div>
  </div>

  {{-- overall --}}
  <div class="sheet" style="line-height: 1.3;">
    @include('best::reports.pdf.partials.header')
    <div class="my-2 border-bottom"></div>
    @include('best::reports.pdf.partials.organisation-profile')
    @include('best::reports.pdf.overall.score')
    @include('best::reports.pdf.overall.pindex')
    @include('best::reports.pdf.partials.disclaimer')
    @include('best::reports.pdf.partials.footer')
    <div class="text-right">
      <div style="font-size: 12px;">{{ __('Page 2 of 7') }}</div>
    </div>
  </div>
  {{-- overall --}}

  @foreach ($data['indices'] as $index)
    <div class="sheet" style="line-height: 1.3;">
      @include('best::reports.pdf.partials.header')
      <div class="my-2 border-bottom"></div>
      @include('best::reports.pdf.partials.organisation-profile')
      @include('best::reports.pdf.pindex.performance-index', ['data' => $index, 'orig' => $data['overall:enablers:orig']])
      @include('best::reports.pdf.partials.disclaimer')
      @include('best::reports.pdf.partials.footer')
      <div class="text-right">
        <div style="font-size: 12px;">Page <span style="display: none;" class="text-white">-</span>{{ $index['page'] }}<span style="display: none;" class="text-white">-</span> of 7</div>
      </div>
    </div>
  @endforeach

  {{-- comments --}}
  <div class="sheet" style="line-height: 1.3;">
    @include('best::reports.pdf.partials.header')
    <div class="my-2 border-bottom"></div>
    @include('best::reports.pdf.partials.organisation-profile')
    <div style="height: 1300px;">
      @include('best::reports.pdf.overall.comments')
    </div>
    @include('best::reports.pdf.partials.disclaimer')
    @include('best::reports.pdf.partials.footer')
    <div class="text-right">
      <div style="font-size: 12px;">{{ __('Page 7 of 7') }}</div>
    </div>
  </div>
  {{-- comments --}}
</body>
</html>
