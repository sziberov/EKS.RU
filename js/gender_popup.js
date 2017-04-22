! function(a, b) {
    "use strict";

    function e(b, c) {
        var d = "http://inv-nets.admixer.net/dmp/survey?subs=25DAC9FD-4BA4-4F39-B590-99DA341A2F9D&g=" + b + "&ag=" + c + "&rnd=" + (new Date).getTime(),
            e = a("<img/>", {
                alt: "g",
                src: d,
                "class": "gender-img"
            });
        a("body").append(e), setTimeout(function() {
            e.remove()
        }, 5e3)
    }

    function f(b) {
        void 0 !== b && g("genderpp", 1, 150), a("#gender_counter_wrapper").remove()
    }

    function g(a, b, c) {
        var d = "";
        if (c) {
            var e = new Date;
            e.setTime(e.getTime() + 24 * c * 60 * 60 * 1e3), d = "; expires=" + e.toGMTString()
        }
        var f = window.location.host;
        /(:\d+)/.test(window.location.host) && (f = window.location.host.split(":")[0]), document.cookie = a + "=" + b + d + ";domain=" + f + ";path=/"
    }

    function h(a) {
        if (document.cookie.length > 0) {
            var b = document.cookie.indexOf(a + "=");
            if (-1 != b) {
                b = b + a.length + 1;
                var c = document.cookie.indexOf(";", b);
                return -1 == c && (c = document.cookie.length), unescape(document.cookie.substring(b, c))
            }
        }
        return ""
    }

    function i() {
        g("jklerp_1", 1);
        var a = h("jklerp_1");
        return a ? (g("jklerp_1", "", -1), !0) : !1
    }
    if (!h("genderpp") && "www.ex.ua" == b.location.host && i()) {
        a("#gender_counter_wrapper").fadeIn(200);
        var c = a('input[name="uid_age"]'),
            d = a('input[name="uid_sex"]');
        c.add(d).on("change", function() {
            var b = a('input[name="uid_sex"]:checked').val(),
                g = a('input[name="uid_age"]:checked').val();
            void 0 !== g && void 0 !== b && (e(b, g), c.add(d).off("change"), f(!0))
        }), a("#cancel").on("click", function() {
            f(!0)
        })
    }
}(jQuery, window);