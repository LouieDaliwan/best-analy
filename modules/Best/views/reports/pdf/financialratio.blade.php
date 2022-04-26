<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ app()->getLocale() }}">
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  {{-- Chart --}}
  <!-- <script>{{ theme()->inlined(public_path('reports/js/vendor.js')) }}</script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"></script>

  <script type="text/javascript">
    Chart.register(chartjs-plugin-annotation);
  </script>

  {{-- Theme CSS --}}
  <style>{{ theme()->inlined(public_path('reports/css/basic.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/ratio-cover.css')) }}</style>
  @if($data['financialStatementCount'] == 3) 
    <style>{{ theme()->inlined(public_path('reports/css/pdf/ratios.css')) }}</style>
    <style>{{ theme()->inlined(public_path('reports/css/pdf/indicators.css')) }}</style>
  @elseif($data['financialStatementCount'] == 2)
    <style>{{ theme()->inlined(public_path('reports/css/pdf/ratios2.css')) }}</style>
    <style>{{ theme()->inlined(public_path('reports/css/pdf/indicators2.css')) }}</style>
  @endif
  
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
    .cover-financial-report {
      height: 1342px;
    }
    .waveWrapperInner {
      background: #ffffff !important;
    }

  </style>
</head>

<body class="A4 lang-{{ app()->getLocale() ?: 'en' }}">
  <div class="sheet cover-financial-report">
    @include('best::reports.pdf.ratio.cover')
  </div>

  {{-- Analysis --}}
  <div class="sheet">
    <div style="zoom: 0.76; line-height: 1;">
      @include('best::reports.pdf.partials.header')
      <div class="my-2 border-bottom"></div>
      @include('best::reports.pdf.partials.organisation-profile')
      @if($data['is_single'])
        @include('best::reports.pdf.financials.singleyear')
        <div class="text-right">
          <div style="font-size: 12px;">{{ __('Page 1 of 1') }}</div>
        </div>
        @include('best::reports.partials.disclaimer')
        @include('best::reports.partials.footer') 
      @else
        @include('best::reports.pdf.analysis.profitability')
        @include('best::reports.pdf.analysis.liquidity')
        @include('best::reports.pdf.analysis.efficiency')
        @include('best::reports.pdf.analysis.solvency')
        @include('best::reports.pdf.analysis.productivity')
    </div>
    @include('best::reports.pdf.partials.disclaimer')
    @include('best::reports.pdf.partials.footer')
    <div class="text-right">
      <div style="font-size: 12px;">{{ __('Page 1 of 3') }}</div>
    </div>
    @endif
  </div>

  @if(!$data['is_single'])
    {{-- Ratios --}}
    <div class="sheet">
      <div style="zoom: 0.83; line-height: 1;">
        @include('best::reports.pdf.partials.header')
        <div class="my-2 border-bottom"></div>
        @include('best::reports.pdf.partials.organisation-profile')
        @include('best::reports.pdf.financials.ratios')
      </div>
      <div style="margin-top: 10px;">
      @include('best::reports.pdf.partials.disclaimer')
      @include('best::reports.pdf.partials.footer')
      </div>
      <div class="text-right">
        <div style="font-size: 12px;">{{ __('Page 2 of 3') }}</div>
      </div>
    </div>

    {{-- <div class="sheet"> --}}
      {{-- <div style="zoom: 0.7; line-height: 1;">
        @include('best::reports.pdf.partials.header')
        <div class="my-2 border-bottom"></div>
        @include('best::reports.pdf.partials.organisation-profile')
        @include('best::reports.pdf.financials.secratios', ['data' => $data['ratios:financial']])
      </div> --}}
      {{-- TODO optimize Louie Daliwan --}}
      {{-- <div style="margin-top: 380px;"> 
        @include('best::reports.pdf.partials.disclaimer')
        @include('best::reports.pdf.partials.footer')
      </div>
      <div class="text-right">
        <div style="font-size: 12px;">{{ __('Page 3 of 4') }}</div>
      </div>
    </div>  --}}
    {{-- Ratios --}}

    {{-- Indicators --}}
    <div class="sheet">
      <div style="zoom: 0.7; line-height: 1;">
        @include('best::reports.pdf.partials.header')
        <div class="my-2 border-bottom"></div>
        @include('best::reports.pdf.partials.organisation-profile')
        @include('best::reports.pdf.financials.indicators')
      </div>
      <div style="margin-top: 335px;"> 
      @include('best::reports.pdf.partials.disclaimer')
      @include('best::reports.pdf.partials.footer')
      </div>
      <div class="text-right">
        <div style="font-size: 12px;">{{ __('Page 3 of 3') }}</div>
      </div>
    </div>
    {{-- Indicators --}}
  @endif
</body>
</html>
