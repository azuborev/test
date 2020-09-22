'use strict';

function switchShow(array) {
    array.forEach(item => {
        item.show();
    });
}
function switchHide(array) {
    array.forEach(item => {
        item.hide();
    });
}
function renderMessage(tag, item, tagId) {
    tag.before(`<p id="${tagId}">${item}</p>`);
}

$(function () {
    const $back = $("button#back");
    const $next = $("button#next");
    const $submit = $("button#submit");
    const $inputDiv = $("div#inputFields");
    const $form = $("form");
    let $stepUp = $next.val();

    switchHide([$back, $submit]);

    $inputDiv.load("step.html #step1", function() {
        const $country = $("#country");
        const $city = $("#city");
        const $address = $("#address");
        switchHide([$city, $address]);

        $country.on('change', function() {
            if ($country.val() === '') {
                $city.prop("required", false).hide();
                $address.hide();
            } else {
                $city.prop("required", true).show();
                $address.show();
            }
        });
    });

    let inputs = [];
    $next.on('click', function () {
        let data = $form.serializeArray();
            inputs = inputs.concat(data);
            $stepUp++;

        $inputDiv.load("step.html #step" + $stepUp, function () {
            if ($stepUp < 4) {
                switchShow([$next, $back]);
                $submit.hide();
            } else {
                $next.hide();
                $submit.show();

                //предварительный просмотр введенных данных на последней странице
                let userData = {};
                inputs.forEach((item) => {
                    $("#results").append('<li>'+item.name + " : " + item.value + '</li>');
                    userData[item.name] = item.value;
                });
                $form.on('submit', function (e) {
                    e.preventDefault();
                    const h3 = $("h3");
                    $("button#submit").prop('disabled', true);
                    $.post(
                        'send.php',
                        userData,
                        function (data) {
                            let info = JSON.parse(data);
                            if (info.status === 'valid') {
                                renderMessage(h3, info.message, 'success');
                            } else {
                                renderMessage(h3, info.message, 'error');
                                const errors = info.errors;
                                    errors.forEach((item) => {
                                        renderMessage(h3, item, 'error');
                                });
                            }
                        })
                        .fail(function() {
                            renderMessage(h3, 'Ошибка работы сервера', 'error');
                        })
                        .always(function() {
                            $("button#submit").prop('disabled', false);
                        });
                });
            }
        });
    });
});




