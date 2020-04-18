define([
    'uiComponent',
    'jquery',
    'ko',
    'underscore',
    'Magento_Ui/js/modal/alert',
    'uiRegistry',
    'mage/translate'
], function (Component, $, ko, _, alert, registry, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            myObservableCount: ko.observable(10)
        },

        /** @inheritdoc */
        initialize: function () {
            this._super();
            console.log('Initialized! Success!');
        },

        /** @inheritdoc */
        initObservable: function () {
            this._super().observe(
                'myObservableCount'
            );

            let self = this;
            this.myObservableCount.subscribe(function (value) {
                self.applyFilter(value);
            });

            return this;
        },

        applyFilter: function (value) {
            let list = $(document).find(this.listItemsSelector);
            list.hide();
            let count = 1;
            _.each(list, function (element) {
                console.log('count is: "' + count + '"');
                let text = $(element).find('.name').text();
                if (count > value) {
                    console.log('count is grater than new value -> skip showing element for user: "' + text + '"!');
                    return false;
                }
                console.log('count is lower than new value -> show element for user: "' + text + '"!');
                $(element).show();
                count++;
            }, this);
        }
    });
});