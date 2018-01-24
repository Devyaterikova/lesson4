<?php
$id = "APPID=8ff2e5d0018da12e343824578c17dc75";
$city = 'Sydney,AU';
$site = file_get_contents("https://api.openweathermap.org/data/2.5/find?q=$city&units=metric&lang=ru&$id");
$myfile = 'weather.json';

if (empty($site)) {
    $my_file_read = file_get_contents($myfile);
    $data = json_decode($my_file_read,true);
}
else {
    $handle = file_put_contents($myfile, $site);
    $data = json_decode($site,true);
}

$city_name = "<h2>Город: " .  $data['list'][0]['name'] . "</h2>";
$pressure =  $data['list'][0]['main']['pressure'];
$pressure = "<p>Давление: " . round(760 / 1013.25 * $pressure, 2) . " мм рт.cт.;</p>";
$humidity =  "<p>Влажность: " . $data['list'][0]['main']['humidity'] . "%;</p>";
$wind_speed =  "<p>Скорость ветра: " . $data['list'][0]['wind']['speed'] . "м/с;</p>";
$clouds = "<p>Облачность: " . $data['list'][0]['clouds']['all'] . "%;</p>";
$weather = "<p>Осадки: " . $data['list'][0]['weather'][0]['description'] . ".</p>";
$icon_data = $data['list'][0]['weather'][0]['icon'];
$icon_from_site = "http://openweathermap.org/img/w/" . $icon_data . ".png";
$temperature = $data['list'][0]['main']['temp'];
if($temperature > 0){
    $temperature = "<p>Температура: " . "+" . $data['list'][0]['main']['temp'] . ";</p>";
}
else {
    $temperature = "<p>Температура: " . $data['list'][0]['main']['temp'] . ";</p>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Прогноз погоды</title>
</head>

<body>
<div style="width: 600px; margin: 50px auto; background: linear-gradient(grey, white);
        border:2px solid #aaa; border-radius: 15px; box-shadow: 0 20px 10px darkslategray; text-align: center;">
<?=$city_name;?>
<?=$temperature;?>
<?=$pressure;?>
<?=$humidity;?>
<?=$wind_speed;?>
<?=$clouds;?>
<?=$weather;?>
<img src="<?=$icon_from_site;?>" alt="today weather">
</div>
</body>
</html>

