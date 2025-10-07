<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo-lista</title>
    </head>
    <body>
        <h1>Todo-lista</h1>
        <form method="POST">
            Uppgift: <input name="uppgift" placeholder="Skriv in en uppgift" required>
            <input type="submit" value="Lägg till">
         </form>
        @if (empty($lista))
            <p>Det finns inget att göra :(</p>
        @else
            <h2>Uppgifter</h2>
            <ul>
                @foreach($lista as $uppgift)
                    <li>
                        <form method="POST">
                            {{$uppgift->id}} {{$uppgift->text}}
                            <input type="hidden" name="uppgift" value="{{$uppgift->id}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Ta bort">
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </body>
</html>