;(function () {
    'use strict';
    window.Model = Model;

    function Model(name) {
        this.name = name;
        this.page = 1;
        this.list = [];
    }

    Model.prototype.read = function () {
        var me = this;
        $.post('/api/' + this.name + '/read', {'page': this.page})
            .then(function (r) {
                me.list = r.data;
                if (me.after_read)
                    me.after_read();
            })
    };
    Model.prototype.remove = function (id) {
        if (!confirm("确定要删除吗?")) {
            return;
        }
        $.post('/api/' + this.name + '/remove', {id: id})
            .then(function (r) {
                console.log(r);
            })
    };
    Model.prototype.add = function (data) {
        var me = this;
        $.post('/api/' + this.name + '/add', data)
            .then(function (r) {
                me.reset_form();
                me.read();
            })
    };
    Model.prototype.update = function (data) {
        $.post('/api/' + this.name + '/change', data)
            .then(function (r) {
                console.log(r);
            })
    }
})();