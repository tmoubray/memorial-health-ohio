var $parcel$global =
typeof globalThis !== 'undefined'
  ? globalThis
  : typeof self !== 'undefined'
  ? self
  : typeof window !== 'undefined'
  ? window
  : typeof global !== 'undefined'
  ? global
  : {};
var $parcel$modules = {};
var $parcel$inits = {};

var parcelRequire = $parcel$global["parcelRequire8534"];
if (parcelRequire == null) {
  parcelRequire = function(id) {
    if (id in $parcel$modules) {
      return $parcel$modules[id].exports;
    }
    if (id in $parcel$inits) {
      var init = $parcel$inits[id];
      delete $parcel$inits[id];
      var module = {id: id, exports: {}};
      $parcel$modules[id] = module;
      init.call(module.exports, module, module.exports);
      return module.exports;
    }
    var err = new Error("Cannot find module '" + id + "'");
    err.code = 'MODULE_NOT_FOUND';
    throw err;
  };

  parcelRequire.register = function register(id, init) {
    $parcel$inits[id] = init;
  };

  $parcel$global["parcelRequire8534"] = parcelRequire;
}
parcelRequire.register("2rYH1", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $1c8d2ebcab38a998$var$_DateTime = $1c8d2ebcab38a998$var$_interopRequireDefault((parcelRequire("bXeqw")));

var $1c8d2ebcab38a998$var$_JQTextElement = $1c8d2ebcab38a998$var$_interopRequireDefault((parcelRequire("80ra5")));
function $1c8d2ebcab38a998$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
/**
 * Represents the last cleared text element
 */ class $1c8d2ebcab38a998$var$LastClearedText extends $1c8d2ebcab38a998$var$_JQTextElement.default {
    setLastClearedText(date) {
        if (this.element.length) {
            let lastClearedAt;
            try {
                lastClearedAt = $1c8d2ebcab38a998$var$_DateTime.default.formatDate(new Date(date));
            } catch  {
                lastClearedAt = $1c8d2ebcab38a998$var$_DateTime.default.formatDate(new Date(Date.now()));
            }
            super.show();
            this.setText(`Last cleared: ${lastClearedAt}`);
        }
    }
    constructor(element = jQuery('#wpe-last-cleared-text')){
        super(element);
    }
}
var $1c8d2ebcab38a998$var$_default = $1c8d2ebcab38a998$var$LastClearedText;
module.exports.default = $1c8d2ebcab38a998$var$_default;

});
parcelRequire.register("bXeqw", function(module, exports) {
'use strict';
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $8b40653f7fa19b7c$var$_Time = $8b40653f7fa19b7c$var$_interopRequireDefault((parcelRequire("dLcJk")));
function $8b40653f7fa19b7c$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
class $8b40653f7fa19b7c$var$DateTime {
    static getDateTimeUTC(date) {
        return date.getTime() + $8b40653f7fa19b7c$var$_Time.default.minutes(date.getTimezoneOffset());
    }
    static getLocalDateTimeFromUTC(date) {
        const newDate = new Date(date.getTime() + $8b40653f7fa19b7c$var$_Time.default.minutes(date.getTimezoneOffset()));
        const offset = date.getTimezoneOffset() / 60;
        const hours = date.getHours();
        newDate.setHours(hours - offset);
        return newDate;
    }
    static formatDate(date, locale = window.navigator.language || 'en-US') {
        const localOptions = {
            dateStyle: 'medium',
            timeStyle: 'medium'
        };
        return `${new Intl.DateTimeFormat(locale, localOptions).format(date)} UTC`;
    }
    static isLastClearedExpired(lastClearedAt, threshold = $8b40653f7fa19b7c$var$_Time.default.minutes(5)) {
        const lastClearedAtDate = new Date(Date.parse(lastClearedAt));
        if (!this.isValidDate(lastClearedAtDate)) {
            console.warn(`Invalid date: ${lastClearedAt}`);
            return true;
        }
        const now = $8b40653f7fa19b7c$var$DateTime.getDateTimeUTC(new Date(Date.now()));
        return now - lastClearedAtDate.getTime() > threshold;
    }
    static isValidDate(d) {
        return d instanceof Date && !Number.isNaN(d.getTime());
    }
    static mostRecentRateLimitedDate(a, b) {
        const mostRecentDate = $8b40653f7fa19b7c$var$DateTime.max(a, b);
        if ($8b40653f7fa19b7c$var$DateTime.isLastClearedExpired(mostRecentDate)) return null;
        return mostRecentDate;
    }
    static max(a, b) {
        return new Date(Math.max(new Date(a), new Date(b)));
    }
}
var $8b40653f7fa19b7c$var$_default = $8b40653f7fa19b7c$var$DateTime;
module.exports.default = $8b40653f7fa19b7c$var$_default;

});
parcelRequire.register("dLcJk", function(module, exports) {
'use strict';
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;
class $a0498a1511e2ef86$var$Time {
    static hours(h) {
        return h * 3600000;
    }
    static minutes(m) {
        return m * 60000;
    }
    static days(d) {
        return d * 86400000;
    }
}
var $a0498a1511e2ef86$var$_default = $a0498a1511e2ef86$var$Time;
module.exports.default = $a0498a1511e2ef86$var$_default;

});


