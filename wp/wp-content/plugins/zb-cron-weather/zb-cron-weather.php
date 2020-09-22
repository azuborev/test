<?php
/*
 * Plugin Name: Zb-Cron-Weather
 * Description: Plugin for sending an email message with the weather
 */

define('API_KEY', '21be3e2f46a388d424fffc268d750402');
define('API_BASE_URL', 'http://api.openweathermap.org/data/2.5/weather');
define('API_CITY', 'Los Angeles');
define('FROM_MAIL', 'from@sender.com');
define('TO_MAIL', 'to@receiver.com');

register_activation_hook(__FILE__, 'activation_send_mail_with_weather');
function activation_send_mail_with_weather() {
    wp_clear_scheduled_hook( 'send_mail_with_weather' );
    wp_schedule_event( time(), 'three_hours', 'send_mail_with_weather');
}

register_deactivation_hook( __FILE__, 'deactivation_send_mail_with_weather');
function deactivation_send_mail_with_weather() {
    wp_clear_scheduled_hook('send_mail_with_weather');
}

add_filter( 'cron_schedules', 'cron_add_three_hours' );
function cron_add_three_hours( $schedules ) {
    $schedules['three_hours'] = [
        'interval' => HOUR_IN_SECONDS * 3,
        'display'  => __('Every 3 hours'),
    ];
    return $schedules;
}

add_action( 'send_mail_with_weather', 'send_mail_with_updated_weather' );
function send_mail_with_updated_weather(){
    $weather_data = get_weather_data( API_CITY );
    wp_mail( TO_MAIL, 'Weather in '.API_CITY, $weather_data, 'From: ' . FROM_MAIL);
}

function get_weather_data( $location ) {
    $params = [
                'q' => $location,
                'lang' => 'ru',
                'units' => 'metric',
                'appid' => API_KEY,
            ];
    $url = add_query_arg( $params, esc_url_raw(API_BASE_URL) );
    $response = wp_remote_get( $url );
    $response_code    = wp_remote_retrieve_response_code( $response );
    $response_body    = json_decode(wp_remote_retrieve_body( $response ));

    if (( 200 != $response_code ) || ( ! $response_body )) {
        $message = 'Trouble with weather data.';
    } else {
        $message = "{$response_body->name}: t, °C: {$response_body->main->temp} |  Ф, %: {$response_body->main->humidity}";
    }
    return $message;
}
