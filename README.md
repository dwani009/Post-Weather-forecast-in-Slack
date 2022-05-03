This program when executed Sends Weather Forecast to a Private Slack Channel and has been created as Daily service which would run at 8.00 AM EST everyday.
You would need API token for Slack and weather forecast service (I have used OpenWeatherMap which provides limited free service)

 * In order to get the Slack API Token refer following steps:
 * 1.) Create an APP from the link: https://api.slack.com/apps/
 * 2.) Look for "Install App"
 * 3.) Use the "Bot User OAuth Token"
 *     The token will look something like this `xoxb-2100000415-0000000000-0000000000-ab1ab1`.
 * 4.) Invite or add the newly created, simply type @my_app_name in the message box and click on invite
 * 5.) API url: https://slack.com/api/chat.postMessage
 *
 * 
 * In order to get the OpenWeatherMap Token refer following steps:
 * 1.)Signup to generate a new token by clicking https://home.openweathermap.org/users/sign_up
 * 2.) Once verified your email after signup, API token would be activated and can be found here: https://home.openweathermap.org/api_keys
 *     The token will look something like this '948391adb6c26c6bd7f19cb95de4d21e'.
 * 3.) I will be using Current Weather Data API, but they have other options available as well. Refer following link for more information https://openweathermap.org/api
 * 4.) API url: https://api.openweathermap.org/data/2.5/weather?appid={openweathermap_apikey}&q=chicago


Steps to run the program:
1. Replace {your_token} with actual token of openWeatherMap API and slack API on Line no. 9 and 65 respectively.
2. On line no. 97, update the name of channel with # before it (example #test). You could also use channel id instead of channel name.
3. Execute the code using php code.php. (code.php is the file name of the program)

Note:
If you nned to update timezone where I used it for displaying sunset time, you can replace it on Line no. 50.
If you are using private channel, don't forget to add app in that particular channel.

Output:
![image](https://user-images.githubusercontent.com/13583745/166564106-749d26af-d4b3-4544-8781-5e6679524a3b.png)
