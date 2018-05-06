
Ext.define('MyApp.view.user.User',{
    extend: 'Ext.grid.Panel',
    xtype: 'user-user',
    requires: [
        'MyApp.view.user.UserController',
        'Ext.grid.filters.Filters',
        'Ext.selection.CellModel',
        'MyApp.store.UserStore',
        'MyApp.model.UserModel'
    ],
    id:'userList',
    controller: 'user',

    store: {
        type: 'userstore'
    },

    plugins: [
      'gridfilters',
      {
        ptype: 'cellediting',
        clicksToEdit: 1
    }],
    title: 'Users',

    tbar: [{
        text: 'Add User',
        handler: 'onAddClick'
    },{
        text: 'Save',
        handler: 'onSaveClick'
    }],
    selModel: {
        type: 'cellmodel'
    },
    columns: [
        { text: 'Id',  dataIndex: 'id' ,
        hidden:true
    },
         {
          text: 'userName',
          dataIndex: 'userName',
          flex: 1,
          editor: {
            allowBlank: false
          }
        },
       {
            xtype: 'actioncolumn',
            width: 30,
            sortable: false,
            menuDisabled: true,
            items: [{
                iconCls: 'fa-users',
                tooltip: 'Group',
                handler: 'onUIGClick'
            }]
        },
        {
          text: 'password',
          dataIndex: 'password',
          flex: 1,
          editor: {
            allowBlank: false
          }
        },

        {
            xtype: 'actioncolumn',
            width: 30,
            sortable: false,
            menuDisabled: true,
            items: [{
                iconCls: 'fa-magic',
                tooltip: 'Generate Password',
                handler: 'onGenerateClick'
            }]
        },
        {
          text: 'firstName',
          dataIndex: 'firstName',
          flex: 1,
          editor: {
            allowBlank: false
          }
        },
        {
          text: 'lastName',
          dataIndex: 'lastName',
          flex: 1,
          editor: {
            allowBlank: false
          }
        },
        {
          text: 'dateOfBirth', dataIndex: 'dateOfBirth', flex: 1 ,
          flex: 1,
            format: 'Y-m-d',
            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            editor: {
                xtype: 'datefield',
                name: 'date1',
                format: 'Y-m-d',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                allowBlank: false,
          }},
        {
          xtype: 'actioncolumn',
          width: 30,
          sortable: false,
          menuDisabled: true,
          items: [{
              iconCls: 'fa-minus-circle',
              tooltip: 'Delete Plant',
              handler: 'onRemoveClick'
          }]
      }
    ],
    bbar: {
        xtype: 'pagingtoolbar',
        displayInfo: true,
        displayMsg: 'Displaying topics {0} - {1} of {2}',
        emptyMsg: "No topics to display",
    }
});
