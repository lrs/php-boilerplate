(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.default = {
    ROOT_URLS: [
        'http://localhost:8888/'
    ],
    MAIN_MENU: '#menu',
    MAIN_SCROLLER: '.scroller-main',
    SCROLLER_OFFSET: $('#menu').innerHeight(),
    KEY: null
};

},{}],2:[function(require,module,exports){
"use strict";
function __export(m) {
    for (var p in m) if (!exports.hasOwnProperty(p)) exports[p] = m[p];
}
Object.defineProperty(exports, "__esModule", { value: true });
__export(require("./scroller-smooth"));

},{"./scroller-smooth":3}],3:[function(require,module,exports){
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var config_1 = require("../config");
/**
 * @description Adds smooth scroll to mousewheel scroll event.
 *
 * @export
 * @class SmoothScroll
 */
var SmoothScroll = (function () {
    /**
     * @description Creates an instance of SmoothScroll.
     * @param {number} [amount]
     *
     * @memberof SmoothScroll
     */
    function SmoothScroll(amount) {
        this.travel = amount || 100;
    }
    /**
     *
     *
     * @private
     * @param {any} e
     *
     * @memberof SmoothScroll
     */
    SmoothScroll.prototype.doSmoothScroll = function (e) {
        var a = e.originalEvent.wheelDelta / 360 || -e.originalEvent.detail / 3;
        a = $(window).scrollTop() - this.travel * a;
        TweenLite.to(window, 0.35, {
            scrollTo: {
                y: a,
                autoKill: false
            },
            ease: Power1.easeOut
        });
    };
    /**
     *
     *
     *
     * @memberof SmoothScroll
     */
    SmoothScroll.prototype.setSmoothScroll = function () {
        var _this = this;
        $(window).on('mousewheel DOMMouseScroll', function (e) {
            if (!config_1.default.KEY && !$('body').hasClass('body-modal')) {
                e.preventDefault();
                _this.doSmoothScroll(e);
            }
        });
    };
    return SmoothScroll;
}());
exports.SmoothScroll = SmoothScroll;

},{"../config":1}],4:[function(require,module,exports){
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var functions_1 = require("./functions");
$(document).ready(function () {
    var s = new functions_1.SmoothScroll(280);
    s.setSmoothScroll;
});

},{"./functions":2}]},{},[4]);
