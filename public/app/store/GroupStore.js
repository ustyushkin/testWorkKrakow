Ext.define('MyApp.store.GroupStore', {
    extend: 'Ext.data.Store',

    alias: 'store.groupstore',

    autoLoad: true,
    autoSync: false,
    editing: true,
    pageSize: 20,
    remoteSort: true,

    proxy: {
        type: 'ajax',
        enablePaging: true,
        api: {
            read: MyApp.global.Vars.primaryPartUrl + '/group/list',
            create: MyApp.global.Vars.primaryPartUrl + '/group/create',
            update: MyApp.global.Vars.primaryPartUrl + '/group/update',
            destroy: MyApp.global.Vars.primaryPartUrl + '/group/delete'
        },
        reader: {
            type: 'json',
            rootProperty: 'group',
            idProperty: 'id',
            totalProperty: 'totalCount',
            successProperty: 'success',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            encode: true,
            root: 'data'
        },
    },
});
