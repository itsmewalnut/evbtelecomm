// =========================================================
// Material Dashboard 2 - v3.1.0
// =========================================================

// Product Page: https://www.creative-tim.com/product/material-dashboard
// Copyright 2023 Creative Tim (https://www.creative-tim.com)
// Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)

// Coded by www.creative-tim.com

// =========================================================

// The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

"use strict";
!(function () {
  var e, t;
  -1 < navigator.platform.indexOf("Win") &&
    (document.getElementsByClassName("main-content")[0] &&
      ((e = document.querySelector(".main-content")), new PerfectScrollbar(e)),
    document.getElementsByClassName("sidenav")[0] &&
      ((e = document.querySelector(".sidenav")), new PerfectScrollbar(e)),
    document.getElementsByClassName("navbar-collapse")[0] &&
      ((t = document.querySelector(
        ".navbar:not(.navbar-expand-lg) .navbar-collapse"
      )),
      new PerfectScrollbar(t)),
    document.getElementsByClassName("fixed-plugin")[0]) &&
    ((t = document.querySelector(".fixed-plugin")), new PerfectScrollbar(t));
})(),
  document.getElementById("navbarBlur") && navbarBlurOnScroll("navbarBlur");
var allInputs,
  fixedPlugin,
  fixedPluginButton,
  fixedPluginButtonNav,
  fixedPluginCard,
  fixedPluginCloseButton,
  navbar,
  buttonNavbarFixed,
  tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  ),
  tooltipList = tooltipTriggerList.map(function (e) {
    return new bootstrap.Tooltip(e);
  });
