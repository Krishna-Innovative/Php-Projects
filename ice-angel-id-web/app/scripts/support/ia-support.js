(function () {
    'use strict';

    angular.module('iaSupport', [])
    /***************************
     * Support Data Factories
     ****************************/
     .factory('iaCollection', [function () {

        var methods = ['filter', 'all', 'every', 'find', 'toArray', 'where', 'findWhere'];

        var Collection = function (items) {
            this.items = items;
        };

        _.each(methods, function (method) {
            Collection.prototype[method] = function () {
                var args = [].slice.call(arguments);
                args.unshift(this.items);
                return _[method].apply(_, args);
            };
        });

        return Collection;
    }])

     .factory('Genders', ['iaCollection', function (iaCollection) {
        var genders = [
        {id:1, name: 'Male', name_en: 'Male', name_zh: '男', name_pinyin: 'nan'},
        {id: 2, name: 'Female', name_en: 'Female', name_zh: '女', name_pinyin: 'nv'}
        ];

        return new iaCollection(genders);
    }])

    .factory('Covidresult', ['iaCollection', function (iaCollection) {
        var covidresult = [
        {id:1, name: 'Negative', name_en: 'Negative', name_zh: '阴性', name_pinyin: 'Negative', value:"negative"},
        {id:2, name: 'Positive', name_en: 'Positive', name_zh: '阳性', name_pinyin: 'Positive', value:"positive"}
        ];

        return new iaCollection(covidresult);
    }])

    .factory('vaccineDosagess', ['iaCollection', function (iaCollection) {
        var dosages = [
        {id:"1", name: 'First dose', name_en: 'First dose', name_zh: '第一针', name_pinyin: 'First dose'},
        {id:"2", name: 'Second dose', name_en: 'Second dose', name_zh: '第二针', name_pinyin: 'Second dose'},
        {id:"5", name: 'OTHER', name_en: 'OTHER', name_zh: '其他', name_pinyin: 'OTHER'}
        ];

        return new iaCollection(dosages);
    }])

    .factory('PTNFilter4MEM', ['iaCollection', function (iaCollection) {
        var ptnfilter = [
        { name: 'Name', name_en: 'Name', name_zh: '姓名', name_pinyin: 'Name',value:'last_name'},
        { name: 'iCE ID', name_en: 'iCE ID', name_zh: '天使救援™号码', name_pinyin: 'iCE ID',value:'ice_id'},
        { name: 'Email', name_en: 'Email', name_zh: '邮件', name_pinyin: 'Email',value:'email'},
        { name: 'Date of Birth', name_en: 'Date of Birth', name_zh: '出生日期', name_pinyin: 'Date of Birth',value:'getfulldob'},
        ];

        return new iaCollection(ptnfilter);
    }])


    .factory('CovidCategories', ['iaCollection', function (iaCollection) {
        var covidCategories = [
        {id:1, name: 'Antibody', name_en: 'Antibody', name_zh: '抗体检测', name_pinyin: 'kangtijiance', value:"antibody"},
        {id: 2, name: 'Antigen', name_en: 'Antigen', name_zh: '抗原检测', name_pinyin: 'kangyuanjiance',value:"antigen"},
        {id: 3, name: 'Nucleic acid', name_en: 'Nucleic acid', name_zh: '核酸检测', name_pinyin: 'hesuanjiance',  value:"nucleicacid"}
        ];

        return new iaCollection(covidCategories);
    }])


    .factory('Countriescn', ['iaCollection', function (iaCollection) {
        var cncountry = {
                "AF":"阿富汗",
"AL":"阿尔巴尼亚",
"DZ":"阿尔及利亚",
"AD":"安道尔",
"AO":"安哥拉",
"AI":"安圭拉",
"AG":"安提瓜和巴布达",
"AR":"阿根廷",
"AM":"亚美尼亚",
"AW":"阿鲁巴",
"AU":"澳大利亚",
"AT":"奥地利",
"AZ":"阿塞拜疆",
"BS":"巴哈马",
"BH":"巴林",
"BD":"孟加拉",
"BB":"巴巴多斯",
"BY":"白俄罗斯",
"BE":"比利时",
"BZ":"伯利兹",
"BJ":"贝宁",
"BM":"百慕大",
"BT":"不丹",
"BO":"玻利维亚",
"BA":"波黑",
"BW":"博茨瓦纳",
"BR":"巴西",
"BN":"文莱",
"BG":"保加利亚",
"BF":"布基纳法索",
"BI":"布隆迪",
"KH":"柬埔寨",
"CM":"喀麦隆",
"CA":"加拿大",
"CV":"佛得角",
"BQ":"荷兰加勒比区",
"KY":"开曼群岛",
"CF":"中非",
"TD":"乍得",
"CL":"智利",
"CN":"中国",
"CO":"哥伦比亚",
"KM":"科摩罗",
"CG":"刚果(布）",
"CD":"刚果(金）",
"CR":"哥斯达黎加",
"CI":"科特迪瓦",
"HR":"克罗地亚",
"CU":"古巴",
"CW":"库拉索",
"CY":"塞浦路斯",
"CZ":"捷克",
"DK":"丹麦",
"DJ":"吉布提",
"DM":"多米尼克",
"DO":"多米尼加",
"EC":"厄瓜多尔",
"EG":"埃及",
"SV":"萨尔瓦多",
"GQ":"赤道几内亚",
"ER":"厄立特里亚",
"EE":"爱沙尼亚",
"ET":"埃塞俄比亚",
"FK":"马尔维纳斯群岛（ 福克兰）",
"FO":"法罗群岛",
"FJ":"斐济群岛",
"FI":"芬兰",
"FR":"法国",
"GF":"法属圭亚那",
"PF":"法属波利尼西亚",
"GA":"加蓬",
"GM":"冈比亚",
"GE":"格鲁吉亚",
"DE":"德国",
"GH":"加纳",
"GI":"直布罗陀",
"GR":"希腊",
"GL":"格陵兰",
"GD":"格林纳达",
"GP":"瓜德罗普",
"GT":"危地马拉",
"GN":"几内亚",
"GW":"几内亚比绍",
"GY":"圭亚那",
"HT":"海地",
"HN":"洪都拉斯",
"HK":"香港",
"HU":"匈牙利",
"IS":"冰岛",
"IN":"印度",
"ID":"印尼",
"IR":"伊朗",
"IQ":"伊拉克",
"IE":"爱尔兰",
"IM":"马恩岛",
"IL":"以色列",
"IT":"意大利",
"JM":"牙买加",
"JP":"日本",
"JO":"约旦",
"KZ":"哈萨克斯坦",
"KE":"肯尼亚",
"KR":"韩国 南朝鲜",
"KW":"科威特",
"KG":"吉尔吉斯斯坦",
"LA":"老挝",
"LV":"拉脱维亚",
"LB":"黎巴嫩",
"LS":"莱索托",
"LR":"利比里亚",
"LY":"利比亚",
"LI":"列支敦士登",
"LT":"立陶宛",
"LU":"卢森堡",
"MO":"澳门",
"MK":"马其顿",
"MG":"马达加斯加",
"MW":"马拉维",
"MY":"马来西亚",
"MV":"马尔代夫",
"ML":"马里",
"MT":"马其他",
"MQ":"马提尼克",
"MR":"毛里塔尼亚",
"MU":"毛里求斯",
"YT":"马约特",
"MX":"墨西哥",
"MD":"摩尔多瓦",
"MC":"摩纳哥",
"MN":"蒙古国 蒙古",
"ME":"黑山",
"MS":"蒙塞拉特岛",
"MA":"摩洛哥",
"MZ":"莫桑比克",
"MM":"缅甸",
"NA":"纳米比亚",
"NP":"尼泊尔",
"NL":"荷兰",
"NC":"新喀里多尼亚",
"NZ":"新西兰",
"NI":"尼加拉瓜",
"NE":"尼日尔",
"NG":"尼日利亚",
"NO":"挪威",
"OM":"阿曼",
"PK":"巴基斯坦",
"PS":"巴基斯坦",
"PA":"巴拿马",
"PG":"巴布亚新几内亚",
"PY":"巴拉圭",
"PE":"秘鲁",
"PH":"菲律宾",
"PL":"波兰",
"PT":"葡萄牙",
"QA":"卡塔尔",
"RE":"留尼汪",
"RO":"罗马尼亚",
"RU":"俄罗斯",
"RW":"卢旺达",
"KN":"圣基茨和尼维斯",
"LC":"圣卢西亚",
"MF":"法属圣马丁",
"PM":"圣皮埃尔和密克隆",
"VC":"圣文森特和格林纳丁斯",
"SM":"圣马力诺",
"ST":"圣多美和普林西比",
"SA":"沙特阿拉伯",
"SN":"塞内加尔",
"RS":"塞尔维亚",
"SC":"塞舌尔",
"SL":"塞拉利昂",
"SG":"新加坡",
"SX":"荷属圣马丁",
"SK":"斯洛伐克",
"SI":"斯洛文尼亚",
"SB":"所罗门群岛",
"SO":"索马里",
"ZA":"南非",
"SS":"南苏丹",
"ES":"西班牙",
"LK":"斯里兰卡",
"BL":"圣巴泰勒米岛",
"SD":"苏丹",
"SR":"苏里南",
"SZ":"斯威士兰",
"SE":"瑞典",
"CH":"瑞士",
"SY":"叙利亚",
"TW":"台湾",
"TJ":"塔吉克斯坦",
"TZ":"坦桑尼亚",
"TH":"泰国",
"TL":"东帝汶",
"TG":"多哥",
"TT":"特立尼达和多巴哥",
"TN":"突尼斯",
"TR":"土耳其",
"TC":"特克斯和凯科斯群岛",
"UG":"乌干达",
"UA":"乌克兰",
"AE":"阿联酋",
"GB":"英国",
"US":"美国",
"UY":"乌拉圭",
"UZ":"乌兹别克斯坦",
"VA":"梵蒂冈",
"VE":"委内瑞拉",
"VN":"越南",
"VG":"英属维尔京群岛",
"WF":"瓦利斯和富图纳",
"EH":"西撒哈拉",
"YE":"也门",
"ZM":"赞比亚",
"ZW":"津巴布韦",
"AQ":"南极洲",
"KI":"基里巴斯",
"KP":"朝鲜 北朝鲜",
"MH":"马绍尔群岛",
"FM":"密克罗尼西亚联邦",
"NR":"瑙鲁",
"NU":"纽埃",
"PW":"帕劳",
"WS":"萨摩亚",
"SJ":"斯瓦尔巴群岛和 扬马延岛",
"TO":"汤加",
"TM":"土库曼斯坦",
"TV":"图瓦卢",
"VU":"瓦努阿图",
"AX":"奥兰群岛",
"AS":"美属萨摩亚",
"BV":"布韦岛",
"IO":"英属印度洋地区",
"CX":"圣诞岛",
"CC":"科科斯群岛",
"CK":"库克群岛",
"TF":"法属南部领地",
"GU":"关岛",
"GG":"根西岛",
"HM":"赫德岛和麦克唐纳群岛",
"JE":"泽西岛",
"NF":"诺福克岛",
"MP":"北马里亚纳群岛",
"PN":"皮特凯恩群岛",
"PR":"波多黎各",
"SH":"圣赫勒拿",
"GS":"南乔治亚岛和南桑威奇群岛",
"TK":"托克劳",
"UM":"美国本土外小岛屿",
"VI":"美属维尔京群岛",

            };

        return new iaCollection(cncountry);
    }])

     .factory('SupportLanguages', ['iaCollection', function(iaCollection) {
        var supportLanguages = [
        {id:1, name_en: 'English', name_zh: 'English', name_pinyin: 'yingwen', value: 'en'},
        {id: 2, name_en: '中文', name_zh: '中文', name_pinyin: 'zhongwen', value: 'zh'}
        ];

        return new iaCollection(supportLanguages);
    }])

     .factory('LocationTrack', ['iaCollection', function (iaCollection) {

        var location_tracks = [
        {name: 'On', name_en: 'On', name_zh: '打开', value: 1},
        {name: 'Off', name_en: 'Off', name_zh: '关闭', value: 0}
        ];

        return new iaCollection(location_tracks);
    }])

     .factory('EmergencyChannel', ['iaCollection', function (iaCollection) {

        var channels = [
        {id: 1, name_en: 'Email', name_zh: '邮件箱', type: 'email'},
        {id: 3, name_en: 'Twitter notification', name_zh: 'Twitter推送', type: 'twitter'}
        ];

        return new iaCollection(channels);
    }])

     .factory('EmailAddresses', function () {

        return [
        {pattern: 'gmail.com', url: 'http://www.gmail.com', domain: 'www.gmail.com'},
        {pattern: '126.com', url: 'http://mail.126.com', domain: 'mail.126.com'},
        {pattern: '163.com',    url: 'mail.163.com', domain: 'mail.163.com' },
        {pattern: 'aol.com', url: 'http://www.aol.com', domain: 'www.aol.com'},
        {pattern: 'hotmail.com', url: 'http://www.hotmail.com', domain: 'www.hotmail.com'},
        {pattern: 'mail.com', url: 'http://www.mail.com', domain: 'www.mail.com'},
        {pattern: 'msn.com', url: 'http://www.msn.com', domain: 'www.msn.com'},
        {pattern: 'outlook.com', url: 'http://www.outlook.com', domain: 'www.outlook.com'},
        {pattern: 'qq.com', url: 'http://mail.qq.com', domain: 'mail.qq.com'},
        {pattern: 'sina.com', url: 'http://mail.sina.com.cn', domain: 'mail.sina.com.cn'},
        {pattern: 'sohu.com', url: 'http://mail.sohu.com', domain: 'mail.sohu.com'},
        {pattern: 'yahoo.com', url: 'http://www.yahoo.com', domain: 'www.yahoo.com'},
        {pattern: 'bigpond.com',    url: 'http://webmail.bigpond.com/webedge/do/oldlogin', domain: 'www.webmail.bigpond.com' },
        {pattern: 'bigpond.com.au', url: 'http://webmail.bigpond.com/webedge/do/oldlogin', domain: 'www.webmail.bigpond.com' },
        {pattern: 'bigpond.net.au', url: 'http://webmail.bigpond.com/webedge/do/oldlogin', domain: 'www.webmail.bigpond.com' },
        {pattern: 'gmx.com',    url: 'http://gmx.com', domain: 'www.gmx.com' },
        {pattern: 'gmx.com',    url: 'http://gmx.com', domain: 'www.gmx.com' },
        {pattern: 'gmx.de', url: 'http://gmx.de', domain: 'www.gmx.de' },
        {pattern: 'gmx.fr', url: 'http://gmx.fr', domain: 'www.gmx.fr' },
        {pattern: 'gmx.net',    url: 'http://gmx.net', domain: 'www.gmx.net' },
        {pattern: 'gmx.net',    url: 'http://gmx.net', domain: 'www.gmx.net' },
        {pattern: 'googlemail.com', url: 'http://googlemail.com', domain: 'www.googlemail.com' },
        {pattern: 'hotmail.be', url: 'http://hotmail.be', domain: 'www.hotmail.be' },
        {pattern: 'hotmail.co.il',  url: 'http://hotmail.co.il', domain: 'www.hotmail.co.il' },
        {pattern: 'hotmail.co.uk',  url: 'http://hotmail.co.uk', domain: 'www.hotmail.co.uk' },
        {pattern: 'hotmail.com',    url: 'http://hotmail.com', domain: 'www.hotmail.com' },
        {pattern: 'hotmail.com.ar', url: 'http://hotmail.com.ar', domain: 'www.hotmail.com.ar' },
        {pattern: 'hotmail.com.mx', url: 'http://hotmail.com.mx', domain: 'www.hotmail.com.mx' },
        {pattern: 'hotmail.de', url: 'http://hotmail.de', domain: 'www.hotmail.de' },
        {pattern: 'hotmail.es', url: 'http://hotmail.es', domain: 'www.hotmail.es' },
        {pattern: 'hotmail.fr', url: 'http://hotmail.fr', domain: 'www.hotmail.fr' },
        {pattern: 'hotmail.kz', url: 'http://hotmail.kz', domain: 'www.hotmail.kz' },
        {pattern: 'hotmail.ru', url: 'http://hotmail.ru', domain: 'www.hotmail.ru' },
        {pattern: 'hushmail.com',   url: 'http://hushmail.com', domain: 'www.hushmail.com' },
        {pattern: 'live.be',    url: 'http://live.be', domain: 'www.live.be' },
        {pattern: 'live.co.uk', url: 'http://live.co.uk', domain: 'www.live.co.uk' },
        {pattern: 'live.com',   url: 'http://live.com', domain: 'www.live.com' },
        {pattern: 'live.com.ar',    url: 'http://live.com.ar', domain: 'www.live.com.ar' },
        {pattern: 'live.com.mx',    url: 'http://live.com.mx', domain: 'www.live.com.mx' },
        {pattern: 'live.de',    url: 'http://live.de', domain: 'www.live.de' },
        {pattern: 'live.fr',    url: 'http://live.fr', domain: 'www.live.fr' },
        {pattern: 'lycos.co.uk',    url: 'http://mail.lycos.co.uk', domain: 'www.mail.lycos.co.uk' },
        {pattern: 'lycos.com',  url: 'http://mail.lycos.com', domain: 'www.mail.lycos.com' },
        {pattern: 'lycos.es',   url: 'http://mail.lycos.com', domain: 'www.mail.lycos.com' },
        {pattern: 'lycos.it',   url: 'http://mail.lycos.com', domain: 'www.mail.lycos.com' },
        {pattern: 'lycosemail.com', url: 'http://mail.lycos.com', domain: 'www.mail.lycos.com' },
        {pattern: 'lycosmail.com',  url: 'http://mail.lycos.com', domain: 'www.mail.lycos.com' },
        {pattern: 'rocketmail.com', url: 'http://rocketmail.com', domain: 'www.rocketmail.com' },
        {pattern: 'yahoo.ca',   url: 'http://mail.yahoo.ca', domain: 'www.mail.yahoo.ca' },
        {pattern: 'yahoo.co.id',    url: 'http://mail.yahoo.co.id', domain: 'www.mail.yahoo.co.id' },
        {pattern: 'yahoo.co.in',    url: 'http://mail.yahoo.co.in', domain: 'www.mail.yahoo.co.in' },
        {pattern: 'yahoo.co.jp',    url: 'http://mail.yahoo.co.jp', domain: 'www.mail.yahoo.co.jp' },
        {pattern: 'yahoo.co.kr',    url: 'http://mail.yahoo.co.kr', domain: 'www.mail.yahoo.co.kr' },
        {pattern: 'yahoo.co.nz',    url: 'http://mail.yahoo.co.nz', domain: 'www.mail.yahoo.co.nz' },
        {pattern: 'yahoo.co.uk',    url: 'http://mail.yahoo.co.uk', domain: 'www.mail.yahoo.co.uk' },
        {pattern: 'yahoo.com',  url: 'http://mail.yahoo.com', domain: 'www.mail.yahoo.com' },
        {pattern: 'yahoo.com.ar',   url: 'http://mail.yahoo.com.ar', domain: 'www.mail.yahoo.com.ar' },
        {pattern: 'yahoo.com.au',   url: 'http://mail.yahoo.com.au', domain: 'www.mail.yahoo.com.au' },
        {pattern: 'yahoo.com.br',   url: 'http://mail.yahoo.com.br', domain: 'www.mail.yahoo.com.br' },
        {pattern: 'yahoo.com.cn',   url: 'http://mail.yahoo.com.cn', domain: 'www.mail.yahoo.com.cn' },
        {pattern: 'yahoo.com.hk',   url: 'http://mail.yahoo.com.hk', domain: 'www.mail.yahoo.com.hk' },
        {pattern: 'yahoo.com.is',   url: 'http://mail.yahoo.com.is', domain: 'www.mail.yahoo.com.is' },
        {pattern: 'yahoo.com.mx',   url: 'http://mail.yahoo.com.mx', domain: 'www.mail.yahoo.com.mx' },
        {pattern: 'yahoo.com.ph',   url: 'http://mail.yahoo.com.ph', domain: 'www.mail.yahoo.com.ph' },
        {pattern: 'yahoo.com.ru',   url: 'http://mail.yahoo.com.ru', domain: 'www.mail.yahoo.com.ru' },
        {pattern: 'yahoo.com.sg',   url: 'http://mail.yahoo.com.sg', domain: 'www.mail.yahoo.com.sg' },
        {pattern: 'yahoo.de',   url: 'http://mail.yahoo.de', domain: 'www.mail.yahoo.de' },
        {pattern: 'yahoo.dk',   url: 'http://mail.yahoo.dk', domain: 'www.mail.yahoo.dk' },
        {pattern: 'yahoo.es',   url: 'http://mail.yahoo.es', domain: 'www.mail.yahoo.es' },
        {pattern: 'yahoo.fr',   url: 'http://mail.yahoo.fr', domain: 'www.mail.yahoo.fr' },
        {pattern: 'yahoo.ie',   url: 'http://mail.yahoo.ie', domain: 'www.mail.yahoo.ie' },
        {pattern: 'yahoo.it',   url: 'http://mail.yahoo.it', domain: 'www.mail.yahoo.it' },
        {pattern: 'yahoo.jp',   url: 'http://mail.yahoo.jp', domain: 'www.mail.yahoo.jp' },
        {pattern: 'yahoo.ru',   url: 'http://mail.yahoo.ru', domain: 'www.mail.yahoo.ru' },
        {pattern: 'yahoo.se',   url: 'http://mail.yahoo.se', domain: 'www.mail.yahoo.se' },
        {pattern: 'yandex.com', url: 'http://mail.yandex.com', domain: 'www.mail.yandex.com' },
        {pattern: 'yandex.ru',  url: 'http://mail.yandex.ru', domain: 'www.mail.yandex.ru' },
        {pattern: 'ymail.com',  url: 'http://mail.ymail.com', domain: 'www.mail.ymail.com' },
        {pattern: 'zoho.com',   url: 'http://mail.zoho.com', domain: 'www.mail.zoho.com' },
        ];
    })

.factory('InsuranceType', ['iaCollection', function (iaCollection) {

    var insurance_types = [
    {id: 1, name_en: 'Medical', name_zh: '医疗', name_pinyin: 'yiliao', value: 'medical'},
    {id: 2, name_en: 'Travel', name_zh: '旅游', name_pinyin: 'lvyou', value: 'travel'},
    {id: 3, name_en: 'Other', name_zh: '其他', name_pinyin: 'qita', value: 'other'}
    ];

    return new iaCollection(insurance_types);
}])

.factory('SecurityQuestions', ['iaCollection', function (iaCollection) {
    var questions = [
    {
        id: 1,
        title_en: 'What is your mother\'s maiden name?',
        title_zh: '您母亲的姓名是什么？',
        title_pinyin: 'Nín mǔqīn de xìngmíng shì shénme?'
    },
    {
        id: 2,
        title_en: 'Which town / city were you born in?',
        title_zh: '您的出生城市在哪里？',
        title_pinyin: 'Nín de chūshēng chéngshì zài nǎlǐ?'
    },
    {
        id: 3,
        title_en: 'What is the name of your first pet?',
        title_zh: '您的第一个宠物叫什么？',
        title_pinyin: 'Nín de dì yī gè chǒngwù jiào shénme?'
    },
    {
        id: 4,
        title_en: 'Who was your first kiss?',
        title_zh: '您的初吻给了谁？',
        title_pinyin: 'Nín de chūwěn gěile shuí?'
    },
    {
        id: 5,
        title_en: 'What is the name of your first school?',
        title_zh: '您的小学名是什么？',
        title_pinyin: 'Nín de xiǎoxué míng shì shénme?'
    },
    {
        id: 6,
        title_en: 'What is your favorite color?',
        title_zh: '您喜欢的颜色是什么？',
        title_pinyin: 'Nín xǐhuān de yánsè shì shénme?'
    }
    ];

    return new iaCollection(questions);
}])

.factory('iaAddress', function ($window) {
    var cjkRegex = $window.regenerate()
                .addRange(0x4E00, 0x9FFF) // CJK Common.
                .addRange(0x3400, 0x4DFF) // CJK Rare.
                .addRange(0x20000, 0x2A6DF) // CJK Historic.
                .addRange(0xF900, 0xFAFF) // CJK Compatibility.
                .addRange(0x2F800, 0x2FA1F) // CJK Compatibility supplement.
                .toRegExp();

                return {
                    personalAddress: personalAddress
                };

                function personalAddress(building, street, district, city, state, postal, country) {
                    var fullAddress = [building, street, district, city, state, postal, country].join('');
                    return containsCjk(fullAddress) ?
                    buildChineseAddress(building, street, district, city, state, postal, country) :
                    buildEnglishAddress(building, street, district, city, state, postal, country);
                }
                function buildEnglishAddress(building, street, district, city, state, postal, country) {
                    var address = building+' '+street+' '+district+' '+city+' '+state+' '+postal+' '+country;
                    return address;
                }
                function buildChineseAddress(building, street, district, city, state, postal, country) {
                    var address = country+' '+state+' '+city+' '+district+' '+street+' '+building+' '+postal;
                    return address;
                }
                function containsCjk (string) {
                    return cjkRegex.test(string);
                }
            })

        /***************************
         * Support filters
         ****************************/
         .filter('unique', function () {
            return function (input, key) {
                var unique = {};
                var uniqueList = [];
                for (var i = 0; i < input.length; i++) {
                    if (typeof unique[input[i][key]] === 'undefined') {
                        unique[input[i][key]] = '';
                        uniqueList.push(input[i]);
                    }
                }
                return uniqueList;
            };
        })

         .filter('uniquey', function () {

          return function (items, filterOn) {

            if (filterOn === false) {
              return items;
          }

          if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {
              var newItems = [];

              var extractValueToCompare = function (item) {
                if (angular.isObject(item) && angular.isString(filterOn)) {
                  return item[filterOn];
              } else {
                  return item;
              }
          };

          angular.forEach(items, function (item) {
            var isDuplicate = false;

            for (var i = 0; i < newItems.length; i++) {
              if (angular.equals(extractValueToCompare(newItems[i]), extractValueToCompare(item))) {
                isDuplicate = true;
                break;
            }
        }
        if (!isDuplicate) {
          newItems.push(item);
      }

  });
          items = newItems;
      }
      return items;
  };
})

         .filter('CovidCatFilter', ['$rootScope', 'iaSettings', function ($rootScope, iaSettings) {
            return function (input, key) {
                if (input) {
                    var filter = {value: input};
                    var covidcats = $rootScope.globals.settings.covidCategories || [];

                    if (covidcats.find(filter)) {
                        return angular.isUndefined(covidcats.find(filter)[key + '_' + iaSettings.getLanguage()]) ? covidcats.find(filter)[key + '_' + iaSettings.getLanguage()] : covidcats.find(filter)[key + '_' + iaSettings.getLanguage()];
                    }
                }
            };
        }])

        .filter('VaccineSeries', ['$rootScope', 'iaSettings', function ($rootScope, iaSettings) {
            return function (input, key) {
                if (input) {
                    var filter = {id: input};
                    var vs = $rootScope.globals.settings.vaccineDosagess || [];

                    if (vs.find(filter)) {
                        return angular.isUndefined(vs.find(filter)[key + '_' + iaSettings.getLanguage()]) ? covidcats.find(filter)[key + '_' + iaSettings.getLanguage()] : vs.find(filter)[key + '_' + iaSettings.getLanguage()];
                    }
                }
            };
        }])

        .filter('CovidResultFilter', ['$rootScope', 'iaSettings', function ($rootScope, iaSettings) {
            return function (input, key) {
                if (input) {
                    var filter = {value: input};
                    var covidresult = $rootScope.globals.settings.covidresult || [];

                    if (covidresult.find(filter)) {
                        return angular.isUndefined(covidresult.find(filter)[key + '_' + iaSettings.getLanguage()]) ? covidresult.find(filter)[key + '_' + iaSettings.getLanguage()] : covidresult.find(filter)[key + '_' + iaSettings.getLanguage()];
                    }
                }
            };
        }])

        .filter('countryFilter', ['$rootScope', 'iaSettings', function ($rootScope, iaSettings) {
            return function (input, key) {
                if (input) {
                    var filter = {id: input};
                    var countries = $rootScope.globals.settings.countries || [];

                    if (countries.find(filter)) {
                        return angular.isUndefined(countries.find(filter)[key]) ? countries.find(filter)[key + '_' + iaSettings.getLanguage()] : countries.find(filter)[key];
                    }
                }
            };
        }])

         .filter('languageFilter', ['$rootScope', 'iaSettings', function ($rootScope, iaSettings) {
            return function (input, key) {
                if (input) {
                    var filter = {value: input};
                    var languages = $rootScope.globals.settings.support_languages || [];

                    if (languages.find(filter)) {
                        return languages.find(filter)['name_' + iaSettings.getLanguage()];
                    }
                }
            };
        }])

         .filter('settingsFilter', ['$rootScope', 'iaSettings', function($rootScope, iaSettings) {
            return function(input, key, field) {
                if (input) {
                    var result;
                    var settings = $rootScope.globals.settings;
                    var filter = {id: input};

                    if (_.isArray(key)) {
                        angular.forEach(key, function(k, i) {
                            if (angular.isUndefined(settings[k])) {
                                return;
                            }

                            settings = settings[k];
                        });
                        result = settings;
                    } else {
                        result = settings[key];
                    }

                    if (result.find(filter)) {
                        return angular.isDefined(result.find(filter)[field + '_' + iaSettings.getLanguage()]) ? result.find(filter)[field + '_' + iaSettings.getLanguage()] : result.find(filter)[field];
                    }
                }
            };
        }])

         .filter('optionsTrans', ['$rootScope', 'iaSettings', function ($rootScope, iaSettings) {
            return function (input, keys) {
                if (!_.isArray(input) || input.length <= 0) {
                    return;
                }

                if (!_.isArray(keys)) {
                    keys = [keys];
                }

                var language = iaSettings.getLanguage();
                var options = [];

                _.each(keys, function (key) {
                    var languageKey = key + '_' + language;
                    if (!_.first(input).hasOwnProperty(languageKey)) {
                        return;
                    }

                    _.each(input, function (option, index) {
                        option[key] = option[languageKey];
                        options[index] = option;
                    });
                });

                return options;
            };
        }])

         .filter('optionsSort', ['$rootScope', 'iaSettings', function ($rootScope, iaSettings) {
            return function (input, key) {
                var sortBy = key + '_' + (iaSettings.getLanguage() === 'en' ? 'en' : 'pinyin');
                var others = [];

                var resultArray = _.reject(input, function (item) {
                    if (/^other(.+)?$/i.test(item[key + '_en'])) {
                        others.push(item);
                        return true;
                    }
                });

                resultArray = _.sortBy(resultArray, sortBy);

                return _.union(resultArray, others);
            };
        }])

        /***************************
         * Support directives
         ****************************/

         .directive('ngMatch', ['$parse', function ($parse) {
            return {
                require: '^ngModel',
                restrict: 'A',
                link: function (scope, elem, attrs, ctrl) {

                    attrs.$observe('ngMatch', function(newVal) {
                        var result = newVal === ctrl.$viewValue;
                        ctrl.$setValidity('match', result);
                    });

                    var validator = function (value) {
                        if (value) {
                            var match = attrs.ngMatch,
                            result = (value === match);
                            ctrl.$setValidity('match', result);
                            return value;
                        } else {
                            ctrl.$setValidity('match', true);
                            return value;
                        }
                    };

                    ctrl.$parsers.unshift(validator);
                    ctrl.$formatters.push(validator);
                }
            };
        }])

        .directive('iceid', ['$filter', function ($filter) {
            return {
                require: 'ngModel',
                link: function (scope, elm, attrs, ctrl) {
                    var INTEGER_REGEXP = /^\-?\d+$/;
                    var value;

                    ctrl.$validators.iceid = function (modelValue, viewValue) {

                        if (ctrl.$isEmpty(modelValue)) {

                            return true;
                        }
                        if(viewValue.length){
                            var i=0;
                            var character='';
                            while(i <= viewValue.length){
                                character = viewValue.charAt(i);
                                if (isNaN(character * 1)){
                                    if(i==0){
                                        modelValue = modelValue.replace(/[^\d]/g, '').replace(/(.{3})/g, '$1 ').trim();
                                        viewValue = viewValue.replace(/[^\d]/g, '').replace(/(.{3})/g, '$1 ').trim();
                                        scope.alert.ice_id = ''.trim();
                                    }
                                    else{
                                        modelValue = modelValue.replace(/[^\d]/g, '').replace(/(.{3})/g, '$1 ').trim();
                                        viewValue = viewValue.replace(/[^\d]/g, '').replace(/(.{3})/g, '$1 ').trim();
                                        scope.alert.ice_id = scope.alert.ice_id.replace(/[^\d]/g, '').replace(/(.{3})/g, '$1 ').trim();;
                                    }
                                  //scope.alert.ice_id = '';
                                    break;
                                }
                                i++;
                            }
                        }

                        value = $filter('iceFormat')(modelValue);
                        document.getElementById('ice_id').addEventListener('input', function (e) {
                          e.target.value = e.target.value.replace(/[^\d]/g, '').replace(/(.{3})/g, '$1 ').trim();
                      });

                        return !!(INTEGER_REGEXP.test(value) && value.length === 12);
                    };
                }
            };
        }])


        .directive('emptyField', function($timeout) {
            return {
                restrict: 'A',
                link: function(scope, $elm, $attrs) {
                    scope.removeError= function (){
                        //alert('dd');
                        scope.error='';
                    }

                    scope.removeError1= function (){
                    //alert('dd');
                     angular.element(document).find(".incorrectPass").addClass("hide");
                    angular.element(document).find(".has-error").removeClass("has-error");
                    }


                }
            };
        })



 .directive('syncDevices', ['$modal', '$state','Restangular','$rootScope', function ($modal, $state,Restangular,$rootScope) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            function cancel(){
                               modalInstance.dismiss('cancel');
                               var body = angular.element(document).find('body').eq(0);
                               if (body[0].className === 'modal-open') {

                                var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                body.removeClass('modal-open');
                                layer.remove();
                                modalLayer.remove();
                            }
                        }

                        $scope.cancel = function () {
                         cancel();
                     };

                   
              }]
          };

          /*elem.on('click', function ($scope) {
            if(opts.scope.member.devices.length>0)
                modalInstance = $modal.open(opts);
        }); */
      }
  };
}])


 .directive('syncDevicesPopup', ['$modal', '$state','Restangular','$rootScope', function ($modal, $state,Restangular,$rootScope) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            function cancel(){
                               modalInstance.dismiss('cancel');
                               var body = angular.element(document).find('body').eq(0);
                               if (body[0].className === 'modal-open') {

                                var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                body.removeClass('modal-open');
                                layer.remove();
                                modalLayer.remove();
                            }
                        }

                        $scope.cancel = function () {
                         cancel();
                     };

                   
              }]
          };

          elem.on('click', function ($scope) {
            if(opts.scope.member.devices.length>0)
                modalInstance = $modal.open(opts);
        });
      }
  };
}])


         .filter('iceFormat', function() {
            return function(input, key) {
                return input ?
                input.trim().replace(/ +/g, '', true) :
                input;
            };
        })

         .directive('iaContacts', ['Account', 'PersonName', 'locale', function (Account, PersonName, locale) {
            return {
                restrict: 'EA',
                replace: true,
                scope: {
                    member: '=',
                    target: '@'
                },
                link: function (scope, elem, attrs) {
                    var token = 'common.dontHaveEmergencyContactsList';
                    scope.haveContacts = false;


                    Account.getAllContacts().then(function (res) {
                        var contact_list = [];
                        scope.contact_list = [];
                        scope.contact_list_filtered = [];

                        switch(scope.target) {
                            case 'guardians':
                            if (angular.isUndefined(scope.$parent.guardians)) {
                                contact_list = res;
                            } else {
                                contact_list = _.filter(res, function(contact) {
                                    return !_.find(scope.$parent.guardians, {email: contact.email});
                                });
                            }
                            break;
                            default:
                            contact_list = _.filter(res, function(contact) {
                                return !_.find(scope.member.contacts, {email: contact.email});
                            });
                            break;
                        }

                        scope.contact_list = contact_list;

                        scope.contact_list = contact_list;
                        _.each(scope.contact_list, function(item){
                            var name = PersonName.build(item.first_name, item.middle_name, item.last_name);  
                            scope.contact_list_filtered.push({'name':name, 'email':item.email});
                        });

                        if (_.isEmpty(scope.contact_list)) {
                            if (locale.isToken(token)) {
                                locale.ready(locale.getPath(token)).then(function () {
                                    angular.element(elem).after('<div class="help-block error">' + locale.getString(token, {}) + '</div>');
                                });
                            }
                        }
                        scope.haveContacts = true;
                    })
                    .catch(function (error) {

                    });
                },
                template: '<select ng-disabled="!haveContacts" class="form-control" id="listContact" ng-options="(item.name + \' - \' + item.email) for item in contact_list_filtered">' +
                '<option style="display: none" value="" i18n="common.select"></option>' +
                '</select>'
            };
        }])

         .directive('pageTitle', function ($rootScope, $state, locale, Account, Auth) {
            return {
                restrict: 'EA',
                link: function (scope, element, attrs) {
                    scope.$on('$destroy', onDestroy);
                    var deregister = $rootScope.$on('$viewContentLoaded', getLocalizedTitle);
                    getLocalizedTitle();

                    function onDestroy () {
                        deregister();
                    }

                    function getLocalizedTitle() {
                        var token = 'title.' + $state.current.states;

                        if (!locale.isToken(token)) {
                            return;
                        }

                        locale.ready(locale.getPath(token))
                        .then(function () {
                            if (!Auth.isLogged()) {
                                setTitle({});
                                return;
                            }

                            if ($state.params.member_id) {
                                Account.getMember($state.params.member_id)
                                .then(setTitle);
                            } else {
                                Account.get()
                                .then(setTitle);
                            }
                        })
                        .catch(function (error) {
                        });


                        function setTitle(parameter) {
                            if (!_.contains(token,'undefined')){
                                var titleString = locale.getString(token, parameter);
                                element.text(titleString);
                            }
                        }
                    }
                }
            };
        })

         .directive('accessAlertProfile', ['$rootScope','$location', '$modal', function ($rootScope, $location, $modal) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$rootScope','$scope', function ($rootScope,$scope) {

                           /* $scope.cancel = function () {
                               
                                modalInstance.close();
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            }; */

                           /* $scope.accessMemberProfile = function (url) {
                                
                                $rootScope.alertloader = true;
                                $rootScope.globals.showSpinner = true;
                                $rootScope.globals.stateShowSpinner = true;
                                modalInstance.close();
                                
                                var body = angular.element(document).find('body').eq(0);

                                if (body[0].className === 'modal-open') {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                                
                                var a = document.createElement('a');
                                a.href = url;

                                var uri = a.hash.substr(1, a.hash.length);
                                //$scope.alertloader = false;
                                $location.url(uri);
                            };*/
                        }]
                    };

                    scope.cancel = function () {
                        modalInstance.close();
                    }

                    scope.accessMemberProfile = function (url) {
                       angular.element(".btnloader").children("i").removeClass("hide");
                        modalInstance.close();
                        var a = document.createElement('a');
                        a.href = url;
                        var uri = a.hash.substr(1, a.hash.length);
                        //angular.element(".btnloader").children("i").addClass("hide");
                        $location.url(uri);
                    }

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        // Partner page 
        .directive('apiKeyModal', ['$modal', '$state','Restangular','$rootScope', function ($modal, $state,Restangular,$rootScope) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            function cancel(){
                               modalInstance.dismiss('cancel');
                               var body = angular.element(document).find('body').eq(0);
                               if (body[0].className === 'modal-open') {

                                var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                body.removeClass('modal-open');
                                layer.remove();
                                modalLayer.remove();
                            }
                        }

                        $scope.cancel = function () {
                         cancel();
                     };

                     $scope.renewApiKeyForPartner = function (){
                      Restangular.one('partners/key').put().then(
                        function(res){
                         $rootScope.apiKey = res.key;
                         cancel();
                     },
                     function(err){
                        errors = [];
                        errors.push(err.data.error);
                        $scope.errors = errors;
                        cancel();
                    });
                  };
              }]
          };

          elem.on('click', function () {
            modalInstance = $modal.open(opts);
        });
      }
  };
}])

         // get PartnerMembers
         .directive('partnerMembersModal', ['$modal', '$state','Restangular','$rootScope','locale','MEDIA_BASE','ngCopy', function ($modal, $state,Restangular,$rootScope,locale,MEDIA_BASE,ngCopy) {
            return {
                restrict: 'EA',
                
                link: function (scope, elem, attrs,iaSettings) {
                    var modalInstance = null;
                    scope: {
                      iceId: '='
                  };
                  var opts = {
                    backdrop: true,
                    backdropClick: true,
                    dialogFade: false,
                    keyboard: true,
                    size: attrs.size,
                    scope: scope,
                    templateUrl: attrs.templateurl,
                    controller: ['$scope', function ($scope) {
                        scope.showCopied = false;
                        function cancel(){
                           modalInstance.dismiss('cancel');
                           var body = angular.element(document).find('body').eq(0);
                           if (body[0].className === 'modal-open') {

                            var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                            var modalLayer  = angular.element(document).find('div.modal').eq(0);

                            body.removeClass('modal-open');
                            layer.remove();
                            modalLayer.remove();
                        }
                    };

                    $scope.cancel = function () {
                     cancel();
                 };
                $scope.ptmemberDetails = [
                 { id: 1, name: "display_name", selected: true}, 
                 { id: 2, name: "ice_id", selected: true }, 
                 { id: 3, name: "qr_code", selected: true }
                ];
                $scope.isCopied = false;

				$scope.pmvalCopy = function(){
                    var checkedUsers = '';
                    $scope.ptmemberDetails.forEach(function(user){
                        if (user.selected) {
                            if(user.id ==1){
                                checkedUsers += scope.partnerMembers.display_name +' \n';
                            }
                            if(user.id == 2){
                                checkedUsers += scope.partnerMembers.ice_id +' \n';
                            }
                            if(user.id == 3){
                                checkedUsers += scope.partnerMembers.qr_code +' \n';
                            }
                        }
                    });
                    ngCopy(checkedUsers);
                    scope.showCopied = true;
                }

             }]
         };

         scope.clearError = function(){
            scope.showError = false;
        }

         elem.on('click', function () {
                     
                        $rootScope.redirecting=true; // to stop global spinner
                        $rootScope.reqLoading = true;
                        scope.showError = false;
                        var lang = locale.getLocale();
                        var validIceIdNumber = scope.validIceIdNumber.replace(/ /g,'');

                        Restangular.one("partners").one("members").customGET
                        (validIceIdNumber, undefined, {
                            'X-Authorization':$rootScope.apiKey,
                            'Accept-Language':lang,
                        })
                        .then(
                            function(res){
                                scope.partnerMembers ={
                                    first_name:res.first_name,
                                    last_name: res.last_name,
                                    display_name: res.display_name,
                                    qr_code: MEDIA_BASE + 'media/qr/iCE_' +res.ice_id+'.png',
                                    ice_id: res.ice_id
                                };
                                modalInstance = $modal.open(opts);
                                $rootScope.reqLoading = false;
                            },
                            function(err){
                                var errors;
                               $rootScope.reqLoading = false;
                               scope.showError = true;
                               errors = [];
                               errors.push(err.data.error);
                               scope.errors = errors;
                           }) 
                    });
     }
 };
}])
                  // get PartnerMembers
 .directive('getWallpaper', ['$window','$modal', '$state','Restangular','$rootScope','locale','AuthToken','$http','iaSettings', function ($window,$modal, $state,Restangular,$rootScope,locale,AuthToken,$http,iaSettings) {
            return {
                restrict: 'EA',
                
                link: function (scope, elem, attrs,iaSettings) {
                    var modalInstance = null;                   
                  var opts = {
                    backdrop: true,
                    backdropClick: true,
                    dialogFade: false,
                    keyboard: true,
                    size: attrs.size,
                    scope: scope,
                    templateUrl: attrs.templateurl,
                    controller: ['$scope', function ($scope) {
                        function cancel(){
                           modalInstance.dismiss('cancel');
                           var body = angular.element(document).find('body').eq(0);
                           if (body[0].className === 'modal-open') {

                            var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                            var modalLayer  = angular.element(document).find('div.modal').eq(0);

                            body.removeClass('modal-open');
                            layer.remove();
                            modalLayer.remove();
                        }
                    };

                    $scope.cancel = function () {
                     cancel();
                 };
             }]
         };

         elem.on('click', function () {
                        $rootScope.redirecting=true; // to stop global spinner
                        $rootScope.reqLoading = true;
                        scope.showError = false;
                        var token = AuthToken.get();

                        var req = {
                             method: 'GET',
                             url: Config.API_BASE+'/lockscreen',
                             headers: {
                               'X-Authorization':'Bearer ' + token,
                               'Accept-Language': locale
                             } 
                        }

        $http(req)
        .then(function(res)
            {
                var anchor = angular.element('<a/>');
                    anchor.css({display: 'none'});
                    angular.element(document.body).append(anchor);
                    anchor.attr({
                        href: res.data.url,
                        target: '_self',
                        download: 'iCE_wallpaper.jpg'
                    })[0].click();                                
                    anchor.remove();
                $rootScope.redirecting=false;
                $rootScope.reqLoading = false;
            }, 
            function(error)
            {
                $rootScope.reqLoading = false;
                scope.showError = true;
                errors = [];
                errors.push(err.data.error);
                scope.errors = errors;
            });                       

                    });
     }
 };
}])
         
        //login help modal
        .directive('loginHelp', ['$modal', 'Account', function ($modal, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: 'partials/account/templates/send-login-help.html',
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            $scope.cancel = function () {
                                modalInstance.close();
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('editSecurity', ['$modal', '$state', 'Account', function ($modal, $state, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: 'edit-security-modal.html',
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            $scope.cancel = function () {
                                modalInstance.close();
                                
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };

                            $scope.declineGuardian = function (request_id) {
                                Account.declineGuardianRequest(request_id).then(
                                    function (res) {
                                        modalInstance.close();
                                        
                                        $state.transitionTo('account.messages', {}, {reload: true});
                                    },
                                    function (err) {
                                        alert(err.data.error.message);
                                    });
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('changePassword', ['$modal', '$state', 'Account', function ($modal, $state, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            $scope.cancel = function () {
                                modalInstance.close();
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };

                            $scope.changePassword = function (password) {

                                Account.changePassword(password).then(
                                    function (res) {
                                        modalInstance.close();
                                    },
                                    function (err) {
                                        $scope.error = err.data.error;
                                    });
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('loginAgain', ['$modal', '$state', 'Account', function ($modal, $state, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: 'login-again.html',
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            $scope.cancel = function () {
                                modalInstance.close();
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };

                            $scope.declineGuardian = function (request_id) {
                                Account.declineGuardianRequest(request_id).then(
                                    function (res) {
                                        modalInstance.close();
                                        $state.transitionTo('account.messages', {}, {reload: true});
                                    },
                                    function (err) {
                                        alert(err.data.error.message);
                                    });
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('accountPassword', ['$rootScope', '$modal', function ($rootScope, $modal) {
            return {
                restrict: 'EA',
                scope: {
                    section: '@section'
                },
                link: function (scope, elem, attrs) {

                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size || 'sm',
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: attrs.controller
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

         .directive('cancelSubscription', ['$rootScope', '$modal','Restangular','AuthToken', function ($rootScope, $modal,Restangular,AuthToken) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size || 'sm',
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {
                            $scope.cancelSubscription=function(){
                                var token = AuthToken.get();      
                                var data =  {
                                            'X-Authorization': token
                                        };
                                Restangular.all('stripe').all('cancel').post(data).then(
                                    function (res) {
                                      $scope.account.subscription_ends_at = res.ends_at; 
                                      $scope.cancel();            
                                    },
                                    function (err) {
                                                              
                                    });
                            };             

                            $scope.cancel = function () {
                                modalInstance.dismiss('cancel');
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {
                                    var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);
                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

          .directive('resumeSubscription', ['$rootScope', '$modal','AuthToken','Restangular', function ($rootScope, $modal,AuthToken,Restangular) {
            return {
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size || 'sm',
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope','$rootScope', function ($scope,$rootScope) {
                            $scope.resumeSubscription=function(){ 
                                var token = AuthToken.get();      
                                var data =  {
                                            'X-Authorization': token
                                        };
                                Restangular.all('stripe').all('resume').post(data).then(
                                    function (res) {
                                       $scope.account.subscription_ends_at = res.ends_at;  
                                       $scope.cancel();                   
                                    },
                                    function (err) {
                                                          
                                    });
                            };             

                            $scope.cancel = function () {                              
                                modalInstance.dismiss('cancel');
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {
                                    var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);
                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };
                        }]
                    };                    

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('cancelConfirmation', ['$modal', function($modal) {
            return {
                restrict: 'EA',
                scope: {
                    state: '@state',
                    params: '=params'
                },
                link: function(scope, elem, attrs) {
                    var partials = 'partials/modal/cancel-confirmation.html';

                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: partials,
                        scope: scope,
                        controller: attrs.controller
                    };

                    elem.on('click', function() {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('scanQrcode', ['Account','$modal','$window','$rootScope', function(Account, $modal,$window,$rootScope) {
            return {
                restrict: 'EA',
                link: function(scope, elem, attrs) {

                   

                    var partials = 'partials/modal/qr-scanner.html';

                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: partials,
                        scope: scope,
                        windowClass: 'chat-modal',
                        controller: ['$scope','$rootScope', function ($scope,$rootScope) {
                           
                        }]
                    };


                    scope.cancel = function () {
                        modalInstance.close();
                         if( $window.productcate == 'antigen' ||  $window.productcate == 'antibody' ||  $window.productcate == 'nucleicacid' &&  ($window.productname != '' || $window.manuafcture != '' || $window.serialnumber != '' || $window.lotnumber != '' )){
                            scope.member.additional_information.medical.covid_reports[attrs.indexform].pcategory= $window.productcate; 
                            scope.member.additional_information.medical.covid_reports[attrs.indexform].pname= $window.productname; 
                            scope.member.additional_information.medical.covid_reports[attrs.indexform].mfname=   $window.manuafcture;
                            scope.member.additional_information.medical.covid_reports[attrs.indexform].srnumber=$window.serialnumber;
                            scope.member.additional_information.medical.covid_reports[attrs.indexform].lotnumber=$window.lotnumber ;  
                        
                            scope.covidForm.pcategory.$setValidity('required', true);
                            scope.covidForm.pcategory.$setValidity('notScanned', true);

                            if($window.serialnumber !== '-'){
                                Account.validateProduct($window.serialnumber, $window.productcate).then(
                                    function(res) {
                                        if (res === undefined) {
                                            scope.isNotValide = true;
                                            
                                        } else {
                                            if(res.data.exist == true){
                                                scope.isNotValide = true;
                                                $rootScope.notvalidproduct = true;
                                                scope.covidForm.srnumber.$setValidity('srnumber', false);
                                            }else{
                                                scope.isNotValide = false;
                                                $rootScope.notvalidproduct = false;
                                                scope.covidForm.srnumber.$setValidity('srnumber', true);
                                            }
                                        }
                                    });
                                }

                            scope.member.additional_information.medical.covid_reports[attrs.indexform].scanned=  1;
                        }else if( $window.productname == '' && $window.manuafcture == '' && $window.serialnumber == '' && $window.lotnumber == '' && $window.productcate == '' ){
                            scope.member.additional_information.medical.covid_reports[attrs.indexform].scanned=  0;
                        }else{
                            scope.covidForm.pcategory.$setValidity('notScanned', false);
                            scope.covidForm.pcategory.$setValidity('required', true);
                        }
                    };


                    scope.start = function(){
                        console("start");
                       
                    }

                    elem.on('click', function() {
                        if(!scope.member.last_name || !scope.member.phone)
                        {
                            scope.incompleteProfle = true;
                        }else{
                            scope.incompleteProfle = false;
                            modalInstance = $modal.open(opts);
                        }
                        
                    });
                }
            };
        }])

        .directive('scanQrcodeImmu', ['Account', '$modal','$window', '$rootScope', function(Account, $modal,$window, $rootScope) {
            return {
                restrict: 'EA',
                link: function(scope, elem, attrs) {

                   

                    var partials = 'partials/modal/qr-scanner.html';

                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: partials,
                        scope: scope,
                        windowClass: 'chat-modal',
                        controller: ['$scope','$rootScope', function ($scope,$rootScope) {
                           
                        }]
                    };

                    scope.cancel = function () {
                        modalInstance.close();
                        if( $window.productcate == 'covid19' && ($window.productname != '' || $window.manuafcture != '' || $window.serialnumber != '' || $window.lotnumber != '' )){
                            scope.member.additional_information.medical.immunizations[attrs.indexform].name= 23; //$window.productcate; 

                            scope.member.additional_information.medical.immunizations[attrs.indexform].pname= $window.productname; 
                            scope.member.additional_information.medical.immunizations[attrs.indexform].mfname=   $window.manuafcture;
                            scope.member.additional_information.medical.immunizations[attrs.indexform].srnumber=$window.serialnumber;
                            scope.member.additional_information.medical.immunizations[attrs.indexform].lotnumber=$window.lotnumber ;  
                        
                            scope.member.additional_information.medical.immunizations[attrs.indexform].scanned=  1;

                            scope.immunizationForm.immunization_type.$setValidity('required', true);
                            scope.immunizationForm.immunization_type.$setValidity('notScanned', true);

                            if($window.serialnumber !== '-'){
                                Account.validateVaccineProduct($window.serialnumber, $window.productcate).then(
                                    function(res) {
                                        if (res === undefined) {
                                            scope.isNotValide = true;
                                            
                                        } else {
                                            if(res.data.exist == true){
                                                scope.isNotValide = true;
                                                $rootScope.notvalidproduct = true;
                                                scope.immunizationForm.srnumber.$setValidity('srnumber', false);
                                            }else{
                                                scope.isNotValide = false;
                                                $rootScope.notvalidproduct = false;
                                                scope.immunizationForm.srnumber.$setValidity('srnumber', true);
                                            }
                                        }
                                    });
                                }



                        }else if( $window.productname == '' && $window.manuafcture == '' && $window.serialnumber == '' && $window.lotnumber == '' && $window.productcate == '' ){
                            scope.member.additional_information.medical.immunizations[attrs.indexform].scanned=  0;
                        }else{
                            scope.immunizationForm.immunization_type.$setValidity('notScanned', false);
                            scope.immunizationForm.immunization_type.$setValidity('required', true);
                        }
                    };

                    scope.start = function(){
                        console("start");
                       
                    }

                    elem.on('click', function() {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('displayResult', ['$modal', function($modal) {
            return {
                restrict: 'EA',
                scope: {
                    state: '@state',
                    params: '=params'
                },
                link: function(scope, elem, attrs) {
                    var partials = 'partials/modal/covid-modal.html';

                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: partials,
                        scope: scope,
                        controller: ['$scope','$rootScope', function ($scope,$rootScope) {
                            $scope.memberdata = angular.fromJson(attrs.resultData);
                        }]
                    };

                    scope.cancel = function () {
                        modalInstance.close();
                    };

                    elem.on('click', function() {
                        modalInstance = $modal.open(opts);
                        //scope.memberdata = angular.toJson(attrs.resultData);
                        //console.log(scope.memberdata);
                    });
                }
            };
        }])

        /*****************************
         * Partner Page Modal.
         *****************************/
         .directive('actionModal', ['$modal', '$state', 'Account','$rootScope', function ($modal, $state,Account,$rootScope) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope','$rootScope', function ($scope,$rootScope) {
                            $scope.ecpremovederror = false;
                            $scope.ecpremovedsuccessfully = false;
                            $scope.ok=function(iceIdNumber){
                                $rootScope.globals.showSpinner = true;
                                $rootScope.globals.stateShowSpinner = true;
                                $rootScope.redirecting = false;
                              Account.removeECPFromPartner(iceIdNumber)
                                .then(function (res) {
                                    $scope.errors = [];      
                                                                                    
                                    Account.getFriends().then(function(friends) {
                        				friends.contacts.forEach(function(friend){
                            				friend.fullDate =  _.compact([friend.birth_date.year, friend.birth_date.month, friend.birth_date.day]).join('-');
                        				});
                      					$rootScope.friends = friends;
                    				});
                                    $rootScope.globals.showSpinner = false;
                                    $rootScope.globals.stateShowSpinner = false;
                                    $rootScope.redirecting = true;
                                    $scope.ecpremovedsuccessfully = true;

                                    setTimeout(function() {
                                            modalInstance.close();
                                            $state.reload();
                                            $scope.ecpremovedsuccessfully = false;   
                                        }, 3000);
                                })
                                .catch(function (err) {
                                    $scope.ecpremovederror = true;
                                    $scope.removeEcpError = err.data.error.message;
                                    setTimeout(function() {
                                        modalInstance.close();
                                        $state.reload();
                                        $scope.ecpremovederror = false;
                                    }, 3000);
                                });
                            };
                            $scope.cancel = function () {
                                modalInstance.dismiss('cancel');
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        /*****************************
         * Remove delete member modal.
         *****************************/
         .directive('deleteMember', ['$modal', '$state','$rootScope', 'Account', function ($modal, $state, $rootScope, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var errors;
                    
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: function () {
                            scope.cancel = function () {
                                modalInstance.close();
                            };

                            scope.ok = function (id) {

                                Account.removeMember(id).then(
                                    function (res) {

                                        if(attrs.id == "partnermemberdelete"){
                                            Account.getFriends().then(function(friends) {
                                                $rootScope.friends = friends;
                                                });
                                            Account.get();
                                            modalInstance.close();
                                            //$state.go('base.Partner');
                                            console.clear();
                                            return;
                                        }
                                        angular.forEach(scope.account.members, function (member, index) {
                                            if (_.find(member.contacts, {id: scope.account.id})) {
                                                scope.account.friends_count--;
                                            }
                                        });

                                        modalInstance.close();
                                        $state.go('account.show');
                                    }, 
                                    function (err) { 
                                        if (err.status == 401) {
                                            $scope.step = 'default';
                                        }
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    });
                            };

                            // Todo:: Transfer members.
                            scope.transfer = function (member) {
                                modalInstance.close();
                                alert('Todo Transfer members');
                            };
                        }
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

         .directive('independentAccount', ['$modal', '$state', 'Account', function ($modal, $state, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: [function () {
                            var errors = [];
                            scope.errors = [];

                            scope.cancel = function () {
                                modalInstance.close();
                            };

                            scope.send_transfer_invitation = function (email, member) {
                                email = !_.isUndefined(email)?email: member.email;
                                Account.validateMemberEmail(email, member).then(
                                    function (res) {
                                        Account.transfer(member.id, email).then(
                                            function (res) {
                                                scope.errors = [];
                                                if (res.success) {
                                                    scope.error = null;
                                                    scope.success = true;
                                                    scope.message = res.message;
                                                }
                                            },
                                            function (err) {
                                                errors = [];
                                                errors.push(err.data.error);
                                                scope.errors = errors;
                                            });
                                    },
                                    function (err) {
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    }
                                    );
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

         .directive('printIceId', ['$modal', '$state', 'Account', function ($modal, $state, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope','$rootScope', function ($scope,$rootScope) {
                            if($scope.member == null)
                            {
                                Account.getMember($rootScope.account.id)
                                    .then(function (member) {
                                        $scope.member = member;
                                });
                            }

                            if(navigator.userAgent.toLowerCase().match(/iphone/i) == "iphone" && navigator.userAgent.toLowerCase().match(/MicroMessenger/i) == "micromessenger"){
                                $rootScope.isiphonewechatDevice = true; 
                            }
                            else{
                                $rootScope.isiphonewechatDevice = false; 
                            }

                            if(navigator.userAgent.toLowerCase().match(/android/i) == "android" && navigator.userAgent.toLowerCase().match(/MicroMessenger/i) == "micromessenger"){
                                $rootScope.isAndroidDevice = true; 
                            }
                            else{
                                $rootScope.isAndroidDevice = false; 
                            }

                            $scope.cancel = function () {
                                modalInstance.dismiss('cancel');
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };

                            $scope.printIceId = function (member) {
                                Account.memberShareEvent(member, 'download').then(
                                    function (res) {
                                        var w = window.open(res[0]);
                                    }
                                );
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);

                        modalInstance.result.then(function (res) {
                        }, function () {
                            elem.find('button').attr('disabled');
                        });
                    });
                }
            };
        }])


         .directive('accessRecords', ['$modal', '$state', '$timeout', 'Account', '$rootScope','Restangular', function ($modal, $state, $timeout, Account, $rootScope,Restangular) {
            return {
                restrict: 'A',
                replace: true,
                link: function (scope, elem, attrs) {
                    attrs.$observe('accessRecords', function(value) {
                        if(value!=="")
                            {
                                $modal.is_premium = $.parseJSON(value).is_premium;
                                $modal.is_partner = $.parseJSON(value).is_partner;
                                if($modal.is_premium===false && !angular.isUndefined($rootScope.promo && !$modal.is_partner)){
                                    setTimeout(function(){
                                        $('#promoClick').trigger('click');
                                         // modalInstance = $modal.open(opts);
                                          // modalInstance.result.then(function (res) {
                                          //       }, function () {
                                          //           elem.find('button').attr('disabled');
                                          //   });
                                    //     var a = $('#promoCouponId').length;
                                    //    $('#promoCouponId').val($rootScope.promo);
                                    // var a = $('#promoCouponId').val();                              
                                     }, 5000);
                                    
                                }                                
                            }
                          });
                    scope.cardNameLanguage = $rootScope.globals.language;
                    var modalInstance = null;
                   

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope','$rootScope','$filter','$http', function ($scope,$rootScope,$filter,$http) {
                            scope.isPayAmountTab = true;
                            scope.isAmountFree = false;
                            scope.isAmountFreeLifeTime = false;
                            scope.isAmountFreeMonthPremium = false;
                            scope.couponCodeInvalideMessage = false;
                            scope.transactionFailed = false;
                            scope.isCouponCodeApplied = false;
                            if($rootScope.globals.language =="en-US"){
                                scope.totalamountforPaid = '15.00';
                            }
                            else{
                                scope.totalamountforPaid = '15';
                            }
                            scope.totalamountPaidAlipay = 1500;
                        $timeout(function () {
                            
                            // scope.submitCard = submitCard;
                            var self = this;
                            var stripe = Stripe(Config.STRIPE_PUBLIC_KEY);
							var elements = stripe.elements({locale: $rootScope.globals.language});
                            var style = {   
                                                    base: {
                                                      iconColor: '#666EE8',
                                                      color: '#31325F',
                                                      lineHeight: '40px',
                                                      fontWeight: 300,
                                                      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                                                      fontSize: '15px',

                                                      '::placeholder': {
                                                        color: '#CFD7E0',
                                                      },
                                                    },
                                                      invalid: {
                                                        color: '#fa755a',
                                                        iconColor: '#fa755a'
                                                      }
                                                  
                                            };

                                // self.card = elements.create('card', {style: style});
                                // self.card.mount('#card-element');

                                scope.cardNumberElement = elements.create('cardNumber', {
                                  iconStyle: 'solid', style: style, classes: {focus: 'is-focused', empty: 'is-empty'}
                                });
                                scope.cardNumberElement.mount('#card-number-element');

                                scope.cardExpiryElement = elements.create('cardExpiry', {
                                  iconStyle: 'solid', style: style, classes: {focus: 'is-focused', empty: 'is-empty'}
                                });
                                scope.cardExpiryElement.mount('#card-expiry-element');

                                scope.cardCvcElement = elements.create('cardCvc', {
                                  iconStyle: 'solid', style: style, classes: {focus: 'is-focused', empty: 'is-empty'}
                                });
                                scope.cardCvcElement.mount('#card-cvc-element');

                                // self.postalCodeElement = elements.create('postalCode', {
                                //   iconStyle: 'solid', style: style, classes: {focus: 'is-focused', empty: 'is-empty'}
                                // });
                                // self.postalCodeElement.mount('#postal-code-element');

                            var inputs = document.querySelectorAll('input.field');
                            Array.prototype.forEach.call(inputs, function(input) {
                              input.addEventListener('focus', function() {
                                input.classList.add('is-focused');
                              });
                              input.addEventListener('blur', function() {
                                input.classList.remove('is-focused');
                              });
                              input.addEventListener('keyup', function() {
                                if (input.value.length === 0) {
                                  input.classList.add('is-empty');
                                } else {
                                  input.classList.remove('is-empty');
                                }
                              });
                            });

                            function setOutcome(result) {
                              var successElement = document.querySelector('.success');
                              var errorElement = document.querySelector('.error');
                                successElement.classList.remove('visible');
                                errorElement.classList.remove('visible');
                                $scope.subscribeCouponCodeInvalid = false;
                                $scope.subscribeInvalidTransaction = false;

                              if (result.token) {
                                // Use the token to create a charge or a customer
                                // https://stripe.com/docs/charges
                                  var isFreeParam = false;
                                var coupon = document.querySelector('input[name=coupon-element]').value;
                                Account.subscribePayment($rootScope.account.id, result.token, coupon,isFreeParam).then(function (returnValue){
                                    //TODO: disable button
                                    var status = '';
                                    $rootScope.account.is_premium=true;
                                    scope.couponCodeInvalidMessage = false;

                                    if (returnValue.success){
                                        status = $filter('i18n')('common.cardPaymentSuccessful');
                                        if (returnValue.promo=='bin' || returnValue.promo=='coupon'){
                                            status =$filter('i18n')('common.couponCodeSuccessful');                                         
                                        }
                                    }else{
                                        $rootScope.account.is_premium=false;
                                    }

                                    successElement.querySelector('.result').textContent = status;
                                    successElement.classList.add('visible');
                                    $timeout(function () {
                                        $scope.cancel();
                                    }, 5000);

                                }, function(e){
                                    //TODO: re-enable button, allow retry                               
                                    if(e.status==404){
                                       $scope.subscribeCouponCodeInvalid = true;
                                    }
                                    else{
                                        $scope.subscribeInvalidTransaction = true;
                                    }
                                   // successElement.classList.add('visible');
                                });
                              } else if (result.error) {

                                errorElement.textContent = result.error.message;
                                errorElement.classList.add('visible');
                              }
                            }
                           function setAlipayOutcome(result) {
                              var successElement = document.querySelector('.successAlipay');
                              var errorElement = document.querySelector('.errorAlipay');
                              successElement.classList.remove('visible');
                              errorElement.classList.remove('visible');
                             
                                if (result.source) {
                                // Use the token to create a charge or a customer
                                // https://stripe.com/docs/charges                                  
                              
                                Account.subscribePaymentAlipay(result.source).then(function (returnValue){
                                    //TODO: disable button
                                  
                                    var status = '';
                                    $rootScope.account.is_premium=true;
                                    scope.couponCodeInvalidMessage = false;

                                    if (returnValue.success){
                                        status = $filter('i18n')('common.cardPaymentSuccessful');
                                        if (returnValue.promo=='bin'){
                                            status =$filter('i18n')('common.couponCodeSuccessful');                                         
                                        }
                                    }else{
                                        $rootScope.account.is_premium=false;
                                    }

                                    successElement.querySelector('.result').textContent = status;
                                    successElement.classList.add('visible');
                                    $timeout(function () {
                                        $scope.cancel();
                                    }, 5000);

                                }, function(e){
                                    //TODO: re-enable button, allow retry                               
                                    if(e.status==404){
                                     successElement.querySelector('.result').textContent = $filter('i18n')('errors.invalidCouponCode');   
                                    }
                                    else{
                                        successElement.querySelector('.result').textContent = $filter('i18n')('errors.transactionFailed');   
                                    }
                                    successElement.classList.add('visible');
                                });
                              } else if (result.error) {

                                errorElement.textContent = result.error.message;
                                errorElement.classList.add('visible');
                              }
                            }
                            
                            if(scope.cardNumberElement){
                                scope.cardNumberElement.on('change', function(event) {
                                  setOutcome(event);
                                });
                            }

                            //document.querySelector('form').addEventListener('submit', function(e) {
                            $scope.submitpayemnt  = function(){
                               
                              var form = document.querySelector('form');
                              //alert(form);
                              var extraDetails = {
                                //name: form.querySelector('input[name=cardholder-name]').value,
                                name: $("input[name=cardholder-name]").val(),
                              };
                            
                              // TODO: capture and pass coupon to API call
                              // document.querySelector('input[name=coupon-element]').value

                              showPaymentSpinner("card");
                              stripe.createToken(scope.cardNumberElement, extraDetails).then(setOutcome)                            
                            }
                            //);

                            function showPaymentSpinner(btnDetail)
                            {
                                if(btnDetail =="card"){
                                    var  payByCardBtnText = document.querySelector('#payByCardBtnId');
                                    if(!_.isNull(payByCardBtnText)){
                                        //payByCardBtnText.classList.add('loading_icon_price');
                                        $scope.iscardLoading= true;
                                        hidePaymentSpinner(payByCardBtnText);                                    
                                    }
                                }
                                else if(btnDetail =="alipay"){
                                    var  payByAliPayBtnVal = document.querySelector('#payByAliPayBtnId');
                                    if(!_.isNull(payByAliPayBtnVal)){
                                        //payByAliPayBtnVal.classList.add('loading_icon_price');
                                        $scope.isalipayLoading= true;
                                        hidePaymentSpinner(payByAliPayBtnVal);
                                    }
                                }
                            }
                             function hidePaymentSpinner(valDetail){
                                $timeout(function () {
                                        //valDetail.classList.remove('loading_icon_price');
                                        $scope.iscardLoading= false;
                                         $scope.isalipayLoading= false;
                                    }, 3000);
                             }
                            $scope.alipayFunc = function () {
                                var errorElementAlipay = document.querySelector('.errorAlipay');
                                    errorElementAlipay.classList.remove('visible');
                                $scope.isAlipayPaymentMobile = false;
                                var mobileDevice = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));                                                  
                                if(mobileDevice){
                                    $scope.isAlipayPaymentMobile = true;
                                }
                                $scope.isAlipayPayment = true;
                                showPaymentSpinner("alipay");
                                Account.createAlipaySource($scope.totalamountPaidAlipay);                                
                                };

                              $scope.applyCouponFunc  = function(){
                                    var successElementeAfterCoupon = document.querySelector('.successAfterCoupon');
                                    successElementeAfterCoupon.classList.remove('visible');
                                    var errorElementeAfterCoupon = document.querySelector('.errorAfterCoupon');
                                    errorElementeAfterCoupon.classList.remove('visible');
                                    var  applyBtnTag = document.querySelector('#applyBtnId');
                                    applyBtnTag.classList.remove('applyBtnActive');
                                                                      
                                    $scope.isPayAmountTab = true;
                                    $scope.isAmountFree = false; 
                                    $scope.isAmountFreeLifeTime = false;
                                    $scope.isAmountFreeMonthPremium = false;
                                    $scope.isCouponCodeApplied = false;
                                    var errors = [];
                                        $scope.errors = [];
                                        $scope.unlinkErr = errors;
                                        $rootScope.globals.showSpinner = false;
                                        $rootScope.globals.stateShowSpinner = false;
                                        $rootScope.redirecting = true;   
                                        $scope.couponCodeInvalidMessage = false;
                                        $scope.couponCodeIsRequired = false;
                                    var couponCodeDetail = document.querySelector('input[name=coupon-element]').value;                                 
                                    if(_.isEmpty(couponCodeDetail)){
                                        $scope.couponCodeIsRequired = true;                                      
                                        return false;
                                    }
                                    $scope.AppliedCouponCode = couponCodeDetail;
                                    //applyBtnTag.classList.add('applyBtnActive');
                                     $scope.isbeforecouponLoading = true;
                                    //Restangular.one('coupon/check?coupon='+couponCodeDetail).get().then(
                                    $http.get(Config.API_BASE+'/coupon/check?coupon='+couponCodeDetail).then(
                                            function(result){
                                                
                                                result= result.data;
                                                if(result.valid){ 
                                                    
                                                    /*if(result.percent_off =="100"){
                                                        if(_.isNumber(result.duration_in_months)){  
                                                            $scope.freeMonthPremium = result.duration_in_months;                                                  
                                                            $scope.isPayAmountTab = false;
                                                            $scope.isAmountFree = true; 
                                                            $scope.isAmountFreeMonthPremium = true;
                                                        }
                                                        if(_.isNull(result.duration_in_months) && result.duration =="forever"){
                                                            $scope.isPayAmountTab = false;
                                                            $scope.isAmountFree = true; 
                                                            $scope.isAmountFreeLifeTime = true;
                                                        }
                                                    }*/


                                                    if(!_.isUndefined(result.percent_off)){
                                                                if(!_.isNull(result.percent_off) && result.percent_off <= 100 ){
                                                                    var total_payment1 = (1500 - Math.round((1500 * result.percent_off))/100);
                                                                    var total_payment =  (Math.round(total_payment1)/100).toString() ; 
                                                                    if(total_payment1 === 0){
                                                                            $scope.freeMonthPremium = result.duration_in_months;
                                                                            $scope.isPayAmountTab = false;
                                                                            $scope.isAmountFree = true; 
                                                                            $scope.isAmountFreeMonthPremium = true;

                                                                    }else{
                                                                            $scope.totalamountPaidAlipay =total_payment1;
                                                                            $scope.totalamountforPaid = total_payment;
                                                                            $scope.isCouponCodeApplied = true;
                                                                    }
                                                                }else{
                                                                    console.log("else condition");
                                                                    $scope.couponCodeInvalidMessage = true;
                                                                }
                                                    }

                                                    if(!_.isNull(result.amount_off)){
                                                        
                                                        if(result.amount_off < 1500){
                                                            var total_pay = (1500 - result.amount_off).toString() ;                                                         
                                                            $scope.totalamountPaidAlipay =total_pay;
                                                            var total_payArray = total_pay.split('')                                                      
                                                            if(total_pay.length>2)
                                                            {
                                                                total_payArray.splice(total_payArray.length-2,0,".")
                                                                var remaining_total_paid =total_payArray.join('');
                                                                $scope.totalamountforPaid = remaining_total_paid;
                                                                $scope.isCouponCodeApplied = true;
                                                            }
                                                            else if(total_pay.length ==2){
                                                                $scope.totalamountforPaid ="00."+total_pay;
                                                                $scope.isCouponCodeApplied = true;
                                                            }
                                                            else if(total_pay.length ==1){                                                                
                                                                 $scope.totalamountforPaid ="00.0"+total_pay;
                                                                 $scope.isCouponCodeApplied = true;
                                                            }
                                                        }

                                                        if(result.amount_off == 1500){
                                                            $scope.freeMonthPremium = result.duration_in_months;                                                  
                                                            $scope.isPayAmountTab = false;
                                                            $scope.isAmountFree = true; 
                                                            $scope.isAmountFreeMonthPremium = true;
                                                        }
                                                    }

                                                }
                                                else{
                                                     $scope.couponCodeInvalidMessage = true;
                                                } 
                                               // applyBtnTag.classList.remove('applyBtnActive');
                                                $scope.isbeforecouponLoading = false; 
                                                 $scope.isfreeLoading= true;
                                            },
                                            function (err) {
                                                $scope.isbeforecouponLoading= false;
                                                if(err.status == 404){
                                                    $scope.couponCodeInvalidMessage = true;
                                                    console.clear();
                                                }
                                                else{
                                                    errors.push(err.data.error);
                                                    $scope.unlinkErr = errors;
                                                }
                                                applyBtnTag.classList.remove('applyBtnActive');
                                            }); 
                            };

                            $scope.afterCouponSubscribe = function () {
                                var errorElementeAfterCoupon = document.querySelector('.errorAfterCoupon');
                                    errorElementeAfterCoupon.classList.remove('visible');
                                var successElementeAfterCoupon = document.querySelector('.successAfterCoupon');
                                    successElementeAfterCoupon.classList.remove('visible');
                                var coupon = document.querySelector('input[name=coupon-element]').value;
                                var tokenVal = null;
                                var isFreeVal = true;
                                var errors = [];
                                    $scope.errors = [];
                                    $scope.unlinkSubsCouponErr = errors;

                                $rootScope.globals.showSpinner = true;
                                $rootScope.globals.stateShowSpinner = true;
                                $rootScope.redirecting = false;  
                                if(_.isEmpty(coupon)){
                                        $scope.couponCodeIsRequired = true;                                      
                                        return false;
                                }
                                function showLoaderOnPage(){
                                    $rootScope.globals.showSpinner = false;
                                    $rootScope.globals.stateShowSpinner = false;
                                    $rootScope.redirecting = true; 
                                }
                                 $scope.isfreeLoading= false;
                                Account.subscribePaymentAfterCoupon($rootScope.account.id, tokenVal, coupon.trim(),isFreeVal).then(function (returnValue){
                                    var status = '';
                                    if (returnValue.success){
                                        $rootScope.account.is_premium=true;
                                        status = $filter('i18n')('common.paymentSuccess');
                                    successElementeAfterCoupon.querySelector('.result').textContent = status;
                                    successElementeAfterCoupon.classList.add('visible');
                                    $timeout(function () {
                                       $scope.cancel();
                                    }, 5000);  

                                    }else{
                                        $rootScope.account.is_premium=false;                                        
                                        errorElementeAfterCoupon.querySelector('.result').textContent = $filter('i18n')('common.subscriptionError');
                                        errorElementeAfterCoupon.classList.add('visible');    
                                    }
                                    $scope.isfreeLoading= false;
                                    showLoaderOnPage();

                                }, function(err){
                                     $scope.isfreeLoading= false;
                                    errors.push(err.data.error);
                                    $scope.unlinkSubsCouponErr = errors;
                                    showLoaderOnPage();
                                });
                                };
                        });

                            $scope.cancel = function () {
                                modalInstance.dismiss('cancel');
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }

                                
                            };

                            $scope.printIceId = function (member) {
                                Account.memberShareEvent(member, 'download').then(
                                    function (res) {
                                        var w = window.open(res[0]);
                                    }
                                    );
                            };
                        }]
                    };

                    elem.on('click', function (element) {
                       
                        if($modal.is_premium===false && !$modal.is_partner)
                        {
                            modalInstance = $modal.open(opts);
                            modalInstance.result.then(function (res) {
                                }, function () {
                                    elem.find('button').attr('disabled');
                            });
                           
                        }
                        else
                        {
                           var details = attrs;
                           if(details.id==='show_payment_popup_rescue_id'){
                                modalInstance = $modal.open(opts);
                                modalInstance.result.then(function (res) {
                                    }, function () {
                                        elem.find('button').attr('disabled');
                                });
                            }
                            else if(element.target.className==='add_member_record'){
                                $state.transitionTo('account.member', {}); 
                            }
                            else if(!_.isUndefined(attrs.memberidval)){
                                $state.transitionTo('account.viewMember', {member_id: attrs.memberidval}); 
                            }
                             else if(!_.isUndefined(attrs.membereditidval)){
                                $state.transitionTo('account.editMember', {member_id: attrs.membereditidval}); 
                            }
                            else
                            {
                                $state.transitionTo('account.viewMember', {member_id: $rootScope.account.members[0].id}); 
                            }                            
                        }
                    });
                }
            };
        }])

    .directive('accessPartnerRecords', ['$modal', '$state', '$timeout', 'Account', '$rootScope','Restangular', function ($modal, $state, $timeout, Account, $rootScope,Restangular) {
           return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {
                        }]
                    };

                    elem.on('click', function (element) {
                        $state.transitionTo('account.editMember', {member_id: attrs.membereditidval});                            
                    });
                }
            };
        }])
         .directive('sendMessenger', ['$modal', '$state', 'Account', function ($modal, $state, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                            $scope.cancel = function () {
                                modalInstance.dismiss('cancel');
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className === 'modal-open') {

                                    var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                    layer.remove();
                                    modalLayer.remove();
                                }
                            };

                            $scope.printIceId = function (member) {
                                Account.memberShareEvent(member, 'download').then(
                                    function (res) {
                                        var w = window.open(res[0]);
                                    }
                                    );
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);

                        modalInstance.result.then(function (res) {
                        }, function () {
                            elem.find('button').attr('disabled');
                        });
                    });
                }
            };
        }])
         .directive('deleteAccount', ['$modal', '$state', 'Account', 'Auth', function ($modal, $state, Account, Auth) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: 'DeleteAccountController'
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('wechatModal', ['$modal', '$state', function ($modal, $state) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                           $scope.cancel = function () {
                            modalInstance.dismiss('cancel');
                            var body = angular.element(document).find('body').eq(0);
                            if (body[0].className === 'modal-open') {

                                var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                body.removeClass('modal-open');
                                layer.remove();
                                modalLayer.remove();
                            }
                        };
                    }]
                };

                elem.on('click', function () {
                    modalInstance = $modal.open(opts);
                });
            }
        };
    }])

        .directive('appStoreModal', ['$modal', '$state', function ($modal, $state) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                           $scope.cancel = function () {
                            modalInstance.dismiss('cancel');
                            var body = angular.element(document).find('body').eq(0);
                            if (body[0].className === 'modal-open') {

                                var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                body.removeClass('modal-open');
                                layer.remove();
                                modalLayer.remove();
                            }
                        };
                    }]
                };

                elem.on('click', function () {
                    modalInstance = $modal.open(opts);
                });
            }
        };
    }])

         .directive('emailconfirmationModal', ['$modal', '$state', function ($modal, $state) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {

                           $scope.cancel = function () {
                            modalInstance.dismiss('cancel');
                            var body = angular.element(document).find('body').eq(0);
                            if (body[0].className === 'modal-open') {

                                var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                body.removeClass('modal-open');
                                layer.remove();
                                modalLayer.remove();
                            }
                        };

                        $scope.gotoSettings = function(){
                            $scope.cancel();
                            $state.transitionTo('account.settings', {});
                        };
                    }]
                };

                elem.on('click', function () {
                    modalInstance = $modal.open(opts);
                });
            }
        };
    }])

         .directive('desktopHeader', function () {
            return {
                restrict: 'E',
                scope: {
                    account: '=',
                    newMessagesCount: '=',
                    language: '=',
                    isHome: '=',
                    logout: '&',
                    isandroidapp: "=",
                    isiphoneapp: "=",
                    downloadlockscreenidpath: '=',
                    iphoneappdownloadurl: '=',
                    iphoneappdownloadurlchina: '=',
                    androidappdownloadurl: '=',
                    cardidurldetailval: '=',
                    showPartner: '='
                },
                templateUrl: 'partials/header/desktop.html'
            };
        })

         .directive('mobileHeader',['$http','$timeout','$rootScope', function ($http,$timeout,$rootScope) {
            return {
                restrict: 'E',
                scope: {
                    account: '=',
                    newMessagesCount: '=',
                    logged: '=',
                    isHome: '=',
                    logout: '&',
                    language: '=',
                    isandroidapp: "=",
                    isiphoneapp: "=",
                    isaccountshowpage: "=",
                    isMessage: "=",
                    isEdit: "=",
                    isSettings: "=",
                    downloadlockscreenidpath: '=',
                    iphoneappdownloadurl: '=',
                    iphoneappdownloadurlchina: '=',
                    androidappdownloadurl: '=',
                    cardidurldetailval: '=',
                    showPartner: '='
                },
                templateUrl: 'partials/header/mobile.html',
                link: function (scope, element, attrs) {
                    var menuMobile = element.find('.menu-mobile');

                    menuMobile.bind('click', function() {
                       // menuMobile.collapse('hide');
                    });

                    scope.$on('$stateChangeStart', function () {
                        menuMobile.collapse('hide');
                    });

                    scope.hrefbase = Config.API_BASE;
                    scope.isDownloadLockScreenIdPath = false;
                    scope.showError = false;
                  
                    scope.downloadlockscreen = function(){
                       
                        $rootScope.globals.showSpinner = true;
                        $rootScope.globals.stateShowSpinner = true;
                        $rootScope.redirecting = false;               
                        
                        $timeout(function() {
                            $rootScope.globals.showSpinner = false;
                            $rootScope.globals.stateShowSpinner = false;
                            $rootScope.redirecting = true;
                        }, 3000);
                    }

                    scope.showloaderonpagepdf = function(){
                        $rootScope.globals.showSpinner = true;
                        $rootScope.globals.stateShowSpinner = true;
                        $rootScope.redirecting = false;               
                        
                        $timeout(function() {
                            $rootScope.globals.showSpinner = false;
                            $rootScope.globals.stateShowSpinner = false;
                            $rootScope.redirecting = true;
                        }, 5000);
                    }

                    scope.callDownloadScreen = function(){
                        
                        if(scope.logged && !scope.isDownloadLockScreenIdPath){

                             var token = AuthToken.get();
                             var req = {
                                         method: 'GET',
                                         async: false,
                                         url: Config.API_BASE+'/lockscreen',
                                         headers: {
                                           'X-Authorization':'Bearer ' + token,
                                           'Accept-Language': iaSettings.getLanguage()
                                        }
                                       }
                             $http(req)
                                 .then(function(res)
                                     {
                                      scope.downloadLockScreenIdPath=res.data.url;
                                    },
                                     function(error)
                                     {
                                        scope.showError = true;
                                     });
                        }                        
                    }

                }
            };
        }])

         .filter('emailAddress', ['$log', '$filter', 'EmailAddresses', function ($log, $filter, EmailAddresses) {
            return function (input, key) {

                var emailPattern = new RegExp('@(.*)'),
                emailDomain = emailPattern.exec(input);


                return emailDomain ? _.find(EmailAddresses, {pattern: emailDomain[1]}) : null;
            };
        }])

         .filter('timeAgo', ['iaSettings', function (iaSettings) {
            return function (input, key) {
                if (input) {
                    moment().local();

                    var alertTime = moment(input.date).format('YYYY-MM-DDTHH:mm:ss'),
                    currentTime = moment().tz(input.timezone).format('YYYY-MM-DDTHH:mm:ss');

                    return moment(alertTime).locale(iaSettings.getFormatLanguage()).from(currentTime);
                }
            };
        }])

         .filter('phoneNumber', ['iaSettings', function (iaSettings) {
            return function (input, key) {
                if(!_.isUndefined(input)){
                    return input.replace(' ', '-');
                }else{
                    return null;
                }
            };
        }])

         .directive('timeAgo', function(iaSettings) {
            return {
                restrict: 'A',
                controller: function($window, $scope, $element, $attrs, $interval) {
                    var interval = null;

                    function renderTime(date) {
                        moment().local();

                        var alertTime = moment(date.date).format('YYYY-MM-DDTHH:mm:ss'),
                        currentTime = moment().tz(date.timezone).format('YYYY-MM-DDTHH:mm:ss');

                        $element.html(moment(alertTime).locale(iaSettings.getFormatLanguage()).from(currentTime));
                    }

                    $attrs.$observe('timeAgo', function() {
                        var time = angular.fromJson($attrs.timeAgo);

                        renderTime(time);

                        if (interval) {
                            $interval.cancel(interval);
                        } else {
                            interval = $interval(function() {
                                renderTime(time);
                            }, 60000);
                        }
                    });

                    $scope.$on('$destroy', function() {
                        $interval.cancel(interval);
                    });
                }
            };
        })

         .filter('integerFilter', [function () {
            return function (items, key, reverse) {
                return _.filter(items, function (item, index) {
                    return !reverse ? item.id === key.id : item.id !== key.id;
                });
            };
        }])

         .directive('phoneCode', function($filter, $timeout) {
            return {
                require: 'ngModel',
                restrict: 'A',
                priority: 1,
                link: function(scope, element, attrs, ngModel) {
                    var phoneCode;
                    scope.htmlPhoneCode;
                    ngModel.$render = function() {
                        element.prop('value', ngModel.$viewValue);
                    };

                    scope.$watch(attrs.phoneCode, function (newVal, oldVal) {
                        if(newVal==47 && oldVal==47)
                        {
                            oldVal=0;   // for default phone code in phone number textbox                           
                        }
                        if (angular.isUndefined(newVal)) {
                         return;
                     }

                     var newPhoneCode = $filter('settingsFilter')(newVal, 'countries', 'phonecode');
                     if (newPhoneCode === phoneCode) {
                        return;
                    }

                    var newPhoneCodeString = '+' + newPhoneCode + ' ';

                    if (!angular.isString(ngModel.$modelValue)) {
                        updateValue(newPhoneCodeString);
                    } else if (angular.isString(newPhoneCode)) {

                        if (!_.contains(ngModel.$modelValue, ' ')){
                            newModelValue = newPhoneCodeString;
                        }else{
                            var currentPhoneCode = ngModel.$modelValue.split(" ")[0];
                            var newModelValue = ngModel.$modelValue.replace(new RegExp('^((\\+)|(00))' + currentPhoneCode + ' ?'), newPhoneCodeString);
                            if (ngModel.$modelValue === newModelValue) {

                                newModelValue = ngModel.$modelValue.substr(ngModel.$modelValue.indexOf(' ')+1);
                            }
                        }

                        updateValue(newModelValue);
                    }

                    phoneCode = newPhoneCode;
                    scope.htmlPhoneCode = phoneCode;
                });

                    function updateValue(value) {
                        ngModel.$setViewValue(value);
                        ngModel.$render(); // This actually shouldn't be necessary. What's going on?
                    }
                }
            };
        })

          .directive('phonevarifyCode', function($filter, $timeout) {
            return {
                require: 'ngModel',
                restrict: 'A',
                priority: 1,
                link: function(scope, element, attrs, ngModel) {
                    var phoneCode;

                    ngModel.$render = function() {
                        element.prop('value', ngModel.$viewValue);
                    };

                    scope.$watch(attrs.phonevarifyCode, function (newVal, oldVal) {
                      
                        if(newVal==47 && oldVal==47)
                        {
                            oldVal=0;   // for default phone code in phone number textbox                           
                        }
                       
                        if (angular.isUndefined(newVal)) {
                         return;
                     }
                
                     var newPhoneCode = $filter('settingsFilter')(newVal, 'countries', 'phonecode');
                     if (newPhoneCode === phoneCode) {
                        return;
                    }                   
                    updateValue(ngModel.$modelValue);                    
                    scope.phonecodevalue = '+' + newPhoneCode;
                    phoneCode = newPhoneCode;
                });
                    function updateValue(value) {
                        ngModel.$setViewValue(value);
                        ngModel.$render(); // This actually shouldn't be necessary. What's going on?
                    }
                }
            };
        }) 
           .directive('phonesNumber', [function() {
            return {
                require: '^ngModel',
                restrict: 'A',
                link: function(scope, element, attrs, ctrl) {
                    scope.once =true;
                   // var INTEGER_REGEXP = /\d+$/;
                   //var INTEGER_REGEXP = /^[\d\(\)\- *+]+$/;
                   var INTEGER_REGEXP = /^[\d\(\)\ ?]+$/
                    var tokens = [ ['[',']'] , ['(',')'] ];
                    scope.checkSpaceLength = function(event) {
                        if (!(event.which >= 48 && event.which <= 57 ))  {
                            return event.preventDefault();
                        }
                    }
                    var isBalancedFalse = false;

                    var phNumbera = angular.element(element);

                    for (var i = 0 ; i < phNumbera.length; i++) {
                        phNumbera[i].addEventListener('input', function (e) {
                        e.target.value = e.target.value.replace(/[^\d]/g, '').trim();
                        });
                    }
                    
                    function isBalanced(expr){
                        var holder = [];
                        var openBrackets = ['(','['];
                        var closedBrackets = [')',']'];
                       
                        angular.forEach(expr, function (letter) { 
                           if(openBrackets.includes(letter)){ 
                                            holder.push(letter);
                                        }else if(closedBrackets.includes(letter)){ 
                                            var openPair = openBrackets[closedBrackets.indexOf(letter)]; 
                                            if(holder[holder.length - 1] === openPair){ 
                                                holder.splice(-1,1); 
                                            }else{ 
                                                holder.push(letter);                                   
                                            }
                                        }
                        });  
                        return holder.length === 0 ? isBalancedFalse = false : isBalancedFalse = true;  
                    }

                    ctrl.$validators.phonenumber = function (modelValue, viewValue) {
                        isBalancedFalse = false;
                        if (ctrl.$isEmpty(modelValue)) {

                            return true;
                        }

                        var phNumber = angular.element(element);
                        var target = phNumber.attr('ng-model');

                        if(!_.isNull(modelValue.split(" ")[1])){
                            var valAfterSpace = modelValue.split(" ")[1];
                            if(!_.isNull(valAfterSpace)){
                                isBalanced(valAfterSpace);
                            }
                        }

                        scope.$watch(target, function(newVal, oldVal, el) {
                            //scope.beforeSpaceChar= modelValue.split(" ")[0];
                            //scope.beforeSpaceChar = scope.beforeSpaceChar+ ' ';
                        });

                        scope.cursorPosVal = -1;
                        scope.checkLength = function(event) {

                            var myEl = event.target;
                            scope.once =false;
                            scope.doGetCaretPosition(myEl);
                            angular.element(document).find(".minlenghtherror").removeClass("hide");
                            var selectionStart = scope.cursorPosVal;


                            /*if(event.which === 37 || event.which === 39){
                                return event.preventDefault();
                            }*/

                            if ((event.which != 37 && (event.which != 39))
                                && ((undefined !== scope.beforeSpaceChar && selectionStart < scope.beforeSpaceChar.length)
                                    || ((undefined !== scope.beforeSpaceChar && selectionStart == scope.beforeSpaceChar.length) && (event.which == 8)))) {
                                return event.preventDefault();
                        }

                    }

                    scope.doGetCaretPosition = function(oField) {

                        var iCaretPos = 0;

                                // IE Support
                                if (document.selection) {
                                  oField.focus ();
                                  var oSel = document.selection.createRange ();
                                  oSel.moveStart ('character', -oField.value.length);
                                  iCaretPos = oSel.text.length;
                              }

                                // Firefox support
                                else if (oField.selectionStart || oField.selectionStart == '0')
                                  iCaretPos = oField.selectionStart;
                              scope.cursorPosVal = iCaretPos;
                          };
                          if(scope.once)
                            angular.element(document).find(".minlenghtherror").addClass("hide");
                          return  isBalancedFalse == true ? false : !!INTEGER_REGEXP.test(modelValue);
                      };
                  }
              };
          }])
        .directive('phoneNumber', ['$rootScope',function($rootScope) {
            return {
                require: '^ngModel',
                restrict: 'A',
                link: function(scope, element, attrs, ctrl) {

                   // var INTEGER_REGEXP = /\d+$/;
                   var INTEGER_REGEXP = /^[\d\(\)\ ?]+$/;
                    var tokens = [ ['[',']'] , ['(',')'] ];
                    scope.checkSpaceLength = function(event) {
                        $rootScope.phonenumberalreadyused = false;
                        if (!(event.which >= 48 && event.which <= 57 ) )  {
                            return event.preventDefault();
                        }
                    }
                    var isBalancedFalse = false;
                    var phNumbera = angular.element(element);

                    for (var i = 0 ; i < phNumbera.length; i++) {
                        phNumbera[i].addEventListener('input', function (e) {
                        e.target.value = e.target.value.replace(/[^\d]/g, '').trim();
                        });
                    }
                    
                    function isBalanced(expr){
                        var holder = [];
                        var openBrackets = ['(','['];
                        var closedBrackets = [')',']'];
                       
                        angular.forEach(expr, function (letter) { 
                           if(openBrackets.includes(letter)){ 
                                            holder.push(letter);
                                        }else if(closedBrackets.includes(letter)){ 
                                            var openPair = openBrackets[closedBrackets.indexOf(letter)]; 
                                            if(holder[holder.length - 1] === openPair){ 
                                                holder.splice(-1,1); 
                                            }else{ 
                                                holder.push(letter);                                   
                                            }
                                        }
                        });  
                        return holder.length === 0 ? isBalancedFalse = false : isBalancedFalse = true;  
                    }

                    ctrl.$validators.phonenumber = function (modelValue, viewValue) {
                        isBalancedFalse = false;
                        $rootScope.phonenumberalreadyused = false;
                        if (ctrl.$isEmpty(modelValue)) {

                            return true;
                        }

                        var phNumber = angular.element(element);
                        var target = phNumber.attr('ng-model');

                        if(!_.isNull(modelValue)){
                            var valAfterSpace = modelValue;
                            if(!_.isNull(valAfterSpace)){
                                isBalanced(valAfterSpace);
                            }
                            else{
                                scope.isphonenumber = false;
                            }   
                        }

                        scope.$watch(target, function(newVal, oldVal, el) {
                            scope.beforeSpaceChar= modelValue.split(" ")[0];
                            scope.beforeSpaceChar = scope.beforeSpaceChar+ ' ';
                           
                        });

                        scope.cursorPosVal = -1;
                        scope.checkLength = function(event) {

                            var myEl = event.target;
                            scope.doGetCaretPosition(myEl);  

                            var selectionStart = scope.cursorPosVal;


                           /* if(event.which === 37 || event.which === 39){
                                return event.preventDefault();
                            } */

                    }

                    scope.doGetCaretPosition = function(oField) {

                        var iCaretPos = 0;

                                // IE Support
                                if (document.selection) {
                                  oField.focus ();
                                  var oSel = document.selection.createRange ();
                                  oSel.moveStart ('character', -oField.value.length);
                                  iCaretPos = oSel.text.length;
                              }

                                // Firefox support
                                else if (oField.selectionStart || oField.selectionStart == '0')
                                  iCaretPos = oField.selectionStart;
                              scope.cursorPosVal = iCaretPos;
                          };
                       
                          return  isBalancedFalse == true ? false : !!INTEGER_REGEXP.test(modelValue);
                      };
                  }
              };
          }])
        
        .directive('phoneNumberCheck', ['$rootScope',function($rootScope) {
            return {
                require: '^ngModel',
                restrict: 'A',
                link: function(scope, element, attrs, ctrl) {
                    console.log('changes');
                        //var INTEGER_REGEXP = /\d+$/;
                        var INTEGER_REGEXP = /^[\d\(\)\ ?]+$/;
                    var tokens = [ ['[',']'] , ['(',')'] ];
                    scope.checkSpaceLength = function(event) {
                        $rootScope.phonenumberalreadyused = false;
                        if (!(event.which >= 48 && event.which <= 57 ) )  {
                            return event.preventDefault();
                        }
                    }
                    var isBalancedFalse = false;
                    
                    var phNumbera = angular.element(element);

                    for (var i = 0 ; i < phNumbera.length; i++) {
                        phNumbera[i].addEventListener('input', function (e) {
                        e.target.value = e.target.value.replace(/[^\d]/g, '').trim();
                        });
                    }

                    function isBalanced(expr){
                        var holder = [];
                        var openBrackets = ['(','['];
                        var closedBrackets = [')',']'];
                       
                        angular.forEach(expr, function (letter) { 
                           if(openBrackets.includes(letter)){ 
                                            holder.push(letter);
                                        }else if(closedBrackets.includes(letter)){ 
                                            var openPair = openBrackets[closedBrackets.indexOf(letter)]; 
                                            if(holder[holder.length - 1] === openPair){ 
                                                holder.splice(-1,1); 
                                            }else{ 
                                                holder.push(letter);                                   
                                            }
                                        }
                        });  
                        return holder.length === 0 ? isBalancedFalse = false : isBalancedFalse = true;  
                    }

                    ctrl.$validators.phonenumber = function (modelValue, viewValue) {
                        isBalancedFalse = false;
                       
                        $rootScope.phonenumberalreadyused = false;
                        if (ctrl.$isEmpty(modelValue)) {

                            return true;
                        }
                    
                        var phNumber = angular.element(element);
                        var target = phNumber.attr('ng-model');
                        
                        if(!_.isNull(modelValue)){
                            var valAfterSpace = modelValue;

                            if(!_.isNull(valAfterSpace)){
                                isBalanced(valAfterSpace);
                            }
                            else{
                                scope.isphonenumber = false;
                            }   
                        }

                        scope.$watch(target, function(newVal, oldVal, el) {
                            scope.beforeSpaceChar= modelValue.split(" ")[0];
                            scope.beforeSpaceChar = scope.beforeSpaceChar+ ' ';
                           
                        });

                        scope.cursorPosVal = -1;
                        scope.checkLength = function(event) {

                            var myEl = event.target;
                            scope.doGetCaretPosition(myEl);  

                            var selectionStart = scope.cursorPosVal;


                            /*if(event.which === 37 || event.which === 39){
                                return event.preventDefault();
                            }*/

                    }

                    scope.doGetCaretPosition = function(oField) {

                        var iCaretPos = 0;

                                // IE Support
                                if (document.selection) {
                                  oField.focus ();
                                  var oSel = document.selection.createRange ();
                                  oSel.moveStart ('character', -oField.value.length);
                                  iCaretPos = oSel.text.length;
                              }

                                // Firefox support
                                else if (oField.selectionStart || oField.selectionStart == '0')
                                  iCaretPos = oField.selectionStart;
                              scope.cursorPosVal = iCaretPos;
                          };

                          return  isBalancedFalse == true ? false : !!INTEGER_REGEXP.test(modelValue);
                      };
                  }
              };
          }])

         .directive('fullPhoneNumber', function($filter) {
            return {
                restrict: 'EA',
                scope: {
                    phonecode: '=',
                    phonenumber: '='
                },
                 link: function(scope, element, attrs, ngModel) {

                    // This function is because Account API's delay doest not refresh the value of HTML. It can be replace with waych function 
                   setTimeout(function(){  
                        scope.$apply(function() {
                            if(scope.phonecode){
                                if(scope.phonenumber.indexOf('+') ==-1){ 
                                    scope.fullnumberdetails = '+' +  $filter('settingsFilter')(scope.phonecode, 'countries', 'phonecode')+' ' +scope.phonenumber ;
                                }
                                else{
                                    scope.fullnumberdetails = scope.phonenumber ;
                                }
                            }
                    }); }, 2000);

                    scope.$watch(attrs.phonecode, function (newVal, oldVal) {
                    if(scope.phonecode){
                        if(scope.phonenumber.indexOf('+') ==-1){ 
                            scope.fullnumberdetails = '+' +  $filter('settingsFilter')(scope.phonecode, 'countries', 'phonecode')+' ' +scope.phonenumber ;
                        }
                        else{
                            scope.fullnumberdetails = scope.phonenumber ;
                        }
                    }
                    else{
                        scope.fullnumberdetails = null;
                    }
                    });
                 },
                template: '<a class="phone_code_mobile" ng-if="phonenumber" href="tel:{{fullnumberdetails}}"><span class="full-phone-number">{{ fullnumberdetails }}</span></a>'
            };
        })

        .directive('checkphoneCode', function($filter, $timeout) {
            return {
                require: 'ngModel',
                restrict: 'A',
                priority: 1,
                link: function(scope, element, attrs, ngModel) {
                    var phoneCode;
                    
                    ngModel.$render = function() {
                        element.prop('value', ngModel.$viewValue);
                    };

                    scope.$watch(attrs.checkphoneCode, function (newVal, oldVal) {
                       if(newVal ==null || newVal ==0 || _.isUndefined(newVal)){
                        scope.newPhoneCodeVal='';
                        
                        return false;
                       }
                      
                        scope.newPhoneCodeVal ='+' +  $filter('settingsFilter')(newVal, 'countries', 'phonecode');
                    });                     
                },
                template: '{{ newPhoneCodeVal }}'
            };
        })

        .directive('exportToCsv',function(){
            return {
              restrict: 'A',
              link: function (scope, element, attrs) {
                  var el = element[0];
                  element.on('click', function(e){
                      //var table = e.target.nextElementSibling.firstChild.nextSibling.nextSibling.firstChild.nextSibling.nextElementSibling;
                      //var header = e.target.nextElementSibling.firstChild.nextSibling.nextSibling.firstChild.nextSibling;
                      var table = e.target.nextElementSibling;
                      //console.log(header);
                      var csvString = '';

                      // header download
                      /*for(var i=0; i<header.rows.length;i++){
                        var rowData = header.rows[i].cells;
                        for(var j=0; j<rowData.length;j++){
                            csvString = csvString + rowData[j].innerHTML + ",";
                        }
                        csvString = csvString.substring(0,csvString.length - 1);
                        csvString = csvString + "\n";
                        }*/
                      // rows download
                      for(var i=0; i<table.rows.length;i++){
                          var rowData = table.rows[i].cells;
                          for(var j=0; j<rowData.length;j++){
                              csvString = csvString + rowData[j].innerText + ",";
                          }
                          csvString = csvString.substring(0,csvString.length - 1);
                          csvString = csvString + "\n";
                      }
                       csvString = csvString.substring(0, csvString.length - 1);
                       var a = $('<a/>', {
                          style:'display:none',
                          href:'data:application/octet-stream;base64,'+btoa(csvString),
                          download:'Results.csv'
                      }).appendTo('body')
                      a[0].click()
                      a.remove();
                  });
              }
            }
          })

        .directive('checkphoneCodePersonal', function($filter, $timeout) {
            return {
                require: 'ngModel',
                restrict: 'A',
                priority: 1,
                link: function(scope, element, attrs, ngModel) {
                    var phoneCode1;
                    ngModel.$render = function() {
                        element.prop('value', ngModel.$viewValue);
                    };
                    scope.$watch(attrs.checkphoneCodePersonal, function (newVal, oldVal) {
                       if( newVal ==null || newVal ==0 || _.isUndefined(newVal)){
                        scope.newPhoneCodeValnew='';

                        return false;
                       }
                       
                        scope.newPhoneCodeValnew ='+' +  $filter('settingsFilter')(newVal, 'countries', 'phonecode');
                    });
                },
                template: '{{ newPhoneCodeValnew }}'
            };
        })
         .directive('fullAddress', function($filter, iaAddress) {
            return {
                restrict: 'EA',
                scope: {
                    building: '=',
                    street:'=',
                    district: '=',
                    city: '=',
                    state: '=',
                    postal: '=',
                    country: '='
                },
                link: function (scope){
                    scope.building = angular.isUndefined(scope.building) ? '' : scope.building;
                    scope.street = angular.isUndefined(scope.street) ? '' : scope.street;
                    scope.district = angular.isUndefined(scope.district) ? '' : scope.district;
                    scope.city = angular.isUndefined(scope.city) ? '' : scope.city;
                    scope.state = angular.isUndefined(scope.state) ? '' : scope.state;
                    scope.postal = angular.isUndefined(scope.postal) ? '' : scope.postal;
                    scope.country = angular.isUndefined(scope.country) ? '' : _.isNumber(scope.country) ? $filter('countryFilter')(scope.country, 'name') : scope.country;
                    scope.personalAddress = iaAddress.personalAddress(scope.building, scope.street, scope.district, scope.city, scope.state,scope.postal, scope.country);
                },
                template: '<span>{{ personalAddress }}</span>'
            };
        })

         .directive('fullDate', function($filter) {
            return {
                restrict: 'EA',
                scope: {
                    year: '=',
                    month: '=',
                    day: '='
                }, link: function (scope){
                    scope.fullDate = _.compact([scope.year, scope.month, scope.day]).join('-');

                    setTimeout(function(){  
                        scope.$apply(function() {
                            scope.fullDate = _.compact([scope.year, scope.month, scope.day]).join('-');
                    }); }, 2000);

                },
                template: '<span id="full-date">{{ fullDate }}</span>'
            };
        })


         .directive('iaGoEmail', ['$log', '$filter', 'locale', function ($log, $filter, locale) {
            return {
                restrict: 'E',
                replace: true,
                template: '<a open-in-app-browser ng-href="{{address.url}}?external=1" target="_blank">{{emailText}}</a>',
                scope: {
                    ngModel: '=ngModel'
                },
                link: function (scope) {
                    var blankAddress = 'http://about:blank';
                    scope.address = $filter('emailAddress')(scope.ngModel);

                    var emailTextToken = _.isObject(scope.address) ? 'common.goTo' : 'common.goToMyEmail';

                    if (locale.isToken(emailTextToken)) {
                        locale.ready(locale.getPath(emailTextToken)).then(function () {
                            var text = locale.getString(emailTextToken, {});

                            scope.emailText = _.isObject(scope.address) ? text + scope.address.domain : text;

                            if (scope.address === null) {
                                scope.address = {
                                    url : blankAddress
                                };
                            }
                        });
                    }
                }
            };
        }])

         .directive('ngFile', ['fileUpload', function (fileUpload) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                replace: true,
                link: function (scope, elem, attrs, ctrl) {
                    var model, result, file;
                    scope.uploadFileFun = function(callID) {
                    scope.calledID = callID;
                   };

                    scope.delete = function(info){
                        
                        var track = info.x.track;
                        if(track =='living_will'){
                            var file = scope.member.additional_information.records.living_will.document.split(',');
                            file.splice(info.$index, 1);
                            scope.member.additional_information.records.living_will.document = file.toString();
                        }else if(track =='organ_donor'){
                            var file = scope.member.additional_information.medical.organ_donor.card.split(',');
                            file.splice(info.$index, 1);
                            scope.member.additional_information.medical.organ_donor.card = file.toString();
                        }else if(track =='covid' || track == 'immunization' || track == 'allergy' || track == 'medication' || track == 'medical_condition' || track == 'surgical' || track == 'insurance' ){
                            var file = scope[track].document.split(',');
                            file.splice(info.$index, 1);
                            scope[track].document = file.toString();
                        }else{
                            var file = scope[track].file.split(',');
                            file.splice(info.$index, 1);
                            scope[track].file = file.toString();
                        }
                        
                       
                    }

                    elem.on('change', function (event) {
                        scope.spinner=true;
                        file = (event.srcElement || event.target).files[0];
                        //(event.srcElement || event.target).files[0] = '';
                        // Change file status back
                        scope.$apply(function () {
                            ctrl.$setPristine();
                            ctrl.$setValidity('filesize', true);
                        });

                            scope.errors = [];
                            var largesize = false;
                            var isImage = /^(image)\//i.test(file.type);

                        // Change file status back

                        if (file) {

                            var maxSize = attrs.maxSize ? attrs.maxSize : Config.MaxFileSize;

                            // Stop file upload when exceed the maximal file size.
                            if (!isImage  && file.size > (maxSize * 1024)) {

                                event.preventDefault();
                                scope.$apply(function () {
                                    ctrl.$setValidity('filesize', false);
                                });
                                return;
                               
                            }

                            if( isImage  && file.size > (maxSize * 1024)) {
                                    console.log('An image is compressing');
                                    
                                    var reader = new FileReader();
                                    reader.onload = function (readerEvent) {
                                        var image = new Image();
                                        
                                        image.onload = function (imageEvent) {

                                            // Resize the image
                                            var canvas = document.createElement('canvas'),
                                                max_size = 544,// TODO : pull max size from a site config
                                                width = image.width,
                                                height = image.height;
                                            if (width > height) {
                                                if (width > max_size) {
                                                    height *= max_size / width;
                                                    width = max_size;
                                                }
                                            } else {
                                                if (height > max_size) {
                                                    width *= max_size / height;
                                                    height = max_size;
                                                }
                                            }
                                            canvas.width = width;
                                            canvas.height = height;
                                            canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                                            var dataUrl = canvas.toDataURL('image/jpeg');
                                            var resizedImage = dataURLToBlob(dataUrl);
                                            resizedImage.lastModifiedDate = new Date();
                                            resizedImage.name = 'fileName.jpg';
                                            
                                            $.event.trigger({
                                                type: "imageResized",
                                                blob: resizedImage,
                                                url: dataUrl,
                                                name:'test'
                                            });

                                            var compressedFile = new File([resizedImage], "name.jpg");
                                           
                                            // Upload file.
                                            fileUpload.upload(compressedFile, attrs.name,scope.calledID).then(
                                                function (res) {
                                                    model = attrs.model.split('.') || [];

                                                    result = scope;

                                                    for (var i = 0; i < model.length; i++) {
                                                        if (typeof result[model[i]] === 'undefined') {
                                                            result[model[i]] = {};
                                                        }

                                                        result = result[model[i]];
                                                    }

                                                    //result[attrs.name] = res.data.url;
                                                    if(result[attrs.name] == '' || typeof result[attrs.name] === 'undefined' || result[attrs.name] == 'null' || result[attrs.name] == null){
                                                        result[attrs.name] = res.data.url;
                                                    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                                    else{
                                                        result[attrs.name] = result[attrs.name]+','+res.data.url;
                                                    }
                                                    scope.spinner=false;
                                                }, function(err){
                                                    errors = [];
                                                    errors.push(err.data.error);
                                                    scope.errors = errors;
                                                    scope.spinner=false;
                                                });
                                        }
                                        image.src = readerEvent.target.result;
                                    }
                                    reader.readAsDataURL(file);
                                }else{
                                            // Upload file.
                                            fileUpload.upload(file, attrs.name,scope.calledID).then(
                                                function (res) {
                                                    model = attrs.model.split('.') || [];

                                                    result = scope;

                                                    for (var i = 0; i < model.length; i++) {
                                                        if (typeof result[model[i]] === 'undefined') {
                                                            result[model[i]] = {};
                                                        }

                                                        result = result[model[i]];
                                                    }

                                                    //result[attrs.name] = res.data.url;
                                                    if(result[attrs.name] == '' || typeof result[attrs.name] === 'undefined' || result[attrs.name] == 'null' || result[attrs.name] == null){
                                                        result[attrs.name] = res.data.url;
                                                    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                                    else{
                                                        result[attrs.name] = result[attrs.name]+','+res.data.url;
                                                    }
                                                    scope.spinner=false;
                                                }, function(err){
                                                    errors = [];
                                                    errors.push(err.data.error);
                                                    scope.errors = errors;
                                                    scope.spinner=false;
                                                });
                                }

                                var dataURLToBlob = function(dataURL) {
                                var BASE64_MARKER = ';base64,';
                                if (dataURL.indexOf(BASE64_MARKER) == -1) {
                                    var parts = dataURL.split(',');
                                    var contentType = parts[0].split(':')[1];
                                    var raw = parts[1];

                                    return new Blob([raw], {type: contentType,name: "test.jpeg"});
                                }
                                var parts = dataURL.split(BASE64_MARKER);
                                var contentType = parts[0].split(':')[1];
                                var raw = window.atob(parts[1]);
                                var rawLength = raw.length;

                                var uInt8Array = new Uint8Array(rawLength);

                                for (var i = 0; i < rawLength; ++i) {
                                    uInt8Array[i] = raw.charCodeAt(i);
                                }
                                return new Blob([uInt8Array], {type: contentType,name: "test.jpeg"});
                            }
                        }
                    });
                },
                template: '<input type="file" class="no-uniform">'
            };
        }])

         .service('fileUpload', ['$rootScope','$http', '$q', 'API_BASE', function ($rootScope, $http,  $q, API_BASE) {
            var upload = function (file, type,calledID) {

                var deferred = $q.defer();

                var fd = new FormData();
                fd.append('file', file);
                $rootScope.ifileloader = true;
                $("#"+calledID).addClass("fa fa-spinner fa-spin");
                $http.post(API_BASE + '/upload?type='+type, fd, {
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined}
                }).then(
                function (res) {
                    $rootScope.ifileloader= false;
                    $("#"+calledID).removeClass("fa fa-spinner fa-spin");
                    deferred.resolve(res);
                }, function (error) {
                    $rootScope.ifileloader= false;
                    $("#"+calledID).removeClass("fa fa-spinner fa-spin");
                    deferred.reject(error);
                });

                return deferred.promise;
            };

            return {
                upload: upload
            };
        }])

          .directive('ngCsvFile', ['partnerCsvFileUpload','Account','$rootScope', function (partnerCsvFileUpload,Account,$rootScope) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                replace: true,
                link: function (scope, elem, attrs, ctrl) {
                    var model, result, file;
                    elem.on('change', function (event) {
                    	// set false all errors
                    	scope.csvErrors = [];
                    	scope.showCsvFileError = false;
                    	scope.showExceedError =false;
                    	scope.showEmptyFileError =false;
                     $rootScope.redirecting = true; // Hide full screen loader
                    
                     file = (event.srcElement || event.target).files[0];

								var sFileName = file.name;
       						var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
      					
      						if(sFileExtension!=="csv")
      						{
       							scope.showCsvFileError = true;
         						return ;
       						}                        
                        
                        $(this).prop("value", "")
                        // Change file status back
                        scope.$apply(function () {
                            ctrl.$setPristine();
                            ctrl.$setValidity('filesize', true);
                        });

                        scope.errors = [];

                        // Change file status back

                        if (file) {

                        var maxSize = attrs.maxSize ? attrs.maxSize : Config.MaxFileSize;

                        // Stop file upload when exceed the maximal file size.
                        if (file.size > (maxSize * 1024)) {
                        	event.preventDefault();
                           scope.$apply(function () {
                           	ctrl.$setValidity('filesize', false);
                           });
                        scope.showExceedError =true;
                        	return;
                        }

                        // Stop file upload when file is empty.
                        if (file.size < 1) {
                        	event.preventDefault();
                           scope.$apply(function () {
                           	ctrl.$setValidity('filesize', false);
                           });
                        scope.showEmptyFileError =true;
                        return;
                        }
                            
                        scope.csvUploadLoading = true;
                    	scope.showWaitingText = true;

                        // Upload file.
                        partnerCsvFileUpload.upload(file, attrs.name).then(
                        	function (res) {
                           	model = attrs.model.split('.') || [];
                              result = scope;
                              scope.visiblemodel = true;
                              for (var i = 0; i < model.length; i++) {
                                 if (typeof result[model[i]] === 'undefined') {
                                     result[model[i]] = {};
                                  }
	                                result = result[model[i]];
                               }

                                $('#CsvResult').modal('show');	
        						       Account.getFriends().then(function(friends) {
           								  friends.contacts.forEach(function(friend){
               						  friend.fullDate =  _.compact([friend.birth_date.year, friend.birth_date.month, friend.birth_date.day]).join('-');
                   				 });
                  					$rootScope.friends = friends;
                  					$rootScope.redirecting = false;
             					 	});

                                  if(res.data.failed.length>0){ 
                                  	 var errors = [];
                                     res.data.failed.forEach(function(item){
                                     errors.push(item);
                                     })
                                     scope.csvErrors = errors;
                                  }
                              scope.createdRecords=res.data.created; 
                                  scope.csvUploadLoading = false;
                                  scope.showWaitingText = false;
                                  }, function(err){
                                       errors = [];
                                       errors.push(err.data.error);
                                       scope.errors = errors;
                                   });
                        }
                    });
                },
                template: '<input type="file" class="no-uniform">'
            };
        }])
        
          .directive('ngCsvFileMember', ['partnerCsvFileUpload','Account','$rootScope', '$timeout','$modal', function (partnerCsvFileUpload,Account,$rootScope,$timeout, $modal) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                replace: true,
                link: function (scope, elem, attrs, ctrl) {
                    var model, result, file;
                    elem.on('change', function (event) {
                        // set false all errors
                        scope.csvPartnerMemberErrors = [];
                        scope.showCsvFileError = false;
                        scope.showExceedError =false;
                        scope.wrongFile = false;
                        scope.showEmptyFileError =false;
                        $rootScope.redirecting = true; // Hide full screen loader
                        $rootScope.csvUpLoading = true;
                     file = (event.srcElement || event.target).files[0];

                                var sFileName = file.name;
                            var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
                        
                            if(sFileExtension!=="csv")
                            {
                                scope.showCsvFileError = true;
                                return ;
                            }                        
                        
                        $(this).prop("value", "")
                        // Change file status back
                        scope.$apply(function () {
                            ctrl.$setPristine();
                            ctrl.$setValidity('filesize', true);
                        });

                        scope.errors = [];

                        // Change file status back

                        if (file) {

                        var maxSize = attrs.maxSize ? attrs.maxSize : Config.MaxFileSize;

                        // Stop file upload when exceed the maximal file size.
                        if (file.size > (maxSize * 1024)) {
                            event.preventDefault();
                           scope.$apply(function () {
                            ctrl.$setValidity('filesize', false);
                           });
                        scope.showExceedError =true;
                            return;
                        }

                        // Stop file upload when file is empty.
                        if (file.size < 1) {
                            event.preventDefault();
                           scope.$apply(function () {
                            ctrl.$setValidity('filesize', false);
                           });
                        scope.showEmptyFileError =true;
                        return;
                        }
                            
                        scope.csvMemberUploadLoading = true;
                        scope.showMemberWaitingText = true;

                        // Upload file.
                        partnerCsvFileUpload.upload(file, attrs.name).then(
                            function (res) {
                                $rootScope.csvUpLoading = false;
                                //model = attrs.model.split('.') || [];
                              //result = scope;
                              //scope.visiblemodel = true;
                              /*for (var i = 0; i < model.length; i++) {
                                 if (typeof result[model[i]] === 'undefined') {
                                     result[model[i]] = {};
                                  }
                                    result = result[model[i]];
                               } */

                                  //$('#CsvMemberResult').modal('show'); 

                                   if(res.data.type=='Success'){
                                       scope.createdMemberRecords= res.data.data.created;                                       
                                       if(res.data.data.failed.length>0){ 
                                        var errors = [];
                                        res.data.data.failed.forEach(function(item){
                                        errors.push(item);
                                        })
                                        scope.csvPartnerMemberErrors = errors;
                                     }
                                    }

                                    if(res.data.type=='ExceedLimit'){
                                        scope.createdMemberRecords= res.data.data.created;
                                        scope.limitexceed = true;
                                        scope.limitexceedmessage = res.data.data.message;
                                    }

                                    if(res.data.type=='ValidationException'){
                                        scope.createdMemberRecords= 0;
                                        scope.wrongFile = true;
                                        scope.wrongFilemessage = res.data.data.message;
                                    }

                                    var modalInstance = $modal.open({
                                        backdrop: false,
                                        backdropClick: false,
                                        dialogFade: false,
                                        keyboard: true,
                                        size: attrs.size,
                                        templateUrl: 'partials/modal/ptncsv.html',
                                        scope: scope,
                                        controller: function () {
                                            scope.cancel = function () {
                                                modalInstance.close();
                                            };                           
                                        }
                                    });


                                    Account.getFriends().then(function(friends) {
                                        friends.contacts.forEach(function(friend){
                                      friend.fullDate =  _.compact([friend.birth_date.year, friend.birth_date.month, friend.birth_date.day]).join('-');
                                    });
                                    $rootScope.friends = friends;
                                    $rootScope.redirecting = false;
                                    }); 

                                  
                                   //scope.createdMemberRecords=res.data.created; 
                                   scope.csvMemberUploadLoading = false;
                                   scope.showMemberWaitingText = false;
                                   
                                   sessionStorage.setItem("refreshAccountDetails", true);
                                   Account.get().then(function(res){                                                                        
                                       $rootScope.partner_ice_id = res;   
                                    });

                                  }, function(err){
                                    $rootScope.csvUpLoading = false;
                                       var errors = [];
                                       errors.push(err.data.error);
                                       scope.errors = errors;
                                   });                               
                        }
                    });
                },
                template: '<input type="file" class="no-uniform">'
            };
        }])

          .service('partnerCsvFileUpload', ['Restangular', '$q', '$rootScope','$http', function (Restangular, $q, $rootScope, $http) {
            var upload = function (file, type) {

                var deferred = $q.defer();

                var fd = new FormData();
                fd.append('csvfile', file);

                $http.post(Config.API_BASE+'/partners/account/upload?Content-Type=application/x-www-form-urlencoded&X-Authorization='+$rootScope.apiKey, fd, {
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined}
                }).then(
                function (res) {
                    deferred.resolve(res);
                }, function (error) {
                    deferred.reject(error);
                });

                return deferred.promise;
            };

            return {
                upload: upload
            };
        }])

         .directive('img', ['CDN_BASE', function (CDN_BASE) {
            return {
                restrict: 'E',
                link: function (scope, element, attrs) {
                    // show an image-missing image
                    element.error(function () {
                        var w = element.width();
                        var h = element.height();

                        // after this error function has been called
                        var url = _.contains(attrs.ngShow,'photo') || _.contains(attrs.ngSrc,'photo')  ?
                        CDN_BASE+'static/images/avatar.png' : '';

                        element.prop('src', url);
                        element.css('border', 'double 1px #7b7b7b');
                    });
                }
            };
        }])

         .directive('iceangelIdDownload', ['API_BASE', 'Auth', function (API_BASE, Auth) {
            return {
                restrict: 'EA',
                replace: true,
                scope: {
                    member: '=model'
                },
                link: function (scope, elem, attrs) {
                    scope.token = Auth.getToken();
                    scope.API_BASE = API_BASE;
                },
                template: '<a download="iceangel_id.pdf" class="btn btn-primary btn-lg btn-block btn-web" ng-href="{{API_BASE}}/pdf/print/iceangel_id/{{member.id}}?token={{token}}">Download PDF</a>'
            };
        }])

         .directive('ecpExist', ['$filter', function ($filter) {
            return {
                restrict: 'A',
                scope: {
                    member: '=',
                    account: '='
                },
                
                link: function (scope, elem, attrs) {

                    scope.exist = !_.isEmpty($filter('filter')(scope.account.members[0].contacts, {id: scope.account.id}));

                    if (scope.exist) {
                        elem.addClass('hide');
                    }
                }
            };
        }])

         .directive('twitterFollowButton', ['$timeout', function ($timeout) {

            return {
                restrict: 'AE',
                scope: {
                    screenName: '@'
                },
                link: link,
                templateUrl: 'partials/directives/twitter-follow-button.html'
            };

            function link(scope, elem, attrs) {
                elem.on('click', function (event) {
                    window.open('https://twitter.com/intent/follow?screen_name=' + attrs.screenName + '&tw_p=followbutton', '_blank');
                });
            }

        }])

         .directive('fixHeaderPosition', ['$document', '$window', function ($document, $window) {
            return function (scope, elem, attrs) {

                var header;

                function getHeader() {
                    return header || (header = angular.element('.tab-mobile'));
                }

                elem.on('focus', 'input, select, textarea', function (e) {
                    if ($window.scrollY > 0) {
                        getHeader().addClass('fix-header');
                    }
                });

                elem.on('blur', 'input, select, textarea', function (e) {
                    getHeader().removeClass('fix-header');
                });

                $document.on(
                        "click",
                        function( event ){
                            var clickover = $(event.target);
                            var _opened = $("#demo3").hasClass("collapse in");
                            var _openedSubMenu = $("#MenuLvl1").hasClass("collapse in");
                            
                            if (_opened === true && !clickover.hasClass("dropdown-toggle main-link collapse") && clickover.context.id !="dropdownMenuButtonDsk1") {
                                $("a.dropdown-toggle").click();
                                if(_openedSubMenu===true){
                                    $("a#dropdownMenuButtonDsk1").click()
                                }
                            }
                        }
                );

            };
        }])

         .directive('iaLabelMain', ['$compile', function ($compile) {
            return {
                restrict: 'A',
                scope: {
                    message: '@',
                    translation: '@'
                },
                link: function (scope, element, attrs) {
                    element.addClass('ia-label');

                    var translation = $compile('<span class="ia-label-text" i18n="{{ translation }}"></span>')(scope);
                    element.append(translation);

                    if (attrs.required !== undefined) {
                        element.append('<span class="ia-label-require"><i class="icon-star_icon"></i></span>');
                    }

                    if (attrs.message) {

                        var tooltip = $compile('<a class="ia-label-tooltip-icon-container" tooltip="" data-i18n-attr="{ tooltip: \'{{ message }}\' }" ng-show="message"><i class="ia-label-tooltip-icon icon-question_icon"></i></a>')(scope);
                        element.append(tooltip);
                    }
                }
            };
        }])

         .directive('iaLabel', ['$compile', function ($compile) {
            return {
                restrict: 'A',
                scope: {
                    message: '@',
                    translation: '@'
                },
                link: function (scope, element, attrs) {
                    element.addClass('ia-label');

                    var translation = $compile('<span class="ia-label-text" i18n="{{ translation }}"></span>')(scope);
                    element.append(translation);

                    if (attrs.required !== undefined) {
                        element.append('<span class="ia-label-require"><i class="icon-star_icon"></i></span>');
                    }

                    if (attrs.message) {

                        var tooltip = $compile('<a class="ia-label-tooltip-icon-container" ng-click = "tooltipToggle();" tooltip="" data-i18n-attr="{ tooltip: \'{{ message }}\' }" ng-show="message"><i class="fa fa-question-circle" aria-hidden="true"></i></a>')(scope);
                        element.append(tooltip);
                    }

                    scope.tooltipToggle = function(){
                       if (jQuery.browser && jQuery.browser.mobile){
                        var elem = $('.tooltip');
                        if(elem.hasClass('in')){
                            elem.removeClass('in');
                        }
                        else{
                            elem.addClass('in');
                        }
                    }
                }

            }
        };
    }])

         .directive('localeLink', ['$compile', function ($compile) {
            return {
                restrict: 'A',
                scope: {
                    content: '@'
                },
                link: function (scope, element, attrs) {
                  /*  element.addClass('terms-link');*/

                    scope.$watch('content', function () {
                        if (!scope.content) {
                            return;
                        }

                        var result = '<div>' + scope.content + '</div>';
                        result = $compile(result)(scope);
                        element.html(result);
                    });
                }
            };
        }])

         .directive('disableAnimation', function($animate){
            return {
                restrict: 'A',
                link: function($scope, $element, $attrs){
                    $attrs.$observe('disableAnimation', function(value){
                        $animate.enabled(!value, $element);
                    });
                }
            };
        }) 

         .directive('attachment', ['MEDIA_BASE', 'CDN_BASE','$rootScope', function (MEDIA_BASE, CDN_BASE, $rootScope) {
            return { 
                restrict: 'EA',
                replace: true,
                scope: {
                    file: '=file'
                },
                link: function(scope, elem, attrs) {
                    scope.$watch('file', function() {
                        if(navigator.userAgent.toLowerCase().match(/MicroMessenger/i) == "micromessenger"){
                            $rootScope.isWeChat = true;
                        }else
                        {
                            $rootScope.isWeChat = false;
                        }
                        if (scope.file == '' || scope.file == null){
                            scope.url = '';
                            scope.url_arr = [];
                        }else{
                            //scope.url = scope.file.replace(CDN_BASE+'media/', MEDIA_BASE);
                            var file_path = scope.file.split(',');
                            scope.url_arr = [];
                            for(var count=0;count<file_path.length;count++){
                               // scope.url_arr.push(file_path[count].replace(CDN_BASE+'media/', MEDIA_BASE));
                                
                               var record = [];
                               if(typeof scope.$parent.emergency_message !== 'undefined'){
                                   var track = 'emergency_message';
                                   
                               }
                               else if(typeof scope.$parent.hospital_record !== 'undefined'){
                                   var track = 'hospital_record';   
                               }
                               else if(typeof scope.$parent.livingWillForm !== 'undefined'){
                                   var track = 'living_will';
                               } else if(typeof scope.$parent.OrganDonorForm !== 'undefined'){
                                var track = 'organ_donor';
                               }else if(typeof scope.$parent.covid !== 'undefined'){
                                var track = 'covid';
                               }else if(typeof scope.$parent.immunization !== 'undefined'){
                                var track = 'immunization';
                               }else if(typeof scope.$parent.allergy !== 'undefined'){
                                var track = 'allergy';
                               }else if(typeof scope.$parent.medication !== 'undefined'){
                                var track = 'medication'; 
                               }else if(typeof scope.$parent.insuranceForm !== 'undefined'){
                                var track = 'insurance'; 
                               }else if(typeof scope.$parent.medical_condition !== 'undefined'){
                                var track = 'medical_condition'; 
                               }else if(typeof scope.$parent.surgical !== 'undefined'){
                                var track = 'surgical'; 
                               }else{
                                   var track = '';
                               }
                               record = {"track":track,"link":file_path[count].replace(CDN_BASE+'media/', MEDIA_BASE+'media/')};
                               scope.url_arr.push(record);
                            }
                        }
                    });
                },
                templateUrl: 'partials/member/attachment.html'
            };
        }])

         .filter('formatRowResult', function() {
            return function(input, key) {

                if (!input) { return; }
                var formattedResults = [];

                angular.forEach(input, function (element, key) {
                    key = (key%2 === 0) ? key/2 : (key-1)/2;

                    if (angular.isUndefined(formattedResults[key])) {
                        formattedResults[key] = [];
                    }

                    formattedResults[key].push(element);
                });

                return formattedResults;

            };
        })

        .filter('beginning_data', function() {
            return function(input, begin) {
                if (input) {
                    begin = +begin;
                    return input.slice(begin);
                }
                return [];
            }
        })

         .directive('clearfix', function() {
            return {
                restrict: 'EA',
                link: function(scope, element, attr) {

                    var clearfix = '<div class="clearfix"></div>';

                    scope.$watch('$index', function(newVal, oldVal) {
                        if(newVal && newVal%2 === 1) {
                            element.after(clearfix);
                        }
                    });
                }
            };
        })

         .filter('fileName', function() {
            return function(input, key) {
                if (input) {
                    return input.split('/').pop();
                }
            };
        })

         .directive('iaFormErrorScroller', function() {
            return {
                require: '^form',
                restrict: 'EA',
                link: function (scope, elem, attrs, ctrl) {
                    angular.element(elem).submit(function (event) {
                        event.preventDefault();

                        if (ctrl.$submitted) {

                            if (ctrl.$invalid) {

                                var errorPosition = $(angular.element('input.ng-invalid, select.ng-invalid, textarea.ng-invalid')[0]).offset().top - 50;

                                $('html, body').animate({
                                    scrollTop: errorPosition
                                }, 1000);
                            }

                            return;
                        }
                    });
                }
            };
        })

         .directive('validateEmailAvailable', ['Account', function(Account) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                link: function(scope, element, attrs, ctrl) {

                    function validate() {
                        Account.validateEmailAvailable(ctrl.$viewValue, attrs.accountId).then(
                            function(res) {
                               if (res === undefined) {
                                    scope.isNotValide = true;
                                    ctrl.$setValidity('available', null);
                                    ctrl.$setValidity('active', null);
                                    ctrl.$setValidity('member', null);
                                } else if(res === "taken"){
                                    scope.isNotValide = true;
                                    ctrl.$setValidity('available', false);
                                    ctrl.$setValidity('member', true);
                                    ctrl.$setValidity('active', true);
                                }
                                else if(res === "inactive"){
                                    scope.isNotValide = true;
                                    ctrl.$setValidity('available', true);
                                    ctrl.$setValidity('member', true);
                                    ctrl.$setValidity('active', false);
                                }
                                else if(res === "member"){
                                    scope.isNotValide = true;
                                    ctrl.$setValidity('available', true);
                                    ctrl.$setValidity('active', true);
                                    ctrl.$setValidity('member', false);
                                }
                                else if(res === "account"){
                                    scope.isNotValide = true;
                                    ctrl.$setValidity('available', false);
                                    ctrl.$setValidity('active', true);
                                    ctrl.$setValidity('member', true);
                                }
                            });
                    }

                    element.on('blur', validate);

                    scope.$on('validate.email', validate);
                }
            };
        }])

          .directive('validateMemberEmailAvailable', ['Account','$rootScope', function(Account, $rootScope) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                link: function(scope, element, attrs, ctrl) {

                    function validate() {
                        if (ctrl.$isEmpty(ctrl.$viewValue)) {
                            return true;
                        }
                        $rootScope.isemailavailableformember = false;
                        $rootScope.isemailalreadyexistformember = false;
                        $rootScope.isemailactiveformember = false;
                        $rootScope.isemailrequiredformember = false;

                        Account.validateEmailAvailable(ctrl.$viewValue, attrs.accountId).then(
                            function(res) {
                               if (res === undefined) {
                                    scope.isNotValide = true;
                                    
                                } else if(res === "taken"){
                                    scope.isNotValide = true;
                                    $rootScope.isemailavailableformember = true;
                                    ctrl.$setValidity('email', false);
                                    /*setTimeout(function() {
                                                $rootScope.$apply(function () {
                                                    $rootScope.isemailavailableformember = false;                                            
                                                });                                        
                                    }, 7000); */
                                   // ctrl.$setValidity('available', false);
                                    
                                }
                                else if(res === "inactive"){
                                    scope.isNotValide = true;
                                    $rootScope.isemailactiveformember = true;
                                    ctrl.$setValidity('email', false);
                                    /*setTimeout(function() {
                                                $rootScope.$apply(function () {
                                                    $rootScope.isemailactiveformember = false;                                            
                                                });                                        
                                    }, 7000);*/
                                   // ctrl.$setValidity('active', false);
                                }
                                else if(res === "member"){
                                    scope.isNotValide = true;
                                    $rootScope.isemailalreadyexistformember = true;
                                    ctrl.$setValidity('email', false);
                                    /*setTimeout(function() {
                                                $rootScope.$apply(function () {
                                                    $rootScope.isemailalreadyexistformember = false;                                            
                                                });                                        
                                    }, 7000);*/
                                   // ctrl.$setValidity('member', false);
                                }
                                else if(res === "account"){
                                    scope.isNotValide = true;
                                    $rootScope.isemailavailableformember = true;
                                    ctrl.$setValidity('email', false);
                                    /*setTimeout(function() {
                                                $rootScope.$apply(function () {
                                                    $rootScope.isemailavailableformember = false;                                            
                                                });                                        
                                    }, 7000);*/
                                   // ctrl.$setValidity('available', false);
                                 
                                }
                                else if(res === "Empty email"){
                                     scope.isNotValide = true;
                                    $rootScope.isemailrequiredformember = true;
                                    ctrl.$setValidity('email', false);
                                    /*setTimeout(function() {
                                                $rootScope.$apply(function () {
                                                    $rootScope.isemailrequiredformember = false;                                            
                                                });                                        
                                    }, 7000);*/
                                }
                            });
                    }

                    element.on('blur', validate);

                    scope.$on('validate.email', validate);
                }
            };
        }])

         .directive('validatePhoneNumber', ['$rootScope','$filter','Account','$modal', function($rootScope,$filter,Account,$modal) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                 scope: {
                    phonevarifyCode: '=',
                    idValue: '='
                },
                link: function(scope, element, attrs, ctrl) {
                    $rootScope.globals.showSpinner = false;
                    $rootScope.globals.stateShowSpinner = false;
                    $rootScope.redirecting = true;   
                    var INTEGER_REGEXPVAL = /^[\d\(\)\ ?]+$/;
                    var tokensval = [ ['[',']'] , ['(',')'] ];
                    var isBalancedFalseVal = false;
                    function checkIsBalanced(expr){
                        var holder = [];
                        var openBrackets = ['(','['];
                        var closedBrackets = [')',']'];
                       
                        angular.forEach(expr, function (letter) { 
                           if(openBrackets.includes(letter)){ 
                                            holder.push(letter);
                                        }else if(closedBrackets.includes(letter)){ 
                                            var openPair = openBrackets[closedBrackets.indexOf(letter)]; 
                                            if(holder[holder.length - 1] === openPair){ 
                                                holder.splice(-1,1); 
                                            }else{ 
                                                holder.push(letter);                                   
                                            }
                                        }
                        });  
                        return holder.length === 0 ? isBalancedFalseVal = false : isBalancedFalseVal = true;  
                    }

                    function validate() {
                       
                            if(angular.isUndefined(scope.phonevarifyCode))
                                return;

                            if(angular.isUndefined(ctrl.$viewValue) && _.isEmpty(ctrl.$viewValue))
                                 return;

                            if((ctrl.$viewValue).trim().length<5){
                                return;
                            }
                            else{                               
                                if(checkIsBalanced((ctrl.$viewValue).trim()))
                                {
                                    return;
                                }
                                if(!(!!INTEGER_REGEXPVAL.test((ctrl.$viewValue).trim())))
                                {
                                    return;
                                }                              
                            }
                       
                        


                        var ccode = '+' +  $filter('settingsFilter')(scope.phonevarifyCode, 'countries', 'phonecode');
                        Account.validatePhoneNumber((ctrl.$viewValue).trim(), scope.phonevarifyCode, scope.idValue,ccode).then(
                            function(res) {
                                $rootScope.phonenumberalreadyused = false;
                                if(res.exist === "1"){ 

                                    $rootScope.phonenumberalreadyused = true;    
                                    ctrl.$setValidity('availablephone', false);                             
                                   // ctrl.$setValidity('availablephone', false);                                   
                                   /* setTimeout(function() {
                                        $rootScope.$apply(function () {
                                            $rootScope.phonenumberalreadyused = false; 
                                        });                                        
                                     }, 7000);*/                              
                                }
                                if(res.exist === "0"){
                                    ctrl.$setValidity('availablephone', true);
                                }
                                if(res.exist === "2"){
                                    var modalInstance = $modal.open({
                                        backdrop: false,
                                        backdropClick: false,
                                        dialogFade: false,
                                        keyboard: true,
                                        size: attrs.size,
                                        templateUrl: 'partials/modal/show-user-phone-sync.html',
                                        scope: scope,
                                        controller: function () {
                                            scope.cancel = function () {
                                                modalInstance.close();
                                            };                           
                                        }
                                    });
                                }
                            });
                    }
                    element.on('blur', validate);
                   
                }
            };
        }]) 
           .directive('validatePhonesNumber', ['$rootScope','$filter','Account','$modal','$window', function($rootScope,$filter,Account,$modal,$window) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                 scope: {
                    phonenumberVal: '=',
                    idValue: '='
                },
                link: function(scope, element, attrs, ctrl) {
                    $rootScope.globals.showSpinner = false;
                    $rootScope.globals.stateShowSpinner = false;
                    $rootScope.redirecting = true;
                    var INTEGER_REGEXPVAL = /^[\d\(\)\ ?]+$/;
                    var tokensval = [ ['[',']'] , ['(',')'] ];
                    var isBalancedFalseVal = false;
                    function checkIsBalanced(expr){
                        var holder = [];
                        var openBrackets = ['(','['];
                        var closedBrackets = [')',']'];
                       
                        angular.forEach(expr, function (letter) { 
                           if(openBrackets.includes(letter)){ 
                                            holder.push(letter);
                                        }else if(closedBrackets.includes(letter)){ 
                                            var openPair = openBrackets[closedBrackets.indexOf(letter)]; 
                                            if(holder[holder.length - 1] === openPair){ 
                                                holder.splice(-1,1); 
                                            }else{ 
                                                holder.push(letter);                                   
                                            }
                                        }
                        });  
                        return holder.length === 0 ? isBalancedFalseVal = false : isBalancedFalseVal = true;  
                    }

                    function validate() {
                        
                        if(angular.isUndefined(scope.phonenumberVal) && _.isEmpty(scope.phonenumberVal))
                            return;

                        if(!_.isEmpty(ctrl.$viewValue))
                            return;
                       
                      
                        if(scope.phonenumberVal.length<5){
                                return;
                        }
                        else{                               
                                if(checkIsBalanced(scope.phonenumberVal))
                                {
                                    return;
                                }
                                if(!(!!INTEGER_REGEXPVAL.test(scope.phonenumberVal)))
                                {
                                    return;
                                }
                        }

                       
                        var ccode = '+' +  $filter('settingsFilter')(ctrl.$viewValue, 'countries', 'phonecode');
                        Account.validatePhoneNumber((scope.phonenumberVal).trim(), ctrl.$viewValue, scope.idValue, ccode).then(
                            function(res) {
                                $rootScope.phonenumberalreadyused = false;                              
                                if(res.exist === "1"){
                                    $rootScope.phonenumberalreadyused = true;                                  
                                    //ctrl.$setValidity('availablephone', false);
                                     /*setTimeout(function() {
                                        $rootScope.$apply(function () {
                                            $rootScope.phonenumberalreadyused = false;                                            
                                        });                                        
                                     }, 7000);*/                            
                                }
                                if(res.exist === "0"){                                  
                                    ctrl.$setValidity('availablephone', true);                              
                                }
                                 if(res.exist === "2"){                                  
                                    var modalInstances = $modal.open({
                                        backdrop: false,
                                        backdropClick: false,
                                        dialogFade: false,
                                        keyboard: true,
                                        size: attrs.size,
                                        templateUrl: 'partials/modal/show-user-phone-sync.html',
                                        scope: scope,
                                        controller: function () {
                                            scope.cancel = function () {
                                                modalInstances.close();
                                            };                           
                                        }
                                    });
                                }
                            });
                    }
                    element.on('blur', validate);
                   
                }
            };
        }])
         .directive('useAccountEmail', function($rootScope, $timeout, locale, AuthToken,$http,iaSettings) {
            return {
                restrict: 'EA',
                link: function(scope, element, attrs) {
                    var email;

                    scope.$watch('member', function (newValue, oldValue) {
                        if (newValue !== oldValue) {
                            email = angular.copy(scope.member.email);
                        }
                    });

                    scope.$on('member.updated', function(event, member) {
                        email = member.email;
                    });

                    element.on('click', function(event) {
                        var checked = element.prop('checked');

                        if (element.prop('checked')) {
                            scope.member.use_account_email = checked;
                         var token = AuthToken.get();
                        var req = {
                             method: 'GET',
                             url: Config.API_BASE+'/account',
                             headers: {
                               'X-Authorization':'Bearer ' + token,
                               'Accept-Language': locale
                             } 
                        }

                        $http(req)
                        .then(function(res)
                            {
                               console.log(res.data.email);
                               scope.member.email = res.data.email;
                               $timeout(function() {
                                    $rootScope.$broadcast('validate.email');
                                }, 0);
                            }, 
                            function(error)
                            {
                               scope.member.email = scope.$parent.account.email;
                            });                       



                            //scope.member.email = scope.$parent.account.email;

                            
                        }
                        else {
                            if (email === scope.$parent.account.email) {
                                scope.member.email = null;
                            } else {
                                scope.member.email = email || null;
                            }
                        }
                    });
                }
            };
        })

         .directive('useAccountPhone', function() {
            return {
                restrict: 'EA',
                link: function(scope, element, attrs) {
                    var phone = {};

                    scope.$watch('member', function (newValue, oldValue) {
                        if (newValue !== oldValue) {
                            phone = angular.copy(scope.member.phone);
                        }
                    });

                    scope.$on('member.updated', function(event, member) {
                        phone = member.phone;
                    });

                    element.on('click', function(event) {                       
                        var checked = element.prop('checked');
                        scope.member.use_account_phone = checked;
                        
                        if (checked) {
                             if(!angular.isUndefined(scope.memberForm.phonenumber.$error.available))
                                scope.memberForm.phonenumber.$error.available = false;
                            
                            if(!angular.isUndefined(scope.memberForm.phonenumber.$error.availablephone)){
                                    // delete scope.memberForm.phonenumber.$error.availablephone ;
                                    // delete scope.memberForm.$error.availablephone;
                                    scope.memberForm.phonenumber.$setValidity('availablephone', true);
                            }

                            scope.member.phone = {};
                            if(sessionStorage.getItem("accountphonenubmervalue") === 'true'){
                                sessionStorage.setItem("accountphonenubmervalue",JSON.stringify(scope.$parent.account.phone));
                            
                                scope.member.phone = scope.$parent.account.phone;
                                phone              = scope.$parent.account.phone;
                            }
                             else{
                                scope.member.phone = JSON.parse(sessionStorage.getItem("accountphonenubmervalue"));
                                phone              = JSON.parse(sessionStorage.getItem("accountphonenubmervalue"));
                            }
                        }
                        else {
                                scope.member.phone = {};                               
                                document.getElementsByName('phonenumber')[0].value='';
                        }
                    });

                }
            };
        })

