$("#paymers").click(function() {
    $("#paymersMenu").toggleClass("collapse");
});
$("#manage").click(function() {
    $("#manageMenu").toggleClass("collapse");
});
$("#reports").click(function() {
    $("#reportsMenu").toggleClass("collapse");
});
$("#users").click(function() {
    $("#usersMenu").toggleClass("collapse");
});
$(".navbar-btn").click(function() {
    $("#left-sidebar").toggleClass("show-bar");
});
$("#dropdown-basic").click(function() {
    $("#userDropdown").removeClass("d-none");
});
$(".main-content").click(function() {
    $("#userDropdown").addClass("d-none");
});

$("#requestForReport").click(function() {
    $("#requestForReportMenu").removeClass("d-none");
});

// asset/js/main.js
/**
 * Template Name: OnePage - v4.7.0
 * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
(function() {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener));
            } else {
                selectEl.addEventListener(type, listener);
            }
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = el => {
        let header = select("#header");
        let offset = header.offsetHeight;

        let elementPos = select(el).offsetTop;
        window.scrollTo({
            top: elementPos - offset,
            behavior: "smooth"
        });
    };

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add("header-scrolled");
            } else {
                selectHeader.classList.remove("header-scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
    }

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Mobile nav toggle
     */
    on("click", ".mobile-nav-toggle", function(e) {
        select("#navbar").classList.toggle("navbar-mobile");
        this.classList.toggle("bi-list");
        this.classList.toggle("bi-x");
    });

    /**
     * Mobile nav dropdowns activate
     */
    on(
        "click",
        ".navbar .dropdown > a",
        function(e) {
            if (select("#navbar").classList.contains("navbar-mobile")) {
                e.preventDefault();
                this.nextElementSibling.classList.toggle("dropdown-active");
            }
        },
        true
    );

    /**
     * Scrool with ofset on links with a class name .scrollto
     */
    on(
        "click",
        ".scrollto",
        function(e) {
            if (select(this.hash)) {
                e.preventDefault();

                let navbar = select("#navbar");
                if (navbar.classList.contains("navbar-mobile")) {
                    navbar.classList.remove("navbar-mobile");
                    let navbarToggle = select(".mobile-nav-toggle");
                    navbarToggle.classList.toggle("bi-list");
                    navbarToggle.classList.toggle("bi-x");
                }
                scrollto(this.hash);
            }
        },
        true
    );

    /**
     * Scroll with ofset on page load with hash links in the url
     */
    window.addEventListener("load", () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash);
            }
        }
    });

    /**
     * Preloader
     */
    let preloader = select("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox"
    });

    /**
     * Testimonials slider
     */
    new Swiper(".testimonials-slider", {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: "auto",
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },

            1200: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    });

    /**
     * Porfolio isotope and filter
     */
    window.addEventListener("load", () => {
        let portfolioContainer = select(".portfolio-container");
        if (portfolioContainer) {
            let portfolioIsotope = new Isotope(portfolioContainer, {
                itemSelector: ".portfolio-item"
            });

            let portfolioFilters = select("#portfolio-flters li", true);

            on(
                "click",
                "#portfolio-flters li",
                function(e) {
                    e.preventDefault();
                    portfolioFilters.forEach(function(el) {
                        el.classList.remove("filter-active");
                    });
                    this.classList.add("filter-active");

                    portfolioIsotope.arrange({
                        filter: this.getAttribute("data-filter")
                    });
                    portfolioIsotope.on("arrangeComplete", function() {
                        AOS.refresh();
                    });
                },
                true
            );
        }
    });

    /**
     * Initiate portfolio lightbox
     */
    const portfolioLightbox = GLightbox({
        selector: ".portfolio-lightbox"
    });

    /**
     * Portfolio details slider
     */
    new Swiper(".portfolio-details-slider", {
        speed: 400,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true
        }
    });

    /**
     * Animation on scroll
     */
    window.addEventListener("load", () => {
        AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true,
            mirror: false
        });
    });

    $(".select-subject").on("change", function() {
        if ($(this).val()) {
            return $(this).css("color", "black");
        } else {
            return $(this).css("color", "gray");
        }
    });
})();

