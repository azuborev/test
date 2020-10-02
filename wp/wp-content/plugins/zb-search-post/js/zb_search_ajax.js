'use strict';
jQuery(function () {
    const post_links = jQuery("#post_links");
    const from_date = jQuery("#from_date");
    const title = jQuery("#title");
    const number = jQuery("#number");

    jQuery('input').on('change', function () {
        post_links.empty();
        const ajax_data = {
            action: 'zb-get-post',
            title: title.val(),
            date: from_date.val(),
            number: number.val(),
        }

        $.post(zb_ajax.url, ajax_data, res => {
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
        post_links.empty();
        title.val('');
        from_date.val('');
    });
});
