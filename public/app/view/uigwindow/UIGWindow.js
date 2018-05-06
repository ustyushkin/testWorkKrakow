Ext.define('MyApp.view.uigwindow.UIGWindow', {
   extend: 'Ext.window.Window',
   xtype: 'form-tag',
   id: 'form-tag',
   requires: [
       'MyApp.view.uigwindow.UIGWindowController',
       'MyApp.store.GroupStore',
       'MyApp.model.GroupModel',
       'MyApp.global.Vars',
   ],
   controller: 'UIGWindow',
   height: 300,
   width: 400,
   title: 'Select a groups for user ',
   scrollable: true,
   bodyPadding: 10,
   constrain: true,
   closable: false,
   currentRecord: '',
   items: [ {
       xtype: 'tagfield',
       id:'uig',
       fieldLabel: 'Groups',
       store: {
           type: 'groupstore'
       },
       value: ['CA'],
       displayField: 'groupName',
       valueField: 'id',
       filterPickList: true,
       queryMode: 'local',
   }],
   buttons: [{
       text: 'OK',
       handler: 'onOkClick'
   }, {
       text: 'Cancel' ,
       handler: 'onCancelClick'
   }],
   listeners:{
       beforeshow:'onLoad'
   }
});
