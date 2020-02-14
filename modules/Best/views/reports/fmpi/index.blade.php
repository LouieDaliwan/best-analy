<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

  <!-- Fonts -->
  <!-- Theme CSS -->
  <style>{{ theme()->inlined(public_path('reports/css/theme.min.css')) }}</style>
  <style>{{ theme()->inlined(public_path('reports/css/custom.css')) }}</style>
</head>

<body>
  <table class="my-4">
    <tbody>
      <tr>
        <td><a class="navbar-brand" href="" class="mr-4"><img height="48" src="{{ asset('logo.png') }}" alt=""></a></td>
        <td>
          <div>
            <h4 class="my-0 mb-1 font-weight-bold" style="color: #167bc3;">{{ settings('app:fulltitle') }} @lang('Toolkit Report')</h4>
            <small class="">@lang('Empowered by') {{ settings('app:author') }}</small>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <main>
    @include('best::reports.fmpi.page1')
    <div class="page-break"></div>
    @include('best::reports.fmpi.page2')
    <div class="page-break"></div>
    @include('best::reports.fmpi.page3')
    <div class="page-break"></div>
  </main>

  <footer class="blockquote-footer">
    <div class="my-4 mx-3" style="color: #95aac9;">
      <p><small><cite><strong>DISCLAIMER:</strong> The BEST Report is engineered to swiftly analyse the critical areas for organisations to transform their Sustainability, Human Resource, Productivity and Financial capabilities. The dashboard engine was designed to provide Consultants with a quick pulse understanding of Client organisation’s critical capability areas. The index, which are essentially perception-based and subject to available data, were derived mainly from the responses to the survey administered to relevant respondents of that organisation.</cite></p>
      <strong>Copyright 2019 <cite>SSA Consulting</cite></small></strong>
    </div>
  </footer>
</body>
</html>
