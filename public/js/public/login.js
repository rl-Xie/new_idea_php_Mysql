;(function () {
    'use strict';
    var el_form = document.querySelector('form');
    init();

    function init() {
        el_form.addEventListener('submit', function (e) {
            e.preventDefault();
            var row = el_form.get_data();
            return $.ajax({
                url: 'api/user/login',
                method: 'post',
                data: row,
                cache: false,
                contentType: false,
                processData: false
            })
                .then(function (r) {
                    if (r.success) {
                        el_form.reset();
                        location.href = '/';
                    }
                }, function () {
                    alert('不对');
                });
            // $.post('api/user/login', el_form.get_data())
            //     .then(function (r) {
            //         el_form.reset();
            //         location.href = '/';
            //     }, function () {
            //         alert('不对');
            //     })
        })
    }
})();