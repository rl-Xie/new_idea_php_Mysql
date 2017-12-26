;(function () {
    'use strict';
    window.Ui = Ui;

    function Ui(name, form_selector, table_selector) {
        Model.call(this, name);
        this.el_form = document.querySelector(form_selector);
        this.el_table = document.querySelector(table_selector);
        this.form_tpl_maker = null;
        this.table_tpl_maker = null;
        //---------------------------------------------------------重置表单
        this.reset_form = function () {
            this.el_form.reset();
        };
        //---------------------------------------------------------渲染到页面
        this.after_read = function () {
            this.render();
        };
        this.render = function () {
            var me = this;
            me.el_table.innerHTML = '';
            me.list_each(function (item) {
                var el = document.createElement('tr');
                el.innerHTML = me.table_tpl_maker(item);
                me.el_table.appendChild(el);
                me.monitor_del(item);
                me.monitor_up(item);
            });
        };
        //---------------------------------------------------------删除
        this.monitor_del = function (item) {
            var me = this;
            var  del_i = document.querySelector('#del_button_'+item.id);
            del_i.addEventListener('click',function () {
                me.remove(item.id);
                me.read();
            })
        };
        //---------------------------------------------------------填充表单
        this.fill_form = function (data) {
             for(var temp in data){
                 var val = data[temp];
                 var input = document.querySelector('[name='+temp +']');
                 if(!input){
                     continue;
                 }
                 input.value = val;
             }
        };
        //---------------------------------------------------------更新
        this.monitor_up = function (item) {
              var me = this;
              // 选中更新按钮 添加点击事件
              var up_button = document.querySelector('#up_button_'+item.id);
              up_button.addEventListener('click',function () {
                  //填充表单
                  me.fill_form(item);
              })
        };
        //---------------------------------------------------------监听提交 增加事件
        this.monitor_event = function () {
            var me =this;
            this.el_form.addEventListener('submit', function (e) {
                e.preventDefault();
                me.row = me.el_form.get_data();
                me.add()
                    .then(function (r) {
                        if(r.success){
                            me.reset_form();
                        }
                    })
            })
        }
    }


    Ui.prototype = Object.create(Model.prototype);
    Ui.prototype.constructor = Ui;
})();