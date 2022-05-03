<?php
/**
 * Call openweathermap API and return message built using required information from the API response
 * Further the message to be sent to the private slack Channel
 * 
 * @return string
 */
function getWeatherData(){
    $url = "https://api.openweathermap.org/data/2.5/weather?q=ottawa&APPID={your_token}&units=metric";
    $dataArr = getApiResponse($url, 'GET');

    return buildMessageData($dataArr);
}

/**
 * Build Message data to be sent on slack
 *
 * @param object $dataArr
 * @return string $msg
 */
function buildMessageData($dataArr){
    $msg = "Good Morning :sunrise:";
    $msg .= "\n";
    if(isset($dataArr['main']) && isset($dataArr['sys'])){
        $msg .=  "Today's Weather Forecast:";
        $msg .= "\n";
        $msg .= "Current Temperature: ".$dataArr['main']['temp']."℃";
        $msg .= "\n";
        $msg .= "Feels like: ".$dataArr['main']['feels_like']."℃";
        $msg .= "\n";
        $msg .= "Max Temperature: ".$dataArr['main']['temp_max']."℃";
        $msg .= "\n";
        $msg .= "Sunset: ".getTimeFromTS($dataArr['sys']['sunset']);
    }else{
        $msg .=  "Sorry, we are unable to provide today's weather forecast.";
    }
    $msg .= "\n";
    $msg .= "Have a wonderful day!";

    return $msg;
}

/**
 * Build Message data to be sent on slack
 *
 * @param object $dateTime
 * @return string $msg
 */
function getTimeFromTS($dateTime){
    date_default_timezone_set('America/New_York');
    return date('H:i', $dateTime);
}

/**
 * Send a Message to a Slack Channel
 *
 * @param string $channel
 * @return bool|string
 */
function postMessageSlack($channel)
{
    $message = getWeatherData();
    $url = "https://slack.com/api/chat.postMessage";
    $data = http_build_query([
        "token" => "{your_token}",
        "channel" => $channel, 
        "text" => $message, 
        "username" => "MySlackBot",
    ]);
    
    return getApiResponse($url, 'POST', $data);
}

/**
 * Call Requested API and return response
 *
 * @param string $url
 * @param string $reqType
 * @param array $data
 * @return bool|string
 */
function getApiResponse($url = '', $reqType = 'GET', $data = array()){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $reqType);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    return json_decode($resp,true);
}

//call postMessageSlack to send message to #test channel with today's weather data
postMessageSlack('#test');