//------------ end 
        .directive('validateCovidProduct', ['Account','$rootScope', function(Account, $rootScope) {
            return {
                require: '?ngModel',
                restrict: 'EA',
                link: function(scope, element, attrs, ctrl) {

                    function validate() {
                        if (ctrl.$isEmpty(ctrl.$viewValue)) {
                            return true;
                        }
                        $rootScope.notvalidproduct = false;
                        
                        if(ctrl.$viewValue !== '-'){
                        Account.validateProduct(ctrl.$viewValue, attrs.pcate).then(
                            function(res) {
                                if (res === undefined) {
                                    scope.isNotValide = true;
                                    
                                } else {
                                    if(res.data.exist == true){
                                        scope.isNotValide = true;
                                        $rootScope.notvalidproduct = true;
                                        ctrl.$setValidity('srnumber', false);
                                    }else{
                                        scope.isNotValide = false;
                                        $rootScope.notvalidproduct = false;
                                        ctrl.$setValidity('srnumber', true);
                                    }
                                }
                            });
                        }
                    }
                    element.on('blur', validate);
                    scope.$on('validate.srnumber', validate);
                }
            };
        }])
//------------ end 


//------------ end 
.directive('validateVaccineProduct', ['Account','$rootScope', function(Account, $rootScope) {
    return {
        require: '?ngModel',
        restrict: 'EA',
        link: function(scope, element, attrs, ctrl) {

            function validate() {
                if (ctrl.$isEmpty(ctrl.$viewValue)) {
                    return true;
                }
                $rootScope.notvalidproduct = false;


                if(ctrl.$viewValue !== '-'){
                Account.validateVaccineProduct(ctrl.$viewValue, attrs.pcate).then(
                    function(res) {
                        if (res === undefined) {
                            scope.isNotValide = true;
                            
                        } else {
                            if(res.data.exist == true){
                                scope.isNotValide = true;
                                $rootScope.notvalidproduct = true;
                                ctrl.$setValidity('srnumber', false);
                            }else{
                                scope.isNotValide = false;
                                $rootScope.notvalidproduct = false;
                                ctrl.$setValidity('srnumber', true);
                            }
                        }
                    });
                }
            }
            element.on('blur', validate);
            scope.$on('validate.srnumber', validate);
        }
    };
}])
//------------ end 
         .directive('iaViewLocation', function($window, $modal, $rootScope) {
            return {
                restrict: 'EA',
                scope: {
                    location: '=location'
                },
                link: function(scope, elem, attrs) {
                    elem.on('click', function () {
                        if (!scope.location) {
                            return;
                        }
                        var countryCode = $rootScope.getMapCountryCode;
                        if(countryCode){
                            if(countryCode =='CN' || countryCode =='cn')
                            {
                               scope.isChina = true;
                                var modalInstance = $modal.open({
                                    backdrop: true,
                                    backdropClick: true,
                                    dialogFade: false,
                                    keyboard: true,
                                    size: attrs.size,
                                    templateUrl: 'partials/modal/open-map.html',
                                    scope: scope,
                                    controller: function () {
                                        scope.cancel = function () {
                                            modalInstance.close();
                                        };

                                        scope.bingMapLink = 'http://www.bing.com/ditu/default.aspx?where1='+
                                        scope.location.latitude + ','+ scope.location.longitude + '&cp='+
                                        scope.location.latitude + '~'+ scope.location.longitude + '&lvl=17&style=r&sp=point.' +
                                        scope.location.latitude + '_'+ scope.location.longitude + '&external=1';
                                        if(navigator.userAgent.toLowerCase().match(/iphone/i) == "iphone" || navigator.userAgent.toLowerCase().match(/ipad/i) == "ipad" || navigator.userAgent.toLowerCase().match(/mac/i) == "mac")
                                        {
                                           scope.isiphone = true;
                                        }
                                        else {
                                            scope.isiphone = false;
                                        }
                                       
                                    }
                                });
                            }
                            else{
                                $window.open('https://www.google.com/maps/place/'+scope.location.latitude+','+scope.location.longitude+'/@'+scope.location.latitude+','+scope.location.longitude+',18z','_blank');  
                            }    
                        }
                        else{
                            $window.open('https://www.google.com/maps/place/'+scope.location.latitude+','+scope.location.longitude+'/@'+scope.location.latitude+','+scope.location.longitude+',18z','_blank');
                        }
                        
                    });
                }
            };
        })

         .directive('notesLayout', function() {

            return ({
                link: link,
                restrict: 'A',
                scope: {
                    notes: '='
                },
                templateUrl: "partials/member/notes.html"
            });

            function link(scope, elem, attrs) {
                var textarea = angular.element(elem).find('textarea');
                var target = textarea.attr('ng-model');
                var maxLength = textarea.attr('ng-maxlength') || textarea.attr('maxlength') || 500;

                if (textarea.attr('maxlength') === undefined) {
                    textarea.attr('maxlength', maxLength);
                }

                scope.notesLength = scope.notesLength ? scope.notesLength : 0;
                scope.maxLength = maxLength;

                scope.$watch(target, function(newVal, oldVal) {

                    scope.notesLength = (newVal === undefined || newVal === null) ? 0 : newVal.length;

                });
            }
        })

         .directive('openInAppBrowser', ['$rootScope', '$window', function ($rootScope, $window) {
             return {
                 restrict: 'EA',
                 link: function (scope, elem, attrs) {

                     scope.language = $rootScope.globals.language;

                     elem.on('click', function (e) {
                         e.preventDefault();

                       // $cordovaInAppBrowser.open(attrs.href, '_blank');
                       $window.open(attrs.href, '_blank');
                   });
                 }
             };
         }])

         .directive('backButton', function () {
            return {
                restrict: 'A',
                controller: ['$rootScope', '$scope', '$window', '$attrs', '$state', '$element', function ($rootScope, $scope, $window, $attrs, $state, $element) {
                    $rootScope.backButton = $attrs.backButton;

                    function backState() {
                        $rootScope.isPanic = false;
                        $attrs.backButton ? $state.go($attrs.backButton) : $window.history.go(-1);
                    }

                    document.addEventListener('backbutton', backState, false);

                    $scope.$on('$destroy', function () {
                        $rootScope.backButton = null;
                        document.removeEventListener('backbutton', backState);
                    });

                    $(document).on('back.button.clicked', backState);
                }]
            };
        })

       
         .directive('showTwitterBox',['$rootScope','$modal',function($rootScope,$modal){
            return {
                 link: function (scope, elem, attrs) {
                    var modalInstance = null;
                      var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: attrs.controller
                    }
                    scope.cancel = function(){
                        modalInstance.close();
                    }                       
                     elem.on('click',function(){
						 modalInstance = $modal.open(opts);
                     });
                    }                
                }            
         }]) 
         .directive('ngPopup',['$rootScope','$modal',function($rootScope,$modal){
            return {
                 restrict: 'EA',
                 link: function (scope, elem, attrs) {
                    var modalInstance = null;
                      var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$rootScope', function ($rootScope) {
                            scope.cancel = function(){
                                modalInstance.close();
                            } 
                        
                        }]
                    };
                                         
                     elem.on('click',function(){
                         modalInstance = $modal.open(opts);
                         scope.lockScreenUrl =  attrs.downloadlink;
                     });
                    }                
                }            
         }])
        .directive('restrictTwitterInput', function() {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function(scope, element, attr, ctrl) {
                ctrl.$parsers.unshift(function(viewValue) {
                    var options = '^[a-zA-Z0-9_]*$';
                    var reg = new RegExp(options);
                    if (reg.test(viewValue)) { //if valid view value, return it
                        return viewValue;
                    } else { //if not valid view value, use the model value (or empty string if that's also invalid)
                    var overrideValue = (reg.test(ctrl.$modelValue) ? ctrl.$modelValue : '');
                    element.val(overrideValue);
                    return overrideValue;
                    }
                });
            }
        };
    })
         .directive('headerBackButton', function () {
            return {
                restrict: 'A',
                controller: ['$rootScope', '$element', '$window', '$location', '$state', function ($rootScope, $element, $window, $location, $state) {
                    $element.on('click', function (e) {
                        e.preventDefault();

                        if (!_.isUndefined($rootScope.backbutton) && $rootScope.backButton) {

                            $(document).trigger('back.button.clicked');

                        } else {

                            function matchPath(path) {
                                return _.contains(path, $location.$$path);
                            }

                            var paths = {'/account'               : 'base.home',
                            '/account/settings'      : 'account.show',
                            '/account/messages'      : 'account.show',
                            '/aboutus'               : 'base.home',
                            '/faq'                   : 'base.home',
                            '/contactus'             : 'base.home',
                            '/login'                 : 'base.home',
                            '/terms'                 : 'base.home',
                            '/privacy'               : 'base.home',
                            '/registration/register' : 'base.login',
                            '/forget-password/email' : 'base.login',
                            '/resend/active-email'   : 'base.login',
                            '/trigger-alert/contacts': 'base.trigger-alert.iceid',
                            '/trigger-alert/iceid'   : 'base.home'
                        };

                        if(_.any(_.keys(paths), matchPath)){

                            var next = _.isUndefined(paths[$location.$$path]) ? 'account.show' : paths[$location.$$path];
                            $state.go(next, {back: 1});

                        }else{
                            $window.history.go(-1);
                        }
                    }
                });
                }]
            };
        })
          .service('ngCopy', ['$window', function ($window) {
            var body = angular.element($window.document.body);
            var textArea;

            function isOS() {
                return navigator.userAgent.match(/ipad|iphone/i);
            }

            function createTextArea(text) {
                textArea = document.createElement('textArea');
                textArea.value = text;
                textArea.readOnly = true;
                document.body.appendChild(textArea);
            }
            function selectText() {
                var range,
                    selection;

                if (isOS()) {
                    range = document.createRange();
                    range.selectNodeContents(textArea);
                    selection = window.getSelection();
                    selection.removeAllRanges();
                    selection.addRange(range);
                    textArea.setSelectionRange(0, 999999);
                } else {
                    textArea.select();
                }
            }

            function copyToClipboard() {
                try {
                    var successful = document.execCommand('copy');
                    if (!successful) throw successful;
                } catch (err) {
                    window.prompt("Copy to clipboard: Ctrl+C, Enter", toCopy);
                }
                document.body.removeChild(textArea);
            }
            return function (toCopy) {
                createTextArea(toCopy);
                selectText();
                copyToClipboard();
            }
        }])
        .directive('ngClickCopy', ['ngCopy', function (ngCopy) {
            return {
                restrict: 'A',
                link: function (scope, element, attrs) {
                    element.bind('click', function (e) {
                     
                        ngCopy(attrs.ngClickCopy);
                        //alert("copied");
                        angular.element(document.getElementById("wechatcopied")).removeClass('hide');
                        setTimeout(function() {
                            angular.element(document.getElementById("wechatcopied")).addClass('hide');
                        }, 3000);
                    });
                }
            }
        }])

        .directive('ngClickCopyAttachment', ['ngCopy', function (ngCopy) {
            return {
                restrict: 'A',
                link: function (scope, element, attrs) {
                    element.bind('click', function (e) {
                     
                        ngCopy(attrs.ngClickCopyAttachment);
                        //alert("copied"); element.parent()
                        element.children().removeClass('hide');
                        setTimeout(function() {
                            element.children().addClass('hide');
                        }, 3000);
                    });
                }
            }
        }])

        .directive('resetEdit', ['$rootScope', function ($rootScope) {
            return {
                restrict: 'A',
                link: function (scope, element, attrs) {
                    scope.isResetEditPage= function(){
                       $rootScope.isEditPage = false;
                    }
                }
            }
        }])
         .directive('showScreenId', ['$modal', '$state', 'Account','AuthToken','iaSettings','$http', function ($modal, $state, Account,AuthToken,iaSettings,$http) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope','$rootScope', function ($scope,$rootScope) {
                            if($scope.member == null)
                            {
                                Account.getMember($rootScope.account.id)
                                    .then(function (member) {
                                        $scope.member = member;
                                });
                            }
                         $scope.cancel = function () {
                            modalInstance.dismiss('cancel');
                            var body = angular.element(document).find('body').eq(0);
                            if (body[0].className === 'modal-open') {
                                var layer       = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer  = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass('modal-open');
                                        layer.remove();
                                        modalLayer.remove();
                                }
                            };
                        }]
                    };

                    elem.on('click', function (e) {

                        modalInstance = $modal.open(opts);
                        modalInstance.result.then(function (res) {
                        }, function (e) {
                            elem.find('button').attr('disabled');
                        });
                    });
                }
            };
        }]);
     })();
