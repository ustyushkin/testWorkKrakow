Ext.define('MyApp.model.UserModel', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'id', type: 'int'},
        {name: 'userName', type: 'string'},
        {name: 'password', type: 'string'},
        {name: 'firstName', type: 'string'},
        {name: 'lastName', type: 'string'},
        {name: 'dateOfBirth', type: 'date', dateFormat:"Y-m-d"},
    ]
});
