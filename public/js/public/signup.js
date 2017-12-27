;(function () {
    'use strict';
    var el_form = document.querySelector('form');
    init();

    function init() {
        el_form.addEventListener('submit', function (e) {
            e.preventDefault();
            var row = el_form.get_data();
            $.ajax({
                url: 'api/user/signup',
                method: 'post',
                data: row,
                cache: false,
                contentType: false,
                processData: false
            })
                .then(function (r) {
                    if (r.success) {
                        el_form.reset();
                        location.href = 'login';
                    }
                }, function () {
                    alert('请重新输入');
                });
        })
    }
})();