parcelRequire.register("80ra5", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $5d4364933246a86a$var$_JQElement = $5d4364933246a86a$var$_interopRequireDefault((parcelRequire("ecXPi")));
function $5d4364933246a86a$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
class $5d4364933246a86a$var$JQTextElement extends $5d4364933246a86a$var$_JQElement.default {
    show() {
        if (this.element.length) this.element.attr('style', 'display: block;');
    }
    hide() {
        if (this.element.length) this.element.attr('style', 'display: none;');
    }
    constructor(element){
        super(element);
    }
}
var $5d4364933246a86a$var$_default = $5d4364933246a86a$var$JQTextElement;
module.exports.default = $5d4364933246a86a$var$_default;

});
parcelRequire.register("ecXPi", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;
/**
 * Represents a JQuery Element in the DOM
 */ class $a58097f2330b510a$var$JQElement {
    setText(text) {
        var _this$element;
        if (((_this$element = this.element) === null || _this$element === void 0 ? void 0 : _this$element.text()) !== text) this.element.text(text);
    }
    constructor(element){
        this.element = element;
    }
}
var $a58097f2330b510a$var$_default = $a58097f2330b510a$var$JQElement;
module.exports.default = $a58097f2330b510a$var$_default;

});



parcelRequire.register("lz2b1", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $fb2e8e1f54601847$var$_DateTime = $fb2e8e1f54601847$var$_interopRequireDefault((parcelRequire("bXeqw")));

var $fb2e8e1f54601847$var$_JQTextElement = $fb2e8e1f54601847$var$_interopRequireDefault((parcelRequire("80ra5")));
function $fb2e8e1f54601847$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
class $fb2e8e1f54601847$var$LastErrorText extends $fb2e8e1f54601847$var$_JQTextElement.default {
    setLastErrorText(date) {
        if (this.element.length) {
            let lastErrorAt;
            try {
                lastErrorAt = $fb2e8e1f54601847$var$_DateTime.default.formatDate(new Date(date));
            } catch  {
                lastErrorAt = $fb2e8e1f54601847$var$_DateTime.default.formatDate(new Date(Date.now()));
            }
            super.show();
            this.setText(`Error clearing all cache: ${lastErrorAt}`);
        }
    }
    constructor(element = jQuery('#wpe-last-cleared-error-text')){
        super(element);
    }
}
var $fb2e8e1f54601847$var$_default = $fb2e8e1f54601847$var$LastErrorText;
module.exports.default = $fb2e8e1f54601847$var$_default;

});

parcelRequire.register("8NCsU", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $6680bcbcb4229a99$var$_JQElement = $6680bcbcb4229a99$var$_interopRequireDefault((parcelRequire("ecXPi")));
function $6680bcbcb4229a99$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
class $6680bcbcb4229a99$var$ErrorToast extends $6680bcbcb4229a99$var$_JQElement.default {
    showToast() {
        if (this.element.length) this.element.attr('style', 'display: block');
    }
    hideToast() {
        if (this.element.length) this.element.attr('style', 'display: none');
    }
    constructor(element = jQuery('#wpe-cache-error-toast')){
        super(element);
    }
}
var $6680bcbcb4229a99$var$_default = $6680bcbcb4229a99$var$ErrorToast;
module.exports.default = $6680bcbcb4229a99$var$_default;

});

