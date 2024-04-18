
(function () {
    'use strict';

    angular.module('iaSupport')
        .factory('CountriesUtils', function (Countries) {
            var china = Countries.findWhere({ 'iso': 'CN' });
            return {
                isChina: isChina
            };

            function isChina (country) {
                if (angular.isObject(country) && angular.isDefined(country.id)) {
                    return country.id === china.id;
                }

                return country === china.id;
            }
        });
})();