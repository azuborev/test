'use strict';
$(function () {

    const $next = $("button.next");
    const $submit = $("button#submit");
    let $stepUp = $($next).val();
    $submit.hide();

    $("div.fields").load("step.html #step1", () => {

        //заготовка для работы со странами
        const $country = $("#country");
        const $city = $("#city");
        const $address = $("#address");
        $city.hide();
        $address.hide();

        $country.on('change', () => {
            if ($country.val() === '') {
                $city.hide();
                $address.hide();
            } else {
                $city.show();
                $address.show();
            }
        });
    });

    let inputs = [];
    $($next).on('click', () => {

        //получаем данные со всех полей
        let data = $("form").serializeArray();
            inputs = inputs.concat(data);

            $stepUp++;

        $("div.fields").load("step.html #step" + $stepUp, () => {
            if ($stepUp < 4) {
                $next.show();
                $submit.hide();
            } else {
                $next.hide();
                $submit.show();
                //предварительный просмотр введенных данных на последней странице
                inputs.forEach((item) => {
                    $("#results").append('<li>'+item.name + " : " + item.value + '</li>');
                });
            }
        });
    });
});