parcelRequire.register("gYRFv", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $c5cbe15d03d24446$var$_JQElement = $c5cbe15d03d24446$var$_interopRequireDefault((parcelRequire("ecXPi")));
function $c5cbe15d03d24446$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
/**
 * Represents the clear all caches button
 */ class $c5cbe15d03d24446$var$ClearAllCacheBtn extends $c5cbe15d03d24446$var$_JQElement.default {
    setDisabled(reason = 'Clear all caches button disabled for 5 minutes') {
        if (this.element.length) {
            this.element.attr('aria-disabled', true);
            this.element.attr('aria-describedby', reason);
            this.element.attr('disabled', true);
        }
    }
    attachSubmit({ onSuccess: onSuccess , onError: onError , maxCDNEnabled: maxCDNEnabled  }) {
        this.element.on('click', ()=>{
            if (maxCDNEnabled) this.setDisabled();
            this.apiService.clearAllCaches().then(onSuccess).catch(onError);
        });
    }
    constructor(apiService, element = jQuery('#wpe-clear-all-cache-btn')){
        super(element);
        this.apiService = apiService;
    }
}
var $c5cbe15d03d24446$var$_default = $c5cbe15d03d24446$var$ClearAllCacheBtn;
module.exports.default = $c5cbe15d03d24446$var$_default;

});

parcelRequire.register("hEd3X", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $cd904e17e8bc93da$var$_JQElement = $cd904e17e8bc93da$var$_interopRequireDefault((parcelRequire("ecXPi")));
function $cd904e17e8bc93da$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
/**
 * Represents the clear all caches icon
 */ class $cd904e17e8bc93da$var$ClearAllCacheIcon extends $cd904e17e8bc93da$var$_JQElement.default {
    setSuccessIcon() {
        if (this.element.length) this.element.attr('style', "content: url(\"data:image/svg+xml,%3Csvg width='50' height='50' viewBox='0 0 32 33' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect y='0.600098' width='32' height='32' rx='16' fill='%230ecad4'/%3E%3Cpath d='M21 12.7993L14.2 19.5993L11.4 16.7993L10 18.1993L14.2 22.3993L22.4 14.1993L21 12.7993Z' fill='white'/%3E%3C/svg%3E \");");
    }
    setErrorIcon() {
        if (this.element.length) this.element.attr('style', "content: url(\"data:image/svg+xml,%3Csvg width='32' height='33' viewBox='0 0 32 33' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M16 0.242615C12.8355 0.242615 9.74207 1.181 7.11088 2.9391C4.4797 4.6972 2.42894 7.19606 1.21793 10.1197C0.0069327 13.0433 -0.309921 16.2604 0.307443 19.3641C0.924806 22.4678 2.44866 25.3187 4.6863 27.5563C6.92394 29.794 9.77486 31.3178 12.8786 31.9352C15.9823 32.5525 19.1993 32.2357 22.1229 31.0247C25.0466 29.8137 27.5454 27.7629 29.3035 25.1317C31.0616 22.5005 32 19.4071 32 16.2426C31.9952 12.0006 30.308 7.93375 27.3084 4.93421C24.3089 1.93466 20.242 0.247414 16 0.242615ZM3.20001 16.2426C3.19796 13.8473 3.86862 11.4996 5.13558 9.46686C6.40255 7.4341 8.21491 5.79798 10.3662 4.74485C12.5176 3.69172 14.9214 3.26391 17.304 3.51013C19.6866 3.75635 21.9522 4.66672 23.8427 6.13755L5.89494 24.0853C4.14652 21.8451 3.19786 19.0843 3.20001 16.2426ZM16 29.0426C13.1592 29.0442 10.3995 28.0955 8.16 26.3477L26.1051 8.40261C27.5751 10.2931 28.4848 12.5584 28.7306 14.9406C28.9764 17.3228 28.5484 19.7261 27.4954 21.877C26.4424 24.0278 24.8066 25.8398 22.7743 27.1067C20.742 28.3735 18.3948 29.0443 16 29.0426Z' fill='%23D21B46'/%3E%3C/svg%3E%0A\");");
    }
    constructor(element = jQuery('#wpe-clear-all-cache-icon')){
        super(element);
    }
}
var $cd904e17e8bc93da$var$_default = $cd904e17e8bc93da$var$ClearAllCacheIcon;
module.exports.default = $cd904e17e8bc93da$var$_default;

});

