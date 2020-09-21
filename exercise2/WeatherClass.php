<?php
/*
 * Также в виде рефакторинга и согласно принципа единой ответственности данный класс можно
 * было разделить на 2 – разнести функции рендеринга и работы с АПИ
 */
class Weather
{
    private $location;
    const API_KEY = '21be3e2f46a388d424fffc268d750402';
    const API_BASE_URL = 'http://api.openweathermap.org/data/2.5/weather';

    public function  __construct($data_location) {
        $this->location = $data_location;
    }

    public function renderWeather() {

        try {
            $data = $this->getWeather();
            echo "Город: {$data->name} | Температура: {$data->main->temp}°C | Влажность: {$data->main->humidity} %";
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    private function get_url() {
        return $url = self::API_BASE_URL."?q=" . $this->location. "&lang=ru&units=metric&appid=" . self::API_KEY;
    }

    private function getWeather() {

        // Создаём запрос
        $ch = curl_init();
        // Настройка запроса
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->get_url());
        // Отправляем запрос и получаем ответ
        $data = json_decode(curl_exec($ch));
        // Закрываем запрос
        curl_close($ch);

        if ($data->cod != 200) {
            throw new Exception('что-то пошло не так');
        } else {
            return $data;
        }
    }
}
$weather_kh = new Weather('Kharkov');
$weather_kh->renderWeather();