// purecounter.js
/*!
 * purecounter.js - A simple yet configurable native javascript counter which you can count on.
 * Author: Stig Rex
 * Version: 1.1.4
 * Url: https://github.com/srexi/purecounterjs
 * License: MIT
 */ !(function() {
    "use strict";
    function e(e, t) {
        var r = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
            var n = Object.getOwnPropertySymbols(e);
            t &&
                (n = n.filter(function(t) {
                    return Object.getOwnPropertyDescriptor(e, t).enumerable;
                })),
                r.push.apply(r, n);
        }
        return r;
    }
    function t(e, t, r) {
        return (
            t in e
                ? Object.defineProperty(e, t, {
                      value: r,
                      enumerable: !0,
                      configurable: !0,
                      writable: !0
                  })
                : (e[t] = r),
            e
        );
    }
    function r(e, t) {
        for (var r = 0; r < t.length; r++) {
            var n = t[r];
            (n.enumerable = n.enumerable || !1),
                (n.configurable = !0),
                "value" in n && (n.writable = !0),
                Object.defineProperty(e, n.key, n);
        }
    }
    new ((function() {
        function n(e) {
            !(function(e, t) {
                if (!(e instanceof t))
                    throw new TypeError("Cannot call a class as a function");
            })(this, n),
                (this.defaults = {
                    start: 0,
                    end: 100,
                    duration: 2e3,
                    delay: 10,
                    once: !0,
                    decimals: 0,
                    legacy: !0,
                    currency: !1,
                    currencysymbol: !1,
                    separator: !1,
                    separatorsymbol: ",",
                    selector: ".purecounter"
                }),
                (this.configOptions = Object.assign(
                    {},
                    this.defaults,
                    e || {}
                )),
                this.registerEventListeners();
        }
        var a, i, o;
        return (
            (a = n),
            (i = [
                {
                    key: "registerEventListeners",
                    value: function() {
                        var e = document.querySelectorAll(
                            this.configOptions.selector
                        );
                        if (this.intersectionListenerSupported()) {
                            var t = new IntersectionObserver(
                                this.animateElements.bind(this),
                                {
                                    root: null,
                                    rootMargin: "20px",
                                    threshold: 0.5
                                }
                            );
                            e.forEach(function(e) {
                                t.observe(e);
                            });
                        } else
                            window.addEventListener &&
                                (this.animateLegacy(e),
                                window.addEventListener(
                                    "scroll",
                                    function(t) {
                                        this.animateLegacy(e);
                                    },
                                    { passive: !0 }
                                ));
                    }
                },
                {
                    key: "animateLegacy",
                    value: function(e) {
                        var t = this;
                        e.forEach(function(e) {
                            !0 === t.parseConfig(e).legacy &&
                                t.elementIsInView(e) &&
                                t.animateElements([e]);
                        });
                    }
                },
                {
                    key: "animateElements",
                    value: function(e, t) {
                        var r = this;
                        e.forEach(function(e) {
                            var n = e.target || e,
                                a = r.parseConfig(n);
                            if (a.duration <= 0)
                                return (n.innerHTML = r.formatNumber(a.end, a));
                            if (
                                (!t && !r.elementIsInView(e)) ||
                                (t && e.intersectionRatio < 0.5)
                            ) {
                                var i = a.start > a.end ? a.end : a.start;
                                return (n.innerHTML = r.formatNumber(i, a));
                            }
                            setTimeout(function() {
                                return r.startCounter(n, a);
                            }, a.delay);
                        });
                    }
                },
                {
                    key: "startCounter",
                    value: function(e, t) {
                        var r = this,
                            n = (t.end - t.start) / (t.duration / t.delay),
                            a = "inc";
                        t.start > t.end && ((a = "dec"), (n *= -1));
                        var i = this.parseValue(t.start);
                        (e.innerHTML = this.formatNumber(i, t)),
                            !0 === t.once &&
                                e.setAttribute("data-purecounter-duration", 0);
                        var o = setInterval(function() {
                            var s = r.nextNumber(i, n, a);
                            (e.innerHTML = r.formatNumber(s, t)),
                                (((i = s) >= t.end && "inc" == a) ||
                                    (i <= t.end && "dec" == a)) &&
                                    ((e.innerHTML = r.formatNumber(t.end, t)),
                                    clearInterval(o));
                        }, t.delay);
                    }
                },
                {
                    key: "parseConfig",
                    value: function(r) {
                        var n = this,
                            a = (function(r) {
                                for (var n = 1; n < arguments.length; n++) {
                                    var a =
                                        null != arguments[n]
                                            ? arguments[n]
                                            : {};
                                    n % 2
                                        ? e(Object(a), !0).forEach(function(e) {
                                              t(r, e, a[e]);
                                          })
                                        : Object.getOwnPropertyDescriptors
                                        ? Object.defineProperties(
                                              r,
                                              Object.getOwnPropertyDescriptors(
                                                  a
                                              )
                                          )
                                        : e(Object(a)).forEach(function(e) {
                                              Object.defineProperty(
                                                  r,
                                                  e,
                                                  Object.getOwnPropertyDescriptor(
                                                      a,
                                                      e
                                                  )
                                              );
                                          });
                                }
                                return r;
                            })({}, this.configOptions),
                            i = [].filter.call(r.attributes, function(e) {
                                return /^data-purecounter-/.test(e.name);
                            }),
                            o = {};
                        return (
                            i.forEach(function(e) {
                                var t = e.name
                                        .replace("data-purecounter-", "")
                                        .toLowerCase(),
                                    r =
                                        "duration" == t
                                            ? parseInt(
                                                  1e3 * n.parseValue(e.value)
                                              )
                                            : n.parseValue(e.value);
                                o[t] = r;
                            }),
                            Object.assign(a, o)
                        );
                    }
                },
                {
                    key: "nextNumber",
                    value: function(e, t) {
                        var r =
                            arguments.length > 2 && void 0 !== arguments[2]
                                ? arguments[2]
                                : "inc";
                        return (
                            (e = this.parseValue(e)),
                            (t = this.parseValue(t)),
                            parseFloat("inc" === r ? e + t : e - t)
                        );
                    }
                },
                {
                    key: "convertToCurrencySystem",
                    value: function(e, t) {
                        var r = t.currencysymbol || "",
                            n = t.decimals || 1;
                        return (
                            r +
                            ((e = Math.abs(Number(e))) >= 1e12
                                ? "".concat((e / 1e12).toFixed(n), " T")
                                : e >= 1e9
                                ? "".concat((e / 1e9).toFixed(n), " B")
                                : e >= 1e6
                                ? "".concat((e / 1e6).toFixed(n), " M")
                                : e >= 1e3
                                ? "".concat((e / 1e12).toFixed(n), " K")
                                : e.toFixed(n))
                        );
                    }
                },
                {
                    key: "applySeparator",
                    value: function(e, t) {
                        return t.separator
                            ? e
                                  .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                                  .replace(
                                      new RegExp(/,/gi, "gi"),
                                      t.separatorsymbol
                                  )
                            : e.replace(new RegExp(/,/gi, "gi"), "");
                    }
                },
                {
                    key: "formatNumber",
                    value: function(e, t) {
                        var r = {
                            minimumFractionDigits: t.decimals,
                            maximumFractionDigits: t.decimals
                        };
                        return (
                            (e = t.currency
                                ? this.convertToCurrencySystem(e, t)
                                : parseFloat(e)),
                            this.applySeparator(e.toLocaleString(void 0, r), t)
                        );
                    }
                },
                {
                    key: "parseValue",
                    value: function(e) {
                        return /^[0-9]+\.[0-9]+$/.test(e)
                            ? parseFloat(e)
                            : /^[0-9]+$/.test(e)
                            ? parseInt(e)
                            : /^true|false/i.test(e)
                            ? /^true/i.test(e)
                            : e;
                    }
                },
                {
                    key: "elementIsInView",
                    value: function(e) {
                        for (
                            var t = e.offsetTop,
                                r = e.offsetLeft,
                                n = e.offsetWidth,
                                a = e.offsetHeight;
                            e.offsetParent;

                        )
                            (t += (e = e.offsetParent).offsetTop),
                                (r += e.offsetLeft);
                        return (
                            t >= window.pageYOffset &&
                            r >= window.pageXOffset &&
                            t + a <= window.pageYOffset + window.innerHeight &&
                            r + n <= window.pageXOffset + window.innerWidth
                        );
                    }
                },
                {
                    key: "intersectionListenerSupported",
                    value: function() {
                        return (
                            "IntersectionObserver" in window &&
                            "IntersectionObserverEntry" in window &&
                            "intersectionRatio" in
                                window.IntersectionObserverEntry.prototype
                        );
                    }
                }
            ]) && r(a.prototype, i),
            o && r(a, o),
            n
        );
    })())();
})();
//# sourceMappingURL=purecounter.js.map
