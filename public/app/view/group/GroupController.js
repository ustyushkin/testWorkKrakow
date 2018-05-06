Ext.define('MyApp.view.group.GroupController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.group',
    requires:
        [
            'MyApp.global.Vars',
        ],
    onAddClick: function () {
        var view = Ext.getCmp('groupList').getView(),
            rec = new MyApp.model.GroupModel({
              id:'',
              groupName:'Group',
            });

        view.store.insert(0, rec);
        Ext.getCmp('groupList').findPlugin('cellediting').startEdit(rec, 0);
    },
    onRemoveClick: function (view, recIndex, cellIndex, item, e, record) {
        record.drop();
    },
    onSaveClick: function () {
        Ext.getCmp('groupList').getStore().sync({
            success: function(response){
                //get response
                responseData = Ext.util.JSON.decode(response.operations[0]._response.responseText);
                if (response.operations[0]._request._action=='create')
                {
                    responseData.data.forEach(function(item, i, arr) {
                        var record = Ext.getCmp('groupList').getStore().getById(item.clientId);
                        //update id for each inserted record
                        record.set('id',item.id);
                    });
                }
            },

            failure: function(response) {
            }
        });
    }
});
