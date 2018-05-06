
Ext.define('MyApp.view.group.Group',{
    extend: 'Ext.grid.Panel',
    xtype: 'group-group',
    requires: [
        'MyApp.view.group.GroupController',
        'Ext.grid.filters.Filters',
        'Ext.selection.CellModel',
        'MyApp.store.GroupStore',
        'MyApp.model.GroupModel'
    ],
    id:'groupList',
    controller: 'group',

    store: {
        type: 'groupstore'
    },

    plugins: [
      'gridfilters',
      {
        ptype: 'cellediting',
        clicksToEdit: 1
    }],
    title: 'Groups',

    tbar: [{
        text: 'Add Group',
        handler: 'onAddClick'
    },{
        text: 'Save',
        handler: 'onSaveClick'
    }],
    selModel: {
        type: 'cellmodel'
    },
    columns: [
        { text: 'Id',  dataIndex: 'id' ,hidden:true},
         {
          text: 'groupName',
          dataIndex: 'groupName',
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
