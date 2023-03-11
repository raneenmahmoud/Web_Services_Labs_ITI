<?php
$cities = file_get_contents("files/city.list.json");
$json_cities = json_decode($cities, true);
function  getEgyptianCities($var){
    return ($var['country'] == "EG");
};
$Egyptian_Cities = array_filter($json_cities, "getEgyptianCities");
$apikey = "45f0845dc011b3838567eb4329aeb3bb";
if(!empty($_POST)){
    if(isset($_POST["submit"]))
    {
        $cityId = $_POST["city"];
        $ApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&appid=" . $apikey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $ApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        $currentTime = date("d-m-y h:i:sa");
        $icon = "https://openweathermap.org/img/wn/". $data["weather"][0]["icon"] . "@2x.png";  
    }
    if(!empty($data)){
        die('<body style="margin: 0%;
                background: linear-gradient(#46949b,
                #46949b,
                #a3d4f3,
                #c0e6fa);
                display:flex;
                justify-content:center;
                align-items:center;
                background-attachment: fixed;">
                <div style="  
                            width:45%;
                            padding:3%;
                            background-color: white;
                            border-radius: 10px;" 
                >'  
                ."<button type='button' class='btn-close' aria-label='Close' style='margin-left:95%'><a href ='./views/select.php' style='text-decoration:none; color:black'> X </a></button>"
                .'<center><h1 >'.$data["name"].'</h1>'
                ."<p><b> Date&Time : </b>".$currentTime."</p>"
                .'<img src="' . $icon . '" alt="">'
                ."<p><b> Description : </b>".$data["weather"][0]["description"]."</p>"
                ."<p><b>  Min_Temp: : </b>".$data["main"]["temp_min"]."&degF</p>"
                ."<p><b>  Max_Temp: : </b>".$data["main"]["temp_max"]."&degF</p>"
                ."<p><b>  Humidity: : </b>".$data["main"]["humidity"]."%</p>"
                ."<p><b>  Wind: : </b>".($data["wind"]["speed"])."Km/h</p>"
                .'</center>'.
           '</div></body>'
        );
    }

}
require_once("./views/select.php");