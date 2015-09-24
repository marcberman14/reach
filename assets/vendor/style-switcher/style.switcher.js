var styleSwitcher = {
    initialized: !1, options: {color: "#CCC", gradient: "false"}, initialize: function () {
        var a = this;
        if (!this.initialized) {
            if ("undefined" != typeof $.browser && $.browser.mobile)return a.setLogo(!0), $("head").append($('<link rel="stylesheet">').attr("href", "assets/stylesheets/skins/default.css")), !1;
            $.styleSwitcherCachedScript = function (a, b) {
                return b = $.extend(b || {}, {dataType: "script", cache: !0, url: a}), $.ajax(b)
            }, $("head").append($('<link rel="stylesheet">').attr("href", "assets/vendor/style-switcher/style-switcher.css")), $("head").append($('<link rel="stylesheet/less">').attr("href", "assets/vendor/style-switcher/less/skin.less")), $("head").append($('<link rel="stylesheet/less">').attr("href", "assets/vendor/style-switcher/less/extension.less")), $("head").append($('<link rel="stylesheet">').attr("href", "assets/vendor/style-switcher/colorpicker/css/colorpicker.css")), $.styleSwitcherCachedScript("assets/vendor/style-switcher/colorpicker/js/colorpicker.js").done(function () {
                less = {env: "development"}, $.styleSwitcherCachedScript("assets/vendor/less/less.js").done(function () {
                    a.build(), a.events(), null != $.cookie("colorGradient") && (a.options.gradient = $.cookie("colorGradient")), null != $.cookie("skin") ? a.setColor($.cookie("skin")) : a.container.find("ul[data-type=colors] li:first a").click(), null != $.cookie("backgroundcolor") && a.setBackgroundColor($.cookie("backgroundcolor")), null != $.cookie("header") && a.setHeaderColor($.cookie("header")), null != $.cookie("sidebarLeftSize") && a.setSidebarLeftSize($.cookie("sidebarLeftSize")), null == $.cookie("initialized") && (a.container.find("h4 a").click(), $.cookie("initialized", !0)), a.container.addClass("ready"), a.initialized = !0, $(window).load(function () {
                        $.event.trigger({type: "styleSwitcher.setColor", color: a.options.color})
                    })
                })
            }), $.styleSwitcherCachedScript("assets/vendor/style-switcher/cssbeautify/cssbeautify.js").done(function () {
            })
        }
    }, build: function () {
        var a = this, b = $("<div />").attr("id", "styleSwitcher").addClass("style-switcher visible-lg").append($("<h4 />").html("Style Switcher").append($("<a />").attr("href", "#").append($("<i />").addClass("fa fa-cogs"))), $("<div />").addClass("style-switcher-mode").append($("<div />").addClass("options-links mode").append($("<a />").attr("href", "#").attr("data-mode", "basic").addClass("active").html("Basic"), $("<a />").attr("href", "#").attr("data-mode", "advanced").html("Advanced"))), $("<div />").addClass("style-switcher-wrap").append($("<h5 />").html("Colors"), $("<ul />").addClass("options colors").attr("data-type", "colors"), $("<h5 />").html("Background Color"), $("<div />").addClass("options-links background-color").append($("<a />").attr("href", "#").attr("data-background-color", "light").addClass("active").html("Light"), $("<a />").attr("href", "#").attr("data-background-color", "dark").html("Dark")), $("<div />").attr("id", "styleSwitcherHeaderColor").append($("<h5 />").html("Header Color"), $("<div />").addClass("options-links header-color").append($("<a />").attr("href", "#").attr("data-header-color", "light").addClass("active").html("Light"), $("<a />").attr("href", "#").attr("data-header-color", "dark").html("Dark"))), $("<h5 />").html("Sidebar Left Size"), $("<div />").addClass("options-links sidebar-left-size").append($("<a />").attr("href", "#").attr("data-sidebar-left-size", "xs").html("XS"), $("<a />").attr("href", "#").attr("data-sidebar-left-size", "sm").html("SM"), $("<a />").attr("href", "#").attr("data-sidebar-left-size", "md").addClass("active").html("MD")), $("<hr />"), $("<div />").addClass("options-links").append($("<a />").addClass("reset").attr("href", "#").html("Reset"), $("<a />").addClass("get-css").attr("href", "#getCSSModal").html("Get Skin CSS"))));
        $("body").append(b);
        var c = '<div class="modal fade" id="getCSSModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="cssModalLabel">Skin CSS</h4></div><div class="modal-body"><div class="tabs"><ul class="nav nav-tabs"><li class="active"><a href="#admin" data-toggle="tab">Admin</a></li><li><a href="#extension" data-toggle="tab">Extension</a></li></ul><div class="tab-content"><div id="admin" class="tab-pane active"><textarea id="getCSSTextarea" class="get-css" readonly></textarea></div><div id="extension" class="tab-pane"><textarea id="getCSSTextareaExt" class="get-css" readonly></textarea></div></div></div></div></div></div></div>';
        $("body").append(c), this.container = $("#styleSwitcher"), $(".inner-toolbar").get(0) && this.container.addClass("with-bar"), this.container.find("div.options-links.mode a").click(function (a) {
            a.preventDefault();
            var b = $(this).parents(".mode");
            b.find("a.active").removeClass("active"), $(this).addClass("active"), "advanced" == $(this).attr("data-mode") ? $("#styleSwitcher").addClass("advanced").removeClass("basic") : $("#styleSwitcher").addClass("basic").removeClass("advanced")
        });
        var d = [{Hex: "#0088CC", colorName: ""}, {Hex: "#1d5a98", colorName: ""}, {
            Hex: "#0e9a5a",
            colorName: ""
        }, {Hex: "#13c2e2", colorName: ""}, {Hex: "#f78d3e", colorName: ""}, {
            Hex: "#ee413c",
            colorName: ""
        }, {Hex: "#8d513e", colorName: ""}, {
            Hex: "#8261a7",
            colorName: ""
        }], e = this.container.find("ul[data-type=colors]");
        if ($.each(d, function (a) {
                var b = $("<li />").append($("<a />").css("background-color", d[a].Hex).attr({
                    "data-color-hex": d[a].Hex,
                    href: "#"
                }));
                e.append(b)
            }), null != $.cookie("skin"))var f = $.cookie("skin"); else var f = d[0].Hex;
        var g = $("<div />").addClass("color-gradient").append($("<input />").attr("id", "colorGradient").attr("checked", "checked").attr("type", "checkbox"), $("<label />").attr("for", "colorGradient").html("Gradient")), h = $("<div />").attr("id", "colorPickerHolder").attr("data-color", f).attr("data-color-format", "hex").addClass("color-picker");
        e.before(g, h), e.find("a").click(function (b) {
            b.preventDefault(), a.setColor($(this).attr("data-color-hex")), $("#colorPickerHolder").ColorPickerSetColor($(this).attr("data-color-hex"))
        }), $("#colorPickerHolder").ColorPicker({
            color: f, flat: !0, livePreview: !1, onChange: function (b, c) {
                a.setColor("#" + c)
            }
        }), $("#colorPickerHolder .colorpicker_color, #colorPickerHolder .colorpicker_hue").on("mousedown", function (b) {
            b.preventDefault(), a.isChanging = !0
        }).on("mouseup", function (b) {
            b.preventDefault(), a.isChanging = !1, setTimeout(function () {
                a.setColor("#" + $("#colorPickerHolder .colorpicker_hex input").val())
            }, 100)
        }), null != $.cookie("colorGradient") && (a.options.gradient = $.cookie("colorGradient")), "true" == a.options.gradient ? $("#colorGradient").attr("checked", "checked") : $("#colorGradient").removeAttr("checked"), $("#colorGradient").on("change", function () {
            var b = $(this).is(":checked").toString();
            a.options.gradient = b, a.setColor(a.options.color), $.cookie("colorGradient", b)
        }), this.container.find("div.options-links.background-color a").click(function (b) {
            b.preventDefault(), a.setBackgroundColor($(this).attr("data-background-color"))
        }), this.container.find("div.options-links.header-color a").click(function (b) {
            b.preventDefault(), a.setHeaderColor($(this).attr("data-header-color"), !0)
        }), this.container.find("div.options-links.sidebar-left-size a").click(function (b) {
            b.preventDefault(), a.setSidebarLeftSize($(this).attr("data-sidebar-left-size"), !0)
        }), a.container.find("a.reset").click(function (b) {
            b.preventDefault(), a.reset()
        }), a.container.find("a.get-css").click(function (b) {
            b.preventDefault(), a.getCss()
        })
    }, events: function () {
        var a = this;
        a.container.find("h4 a").click(function (b) {
            b.preventDefault(), a.container.hasClass("active") ? a.container.animate({right: "-" + a.container.width() + "px"}, 300).removeClass("active") : a.container.animate({right: "0"}, 300).addClass("active")
        }), (null != $.cookie("showSwitcher") || $("body").hasClass("one-page")) && (a.container.find("h4 a").click(), $.removeCookie("showSwitcher"))
    }, setColor: function (a) {
        var b = this;
        return this.isChanging ? !1 : (b.options.color = a, less.modifyVars({
            gradient: b.options.gradient,
            skinColor: a
        }), $.cookie("skin", a), this.setLogo(), void $.event.trigger({type: "styleSwitcher.setColor", color: a}))
    }, setLogo: function (a) {
        var b = $(".header .logo img, .center-sign .logo img");
        a || $.cookie("skin") == this.container.find("ul[data-type=colors] li:first a").attr("data-color-hex") && "dark" != $.cookie("backgroundcolor") ? b.attr("src", "assets/images/logo-default.png") : "dark" == $.cookie("header") || "dark" == $.cookie("backgroundcolor") ? b.attr("src", "assets/images/logo-light.png") : b.attr("src", "assets/images/logo.png")
    }, setBackgroundColor: function (a) {
        $.cookie("backgroundcolor", a);
        var b = this.container.find("div.options-links.background-color");
        b.find("a.active").removeClass("active"), b.find("a[data-background-color=" + a + "]").addClass("active"), "dark" == a ? ($("html").addClass("dark"), $.event.trigger({
            type: "styleSwitcher.setBackgroundColor",
            color: "dark"
        }), $("#styleSwitcherHeaderColor").hide()) : ($("html").removeClass("dark"), $.event.trigger({
            type: "styleSwitcher.setBackgroundColor",
            color: ""
        }), $("#styleSwitcherHeaderColor").show()), this.setLogo()
    }, setHeaderColor: function (a) {
        $.cookie("header", a);
        var b = this.container.find("div.options-links.header-color");
        b.find("a.active").removeClass("active"), b.find("a[data-header-color=" + a + "]").addClass("active"), "light" == a ? $("html").removeClass("header-dark") : $("html").addClass("header-dark"), this.setLogo()
    }, setSidebarLeftSize: function (a) {
        var b = $("html");
        $.cookie("sidebarLeftSize", a);
        var c = this.container.find("div.options-links.sidebar-left-size");
        switch (c.find("a.active").removeClass("active"), c.find("a[data-sidebar-left-size=" + a + "]").addClass("active"), b.removeClass("sidebar-left-xs sidebar-left-sm"), a) {
            case"xs":
                b.addClass("sidebar-left-xs");
                break;
            case"sm":
                b.addClass("sidebar-left-sm")
        }
    }, reset: function () {
        $.removeCookie("skin"), $.removeCookie("colorGradient"), $.removeCookie("backgroundcolor"), $.removeCookie("header"), $.cookie("showSwitcher", !0), window.location.reload()
    }, getCss: function () {
        raw = "", options = {
            indent: "	",
            autosemicolon: !0
        }, $("#getCSSModal").modal("show"), $("#getCSSTextarea").text($('style[id^="less:assets-vendor-style-switcher-less-skin"]').text()), raw = $("#getCSSTextarea").text(), $("#getCSSTextarea").text(cssbeautify(raw, options)), $("#getCSSTextareaExt").text($('style[id^="less:assets-vendor-style-switcher-less-extension"]').text()), raw = $("#getCSSTextareaExt").text(), $("#getCSSTextareaExt").text(cssbeautify(raw, options))
    }, lightenDarkenColor: function (a, b) {
        var c = !1;
        "#" == a[0] && (a = a.slice(1), c = !0);
        var d = parseInt(a, 16), e = (d >> 16) + b;
        e > 255 ? e = 255 : 0 > e && (e = 0);
        var f = (d >> 8 & 255) + b;
        f > 255 ? f = 255 : 0 > f && (f = 0);
        var g = (255 & d) + b;
        return g > 255 ? g = 255 : 0 > g && (g = 0), (c ? "#" : "") + (g | f << 8 | e << 16).toString(16)
    }
};
styleSwitcher.initialize();