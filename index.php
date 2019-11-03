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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="wrap">
            <form action="weather.php" method="GET">
                <p class="name">
                    Podaj miasto: <input type="text" name="city"/>
                </p>
                <p class="submit">
                    <input type=submit value="Wyślij"/>
                </p>
            </form>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                $(document).on('submit','form',function(event){
                    event.preventDefault();
                    let input = $('input[name="city"]').val();
                    let send = 0;

                    // console.log(input);
                    input = input.split(',');
                    if(input.length > 1 && input.length < 5){
                        // console.log(1);
                        return true;
                    } else {
                        // console.log(input.length);
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>
