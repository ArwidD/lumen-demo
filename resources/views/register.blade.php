<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <style>
            label {
                display: block;
                margin: 1em;
            }
            .error {
                background-color: pink;
                color: darkred;
            }
        </style>
    </head>
    <body>
        @if($meddelande)
            <p class="error">{{$meddelande}}</p>
        @endif
        <h2>Registrera ny användare</h2>
        <form method="post">
            <label>Namn: <input name="namn" type="text" required> </label>
            <label>Epost: <input name="epost" type="email" required> </label>
            <label>Lösenord: <input name="losenord" type="password" required> </label>
            <input type="submit" value="Registrera!">
        </form>
    </body>
</html>