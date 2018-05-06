Ext.define('MyApp.view.user.UserController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.user',
    requires:
        [
            'MyApp.global.Vars',
            'MyApp.view.uigwindow.UIGWindow',
        ],
    onGenerateClick: function (view, recIndex, cellIndex, item, e, record){
        var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var pass = "";
        var min = 8;
        var max = 9;
        var rand = min - 0.5 + Math.random() * (max - min + 1)
        length = Math.round(rand);
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        record.set('password',pass);
    },
    onClearFilters: function () {

            Ext.getCmp('userList').filters.clearFilters();
        },

    onShowFilters: function () {
        var data = [];

        // The actual record filters are placed on the Store.
        Ext.getCmp('userList').store.getFilters().each(function (filter) {
            data.push(filter.serialize());
        });

        // Pretty it up for presentation
        data = Ext.JSON.encodeValue(data, '\n').replace(/^[ ]+/gm, function (s) {
            for (var r = '', i = s.length; i--; ) {
                r += '&#160;';
            }
            return r;
        });
        data = data.replace(/\n/g, '<br>');

        Ext.Msg.alert('Filter Data', data);
    },
    onAddClick: function () {
        var view = Ext.getCmp('userList').getView(),
            rec = new MyApp.model.UserModel({
              id:'',
              userName:'User',
              password:'',
              firstName:'',
              lastName:'',
              dateOfBirth:Ext.Date.format(new Date(), "Y-m-d"),
            });

        view.store.insert(0, rec);
        //Ext.getCmp('userList').getStore().load();
        Ext.getCmp('userList').findPlugin('cellediting').startEdit(rec, 0);
    },
    onRemoveClick: function (view, recIndex, cellIndex, item, e, record) {
        record.drop();
    },
    onSaveClick: function () {
        Ext.getCmp('userList').getStore().sync(
            {
                success: function(response){
                    //get response
                    responseData = Ext.util.JSON.decode(response.operations[0]._response.responseText);
                    if (response.operations[0]._request._action=='create')
                    {
                        responseData.data.forEach(function(item, i, arr) {
                            var record = Ext.getCmp('userList').getStore().getById(item.clientId);
                            //update id for each inserted record
                            record.set('id',item.id);
                        });
                    }
                },

                failure: function(response) {
                }
            });
    },
    onUIGClick: function (view, recIndex, cellIndex, item, e, record){
        MyApp.global.Vars.currentRecord = record.get('id').toString();
        MyApp.global.Vars.currentUser = record.get('userName').toString();
        Ext.widget('form-tag').show();
    }
});
