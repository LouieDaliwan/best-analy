<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>{{ settings('app:fulltitle') }} @lang('Toolkit Report')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style>
    @page { margin: 10px 10px; }
    header { position: fixed; top: 0; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    footer { position: fixed; bottom: 0px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    main { padding-top: 50px; padding-bottom: 50px }
    ul, ol, li {
      padding-top: 0;
    }
    body {
      font-size: 12px;
      font-family: sans-serif;
      margin: 0;
      padding: 0;
    }
    .page-break {
      page-break-after: always;
    }
    .section__title {
      text-transform: uppercase;
      font-size: 12px;
      font-weight: bold;
    }
    .section__title--lead {
      padding: 12px;
      background-color: #f9e9cc;
    }
    .traffic-light {
      border: 2px solid;
    }
    .traffic-light__light {
      width: 20px;
      height: 20px;
      border-radius: 50%;
    }
    .traffic-light__light--red {
      background-color: red;
    }
    .traffic-light__light--amber {
      background-color: yellow;
    }
    .traffic-light__light--green {
      background-color: green;
    }
  </style>
</head>
<body>
  <header>header on each page</header>
  <footer>footer on each page</footer>

  <main>
    @include('best::reports.pindex.page1')
    <div class="page-break"></div>
  </main>

</body>
</html>
