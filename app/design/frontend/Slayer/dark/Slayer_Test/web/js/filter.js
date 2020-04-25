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
            // function "_super" is the same function as parent::_ in php
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
            // var parsedValue = parseInt(value);
            // var parsedValue = isNaN(parsedValue) ? 0 : parsedValue;
            list.hide();
            let count = 1;
            // console.log('new value is: "' + parsedValue + '"');
            console.log('new value is: "' + value + '"');
            _.each(list, function (element) {
                console.log('count is: "' + count + '"');
                let text = $(element).find('.name').text();
                // if (count > parsedValue) {
                if (count > value) {
                    console.log('count is grater than new value -> skip showing element for user: "' + text + '"!');
                    count++;
                    return false;
                }

                console.log('count is lower than new value -> show element for user: "' + text + '"!');
                $(element).show();
                count++;
            }, this);
        }
    });
});