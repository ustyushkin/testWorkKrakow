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
            read: MyApp.global.Vars.primaryPartUrl + '/ingroup/list',
            create: MyApp.global.Vars.primaryPartUrl + '/ingroup/create',
            update: MyApp.global.Vars.primaryPartUrl + '/ingroup/update',
            destroy: MyApp.global.Vars.primaryPartUrl + '/ingroup/delete'
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
