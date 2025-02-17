/*
     _ _      _       _
 ___| (_) ___| | __  (_)___
/ __| | |/ __| |/ /  | / __|
\__ \ | | (__|   < _ | \__ \
|___/_|_|\___|_|\_(_)/ |___/
                   |__/

 Version: 1.6.0
  Author: Ken Wheeler
 Website: http://kenwheeler.github.io
    Docs: http://kenwheeler.github.io/ex_s_lick
    Repo: http://github.com/kenwheeler/ex_s_lick
  Issues: http://github.com/kenwheeler/ex_s_lick/issues

 */
/* global window, document, define, jQuery, setInterval, clearInterval */
!(function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : "undefined" != typeof exports ? (module.exports = e(require("jquery"))) : e(jQuery);
})(function (a) {
    "use strict";
    var o,
        r = window.EXT_Slick || {};
    (o = 0),
        ((r = function (e, i) {
            var t = this;
            (t.defaults = {
                accessibility: !0,
                adaptiveHeight: !1,
                appendArrows: a(e),
                appendDots: a(e),
                arrows: !0,
                asNavFor: null,
                prevArrow: '<button type="button" data-role="none" class="ex_s_lick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
                nextArrow: '<button type="button" data-role="none" class="ex_s_lick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
                autoplay: !1,
                autoplaySpeed: 3e3,
                centerMode: !1,
                centerPadding: "50px",
                cssEase: "ease",
                customPaging: function (e, i) {
                    return a('<button type="button" data-role="none" role="button" tabindex="0" />').text(i + 1);
                },
                dots: !1,
                dotsClass: "ex_s_lick-dots",
                draggable: !0,
                easing: "linear",
                edgeFriction: 0.35,
                fade: !1,
                focusOnSelect: !1,
                infinite: !0,
                initialSlide: 0,
                lazyLoad: "ondemand",
                mobileFirst: !1,
                pauseOnHover: !0,
                pauseOnFocus: !0,
                pauseOnDotsHover: !1,
                respondTo: "window",
                responsive: null,
                rows: 1,
                rtl: !1,
                slide: "",
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: !0,
                swipeToSlide: !1,
                touchMove: !0,
                touchThreshold: 5,
                useCSS: !0,
                useTransform: !0,
                variableWidth: !1,
                vertical: !1,
                verticalSwiping: !1,
                waitForAnimate: !0,
                zIndex: 1e3,
            }),
                (t.initials = {
                    animating: !1,
                    dragging: !1,
                    autoPlayTimer: null,
                    currentDirection: 0,
                    currentLeft: null,
                    currentSlide: 0,
                    direction: 1,
                    $dots: null,
                    listWidth: null,
                    listHeight: null,
                    loadIndex: 0,
                    $nextArrow: null,
                    $prevArrow: null,
                    slideCount: null,
                    slideWidth: null,
                    $slideTrack: null,
                    $slides: null,
                    sliding: !1,
                    slideOffset: 0,
                    swipeLeft: null,
                    $list: null,
                    touchObject: {},
                    transformsEnabled: !1,
                    unex_s_licked: !1,
                }),
                a.extend(t, t.initials),
                (t.activeBreakpoint = null),
                (t.animType = null),
                (t.animProp = null),
                (t.breakpoints = []),
                (t.breakpointSettings = []),
                (t.cssTransitions = !1),
                (t.focussed = !1),
                (t.interrupted = !1),
                (t.hidden = "hidden"),
                (t.paused = !0),
                (t.positionProp = null),
                (t.respondTo = null),
                (t.rowCount = 1),
                (t.shouldClick = !0),
                (t.$slider = a(e)),
                (t.$slidesCache = null),
                (t.transformType = null),
                (t.transitionType = null),
                (t.visibilityChange = "visibilitychange"),
                (t.windowWidth = 0),
                (t.windowTimer = null),
                (e = a(e).data("ex_s_lick") || {}),
                (t.options = a.extend({}, t.defaults, i, e)),
                (t.currentSlide = t.options.initialSlide),
                (t.originalSettings = t.options),
                void 0 !== document.mozHidden ? ((t.hidden = "mozHidden"), (t.visibilityChange = "mozvisibilitychange")) : void 0 !== document.webkitHidden && ((t.hidden = "webkitHidden"), (t.visibilityChange = "webkitvisibilitychange")),
                (t.autoPlay = a.proxy(t.autoPlay, t)),
                (t.autoPlayClear = a.proxy(t.autoPlayClear, t)),
                (t.autoPlayIterator = a.proxy(t.autoPlayIterator, t)),
                (t.changeSlide = a.proxy(t.changeSlide, t)),
                (t.clickHandler = a.proxy(t.clickHandler, t)),
                (t.selectHandler = a.proxy(t.selectHandler, t)),
                (t.setPosition = a.proxy(t.setPosition, t)),
                (t.swipeHandler = a.proxy(t.swipeHandler, t)),
                (t.dragHandler = a.proxy(t.dragHandler, t)),
                (t.keyHandler = a.proxy(t.keyHandler, t)),
                (t.instanceUid = o++),
                (t.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/),
                t.registerBreakpoints(),
                t.init(!0);
        }).prototype.activateADA = function () {
            this.$slideTrack.find(".ex_s_lick-active").attr({ "aria-hidden": "false" }).find("a, input, button, select").attr({ tabindex: "0" });
        }),
        (r.prototype.addSlide = r.prototype.ex_s_lickAdd = function (e, i, t) {
            var o = this;
            if ("boolean" == typeof i) (t = i), (i = null);
            else if (i < 0 || i >= o.slideCount) return !1;
            o.unload(),
                "number" == typeof i
                    ? 0 === i && 0 === o.$slides.length
                        ? a(e).appendTo(o.$slideTrack)
                        : t
                        ? a(e).insertBefore(o.$slides.eq(i))
                        : a(e).insertAfter(o.$slides.eq(i))
                    : !0 === t
                    ? a(e).prependTo(o.$slideTrack)
                    : a(e).appendTo(o.$slideTrack),
                (o.$slides = o.$slideTrack.children(this.options.slide)),
                o.$slideTrack.children(this.options.slide).detach(),
                o.$slideTrack.append(o.$slides),
                o.$slides.each(function (e, i) {
                    a(i).attr("data-ex_s_lick-index", e);
                }),
                (o.$slidesCache = o.$slides),
                o.reinit();
        }),
        (r.prototype.animateHeight = function () {
            var e,
                i = this;
            1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical && ((e = i.$slides.eq(i.currentSlide).outerHeight(!0)), i.$list.animate({ height: e }, i.options.speed));
        }),
        (r.prototype.animateSlide = function (e, i) {
            var t = {},
                o = this;
            o.animateHeight(),
                !0 === o.options.rtl && !1 === o.options.vertical && (e = -e),
                !1 === o.transformsEnabled
                    ? !1 === o.options.vertical
                        ? o.$slideTrack.animate({ left: e }, o.options.speed, o.options.easing, i)
                        : o.$slideTrack.animate({ top: e }, o.options.speed, o.options.easing, i)
                    : !1 === o.cssTransitions
                    ? (!0 === o.options.rtl && (o.currentLeft = -o.currentLeft),
                      a({ animStart: o.currentLeft }).animate(
                          { animStart: e },
                          {
                              duration: o.options.speed,
                              easing: o.options.easing,
                              step: function (e) {
                                  (e = Math.ceil(e)), !1 === o.options.vertical ? (t[o.animType] = "translate(" + e + "px, 0px)") : (t[o.animType] = "translate(0px," + e + "px)"), o.$slideTrack.css(t);
                              },
                              complete: function () {
                                  i && i.call();
                              },
                          }
                      ))
                    : (o.applyTransition(),
                      (e = Math.ceil(e)),
                      !1 === o.options.vertical ? (t[o.animType] = "translate3d(" + e + "px, 0px, 0px)") : (t[o.animType] = "translate3d(0px," + e + "px, 0px)"),
                      o.$slideTrack.css(t),
                      i &&
                          setTimeout(function () {
                              o.disableTransition(), i.call();
                          }, o.options.speed));
        }),
        (r.prototype.getNavTarget = function () {
            var e = this.options.asNavFor;
            return e && null !== e && (e = a(e).not(this.$slider)), e;
        }),
        (r.prototype.asNavFor = function (i) {
            var e = this.getNavTarget();
            null !== e &&
                "object" == typeof e &&
                e.each(function () {
                    var e = a(this).EX_ex_s_lick("getEXT_Slick");
                    e.unex_s_licked || e.slideHandler(i, !0);
                });
        }),
        (r.prototype.applyTransition = function (e) {
            var i = this,
                t = {};
            !1 === i.options.fade ? (t[i.transitionType] = i.transformType + " " + i.options.speed + "ms " + i.options.cssEase) : (t[i.transitionType] = "opacity " + i.options.speed + "ms " + i.options.cssEase),
                (!1 === i.options.fade ? i.$slideTrack : i.$slides.eq(e)).css(t);
        }),
        (r.prototype.autoPlay = function () {
            var e = this;
            e.autoPlayClear(), e.slideCount > e.options.slidesToShow && (e.autoPlayTimer = setInterval(e.autoPlayIterator, e.options.autoplaySpeed));
        }),
        (r.prototype.autoPlayClear = function () {
            this.autoPlayTimer && clearInterval(this.autoPlayTimer);
        }),
        (r.prototype.autoPlayIterator = function () {
            var e = this,
                i = e.currentSlide + e.options.slidesToScroll;
            e.paused ||
                e.interrupted ||
                e.focussed ||
                (!1 === e.options.infinite &&
                    (1 === e.direction && e.currentSlide + 1 === e.slideCount - 1 ? (e.direction = 0) : 0 === e.direction && ((i = e.currentSlide - e.options.slidesToScroll), e.currentSlide - 1 == 0 && (e.direction = 1))),
                e.slideHandler(i));
        }),
        (r.prototype.buildArrows = function () {
            var e = this;
            !0 === e.options.arrows &&
                ((e.$prevArrow = a(e.options.prevArrow).addClass("ex_s_lick-arrow")),
                (e.$nextArrow = a(e.options.nextArrow).addClass("ex_s_lick-arrow")),
                e.slideCount > e.options.slidesToShow
                    ? (e.$prevArrow.removeClass("ex_s_lick-hidden").removeAttr("aria-hidden tabindex"),
                      e.$nextArrow.removeClass("ex_s_lick-hidden").removeAttr("aria-hidden tabindex"),
                      e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows),
                      e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows),
                      !0 !== e.options.infinite && e.$prevArrow.addClass("ex_s_lick-disabled").attr("aria-disabled", "true"))
                    : e.$prevArrow.add(e.$nextArrow).addClass("ex_s_lick-hidden").attr({ "aria-disabled": "true", tabindex: "-1" }));
        }),
        (r.prototype.buildDots = function () {
            var e,
                i,
                t = this;
            if (!0 === t.options.dots && t.slideCount > t.options.slidesToShow) {
                for (t.$slider.addClass("ex_s_lick-dotted"), i = a("<ul />").addClass(t.options.dotsClass), e = 0; e <= t.getDotCount(); e += 1) i.append(a("<li />").append(t.options.customPaging.call(this, t, e)));
                (t.$dots = i.appendTo(t.options.appendDots)), t.$dots.find("li").first().addClass("ex_s_lick-active").attr("aria-hidden", "false");
            }
        }),
        (r.prototype.buildOut = function () {
            var e = this;
            (e.$slides = e.$slider.children(e.options.slide + ":not(.ex_s_lick-cloned)").addClass("ex_s_lick-slide")),
                (e.slideCount = e.$slides.length),
                e.$slides.each(function (e, i) {
                    a(i)
                        .attr("data-ex_s_lick-index", e)
                        .data("originalStyling", a(i).attr("style") || "");
                }),
                e.$slider.addClass("ex_s_lick-slider"),
                (e.$slideTrack = 0 === e.slideCount ? a('<div class="ex_s_lick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="ex_s_lick-track"/>').parent()),
                (e.$list = e.$slideTrack.wrap('<div aria-live="polite" class="ex_s_lick-list !h-fit"/>').parent()),
                e.$slideTrack.css("opacity", 0),
                (!0 !== e.options.centerMode && !0 !== e.options.swipeToSlide) || (e.options.slidesToScroll = 1),
                a("img[data-lazy]", e.$slider).not("[src]").addClass("ex_s_lick-loading"),
                e.setupInfinite(),
                e.buildArrows(),
                e.buildDots(),
                e.updateDots(),
                e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0),
                !0 === e.options.draggable && e.$list.addClass("draggable");
        }),
        (r.prototype.buildRows = function () {
            var e,
                i,
                t,
                o = this,
                s = document.createDocumentFragment(),
                n = o.$slider.children();
            if (1 < o.options.rows) {
                for (t = o.options.slidesPerRow * o.options.rows, i = Math.ceil(n.length / t), e = 0; e < i; e++) {
                    for (var r = document.createElement("div"), l = 0; l < o.options.rows; l++) {
                        for (var d = document.createElement("div"), a = 0; a < o.options.slidesPerRow; a++) {
                            var c = e * t + (l * o.options.slidesPerRow + a);
                            n.get(c) && d.appendChild(n.get(c));
                        }
                        r.appendChild(d);
                    }
                    s.appendChild(r);
                }
                o.$slider.empty().append(s),
                    o.$slider
                        .children()
                        .children()
                        .children()
                        .css({ width: 100 / o.options.slidesPerRow + "%", display: "inline-block" });
            }
        }),
        (r.prototype.checkResponsive = function (e, i) {
            var t,
                o,
                s,
                n = this,
                r = !1,
                l = n.$slider.width(),
                d = window.innerWidth || a(window).width();
            if (("window" === n.respondTo ? (s = d) : "slider" === n.respondTo ? (s = l) : "min" === n.respondTo && (s = Math.min(d, l)), n.options.responsive && n.options.responsive.length && null !== n.options.responsive)) {
                for (t in ((o = null), n.breakpoints)) n.breakpoints.hasOwnProperty(t) && (!1 === n.originalSettings.mobileFirst ? s < n.breakpoints[t] && (o = n.breakpoints[t]) : s > n.breakpoints[t] && (o = n.breakpoints[t]));
                null !== o
                    ? (null !== n.activeBreakpoint && o === n.activeBreakpoint && !i) ||
                      ((n.activeBreakpoint = o),
                      "unex_s_lick" === n.breakpointSettings[o] ? n.unex_s_lick(o) : ((n.options = a.extend({}, n.originalSettings, n.breakpointSettings[o])), !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e)),
                      (r = o))
                    : null !== n.activeBreakpoint && ((n.activeBreakpoint = null), (n.options = n.originalSettings), !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e), (r = o)),
                    e || !1 === r || n.$slider.trigger("breakpoint", [n, r]);
            }
        }),
        (r.prototype.changeSlide = function (e, i) {
            var t,
                o = this,
                s = a(e.currentTarget);
            switch ((s.is("a") && e.preventDefault(), s.is("li") || (s = s.closest("li")), (t = o.slideCount % o.options.slidesToScroll != 0 ? 0 : (o.slideCount - o.currentSlide) % o.options.slidesToScroll), e.data.message)) {
                case "previous":
                    (n = 0 == t ? o.options.slidesToScroll : o.options.slidesToShow - t), o.slideCount > o.options.slidesToShow && o.slideHandler(o.currentSlide - n, !1, i);
                    break;
                case "next":
                    (n = 0 == t ? o.options.slidesToScroll : t), o.slideCount > o.options.slidesToShow && o.slideHandler(o.currentSlide + n, !1, i);
                    break;
                case "index":
                    var n = 0 === e.data.index ? 0 : e.data.index || s.index() * o.options.slidesToScroll;
                    o.slideHandler(o.checkNavigable(n), !1, i), s.children().trigger("focus");
                    break;
                default:
                    return;
            }
        }),
        (r.prototype.checkNavigable = function (e) {
            var i = this.getNavigableIndexes(),
                t = 0;
            if (e > i[i.length - 1]) e = i[i.length - 1];
            else
                for (var o in i) {
                    if (e < i[o]) {
                        e = t;
                        break;
                    }
                    t = i[o];
                }
            return e;
        }),
        (r.prototype.cleanUpEvents = function () {
            var e = this;
            e.options.dots && null !== e.$dots && a("li", e.$dots).off("click.ex_s_lick", e.changeSlide).off("mouseenter.ex_s_lick", a.proxy(e.interrupt, e, !0)).off("mouseleave.ex_s_lick", a.proxy(e.interrupt, e, !1)),
                e.$slider.off("focus.ex_s_lick blur.ex_s_lick"),
                !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.ex_s_lick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.ex_s_lick", e.changeSlide)),
                e.$list.off("touchstart.ex_s_lick mousedown.ex_s_lick", e.swipeHandler),
                e.$list.off("touchmove.ex_s_lick mousemove.ex_s_lick", e.swipeHandler),
                e.$list.off("touchend.ex_s_lick mouseup.ex_s_lick", e.swipeHandler),
                e.$list.off("touchcancel.ex_s_lick mouseleave.ex_s_lick", e.swipeHandler),
                e.$list.off("click.ex_s_lick", e.clickHandler),
                a(document).off(e.visibilityChange, e.visibility),
                e.cleanUpSlideEvents(),
                !0 === e.options.accessibility && e.$list.off("keydown.ex_s_lick", e.keyHandler),
                !0 === e.options.focusOnSelect && a(e.$slideTrack).children().off("click.ex_s_lick", e.selectHandler),
                a(window).off("orientationchange.ex_s_lick.ex_s_lick-" + e.instanceUid, e.orientationChange),
                a(window).off("resize.ex_s_lick.ex_s_lick-" + e.instanceUid, e.resize),
                a("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault),
                a(window).off("load.ex_s_lick.ex_s_lick-" + e.instanceUid, e.setPosition),
                a(document).off("ready.ex_s_lick.ex_s_lick-" + e.instanceUid, e.setPosition);
        }),
        (r.prototype.cleanUpSlideEvents = function () {
            var e = this;
            e.$list.off("mouseenter.ex_s_lick", a.proxy(e.interrupt, e, !0)), e.$list.off("mouseleave.ex_s_lick", a.proxy(e.interrupt, e, !1));
        }),
        (r.prototype.cleanUpRows = function () {
            var e;
            1 < this.options.rows && ((e = this.$slides.children().children()).removeAttr("style"), this.$slider.empty().append(e));
        }),
        (r.prototype.clickHandler = function (e) {
            !1 === this.shouldClick && (e.stopImmediatePropagation(), e.stopPropagation(), e.preventDefault());
        }),
        (r.prototype.destroy = function (e) {
            var i = this;
            i.autoPlayClear(),
                (i.touchObject = {}),
                i.cleanUpEvents(),
                a(".ex_s_lick-cloned", i.$slider).detach(),
                i.$dots && i.$dots.remove(),
                i.$prevArrow &&
                    i.$prevArrow.length &&
                    (i.$prevArrow.removeClass("ex_s_lick-disabled ex_s_lick-arrow ex_s_lick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.prevArrow) && i.$prevArrow.remove()),
                i.$nextArrow &&
                    i.$nextArrow.length &&
                    (i.$nextArrow.removeClass("ex_s_lick-disabled ex_s_lick-arrow ex_s_lick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.nextArrow) && i.$nextArrow.remove()),
                i.$slides &&
                    (i.$slides
                        .removeClass("ex_s_lick-slide ex_s_lick-active ex_s_lick-center ex_s_lick-visible ex_s_lick-current")
                        .removeAttr("aria-hidden")
                        .removeAttr("data-ex_s_lick-index")
                        .each(function () {
                            a(this).attr("style", a(this).data("originalStyling"));
                        }),
                    i.$slideTrack.children(this.options.slide).detach(),
                    i.$slideTrack.detach(),
                    i.$list.detach(),
                    i.$slider.append(i.$slides)),
                i.cleanUpRows(),
                i.$slider.removeClass("ex_s_lick-slider"),
                i.$slider.removeClass("ex_s_lick-initialized"),
                i.$slider.removeClass("ex_s_lick-dotted"),
                (i.unex_s_licked = !0),
                e || i.$slider.trigger("destroy", [i]);
        }),
        (r.prototype.disableTransition = function (e) {
            var i = {};
            (i[this.transitionType] = ""), (!1 === this.options.fade ? this.$slideTrack : this.$slides.eq(e)).css(i);
        }),
        (r.prototype.fadeSlide = function (e, i) {
            var t = this;
            !1 === t.cssTransitions
                ? (t.$slides.eq(e).css({ zIndex: t.options.zIndex }), t.$slides.eq(e).animate({ opacity: 1 }, t.options.speed, t.options.easing, i))
                : (t.applyTransition(e),
                  t.$slides.eq(e).css({ opacity: 1, zIndex: t.options.zIndex }),
                  i &&
                      setTimeout(function () {
                          t.disableTransition(e), i.call();
                      }, t.options.speed));
        }),
        (r.prototype.fadeSlideOut = function (e) {
            var i = this;
            !1 === i.cssTransitions ? i.$slides.eq(e).animate({ opacity: 0, zIndex: i.options.zIndex - 2 }, i.options.speed, i.options.easing) : (i.applyTransition(e), i.$slides.eq(e).css({ opacity: 0, zIndex: i.options.zIndex - 2 }));
        }),
        (r.prototype.filterSlides = r.prototype.ex_s_lickFilter = function (e) {
            var i = this;
            null !== e && ((i.$slidesCache = i.$slides), i.unload(), i.$slideTrack.children(this.options.slide).detach(), i.$slidesCache.filter(e).appendTo(i.$slideTrack), i.reinit());
        }),
        (r.prototype.focusHandler = function () {
            var t = this;
            t.$slider.off("focus.ex_s_lick blur.ex_s_lick").on("focus.ex_s_lick blur.ex_s_lick", "*:not(.ex_s_lick-arrow)", function (e) {
                e.stopImmediatePropagation();
                var i = a(this);
                setTimeout(function () {
                    t.options.pauseOnFocus && ((t.focussed = i.is(":focus")), t.autoPlay());
                }, 0);
            });
        }),
        (r.prototype.getCurrent = r.prototype.ex_s_lickCurrentSlide = function () {
            return this.currentSlide;
        }),
        (r.prototype.getDotCount = function () {
            var e = this,
                i = 0,
                t = 0,
                o = 0;
            if (!0 === e.options.infinite) for (; i < e.slideCount; ) ++o, (i = t + e.options.slidesToScroll), (t += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow);
            else if (!0 === e.options.centerMode) o = e.slideCount;
            else if (e.options.asNavFor) for (; i < e.slideCount; ) ++o, (i = t + e.options.slidesToScroll), (t += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow);
            else o = 1 + Math.ceil((e.slideCount - e.options.slidesToShow) / e.options.slidesToScroll);
            return o - 1;
        }),
        (r.prototype.getLeft = function (e) {
            var i,
                t = this,
                o = 0;
            return (
                (t.slideOffset = 0),
                (i = t.$slides.first().outerHeight(!0)),
                !0 === t.options.infinite
                    ? (t.slideCount > t.options.slidesToShow && ((t.slideOffset = t.slideWidth * t.options.slidesToShow * -1), (o = i * t.options.slidesToShow * -1)),
                      t.slideCount % t.options.slidesToScroll != 0 &&
                          e + t.options.slidesToScroll > t.slideCount &&
                          t.slideCount > t.options.slidesToShow &&
                          (o =
                              e > t.slideCount
                                  ? ((t.slideOffset = (t.options.slidesToShow - (e - t.slideCount)) * t.slideWidth * -1), (t.options.slidesToShow - (e - t.slideCount)) * i * -1)
                                  : ((t.slideOffset = (t.slideCount % t.options.slidesToScroll) * t.slideWidth * -1), (t.slideCount % t.options.slidesToScroll) * i * -1)))
                    : e + t.options.slidesToShow > t.slideCount && ((t.slideOffset = (e + t.options.slidesToShow - t.slideCount) * t.slideWidth), (o = (e + t.options.slidesToShow - t.slideCount) * i)),
                t.slideCount <= t.options.slidesToShow && (o = t.slideOffset = 0),
                !0 === t.options.centerMode && !0 === t.options.infinite
                    ? (t.slideOffset += t.slideWidth * Math.floor(t.options.slidesToShow / 2) - t.slideWidth)
                    : !0 === t.options.centerMode && ((t.slideOffset = 0), (t.slideOffset += t.slideWidth * Math.floor(t.options.slidesToShow / 2))),
                (i = !1 === t.options.vertical ? e * t.slideWidth * -1 + t.slideOffset : e * i * -1 + o),
                !0 === t.options.variableWidth &&
                    ((o = t.slideCount <= t.options.slidesToShow || !1 === t.options.infinite ? t.$slideTrack.children(".ex_s_lick-slide").eq(e) : t.$slideTrack.children(".ex_s_lick-slide").eq(e + t.options.slidesToShow)),
                    (i = !0 === t.options.rtl ? (o[0] ? -1 * (t.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0) : o[0] ? -1 * o[0].offsetLeft : 0),
                    !0 === t.options.centerMode &&
                        ((o = t.slideCount <= t.options.slidesToShow || !1 === t.options.infinite ? t.$slideTrack.children(".ex_s_lick-slide").eq(e) : t.$slideTrack.children(".ex_s_lick-slide").eq(e + t.options.slidesToShow + 1)),
                        (i = !0 === t.options.rtl ? (o[0] ? -1 * (t.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0) : o[0] ? -1 * o[0].offsetLeft : 0),
                        (i += (t.$list.width() - o.outerWidth()) / 2))),
                i
            );
        }),
        (r.prototype.getOption = r.prototype.ex_s_lickGetOption = function (e) {
            return this.options[e];
        }),
        (r.prototype.getNavigableIndexes = function () {
            for (var e = this, i = 0, t = 0, o = [], s = !1 === e.options.infinite ? e.slideCount : ((i = -1 * e.options.slidesToScroll), (t = -1 * e.options.slidesToScroll), 2 * e.slideCount); i < s; )
                o.push(i), (i = t + e.options.slidesToScroll), (t += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow);
            return o;
        }),
        (r.prototype.getEXT_Slick = function () {
            return this;
        }),
        (r.prototype.getSlideCount = function () {
            var t,
                o = this,
                s = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0;
            return !0 === o.options.swipeToSlide
                ? (o.$slideTrack.find(".ex_s_lick-slide").each(function (e, i) {
                      if (i.offsetLeft - s + a(i).outerWidth() / 2 > -1 * o.swipeLeft) return (t = i), !1;
                  }),
                  Math.abs(a(t).attr("data-ex_s_lick-index") - o.currentSlide) || 1)
                : o.options.slidesToScroll;
        }),
        (r.prototype.goTo = r.prototype.ex_s_lickGoTo = function (e, i) {
            this.changeSlide({ data: { message: "index", index: parseInt(e) } }, i);
        }),
        (r.prototype.init = function (e) {
            var i = this;
            a(i.$slider).hasClass("ex_s_lick-initialized") ||
                (a(i.$slider).addClass("ex_s_lick-initialized"), i.buildRows(), i.buildOut(), i.setProps(), i.startLoad(), i.loadSlider(), i.initializeEvents(), i.updateArrows(), i.updateDots(), i.checkResponsive(!0), i.focusHandler()),
                e && i.$slider.trigger("init", [i]),
                !0 === i.options.accessibility && i.initADA(),
                i.options.autoplay && ((i.paused = !1), i.autoPlay());
        }),
        (r.prototype.initADA = function () {
            var i = this;
            i.$slides.add(i.$slideTrack.find(".ex_s_lick-cloned")).attr({ "aria-hidden": "true", tabindex: "-1" }).find("a, input, button, select").attr({ tabindex: "-1" }),
                i.$slideTrack.attr("role", "listbox"),
                i.$slides.not(i.$slideTrack.find(".ex_s_lick-cloned")).each(function (e) {
                    a(this).attr({ role: "option", "aria-describedby": "ex_s_lick-slide" + i.instanceUid + e });
                }),
                null !== i.$dots &&
                    i.$dots
                        .attr("role", "tablist")
                        .find("li")
                        .each(function (e) {
                            a(this).attr({ role: "presentation", "aria-selected": "false", "aria-controls": "navigation" + i.instanceUid + e, id: "ex_s_lick-slide" + i.instanceUid + e });
                        })
                        .first()
                        .attr("aria-selected", "true")
                        .end()
                        .find("button")
                        .attr("role", "button")
                        .end()
                        .closest("div")
                        .attr("role", "toolbar"),
                i.activateADA();
        }),
        (r.prototype.initArrowEvents = function () {
            var e = this;
            !0 === e.options.arrows &&
                e.slideCount > e.options.slidesToShow &&
                (e.$prevArrow.off("click.ex_s_lick").on("click.ex_s_lick", { message: "previous" }, e.changeSlide), e.$nextArrow.off("click.ex_s_lick").on("click.ex_s_lick", { message: "next" }, e.changeSlide));
        }),
        (r.prototype.initDotEvents = function () {
            var e = this;
            !0 === e.options.dots && e.slideCount > e.options.slidesToShow && a("li", e.$dots).on("click.ex_s_lick", { message: "index" }, e.changeSlide),
                !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && a("li", e.$dots).on("mouseenter.ex_s_lick", a.proxy(e.interrupt, e, !0)).on("mouseleave.ex_s_lick", a.proxy(e.interrupt, e, !1));
        }),
        (r.prototype.initSlideEvents = function () {
            var e = this;
            e.options.pauseOnHover && (e.$list.on("mouseenter.ex_s_lick", a.proxy(e.interrupt, e, !0)), e.$list.on("mouseleave.ex_s_lick", a.proxy(e.interrupt, e, !1)));
        }),
        (r.prototype.initializeEvents = function () {
            var e = this;
            e.initArrowEvents(),
                e.initDotEvents(),
                e.initSlideEvents(),
                e.$list.on("touchstart.ex_s_lick mousedown.ex_s_lick", { action: "start" }, e.swipeHandler),
                e.$list.on("touchmove.ex_s_lick mousemove.ex_s_lick", { action: "move" }, e.swipeHandler),
                e.$list.on("touchend.ex_s_lick mouseup.ex_s_lick", { action: "end" }, e.swipeHandler),
                e.$list.on("touchcancel.ex_s_lick mouseleave.ex_s_lick", { action: "end" }, e.swipeHandler),
                e.$list.on("click.ex_s_lick", e.clickHandler),
                a(document).on(e.visibilityChange, a.proxy(e.visibility, e)),
                !0 === e.options.accessibility && e.$list.on("keydown.ex_s_lick", e.keyHandler),
                !0 === e.options.focusOnSelect && a(e.$slideTrack).children().on("click.ex_s_lick", e.selectHandler),
                a(window).on("orientationchange.ex_s_lick.ex_s_lick-" + e.instanceUid, a.proxy(e.orientationChange, e)),
                a(window).on("resize.ex_s_lick.ex_s_lick-" + e.instanceUid, a.proxy(e.resize, e)),
                a("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault),
                a(window).on("load.ex_s_lick.ex_s_lick-" + e.instanceUid, e.setPosition),
                a(document).on("ready.ex_s_lick.ex_s_lick-" + e.instanceUid, e.setPosition);
        }),
        (r.prototype.initUI = function () {
            var e = this;
            !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.show(), e.$nextArrow.show()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.show();
        }),
        (r.prototype.keyHandler = function (e) {
            var i = this;
            e.target.tagName.match("TEXTAREA|INPUT|SELECT") ||
                (37 === e.keyCode && !0 === i.options.accessibility
                    ? i.changeSlide({ data: { message: !0 === i.options.rtl ? "next" : "previous" } })
                    : 39 === e.keyCode && !0 === i.options.accessibility && i.changeSlide({ data: { message: !0 === i.options.rtl ? "previous" : "next" } }));
        }),
        (r.prototype.lazyLoad = function () {
            var e,
                i,
                o = this;
            function t(e) {
                a("img[data-lazy]", e).each(function () {
                    var e = a(this),
                        i = a(this).attr("data-lazy"),
                        t = document.createElement("img");
                    (t.onload = function () {
                        e.animate({ opacity: 0 }, 100, function () {
                            e.attr("src", i).animate({ opacity: 1 }, 200, function () {
                                e.removeAttr("data-lazy").removeClass("ex_s_lick-loading");
                            }),
                                o.$slider.trigger("lazyLoaded", [o, e, i]);
                        });
                    }),
                        (t.onerror = function () {
                            e.removeAttr("data-lazy").removeClass("ex_s_lick-loading").addClass("ex_s_lick-lazyload-error"), o.$slider.trigger("lazyLoadError", [o, e, i]);
                        }),
                        (t.src = i);
                });
            }
            !0 === o.options.centerMode
                ? (i =
                      !0 === o.options.infinite
                          ? (e = o.currentSlide + (o.options.slidesToShow / 2 + 1)) + o.options.slidesToShow + 2
                          : ((e = Math.max(0, o.currentSlide - (o.options.slidesToShow / 2 + 1))), o.options.slidesToShow / 2 + 1 + 2 + o.currentSlide))
                : ((e = o.options.infinite ? o.options.slidesToShow + o.currentSlide : o.currentSlide), (i = Math.ceil(e + o.options.slidesToShow)), !0 === o.options.fade && (0 < e && e--, i <= o.slideCount && i++)),
                t(o.$slider.find(".ex_s_lick-slide").slice(e, i)),
                o.slideCount <= o.options.slidesToShow
                    ? t(o.$slider.find(".ex_s_lick-slide"))
                    : o.currentSlide >= o.slideCount - o.options.slidesToShow
                    ? t(o.$slider.find(".ex_s_lick-cloned").slice(0, o.options.slidesToShow))
                    : 0 === o.currentSlide && t(o.$slider.find(".ex_s_lick-cloned").slice(-1 * o.options.slidesToShow));
        }),
        (r.prototype.loadSlider = function () {
            var e = this;
            e.setPosition(), e.$slideTrack.css({ opacity: 1 }), e.$slider.removeClass("ex_s_lick-loading"), e.initUI(), "progressive" === e.options.lazyLoad && e.progressiveLazyLoad();
        }),
        (r.prototype.next = r.prototype.ex_s_lickNext = function () {
            this.changeSlide({ data: { message: "next" } });
        }),
        (r.prototype.orientationChange = function () {
            this.checkResponsive(), this.setPosition();
        }),
        (r.prototype.pause = r.prototype.ex_s_lickPause = function () {
            this.autoPlayClear(), (this.paused = !0);
        }),
        (r.prototype.play = r.prototype.ex_s_lickPlay = function () {
            var e = this;
            e.autoPlay(), (e.options.autoplay = !0), (e.paused = !1), (e.focussed = !1), (e.interrupted = !1);
        }),
        (r.prototype.postSlide = function (e) {
            var i = this;
            i.unex_s_licked || (i.$slider.trigger("afterChange", [i, e]), (i.animating = !1), i.setPosition(), (i.swipeLeft = null), i.options.autoplay && i.autoPlay(), !0 === i.options.accessibility && i.initADA());
        }),
        (r.prototype.prev = r.prototype.ex_s_lickPrev = function () {
            this.changeSlide({ data: { message: "previous" } });
        }),
        (r.prototype.preventDefault = function (e) {
            e.preventDefault();
        }),
        (r.prototype.progressiveLazyLoad = function (e) {
            e = e || 1;
            var i,
                t,
                o = this,
                s = a("img[data-lazy]", o.$slider);
            s.length
                ? ((i = s.first()),
                  (t = i.attr("data-lazy")),
                  ((s = document.createElement("img")).onload = function () {
                      i.attr("src", t).removeAttr("data-lazy").removeClass("ex_s_lick-loading"), !0 === o.options.adaptiveHeight && o.setPosition(), o.$slider.trigger("lazyLoaded", [o, i, t]), o.progressiveLazyLoad();
                  }),
                  (s.onerror = function () {
                      e < 3
                          ? setTimeout(function () {
                                o.progressiveLazyLoad(e + 1);
                            }, 500)
                          : (i.removeAttr("data-lazy").removeClass("ex_s_lick-loading").addClass("ex_s_lick-lazyload-error"), o.$slider.trigger("lazyLoadError", [o, i, t]), o.progressiveLazyLoad());
                  }),
                  (s.src = t))
                : o.$slider.trigger("allImagesLoaded", [o]);
        }),
        (r.prototype.refresh = function (e) {
            var i = this,
                t = i.slideCount - i.options.slidesToShow;
            !i.options.infinite && i.currentSlide > t && (i.currentSlide = t),
                i.slideCount <= i.options.slidesToShow && (i.currentSlide = 0),
                (t = i.currentSlide),
                i.destroy(!0),
                a.extend(i, i.initials, { currentSlide: t }),
                i.init(),
                e || i.changeSlide({ data: { message: "index", index: t } }, !1);
        }),
        (r.prototype.registerBreakpoints = function () {
            var e,
                i,
                t,
                o = this,
                s = o.options.responsive || null;
            if ("array" === a.type(s) && s.length) {
                for (e in ((o.respondTo = o.options.respondTo || "window"), s))
                    if (((t = o.breakpoints.length - 1), (i = s[e].breakpoint), s.hasOwnProperty(e))) {
                        for (; 0 <= t; ) o.breakpoints[t] && o.breakpoints[t] === i && o.breakpoints.splice(t, 1), t--;
                        o.breakpoints.push(i), (o.breakpointSettings[i] = s[e].settings);
                    }
                o.breakpoints.sort(function (e, i) {
                    return o.options.mobileFirst ? e - i : i - e;
                });
            }
        }),
        (r.prototype.reinit = function () {
            var e = this;
            (e.$slides = e.$slideTrack.children(e.options.slide).addClass("ex_s_lick-slide")),
                (e.slideCount = e.$slides.length),
                e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll),
                e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0),
                e.registerBreakpoints(),
                e.setProps(),
                e.setupInfinite(),
                e.buildArrows(),
                e.updateArrows(),
                e.initArrowEvents(),
                e.buildDots(),
                e.updateDots(),
                e.initDotEvents(),
                e.cleanUpSlideEvents(),
                e.initSlideEvents(),
                e.checkResponsive(!1, !0),
                !0 === e.options.focusOnSelect && a(e.$slideTrack).children().on("click.ex_s_lick", e.selectHandler),
                e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0),
                e.setPosition(),
                e.focusHandler(),
                (e.paused = !e.options.autoplay),
                e.autoPlay(),
                e.$slider.trigger("reInit", [e]);
        }),
        (r.prototype.resize = function () {
            var e = this;
            a(window).width() !== e.windowWidth &&
                (clearTimeout(e.windowDelay),
                (e.windowDelay = window.setTimeout(function () {
                    (e.windowWidth = a(window).width()), e.checkResponsive(), e.unex_s_licked || e.setPosition();
                }, 50)));
        }),
        (r.prototype.removeSlide = r.prototype.ex_s_lickRemove = function (e, i, t) {
            var o = this;
            if (((e = "boolean" == typeof e ? (!0 === (i = e) ? 0 : o.slideCount - 1) : !0 === i ? --e : e), o.slideCount < 1 || e < 0 || e > o.slideCount - 1)) return !1;
            o.unload(),
                (!0 === t ? o.$slideTrack.children() : o.$slideTrack.children(this.options.slide).eq(e)).remove(),
                (o.$slides = o.$slideTrack.children(this.options.slide)),
                o.$slideTrack.children(this.options.slide).detach(),
                o.$slideTrack.append(o.$slides),
                (o.$slidesCache = o.$slides),
                o.reinit();
        }),
        (r.prototype.setCSS = function (e) {
            var i,
                t,
                o = this,
                s = {};
            !0 === o.options.rtl && (e = -e),
                (i = "left" == o.positionProp ? Math.ceil(e) + "px" : "0px"),
                (t = "top" == o.positionProp ? Math.ceil(e) + "px" : "0px"),
                (s[o.positionProp] = e),
                !1 === o.transformsEnabled || (!(s = {}) === o.cssTransitions ? (s[o.animType] = "translate(" + i + ", " + t + ")") : (s[o.animType] = "translate3d(" + i + ", " + t + ", 0px)")),
                o.$slideTrack.css(s);
        }),
        (r.prototype.setDimensions = function () {
            var e = this;
            !1 === e.options.vertical
                ? !0 === e.options.centerMode && e.$list.css({ padding: "0px " + e.options.centerPadding })
                : (e.$list.height(e.$slides.first().outerHeight(!0) * e.options.slidesToShow), !0 === e.options.centerMode && e.$list.css({ padding: e.options.centerPadding + " 0px" })),
                (e.listWidth = e.$list.width()),
                (e.listHeight = e.$list.height()),
                !1 === e.options.vertical && !1 === e.options.variableWidth
                    ? ((e.slideWidth = Math.ceil(e.listWidth / e.options.slidesToShow)), e.$slideTrack.width(Math.ceil(e.slideWidth * e.$slideTrack.children(".ex_s_lick-slide").length)))
                    : !0 === e.options.variableWidth
                    ? e.$slideTrack.width(5e3 * e.slideCount)
                    : ((e.slideWidth = Math.ceil(e.listWidth)), e.$slideTrack.height(Math.ceil(e.$slides.first().outerHeight(!0) * e.$slideTrack.children(".ex_s_lick-slide").length)));
            var i = e.$slides.first().outerWidth(!0) - e.$slides.first().width();
            !1 === e.options.variableWidth && e.$slideTrack.children(".ex_s_lick-slide").width(e.slideWidth - i);
        }),
        (r.prototype.setFade = function () {
            var t,
                o = this;
            o.$slides.each(function (e, i) {
                (t = o.slideWidth * e * -1),
                    !0 === o.options.rtl ? a(i).css({ position: "relative", right: t, top: 0, zIndex: o.options.zIndex - 2, opacity: 0 }) : a(i).css({ position: "relative", left: t, top: 0, zIndex: o.options.zIndex - 2, opacity: 0 });
            }),
                o.$slides.eq(o.currentSlide).css({ zIndex: o.options.zIndex - 1, opacity: 1 });
        }),
        (r.prototype.setHeight = function () {
            var e,
                i = this;
            1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical && ((e = i.$slides.eq(i.currentSlide).outerHeight(!0)), i.$list.css("height", e));
        }),
        (r.prototype.setOption = r.prototype.ex_s_lickSetOption = function () {
            var e,
                i,
                t,
                o,
                s,
                n = this,
                r = !1;
            if (
                ("object" === a.type(arguments[0])
                    ? ((t = arguments[0]), (r = arguments[1]), (s = "multiple"))
                    : "string" === a.type(arguments[0]) &&
                      ((t = arguments[0]), (o = arguments[1]), (r = arguments[2]), "responsive" === arguments[0] && "array" === a.type(arguments[1]) ? (s = "responsive") : void 0 !== arguments[1] && (s = "single")),
                "single" === s)
            )
                n.options[t] = o;
            else if ("multiple" === s)
                a.each(t, function (e, i) {
                    n.options[e] = i;
                });
            else if ("responsive" === s)
                for (i in o)
                    if ("array" !== a.type(n.options.responsive)) n.options.responsive = [o[i]];
                    else {
                        for (e = n.options.responsive.length - 1; 0 <= e; ) n.options.responsive[e].breakpoint === o[i].breakpoint && n.options.responsive.splice(e, 1), e--;
                        n.options.responsive.push(o[i]);
                    }
            r && (n.unload(), n.reinit());
        }),
        (r.prototype.setPosition = function () {
            var e = this;
            e.setDimensions(), e.setHeight(), !1 === e.options.fade ? e.setCSS(e.getLeft(e.currentSlide)) : e.setFade(), e.$slider.trigger("setPosition", [e]);
        }),
        (r.prototype.setProps = function () {
            var e = this,
                i = document.body.style;
            (e.positionProp = !0 === e.options.vertical ? "top" : "left"),
                "top" === e.positionProp ? e.$slider.addClass("ex_s_lick-vertical") : e.$slider.removeClass("ex_s_lick-vertical"),
                (void 0 === i.WebkitTransition && void 0 === i.MozTransition && void 0 === i.msTransition) || (!0 === e.options.useCSS && (e.cssTransitions = !0)),
                e.options.fade && ("number" == typeof e.options.zIndex ? e.options.zIndex < 3 && (e.options.zIndex = 3) : (e.options.zIndex = e.defaults.zIndex)),
                void 0 !== i.OTransform && ((e.animType = "OTransform"), (e.transformType = "-o-transform"), (e.transitionType = "OTransition"), void 0 === i.perspectiveProperty && void 0 === i.webkitPerspective && (e.animType = !1)),
                void 0 !== i.MozTransform && ((e.animType = "MozTransform"), (e.transformType = "-moz-transform"), (e.transitionType = "MozTransition"), void 0 === i.perspectiveProperty && void 0 === i.MozPerspective && (e.animType = !1)),
                void 0 !== i.webkitTransform &&
                    ((e.animType = "webkitTransform"), (e.transformType = "-webkit-transform"), (e.transitionType = "webkitTransition"), void 0 === i.perspectiveProperty && void 0 === i.webkitPerspective && (e.animType = !1)),
                void 0 !== i.msTransform && ((e.animType = "msTransform"), (e.transformType = "-ms-transform"), (e.transitionType = "msTransition"), void 0 === i.msTransform && (e.animType = !1)),
                void 0 !== i.transform && !1 !== e.animType && ((e.animType = "transform"), (e.transformType = "transform"), (e.transitionType = "transition")),
                (e.transformsEnabled = e.options.useTransform && null !== e.animType && !1 !== e.animType);
        }),
        (r.prototype.setSlideClasses = function (e) {
            var i,
                t,
                o = this,
                s = o.$slider.find(".ex_s_lick-slide").removeClass("ex_s_lick-active ex_s_lick-center ex_s_lick-current").attr("aria-hidden", "true");
            o.$slides.eq(e).addClass("ex_s_lick-current"),
                !0 === o.options.centerMode
                    ? ((t = Math.floor(o.options.slidesToShow / 2)),
                      !0 === o.options.infinite &&
                          (t <= e && e <= o.slideCount - 1 - t
                              ? o.$slides
                                    .slice(e - t, e + t + 1)
                                    .addClass("ex_s_lick-active")
                                    .attr("aria-hidden", "false")
                              : ((i = o.options.slidesToShow + e),
                                s
                                    .slice(i - t + 1, i + t + 2)
                                    .addClass("ex_s_lick-active")
                                    .attr("aria-hidden", "false")),
                          0 === e ? s.eq(s.length - 1 - o.options.slidesToShow).addClass("ex_s_lick-center") : e === o.slideCount - 1 && s.eq(o.options.slidesToShow).addClass("ex_s_lick-center")),
                      o.$slides.eq(e).addClass("ex_s_lick-center"))
                    : 0 <= e && e <= o.slideCount - o.options.slidesToShow
                    ? o.$slides
                          .slice(e, e + o.options.slidesToShow)
                          .addClass("ex_s_lick-active")
                          .attr("aria-hidden", "false")
                    : s.length <= o.options.slidesToShow
                    ? s.addClass("ex_s_lick-active").attr("aria-hidden", "false")
                    : ((t = o.slideCount % o.options.slidesToShow),
                      (i = !0 === o.options.infinite ? o.options.slidesToShow + e : e),
                      (o.options.slidesToShow == o.options.slidesToScroll && o.slideCount - e < o.options.slidesToShow ? s.slice(i - (o.options.slidesToShow - t), i + t) : s.slice(i, i + o.options.slidesToShow))
                          .addClass("ex_s_lick-active")
                          .attr("aria-hidden", "false")),
                "ondemand" === o.options.lazyLoad && o.lazyLoad();
        }),
        (r.prototype.setupInfinite = function () {
            var e,
                i,
                t,
                o = this;
            if ((!0 === o.options.fade && (o.options.centerMode = !1), !0 === o.options.infinite && !1 === o.options.fade && ((i = null), o.slideCount > o.options.slidesToShow))) {
                for (t = !0 === o.options.centerMode ? o.options.slidesToShow + 1 : o.options.slidesToShow, e = o.slideCount; e > o.slideCount - t; --e)
                    (i = e - 1),
                        a(o.$slides[i])
                            .clone(!0)
                            .attr("id", "")
                            .attr("data-ex_s_lick-index", i - o.slideCount)
                            .prependTo(o.$slideTrack)
                            .addClass("ex_s_lick-cloned");
                for (e = 0; e < t; e += 1)
                    (i = e),
                        a(o.$slides[i])
                            .clone(!0)
                            .attr("id", "")
                            .attr("data-ex_s_lick-index", i + o.slideCount)
                            .appendTo(o.$slideTrack)
                            .addClass("ex_s_lick-cloned");
                o.$slideTrack
                    .find(".ex_s_lick-cloned")
                    .find("[id]")
                    .each(function () {
                        a(this).attr("id", "");
                    });
            }
        }),
        (r.prototype.interrupt = function (e) {
            e || this.autoPlay(), (this.interrupted = e);
        }),
        (r.prototype.selectHandler = function (e) {
            var i = this,
                e = a(e.target).is(".ex_s_lick-slide") ? a(e.target) : a(e.target).parents(".ex_s_lick-slide"),
                e = (e = parseInt(e.attr("data-ex_s_lick-index"))) || 0;
            if (i.slideCount <= i.options.slidesToShow) return i.setSlideClasses(e), void i.asNavFor(e);
            i.slideHandler(e);
        }),
        (r.prototype.slideHandler = function (e, i, t) {
            var o,
                s,
                n,
                r,
                l = this;
            if (((i = i || !1), (!0 !== l.animating || !0 !== l.options.waitForAnimate) && !((!0 === l.options.fade && l.currentSlide === e) || l.slideCount <= l.options.slidesToShow)))
                if (
                    (!1 === i && l.asNavFor(e),
                    (o = e),
                    (n = l.getLeft(o)),
                    (i = l.getLeft(l.currentSlide)),
                    (l.currentLeft = null === l.swipeLeft ? i : l.swipeLeft),
                    !1 === l.options.infinite && !1 === l.options.centerMode && (e < 0 || e > l.getDotCount() * l.options.slidesToScroll))
                )
                    !1 === l.options.fade &&
                        ((o = l.currentSlide),
                        !0 !== t
                            ? l.animateSlide(i, function () {
                                  l.postSlide(o);
                              })
                            : l.postSlide(o));
                else if (!1 === l.options.infinite && !0 === l.options.centerMode && (e < 0 || e > l.slideCount - l.options.slidesToScroll))
                    !1 === l.options.fade &&
                        ((o = l.currentSlide),
                        !0 !== t
                            ? l.animateSlide(i, function () {
                                  l.postSlide(o);
                              })
                            : l.postSlide(o));
                else {
                    if (
                        (l.options.autoplay && clearInterval(l.autoPlayTimer),
                        (s =
                            o < 0
                                ? l.slideCount % l.options.slidesToScroll != 0
                                    ? l.slideCount - (l.slideCount % l.options.slidesToScroll)
                                    : l.slideCount + o
                                : o >= l.slideCount
                                ? l.slideCount % l.options.slidesToScroll != 0
                                    ? 0
                                    : o - l.slideCount
                                : o),
                        (l.animating = !0),
                        l.$slider.trigger("beforeChange", [l, l.currentSlide, s]),
                        (i = l.currentSlide),
                        (l.currentSlide = s),
                        l.setSlideClasses(l.currentSlide),
                        l.options.asNavFor && (r = (r = l.getNavTarget()).EX_ex_s_lick("getEXT_Slick")).slideCount <= r.options.slidesToShow && r.setSlideClasses(l.currentSlide),
                        l.updateDots(),
                        l.updateArrows(),
                        !0 === l.options.fade)
                    )
                        return (
                            !0 !== t
                                ? (l.fadeSlideOut(i),
                                  l.fadeSlide(s, function () {
                                      l.postSlide(s);
                                  }))
                                : l.postSlide(s),
                            void l.animateHeight()
                        );
                    !0 !== t
                        ? l.animateSlide(n, function () {
                              l.postSlide(s);
                          })
                        : l.postSlide(s);
                }
        }),
        (r.prototype.startLoad = function () {
            var e = this;
            !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.hide(), e.$nextArrow.hide()),
                !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.hide(),
                e.$slider.addClass("ex_s_lick-loading");
        }),
        (r.prototype.swipeDirection = function () {
            var e = this,
                i = e.touchObject.startX - e.touchObject.curX,
                t = e.touchObject.startY - e.touchObject.curY,
                i = Math.atan2(t, i),
                i = Math.round((180 * i) / Math.PI);
            return (
                i < 0 && (i = 360 - Math.abs(i)),
                (i <= 45 && 0 <= i) || (i <= 360 && 315 <= i)
                    ? !1 === e.options.rtl
                        ? "left"
                        : "right"
                    : 135 <= i && i <= 225
                    ? !1 === e.options.rtl
                        ? "right"
                        : "left"
                    : !0 === e.options.verticalSwiping
                    ? 35 <= i && i <= 135
                        ? "down"
                        : "up"
                    : "vertical"
            );
        }),
        (r.prototype.swipeEnd = function (e) {
            var i,
                t,
                o = this;
            if (((o.dragging = !1), (o.interrupted = !1), (o.shouldClick = !(10 < o.touchObject.swipeLength)), void 0 === o.touchObject.curX)) return !1;
            if ((!0 === o.touchObject.edgeHit && o.$slider.trigger("edge", [o, o.swipeDirection()]), o.touchObject.swipeLength >= o.touchObject.minSwipe)) {
                switch ((t = o.swipeDirection())) {
                    case "left":
                    case "down":
                        (i = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide + o.getSlideCount()) : o.currentSlide + o.getSlideCount()), (o.currentDirection = 0);
                        break;
                    case "right":
                    case "up":
                        (i = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide - o.getSlideCount()) : o.currentSlide - o.getSlideCount()), (o.currentDirection = 1);
                }
                "vertical" != t && (o.slideHandler(i), (o.touchObject = {}), o.$slider.trigger("swipe", [o, t]));
            } else o.touchObject.startX !== o.touchObject.curX && (o.slideHandler(o.currentSlide), (o.touchObject = {}));
        }),
        (r.prototype.swipeHandler = function (e) {
            var i = this;
            if (!(!1 === i.options.swipe || ("ontouchend" in document && !1 === i.options.swipe) || (!1 === i.options.draggable && -1 !== e.type.indexOf("mouse"))))
                switch (
                    ((i.touchObject.fingerCount = e.originalEvent && void 0 !== e.originalEvent.touches ? e.originalEvent.touches.length : 1),
                    (i.touchObject.minSwipe = i.listWidth / i.options.touchThreshold),
                    !0 === i.options.verticalSwiping && (i.touchObject.minSwipe = i.listHeight / i.options.touchThreshold),
                    e.data.action)
                ) {
                    case "start":
                        i.swipeStart(e);
                        break;
                    case "move":
                        i.swipeMove(e);
                        break;
                    case "end":
                        i.swipeEnd(e);
                }
        }),
        (r.prototype.swipeMove = function (e) {
            var i,
                t,
                o = this,
                s = void 0 !== e.originalEvent ? e.originalEvent.touches : null;
            return (
                !(!o.dragging || (s && 1 !== s.length)) &&
                ((i = o.getLeft(o.currentSlide)),
                (o.touchObject.curX = void 0 !== s ? s[0].pageX : e.clientX),
                (o.touchObject.curY = void 0 !== s ? s[0].pageY : e.clientY),
                (o.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(o.touchObject.curX - o.touchObject.startX, 2)))),
                !0 === o.options.verticalSwiping && (o.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(o.touchObject.curY - o.touchObject.startY, 2)))),
                "vertical" !== (t = o.swipeDirection())
                    ? (void 0 !== e.originalEvent && 4 < o.touchObject.swipeLength && e.preventDefault(),
                      (s = (!1 === o.options.rtl ? 1 : -1) * (o.touchObject.curX > o.touchObject.startX ? 1 : -1)),
                      !0 === o.options.verticalSwiping && (s = o.touchObject.curY > o.touchObject.startY ? 1 : -1),
                      (e = o.touchObject.swipeLength),
                      (o.touchObject.edgeHit = !1) === o.options.infinite &&
                          ((0 === o.currentSlide && "right" === t) || (o.currentSlide >= o.getDotCount() && "left" === t)) &&
                          ((e = o.touchObject.swipeLength * o.options.edgeFriction), (o.touchObject.edgeHit = !0)),
                      !1 === o.options.vertical ? (o.swipeLeft = i + e * s) : (o.swipeLeft = i + e * (o.$list.height() / o.listWidth) * s),
                      !0 === o.options.verticalSwiping && (o.swipeLeft = i + e * s),
                      !0 !== o.options.fade && !1 !== o.options.touchMove && (!0 === o.animating ? ((o.swipeLeft = null), !1) : void o.setCSS(o.swipeLeft)))
                    : void 0)
            );
        }),
        (r.prototype.swipeStart = function (e) {
            var i,
                t = this;
            if (((t.interrupted = !0), 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow)) return !(t.touchObject = {});
            void 0 !== e.originalEvent && void 0 !== e.originalEvent.touches && (i = e.originalEvent.touches[0]),
                (t.touchObject.startX = t.touchObject.curX = void 0 !== i ? i.pageX : e.clientX),
                (t.touchObject.startY = t.touchObject.curY = void 0 !== i ? i.pageY : e.clientY),
                (t.dragging = !0);
        }),
        (r.prototype.unfilterSlides = r.prototype.ex_s_lickUnfilter = function () {
            var e = this;
            null !== e.$slidesCache && (e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.appendTo(e.$slideTrack), e.reinit());
        }),
        (r.prototype.unload = function () {
            var e = this;
            a(".ex_s_lick-cloned", e.$slider).remove(),
                e.$dots && e.$dots.remove(),
                e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(),
                e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(),
                e.$slides.removeClass("ex_s_lick-slide ex_s_lick-active ex_s_lick-visible ex_s_lick-current").attr("aria-hidden", "true").css("width", "");
        }),
        (r.prototype.unex_s_lick = function (e) {
            this.$slider.trigger("unex_s_lick", [this, e]), this.destroy();
        }),
        (r.prototype.updateArrows = function () {
            var e = this;
            Math.floor(e.options.slidesToShow / 2);
            !0 === e.options.arrows &&
                e.slideCount > e.options.slidesToShow &&
                !e.options.infinite &&
                (e.$prevArrow.removeClass("ex_s_lick-disabled").attr("aria-disabled", "false"),
                e.$nextArrow.removeClass("ex_s_lick-disabled").attr("aria-disabled", "false"),
                0 === e.currentSlide
                    ? (e.$prevArrow.addClass("ex_s_lick-disabled").attr("aria-disabled", "true"), e.$nextArrow.removeClass("ex_s_lick-disabled").attr("aria-disabled", "false"))
                    : ((e.currentSlide >= e.slideCount - e.options.slidesToShow && !1 === e.options.centerMode) || (e.currentSlide >= e.slideCount - 1 && !0 === e.options.centerMode)) &&
                      (e.$nextArrow.addClass("ex_s_lick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("ex_s_lick-disabled").attr("aria-disabled", "false")));
        }),
        (r.prototype.updateDots = function () {
            var e = this;
            null !== e.$dots &&
                (e.$dots.find("li").removeClass("ex_s_lick-active").attr("aria-hidden", "true"),
                e.$dots
                    .find("li")
                    .eq(Math.floor(e.currentSlide / e.options.slidesToScroll))
                    .addClass("ex_s_lick-active")
                    .attr("aria-hidden", "false"));
        }),
        (r.prototype.visibility = function () {
            this.options.autoplay && (document[this.hidden] ? (this.interrupted = !0) : (this.interrupted = !1));
        }),
        (a.fn.EX_ex_s_lick = function () {
            for (var e, i = this, t = arguments[0], o = Array.prototype.slice.call(arguments, 1), s = i.length, n = 0; n < s; n++)
                if (("object" == typeof t || void 0 === t ? (i[n].EX_ex_s_lick = new r(i[n], t)) : (e = i[n].EX_ex_s_lick[t].apply(i[n].EX_ex_s_lick, o)), void 0 !== e)) return e;
            return i;
        });
});
