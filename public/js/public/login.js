;(function () {
    'use strict';
    var el_form = document.querySelector('form');
    init();

    function init() {
        el_form.addEventListener('submit', function (e) {
            e.preventDefault();
            $.post('api/user/login', el_form.get_data())
                .then(function (r) {
                    el_form.reset();
                    location.href = '/';
                }, function () {
                    alert('不对');
                })
        })
    }
})();