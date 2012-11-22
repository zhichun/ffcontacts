require.config({
    paths: {
        bootstrap: 'lib/bootstrap.min',
        underscore: 'lib/underscore'
    }
});
define('app', ['jquery', 'bootstrap', 'underscore'], function() {
    var phone_re = new RegExp(/^\+?\d+$/gi);

    $('input#first, input#last, input#phone').on('keyup', function() {
        var post_data = {},
            phone = $('input#phone').val();

        $('img.img-loading').show();

        if (phone) {
            if (!phone.match(phone_re)) {
                $('div.phone-number').addClass('error');
                $('img.img-loading').hide();
                return null;
            } else {
                $('div.phone-number').removeClass('error');
            }
        }

        post_data['first'] = $('input#first').val();
        post_data['last'] = $('input#last').val();
        post_data['phone'] = phone;
        console.log(post_data);

        $.ajax({url: 'search/', type: 'POST', data: post_data, dataType: 'json',
            success: function(response) {
                var user_list = '';
                setTimeout(function() {
                    $('img.img-loading').hide();
                    $('div.search-results').html('');
                    if (response.success && response.users.length >= 1) {
                        _.each(response.users, function(user) {
                            var el = _.template($('#user-tpl').html(), {user: user});
                            user_list += el;
                        });
                        $('div.search-results').html(user_list);
                    } else {
                        $('div.search-results').html("Nothing found");
                    }
                }, 600);
            }
        });
    });

    $('button.clear-results').on('click', function() {
        $('div.search-results').html('');
    });
});