function focused(e) {
  e.parentElement.classList.contains("input-group") &&
    e.parentElement.classList.add("focused");
}
function defocused(e) {
  e.parentElement.classList.contains("input-group") &&
    e.parentElement.classList.remove("focused");
}
function setAttributes(t, s) {
  Object.keys(s).forEach(function (e) {
    t.setAttribute(e, s[e]);
  });
}
function sidebarColor(e) {
  var t = document.querySelector(".nav-link.active"),
    e = e.getAttribute("data-color");
  t.classList.contains("bg-gradient-primary") &&
    t.classList.remove("bg-gradient-primary"),
    t.classList.contains("bg-gradient-dark") &&
      t.classList.remove("bg-gradient-dark"),
    t.classList.contains("bg-gradient-info") &&
      t.classList.remove("bg-gradient-info"),
    t.classList.contains("bg-gradient-success") &&
      t.classList.remove("bg-gradient-success"),
    t.classList.contains("bg-gradient-warning") &&
      t.classList.remove("bg-gradient-warning"),
    t.classList.contains("bg-gradient-danger") &&
      t.classList.remove("bg-gradient-danger"),
    t.classList.add("bg-gradient-" + e);
}
function sidebarType(e) {
  for (
    var t = e.parentElement.children,
      s = e.getAttribute("data-class"),
      n = document.querySelector("body"),
      a = document.querySelector("body:not(.dark-version)"),
      n = n.classList.contains("dark-version"),
      i = [],
      r = 0;
    r < t.length;
    r++
  )
    t[r].classList.remove("active"), i.push(t[r].getAttribute("data-class"));
  e.classList.contains("active")
    ? e.classList.remove("active")
    : e.classList.add("active");
  for (
    var l, o, c, d = document.querySelector(".sidenav"), r = 0;
    r < i.length;
    r++
  )
    d.classList.remove(i[r]);
  if ((d.classList.add(s), "bg-transparent" == s || "bg-white" == s)) {
    var u = document.querySelectorAll(".sidenav .text-white");
    for (let e = 0; e < u.length; e++)
      u[e].classList.remove("text-white"), u[e].classList.add("text-dark");
  } else {
    var f = document.querySelectorAll(".sidenav .text-dark");
    for (let e = 0; e < f.length; e++)
      f[e].classList.add("text-white"), f[e].classList.remove("text-dark");
  }
  if ("bg-transparent" == s && n) {
    f = document.querySelectorAll(".navbar-brand .text-dark");
    for (let e = 0; e < f.length; e++)
      f[e].classList.add("text-white"), f[e].classList.remove("text-dark");
  }
  ("bg-transparent" != s && "bg-white" != s) || !a
    ? (o = (l = document.querySelector(".navbar-brand-img")).src).includes(
        "logo-ct-dark.png"
      ) && ((c = o.replace("logo-ct-dark", "logo-ct")), (l.src = c))
    : (o = (l = document.querySelector(".navbar-brand-img")).src).includes(
        "logo-ct.png"
      ) && ((c = o.replace("logo-ct", "logo-ct-dark")), (l.src = c)),
    "bg-white" == s &&
      n &&
      (o = (l = document.querySelector(".navbar-brand-img")).src).includes(
        "logo-ct.png"
      ) &&
      ((c = o.replace("logo-ct", "logo-ct-dark")), (l.src = c));
}
function navbarFixed(e) {
  var t = [
      "position-sticky",
      "blur",
      "shadow-blur",
      "mt-4",
      "left-auto",
      "top-1",
      "z-index-sticky",
    ],
    s = document.getElementById("navbarBlur");
  e.getAttribute("checked")
    ? (s.classList.remove(...t),
      s.setAttribute("navbar-scroll", "false"),
      navbarBlurOnScroll("navbarBlur"),
      e.removeAttribute("checked"))
    : (s.classList.add(...t),
      s.setAttribute("navbar-scroll", "true"),
      navbarBlurOnScroll("navbarBlur"),
      e.setAttribute("checked", "true"));
}
function navbarMinimize(e) {
  var t = document.getElementsByClassName("g-sidenav-show")[0];
  e.getAttribute("checked")
    ? (t.classList.remove("g-sidenav-hidden"),
      t.classList.add("g-sidenav-pinned"),
      e.removeAttribute("checked"))
    : (t.classList.remove("g-sidenav-pinned"),
      t.classList.add("g-sidenav-hidden"),
      e.setAttribute("checked", "true"));
}
function navbarBlurOnScroll(e) {
  const t = document.getElementById(e);
  var s,
    e = !!t && t.getAttribute("data-scroll");
  let n = ["blur", "shadow-blur", "left-auto"],
    a = ["shadow-none"];
  function i() {
    t.classList.add(...n), t.classList.remove(...a), l("blur");
  }
  function r() {
    t.classList.remove(...n), t.classList.add(...a), l("transparent");
  }
  function l(e) {
    var t = document.querySelectorAll(".navbar-main .nav-link"),
      s = document.querySelectorAll(".navbar-main .sidenav-toggler-line");
    "blur" === e
      ? (t.forEach((e) => {
          e.classList.remove("text-body");
        }),
        s.forEach((e) => {
          e.classList.add("bg-dark");
        }))
      : "transparent" === e &&
        (t.forEach((e) => {
          e.classList.add("text-body");
        }),
        s.forEach((e) => {
          e.classList.remove("bg-dark");
        }));
  }
  (window.onscroll = debounce(
    "true" == e
      ? function () {
          (5 < window.scrollY ? i : r)();
        }
      : function () {
          r();
        },
    10
  )),
    -1 < navigator.platform.indexOf("Win") &&
      ((s = document.querySelector(".main-content")),
      "true" == e
        ? s.addEventListener(
            "ps-scroll-y",
            debounce(function () {
              (5 < s.scrollTop ? i : r)();
            }, 10)
          )
        : s.addEventListener(
            "ps-scroll-y",
            debounce(function () {
              r();
            }, 10)
          ));
}
function debounce(n, a, i) {
  var r;
  return function () {
    var e = this,
      t = arguments,
      s = i && !r;
    clearTimeout(r),
      (r = setTimeout(function () {
        (r = null), i || n.apply(e, t);
      }, a)),
      s && n.apply(e, t);
  };
}
0 != document.querySelectorAll(".input-group").length &&
  (allInputs = document.querySelectorAll("input.form-control")).forEach((e) =>
    setAttributes(e, {
      onfocus: "focused(this)",
      onfocusout: "defocused(this)",
    })
  ),
  document.querySelector(".fixed-plugin") &&
    ((fixedPlugin = document.querySelector(".fixed-plugin")),
    (fixedPluginButton = document.querySelector(".fixed-plugin-button")),
    (fixedPluginButtonNav = document.querySelector(".fixed-plugin-button-nav")),
    (fixedPluginCard = document.querySelector(".fixed-plugin .card")),
    (fixedPluginCloseButton = document.querySelectorAll(
      ".fixed-plugin-close-button"
    )),
    (navbar = document.getElementById("navbarBlur")),
    (buttonNavbarFixed = document.getElementById("navbarFixed")),
    fixedPluginButton &&
      (fixedPluginButton.onclick = function () {
        fixedPlugin.classList.contains("show")
          ? fixedPlugin.classList.remove("show")
          : fixedPlugin.classList.add("show");
      }),
    fixedPluginButtonNav &&
      (fixedPluginButtonNav.onclick = function () {
        fixedPlugin.classList.contains("show")
          ? fixedPlugin.classList.remove("show")
          : fixedPlugin.classList.add("show");
      }),
    fixedPluginCloseButton.forEach(function (e) {
      e.onclick = function () {
        fixedPlugin.classList.remove("show");
      };
    }),
    (document.querySelector("body").onclick = function (e) {
      e.target != fixedPluginButton &&
        e.target != fixedPluginButtonNav &&
        e.target.closest(".fixed-plugin .card") != fixedPluginCard &&
        fixedPlugin.classList.remove("show");
    }),
    navbar) &&
    "true" == navbar.getAttribute("data-scroll") &&
    buttonNavbarFixed &&
    buttonNavbarFixed.setAttribute("checked", "true");
