<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>färger</title>
    <style>
        body {
            background-color: {{ $backColor ?? 'inherit' }};
            color: {{ $textColor ?? 'inherit' }};
        }
    </style>
</head>
<body>
    <h1>välj färger</h1>
    <form method ="POST">
        välj textfärg: <input name="textColor" value="{{ $textColor ?? ''}}"><br>
        välj bakgrundsfärg: <input name="backColor" value="{{ $backColor ?? ''}}"><br>
        <input type="submit" value="skicka"><br>
        <input type="reset" value="ångra"><br>
    </form>
</body>
</html>