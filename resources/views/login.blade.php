<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <style>
            label {
                display: block;
            }

            .err {
                background-color: pink;
                color: darkred;
            }
        </style>
    </head>
    <body>
        <p class="err">{{$message ?? ''}}</p>
        <h1>Login</h1>
        <form method="post">
            <label>
                Epost:
                <input type="email" name="epost" placeholder="Ange epost" required>
            </label>
            <label>
                Lösenord:
                <input type="password" name="losenord" required>
            </label>
            <input type="submit" value="Logga in">
        </form>
    </body>
</html>