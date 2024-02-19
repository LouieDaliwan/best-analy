<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ app()->getLocale() }}">
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  {{-- Chart --}}
  {{-- <!-- <script>{!! file_get_contents('http://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js') !!}</script> --}}
  {{-- <script>{!! file_get_contents('http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js') !!}</script> --> --}}
  <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
    Chart.register(chartjs-plugin-annotation);
  </script>

  {{-- Theme CSS --}}
  <style>{{ theme()->inlined(public_path('reports/css/basic.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style>

  <link rel="stylesheet" type="text/css" href="reports/css/paper.css">

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
    @include('best::reports.pdf.partials.cover', ['data' => $data['current:pindex']])
  </div>

  <div class="sheet" style="line-height: 1.3;">
    @include('best::reports.pdf.partials.header')
    @include('best::reports.pdf.partials.organisation-profile')
    @include('best::reports.pdf.pindex.performance-index', ['data' => $data['current:pindex'], 'orig' => $data['overall:enablers:orig'] ?? null])
    @include('best::reports.pdf.partials.disclaimer')
    @include('best::reports.pdf.partials.footer')
    <div class="text-right">
      <div style="font-size: 12px;">{{ __('Page 1 of 1') }}</div>
    </div>
  </div>

  @stack('js')
</body>
</html>