var sidenavToggler,
  sidenavShow,
  toggleNavbarMinimize,
  total = document.querySelectorAll(".nav-pills");
function initNavs() {
  total.forEach(function (l, e) {
    var s = document.createElement("div"),
      t = l.querySelector(".nav-link.active").cloneNode(),
      a =
        ((t.innerHTML = "-"),
        s.classList.add("moving-tab", "position-absolute", "nav-link"),
        s.appendChild(t),
        l.appendChild(s),
        l.getElementsByTagName("li").length,
        (s.style.padding = "0px"),
        (s.style.transition = ".5s ease"),
        l.querySelector(".nav-link.active").parentElement);
    if (a) {
      var n = Array.from(a.closest("ul").children),
        t = n.indexOf(a) + 1;
      let e = 0;
      if (l.classList.contains("flex-column")) {
        for (var i = 1; i <= n.indexOf(a); i++)
          e += l.querySelector("li:nth-child(" + i + ")").offsetHeight;
        (s.style.transform = "translate3d(0px," + e + "px, 0px)"),
          (s.style.width =
            l.querySelector("li:nth-child(" + t + ")").offsetWidth + "px"),
          (s.style.height = l.querySelector(
            "li:nth-child(" + i + ")"
          ).offsetHeight);
      } else {
        for (i = 1; i <= n.indexOf(a); i++)
          e += l.querySelector("li:nth-child(" + i + ")").offsetWidth;
        (s.style.transform = "translate3d(" + e + "px, 0px, 0px)"),
          (s.style.width =
            l.querySelector("li:nth-child(" + t + ")").offsetWidth + "px");
      }
    }
    l.onmouseover = function (e) {
      let i = getEventTarget(e).closest("li");
      if (i) {
        let a = Array.from(i.closest("ul").children),
          n = a.indexOf(i) + 1;
        l.querySelector("li:nth-child(" + n + ") .nav-link").onclick =
          function () {
            s = l.querySelector(".moving-tab");
            let e = 0;
            if (l.classList.contains("flex-column")) {
              for (var t = 1; t <= a.indexOf(i); t++)
                e += l.querySelector("li:nth-child(" + t + ")").offsetHeight;
              (s.style.transform = "translate3d(0px," + e + "px, 0px)"),
                (s.style.height = l.querySelector(
                  "li:nth-child(" + t + ")"
                ).offsetHeight);
            } else {
              for (t = 1; t <= a.indexOf(i); t++)
                e += l.querySelector("li:nth-child(" + t + ")").offsetWidth;
              (s.style.transform = "translate3d(" + e + "px, 0px, 0px)"),
                (s.style.width =
                  l.querySelector("li:nth-child(" + n + ")").offsetWidth +
                  "px");
            }
          };
      }
    };
  });
}
function getEventTarget(e) {
  return (e = e || window.event).target || e.srcElement;
}
setTimeout(function () {
  initNavs();
}, 100),
  window.addEventListener("resize", function (e) {
    total.forEach(function (t, e) {
      t.querySelector(".moving-tab").remove();
      var a = document.createElement("div"),
        n = t.querySelector(".nav-link.active").cloneNode(),
        i =
          ((n.innerHTML = "-"),
          a.classList.add("moving-tab", "position-absolute", "nav-link"),
          a.appendChild(n),
          t.appendChild(a),
          (a.style.padding = "0px"),
          (a.style.transition = ".5s ease"),
          t.querySelector(".nav-link.active").parentElement);
      if (i) {
        var l = Array.from(i.closest("ul").children),
          n = l.indexOf(i) + 1;
        let e = 0;
        if (t.classList.contains("flex-column")) {
          for (var s = 1; s <= l.indexOf(i); s++)
            e += t.querySelector("li:nth-child(" + s + ")").offsetHeight;
          (a.style.transform = "translate3d(0px," + e + "px, 0px)"),
            (a.style.width =
              t.querySelector("li:nth-child(" + n + ")").offsetWidth + "px"),
            (a.style.height = t.querySelector(
              "li:nth-child(" + s + ")"
            ).offsetHeight);
        } else {
          for (s = 1; s <= l.indexOf(i); s++)
            e += t.querySelector("li:nth-child(" + s + ")").offsetWidth;
          (a.style.transform = "translate3d(" + e + "px, 0px, 0px)"),
            (a.style.width =
              t.querySelector("li:nth-child(" + n + ")").offsetWidth + "px");
        }
      }
    }),
      window.innerWidth < 991
        ? total.forEach(function (t, e) {
            if (!t.classList.contains("flex-column")) {
              t.classList.remove("flex-row"),
                t.classList.add("flex-column", "on-resize");
              var a = t.querySelector(".nav-link.active").parentElement,
                n = Array.from(a.closest("ul").children);
              n.indexOf(a);
              let e = 0;
              for (var i = 1; i <= n.indexOf(a); i++)
                e += t.querySelector("li:nth-child(" + i + ")").offsetHeight;
              var l = document.querySelector(".moving-tab");
              (l.style.width =
                t.querySelector("li:nth-child(1)").offsetWidth + "px"),
                (l.style.transform = "translate3d(0px," + e + "px, 0px)");
            }
          })
        : total.forEach(function (t, e) {
            if (t.classList.contains("on-resize")) {
              t.classList.remove("flex-column", "on-resize"),
                t.classList.add("flex-row");
              var a = t.querySelector(".nav-link.active").parentElement,
                n = Array.from(a.closest("ul").children),
                i = n.indexOf(a) + 1;
              let e = 0;
              for (var l = 1; l <= n.indexOf(a); l++)
                e += t.querySelector("li:nth-child(" + l + ")").offsetWidth;
              var s = document.querySelector(".moving-tab");
              (s.style.transform = "translate3d(" + e + "px, 0px, 0px)"),
                (s.style.width =
                  t.querySelector("li:nth-child(" + i + ")").offsetWidth +
                  "px");
            }
          });
  }),
  window.innerWidth < 991 &&
    total.forEach(function (e, t) {
      e.classList.contains("flex-row") &&
        (e.classList.remove("flex-row"),
        e.classList.add("flex-column", "on-resize"));
    }),
  document.querySelector(".sidenav-toggler") &&
    ((sidenavToggler = document.getElementsByClassName("sidenav-toggler")[0]),
    (sidenavShow = document.getElementsByClassName("g-sidenav-show")[0]),
    (toggleNavbarMinimize = document.getElementById("navbarMinimize")),
    sidenavShow) &&
    (sidenavToggler.onclick = function () {
      sidenavShow.classList.contains("g-sidenav-hidden")
        ? (sidenavShow.classList.remove("g-sidenav-hidden"),
          sidenavShow.classList.add("g-sidenav-pinned"),
          toggleNavbarMinimize &&
            (toggleNavbarMinimize.click(),
            toggleNavbarMinimize.removeAttribute("checked")))
        : (sidenavShow.classList.remove("g-sidenav-pinned"),
          sidenavShow.classList.add("g-sidenav-hidden"),
          toggleNavbarMinimize &&
            (toggleNavbarMinimize.click(),
            toggleNavbarMinimize.setAttribute("checked", "true")));
    });
