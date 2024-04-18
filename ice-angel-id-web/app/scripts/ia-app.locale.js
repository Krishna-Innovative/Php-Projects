(function () {
    'use strict';

    angular.module('iaApp')
        .value('localeConf', {
            basePath: 'languages',
            defaultLocale: 'en-US',
            sharedDictionary: 'common',
            fileExtension: '.lang.json',
            persistSelection: true,
            cookieName: 'COOKIE_LOCALE_LANG',
            observableAttrs: new RegExp('^data-(?!ng-|i18n)'),
            delimiter: '::'
        })

        .value('localeSupported', [
            'en-US',
            'zh-CN'
        ])

        .value('localeFallbacks', {
            'en': 'en-US',
            'zh': 'zh-CN'
        })

        .run(function ($rootScope, Store, BrowserLanguage, localeConf, locale, localeEvents, iaSettings) {
            var preferredLanguage = Store.get('preferredLanguage');

            if (preferredLanguage) {
                setDefaultLocale(preferredLanguage);
                return;
            }

            $rootScope.$on(localeEvents.localeChanges, function (event, data) {
                setDefaultLocale(data);
            });

            BrowserLanguage.prefersChinese()
                .then(function (prefersChinese) {
                    if (!prefersChinese) {
                        setDefaultLocale('en-US');
                        return;
                    }

                    setDefaultLocale('zh-CN');
                });

            function setDefaultLocale(lang) {
                localeConf.defaultLocale = lang;
                locale.setLocale();

                $rootScope.globals.language = lang;
                Store.put('preferredLanguage', lang);
                iaSettings.setLanguage(lang);
            }
        });

})();
