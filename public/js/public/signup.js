;(function () {
    'use strict';
    var el_form = document.querySelector('form');
    init();

    function init() {
        el_form.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log(el_form.get_data());
            $.post('api/user/signup', el_form.get_data())
                .then(function (r) {
                    el_form.reset();
                    location.href = 'login';
                }, function () {
                    alert('你输入的不对');
                })
        })
    }
})();