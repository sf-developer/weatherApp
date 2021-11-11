<?php
define('SITE_URL', 'https://weather.sajjadfattah.ir');
if(!defined('SITE_URL')) {
    //Send 403 Forbidden response.
    header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden");
    //Kill the script.
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>هواشناسی استان گیلان</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/weather-icons.css">
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="/assets/js/script.js"></script>
</head>
<body>
    <?php
    include_once(getcwd() . '/classes/persian_date.class.php');
    $persian = new persian_date();
    $day_name = date('l');

    $cl = curl_init();
    curl_setopt_array($cl, [
    	CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/weather?q=Rasht%2Cir&lat=0&lon=0&units=metric",
    	CURLOPT_RETURNTRANSFER => true,
    	CURLOPT_FOLLOWLOCATION => true,
    	CURLOPT_ENCODING => "",
    	CURLOPT_MAXREDIRS => 10,
    	CURLOPT_TIMEOUT => 30,
    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	CURLOPT_CUSTOMREQUEST => "GET",
    	CURLOPT_HTTPHEADER => [
    	    "Accept: application/json",
    		"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
    		"x-rapidapi-key: 173c76b589mshaad10f0f019bbcap11ff92jsn9bef1a21a8fe"
    	],
    ]);

    $resp = curl_exec($cl);
    $error = curl_error($cl);

    curl_close($cl);

    if ($error) {
	    echo "cURL Error #:" . $error;
    } else {
        $resp = json_decode($resp);
        $humidity = $resp->main->humidity;
        $speed = $resp->wind->speed;
        $temp = $resp->main->temp;
        $weather = $resp->weather;
        foreach($weather as $wh){
            $weather_type = $wh->id;
            $icon = $wh->icon;
            switch($weather_type){
                case 200 || 201 || 202 || 210 || 211 || 212 || 221 || 230 || 231 || 232:
                    $type = 'رعد و برق';
                    break;
                case 300 || 301 || 302 || 310 || 311 || 312 || 313 || 314 || 321:
                    $type = 'نم نم باران';
                    break;
                case 500 || 501 || 502 || 503 || 504 || 511 || 520 || 521 || 522 || 531:
                    $type = 'بارانی';
                    break;
                case 600 || 601 || 602 || 611 || 612 || 613 || 615 || 616 || 620 || 621 || 622:
                    $type = 'برفی';
                    break;
                case 701 || 711 || 721 || 731 || 741 || 751 || 761 || 762 || 771 || 781:
                    $type = '';
                    break;
                case 800:
                    $type = 'صاف';
                    break;
                case 801 || 802 || 803 || 804:
                    $type = 'ابری';
                    break;
            }
            switch($icon){
                case '11d':
                    $icn = '<i class="wi wi-day-lightning"></i>';
                    break;
                case '11n':
                    $icn = '<i class="wi wi-night-alt-lightning"></i>';
                    break;
                case '09d':
                    $icn = '<i class="wi wi-day-showers"></i>';
                    break;
                case '09n':
                    $icn = '<i class="wi wi-night-alt-showers"></i>';
                    break;
                case '10d':
                    $icn = '<i class="wi wi-day-rain"></i>';
                    break;
                case '10n':
                    $icn = '<i class="wi wi-night-alt-rain"></i>';
                    break;
                case '13d':
                    $icn = '<i class="wi wi-day-snow"></i>';
                    break;
                case '13n':
                    $icn = '<i class="wi wi-night-alt-snow"></i>';
                    break;
                case '50d':
                    $icn = '<i class="wi wi-day-fog"></i>';
                    break;
                case '50n':
                    $icn = '<i class="wi wi-night-fog"></i>';
                    break;
                case '01d':
                    $icn = '<i class="wi wi-day-sunny"></i>';
                    break;
                case '01n':
                    $icn = '<i class="wi wi-night-clear"></i>';
                    break;
                case '02d':
                    $icn = '<i class="wi wi-day-cloudy"></i>';
                    break;
                case '02n':
                    $icn = '<i class="wi wi-night-alt-cloudy"></i>';
                    break;
                case '03d':
                    $icn = '<i class="wi wi-day-sunny-overcast"></i>';
                    break;
                case '03n':
                    $icn = '<i class="wi wi-night-partly-cloudy"></i>';
                    break;
                case '04d':
                    $icn = '<i class="wi wi-day-cloudy-high"></i>';
                    break;
                case '04n':
                    $icn = '<i class="wi wi-night-cloudy-high"></i>';
                    break;
                                
            }
        }
        
        
    
    }

  $curl = curl_init();

    curl_setopt_array($curl, [
    	CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/forecast/daily?q=Rasht%2Cir&lat=0&lon=0&cnt=4&units=metric",
    	CURLOPT_RETURNTRANSFER => true,
    	CURLOPT_FOLLOWLOCATION => true,
    	CURLOPT_ENCODING => "",
    	CURLOPT_MAXREDIRS => 10,
    	CURLOPT_TIMEOUT => 30,
    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	CURLOPT_CUSTOMREQUEST => "GET",
    	CURLOPT_HTTPHEADER => [
    	    "Accept: application/json",
    		"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
    		"x-rapidapi-key: 173c76b589mshaad10f0f019bbcap11ff92jsn9bef1a21a8fe"
    	],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);


    ?>
    <div class="container">
      <div class="weather-side">
        <div class="weather-gradient"></div>
        <div class="date-container">
          <h2 class="date-dayname"><?php echo $persian->day_name($day_name); ?></h2><span class="date-day"><?php echo $persian->date("compelete"); ?></span><i class="location-icon" data-feather="map-pin"></i><span class="location">گیلان، رشت</span>
        </div>
        <div class="weather-container"><?php echo $icn; ?>
          <h1 class="weather-temp"><?php echo $temp; ?>°C</h1>
          <h3 class="weather-desc"><?php echo $type; ?></h3>
        </div>
      </div>
      <div class="info-side">
        <div class="today-info-container">
          <div class="today-info">
            <div class="humidity"> <span class="title">رطوبت</span><span class="value"><?php echo $humidity; ?> %</span>
              <div class="clear"></div>
            </div>
            <div class="wind"> <span class="title">باد</span><span class="value"><?php echo $speed * 3.6; ?> km/h</span>
              <div class="clear"></div>
            </div>
          </div>
        </div>
        <div class="week-container">
          <ul class="week-list">
              <?php
              
              if ($err) {
                	echo "cURL Error #:" . $err;
                } else {
                    $response = json_decode($response);
                    
                    $lists = $response->list;
                    $i = 0;
                    foreach($lists as $list){
                        $weathers = $list->weather;
                        $temp = $list->temp->day;
                        
                        foreach($weathers as $weather){
                            
                            if($i == 0){
                                $html = '<li class="active">';
                            }else{
                                $html = '<li>';
                                $day_name = date('l', strtotime("+".$i." day"));
                            }
                            
                            switch($weather->icon){
                                case '11d':
                                    $html .= '<i class="wi wi-lightning"></i>';
                                    break;
                                case '09d':
                                    $html .= '<i class="wi wi-rain"></i>';
                                    break;
                                case '10d':
                                    $html .= '<i class="wi wi-day-rain-mix"></i>';
                                    break;
                                case '13d':
                                    $html .= '<i class="wi wi-snowflake-cold"></i>';
                                    break;
                                case '50d':
                                    $html .= '<i class="wi wi-lightning"></i>';
                                    break;
                                case '01d':
                                    $html .= '<i class="wi wi-day-sunny"></i>';
                                    break;
                                case '02d':
                                    $html .= '<i class="wi wi-day-cloudy"></i>';
                                    break;
                                case '03d':
                                    $html .= '<i class="wi wi-cloud"></i>';
                                    break;
                                case '04d':
                                    $html .= '<i class="wi wi-cloudy"></i>';
                                    break;
                                
                            }
                            
                            $html .= '<span class="day-name">';
                            $html .= $persian->day_name($day_name);
                            $html .= '</span>';
                            $html .= '<span class="day-temp">';
                            $html .= $temp . '°C';
                            $html .= '</span>';
                            $html .= '</li>';
                            
                            echo $html;
                            $i++;
                        }
                    }
                
                }
    ?>
            <div class="clear"></div>
          </ul>
        </div>
      </div>
    </div>
</body>
</html>