parcelRequire.register("5Zu9t", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $45ca09c072d2b44f$var$_DateTime = $45ca09c072d2b44f$var$_interopRequireDefault((parcelRequire("bXeqw")));
function $45ca09c072d2b44f$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
class $45ca09c072d2b44f$var$CachePluginApiService {
    clearAllCaches() {
        return new Promise((resolve, reject)=>{
            this.ajaxCall(this.paths.clearAllCachesPath, 'POST', (data)=>{
                if (data.success) {
                    const dateTime = new Date(Date.parse(data.time_cleared));
                    resolve(dateTime);
                } else reject(data.last_error_at);
            }, ()=>{
                const now = $45ca09c072d2b44f$var$_DateTime.default.formatDate(new Date(Date.now()));
                reject(now);
            });
        });
    }
    ajaxCall(path, method, onSuccess, onError) {
        jQuery.ajax({
            type: method,
            url: path,
            success: (data)=>onSuccess(data)
            ,
            error: (error)=>onError(error)
        });
    }
    constructor(nonce, paths){
        this.nonce = nonce;
        this.paths = paths;
        jQuery.ajaxSetup({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', nonce);
            }
        });
    }
}
var $45ca09c072d2b44f$var$_default = $45ca09c072d2b44f$var$CachePluginApiService;
module.exports.default = $45ca09c072d2b44f$var$_default;

});

parcelRequire.register("6Q41H", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;
function $4faab8fb52349fa6$var$_classPrivateMethodGet(receiver, privateSet, fn) {
    if (!privateSet.has(receiver)) throw new TypeError("attempted to get private field on non-instance");
    return fn;
}
var $4faab8fb52349fa6$var$_removeQueryParam = /*#__PURE__*/ new WeakSet();
class $4faab8fb52349fa6$var$CachePluginWindowModifier {
    stripQueryParamFromPathname(queryParam) {
        const urlParams = $4faab8fb52349fa6$var$_classPrivateMethodGet(this, $4faab8fb52349fa6$var$_removeQueryParam, $4faab8fb52349fa6$var$_removeQueryParam2).call(this, queryParam);
        return `${this.window.location.pathname}?${urlParams}`;
    }
    replaceWindowState(url) {
        this.window.history.replaceState(null, '', url);
    }
    constructor(window){
        $4faab8fb52349fa6$var$_removeQueryParam.add(this);
        this.window = window;
    }
}
function $4faab8fb52349fa6$var$_removeQueryParam2(queryParam) {
    const newUrl = new URL(this.window.location.href);
    let params = new URLSearchParams(newUrl.search);
    params.delete(queryParam);
    return params;
}
var $4faab8fb52349fa6$var$_default = $4faab8fb52349fa6$var$CachePluginWindowModifier;
module.exports.default = $4faab8fb52349fa6$var$_default;

});

parcelRequire.register("kOgeL", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;

var $f265127fe423f144$var$_JQElement = $f265127fe423f144$var$_interopRequireDefault((parcelRequire("ecXPi")));
function $f265127fe423f144$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
/**
 * Represents the hidden _wp_http_referer field in the cache times form
 */ class $f265127fe423f144$var$CacheTimesFormReferField extends $f265127fe423f144$var$_JQElement.default {
    replaceRefer(url) {
        this.element.val(url);
    }
    constructor(element = jQuery('input[name="_wp_http_referer"]')){
        super(element);
    }
}
var $f265127fe423f144$var$_default = $f265127fe423f144$var$CacheTimesFormReferField;
module.exports.default = $f265127fe423f144$var$_default;

});

parcelRequire.register("bV5mJ", function(module, exports) {
"use strict";
Object.defineProperty(module.exports, "__esModule", {
    value: true
});
module.exports.default = void 0;
var $8ad92e16cf1636a0$var$_default = {
    notification: 'notification'
};
module.exports.default = $8ad92e16cf1636a0$var$_default;

});

"use strict";

var $aea0b5771135e6b1$var$_LastClearedText = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("2rYH1")));

var $aea0b5771135e6b1$var$_LastErrorText = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("lz2b1")));

var $aea0b5771135e6b1$var$_ErrorToast = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("8NCsU")));

var $aea0b5771135e6b1$var$_ClearAllCacheBtn = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("gYRFv")));

var $aea0b5771135e6b1$var$_ClearAllCacheIcon = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("hEd3X")));

var $aea0b5771135e6b1$var$_CachePluginApiService = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("5Zu9t")));

var $aea0b5771135e6b1$var$_DateTime = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("bXeqw")));

