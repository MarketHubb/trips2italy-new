var Wptl_El_Sp = {
    timelines_hoz: function () {
        "use strict";
        return (
            jQuery(window).resize(function () {
                jQuery(".horizontal-timeline:not(.ex-multi-item)").each(function () {
                    var a = jQuery(this);
                    setTimeout(function () {
                        var e = a.data("id"),
                            t = jQuery("#" + e + " ul.horizontal-nav li.ex_s_lick-current"),
                            l = t.offset(),
                            i = jQuery("#" + e + " .horizontal-nav").offset(),
                            t = t.width(),
                            t = l.left - i.left + t / 2;
                        jQuery("#" + e + " .timeline-pos-select").css("width", t);
                    }, 200);
                });
            }),
            jQuery(".horizontal-timeline.ld-screen").length &&
                ((window.onload = function (e) {
                    window.jQuery && jQuery(".horizontal-timeline.ld-screen").addClass("at-childdiv");
                }),
                setTimeout(function () {
                    jQuery(".horizontal-timeline.ld-screen").addClass("at-childdiv");
                }, 4e3)),
            jQuery(".horizontal-timeline:not(.ex-multi-item)").each(function () {
                var e, u, p, h, t, l, i, a, n, m, s;
                jQuery(this).hasClass("hoz-at") ||
                    (jQuery(this).addClass("hoz-at"),
                    (e = jQuery(this)).hasClass("tl-hozsteps") && (s = !1),
                    e.data("layout"),
                    (u = e.data("id")),
                    (p = e.data("count")),
                    "" == (h = e.data("slidesshow")) && (h = 3),
                    (t = e.data("arrowpos")),
                    0 < e.data("startit") && e.data("startit"),
                    (l = e.data("autoplay")),
                    (i = e.data("speed")),
                    (a = e.data("rtl")),
                    (n = 0 < e.data("start_on") ? e.data("start_on") : 0),
                    (m = "0" == e.data("infinite") ? 0 : "yes" == e.data("infinite") || "1" == e.data("infinite")),
                    (s = e.data("center")),
                    jQuery("#" + u + " .horizontal-content")
                        .on("beforeChange", function (e, t, l, i) {
                            1 == m || 0 == m
                                ? ((t = t.currentSlide), (t = jQuery("#" + u + ' ul.horizontal-nav li[data-ex_s_lick-index="' + t + '"]')).prevAll().addClass("prev_item"), t.removeClass("prev_item"), t.nextAll().removeClass("prev_item"))
                                : ((i = i + 1),
                                  jQuery("#" + u + " .horizontal-nav li.ex_s_lick-slide:nth-child(" + i + ")")
                                      .prevAll()
                                      .addClass("prev_item"),
                                  jQuery("#" + u + " .horizontal-nav li.ex_s_lick-slide:nth-child(" + i + ")")
                                      .nextAll()
                                      .removeClass("prev_item"));
                        })
                        .on("afterChange", function (e, t, l, i) {
                            if (1 == m) {
                                s = t.currentSlide;
                                var a = jQuery("#" + u + ' ul.horizontal-nav li[data-ex_s_lick-index="' + s + '"]');
                                p == h && ((n = a.offset()), (r = jQuery("#" + u + " .horizontal-nav").offset()), (d = a.width()), (c = n.left - r.left + d / 2), jQuery("#" + u + " .timeline-pos-select").css("width", c));
                            } else {
                                var s = t.currentSlide;
                                0 == s && 0 == m && jQuery("#" + u).resize();
                                for (var o = 0; o < t.$slides.length; o++)
                                    if ((a = jQuery(t.$slides[o])).hasClass("ex_s_lick-current")) {
                                        var n = (a = jQuery("#" + u + " ul.horizontal-nav li:nth-child(" + (o + 1) + ")")).offset(),
                                            r = jQuery("#" + u + " .horizontal-nav").offset(),
                                            d = a.width(),
                                            c = n.left - r.left + d / 2;
                                        jQuery("#" + u + " .timeline-pos-select").css("width", c);
                                        break;
                                    }
                            }
                            a.prevAll().addClass("prev_item"),
                                a.removeClass("prev_item"),
                                a.nextAll().removeClass("prev_item"),
                                jQuery("#" + u).hasClass("extl-stop-end") && jQuery("#" + u + " ul.horizontal-nav li").length === s + 1 && t.ex_s_lickSetOption("autoplay", !1, !1);
                        })
                        .EX_ex_s_lick({
                            infinite: m,
                            speed: 250,
                            initialSlide: n,
                            rtl: "yes" == a,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            adaptiveHeight: !0,
                            autoplay: 1 == l && p <= h,
                            arrows: "top" != t,
                            prevArrow: '<button type="button" class="ex_s_lick-prev"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-left"></i></button>',
                            nextArrow: '<button type="button" class="ex_s_lick-next"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-right"></i></button>',
                            fade: !0,
                            asNavFor: "#" + u + " .horizontal-nav",
                            pauseOnHover: !0,
                        }),
                    jQuery("#" + u + " .horizontal-nav")
                        .on("init", function (e, t, l) {
                            var i, a, s, o;
                            "" != n && jQuery.isNumeric(n) ? (jQuery("#" + u + " ul.horizontal-nav li").removeClass("ex_s_lick-current"), (o = jQuery(t.$slides[n])).addClass("ex_s_lick-current")) : (o = jQuery(t.$slides[0])),
                                o.hasClass("ex_s_lick-current") &&
                                    (jQuery("#" + u + " ul.horizontal-nav li.ex_s_lick-current").trigger("click"), (i = o.offset()), (a = jQuery("#" + u + " .horizontal-nav").offset()), (s = o.width()), (s = i.left - a.left + s / 2)),
                                jQuery("#" + u + " ul.horizontal-nav li").hasClass("ex_s_lick-center")
                                    ? jQuery("#" + u + " .timeline-pos-select").css("width", jQuery("#" + u + " .horizontal-nav").width / 2)
                                    : jQuery("#" + u + " .timeline-pos-select").css("width", s),
                                (1 != m && 0 != m) ||
                                    ((t = t.currentSlide), (o = jQuery("#" + u + ' ul.horizontal-nav li[data-ex_s_lick-index="' + t + '"]')).prevAll().addClass("prev_item"), o.removeClass("prev_item"), o.nextAll().removeClass("prev_item"));
                        })
                        .on("breakpoint", function (e, t, l) {
                            jQuery("#" + u).removeClass("at-childdiv"),
                                setTimeout(function () {
                                    t.ex_s_lickGoTo(parseInt(n)), jQuery("#" + u).addClass("at-childdiv");
                                }, 400);
                        })
                        .on("afterChange", function (e, t, l, i) {
                            var a;
                            jQuery("#" + u).hasClass("extl-stop-end") && ((a = t.currentSlide), jQuery("#" + u + " ul.horizontal-nav li").length === a + 1 && t.ex_s_lickSetOption("autoplay", !1, !1));
                        })
                        .EX_ex_s_lick({
                            infinite: m,
                            speed: 250,
                            initialSlide: n,
                            rtl: "yes" == a,
                            prevArrow: '<button type="button" class="ex_s_lick-prev"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-left"></i></button>',
                            nextArrow: '<button type="button" class="ex_s_lick-next"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-right"></i></button>',
                            slidesToShow: h,
                            slidesToScroll: 1,
                            asNavFor: "#" + u + " .horizontal-content",
                            dots: !1,
                            autoplay: 1 == l,
                            autoplaySpeed: "" != i ? i : 3e3,
                            arrows: "top" == t,
                            centerMode: "left" != s,
                            focusOnSelect: !0,
                            pauseOnHover: !0,
                            responsive: [
                                { breakpoint: 1024, settings: { slidesToShow: h, slidesToScroll: 1 } },
                                { breakpoint: 767, settings: { slidesToShow: 1, slidesToScroll: 1 } },
                                { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
                            ],
                        }));
            }),
            this
        );
    },
    timelines_hoz_multi: function () {
        "use strict";
        return (
            jQuery(".horizontal-timeline.ex-multi-item").each(function () {
                var e,
                    t,
                    l,
                    i,
                    a,
                    s,
                    o,
                    n = jQuery(this);
                jQuery(this).hasClass("hoz-at") ||
                    (jQuery(this).addClass("hoz-at"),
                    (e = n.data("id")),
                    "" == (t = n.data("slidesshow")) && (t = 3),
                    0 < n.data("startit") && n.data("startit"),
                    (l = n.data("autoplay")),
                    (i = n.data("speed")),
                    (a = n.data("rtl")),
                    (s = 0 < n.data("start_on") ? n.data("start_on") : 0),
                    (o = "0" == n.data("infinite") ? 0 : "yes" == n.data("infinite") || "1" == n.data("infinite")),
                    (n = [
                        { breakpoint: 1024, settings: { slidesToShow: t, slidesToScroll: 1 } },
                        { breakpoint: 767, settings: { slidesToShow: jQuery("#" + e + " .horizontal-sl-2").length ? 2 : 1, slidesToScroll: 1 } },
                        { breakpoint: 480, settings: { slidesToShow: jQuery("#" + e + " .horizontal-sl-2").length ? 2 : 1, slidesToScroll: 1 } },
                    ]),
                    jQuery("#" + e + " .horizontal-nav").EX_ex_s_lick({
                        infinite: o,
                        initialSlide: s,
                        rtl: "yes" == a,
                        prevArrow: '<button type="button" class="ex_s_lick-prev"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-left"></i></button>',
                        nextArrow: '<button type="button" class="ex_s_lick-next"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-right"></i></button>',
                        slidesToShow: t,
                        slidesToScroll: 1,
                        dots: !1,
                        autoplay: 1 == l,
                        autoplaySpeed: "" != i ? i : 3e3,
                        arrows: !0,
                        centerMode: !1,
                        focusOnSelect: !0,
                        adaptiveHeight: !0,
                        asNavFor: jQuery("#" + e + " .horizontal-sl-2").length ? "#" + e + " .horizontal-sl-2" : "",
                        responsive: n,
                    }),
                    jQuery("#" + e + " .horizontal-sl-2").length &&
                        jQuery("#" + e + " .horizontal-sl-2").EX_ex_s_lick({
                            infinite: o,
                            initialSlide: s,
                            rtl: "yes" == a,
                            slidesToShow: t,
                            slidesToScroll: 1,
                            dots: !1,
                            arrows: !1,
                            centerMode: !1,
                            focusOnSelect: !0,
                            adaptiveHeight: !0,
                            asNavFor: "#" + e + " .extl-nav",
                            responsive: n,
                        }));
            }),
            this
        );
    },
};
!(function () {
    "use strict";
    jQuery(document).ready(function (c) {
        function u() {
            c(".extllightbox").length &&
                c(".extllightbox").each(function () {
                    var e = c(this).data("class"),
                        t = (GLightbox(), c(".glightbox-desc").data("close-outsite"));
                    GLightbox({
                        selector: e,
                        moreLength: 0,
                        touchNavigation: !0,
                        closeOnOutsideClick: 1 == t,
                        type: "inline",
                        lightboxHtml:
                            '<div id="glightbox-body" class="extl-lb glightbox-container">\t\t\t\t\t  <div class="gloader visible"></div>\t\t\t\t\t  <div class="goverlay"></div>\t\t\t\t\t  <div class="gcontainer">\t\t\t\t\t     <div id="glightbox-slider" class="gslider"></div>\t\t\t\t\t     <a class="gnext"></a>\t\t\t\t\t     <a class="gprev"></a>\t\t\t\t\t     <a class="gclose"></a>\t\t\t\t\t  </div>\t\t\t\t\t</div>',
                        afterSlideLoad: function (e, t) {
                            var l, i, a;
                            c(".exlb-gallery-carousel").length &&
                                ((l = c(".wpex-timeline-list").data("rtl")),
                                (i = c(".extl-gallery-carousel").data("autoplay")),
                                (a = c(".extl-gallery-carousel").data("autoplay_speed")),
                                c(".loaded .exlb-gallery-carousel:not(.glled-lb)").EX_ex_s_lick({
                                    dots: !0,
                                    slidesToShow: 1,
                                    infinite: !0,
                                    speed: 500,
                                    fade: !0,
                                    cssEase: "linear",
                                    adaptiveHeight: !0,
                                    autoplay: "yes" == i,
                                    autoplaySpeed: "" != a ? a : 2e3,
                                    arrows: !1,
                                    prevArrow: '<button type="button" class="ex_s_lick-prev"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-left"></i></button>',
                                    nextArrow: '<button type="button" class="ex_s_lick-next"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-right"></i></button>',
                                    rtl: "yes" == l,
                                }),
                                c(".loaded .exlb-gallery-carousel").addClass("glled-lb"));
                        },
                    });
                });
        }
        function n() {
            c(".wpex-timeline-list.wpex-infinite, .wpifgr-timeline.wpex-infinite").each(function () {
                var e,
                    t,
                    l,
                    i,
                    a,
                    s = jQuery(this).attr("id");
                c("#" + s + " .wpex-loadmore a.loadmore-timeline").length &&
                    ((e = c("#" + s + " .wpex-loadmore a.loadmore-timeline")),
                    (t = "#" + s + " .wpex-loadmore a.loadmore-timeline"),
                    (l = jQuery(window).scrollTop()),
                    (i = l + jQuery(window).height()),
                    (a = jQuery(t).offset().top) + jQuery(t).height() <= i + 200 && l <= a && !e.hasClass("loading") && !c("#" + s + " .wpex-loadmore").hasClass("hidden") && e.trigger("click"));
            });
        }
        function p() {
            var e, t, l;
            c(".extl-gallery-carousel").length &&
                ((e = c(".wpex-timeline-list").data("rtl")),
                (t = c(".extl-gallery-carousel").data("autoplay")),
                (l = c(".extl-gallery-carousel").data("autoplay_speed")),
                c(".extl-gallery-carousel:not(.glled)").EX_ex_s_lick({
                    dots: !0,
                    slidesToShow: 1,
                    infinite: !0,
                    speed: 500,
                    fade: !0,
                    cssEase: "linear",
                    adaptiveHeight: !0,
                    autoplay: "yes" == t,
                    autoplaySpeed: "" != l ? l : 2e3,
                    arrows: !0,
                    prevArrow: '<button type="button" class="ex_s_lick-prev"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-left"></i></button>',
                    nextArrow: '<button type="button" class="ex_s_lick-next"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-right"></i></button>',
                    rtl: "yes" == e,
                }),
                c(".extl-gallery-carousel").addClass("glled"),
                c(".wpex-timeline-list:not(.wptl-lightbox) .extl-gallery-carousel").on("click", function (e) {
                    e.stopPropagation();
                }));
        }
        function h() {
            var s = c(this);
            c(".wpex-timeline-list, .wpifgr-timeline").each(function () {
                var l = jQuery(this).attr("id"),
                    e = c(this),
                    t = e.offset().top,
                    e = t + e.height();
                (t -= 200), c(document).scrollTop() >= t && c(document).scrollTop() <= e ? c("#" + l + " .wpex-filter").addClass("active") : c("#" + l + " .wpex-filter").removeClass("active");
                var i = c(window).height(),
                    a = 0.3 * i;
                s.scrollTop();
                c("#" + l + " ul:not(.wpex-taxonomy-filter):not(.page-numbers) li").each(function () {
                    var e = c(this).data("id"),
                        t = c(this).offset().top - c(window).scrollTop();
                    c(this).height();
                    a <= t ? c("#" + e).removeClass("active") : c("#" + e).addClass("active");
                    e = c("#" + l).data("animations");
                    "" != e &&
                        t < 0.7 * i &&
                        (c(this)
                            .children(":first")
                            .removeClass("scroll-effect")
                            .addClass(e + " animated"),
                        c(this).find(".extl-gallery-carousel:not(.glled)").length &&
                            (c(this)
                                .find(".extl-gallery-carousel:not(.glled)")
                                .EX_ex_s_lick({
                                    dots: !0,
                                    slidesToShow: 1,
                                    infinite: !0,
                                    speed: 500,
                                    fade: !0,
                                    cssEase: "linear",
                                    adaptiveHeight: !0,
                                    arrows: !0,
                                    prevArrow: '<button type="button" class="ex_s_lick-prev"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-left"></i></button>',
                                    nextArrow: '<button type="button" class="ex_s_lick-next"><i class="text-brand-500/50 hover:text-brand-500 fa fa-angle-right"></i></button>',
                                    rtl: !1,
                                }),
                            c(this).find(".extl-gallery-carousel").addClass("glled")));
                });
            });
        }
        function l(l, e) {
            var t = c("#" + l + " input[name=ajax_url]").val(),
                i = c("#" + l + " input[name=param_shortcode]").val();
            c("#" + l).addClass("loading"),
                c("#" + l + " ul.wpex-timeline li").fadeOut(300, function () {
                    c(this).remove();
                }),
                c("#" + l + " input[name=num_page_uu]").val(1),
                c("#" + l + " input[name=current_page]").val(1),
                c("#" + l + " .wpex-tltitle.wpex-loadmore .yft").remove();
            i = { action: "wpex_filter_taxonomy", taxonomy_id: e, param_shortcode: i };
            c.ajax({
                type: "post",
                url: t,
                dataType: "json",
                data: i,
                success: function (e) {
                    var t;
                    "0" != e
                        ? ("" == e
                              ? c("#" + l + " .wpex-loadmore.lbt").addClass("hidden")
                              : (c("#" + l + " ul.infogr-list").length
                                    ? ((t = c("#" + l + " ul.infogr-list > li").length),
                                      (t += e.count) % 2 != 0 ? c("#" + l + " ul.infogr-list").removeClass("exif-nb-even") : c("#" + l + " ul.infogr-list").addClass("exif-nb-even"),
                                      (t = c("#" + l + " ul.infogr-list")),
                                      setTimeout(function () {
                                          c("#" + l + " .extl-gallery-carousel").EX_ex_s_lick("setPosition");
                                      }, 200))
                                    : (t = c("#" + l + " ul.wpex")),
                                t.html(""),
                                t.append(e.html_content),
                                c("#" + l + " .wpex-filter:not(.year-ft) div span").remove(),
                                c("#" + l + " .wpex-filter:not(.year-ft) div").append(e.date),
                                setTimeout(function () {
                                    c("#" + l + " ul.wpex > li").addClass("active");
                                }, 200),
                                c("#" + l).removeClass("loading"),
                                c("#" + l + " input[name=param_query]").val(JSON.stringify(e.data_query))),
                          1 != e.more ? (c("#" + l).addClass("no-more"), c("#" + l + " .wpex-loadmore.lbt").addClass("hidden")) : c("#" + l).removeClass("no-more"),
                          u(),
                          h(),
                          p(),
                          c(".wpex-timeline-list .wpex-filter:not(.active)").css("right", -1 * c(".wpex-timeline-list .wpex-filter").width()))
                        : c(".row.loadmore").html("error");
                },
            });
        }
        u(),
            p(),
            c(".wpex-filter:not(.year-ft)").on("click", "div span", function () {
                var e = jQuery(this).attr("id"),
                    t = c(window).height();
                c("html,body").animate({ scrollTop: c("." + e).offset().top - 0.2 * t }, "slow");
            }),
            c(".wpex-timeline-list, .wpifgr-timeline").length &&
                (h(),
                n(),
                c(document).scroll(function () {
                    h(), n();
                })),
            c(".wpex-filter.year-ft").on("click", "div span", function () {
                var l = c(this),
                    e = jQuery(this).data("id");
                c("#timeline-" + e).addClass("loading no-more");
                var i = "timeline-" + e;
                c("#" + i + " .wpex-filter.year-ft div span").removeClass("active"), l.addClass("active");
                var t = jQuery(this).data("value"),
                    a = "";
                c("#" + i + " .wpex-taxonomy-filter li a.active").length && (a = c("#" + i + " .wpex-taxonomy-filter li a.active").data("value"));
                var s = c("#timeline-" + e + " input[name=ajax_url]").val(),
                    o = c("#timeline-" + e + " input[name=param_shortcode]").val();
                c("#" + i + " .wpex-loadmore.lbt").addClass("hidden"),
                    c("#timeline-" + e + " ul.wpex-timeline li").fadeOut(300, function () {
                        c(this).remove();
                    });
                o = { action: "wpex_filter_year", taxonomy_id: t, mult: a, param_shortcode: o };
                return (
                    c.ajax({
                        type: "post",
                        url: s,
                        dataType: "json",
                        data: o,
                        success: function (e) {
                            var t;
                            "0" != e
                                ? ("" != e &&
                                      ((t = c("#" + i + " ul.wpex")).html(""),
                                      "" != e.html_content
                                          ? (c("#" + i + " .wpex-tltitle.wpex-loadmore").prepend('<span class="yft">' + l.html() + "</span>"), c("#" + i + " .wpex-loadmore:not(.lbt)").removeClass("hidden"), t.append(e.html_content))
                                          : (c("#" + i + " .wpex-loadmore").addClass("hidden"), t.append('<h2 style="text-align: center;">' + e.massage + "</h2>")),
                                      setTimeout(function () {
                                          c("#" + i + " ul.wpex > li").addClass("active");
                                      }, 200),
                                      c("#" + i).removeClass("loading")),
                                  h(),
                                  n(),
                                  p(),
                                  c(".wpex-timeline-list .wpex-filter:not(.active)").css("right", -1 * c(".wpex-timeline-list .wpex-filter").width()))
                                : c(".row.loadmore").html("error");
                        },
                    }),
                    !1
                );
            }),
            c(".wpex-taxonomy-filter").on("click", "li", function () {
                var e = c(this),
                    t = "timeline-" + jQuery(this).data("id");
                c("#" + t + " .wpex-taxonomy-filter li").removeClass("active"),
                    c("#" + t + " .wpex-taxonomy-filter li").removeClass("crr-at"),
                    c("#" + t + " .wpex-filter.year-ft div span").removeClass("active"),
                    c("#" + t + " .wpex-loadmore").removeClass("hidden"),
                    e.addClass("active crr-at"),
                    e.parents("li").addClass("active");
                e = jQuery(this).data("value");
                return c("#" + t + " .wpex-taxonomy-select option[value='" + e + "']").attr("selected", "selected"), l(t, e), !1;
            }),
            c(".wptl-filter-box select[name=wpex_taxonomy]").on("change", function (e) {
                e.preventDefault();
                c(this);
                var t = "timeline-" + jQuery(this).find(":selected").data("id"),
                    e = jQuery(this).find(":selected").val();
                return (
                    c("#" + t + " .wpex-taxonomy-filter li").removeClass("active"),
                    c("#" + t + " .wpex-taxonomy-filter li[data-value='" + e + "']").addClass("active"),
                    c("#" + t + " .wpex-taxonomy-filter li[data-value='" + e + "']")
                        .parents("li")
                        .addClass("active"),
                    l(t, e),
                    !1
                );
            }),
            c(".loadmore-timeline").on("click", function () {
                var l = c(this);
                l.addClass("disable-click");
                var i = l.data("id"),
                    a = c("#" + i + " input[name=num_page_uu]").val();
                c("#" + i + " .loadmore-timeline").addClass("loading");
                var e = c("#" + i + " input[name=param_query]").val(),
                    s = c("#" + i + " input[name=current_page]").val(),
                    o = c("#" + i + " input[name=num_page]").val(),
                    t = c("#" + i + " input[name=ajax_url]").val(),
                    n = c("#" + i + " input[name=param_shortcode]").val(),
                    r = "",
                    d = l.data("tl_language");
                c("#" + i + " li:last-child > input.crr-year").length && (r = c("#" + i + " li:last-child > input.crr-year").val());
                d = { action: "wpex_loadmore_timeline", param_query: e, page: +s + 1, param_shortcode: n, param_year: r, lang: d };
                return (
                    c.ajax({
                        type: "post",
                        url: t,
                        dataType: "json",
                        data: d,
                        success: function (e) {
                            var t;
                            "0" != e
                                ? ((a = +a + 1),
                                  c("#" + i + " input[name=num_page_uu]").val(a),
                                  "" == e.html_content
                                      ? c("#" + i + " .wpex-loadmore.lbt").addClass("hidden")
                                      : (c("#" + i + " input[name=current_page]").val(+s + 1),
                                        c("#" + i + " ul.infogr-list").length
                                            ? ((t = c("#" + i + " ul.infogr-list > li").length),
                                              (t += e.count) % 2 != 0 ? c("#" + i + " ul.infogr-list").removeClass("exif-nb-even") : c("#" + i + " ul.infogr-list").addClass("exif-nb-even"),
                                              (t = c("#" + i + " ul.infogr-list")),
                                              setTimeout(function () {
                                                  c("#" + i + " .extl-gallery-carousel").EX_ex_s_lick("setPosition");
                                              }, 200))
                                            : (t = c("#" + i + " ul.wpex")),
                                        t.append(e.html_content),
                                        c("#" + i + " .wpex-filter:not(.year-ft) div").append(e.date),
                                        setTimeout(function () {
                                            c("#" + i + " ul.wpex > li").addClass("active");
                                        }, 200)),
                                  a == o && (c("#" + i).addClass("no-more"), c("#" + i + " .wpex-loadmore.lbt").addClass("hidden")),
                                  h(),
                                  u(),
                                  p(),
                                  c(".wpex-timeline-list .wpex-filter:not(.active)").css("right", -1 * c(".wpex-timeline-list .wpex-filter").width()),
                                  c("#" + i + " .loadmore-timeline").removeClass("loading"),
                                  l.removeClass("disable-click"))
                                : c(".row.loadmore").html("error");
                        },
                    }),
                    !1
                );
            }),
            c(".wpex-timeline-list .wpex-filter").css("right", -1 * c(".wpex-timeline-list .wpex-filter").width()),
            c(".wpifgr-timeline .wpex-filter").css("right", -1 * c(".wpifgr-timeline .wpex-filter").width()),
            c(".wpex-timeline-list .wpex-filter > .fa, .wpifgr-timeline .wpex-filter > .fa").on("click", function () {
                var e = c(this).data("id");
                c("#" + e + " .wpex-filter").hasClass("show-filter")
                    ? (c("#" + e + " .wpex-filter").removeClass("show-filter"), c("#" + e + " .wpex-filter").css("right", -1 * c("#" + e + " .wpex-filter").width()))
                    : (c("#" + e + " .wpex-filter").addClass("show-filter"), c("#" + e + " .wpex-filter").css("right", 0));
            }),
            c(".wpex-timeline-list,.wpifgr-timeline").each(function () {
                var e = c(this),
                    t = e.attr("id");
                c(e).hasClass("wptl-lightbox") &&
                    (c(e).hasClass("ifgr-fline")
                        ? c("#" + t + " ul.infogr-list ").slickLightbox({ itemSelector: "> li .tlif-img a", useHistoryApi: !0 })
                        : (c("#" + t).hasClass("left-tl") && c("#" + t).hasClass("show-icon") && !c("#" + t).hasClass("show-box-color")
                              ? c("#" + t + " ul.wpex-timeline").slickLightbox({ itemSelector: "> li .wpex-content-left > a", useHistoryApi: !0 })
                              : c("#" + t).hasClass("show-clean")
                              ? c("#" + t + " ul.wpex-timeline").slickLightbox({ itemSelector: " .wpex-timeline-label > a", useHistoryApi: !0 })
                              : c("#" + t).hasClass("show-wide_img") || c("#" + t).hasClass("show-simple-bod") || c("#" + t).hasClass("show-box-color")
                              ? c("#" + t + " ul.wpex-timeline").slickLightbox({ itemSelector: " .timeline-details > a", useHistoryApi: !0 })
                              : c("#" + t).hasClass("left-tl") || (c("#" + t).hasClass("center-tl") && !c("#" + t).hasClass("show-icon") && !c("#" + t).hasClass("sidebyside-tl"))
                              ? c("#" + t + " ul.wpex-timeline").slickLightbox({ itemSelector: "> li .wpex-timeline-time > a", useHistoryApi: !0 })
                              : c("#" + t + " ul.wpex-timeline").slickLightbox({ itemSelector: "> li .timeline-details > a", useHistoryApi: !0 }),
                          c("#" + t + " ul.wpex-timeline").slickLightbox({ itemSelector: "> li .extl-gallery-carousel a", useHistoryApi: !0 })));
            }),
            Wptl_El_Sp.timelines_hoz_multi(),
            c(".horizontal-timeline:not(.ex-multi-item) ul.horizontal-nav li").on("click", function () {
                c(this).prevAll().addClass("prev_item"), c(this).nextAll().removeClass("prev_item");
            }),
            Wptl_El_Sp.timelines_hoz();
    });
})();
