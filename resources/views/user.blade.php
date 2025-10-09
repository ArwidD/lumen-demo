<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Användare</title>
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }
        </style>
</head>
<body>
    <h1>Användare</h1>
    <form method="post">
        @if(isset($user))
            <input type="hidden" name="id" value="{{$user->id}}">
            @endif
    <label>Namn: <input name="namn" requried placeholder="Ange namn"
 value="{{$user->namn ?? ''}}">
    </label>
        <label>Epost:
    <input type="email" name="epost" required placeholder="Ange epost" value="{{$user->epost ?? ''}}">
        </label>
        <input type="submit" value="Spara">
        <input type="reset" value="Ångra">
        @if(isset($user))
            <input type="submit" name="delete" value="ta bort">
            @endif
    </form>
    @if (!empty($lista))
        <h2>Alla användare</h2>
    <ul>
                @foreach($lista as $u)
                    <li>
                            {{$u->id}}.
                            <a href="/anvandare/{{$u->id}}">{{$u->namn}}</a> 
                            {{$u->epost}} 
                    </li>
                @endforeach
            </ul>
        @endif
</body>
</html>