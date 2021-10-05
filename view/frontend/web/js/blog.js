define(['uiComponent'], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'BlogModule_Blog/blog.html'
        },

        getDate: function (value) {
            const date = new Date(value);

            const formatter = new Intl.DateTimeFormat('en', {month: 'short'});
            const month = formatter.format(date);
            return month + ' ' + date.getDate() + ', ' + date.getFullYear();
        },

        initialize: function () {
            this._super();

            return this;
        }
    });
});
