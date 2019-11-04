<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>OpenWeatherMap App</title>
        <style>
            .wrap{
                max-width: 320px;
                margin: 20px auto;
            }
            .wrap form{
                display: block;
                margin: auto;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <form action="weather.php" method="GET">
                <p class="name">
                    Podaj miasta: <input type="text" name="city" placeholder="Example 'city1,city2'" />
                </p>
                <p class="submit">
                    <input type=submit value="Wyślij"/>
                </p>
            </form>
        </div>

    </body>
</html>