const iconNavbarSidenav = document.getElementById("iconNavbarSidenav"),
  iconSidenav = document.getElementById("iconSidenav"),
  sidenav = document.getElementById("sidenav-main");
let body = document.getElementsByTagName("body")[0],
  className = "g-sidenav-pinned";
function toggleSidenav() {
  body.classList.contains(className)
    ? (body.classList.remove(className),
      setTimeout(function () {
        sidenav.classList.remove("bg-white");
      }, 100),
      sidenav.classList.remove("bg-transparent"))
    : (body.classList.add(className),
      sidenav.classList.remove("bg-transparent"),
      iconSidenav.classList.remove("d-none"));
}
iconNavbarSidenav && iconNavbarSidenav.addEventListener("click", toggleSidenav),
  iconSidenav && iconSidenav.addEventListener("click", toggleSidenav);
let referenceButtons = document.querySelector("[data-class]");
function navbarColorOnResize() {
  1200 < window.innerWidth
    ? referenceButtons?.classList.contains("active") &&
      "bg-transparent" === referenceButtons?.getAttribute("data-class")
      ? sidenav.classList.remove("bg-white")
      : sidenav.classList.add("bg-white")
    : (sidenav.classList.add("bg-white"),
      sidenav.classList.remove("bg-transparent"));
}

