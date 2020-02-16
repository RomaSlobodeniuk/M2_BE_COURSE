/**
 * @api
 */
define([
    'jquery',
    'mage/storage',
    'mage/url',
    'mage/template',
    'text!Roma_Test/template/customer-cars.html',
    'domReady!'
], function (
    $,
    storage,
    url,
    mageTemplate,
    customerCarsTemplate
) {
    'use strict';

    $.widget('roma.getCustomerCars', {
        options: {
            serviceUrl: 'rest/all/V1/test/cars/service/:userId',
            userId: 0,
            userName: 'User\'s',
            carsTemplate: customerCarsTemplate,
            container: '#cars-container',
        },

        _create: function () {
            var self = this;
            console.log('UserId: "' + this.options.userId + '"');
            console.log('AjaxUrl: "' + this.getAjaxUrl(this.options.serviceUrl, this.options.userId) + '"');
            $(this.element).on('click', function (event) {
                event.preventDefault();
                if (self.options.userId > 0) {
                    self.renderCustomerCars($(this));
                } else {
                    self.renderNoCarsAnswer();
                }
            });
        },

        renderCustomerCars: function(element) {
            var self = this;
            var userId = this.options.userId;
            var fullUrl = this.getAjaxUrl(this.options.serviceUrl, userId);
            var container = $(document).find(self.options.container);
            container.trigger('processStart');
            storage.get(
                fullUrl, false
            ).done(function (response) {
                console.log(response);
                var template = self.options.carsTemplate;
                var options = {
                    cars: response,
                    hrefMore: element.attr('href'),
                    userName: self.options.userName
                };
                var htmlToInsert = mageTemplate(template, options);
                container.hide();
                container.empty();
                container.html(htmlToInsert);
                container.animate({
                    opacity: 1,
                    width: "show"
                }, 250, function() {
                    container.show();
                });
                self.initClickOnCloseButton(container);
            }).fail(function (response) {
                console.log(response);
            }).always(function () {
                container.trigger('processStop');
            });
        },

        initClickOnCloseButton: function(container)
        {
            container.find('.close').off('click').on('click', function (event) {
                event.preventDefault();
                container.animate({
                    opacity: 0.25,
                    width: "hide"
                }, 500, function() {
                    container.hide();
                });
            });
        },

        renderNoCarsAnswer: function() {

        },

        getAjaxUrl: function (serviceUrl, userId) {
            var ajaxUrl = serviceUrl.replace(":userId", userId);
            url.setBaseUrl(BASE_URL);
            return url.build(ajaxUrl)
        }
    });

    return $.roma.getCustomerCars;
});