var $aea0b5771135e6b1$var$_CachePluginWindowModifier = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("6Q41H")));

var $aea0b5771135e6b1$var$_CacheTimesFormReferField = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("kOgeL")));

var $aea0b5771135e6b1$var$_CachePluginQueryParams = $aea0b5771135e6b1$var$_interopRequireDefault((parcelRequire("bV5mJ")));
function $aea0b5771135e6b1$var$_interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
(function($) {
    $(document).ready(function() {
        var _WPECachePlugin, _WPECachePlugin2;
        const removeNotificationParamFromPathname = ()=>{
            const windowModifier = new $aea0b5771135e6b1$var$_CachePluginWindowModifier.default(window);
            const updatedWindowPath = windowModifier.stripQueryParamFromPathname($aea0b5771135e6b1$var$_CachePluginQueryParams.default.notification);
            windowModifier.replaceWindowState(updatedWindowPath);
            const cacheTimesFormReferField = new $aea0b5771135e6b1$var$_CacheTimesFormReferField.default();
            cacheTimesFormReferField.replaceRefer(updatedWindowPath);
        };
        const getPreviousCacheClearResult = (mostRecentRateLimitedDate, lastClearedAt)=>{
            return mostRecentRateLimitedDate.getTime() === new Date(Date.parse(lastClearedAt)).getTime() ? 'success' : 'error';
        };
        const updateUIWithPreviousCacheClearResult = (previousCacheClearResult)=>{
            if (previousCacheClearResult === 'error') {
                clearCacheIcon.setErrorIcon();
                lastErrorText.setLastErrorText(mostRecentRateLimitedDate1);
            } else {
                clearCacheIcon.setSuccessIcon();
                lastClearedText.setLastClearedText(mostRecentRateLimitedDate1);
            }
        };
        const rootPath = wpApiSettings.root; // this root path contains the base api path for the REST Routes
        const nonce = wpApiSettings.nonce; // this is the nonce field
        const clearAllCachesPath = `${rootPath}${WPECachePlugin.clear_all_caches_path}`;
        const lastClearedAt1 = (_WPECachePlugin = WPECachePlugin) === null || _WPECachePlugin === void 0 ? void 0 : _WPECachePlugin.clear_all_cache_last_cleared;
        const lastErroredAt = (_WPECachePlugin2 = WPECachePlugin) === null || _WPECachePlugin2 === void 0 ? void 0 : _WPECachePlugin2.clear_all_cache_last_cleared_error;
        const cachePluginApiService = new $aea0b5771135e6b1$var$_CachePluginApiService.default(nonce, {
            clearAllCachesPath: clearAllCachesPath
        });
        const lastErrorText = new $aea0b5771135e6b1$var$_LastErrorText.default();
        const errorToast = new $aea0b5771135e6b1$var$_ErrorToast.default();
        const lastClearedText = new $aea0b5771135e6b1$var$_LastClearedText.default();
        const clearAllCacheBtn = new $aea0b5771135e6b1$var$_ClearAllCacheBtn.default(cachePluginApiService);
        const clearCacheIcon = new $aea0b5771135e6b1$var$_ClearAllCacheIcon.default();
        removeNotificationParamFromPathname();
        const mostRecentRateLimitedDate1 = $aea0b5771135e6b1$var$_DateTime.default.mostRecentRateLimitedDate(lastErroredAt, lastClearedAt1);
        const maxCDNEnabled = WPECachePlugin.max_cdn_enabled === '1';
        if (mostRecentRateLimitedDate1) {
            updateUIWithPreviousCacheClearResult(getPreviousCacheClearResult(mostRecentRateLimitedDate1, lastClearedAt1));
            if (maxCDNEnabled) clearAllCacheBtn.setDisabled();
        }
        clearAllCacheBtn.attachSubmit({
            onSuccess: (dateTime)=>{
                lastErrorText.hide();
                lastClearedText.setLastClearedText(dateTime);
                clearCacheIcon.setSuccessIcon();
                errorToast.hideToast();
            },
            onError: (errorTime)=>{
                lastClearedText.hide();
                lastErrorText.setLastErrorText(errorTime);
                clearCacheIcon.setErrorIcon();
                errorToast.showToast();
            },
            maxCDNEnabled: maxCDNEnabled
        });
    });
})(jQuery);


//# sourceMappingURL=wpe-cache-plugin-admin.js.map
