Ext.define('MyApp.store.UserStore', {
    extend: 'Ext.data.Store',

    alias: 'store.userstore',

    autoLoad: true,
    autoSync: false,
    //autoSync: true,
    editing: true,
    pageSize: 20,
    remoteSort: true,
    proxy: {
        type: 'ajax',
        enablePaging: true,
        api: {
            read: MyApp.global.Vars.primaryPartUrl + '/user/list',
            create: MyApp.global.Vars.primaryPartUrl + '/user/create',
            update: MyApp.global.Vars.primaryPartUrl + '/user/update',
            destroy: MyApp.global.Vars.primaryPartUrl + '/user/delete'
        },
        reader: {
            type: 'json',
            rootProperty: 'user',
            idProperty: 'id',
            totalProperty: 'totalCount',
            successProperty: 'success',
            messageProperty: 'message',
        },
        writer: {
            type: 'json',
            encode: true,
            root: 'data'
        },
    },
});
