Ext.define('MyApp.view.uigwindow.UIGWindowController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.UIGWindow',
    requires:
        [
            'MyApp.global.Vars',
        ],
    onLoad: function(thiss,eOpts){
        thiss.title = 'Select a groups for user ' + MyApp.global.Vars.currentUser;
        Ext.Ajax.request({
            url: '/group/get',
            method: 'GET',
            timeout: 60000,
            params:
            {
                id: MyApp.global.Vars.currentRecord
            },
            headers:
            {
                'Content-Type': 'application/json'
            },
            success: function (response) {
                var jsonData = Ext.util.JSON.decode(response.responseText);
                var resultMessage = jsonData.data;
                Ext.getCmp('uig').setValue(jsonData);
            },
            failure: function (response) {
                Ext.Msg.alert('Status', 'Request Failed.');
            }
        });
    },
    onOkClick: function () {
        Ext.Ajax.request({
            url: '/group/set',
            method: 'GET',
            timeout: 60000,
            params:
            {
                id: MyApp.global.Vars.currentRecord,
                groups:new String(Ext.getCmp('uig').value),
            },
            headers:
            {
                'Content-Type': 'application/json'
            },
            success: function (response) {
                Ext.getCmp('form-tag').close();
            },
            failure: function (response) {
                Ext.Msg.alert('Status', 'Request Failed.');
            }
        });
    },
    onCancelClick: function(){
        Ext.getCmp('form-tag').close();
    }
});
