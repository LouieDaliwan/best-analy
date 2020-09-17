<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Temporary Data from LocalStorage</title>
</head>
<body>

    <div id="main"></div>

    <script type="text/javascript">
        localStorage.clear();

        let m = document.querySelector('#main')
        m.innerHTML = 'Done. <br><a href="/login">Back to Login</a>';
    </script>
</body>
</html>