function sidenavTypeOnResize() {
  var e = document.querySelectorAll('[onclick="sidebarType(this)"]');
  window.innerWidth < 1200
    ? e.forEach(function (e) {
        e.classList.add("disabled");
      })
    : e.forEach(function (e) {
        e.classList.remove("disabled");
      });
}

function toggleDarkMode() {
  const body = document.getElementsByTagName("body")[0];
  const isDarkMode = body.classList.contains("dark-version");

  // Toggle dark mode
  body.classList.toggle("dark-version", !isDarkMode);

  // Save the dark mode state to localStorage
  localStorage.setItem("darkMode", !isDarkMode ? "true" : "false");

  // Toggle icons
  document.getElementById("light-mode-icon").style.display = isDarkMode
    ? "block"
    : "none";
  document.getElementById("dark-mode-icon").style.display = isDarkMode
    ? "none"
    : "block";
}

// Initialize dark mode based on localStorage
function initializeDarkMode() {
  const storedMode = localStorage.getItem("darkMode");
  const isDarkMode = storedMode === "true";
  const body = document.getElementsByTagName("body")[0];
  body.classList.toggle("dark-version", isDarkMode);

  // Toggle icons based on stored mode
  document.getElementById("light-mode-icon").style.display = isDarkMode
    ? "none"
    : "block";
  document.getElementById("dark-mode-icon").style.display = isDarkMode
    ? "block"
    : "none";
}

// Call this function on page load to set the initial state
initializeDarkMode();

// Attach event listener to the toggle button
document
  .getElementById("toggle-dark-mode")
  .addEventListener("click", toggleDarkMode);

sidenav && window.addEventListener("resize", navbarColorOnResize),
  window.addEventListener("resize", sidenavTypeOnResize),
  window.addEventListener("load", sidenavTypeOnResize);
const indicators = document.querySelectorAll(".indicator"),
  sections = document.querySelectorAll("section");
if (indicators) {
  const P0 = () => {
      var e = document.querySelector(".indicator.active");
      e && e.classList.remove("active");
    },
    Q0 = (e) => {
      new IntersectionObserver(
        (e) => {
          e.forEach((e) => {
            e.isIntersecting &&
              (P0(),
              (e = e.target),
              document
                .querySelector(`a[href='#${e.id}']`)
                .classList.add("active"));
          });
        },
        { root: null, rootMargin: "0px", threshold: 0.75 }
      ).observe(e);
    };
  indicators.forEach((e) => {
    e.addEventListener("click", function (e) {
      e.preventDefault(),
        document
          .querySelector(this.getAttribute("href"))
          .scrollIntoView({ behavior: "smooth" }),
        P0(),
        this.classList.add("active");
    });
  }),
    sections.forEach(Q0);
}

//# sourceMappingURL=_site_dashboard_free/assets/js/dashboard-free.js.map
