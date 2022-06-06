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

  {{-- Chart --}}
  <!-- <script>{{ theme()->inlined(public_path('reports/js/vendor.js')) }}</script> -->
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script> --}}
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
    @page { size: legal ; margin: 0; }
    body { margin: 0; overflow: visible; float: none; background: #ffffff !important; }
    /*body.A4 { width: 210mm }*/
    div.sheet {
      margin: 0;
      display: block;
      overflow: hidden;
      position: relative;
      box-sizing: border-box;
      page-break-after: always;
      /*border: 1px solid red;*/
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
    <table width="100%">
      <tr>
        <td valign="bottom" width="50%">
          @include('best::reports.pdf.partials.footer')
        </td>
        <td valign="bottom" width="50%" class="text-right">
          <section>
            <div class="row">
              <div class="col-md-12">
                <div style="font-size: 10px;">
                {{ __('Page 1 of') }}
                <?php if($data['is_single']): ?> {{ __('8') }}
                <?php else: ?> {{ __('10') }}
                <?php endif; ?>
              </div>
              </div>
            </div>
          </section>
        </td>
      </tr>
    </table>
  </div>

  {{-- overall --}}
  <div class="sheet" style="line-height: 1.3;">
    @include('best::reports.pdf.partials.header')
    <div class="my-2 border-bottom"></div>
    @include('best::reports.pdf.partials.organisation-profile')
    @include('best::reports.pdf.overall.score')
    {{-- @include('best::reports.pdf.overall.pindex') --}}
    @include('best::reports.pdf.partials.disclaimer')
    <table width="100%">
      <tr>
        <td valign="bottom" width="50%">
          @include('best::reports.pdf.partials.footer')
        </td>
        <td valign="bottom" width="50%" class="text-right">
          <section>
            <div class="row">
              <div class="col-md-12">
                <div style="font-size: 10px;">
                  {{ __('Page 2 of') }}
                  <?php if($data['is_single']): ?> {{ __('8') }}
                  <?php else: ?> {{ __('10') }}
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </section>
        </td>
      </tr>
    </table>
  </div>
  {{-- overall --}}

  @foreach ($data['indices'] as $index)
    <div class="sheet" style="line-height: 1.3;">
      @include('best::reports.pdf.partials.header')
      <div class="my-2 border-bottom"></div>
      @include('best::reports.pdf.partials.organisation-profile')
      @include('best::reports.pdf.pindex.performance-index', ['data' => $index, 'orig' => $data['overall:enablers:orig']])
      @include('best::reports.pdf.partials.disclaimer')
      <table width="100%">
        <tr>
          <td valign="bottom" width="50%">
            @include('best::reports.pdf.partials.footer')
          </td>
          <td valign="bottom" width="50%" class="text-right">
            <section>
              <div class="row">
                <div class="col-md-12">
                  <div style="font-size: 10px;">
                    Page
                    <span style="display: none;" class="text-white">-</span>
                    {{ $index['page'] }}
                    <span style="display: none;" class="text-white">-</span> of
                    <?php if($data['is_single']): ?> {{ __('8') }}
                    <?php else: ?> {{ __('10') }}
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </section>
          </td>
        </tr>
      </table>
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
    <table width="100%">
      <tr>
        <td valign="bottom" width="50%">
          @include('best::reports.pdf.partials.footer')
        </td>
        <td valign="bottom" width="50%" class="text-right">
          <section>
            <div class="row">
              <div class="col-md-12">
                <div style="font-size: 10px;">
                  {{ __('Page 7 of') }}
                  <?php if($data['is_single']): ?> {{ __('8') }}
                  <?php else: ?> {{ __('10') }}
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </section>
        </td>
      </tr>
    </table>
  </div>
  {{-- comments --}}

  {{-- <div class="sheet cover-financial-report">
    @include('best::reports.pdf.ratio.cover')
  </div> --}}

  {{-- Analysis --}}
  <div class="sheet">
    @include('best::reports.pdf.partials.header')
    <div class="my-2 border-bottom"></div>
    @include('best::reports.pdf.partials.organisation-profile')
    @if($data['is_single'])
      <div style="zoom: 0.76; line-height: 1.3;">
        @include('best::reports.pdf.financials.singleyear')
        @include('best::reports.pdf.partials.disclaimer')
        <table width="100%">
          <tr>
            <td valign="bottom" width="50%">
              @include('best::reports.pdf.partials.footer')
            </td>
            <td valign="bottom" width="50%" class="text-right">
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div style="font-size: 10px;">
                      {{ __('Page 8 of') }}
                      <?php if($data['is_single']): ?> {{ __('8') }}
                      <?php else: ?> {{ __('10') }}
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </section>
            </td>
          </tr>
        </table>
      </div>
    @else
      <div style="zoom: 0.73; line-height: 1.3;">
        @include('best::reports.pdf.analysis.profitability')
        @include('best::reports.pdf.analysis.liquidity')
        @include('best::reports.pdf.analysis.efficiency')
        @include('best::reports.pdf.analysis.solvency')
        @include('best::reports.pdf.analysis.productivity')
      </div>
    @include('best::reports.pdf.partials.disclaimer')
    <table width="100%">
      <tr>
        <td valign="bottom" width="50%">
          @include('best::reports.pdf.partials.footer')
        </td>
        <td valign="bottom" width="50%" class="text-right">
          <section>
            <div class="row">
              <div class="col-md-12">
                <div style="font-size: 10px;">
                  {{ __('Page 8 of 10') }}
                </div>
              </div>
            </div>
          </section>
        </td>
      </tr>
    </table>
    @endif
  </div>

  @if(!$data['is_single'])
    {{-- Ratios --}}
    <div class="sheet">
      {{-- <div style="zoom: 0.83; line-height: 1;"> --}}
        @include('best::reports.pdf.partials.header')
        <div class="my-2 border-bottom"></div>
        @include('best::reports.pdf.partials.organisation-profile')
        @include('best::reports.pdf.financials.ratios')
      {{-- </div> --}}
      <div style="margin-top: 10px;">
      @include('best::reports.pdf.partials.disclaimer')
      </div>
      <table width="100%">
        <tr>
          <td valign="bottom" width="50%">
            @include('best::reports.pdf.partials.footer')
          </td>
          <td valign="bottom" width="50%" class="text-right">
            <section>
              <div class="row">
                <div class="col-md-12">
                  <div style="font-size: 10px;">
                    {{ __('Page 9 of 10') }}
                  </div>
                </div>
              </div>
            </section>
          </td>
        </tr>
      </table>
    </div>

    {{-- Indicators --}}
    <div class="sheet">
      {{-- <div style="zoom: 0.7; line-height: 1;"> --}}
        @include('best::reports.pdf.partials.header')
        <div class="my-2 border-bottom"></div>
        @include('best::reports.pdf.partials.organisation-profile')
        @include('best::reports.pdf.financials.indicators')
      {{-- </div> --}}
      <div style="margin-top: 75px;">
      @include('best::reports.pdf.partials.disclaimer')
      </div>
      <table width="100%">
        <tr>
          <td valign="bottom" width="50%">
            @include('best::reports.pdf.partials.footer')
          </td>
          <td valign="bottom" width="50%" class="text-right">
            <section>
              <div class="row">
                <div class="col-md-12">
                  <div style="font-size: 10px;">
                    {{ __('Page 10 of 10') }}
                  </div>
                </div>
              </div>
            </section>
          </td>
        </tr>
      </table>
    </div>
    {{-- Indicators --}}
  @endif
</body>
</html>
