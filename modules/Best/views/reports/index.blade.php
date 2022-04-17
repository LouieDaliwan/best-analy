<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ app()->getLocale() }}">
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

  {{-- Chart --}}
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"></script>
  <script src="{{ asset('reports/js/radius.js') }}"></script>

  {{-- Theme CSS --}}
  <style>{{ theme()->inlined(public_path('reports/css/report.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/ratios.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/indicators.css')) }}</style>

  {{-- RTL --}}
  @if (app()->getLocale() == 'ar')
    <style>{{ theme()->inlined(public_path('reports/css/rtl.css')) }}</style>
  @endif
</head>

<body>
  <main>
    <div class="container">
      <div class="main-body">
        <div class="main-content">
          @include('best::reports.partials.cover', ['data' => $data['current:pindex']])
        </div>
      </div>
    </div>

    <div class="container">
      <div class="main-body">
        <div class="main-content pb-3">
          @include('best::reports.partials.header')
        </div>
        <div class="mt-2 border-bottom"></div>
        <div class="main-content">
          @include('best::reports.partials.organisation-profile')
          @include('best::reports.pindex.performance-index', ['data' => $data['current:pindex'], 'orig' => $data['overall:enablers:orig'] ?? null])
          @include('best::reports.partials.disclaimer')
          @include('best::reports.partials.footer')
          <div class="text-right">
            {{-- @if ($data['current:index']['pindex:code'] == 'FMPI')
              <div style="font-size: 12px;">{{ __('Page 1 of 3') }}</div>
            @else --}}
              <div style="font-size: 12px;">{{ __('Page 1 of 1') }}</div>
            {{-- @endif --}}
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
