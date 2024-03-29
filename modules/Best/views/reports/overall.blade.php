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
  <script src="{{ asset('reports/js/radius.js') }}"></script>

  {{-- Theme CSS --}}
  <style>{{ theme()->inlined(public_path('reports/css/report.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/ratios.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/indicators.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/overall-cover.css')) }}</style>

  @if($data['financialStatementCount'] == 3)
    <style>{{ theme()->inlined(public_path('reports/css/ratios.css')) }}</style>
    <style>{{ theme()->inlined(public_path('reports/css/indicators.css')) }}</style>
  @elseif($data['financialStatementCount'] == 2)
    <style>{{ theme()->inlined(public_path('reports/css/ratios2.css')) }}</style>
    <style>{{ theme()->inlined(public_path('reports/css/indicators2.css')) }}</style>
  @endif

  <style>{{ theme()->inlined(public_path('reports/css/ratio-cover.css')) }}</style>

  {{-- RTL --}}
  @if (app()->getLocale() == 'ar')
    <style>{{ theme()->inlined(public_path('reports/css/rtl.css')) }}</style>
  @endif
</head>

<body>
  <main>
    <div class="container">
      <div class="main-body">
        @include('best::reports.overall.cover')
      </div>
    </div>

    <div class="container">
      <div class="main-body">
        <div class="main-content pb-3">
          @include('best::reports.partials.header')
        </div>
        <div class="mt-2 border-bottom"></div>
        <div class="main-content">
          @include('best::reports.summary.about')
          @include('best::reports.summary.report-objectives')
          @include('best::reports.summary.key-benefits')
          @include('best::reports.summary.what-is-in-report')
          @include('best::reports.summary.data-reliability-validity')
          @include('best::reports.summary.data-privacy')
          <div class="row align-items-end">
            <div class="col-md-6 col-12">
              @include('best::reports.partials.footer')
            </div>
            <div class="col-md-6 col-12 text-right blockquote-footer">
              <cite>
                <div style="font-size: 10px;">
                  {{ __('Page 1 of') }}
                  <?php if($data['is_single']): ?> {{ __('8') }}
                  <?php else: ?> {{ __('10') }}
                  <?php endif; ?>
                </div>
              </cite>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- overall --}}
    <div class="container">
      <div class="main-body">
        <div class="main-content pb-3">
          @include('best::reports.partials.header')
        </div>
        <div class="mt-2 border-bottom"></div>
        <div class="main-content">
          @include('best::reports.partials.organisation-profile')
          @include('best::reports.overall.score')
          @include('best::reports.overall.pindex')
          @include('best::reports.partials.disclaimer')
          <div class="row align-items-end">
            <div class="col-md-6 col-12">
              @include('best::reports.partials.footer')
            </div>
            <div class="col-md-6 col-12 text-right blockquote-footer">
              <cite>
                <div style="font-size: 10px;">
                  {{ __('Page 2 of') }}
                  <?php if($data['is_single']): ?> {{ __('8') }}
                  <?php else: ?> {{ __('10') }}
                  <?php endif; ?>
                </div>
              </cite>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- overall --}}

    @foreach ($data['indices'] as $index)
      @if($index['pindex:code'] !== 'BGMI')
      <div class="container">
        <div class="main-body">
          <div class="main-content pb-3">
            @include('best::reports.partials.header')
          </div>
          <div class="mt-2 border-bottom"></div>
          <div class="main-content">
            @include('best::reports.partials.organisation-profile')
            @include('best::reports.pindex.performance-index', ['data' => $index, 'orig' => $data['overall:enablers:orig']])
            @include('best::reports.partials.disclaimer')
            <div class="row align-items-end">
            <div class="col-md-6 col-12">
              @include('best::reports.partials.footer')
            </div>
            <div class="col-md-6 col-12 text-right blockquote-footer">
              <cite>
                <div style="font-size: 10px;">
                  Page <span style="display: none;" class="text-white">-</span>
                  {{ $index['page'] }}<span style="display: none;" class="text-white">-
                  </span> of
                  <?php if($data['is_single']): ?> {{ __('8') }}
                  <?php else: ?> {{ __('10') }}
                  <?php endif; ?>
                </div>
              </cite>
            </div>
          </div>
        </div>
      </div>
      @endif
    @endforeach

    {{-- comments --}}
    <div class="container">
      <div class="main-body">
        <div class="main-content pb-3">
          @include('best::reports.partials.header')
          @include('best::reports.partials.organisation-profile')
          @include('best::reports.overall.comments')
          @include('best::reports.partials.disclaimer')
          <div class="row align-items-end">
            <div class="col-md-6 col-12">
              @include('best::reports.partials.footer')
            </div>
            <div class="col-md-6 col-12 text-right blockquote-footer">
              <cite>
                <div style="font-size: 10px;">
                  {{ __('Page 7 of') }}
                  <?php if($data['is_single']): ?> {{ __('8') }}
                  <?php else: ?> {{ __('10') }}
                  <?php endif; ?>
                </div>
              </cite>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- comments --}}

    {{-- Analysis --}}
    <div class="container">
      <div class="main-body">
        <div class="main-content pb-3">
          @include('best::reports.partials.header')
        </div>
        <div class="mt-2 border-bottom"></div>
        <div class="main-content">
          @include('best::reports.partials.organisation-profile')
          @if($data['is_single'] == true)
            @include('best::reports.analysis.singleperiod.gross')
            @include('best::reports.analysis.singleperiod.netmargin')
            @include('best::reports.analysis.singleperiod.currentratio')
            @include('best::reports.analysis.singleperiod.debtratio')
            @include('best::reports.analysis.singleperiod.roi')
            @include('best::reports.analysis.singleperiod.rawmaterials')
            @include('best::reports.partials.disclaimer')
            <div class="row align-items-end">
              <div class="col-md-6 col-12">
                @include('best::reports.partials.footer')
              </div>
              <div class="col-md-6 col-12 text-right blockquote-footer">
                <cite>
                  <div style="font-size: 10px;">
                    {{ __('Page 8 of') }}
                    <?php if($data['is_single']): ?> {{ __('8') }}
                    <?php else: ?> {{ __('10') }}
                    <?php endif; ?>
                  </div>
                </cite>
              </div>
            </div>
          @else
            @include('best::reports.analysis.profitability')
            @include('best::reports.analysis.liquidity')
            @include('best::reports.analysis.efficiency')
            @include('best::reports.analysis.solvency')
            @include('best::reports.analysis.productivity')
            @include('best::reports.partials.disclaimer')
            <div class="row align-items-end">
              <div class="col-md-6 col-12">
                @include('best::reports.partials.footer')
              </div>
              <div class="col-md-6 col-12 text-right blockquote-footer">
                <cite>
                  <div style="font-size: 10px;">
                    {{ __('Page 8 of') }}
                    <?php if($data['is_single']): ?> {{ __('8') }}
                    <?php else: ?> {{ __('10') }}
                    <?php endif; ?>
                  </div>
                </cite>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
    {{-- Analysis --}}

    <?php if($data['is_single']): ?>
      {{-- Ratios --}}
      {{-- <div class="container">
        <div class="main-body">
          <div class="main-content pb-3">
            @include('best::reports.partials.header')
          </div>
          <div class="mt-2 border-bottom"></div>
          <div class="main-content">
            @include('best::reports.partials.organisation-profile')
            @include('best::reports.financials.singleyear', ['data' => $data['ratios:financial']])
            @include('best::reports.partials.disclaimer')
            @include('best::reports.partials.footer')
            <div class="text-right">
              <div style="font-size: 12px;">{{ __('Page 2 of 2') }}</div>
            </div>
          </div>
        </div>
      </div> --}}
      {{-- Ratios --}}
    <?php else: ?>
      {{-- Ratios --}}
      <div class="container">
        <div class="main-body">
          <div class="main-content pb-3">
            @include('best::reports.partials.header')
          </div>
          <div class="mt-2 border-bottom"></div>
          <div class="main-content">
            @include('best::reports.partials.organisation-profile')
            @include('best::reports.financials.ratio', ['data' => $data['ratios:financial']])
            @include('best::reports.partials.disclaimer')
            <div class="row align-items-end">
              <div class="col-md-6 col-12">
                @include('best::reports.partials.footer')
              </div>
              <div class="col-md-6 col-12 text-right blockquote-footer">
                <cite>
                  <div style="font-size: 10px;">
                    {{ __('Page 9 of') }}
                    <?php if($data['is_single']): ?> {{ __('8') }}
                    <?php else: ?> {{ __('10') }}
                    <?php endif; ?>
                  </div>
                </cite>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Ratios --}}

      {{-- Indicators --}}
      <div class="container">
        <div class="main-body">
          <div class="main-content pb-3">
            @include('best::reports.partials.header')
          </div>
          <div class="mt-2 border-bottom"></div>
          <div class="main-content">
            @include('best::reports.partials.organisation-profile')
            @include('best::reports.financials.indicators')
            @include('best::reports.partials.disclaimer')
            <div class="row align-items-end">
              <div class="col-md-6 col-12">
                @include('best::reports.partials.footer')
              </div>
              <div class="col-md-6 col-12 text-right blockquote-footer">
                <cite>
                  <div style="font-size: 10px;">
                    {{ __('Page 10 of') }}
                    <?php if($data['is_single']): ?> {{ __('8') }}
                    <?php else: ?> {{ __('10') }}
                    <?php endif; ?>
                  </div>
                </cite>
              </div>
            </div>
        </div>
      </div>
      {{-- Indicators --}}
    <?php endif; ?>
  </main>
</body>
</html>
