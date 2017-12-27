;(function () {
    'use strict';
    window.Model = Model;

    function Model(name) {
        this.name = name;
        this.page = 1;
        this.list = [];
        this.row = {};
        this.number;
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

    //获取搜有数据的个数  以及求出页数
    Model.prototype.read_data_number = function () {
        var me = this;
        $.post('/api/' + this.name + '/read_number')
            .then(function (r) {
              me.number = Math.ceil(r.data/10);
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
    Model.prototype.add = function () {
        var me = this;
        return $.ajax({
            url: '/api/' + this.name + '/add',
            method: 'post',
            data: me.row,
            cache: false,
            contentType: false,
            processData: false
        })
            .then(function (r) {
                if (r.success) {
                    me.read();
                }
                // me.list = r.data;
                if (me.after_add)
                    me.after_add();

                return r;
            })
    };
    Model.prototype.update = function (data) {
        $.post('/api/' + this.name + '/change', data)
            .then(function (r) {
                console.log(r);
            })
    };
    Model.prototype.list_each = function (callback) {
        this.list.forEach(function (item, index) {
            callback(item, index);
        });
    }
})();