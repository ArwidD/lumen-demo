<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-lista</title>
</head>
<body>
    <h1>Todo-lista</h1>
    <form method="POST">
        Uppgift: <input name="uppgift" placeholder="Skriv in en uppgift" required>
        <input type="submit" value="Lägg till">
        <input name="lista" value="{{json_encode($lista)}}" hidden>
    </form>
    @if (empty($lista))
        <p>Det finns inget att göra!</p>
        @else
        <h2>uppgifter</h2>
        <ul>
            @foreach ($lista as $uppgift)
                <li>{{ $uppgift }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>