;(function () {
    'use strict';
    HTMLFormElement.prototype.get_data = function () {
        var data = {};
        var input_list = this.querySelectorAll('[name]');
        input_list.forEach(function (input) {
            data[input.name] = input.value;
        });
        return data;
    };
})();