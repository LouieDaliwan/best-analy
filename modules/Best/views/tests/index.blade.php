<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Test</title>
  <link rel="stylesheet" href="//unpkg.com/gutenberg-css" media="print" charset="utf-8">
  <link rel="stylesheet" href="//unpkg.com/gutenberg-css/dist/themes/modern.min.css" media="print" charset="utf-8">

  <style>{{ theme()->inlined(public_path('reports/css/critical.css')) }}</style>
  <style>
    @page { size: A4; margin: 10mm; }
    html { font-family: 'Rubik', sans-serif; }
    body { font-family: 'Rubik', sans-serif; }
    h1 { font-family: 'Rubik', sans-serif; font-size: 18px; }
    .sheet { page-break-after: always; }
  </style>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
</head>
<body class="A4">
  {{-- Page 1 --}}
  <section class="sheet padding-10mm">
    <article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi sequi, minima, soluta, ratione earum eveniet saepe sint enim et assumenda dolorem architecto fuga quibusdam dolores quis! Vero placeat, consectetur debitis.</article>
  </section>

  {{-- Page 2 --}}
  <section class="sheet padding-10mm page-break-before">
    <article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae nihil eaque beatae aperiam, facilis placeat quos totam, quisquam voluptatum unde doloribus vel cumque voluptas porro, officia? Repellat laboriosam quidem, eos.</article>
  </section>
</body>
</html>
