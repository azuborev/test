'use strict';

jQuery(function () {
    const button = jQuery("#search_submit");
    const form = jQuery("#form");
    const post_links = jQuery("#post_links");

    button.on('click', function (e) {
        const title = jQuery("#title").val();
        const date = jQuery("#from_date").val();
        const number = jQuery("#number").val();

        e.preventDefault();

        post_links.empty();
        const ajax_data = {
            action: 'zb-get-post',
            title: title,
            date: date,
            number: number,
        }
        $.post(zb_ajax.url, ajax_data, res => {
            console.log(res);
            if (res.data.length > 0) {
                res.data.forEach((item) => {
                    post_links.append(`<p><a href="${item.guid}">${item.post_title}</a></p>`);
                });
            } else {
                post_links.append(`<p>Nothing</p>`);
            }
        });
    });

    jQuery("#reset_button").on('click', function (e) {
        e.preventDefault();
        form.trigger('reset');
        post_links.empty();
    });
});
