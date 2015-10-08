/* CodeMirror - Minified & Bundled
 Generated on 6.8.2014 with http://codemirror.net/doc/compress.html
 Version: 4.4

 CodeMirror Library:
 - codemirror.js
 Modes:
 - clike.js
 - coffeescript.js
 - css.js
 - gfm.js
 - htmlembedded.js
 - htmlmixed.js
 - javascript.js
 - markdown.js
 - php.js
 - sql.js
 - xml.js
 - yaml.js
 Add-ons:
 - active-line.js
 - anyword-hint.js
 - brace-fold.js
 - closebrackets.js
 - closetag.js
 - colorize.js
 - comment.js
 - comment-fold.js
 - continuecomment.js
 - continuelist.js
 - css-hint.js
 - dialog.js
 - foldcode.js
 - foldgutter.js
 - html-hint.js
 - indent-fold.js
 - javascript-hint.js
 - markdown-fold.js
 - mark-selection.js
 - match-highlighter.js
 - matchbrackets.js
 - matchtags.js
 - overlay.js
 - placeholder.js
 - rulers.js
 - searchcursor.js
 - show-hint.js
 - sql-hint.js
 - trailingspace.js
 - xml-fold.js
 - xml-hint.js
 Keymaps:
 - sublime.js
 */

!function (a) {
    if ("object" == typeof exports && "object" == typeof module)module.exports = a(); else {
        if ("function" == typeof define && define.amd)return define([], a);
        this.CodeMirror = a()
    }
}(function () {
    "use strict";
    function w(a, b) {
        if (!(this instanceof w))return new w(a, b);
        this.options = b = b || {}, Og(ie, b, !1), K(b);
        var c = b.value;
        "string" == typeof c && (c = new Jf(c, b.mode)), this.doc = c;
        var f = this.display = new x(a, c);
        f.wrapper.CodeMirror = this, G(this), E(this), b.lineWrapping && (this.display.wrapper.className += " CodeMirror-wrap"), b.autofocus && !o && _c(this), this.state = {
            keyMaps: [],
            overlays: [],
            modeGen: 0,
            overwrite: !1,
            focused: !1,
            suppressEdits: !1,
            pasteIncoming: !1,
            cutIncoming: !1,
            draggingText: !1,
            highlight: new Eg
        }, d && 11 > e && setTimeout(Pg($c, this, !0), 20), cd(this), gh();
        var g = this;
        Jc(this, function () {
            g.curOp.forceUpdate = !0, Nf(g, c), b.autofocus && !o || _g() == f.input ? setTimeout(Pg(Gd, g), 20) : Hd(g);
            for (var a in je)je.hasOwnProperty(a) && je[a](g, b[a], le);
            Q(g);
            for (var d = 0; d < pe.length; ++d)pe[d](g)
        })
    }

    function x(a, b) {
        var c = this, g = c.input = Wg("textarea", null, null, "position: absolute; padding: 0; width: 1px; height: 1em; outline: none");
        f ? g.style.width = "1000px" : g.setAttribute("wrap", "off"), n && (g.style.border = "1px solid black"), g.setAttribute("autocorrect", "off"), g.setAttribute("autocapitalize", "off"), g.setAttribute("spellcheck", "false"), c.inputDiv = Wg("div", [g], null, "overflow: hidden; position: relative; width: 3px; height: 0px;"), c.scrollbarH = Wg("div", [Wg("div", null, null, "height: 100%; min-height: 1px")], "CodeMirror-hscrollbar"), c.scrollbarV = Wg("div", [Wg("div", null, null, "min-width: 1px")], "CodeMirror-vscrollbar"), c.scrollbarFiller = Wg("div", null, "CodeMirror-scrollbar-filler"), c.gutterFiller = Wg("div", null, "CodeMirror-gutter-filler"), c.lineDiv = Wg("div", null, "CodeMirror-code"), c.selectionDiv = Wg("div", null, null, "position: relative; z-index: 1"), c.cursorDiv = Wg("div", null, "CodeMirror-cursors"), c.measure = Wg("div", null, "CodeMirror-measure"), c.lineMeasure = Wg("div", null, "CodeMirror-measure"), c.lineSpace = Wg("div", [c.measure, c.lineMeasure, c.selectionDiv, c.cursorDiv, c.lineDiv], null, "position: relative; outline: none"), c.mover = Wg("div", [Wg("div", [c.lineSpace], "CodeMirror-lines")], null, "position: relative"), c.sizer = Wg("div", [c.mover], "CodeMirror-sizer"), c.heightForcer = Wg("div", null, null, "position: absolute; height: " + zg + "px; width: 1px;"), c.gutters = Wg("div", null, "CodeMirror-gutters"), c.lineGutter = null, c.scroller = Wg("div", [c.sizer, c.heightForcer, c.gutters], "CodeMirror-scroll"), c.scroller.setAttribute("tabIndex", "-1"), c.wrapper = Wg("div", [c.inputDiv, c.scrollbarH, c.scrollbarV, c.scrollbarFiller, c.gutterFiller, c.scroller], "CodeMirror"), d && 8 > e && (c.gutters.style.zIndex = -1, c.scroller.style.paddingRight = 0), n && (g.style.width = "0px"), f || (c.scroller.draggable = !0), k && (c.inputDiv.style.height = "1px", c.inputDiv.style.position = "absolute"), d && 8 > e && (c.scrollbarH.style.minHeight = c.scrollbarV.style.minWidth = "18px"), a.appendChild ? a.appendChild(c.wrapper) : a(c.wrapper), c.viewFrom = c.viewTo = b.first, c.view = [], c.externalMeasured = null, c.viewOffset = 0, c.lastSizeC = 0, c.updateLineNumbers = null, c.lineNumWidth = c.lineNumInnerWidth = c.lineNumChars = null, c.prevInput = "", c.alignWidgets = !1, c.pollingFast = !1, c.poll = new Eg, c.cachedCharWidth = c.cachedTextHeight = c.cachedPaddingH = null, c.inaccurateSelection = !1, c.maxLine = null, c.maxLineLength = 0, c.maxLineChanged = !1, c.wheelDX = c.wheelDY = c.wheelStartX = c.wheelStartY = null, c.shift = !1, c.selForContextMenu = null
    }

    function y(a) {
        a.doc.mode = w.getMode(a.options, a.doc.modeOption), z(a)
    }

    function z(a) {
        a.doc.iter(function (a) {
            a.stateAfter && (a.stateAfter = null), a.styles && (a.styles = null)
        }), a.doc.frontier = a.doc.first, Tb(a, 100), a.state.modeGen++, a.curOp && Pc(a)
    }

    function A(a) {
        a.options.lineWrapping ? (ch(a.display.wrapper, "CodeMirror-wrap"), a.display.sizer.style.minWidth = "") : (bh(a.display.wrapper, "CodeMirror-wrap"), J(a)), C(a), Pc(a), kc(a), setTimeout(function () {
            N(a)
        }, 100)
    }

    function B(a) {
        var b = wc(a.display), c = a.options.lineWrapping, d = c && Math.max(5, a.display.scroller.clientWidth / xc(a.display) - 3);
        return function (e) {
            if (df(a.doc, e))return 0;
            var f = 0;
            if (e.widgets)for (var g = 0; g < e.widgets.length; g++)e.widgets[g].height && (f += e.widgets[g].height);
            return c ? f + (Math.ceil(e.text.length / d) || 1) * b : f + b
        }
    }

    function C(a) {
        var b = a.doc, c = B(a);
        b.iter(function (a) {
            var b = c(a);
            b != a.height && Rf(a, b)
        })
    }

    function D(a) {
        var b = ue[a.options.keyMap], c = b.style;
        a.display.wrapper.className = a.display.wrapper.className.replace(/\s*cm-keymap-\S+/g, "") + (c ? " cm-keymap-" + c : "")
    }

    function E(a) {
        a.display.wrapper.className = a.display.wrapper.className.replace(/\s*cm-s-\S+/g, "") + a.options.theme.replace(/(^|\s)\s*/g, " cm-s-"), kc(a)
    }

    function F(a) {
        G(a), Pc(a), setTimeout(function () {
            P(a)
        }, 20)
    }

    function G(a) {
        var b = a.display.gutters, c = a.options.gutters;
        Yg(b);
        for (var d = 0; d < c.length; ++d) {
            var e = c[d], f = b.appendChild(Wg("div", null, "CodeMirror-gutter " + e));
            "CodeMirror-linenumbers" == e && (a.display.lineGutter = f, f.style.width = (a.display.lineNumWidth || 1) + "px")
        }
        b.style.display = d ? "" : "none", H(a)
    }

    function H(a) {
        var b = a.display.gutters.offsetWidth;
        a.display.sizer.style.marginLeft = b + "px", a.display.scrollbarH.style.left = a.options.fixedGutter ? b + "px" : 0
    }

    function I(a) {
        if (0 == a.height)return 0;
        for (var c, b = a.text.length, d = a; c = Ye(d);) {
            var e = c.find(0, !0);
            d = e.from.line, b += e.from.ch - e.to.ch
        }
        for (d = a; c = Ze(d);) {
            var e = c.find(0, !0);
            b -= d.text.length - e.from.ch, d = e.to.line, b += d.text.length - e.to.ch
        }
        return b
    }

    function J(a) {
        var b = a.display, c = a.doc;
        b.maxLine = Of(c, c.first), b.maxLineLength = I(b.maxLine), b.maxLineChanged = !0, c.iter(function (a) {
            var c = I(a);
            c > b.maxLineLength && (b.maxLineLength = c, b.maxLine = a)
        })
    }

    function K(a) {
        var b = Lg(a.gutters, "CodeMirror-linenumbers");
        -1 == b && a.lineNumbers ? a.gutters = a.gutters.concat(["CodeMirror-linenumbers"]) : b > -1 && !a.lineNumbers && (a.gutters = a.gutters.slice(0), a.gutters.splice(b, 1))
    }

    function L(a) {
        return a.display.scroller.clientHeight - a.display.wrapper.clientHeight < zg - 3
    }

    function M(a) {
        var b = a.display.scroller;
        return {
            clientHeight: b.clientHeight,
            barHeight: a.display.scrollbarV.clientHeight,
            scrollWidth: b.scrollWidth,
            clientWidth: b.clientWidth,
            hScrollbarTakesSpace: L(a),
            barWidth: a.display.scrollbarH.clientWidth,
            docHeight: Math.round(a.doc.height + Yb(a.display))
        }
    }

    function N(a, b) {
        b || (b = M(a));
        var c = a.display, d = kh(c.measure), e = b.docHeight + zg, f = b.scrollWidth > b.clientWidth;
        f && b.scrollWidth <= b.clientWidth + 1 && d > 0 && !b.hScrollbarTakesSpace && (f = !1);
        var g = e > b.clientHeight;
        if (g ? (c.scrollbarV.style.display = "block", c.scrollbarV.style.bottom = f ? d + "px" : "0", c.scrollbarV.firstChild.style.height = Math.max(0, e - b.clientHeight + (b.barHeight || c.scrollbarV.clientHeight)) + "px") : (c.scrollbarV.style.display = "", c.scrollbarV.firstChild.style.height = "0"), f ? (c.scrollbarH.style.display = "block", c.scrollbarH.style.right = g ? d + "px" : "0", c.scrollbarH.firstChild.style.width = b.scrollWidth - b.clientWidth + (b.barWidth || c.scrollbarH.clientWidth) + "px") : (c.scrollbarH.style.display = "", c.scrollbarH.firstChild.style.width = "0"), f && g ? (c.scrollbarFiller.style.display = "block", c.scrollbarFiller.style.height = c.scrollbarFiller.style.width = d + "px") : c.scrollbarFiller.style.display = "", f && a.options.coverGutterNextToScrollbar && a.options.fixedGutter ? (c.gutterFiller.style.display = "block", c.gutterFiller.style.height = d + "px", c.gutterFiller.style.width = c.gutters.offsetWidth + "px") : c.gutterFiller.style.display = "", !a.state.checkedOverlayScrollbar && b.clientHeight > 0) {
            if (0 === d) {
                var h = p && !l ? "12px" : "18px";
                c.scrollbarV.style.minWidth = c.scrollbarH.style.minHeight = h;
                var i = function (b) {
                    ng(b) != c.scrollbarV && ng(b) != c.scrollbarH && Kc(a, gd)(b)
                };
                pg(c.scrollbarV, "mousedown", i), pg(c.scrollbarH, "mousedown", i)
            }
            a.state.checkedOverlayScrollbar = !0
        }
    }

    function O(a, b, c) {
        var d = c && null != c.top ? Math.max(0, c.top) : a.scroller.scrollTop;
        d = Math.floor(d - Xb(a));
        var e = c && null != c.bottom ? c.bottom : d + a.wrapper.clientHeight, f = Tf(b, d), g = Tf(b, e);
        if (c && c.ensure) {
            var h = c.ensure.from.line, i = c.ensure.to.line;
            if (f > h)return {from: h, to: Tf(b, Uf(Of(b, h)) + a.wrapper.clientHeight)};
            if (Math.min(i, b.lastLine()) >= g)return {from: Tf(b, Uf(Of(b, i)) - a.wrapper.clientHeight), to: i}
        }
        return {from: f, to: Math.max(g, f + 1)}
    }

    function P(a) {
        var b = a.display, c = b.view;
        if (b.alignWidgets || b.gutters.firstChild && a.options.fixedGutter) {
            for (var d = S(b) - b.scroller.scrollLeft + a.doc.scrollLeft, e = b.gutters.offsetWidth, f = d + "px", g = 0; g < c.length; g++)if (!c[g].hidden) {
                a.options.fixedGutter && c[g].gutter && (c[g].gutter.style.left = f);
                var h = c[g].alignable;
                if (h)for (var i = 0; i < h.length; i++)h[i].style.left = f
            }
            a.options.fixedGutter && (b.gutters.style.left = d + e + "px")
        }
    }

    function Q(a) {
        if (!a.options.lineNumbers)return !1;
        var b = a.doc, c = R(a.options, b.first + b.size - 1), d = a.display;
        if (c.length != d.lineNumChars) {
            var e = d.measure.appendChild(Wg("div", [Wg("div", c)], "CodeMirror-linenumber CodeMirror-gutter-elt")), f = e.firstChild.offsetWidth, g = e.offsetWidth - f;
            return d.lineGutter.style.width = "", d.lineNumInnerWidth = Math.max(f, d.lineGutter.offsetWidth - g), d.lineNumWidth = d.lineNumInnerWidth + g, d.lineNumChars = d.lineNumInnerWidth ? c.length : -1, d.lineGutter.style.width = d.lineNumWidth + "px", H(a), !0
        }
        return !1
    }

    function R(a, b) {
        return String(a.lineNumberFormatter(b + a.firstLineNumber))
    }

    function S(a) {
        return a.scroller.getBoundingClientRect().left - a.sizer.getBoundingClientRect().left
    }

    function T(a, b, c) {
        var d = a.display;
        this.viewport = b, this.visible = O(d, a.doc, b), this.editorIsHidden = !d.wrapper.offsetWidth, this.wrapperHeight = d.wrapper.clientHeight, this.oldViewFrom = d.viewFrom, this.oldViewTo = d.viewTo, this.oldScrollerWidth = d.scroller.clientWidth, this.force = c, this.dims = _(a)
    }

    function U(a, b) {
        var c = a.display, d = a.doc;
        if (b.editorIsHidden)return Rc(a), !1;
        if (!b.force && b.visible.from >= c.viewFrom && b.visible.to <= c.viewTo && (null == c.updateLineNumbers || c.updateLineNumbers >= c.viewTo) && 0 == Vc(a))return !1;
        Q(a) && (Rc(a), b.dims = _(a));
        var e = d.first + d.size, f = Math.max(b.visible.from - a.options.viewportMargin, d.first), g = Math.min(e, b.visible.to + a.options.viewportMargin);
        c.viewFrom < f && f - c.viewFrom < 20 && (f = Math.max(d.first, c.viewFrom)), c.viewTo > g && c.viewTo - g < 20 && (g = Math.min(e, c.viewTo)), v && (f = bf(a.doc, f), g = cf(a.doc, g));
        var h = f != c.viewFrom || g != c.viewTo || c.lastSizeC != b.wrapperHeight;
        Uc(a, f, g), c.viewOffset = Uf(Of(a.doc, c.viewFrom)), a.display.mover.style.top = c.viewOffset + "px";
        var i = Vc(a);
        if (!h && 0 == i && !b.force && (null == c.updateLineNumbers || c.updateLineNumbers >= c.viewTo))return !1;
        var j = _g();
        return i > 4 && (c.lineDiv.style.display = "none"), ab(a, c.updateLineNumbers, b.dims), i > 4 && (c.lineDiv.style.display = ""), j && _g() != j && j.offsetHeight && j.focus(), Yg(c.cursorDiv), Yg(c.selectionDiv), h && (c.lastSizeC = b.wrapperHeight, Tb(a, 400)), c.updateLineNumbers = null, !0
    }

    function V(a, b) {
        for (var c = b.force, d = b.viewport, e = !0; ; e = !1) {
            if (e && a.options.lineWrapping && b.oldScrollerWidth != a.display.scroller.clientWidth)c = !0; else if (c = !1, d && null != d.top && (d = {top: Math.min(a.doc.height + Yb(a.display) - zg - a.display.scroller.clientHeight, d.top)}), b.visible = O(a.display, a.doc, d), b.visible.from >= a.display.viewFrom && b.visible.to <= a.display.viewTo)break;
            if (!U(a, b))break;
            Z(a);
            var f = M(a);
            Pb(a), X(a, f), N(a, f)
        }
        tg(a, "update", a), (a.display.viewFrom != b.oldViewFrom || a.display.viewTo != b.oldViewTo) && tg(a, "viewportChange", a, a.display.viewFrom, a.display.viewTo)
    }

    function W(a, b) {
        var c = new T(a, b);
        if (U(a, c)) {
            V(a, c);
            var d = M(a);
            Pb(a), X(a, d), N(a, d)
        }
    }

    function X(a, b) {
        a.display.sizer.style.minHeight = a.display.heightForcer.style.top = b.docHeight + "px", a.display.gutters.style.height = Math.max(b.docHeight, b.clientHeight - zg) + "px"
    }

    function Y(a, b) {
        a.display.sizer.offsetWidth + a.display.gutters.offsetWidth < a.display.scroller.clientWidth - 1 && (a.display.sizer.style.minHeight = a.display.heightForcer.style.top = "0px", a.display.gutters.style.height = b.docHeight + "px")
    }

    function Z(a) {
        for (var b = a.display, c = b.lineDiv.offsetTop, f = 0; f < b.view.length; f++) {
            var h, g = b.view[f];
            if (!g.hidden) {
                if (d && 8 > e) {
                    var i = g.node.offsetTop + g.node.offsetHeight;
                    h = i - c, c = i
                } else {
                    var j = g.node.getBoundingClientRect();
                    h = j.bottom - j.top
                }
                var k = g.line.height - h;
                if (2 > h && (h = wc(b)), (k > .001 || -.001 > k) && (Rf(g.line, h), $(g.line), g.rest))for (var l = 0; l < g.rest.length; l++)$(g.rest[l])
            }
        }
    }

    function $(a) {
        if (a.widgets)for (var b = 0; b < a.widgets.length; ++b)a.widgets[b].height = a.widgets[b].node.offsetHeight
    }

    function _(a) {
        for (var b = a.display, c = {}, d = {}, e = b.gutters.firstChild, f = 0; e; e = e.nextSibling, ++f)c[a.options.gutters[f]] = e.offsetLeft, d[a.options.gutters[f]] = e.offsetWidth;
        return {
            fixedPos: S(b),
            gutterTotalWidth: b.gutters.offsetWidth,
            gutterLeft: c,
            gutterWidth: d,
            wrapperWidth: b.wrapper.clientWidth
        }
    }

    function ab(a, b, c) {
        function i(b) {
            var c = b.nextSibling;
            return f && p && a.display.currentWheelTarget == b ? b.style.display = "none" : b.parentNode.removeChild(b), c
        }

        for (var d = a.display, e = a.options.lineNumbers, g = d.lineDiv, h = g.firstChild, j = d.view, k = d.viewFrom, l = 0; l < j.length; l++) {
            var m = j[l];
            if (m.hidden); else if (m.node) {
                for (; h != m.node;)h = i(h);
                var o = e && null != b && k >= b && m.lineNumber;
                m.changes && (Lg(m.changes, "gutter") > -1 && (o = !1), bb(a, m, k, c)), o && (Yg(m.lineNumber), m.lineNumber.appendChild(document.createTextNode(R(a.options, k)))), h = m.node.nextSibling
            } else {
                var n = jb(a, m, k, c);
                g.insertBefore(n, h)
            }
            k += m.size
        }
        for (; h;)h = i(h)
    }

    function bb(a, b, c, d) {
        for (var e = 0; e < b.changes.length; e++) {
            var f = b.changes[e];
            "text" == f ? fb(a, b) : "gutter" == f ? hb(a, b, c, d) : "class" == f ? gb(b) : "widget" == f && ib(b, d)
        }
        b.changes = null
    }

    function cb(a) {
        return a.node == a.text && (a.node = Wg("div", null, null, "position: relative"), a.text.parentNode && a.text.parentNode.replaceChild(a.node, a.text), a.node.appendChild(a.text), d && 8 > e && (a.node.style.zIndex = 2)), a.node
    }

    function db(a) {
        var b = a.bgClass ? a.bgClass + " " + (a.line.bgClass || "") : a.line.bgClass;
        if (b && (b += " CodeMirror-linebackground"), a.background)b ? a.background.className = b : (a.background.parentNode.removeChild(a.background), a.background = null); else if (b) {
            var c = cb(a);
            a.background = c.insertBefore(Wg("div", null, b), c.firstChild)
        }
    }

    function eb(a, b) {
        var c = a.display.externalMeasured;
        return c && c.line == b.line ? (a.display.externalMeasured = null, b.measure = c.measure, c.built) : xf(a, b)
    }

    function fb(a, b) {
        var c = b.text.className, d = eb(a, b);
        b.text == b.node && (b.node = d.pre), b.text.parentNode.replaceChild(d.pre, b.text), b.text = d.pre, d.bgClass != b.bgClass || d.textClass != b.textClass ? (b.bgClass = d.bgClass, b.textClass = d.textClass, gb(b)) : c && (b.text.className = c)
    }

    function gb(a) {
        db(a), a.line.wrapClass ? cb(a).className = a.line.wrapClass : a.node != a.text && (a.node.className = "");
        var b = a.textClass ? a.textClass + " " + (a.line.textClass || "") : a.line.textClass;
        a.text.className = b || ""
    }

    function hb(a, b, c, d) {
        b.gutter && (b.node.removeChild(b.gutter), b.gutter = null);
        var e = b.line.gutterMarkers;
        if (a.options.lineNumbers || e) {
            var f = cb(b), g = b.gutter = f.insertBefore(Wg("div", null, "CodeMirror-gutter-wrapper", "position: absolute; left: " + (a.options.fixedGutter ? d.fixedPos : -d.gutterTotalWidth) + "px"), b.text);
            if (!a.options.lineNumbers || e && e["CodeMirror-linenumbers"] || (b.lineNumber = g.appendChild(Wg("div", R(a.options, c), "CodeMirror-linenumber CodeMirror-gutter-elt", "left: " + d.gutterLeft["CodeMirror-linenumbers"] + "px; width: " + a.display.lineNumInnerWidth + "px"))), e)for (var h = 0; h < a.options.gutters.length; ++h) {
                var i = a.options.gutters[h], j = e.hasOwnProperty(i) && e[i];
                j && g.appendChild(Wg("div", [j], "CodeMirror-gutter-elt", "left: " + d.gutterLeft[i] + "px; width: " + d.gutterWidth[i] + "px"))
            }
        }
    }

    function ib(a, b) {
        a.alignable && (a.alignable = null);
        for (var d, c = a.node.firstChild; c; c = d) {
            var d = c.nextSibling;
            "CodeMirror-linewidget" == c.className && a.node.removeChild(c)
        }
        kb(a, b)
    }

    function jb(a, b, c, d) {
        var e = eb(a, b);
        return b.text = b.node = e.pre, e.bgClass && (b.bgClass = e.bgClass), e.textClass && (b.textClass = e.textClass), gb(b), hb(a, b, c, d), kb(b, d), b.node
    }

    function kb(a, b) {
        if (lb(a.line, a, b, !0), a.rest)for (var c = 0; c < a.rest.length; c++)lb(a.rest[c], a, b, !1)
    }

    function lb(a, b, c, d) {
        if (a.widgets)for (var e = cb(b), f = 0, g = a.widgets; f < g.length; ++f) {
            var h = g[f], i = Wg("div", [h.node], "CodeMirror-linewidget");
            h.handleMouseEvents || (i.ignoreEvents = !0), mb(h, i, b, c), d && h.above ? e.insertBefore(i, b.gutter || b.text) : e.appendChild(i), tg(h, "redraw")
        }
    }

    function mb(a, b, c, d) {
        if (a.noHScroll) {
            (c.alignable || (c.alignable = [])).push(b);
            var e = d.wrapperWidth;
            b.style.left = d.fixedPos + "px", a.coverGutter || (e -= d.gutterTotalWidth, b.style.paddingLeft = d.gutterTotalWidth + "px"), b.style.width = e + "px"
        }
        a.coverGutter && (b.style.zIndex = 5, b.style.position = "relative", a.noHScroll || (b.style.marginLeft = -d.gutterTotalWidth + "px"))
    }

    function pb(a) {
        return nb(a.line, a.ch)
    }

    function qb(a, b) {
        return ob(a, b) < 0 ? b : a
    }

    function rb(a, b) {
        return ob(a, b) < 0 ? a : b
    }

    function sb(a, b) {
        this.ranges = a, this.primIndex = b
    }

    function tb(a, b) {
        this.anchor = a, this.head = b
    }

    function ub(a, b) {
        var c = a[b];
        a.sort(function (a, b) {
            return ob(a.from(), b.from())
        }), b = Lg(a, c);
        for (var d = 1; d < a.length; d++) {
            var e = a[d], f = a[d - 1];
            if (ob(f.to(), e.from()) >= 0) {
                var g = rb(f.from(), e.from()), h = qb(f.to(), e.to()), i = f.empty() ? e.from() == e.head : f.from() == f.head;
                b >= d && --b, a.splice(--d, 2, new tb(i ? h : g, i ? g : h))
            }
        }
        return new sb(a, b)
    }

    function vb(a, b) {
        return new sb([new tb(a, b || a)], 0)
    }

    function wb(a, b) {
        return Math.max(a.first, Math.min(b, a.first + a.size - 1))
    }

    function xb(a, b) {
        if (b.line < a.first)return nb(a.first, 0);
        var c = a.first + a.size - 1;
        return b.line > c ? nb(c, Of(a, c).text.length) : yb(b, Of(a, b.line).text.length)
    }

    function yb(a, b) {
        var c = a.ch;
        return null == c || c > b ? nb(a.line, b) : 0 > c ? nb(a.line, 0) : a
    }

    function zb(a, b) {
        return b >= a.first && b < a.first + a.size
    }

    function Ab(a, b) {
        for (var c = [], d = 0; d < b.length; d++)c[d] = xb(a, b[d]);
        return c
    }

    function Bb(a, b, c, d) {
        if (a.cm && a.cm.display.shift || a.extend) {
            var e = b.anchor;
            if (d) {
                var f = ob(c, e) < 0;
                f != ob(d, e) < 0 ? (e = c, c = d) : f != ob(c, d) < 0 && (c = d)
            }
            return new tb(e, c)
        }
        return new tb(d || c, c)
    }

    function Cb(a, b, c, d) {
        Ib(a, new sb([Bb(a, a.sel.primary(), b, c)], 0), d)
    }

    function Db(a, b, c) {
        for (var d = [], e = 0; e < a.sel.ranges.length; e++)d[e] = Bb(a, a.sel.ranges[e], b[e], null);
        var f = ub(d, a.sel.primIndex);
        Ib(a, f, c)
    }

    function Eb(a, b, c, d) {
        var e = a.sel.ranges.slice(0);
        e[b] = c, Ib(a, ub(e, a.sel.primIndex), d)
    }

    function Fb(a, b, c, d) {
        Ib(a, vb(b, c), d)
    }

    function Gb(a, b) {
        var c = {
            ranges: b.ranges, update: function (b) {
                this.ranges = [];
                for (var c = 0; c < b.length; c++)this.ranges[c] = new tb(xb(a, b[c].anchor), xb(a, b[c].head))
            }
        };
        return rg(a, "beforeSelectionChange", a, c), a.cm && rg(a.cm, "beforeSelectionChange", a.cm, c), c.ranges != b.ranges ? ub(c.ranges, c.ranges.length - 1) : b
    }

    function Hb(a, b, c) {
        var d = a.history.done, e = Jg(d);
        e && e.ranges ? (d[d.length - 1] = b, Jb(a, b, c)) : Ib(a, b, c)
    }

    function Ib(a, b, c) {
        Jb(a, b, c), ag(a, a.sel, a.cm ? a.cm.curOp.id : 0 / 0, c)
    }

    function Jb(a, b, c) {
        (xg(a, "beforeSelectionChange") || a.cm && xg(a.cm, "beforeSelectionChange")) && (b = Gb(a, b));
        var d = c && c.bias || (ob(b.primary().head, a.sel.primary().head) < 0 ? -1 : 1);
        Kb(a, Mb(a, b, d, !0)), c && c.scroll === !1 || !a.cm || ae(a.cm)
    }

    function Kb(a, b) {
        b.equals(a.sel) || (a.sel = b, a.cm && (a.cm.curOp.updateInput = a.cm.curOp.selectionChanged = !0, wg(a.cm)), tg(a, "cursorActivity", a))
    }

    function Lb(a) {
        Kb(a, Mb(a, a.sel, null, !1), Bg)
    }

    function Mb(a, b, c, d) {
        for (var e, f = 0; f < b.ranges.length; f++) {
            var g = b.ranges[f], h = Nb(a, g.anchor, c, d), i = Nb(a, g.head, c, d);
            (e || h != g.anchor || i != g.head) && (e || (e = b.ranges.slice(0, f)), e[f] = new tb(h, i))
        }
        return e ? ub(e, b.primIndex) : b
    }

    function Nb(a, b, c, d) {
        var e = !1, f = b, g = c || 1;
        a.cantEdit = !1;
        a:for (; ;) {
            var h = Of(a, f.line);
            if (h.markedSpans)for (var i = 0; i < h.markedSpans.length; ++i) {
                var j = h.markedSpans[i], k = j.marker;
                if ((null == j.from || (k.inclusiveLeft ? j.from <= f.ch : j.from < f.ch)) && (null == j.to || (k.inclusiveRight ? j.to >= f.ch : j.to > f.ch))) {
                    if (d && (rg(k, "beforeCursorEnter"), k.explicitlyCleared)) {
                        if (h.markedSpans) {
                            --i;
                            continue
                        }
                        break
                    }
                    if (!k.atomic)continue;
                    var l = k.find(0 > g ? -1 : 1);
                    if (0 == ob(l, f) && (l.ch += g, l.ch < 0 ? l = l.line > a.first ? xb(a, nb(l.line - 1)) : null : l.ch > h.text.length && (l = l.line < a.first + a.size - 1 ? nb(l.line + 1, 0) : null), !l)) {
                        if (e)return d ? (a.cantEdit = !0, nb(a.first, 0)) : Nb(a, b, c, !0);
                        e = !0, l = b, g = -g
                    }
                    f = l;
                    continue a
                }
            }
            return f
        }
    }

    function Ob(a) {
        for (var b = a.display, c = a.doc, d = {}, e = d.cursors = document.createDocumentFragment(), f = d.selection = document.createDocumentFragment(), g = 0; g < c.sel.ranges.length; g++) {
            var h = c.sel.ranges[g], i = h.empty();
            (i || a.options.showCursorWhenSelecting) && Qb(a, h, e), i || Rb(a, h, f)
        }
        if (a.options.moveInputWithCursor) {
            var j = qc(a, c.sel.primary().head, "div"), k = b.wrapper.getBoundingClientRect(), l = b.lineDiv.getBoundingClientRect();
            d.teTop = Math.max(0, Math.min(b.wrapper.clientHeight - 10, j.top + l.top - k.top)), d.teLeft = Math.max(0, Math.min(b.wrapper.clientWidth - 10, j.left + l.left - k.left))
        }
        return d
    }

    function Pb(a, b) {
        b || (b = Ob(a)), Zg(a.display.cursorDiv, b.cursors), Zg(a.display.selectionDiv, b.selection), null != b.teTop && (a.display.inputDiv.style.top = b.teTop + "px", a.display.inputDiv.style.left = b.teLeft + "px")
    }

    function Qb(a, b, c) {
        var d = qc(a, b.head, "div", null, null, !a.options.singleCursorHeightPerLine), e = c.appendChild(Wg("div", "\xa0", "CodeMirror-cursor"));
        if (e.style.left = d.left + "px", e.style.top = d.top + "px", e.style.height = Math.max(0, d.bottom - d.top) * a.options.cursorHeight + "px", d.other) {
            var f = c.appendChild(Wg("div", "\xa0", "CodeMirror-cursor CodeMirror-secondarycursor"));
            f.style.display = "", f.style.left = d.other.left + "px", f.style.top = d.other.top + "px", f.style.height = .85 * (d.other.bottom - d.other.top) + "px"
        }
    }

    function Rb(a, b, c) {
        function j(a, b, c, d) {
            0 > b && (b = 0), b = Math.round(b), d = Math.round(d), f.appendChild(Wg("div", null, "CodeMirror-selected", "position: absolute; left: " + a + "px; top: " + b + "px; width: " + (null == c ? i - a : c) + "px; height: " + (d - b) + "px"))
        }

        function k(b, c, d) {
            function m(c, d) {
                return pc(a, nb(b, c), "div", f, d)
            }

            var k, l, f = Of(e, b), g = f.text.length;
            return vh(Vf(f), c || 0, null == d ? g : d, function (a, b, e) {
                var n, o, p, f = m(a, "left");
                if (a == b)n = f, o = p = f.left; else {
                    if (n = m(b - 1, "right"), "rtl" == e) {
                        var q = f;
                        f = n, n = q
                    }
                    o = f.left, p = n.right
                }
                null == c && 0 == a && (o = h), n.top - f.top > 3 && (j(o, f.top, null, f.bottom), o = h, f.bottom < n.top && j(o, f.bottom, null, n.top)), null == d && b == g && (p = i), (!k || f.top < k.top || f.top == k.top && f.left < k.left) && (k = f), (!l || n.bottom > l.bottom || n.bottom == l.bottom && n.right > l.right) && (l = n), h + 1 > o && (o = h), j(o, n.top, p - o, n.bottom)
            }), {start: k, end: l}
        }

        var d = a.display, e = a.doc, f = document.createDocumentFragment(), g = Zb(a.display), h = g.left, i = d.lineSpace.offsetWidth - g.right, l = b.from(), m = b.to();
        if (l.line == m.line)k(l.line, l.ch, m.ch); else {
            var n = Of(e, l.line), o = Of(e, m.line), p = _e(n) == _e(o), q = k(l.line, l.ch, p ? n.text.length + 1 : null).end, r = k(m.line, p ? 0 : null, m.ch).start;
            p && (q.top < r.top - 2 ? (j(q.right, q.top, null, q.bottom), j(h, r.top, r.left, r.bottom)) : j(q.right, q.top, r.left - q.right, q.bottom)), q.bottom < r.top && j(h, q.bottom, null, r.top)
        }
        c.appendChild(f)
    }

    function Sb(a) {
        if (a.state.focused) {
            var b = a.display;
            clearInterval(b.blinker);
            var c = !0;
            b.cursorDiv.style.visibility = "", a.options.cursorBlinkRate > 0 ? b.blinker = setInterval(function () {
                b.cursorDiv.style.visibility = (c = !c) ? "" : "hidden"
            }, a.options.cursorBlinkRate) : a.options.cursorBlinkRate < 0 && (b.cursorDiv.style.visibility = "hidden")
        }
    }

    function Tb(a, b) {
        a.doc.mode.startState && a.doc.frontier < a.display.viewTo && a.state.highlight.set(b, Pg(Ub, a))
    }

    function Ub(a) {
        var b = a.doc;
        if (b.frontier < b.first && (b.frontier = b.first), !(b.frontier >= a.display.viewTo)) {
            var c = +new Date + a.options.workTime, d = re(b.mode, Wb(a, b.frontier)), e = [];
            b.iter(b.frontier, Math.min(b.first + b.size, a.display.viewTo + 500), function (f) {
                if (b.frontier >= a.display.viewFrom) {
                    var g = f.styles, h = rf(a, f, d, !0);
                    f.styles = h.styles;
                    var i = f.styleClasses, j = h.classes;
                    j ? f.styleClasses = j : i && (f.styleClasses = null);
                    for (var k = !g || g.length != f.styles.length || i != j && (!i || !j || i.bgClass != j.bgClass || i.textClass != j.textClass), l = 0; !k && l < g.length; ++l)k = g[l] != f.styles[l];
                    k && e.push(b.frontier), f.stateAfter = re(b.mode, d)
                } else tf(a, f.text, d), f.stateAfter = 0 == b.frontier % 5 ? re(b.mode, d) : null;
                return ++b.frontier, +new Date > c ? (Tb(a, a.options.workDelay), !0) : void 0
            }), e.length && Jc(a, function () {
                for (var b = 0; b < e.length; b++)Qc(a, e[b], "text")
            })
        }
    }

    function Vb(a, b, c) {
        for (var d, e, f = a.doc, g = c ? -1 : b - (a.doc.mode.innerMode ? 1e3 : 100), h = b; h > g; --h) {
            if (h <= f.first)return f.first;
            var i = Of(f, h - 1);
            if (i.stateAfter && (!c || h <= f.frontier))return h;
            var j = Fg(i.text, null, a.options.tabSize);
            (null == e || d > j) && (e = h - 1, d = j)
        }
        return e
    }

    function Wb(a, b, c) {
        var d = a.doc, e = a.display;
        if (!d.mode.startState)return !0;
        var f = Vb(a, b, c), g = f > d.first && Of(d, f - 1).stateAfter;
        return g = g ? re(d.mode, g) : se(d.mode), d.iter(f, b, function (c) {
            tf(a, c.text, g);
            var h = f == b - 1 || 0 == f % 5 || f >= e.viewFrom && f < e.viewTo;
            c.stateAfter = h ? re(d.mode, g) : null, ++f
        }), c && (d.frontier = f), g
    }

    function Xb(a) {
        return a.lineSpace.offsetTop
    }

    function Yb(a) {
        return a.mover.offsetHeight - a.lineSpace.offsetHeight
    }

    function Zb(a) {
        if (a.cachedPaddingH)return a.cachedPaddingH;
        var b = Zg(a.measure, Wg("pre", "x")), c = window.getComputedStyle ? window.getComputedStyle(b) : b.currentStyle, d = {
            left: parseInt(c.paddingLeft),
            right: parseInt(c.paddingRight)
        };
        return isNaN(d.left) || isNaN(d.right) || (a.cachedPaddingH = d), d
    }

    function $b(a, b, c) {
        var d = a.options.lineWrapping, e = d && a.display.scroller.clientWidth;
        if (!b.measure.heights || d && b.measure.width != e) {
            var f = b.measure.heights = [];
            if (d) {
                b.measure.width = e;
                for (var g = b.text.firstChild.getClientRects(), h = 0; h < g.length - 1; h++) {
                    var i = g[h], j = g[h + 1];
                    Math.abs(i.bottom - j.bottom) > 2 && f.push((i.bottom + j.top) / 2 - c.top)
                }
            }
            f.push(c.bottom - c.top)
        }
    }

    function _b(a, b, c) {
        if (a.line == b)return {map: a.measure.map, cache: a.measure.cache};
        for (var d = 0; d < a.rest.length; d++)if (a.rest[d] == b)return {
            map: a.measure.maps[d],
            cache: a.measure.caches[d]
        };
        for (var d = 0; d < a.rest.length; d++)if (Sf(a.rest[d]) > c)return {
            map: a.measure.maps[d],
            cache: a.measure.caches[d],
            before: !0
        }
    }

    function ac(a, b) {
        b = _e(b);
        var c = Sf(b), d = a.display.externalMeasured = new Nc(a.doc, b, c);
        d.lineN = c;
        var e = d.built = xf(a, d);
        return d.text = e.pre, Zg(a.display.lineMeasure, e.pre), d
    }

    function bc(a, b, c, d) {
        return ec(a, dc(a, b), c, d)
    }

    function cc(a, b) {
        if (b >= a.display.viewFrom && b < a.display.viewTo)return a.display.view[Sc(a, b)];
        var c = a.display.externalMeasured;
        return c && b >= c.lineN && b < c.lineN + c.size ? c : void 0
    }

    function dc(a, b) {
        var c = Sf(b), d = cc(a, c);
        d && !d.text ? d = null : d && d.changes && bb(a, d, c, _(a)), d || (d = ac(a, b));
        var e = _b(d, b, c);
        return {line: b, view: d, rect: null, map: e.map, cache: e.cache, before: e.before, hasHeights: !1}
    }

    function ec(a, b, c, d, e) {
        b.before && (c = -1);
        var g, f = c + (d || "");
        return b.cache.hasOwnProperty(f) ? g = b.cache[f] : (b.rect || (b.rect = b.view.text.getBoundingClientRect()), b.hasHeights || ($b(a, b.view, b.rect), b.hasHeights = !0), g = gc(a, b, c, d), g.bogus || (b.cache[f] = g)), {
            left: g.left,
            right: g.right,
            top: e ? g.rtop : g.top,
            bottom: e ? g.rbottom : g.bottom
        }
    }

    function gc(a, b, c, f) {
        for (var h, i, j, k, g = b.map, l = 0; l < g.length; l += 3) {
            var m = g[l], n = g[l + 1];
            if (m > c ? (i = 0, j = 1, k = "left") : n > c ? (i = c - m, j = i + 1) : (l == g.length - 3 || c == n && g[l + 3] > c) && (j = n - m, i = j - 1, c >= n && (k = "right")), null != i) {
                if (h = g[l + 2], m == n && f == (h.insertLeft ? "left" : "right") && (k = f), "left" == f && 0 == i)for (; l && g[l - 2] == g[l - 3] && g[l - 1].insertLeft;)h = g[(l -= 3) + 2], k = "left";
                if ("right" == f && i == n - m)for (; l < g.length - 3 && g[l + 3] == g[l + 4] && !g[l + 5].insertLeft;)h = g[(l += 3) + 2], k = "right";
                break
            }
        }
        var o;
        if (3 == h.nodeType) {
            for (; i && Vg(b.line.text.charAt(m + i));)--i;
            for (; n > m + j && Vg(b.line.text.charAt(m + j));)++j;
            if (d && 9 > e && 0 == i && j == n - m)o = h.parentNode.getBoundingClientRect(); else if (d && a.options.lineWrapping) {
                var p = Xg(h, i, j).getClientRects();
                o = p.length ? p["right" == f ? p.length - 1 : 0] : fc
            } else o = Xg(h, i, j).getBoundingClientRect() || fc
        } else {
            i > 0 && (k = f = "right");
            var p;
            o = a.options.lineWrapping && (p = h.getClientRects()).length > 1 ? p["right" == f ? p.length - 1 : 0] : h.getBoundingClientRect()
        }
        if (d && 9 > e && !i && (!o || !o.left && !o.right)) {
            var q = h.parentNode.getClientRects()[0];
            o = q ? {left: q.left, right: q.left + xc(a.display), top: q.top, bottom: q.bottom} : fc
        }
        d && 11 > e && (o = hc(a.display.measure, o));
        for (var r = o.top - b.rect.top, s = o.bottom - b.rect.top, t = (r + s) / 2, u = b.view.measure.heights, l = 0; l < u.length - 1 && !(t < u[l]); l++);
        var v = l ? u[l - 1] : 0, w = u[l], x = {
            left: ("right" == k ? o.right : o.left) - b.rect.left,
            right: ("left" == k ? o.left : o.right) - b.rect.left,
            top: v,
            bottom: w
        };
        return o.left || o.right || (x.bogus = !0), a.options.singleCursorHeightPerLine || (x.rtop = r, x.rbottom = s), x
    }

    function hc(a, b) {
        if (!window.screen || null == screen.logicalXDPI || screen.logicalXDPI == screen.deviceXDPI || !th(a))return b;
        var c = screen.logicalXDPI / screen.deviceXDPI, d = screen.logicalYDPI / screen.deviceYDPI;
        return {left: b.left * c, right: b.right * c, top: b.top * d, bottom: b.bottom * d}
    }

    function ic(a) {
        if (a.measure && (a.measure.cache = {}, a.measure.heights = null, a.rest))for (var b = 0; b < a.rest.length; b++)a.measure.caches[b] = {}
    }

    function jc(a) {
        a.display.externalMeasure = null, Yg(a.display.lineMeasure);
        for (var b = 0; b < a.display.view.length; b++)ic(a.display.view[b])
    }

    function kc(a) {
        jc(a), a.display.cachedCharWidth = a.display.cachedTextHeight = a.display.cachedPaddingH = null, a.options.lineWrapping || (a.display.maxLineChanged = !0), a.display.lineNumChars = null
    }

    function lc() {
        return window.pageXOffset || (document.documentElement || document.body).scrollLeft
    }

    function mc() {
        return window.pageYOffset || (document.documentElement || document.body).scrollTop
    }

    function nc(a, b, c, d) {
        if (b.widgets)for (var e = 0; e < b.widgets.length; ++e)if (b.widgets[e].above) {
            var f = hf(b.widgets[e]);
            c.top += f, c.bottom += f
        }
        if ("line" == d)return c;
        d || (d = "local");
        var g = Uf(b);
        if ("local" == d ? g += Xb(a.display) : g -= a.display.viewOffset, "page" == d || "window" == d) {
            var h = a.display.lineSpace.getBoundingClientRect();
            g += h.top + ("window" == d ? 0 : mc());
            var i = h.left + ("window" == d ? 0 : lc());
            c.left += i, c.right += i
        }
        return c.top += g, c.bottom += g, c
    }

    function oc(a, b, c) {
        if ("div" == c)return b;
        var d = b.left, e = b.top;
        if ("page" == c)d -= lc(), e -= mc(); else if ("local" == c || !c) {
            var f = a.display.sizer.getBoundingClientRect();
            d += f.left, e += f.top
        }
        var g = a.display.lineSpace.getBoundingClientRect();
        return {left: d - g.left, top: e - g.top}
    }

    function pc(a, b, c, d, e) {
        return d || (d = Of(a.doc, b.line)), nc(a, d, bc(a, d, b.ch, e), c)
    }

    function qc(a, b, c, d, e, f) {
        function g(b, g) {
            var h = ec(a, e, b, g ? "right" : "left", f);
            return g ? h.left = h.right : h.right = h.left, nc(a, d, h, c)
        }

        function h(a, b) {
            var c = i[b], d = c.level % 2;
            return a == wh(c) && b && c.level < i[b - 1].level ? (c = i[--b], a = xh(c) - (c.level % 2 ? 0 : 1), d = !0) : a == xh(c) && b < i.length - 1 && c.level < i[b + 1].level && (c = i[++b], a = wh(c) - c.level % 2, d = !1), d && a == c.to && a > c.from ? g(a - 1) : g(a, d)
        }

        d = d || Of(a.doc, b.line), e || (e = dc(a, d));
        var i = Vf(d), j = b.ch;
        if (!i)return g(j);
        var k = Eh(i, j), l = h(j, k);
        return null != Dh && (l.other = h(j, Dh)), l
    }

    function rc(a, b) {
        var c = 0, b = xb(a.doc, b);
        a.options.lineWrapping || (c = xc(a.display) * b.ch);
        var d = Of(a.doc, b.line), e = Uf(d) + Xb(a.display);
        return {left: c, right: c, top: e, bottom: e + d.height}
    }

    function sc(a, b, c, d) {
        var e = nb(a, b);
        return e.xRel = d, c && (e.outside = !0), e
    }

    function tc(a, b, c) {
        var d = a.doc;
        if (c += a.display.viewOffset, 0 > c)return sc(d.first, 0, !0, -1);
        var e = Tf(d, c), f = d.first + d.size - 1;
        if (e > f)return sc(d.first + d.size - 1, Of(d, f).text.length, !0, 1);
        0 > b && (b = 0);
        for (var g = Of(d, e); ;) {
            var h = uc(a, g, e, b, c), i = Ze(g), j = i && i.find(0, !0);
            if (!i || !(h.ch > j.from.ch || h.ch == j.from.ch && h.xRel > 0))return h;
            e = Sf(g = j.to.line)
        }
    }

    function uc(a, b, c, d, e) {
        function j(d) {
            var e = qc(a, nb(c, d), "line", b, i);
            return g = !0, f > e.bottom ? e.left - h : f < e.top ? e.left + h : (g = !1, e.left)
        }

        var f = e - Uf(b), g = !1, h = 2 * a.display.wrapper.clientWidth, i = dc(a, b), k = Vf(b), l = b.text.length, m = yh(b), n = zh(b), o = j(m), p = g, q = j(n), r = g;
        if (d > q)return sc(c, n, r, 1);
        for (; ;) {
            if (k ? n == m || n == Gh(b, m, 1) : 1 >= n - m) {
                for (var s = o > d || q - d >= d - o ? m : n, t = d - (s == m ? o : q); Vg(b.text.charAt(s));)++s;
                var u = sc(c, s, s == m ? p : r, -1 > t ? -1 : t > 1 ? 1 : 0);
                return u
            }
            var v = Math.ceil(l / 2), w = m + v;
            if (k) {
                w = m;
                for (var x = 0; v > x; ++x)w = Gh(b, w, 1)
            }
            var y = j(w);
            y > d ? (n = w, q = y, (r = g) && (q += 1e3), l = v) : (m = w, o = y, p = g, l -= v)
        }
    }

    function wc(a) {
        if (null != a.cachedTextHeight)return a.cachedTextHeight;
        if (null == vc) {
            vc = Wg("pre");
            for (var b = 0; 49 > b; ++b)vc.appendChild(document.createTextNode("x")), vc.appendChild(Wg("br"));
            vc.appendChild(document.createTextNode("x"))
        }
        Zg(a.measure, vc);
        var c = vc.offsetHeight / 50;
        return c > 3 && (a.cachedTextHeight = c), Yg(a.measure), c || 1
    }

    function xc(a) {
        if (null != a.cachedCharWidth)return a.cachedCharWidth;
        var b = Wg("span", "xxxxxxxxxx"), c = Wg("pre", [b]);
        Zg(a.measure, c);
        var d = b.getBoundingClientRect(), e = (d.right - d.left) / 10;
        return e > 2 && (a.cachedCharWidth = e), e || 10
    }

    function Ac(a) {
        a.curOp = {
            cm: a,
            viewChanged: !1,
            startHeight: a.doc.height,
            forceUpdate: !1,
            updateInput: null,
            typing: !1,
            changeObjs: null,
            cursorActivityHandlers: null,
            cursorActivityCalled: 0,
            selectionChanged: !1,
            updateMaxLine: !1,
            scrollLeft: null,
            scrollTop: null,
            scrollToPos: null,
            id: ++zc
        }, yc ? yc.ops.push(a.curOp) : a.curOp.ownsGroup = yc = {ops: [a.curOp], delayedCallbacks: []}
    }

    function Bc(a) {
        var b = a.delayedCallbacks, c = 0;
        do {
            for (; c < b.length; c++)b[c]();
            for (var d = 0; d < a.ops.length; d++) {
                var e = a.ops[d];
                if (e.cursorActivityHandlers)for (; e.cursorActivityCalled < e.cursorActivityHandlers.length;)e.cursorActivityHandlers[e.cursorActivityCalled++](e.cm)
            }
        } while (c < b.length)
    }

    function Cc(a) {
        var b = a.curOp, c = b.ownsGroup;
        if (c)try {
            Bc(c)
        } finally {
            yc = null;
            for (var d = 0; d < c.ops.length; d++)c.ops[d].cm.curOp = null;
            Dc(c)
        }
    }

    function Dc(a) {
        for (var b = a.ops, c = 0; c < b.length; c++)Ec(b[c]);
        for (var c = 0; c < b.length; c++)Fc(b[c]);
        for (var c = 0; c < b.length; c++)Gc(b[c]);
        for (var c = 0; c < b.length; c++)Hc(b[c]);
        for (var c = 0; c < b.length; c++)Ic(b[c])
    }

    function Ec(a) {
        var b = a.cm, c = b.display;
        a.updateMaxLine && J(b), a.mustUpdate = a.viewChanged || a.forceUpdate || null != a.scrollTop || a.scrollToPos && (a.scrollToPos.from.line < c.viewFrom || a.scrollToPos.to.line >= c.viewTo) || c.maxLineChanged && b.options.lineWrapping, a.update = a.mustUpdate && new T(b, a.mustUpdate && {
                    top: a.scrollTop,
                    ensure: a.scrollToPos
                }, a.forceUpdate)
    }

    function Fc(a) {
        a.updatedDisplay = a.mustUpdate && U(a.cm, a.update)
    }

    function Gc(a) {
        var b = a.cm, c = b.display;
        a.updatedDisplay && Z(b), c.maxLineChanged && !b.options.lineWrapping && (a.adjustWidthTo = bc(b, c.maxLine, c.maxLine.text.length).left, a.maxScrollLeft = Math.max(0, c.sizer.offsetLeft + a.adjustWidthTo + zg - c.scroller.clientWidth)), a.barMeasure = M(b), (a.updatedDisplay || a.selectionChanged) && (a.newSelectionNodes = Ob(b))
    }

    function Hc(a) {
        var b = a.cm;
        null != a.adjustWidthTo && (b.display.sizer.style.minWidth = a.adjustWidthTo + "px", a.maxScrollLeft < b.doc.scrollLeft && sd(b, Math.min(b.display.scroller.scrollLeft, a.maxScrollLeft), !0)), a.newSelectionNodes && Pb(b, a.newSelectionNodes), a.updatedDisplay && X(b, a.barMeasure), (a.updatedDisplay || a.startHeight != b.doc.height) && N(b, a.barMeasure), a.selectionChanged && Sb(b), b.state.focused && a.updateInput && $c(b, a.typing)
    }

    function Ic(a) {
        var b = a.cm, c = b.display, d = b.doc;
        if (a.updatedDisplay && V(b, a.update), null == c.wheelStartX || null == a.scrollTop && null == a.scrollLeft && !a.scrollToPos || (c.wheelStartX = c.wheelStartY = null), null != a.scrollTop && c.scroller.scrollTop != a.scrollTop) {
            var e = Math.max(0, Math.min(c.scroller.scrollHeight - c.scroller.clientHeight, a.scrollTop));
            c.scroller.scrollTop = c.scrollbarV.scrollTop = d.scrollTop = e
        }
        if (null != a.scrollLeft && c.scroller.scrollLeft != a.scrollLeft) {
            var g = Math.max(0, Math.min(c.scroller.scrollWidth - c.scroller.clientWidth, a.scrollLeft));
            c.scroller.scrollLeft = c.scrollbarH.scrollLeft = d.scrollLeft = g, P(b)
        }
        if (a.scrollToPos) {
            var h = Yd(b, xb(d, a.scrollToPos.from), xb(d, a.scrollToPos.to), a.scrollToPos.margin);
            a.scrollToPos.isCursor && b.state.focused && Xd(b, h)
        }
        var i = a.maybeHiddenMarkers, j = a.maybeUnhiddenMarkers;
        if (i)for (var k = 0; k < i.length; ++k)i[k].lines.length || rg(i[k], "hide");
        if (j)for (var k = 0; k < j.length; ++k)j[k].lines.length && rg(j[k], "unhide");
        c.wrapper.offsetHeight && (d.scrollTop = b.display.scroller.scrollTop), a.updatedDisplay && f && (b.options.lineWrapping && Y(b, a.barMeasure), a.barMeasure.scrollWidth > a.barMeasure.clientWidth && a.barMeasure.scrollWidth < a.barMeasure.clientWidth + 1 && !L(b) && N(b)), a.changeObjs && rg(b, "changes", b, a.changeObjs)
    }

    function Jc(a, b) {
        if (a.curOp)return b();
        Ac(a);
        try {
            return b()
        } finally {
            Cc(a)
        }
    }

    function Kc(a, b) {
        return function () {
            if (a.curOp)return b.apply(a, arguments);
            Ac(a);
            try {
                return b.apply(a, arguments)
            } finally {
                Cc(a)
            }
        }
    }

    function Lc(a) {
        return function () {
            if (this.curOp)return a.apply(this, arguments);
            Ac(this);
            try {
                return a.apply(this, arguments)
            } finally {
                Cc(this)
            }
        }
    }

    function Mc(a) {
        return function () {
            var b = this.cm;
            if (!b || b.curOp)return a.apply(this, arguments);
            Ac(b);
            try {
                return a.apply(this, arguments)
            } finally {
                Cc(b)
            }
        }
    }

    function Nc(a, b, c) {
        this.line = b, this.rest = af(b), this.size = this.rest ? Sf(Jg(this.rest)) - c + 1 : 1, this.node = this.text = null, this.hidden = df(a, b)
    }

    function Oc(a, b, c) {
        for (var e, d = [], f = b; c > f; f = e) {
            var g = new Nc(a.doc, Of(a.doc, f), f);
            e = f + g.size, d.push(g)
        }
        return d
    }

    function Pc(a, b, c, d) {
        null == b && (b = a.doc.first), null == c && (c = a.doc.first + a.doc.size), d || (d = 0);
        var e = a.display;
        if (d && c < e.viewTo && (null == e.updateLineNumbers || e.updateLineNumbers > b) && (e.updateLineNumbers = b), a.curOp.viewChanged = !0, b >= e.viewTo)v && bf(a.doc, b) < e.viewTo && Rc(a); else if (c <= e.viewFrom)v && cf(a.doc, c + d) > e.viewFrom ? Rc(a) : (e.viewFrom += d, e.viewTo += d); else if (b <= e.viewFrom && c >= e.viewTo)Rc(a); else if (b <= e.viewFrom) {
            var f = Tc(a, c, c + d, 1);
            f ? (e.view = e.view.slice(f.index), e.viewFrom = f.lineN, e.viewTo += d) : Rc(a)
        } else if (c >= e.viewTo) {
            var f = Tc(a, b, b, -1);
            f ? (e.view = e.view.slice(0, f.index), e.viewTo = f.lineN) : Rc(a)
        } else {
            var g = Tc(a, b, b, -1), h = Tc(a, c, c + d, 1);
            g && h ? (e.view = e.view.slice(0, g.index).concat(Oc(a, g.lineN, h.lineN)).concat(e.view.slice(h.index)), e.viewTo += d) : Rc(a)
        }
        var i = e.externalMeasured;
        i && (c < i.lineN ? i.lineN += d : b < i.lineN + i.size && (e.externalMeasured = null))
    }

    function Qc(a, b, c) {
        a.curOp.viewChanged = !0;
        var d = a.display, e = a.display.externalMeasured;
        if (e && b >= e.lineN && b < e.lineN + e.size && (d.externalMeasured = null), !(b < d.viewFrom || b >= d.viewTo)) {
            var f = d.view[Sc(a, b)];
            if (null != f.node) {
                var g = f.changes || (f.changes = []);
                -1 == Lg(g, c) && g.push(c)
            }
        }
    }

    function Rc(a) {
        a.display.viewFrom = a.display.viewTo = a.doc.first, a.display.view = [], a.display.viewOffset = 0
    }

    function Sc(a, b) {
        if (b >= a.display.viewTo)return null;
        if (b -= a.display.viewFrom, 0 > b)return null;
        for (var c = a.display.view, d = 0; d < c.length; d++)if (b -= c[d].size, 0 > b)return d
    }

    function Tc(a, b, c, d) {
        var f, e = Sc(a, b), g = a.display.view;
        if (!v || c == a.doc.first + a.doc.size)return {index: e, lineN: c};
        for (var h = 0, i = a.display.viewFrom; e > h; h++)i += g[h].size;
        if (i != b) {
            if (d > 0) {
                if (e == g.length - 1)return null;
                f = i + g[e].size - b, e++
            } else f = i - b;
            b += f, c += f
        }
        for (; bf(a.doc, c) != c;) {
            if (e == (0 > d ? 0 : g.length - 1))return null;
            c += d * g[e - (0 > d ? 1 : 0)].size, e += d
        }
        return {index: e, lineN: c}
    }

    function Uc(a, b, c) {
        var d = a.display, e = d.view;
        0 == e.length || b >= d.viewTo || c <= d.viewFrom ? (d.view = Oc(a, b, c), d.viewFrom = b) : (d.viewFrom > b ? d.view = Oc(a, b, d.viewFrom).concat(d.view) : d.viewFrom < b && (d.view = d.view.slice(Sc(a, b))), d.viewFrom = b, d.viewTo < c ? d.view = d.view.concat(Oc(a, d.viewTo, c)) : d.viewTo > c && (d.view = d.view.slice(0, Sc(a, c)))), d.viewTo = c
    }

    function Vc(a) {
        for (var b = a.display.view, c = 0, d = 0; d < b.length; d++) {
            var e = b[d];
            e.hidden || e.node && !e.changes || ++c
        }
        return c
    }

    function Wc(a) {
        a.display.pollingFast || a.display.poll.set(a.options.pollInterval, function () {
            Zc(a), a.state.focused && Wc(a)
        })
    }

    function Xc(a) {
        function c() {
            var d = Zc(a);
            d || b ? (a.display.pollingFast = !1, Wc(a)) : (b = !0, a.display.poll.set(60, c))
        }

        var b = !1;
        a.display.pollingFast = !0, a.display.poll.set(20, c)
    }

    function Zc(a) {
        var b = a.display.input, c = a.display.prevInput, f = a.doc;
        if (!a.state.focused || qh(b) && !c || bd(a) || a.options.disableInput)return !1;
        a.state.pasteIncoming && a.state.fakedLastChar && (b.value = b.value.substring(0, b.value.length - 1), a.state.fakedLastChar = !1);
        var g = b.value;
        if (g == c && !a.somethingSelected())return !1;
        if (d && e >= 9 && a.display.inputHasSelection === g || p && /[\uf700-\uf7ff]/.test(g))return $c(a), !1;
        var h = !a.curOp;
        h && Ac(a), a.display.shift = !1, 8203 != g.charCodeAt(0) || f.sel != a.display.selForContextMenu || c || (c = "\u200b");
        for (var i = 0, j = Math.min(c.length, g.length); j > i && c.charCodeAt(i) == g.charCodeAt(i);)++i;
        var k = g.slice(i), l = ph(k), m = null;
        a.state.pasteIncoming && f.sel.ranges.length > 1 && (Yc && Yc.join("\n") == k ? m = 0 == f.sel.ranges.length % Yc.length && Mg(Yc, ph) : l.length == f.sel.ranges.length && (m = Mg(l, function (a) {
            return [a]
        })));
        for (var n = f.sel.ranges.length - 1; n >= 0; n--) {
            var o = f.sel.ranges[n], q = o.from(), r = o.to();
            i < c.length ? q = nb(q.line, q.ch - (c.length - i)) : a.state.overwrite && o.empty() && !a.state.pasteIncoming && (r = nb(r.line, Math.min(Of(f, r.line).text.length, r.ch + Jg(l).length)));
            var s = a.curOp.updateInput, t = {
                from: q,
                to: r,
                text: m ? m[n % m.length] : l,
                origin: a.state.pasteIncoming ? "paste" : a.state.cutIncoming ? "cut" : "+input"
            };
            if (Qd(a.doc, t), tg(a, "inputRead", a, t), k && !a.state.pasteIncoming && a.options.electricChars && a.options.smartIndent && o.head.ch < 100 && (!n || f.sel.ranges[n - 1].head.line != o.head.line)) {
                var u = a.getModeAt(o.head);
                if (u.electricChars) {
                    for (var v = 0; v < u.electricChars.length; v++)if (k.indexOf(u.electricChars.charAt(v)) > -1) {
                        ce(a, o.head.line, "smart");
                        break
                    }
                } else if (u.electricInput) {
                    var w = Kd(t);
                    u.electricInput.test(Of(f, w.line).text.slice(0, w.ch)) && ce(a, o.head.line, "smart")
                }
            }
        }
        return ae(a), a.curOp.updateInput = s, a.curOp.typing = !0, g.length > 1e3 || g.indexOf("\n") > -1 ? b.value = a.display.prevInput = "" : a.display.prevInput = g, h && Cc(a), a.state.pasteIncoming = a.state.cutIncoming = !1, !0
    }

    function $c(a, b) {
        var c, f, g = a.doc;
        if (a.somethingSelected()) {
            a.display.prevInput = "";
            var h = g.sel.primary();
            c = rh && (h.to().line - h.from().line > 100 || (f = a.getSelection()).length > 1e3);
            var i = c ? "-" : f || a.getSelection();
            a.display.input.value = i, a.state.focused && Kg(a.display.input), d && e >= 9 && (a.display.inputHasSelection = i)
        } else b || (a.display.prevInput = a.display.input.value = "", d && e >= 9 && (a.display.inputHasSelection = null));
        a.display.inaccurateSelection = c
    }

    function _c(a) {
        "nocursor" == a.options.readOnly || o && _g() == a.display.input || a.display.input.focus()
    }

    function ad(a) {
        a.state.focused || (_c(a), Gd(a))
    }

    function bd(a) {
        return a.options.readOnly || a.doc.cantEdit
    }

    function cd(a) {
        function c() {
            a.state.focused && setTimeout(Pg(_c, a), 0)
        }

        function g(b) {
            vg(a, b) || mg(b)
        }

        function h(c) {
            if (a.somethingSelected())Yc = a.getSelections(), b.inaccurateSelection && (b.prevInput = "", b.inaccurateSelection = !1, b.input.value = Yc.join("\n"), Kg(b.input)); else {
                for (var d = [], e = [], f = 0; f < a.doc.sel.ranges.length; f++) {
                    var g = a.doc.sel.ranges[f].head.line, h = {anchor: nb(g, 0), head: nb(g + 1, 0)};
                    e.push(h), d.push(a.getRange(h.anchor, h.head))
                }
                "cut" == c.type ? a.setSelections(e, null, Bg) : (b.prevInput = "", b.input.value = d.join("\n"), Kg(b.input)), Yc = d
            }
            "cut" == c.type && (a.state.cutIncoming = !0)
        }

        var b = a.display;
        pg(b.scroller, "mousedown", Kc(a, gd)), d && 11 > e ? pg(b.scroller, "dblclick", Kc(a, function (b) {
            if (!vg(a, b)) {
                var c = fd(a, b);
                if (c && !nd(a, b) && !ed(a.display, b)) {
                    jg(b);
                    var d = he(a, c);
                    Cb(a.doc, d.anchor, d.head)
                }
            }
        })) : pg(b.scroller, "dblclick", function (b) {
            vg(a, b) || jg(b)
        }), pg(b.lineSpace, "selectstart", function (a) {
            ed(b, a) || jg(a)
        }), t || pg(b.scroller, "contextmenu", function (b) {
            Id(a, b)
        }), pg(b.scroller, "scroll", function () {
            b.scroller.clientHeight && (rd(a, b.scroller.scrollTop), sd(a, b.scroller.scrollLeft, !0), rg(a, "scroll", a))
        }), pg(b.scrollbarV, "scroll", function () {
            b.scroller.clientHeight && rd(a, b.scrollbarV.scrollTop)
        }), pg(b.scrollbarH, "scroll", function () {
            b.scroller.clientHeight && sd(a, b.scrollbarH.scrollLeft)
        }), pg(b.scroller, "mousewheel", function (b) {
            vd(a, b)
        }), pg(b.scroller, "DOMMouseScroll", function (b) {
            vd(a, b)
        }), pg(b.scrollbarH, "mousedown", c), pg(b.scrollbarV, "mousedown", c), pg(b.wrapper, "scroll", function () {
            b.wrapper.scrollTop = b.wrapper.scrollLeft = 0
        }), pg(b.input, "keyup", function (b) {
            Ed.call(a, b)
        }), pg(b.input, "input", function () {
            d && e >= 9 && a.display.inputHasSelection && (a.display.inputHasSelection = null), Xc(a)
        }), pg(b.input, "keydown", Kc(a, Cd)), pg(b.input, "keypress", Kc(a, Fd)), pg(b.input, "focus", Pg(Gd, a)), pg(b.input, "blur", Pg(Hd, a)), a.options.dragDrop && (pg(b.scroller, "dragstart", function (b) {
            qd(a, b)
        }), pg(b.scroller, "dragenter", g), pg(b.scroller, "dragover", g), pg(b.scroller, "drop", Kc(a, pd))), pg(b.scroller, "paste", function (c) {
            ed(b, c) || (a.state.pasteIncoming = !0, _c(a), Xc(a))
        }), pg(b.input, "paste", function () {
            if (f && !a.state.fakedLastChar && !(new Date - a.state.lastMiddleDown < 200)) {
                var c = b.input.selectionStart, d = b.input.selectionEnd;
                b.input.value += "$", b.input.selectionEnd = d, b.input.selectionStart = c, a.state.fakedLastChar = !0
            }
            a.state.pasteIncoming = !0, Xc(a)
        }), pg(b.input, "cut", h), pg(b.input, "copy", h), k && pg(b.sizer, "mouseup", function () {
            _g() == b.input && b.input.blur(), _c(a)
        })
    }

    function dd(a) {
        var b = a.display;
        b.cachedCharWidth = b.cachedTextHeight = b.cachedPaddingH = null, a.setSize()
    }

    function ed(a, b) {
        for (var c = ng(b); c != a.wrapper; c = c.parentNode)if (!c || c.ignoreEvents || c.parentNode == a.sizer && c != a.mover)return !0
    }

    function fd(a, b, c, d) {
        var e = a.display;
        if (!c) {
            var f = ng(b);
            if (f == e.scrollbarH || f == e.scrollbarV || f == e.scrollbarFiller || f == e.gutterFiller)return null
        }
        var g, h, i = e.lineSpace.getBoundingClientRect();
        try {
            g = b.clientX - i.left, h = b.clientY - i.top
        } catch (b) {
            return null
        }
        var k, j = tc(a, g, h);
        if (d && 1 == j.xRel && (k = Of(a.doc, j.line).text).length == j.ch) {
            var l = Fg(k, k.length, a.options.tabSize) - k.length;
            j = nb(j.line, Math.max(0, Math.round((g - Zb(a.display).left) / xc(a.display)) - l))
        }
        return j
    }

    function gd(a) {
        if (!vg(this, a)) {
            var b = this, c = b.display;
            if (c.shift = a.shiftKey, ed(c, a))return f || (c.scroller.draggable = !1, setTimeout(function () {
                c.scroller.draggable = !0
            }, 100)), void 0;
            if (!nd(b, a)) {
                var d = fd(b, a);
                switch (window.focus(), og(a)) {
                    case 1:
                        d ? jd(b, a, d) : ng(a) == c.scroller && jg(a);
                        break;
                    case 2:
                        f && (b.state.lastMiddleDown = +new Date), d && Cb(b.doc, d), setTimeout(Pg(_c, b), 20), jg(a);
                        break;
                    case 3:
                        t && Id(b, a)
                }
            }
        }
    }

    function jd(a, b, c) {
        setTimeout(Pg(ad, a), 0);
        var e, d = +new Date;
        id && id.time > d - 400 && 0 == ob(id.pos, c) ? e = "triple" : hd && hd.time > d - 400 && 0 == ob(hd.pos, c) ? (e = "double", id = {
            time: d,
            pos: c
        }) : (e = "single", hd = {time: d, pos: c});
        var f = a.doc.sel, g = p ? b.metaKey : b.ctrlKey;
        a.options.dragDrop && ih && !bd(a) && "single" == e && f.contains(c) > -1 && f.somethingSelected() ? kd(a, b, c, g) : ld(a, b, c, e, g)
    }

    function kd(a, b, c, g) {
        var h = a.display, i = Kc(a, function (j) {
            f && (h.scroller.draggable = !1), a.state.draggingText = !1, qg(document, "mouseup", i), qg(h.scroller, "drop", i), Math.abs(b.clientX - j.clientX) + Math.abs(b.clientY - j.clientY) < 10 && (jg(j), g || Cb(a.doc, c), _c(a), d && 9 == e && setTimeout(function () {
                document.body.focus(), _c(a)
            }, 20))
        });
        f && (h.scroller.draggable = !0), a.state.draggingText = i, h.scroller.dragDrop && h.scroller.dragDrop(), pg(document, "mouseup", i), pg(h.scroller, "drop", i)
    }

    function ld(a, b, c, d, e) {
        function n(b) {
            if (0 != ob(m, b))if (m = b, "rect" == d) {
                for (var e = [], f = a.options.tabSize, k = Fg(Of(g, c.line).text, c.ch, f), l = Fg(Of(g, b.line).text, b.ch, f), n = Math.min(k, l), o = Math.max(k, l), p = Math.min(c.line, b.line), q = Math.min(a.lastLine(), Math.max(c.line, b.line)); q >= p; p++) {
                    var r = Of(g, p).text, s = Gg(r, n, f);
                    n == o ? e.push(new tb(nb(p, s), nb(p, s))) : r.length > s && e.push(new tb(nb(p, s), nb(p, Gg(r, o, f))))
                }
                e.length || e.push(new tb(c, c)), Ib(g, ub(j.ranges.slice(0, i).concat(e), i), {
                    origin: "*mouse",
                    scroll: !1
                }), a.scrollIntoView(b)
            } else {
                var t = h, u = t.anchor, v = b;
                if ("single" != d) {
                    if ("double" == d)var w = he(a, b); else var w = new tb(nb(b.line, 0), xb(g, nb(b.line + 1, 0)));
                    ob(w.anchor, u) > 0 ? (v = w.head, u = rb(t.from(), w.anchor)) : (v = w.anchor, u = qb(t.to(), w.head))
                }
                var e = j.ranges.slice(0);
                e[i] = new tb(xb(g, u), v), Ib(g, ub(e, i), Cg)
            }
        }

        function q(b) {
            var c = ++p, e = fd(a, b, !0, "rect" == d);
            if (e)if (0 != ob(e, m)) {
                ad(a), n(e);
                var h = O(f, g);
                (e.line >= h.to || e.line < h.from) && setTimeout(Kc(a, function () {
                    p == c && q(b)
                }), 150)
            } else {
                var i = b.clientY < o.top ? -20 : b.clientY > o.bottom ? 20 : 0;
                i && setTimeout(Kc(a, function () {
                    p == c && (f.scroller.scrollTop += i, q(b))
                }), 50)
            }
        }

        function r(b) {
            p = 1 / 0, jg(b), _c(a), qg(document, "mousemove", s), qg(document, "mouseup", t), g.history.lastSelOrigin = null
        }

        var f = a.display, g = a.doc;
        jg(b);
        var h, i, j = g.sel;
        if (e && !b.shiftKey ? (i = g.sel.contains(c), h = i > -1 ? g.sel.ranges[i] : new tb(c, c)) : h = g.sel.primary(), b.altKey)d = "rect", e || (h = new tb(c, c)), c = fd(a, b, !0, !0), i = -1; else if ("double" == d) {
            var k = he(a, c);
            h = a.display.shift || g.extend ? Bb(g, h, k.anchor, k.head) : k
        } else if ("triple" == d) {
            var l = new tb(nb(c.line, 0), xb(g, nb(c.line + 1, 0)));
            h = a.display.shift || g.extend ? Bb(g, h, l.anchor, l.head) : l
        } else h = Bb(g, h, c);
        e ? i > -1 ? Eb(g, i, h, Cg) : (i = g.sel.ranges.length, Ib(g, ub(g.sel.ranges.concat([h]), i), {
            scroll: !1,
            origin: "*mouse"
        })) : (i = 0, Ib(g, new sb([h], 0), Cg), j = g.sel);
        var m = c, o = f.wrapper.getBoundingClientRect(), p = 0, s = Kc(a, function (a) {
            og(a) ? q(a) : r(a)
        }), t = Kc(a, r);
        pg(document, "mousemove", s), pg(document, "mouseup", t)
    }

    function md(a, b, c, d, e) {
        try {
            var f = b.clientX, g = b.clientY
        } catch (b) {
            return !1
        }
        if (f >= Math.floor(a.display.gutters.getBoundingClientRect().right))return !1;
        d && jg(b);
        var h = a.display, i = h.lineDiv.getBoundingClientRect();
        if (g > i.bottom || !xg(a, c))return lg(b);
        g -= i.top - h.viewOffset;
        for (var j = 0; j < a.options.gutters.length; ++j) {
            var k = h.gutters.childNodes[j];
            if (k && k.getBoundingClientRect().right >= f) {
                var l = Tf(a.doc, g), m = a.options.gutters[j];
                return e(a, c, a, l, m, b), lg(b)
            }
        }
    }

    function nd(a, b) {
        return md(a, b, "gutterClick", !0, tg)
    }

    function pd(a) {
        var b = this;
        if (!vg(b, a) && !ed(b.display, a)) {
            jg(a), d && (od = +new Date);
            var c = fd(b, a, !0), e = a.dataTransfer.files;
            if (c && !bd(b))if (e && e.length && window.FileReader && window.File)for (var f = e.length, g = Array(f), h = 0, i = function (a, d) {
                var e = new FileReader;
                e.onload = Kc(b, function () {
                    if (g[d] = e.result, ++h == f) {
                        c = xb(b.doc, c);
                        var a = {from: c, to: c, text: ph(g.join("\n")), origin: "paste"};
                        Qd(b.doc, a), Hb(b.doc, vb(c, Kd(a)))
                    }
                }), e.readAsText(a)
            }, j = 0; f > j; ++j)i(e[j], j); else {
                if (b.state.draggingText && b.doc.sel.contains(c) > -1)return b.state.draggingText(a), setTimeout(Pg(_c, b), 20), void 0;
                try {
                    var g = a.dataTransfer.getData("Text");
                    if (g) {
                        if (b.state.draggingText && !(p ? a.metaKey : a.ctrlKey))var k = b.listSelections();
                        if (Jb(b.doc, vb(c, c)), k)for (var j = 0; j < k.length; ++j)Wd(b.doc, "", k[j].anchor, k[j].head, "drag");
                        b.replaceSelection(g, "around", "paste"), _c(b)
                    }
                } catch (a) {
                }
            }
        }
    }

    function qd(a, b) {
        if (d && (!a.state.draggingText || +new Date - od < 100))return mg(b), void 0;
        if (!vg(a, b) && !ed(a.display, b) && (b.dataTransfer.setData("Text", a.getSelection()), b.dataTransfer.setDragImage && !j)) {
            var c = Wg("img", null, null, "position: fixed; left: 0; top: 0;");
            c.src = "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==", i && (c.width = c.height = 1, a.display.wrapper.appendChild(c), c._top = c.offsetTop), b.dataTransfer.setDragImage(c, 0, 0), i && c.parentNode.removeChild(c)
        }
    }

    function rd(b, c) {
        Math.abs(b.doc.scrollTop - c) < 2 || (b.doc.scrollTop = c, a || W(b, {top: c}), b.display.scroller.scrollTop != c && (b.display.scroller.scrollTop = c), b.display.scrollbarV.scrollTop != c && (b.display.scrollbarV.scrollTop = c), a && W(b), Tb(b, 100))
    }

    function sd(a, b, c) {
        (c ? b == a.doc.scrollLeft : Math.abs(a.doc.scrollLeft - b) < 2) || (b = Math.min(b, a.display.scroller.scrollWidth - a.display.scroller.clientWidth), a.doc.scrollLeft = b, P(a), a.display.scroller.scrollLeft != b && (a.display.scroller.scrollLeft = b), a.display.scrollbarH.scrollLeft != b && (a.display.scrollbarH.scrollLeft = b))
    }

    function vd(b, c) {
        var d = c.wheelDeltaX, e = c.wheelDeltaY;
        null == d && c.detail && c.axis == c.HORIZONTAL_AXIS && (d = c.detail), null == e && c.detail && c.axis == c.VERTICAL_AXIS ? e = c.detail : null == e && (e = c.wheelDelta);
        var g = b.display, h = g.scroller;
        if (d && h.scrollWidth > h.clientWidth || e && h.scrollHeight > h.clientHeight) {
            if (e && p && f)a:for (var j = c.target, k = g.view; j != h; j = j.parentNode)for (var l = 0; l < k.length; l++)if (k[l].node == j) {
                b.display.currentWheelTarget = j;
                break a
            }
            if (d && !a && !i && null != ud)return e && rd(b, Math.max(0, Math.min(h.scrollTop + e * ud, h.scrollHeight - h.clientHeight))), sd(b, Math.max(0, Math.min(h.scrollLeft + d * ud, h.scrollWidth - h.clientWidth))), jg(c), g.wheelStartX = null, void 0;
            if (e && null != ud) {
                var m = e * ud, n = b.doc.scrollTop, o = n + g.wrapper.clientHeight;
                0 > m ? n = Math.max(0, n + m - 50) : o = Math.min(b.doc.height, o + m + 50), W(b, {top: n, bottom: o})
            }
            20 > td && (null == g.wheelStartX ? (g.wheelStartX = h.scrollLeft, g.wheelStartY = h.scrollTop, g.wheelDX = d, g.wheelDY = e, setTimeout(function () {
                if (null != g.wheelStartX) {
                    var a = h.scrollLeft - g.wheelStartX, b = h.scrollTop - g.wheelStartY, c = b && g.wheelDY && b / g.wheelDY || a && g.wheelDX && a / g.wheelDX;
                    g.wheelStartX = g.wheelStartY = null, c && (ud = (ud * td + c) / (td + 1), ++td)
                }
            }, 200)) : (g.wheelDX += d, g.wheelDY += e))
        }
    }

    function wd(a, b, c) {
        if ("string" == typeof b && (b = te[b], !b))return !1;
        a.display.pollingFast && Zc(a) && (a.display.pollingFast = !1);
        var d = a.display.shift, e = !1;
        try {
            bd(a) && (a.state.suppressEdits = !0), c && (a.display.shift = !1), e = b(a) != Ag
        } finally {
            a.display.shift = d, a.state.suppressEdits = !1
        }
        return e
    }

    function xd(a) {
        var b = a.state.keyMaps.slice(0);
        return a.options.extraKeys && b.push(a.options.extraKeys), b.push(a.options.keyMap), b
    }

    function zd(a, b) {
        var c = ve(a.options.keyMap), d = c.auto;
        clearTimeout(yd), d && !xe(b) && (yd = setTimeout(function () {
            ve(a.options.keyMap) == c && (a.options.keyMap = d.call ? d.call(null, a) : d, D(a))
        }, 50));
        var e = ye(b, !0), f = !1;
        if (!e)return !1;
        var g = xd(a);
        return f = b.shiftKey ? we("Shift-" + e, g, function (b) {
            return wd(a, b, !0)
        }) || we(e, g, function (b) {
            return ("string" == typeof b ? /^go[A-Z]/.test(b) : b.motion) ? wd(a, b) : void 0
        }) : we(e, g, function (b) {
            return wd(a, b)
        }), f && (jg(b), Sb(a), tg(a, "keyHandled", a, e, b)), f
    }

    function Ad(a, b, c) {
        var d = we("'" + c + "'", xd(a), function (b) {
            return wd(a, b, !0)
        });
        return d && (jg(b), Sb(a), tg(a, "keyHandled", a, "'" + c + "'", b)), d
    }

    function Cd(a) {
        var b = this;
        if (ad(b), !vg(b, a)) {
            d && 11 > e && 27 == a.keyCode && (a.returnValue = !1);
            var c = a.keyCode;
            b.display.shift = 16 == c || a.shiftKey;
            var f = zd(b, a);
            i && (Bd = f ? c : null, !f && 88 == c && !rh && (p ? a.metaKey : a.ctrlKey) && b.replaceSelection("", null, "cut")), 18 != c || /\bCodeMirror-crosshair\b/.test(b.display.lineDiv.className) || Dd(b)
        }
    }

    function Dd(a) {
        function c(a) {
            18 != a.keyCode && a.altKey || (bh(b, "CodeMirror-crosshair"), qg(document, "keyup", c), qg(document, "mouseover", c))
        }

        var b = a.display.lineDiv;
        ch(b, "CodeMirror-crosshair"), pg(document, "keyup", c), pg(document, "mouseover", c)
    }

    function Ed(a) {
        16 == a.keyCode && (this.doc.sel.shift = !1), vg(this, a)
    }

    function Fd(a) {
        var b = this;
        if (!(vg(b, a) || a.ctrlKey && !a.altKey || p && a.metaKey)) {
            var c = a.keyCode, f = a.charCode;
            if (i && c == Bd)return Bd = null, jg(a), void 0;
            if (!(i && (!a.which || a.which < 10) || k) || !zd(b, a)) {
                var g = String.fromCharCode(null == f ? c : f);
                Ad(b, a, g) || (d && e >= 9 && (b.display.inputHasSelection = null), Xc(b))
            }
        }
    }

    function Gd(a) {
        "nocursor" != a.options.readOnly && (a.state.focused || (rg(a, "focus", a), a.state.focused = !0, ch(a.display.wrapper, "CodeMirror-focused"), a.curOp || a.display.selForContextMenu == a.doc.sel || ($c(a), f && setTimeout(Pg($c, a, !0), 0))), Wc(a), Sb(a))
    }

    function Hd(a) {
        a.state.focused && (rg(a, "blur", a), a.state.focused = !1, bh(a.display.wrapper, "CodeMirror-focused")), clearInterval(a.display.blinker), setTimeout(function () {
            a.state.focused || (a.display.shift = !1)
        }, 150)
    }

    function Id(a, b) {
        function m() {
            if (null != c.input.selectionStart) {
                var b = a.somethingSelected(), d = c.input.value = "\u200b" + (b ? c.input.value : "");
                c.prevInput = b ? "" : "\u200b", c.input.selectionStart = 1, c.input.selectionEnd = d.length, c.selForContextMenu = a.doc.sel
            }
        }

        function n() {
            if (c.inputDiv.style.position = "relative", c.input.style.cssText = k, d && 9 > e && (c.scrollbarV.scrollTop = c.scroller.scrollTop = h), Wc(a), null != c.input.selectionStart) {
                (!d || d && 9 > e) && m();
                var b = 0, f = function () {
                    c.selForContextMenu == a.doc.sel && 0 == c.input.selectionStart ? Kc(a, te.selectAll)(a) : b++ < 10 ? c.detectingSelectAll = setTimeout(f, 500) : $c(a)
                };
                c.detectingSelectAll = setTimeout(f, 200)
            }
        }

        if (!vg(a, b, "contextmenu")) {
            var c = a.display;
            if (!ed(c, b) && !Jd(a, b)) {
                var g = fd(a, b), h = c.scroller.scrollTop;
                if (g && !i) {
                    var j = a.options.resetSelectionOnContextMenu;
                    j && -1 == a.doc.sel.contains(g) && Kc(a, Ib)(a.doc, vb(g), Bg);
                    var k = c.input.style.cssText;
                    if (c.inputDiv.style.position = "absolute", c.input.style.cssText = "position: fixed; width: 30px; height: 30px; top: " + (b.clientY - 5) + "px; left: " + (b.clientX - 5) + "px; z-index: 1000; background: " + (d ? "rgba(255, 255, 255, .05)" : "transparent") + "; outline: none; border-width: 0; outline: none; overflow: hidden; opacity: .05; filter: alpha(opacity=5);", f)var l = window.scrollY;
                    if (_c(a), f && window.scrollTo(null, l), $c(a), a.somethingSelected() || (c.input.value = c.prevInput = " "), c.selForContextMenu = a.doc.sel, clearTimeout(c.detectingSelectAll), d && e >= 9 && m(), t) {
                        mg(b);
                        var o = function () {
                            qg(window, "mouseup", o), setTimeout(n, 20)
                        };
                        pg(window, "mouseup", o)
                    } else setTimeout(n, 50)
                }
            }
        }
    }

    function Jd(a, b) {
        return xg(a, "gutterContextMenu") ? md(a, b, "gutterContextMenu", !1, rg) : !1
    }

    function Ld(a, b) {
        if (ob(a, b.from) < 0)return a;
        if (ob(a, b.to) <= 0)return Kd(b);
        var c = a.line + b.text.length - (b.to.line - b.from.line) - 1, d = a.ch;
        return a.line == b.to.line && (d += Kd(b).ch - b.to.ch), nb(c, d)
    }

    function Md(a, b) {
        for (var c = [], d = 0; d < a.sel.ranges.length; d++) {
            var e = a.sel.ranges[d];
            c.push(new tb(Ld(e.anchor, b), Ld(e.head, b)))
        }
        return ub(c, a.sel.primIndex)
    }

    function Nd(a, b, c) {
        return a.line == b.line ? nb(c.line, a.ch - b.ch + c.ch) : nb(c.line + (a.line - b.line), a.ch)
    }

    function Od(a, b, c) {
        for (var d = [], e = nb(a.first, 0), f = e, g = 0; g < b.length; g++) {
            var h = b[g], i = Nd(h.from, e, f), j = Nd(Kd(h), e, f);
            if (e = h.to, f = j, "around" == c) {
                var k = a.sel.ranges[g], l = ob(k.head, k.anchor) < 0;
                d[g] = new tb(l ? j : i, l ? i : j)
            } else d[g] = new tb(i, i)
        }
        return new sb(d, a.sel.primIndex)
    }

    function Pd(a, b, c) {
        var d = {
            canceled: !1, from: b.from, to: b.to, text: b.text, origin: b.origin, cancel: function () {
                this.canceled = !0
            }
        };
        return c && (d.update = function (b, c, d, e) {
            b && (this.from = xb(a, b)), c && (this.to = xb(a, c)), d && (this.text = d), void 0 !== e && (this.origin = e)
        }), rg(a, "beforeChange", a, d), a.cm && rg(a.cm, "beforeChange", a.cm, d), d.canceled ? null : {
            from: d.from,
            to: d.to,
            text: d.text,
            origin: d.origin
        }
    }

    function Qd(a, b, c) {
        if (a.cm) {
            if (!a.cm.curOp)return Kc(a.cm, Qd)(a, b, c);
            if (a.cm.state.suppressEdits)return
        }
        if (!(xg(a, "beforeChange") || a.cm && xg(a.cm, "beforeChange")) || (b = Pd(a, b, !0))) {
            var d = u && !c && Re(a, b.from, b.to);
            if (d)for (var e = d.length - 1; e >= 0; --e)Rd(a, {
                from: d[e].from,
                to: d[e].to,
                text: e ? [""] : b.text
            }); else Rd(a, b)
        }
    }

    function Rd(a, b) {
        if (1 != b.text.length || "" != b.text[0] || 0 != ob(b.from, b.to)) {
            var c = Md(a, b);
            $f(a, b, c, a.cm ? a.cm.curOp.id : 0 / 0), Ud(a, b, c, Oe(a, b));
            var d = [];
            Mf(a, function (a, c) {
                c || -1 != Lg(d, a.history) || (ig(a.history, b), d.push(a.history)), Ud(a, b, null, Oe(a, b))
            })
        }
    }

    function Sd(a, b, c) {
        if (!a.cm || !a.cm.state.suppressEdits) {
            for (var e, d = a.history, f = a.sel, g = "undo" == b ? d.done : d.undone, h = "undo" == b ? d.undone : d.done, i = 0; i < g.length && (e = g[i], c ? !e.ranges || e.equals(a.sel) : e.ranges); i++);
            if (i != g.length) {
                for (d.lastOrigin = d.lastSelOrigin = null; e = g.pop(), e.ranges;) {
                    if (bg(e, h), c && !e.equals(a.sel))return Ib(a, e, {clearRedo: !1}), void 0;
                    f = e
                }
                var j = [];
                bg(f, h), h.push({
                    changes: j,
                    generation: d.generation
                }), d.generation = e.generation || ++d.maxGeneration;
                for (var k = xg(a, "beforeChange") || a.cm && xg(a.cm, "beforeChange"), i = e.changes.length - 1; i >= 0; --i) {
                    var l = e.changes[i];
                    if (l.origin = b, k && !Pd(a, l, !1))return g.length = 0, void 0;
                    j.push(Xf(a, l));
                    var m = i ? Md(a, l) : Jg(g);
                    Ud(a, l, m, Qe(a, l)), !i && a.cm && a.cm.scrollIntoView(l);
                    var n = [];
                    Mf(a, function (a, b) {
                        b || -1 != Lg(n, a.history) || (ig(a.history, l), n.push(a.history)), Ud(a, l, null, Qe(a, l))
                    })
                }
            }
        }
    }

    function Td(a, b) {
        if (0 != b && (a.first += b, a.sel = new sb(Mg(a.sel.ranges, function (a) {
                return new tb(nb(a.anchor.line + b, a.anchor.ch), nb(a.head.line + b, a.head.ch))
            }), a.sel.primIndex), a.cm)) {
            Pc(a.cm, a.first, a.first - b, b);
            for (var c = a.cm.display, d = c.viewFrom; d < c.viewTo; d++)Qc(a.cm, d, "gutter")
        }
    }

    function Ud(a, b, c, d) {
        if (a.cm && !a.cm.curOp)return Kc(a.cm, Ud)(a, b, c, d);
        if (b.to.line < a.first)return Td(a, b.text.length - 1 - (b.to.line - b.from.line)), void 0;
        if (!(b.from.line > a.lastLine())) {
            if (b.from.line < a.first) {
                var e = b.text.length - 1 - (a.first - b.from.line);
                Td(a, e), b = {
                    from: nb(a.first, 0),
                    to: nb(b.to.line + e, b.to.ch),
                    text: [Jg(b.text)],
                    origin: b.origin
                }
            }
            var f = a.lastLine();
            b.to.line > f && (b = {
                from: b.from,
                to: nb(f, Of(a, f).text.length),
                text: [b.text[0]],
                origin: b.origin
            }), b.removed = Pf(a, b.from, b.to), c || (c = Md(a, b)), a.cm ? Vd(a.cm, b, d) : Ff(a, b, d), Jb(a, c, Bg)
        }
    }

    function Vd(a, b, c) {
        var d = a.doc, e = a.display, f = b.from, g = b.to, h = !1, i = f.line;
        a.options.lineWrapping || (i = Sf(_e(Of(d, f.line))), d.iter(i, g.line + 1, function (a) {
            return a == e.maxLine ? (h = !0, !0) : void 0
        })), d.sel.contains(b.from, b.to) > -1 && wg(a), Ff(d, b, c, B(a)), a.options.lineWrapping || (d.iter(i, f.line + b.text.length, function (a) {
            var b = I(a);
            b > e.maxLineLength && (e.maxLine = a, e.maxLineLength = b, e.maxLineChanged = !0, h = !1)
        }), h && (a.curOp.updateMaxLine = !0)), d.frontier = Math.min(d.frontier, f.line), Tb(a, 400);
        var j = b.text.length - (g.line - f.line) - 1;
        f.line != g.line || 1 != b.text.length || Ef(a.doc, b) ? Pc(a, f.line, g.line + 1, j) : Qc(a, f.line, "text");
        var k = xg(a, "changes"), l = xg(a, "change");
        if (l || k) {
            var m = {from: f, to: g, text: b.text, removed: b.removed, origin: b.origin};
            l && tg(a, "change", a, m), k && (a.curOp.changeObjs || (a.curOp.changeObjs = [])).push(m)
        }
        a.display.selForContextMenu = null
    }

    function Wd(a, b, c, d, e) {
        if (d || (d = c), ob(d, c) < 0) {
            var f = d;
            d = c, c = f
        }
        "string" == typeof b && (b = ph(b)), Qd(a, {from: c, to: d, text: b, origin: e})
    }

    function Xd(a, b) {
        var c = a.display, d = c.sizer.getBoundingClientRect(), e = null;
        if (b.top + d.top < 0 ? e = !0 : b.bottom + d.top > (window.innerHeight || document.documentElement.clientHeight) && (e = !1), null != e && !m) {
            var f = Wg("div", "\u200b", null, "position: absolute; top: " + (b.top - c.viewOffset - Xb(a.display)) + "px; height: " + (b.bottom - b.top + zg) + "px; left: " + b.left + "px; width: 2px;");
            a.display.lineSpace.appendChild(f), f.scrollIntoView(e), a.display.lineSpace.removeChild(f)
        }
    }

    function Yd(a, b, c, d) {
        for (null == d && (d = 0); ;) {
            var e = !1, f = qc(a, b), g = c && c != b ? qc(a, c) : f, h = $d(a, Math.min(f.left, g.left), Math.min(f.top, g.top) - d, Math.max(f.left, g.left), Math.max(f.bottom, g.bottom) + d), i = a.doc.scrollTop, j = a.doc.scrollLeft;
            if (null != h.scrollTop && (rd(a, h.scrollTop), Math.abs(a.doc.scrollTop - i) > 1 && (e = !0)), null != h.scrollLeft && (sd(a, h.scrollLeft), Math.abs(a.doc.scrollLeft - j) > 1 && (e = !0)), !e)return f
        }
    }

    function Zd(a, b, c, d, e) {
        var f = $d(a, b, c, d, e);
        null != f.scrollTop && rd(a, f.scrollTop), null != f.scrollLeft && sd(a, f.scrollLeft)
    }

    function $d(a, b, c, d, e) {
        var f = a.display, g = wc(a.display);
        0 > c && (c = 0);
        var h = a.curOp && null != a.curOp.scrollTop ? a.curOp.scrollTop : f.scroller.scrollTop, i = f.scroller.clientHeight - zg, j = {}, k = a.doc.height + Yb(f), l = g > c, m = e > k - g;
        if (h > c)j.scrollTop = l ? 0 : c; else if (e > h + i) {
            var n = Math.min(c, (m ? k : e) - i);
            n != h && (j.scrollTop = n)
        }
        var o = a.curOp && null != a.curOp.scrollLeft ? a.curOp.scrollLeft : f.scroller.scrollLeft, p = f.scroller.clientWidth - zg;
        b += f.gutters.offsetWidth, d += f.gutters.offsetWidth;
        var q = f.gutters.offsetWidth, r = q + 10 > b;
        return o + q > b || r ? (r && (b = 0), j.scrollLeft = Math.max(0, b - 10 - q)) : d > p + o - 3 && (j.scrollLeft = d + 10 - p), j
    }

    function _d(a, b, c) {
        (null != b || null != c) && be(a), null != b && (a.curOp.scrollLeft = (null == a.curOp.scrollLeft ? a.doc.scrollLeft : a.curOp.scrollLeft) + b), null != c && (a.curOp.scrollTop = (null == a.curOp.scrollTop ? a.doc.scrollTop : a.curOp.scrollTop) + c)
    }

    function ae(a) {
        be(a);
        var b = a.getCursor(), c = b, d = b;
        a.options.lineWrapping || (c = b.ch ? nb(b.line, b.ch - 1) : b, d = nb(b.line, b.ch + 1)), a.curOp.scrollToPos = {
            from: c,
            to: d,
            margin: a.options.cursorScrollMargin,
            isCursor: !0
        }
    }

    function be(a) {
        var b = a.curOp.scrollToPos;
        if (b) {
            a.curOp.scrollToPos = null;
            var c = rc(a, b.from), d = rc(a, b.to), e = $d(a, Math.min(c.left, d.left), Math.min(c.top, d.top) - b.margin, Math.max(c.right, d.right), Math.max(c.bottom, d.bottom) + b.margin);
            a.scrollTo(e.scrollLeft, e.scrollTop)
        }
    }

    function ce(a, b, c, d) {
        var f, e = a.doc;
        null == c && (c = "add"), "smart" == c && (e.mode.indent ? f = Wb(a, b) : c = "prev");
        var g = a.options.tabSize, h = Of(e, b), i = Fg(h.text, null, g);
        h.stateAfter && (h.stateAfter = null);
        var k, j = h.text.match(/^\s*/)[0];
        if (d || /\S/.test(h.text)) {
            if ("smart" == c && (k = e.mode.indent(f, h.text.slice(j.length), h.text), k == Ag || k > 150)) {
                if (!d)return;
                c = "prev"
            }
        } else k = 0, c = "not";
        "prev" == c ? k = b > e.first ? Fg(Of(e, b - 1).text, null, g) : 0 : "add" == c ? k = i + a.options.indentUnit : "subtract" == c ? k = i - a.options.indentUnit : "number" == typeof c && (k = i + c), k = Math.max(0, k);
        var l = "", m = 0;
        if (a.options.indentWithTabs)for (var n = Math.floor(k / g); n; --n)m += g, l += "	";
        if (k > m && (l += Ig(k - m)), l != j)Wd(e, l, nb(b, 0), nb(b, j.length), "+input"); else for (var n = 0; n < e.sel.ranges.length; n++) {
            var o = e.sel.ranges[n];
            if (o.head.line == b && o.head.ch < j.length) {
                var m = nb(b, j.length);
                Eb(e, n, new tb(m, m));
                break
            }
        }
        h.stateAfter = null
    }

    function de(a, b, c, d) {
        var e = b, f = b;
        return "number" == typeof b ? f = Of(a, wb(a, b)) : e = Sf(b), null == e ? null : (d(f, e) && a.cm && Qc(a.cm, e, c), f)
    }

    function ee(a, b) {
        for (var c = a.doc.sel.ranges, d = [], e = 0; e < c.length; e++) {
            for (var f = b(c[e]); d.length && ob(f.from, Jg(d).to) <= 0;) {
                var g = d.pop();
                if (ob(g.from, f.from) < 0) {
                    f.from = g.from;
                    break
                }
            }
            d.push(f)
        }
        Jc(a, function () {
            for (var b = d.length - 1; b >= 0; b--)Wd(a.doc, "", d[b].from, d[b].to, "+delete");
            ae(a)
        })
    }

    function fe(a, b, c, d, e) {
        function k() {
            var b = f + c;
            return b < a.first || b >= a.first + a.size ? j = !1 : (f = b, i = Of(a, b))
        }

        function l(a) {
            var b = (e ? Gh : Hh)(i, g, c, !0);
            if (null == b) {
                if (a || !k())return j = !1;
                g = e ? (0 > c ? zh : yh)(i) : 0 > c ? i.text.length : 0
            } else g = b;
            return !0
        }

        var f = b.line, g = b.ch, h = c, i = Of(a, f), j = !0;
        if ("char" == d)l(); else if ("column" == d)l(!0); else if ("word" == d || "group" == d)for (var m = null, n = "group" == d, o = a.cm && a.cm.getHelper(b, "wordChars"), p = !0; !(0 > c) || l(!p); p = !1) {
            var q = i.text.charAt(g) || "\n", r = Sg(q, o) ? "w" : n && "\n" == q ? "n" : !n || /\s/.test(q) ? null : "p";
            if (!n || p || r || (r = "s"), m && m != r) {
                0 > c && (c = 1, l());
                break
            }
            if (r && (m = r), c > 0 && !l(!p))break
        }
        var s = Nb(a, nb(f, g), h, !0);
        return j || (s.hitSide = !0), s
    }

    function ge(a, b, c, d) {
        var g, e = a.doc, f = b.left;
        if ("page" == d) {
            var h = Math.min(a.display.wrapper.clientHeight, window.innerHeight || document.documentElement.clientHeight);
            g = b.top + c * (h - (0 > c ? 1.5 : .5) * wc(a.display))
        } else"line" == d && (g = c > 0 ? b.bottom + 3 : b.top - 3);
        for (; ;) {
            var i = tc(a, f, g);
            if (!i.outside)break;
            if (0 > c ? 0 >= g : g >= e.height) {
                i.hitSide = !0;
                break
            }
            g += 5 * c
        }
        return i
    }

    function he(a, b) {
        var c = a.doc, d = Of(c, b.line).text, e = b.ch, f = b.ch;
        if (d) {
            var g = a.getHelper(b, "wordChars");
            (b.xRel < 0 || f == d.length) && e ? --e : ++f;
            for (var h = d.charAt(e), i = Sg(h, g) ? function (a) {
                return Sg(a, g)
            } : /\s/.test(h) ? function (a) {
                return /\s/.test(a)
            } : function (a) {
                return !/\s/.test(a) && !Sg(a)
            }; e > 0 && i(d.charAt(e - 1));)--e;
            for (; f < d.length && i(d.charAt(f));)++f
        }
        return new tb(nb(b.line, e), nb(b.line, f))
    }

    function ke(a, b, c, d) {
        w.defaults[a] = b, c && (je[a] = d ? function (a, b, d) {
            d != le && c(a, b, d)
        } : c)
    }

    function ve(a) {
        return "string" == typeof a ? ue[a] : a
    }

    function Ce(a, b, c, d, e) {
        if (d && d.shared)return Ee(a, b, c, d, e);
        if (a.cm && !a.cm.curOp)return Kc(a.cm, Ce)(a, b, c, d, e);
        var f = new Ae(a, e), g = ob(b, c);
        if (d && Og(d, f, !1), g > 0 || 0 == g && f.clearWhenEmpty !== !1)return f;
        if (f.replacedWith && (f.collapsed = !0, f.widgetNode = Wg("span", [f.replacedWith], "CodeMirror-widget"), d.handleMouseEvents || (f.widgetNode.ignoreEvents = !0), d.insertLeft && (f.widgetNode.insertLeft = !0)), f.collapsed) {
            if ($e(a, b.line, b, c, f) || b.line != c.line && $e(a, c.line, b, c, f))throw new Error("Inserting collapsed marker partially overlapping an existing one");
            v = !0
        }
        f.addToHistory && $f(a, {from: b, to: c, origin: "markText"}, a.sel, 0 / 0);
        var j, h = b.line, i = a.cm;
        if (a.iter(h, c.line + 1, function (a) {
                i && f.collapsed && !i.options.lineWrapping && _e(a) == i.display.maxLine && (j = !0), f.collapsed && h != b.line && Rf(a, 0), Le(a, new Ie(f, h == b.line ? b.ch : null, h == c.line ? c.ch : null)), ++h
            }), f.collapsed && a.iter(b.line, c.line + 1, function (b) {
                df(a, b) && Rf(b, 0)
            }), f.clearOnEnter && pg(f, "beforeCursorEnter", function () {
                f.clear()
            }), f.readOnly && (u = !0, (a.history.done.length || a.history.undone.length) && a.clearHistory()), f.collapsed && (f.id = ++Be, f.atomic = !0), i) {
            if (j && (i.curOp.updateMaxLine = !0), f.collapsed)Pc(i, b.line, c.line + 1);
            else if (f.className || f.title || f.startStyle || f.endStyle)for (var k = b.line; k <= c.line; k++)Qc(i, k, "text");
            f.atomic && Lb(i.doc), tg(i, "markerAdded", i, f)
        }
        return f
    }

    function Ee(a, b, c, d, e) {
        d = Og(d), d.shared = !1;
        var f = [Ce(a, b, c, d, e)], g = f[0], h = d.widgetNode;
        return Mf(a, function (a) {
            h && (d.widgetNode = h.cloneNode(!0)), f.push(Ce(a, xb(a, b), xb(a, c), d, e));
            for (var i = 0; i < a.linked.length; ++i)if (a.linked[i].isParent)return;
            g = Jg(f)
        }), new De(f, g)
    }

    function Fe(a) {
        return a.findMarks(nb(a.first, 0), a.clipPos(nb(a.lastLine())), function (a) {
            return a.parent
        })
    }

    function Ge(a, b) {
        for (var c = 0; c < b.length; c++) {
            var d = b[c], e = d.find(), f = a.clipPos(e.from), g = a.clipPos(e.to);
            if (ob(f, g)) {
                var h = Ce(a, f, g, d.primary, d.primary.type);
                d.markers.push(h), h.parent = d
            }
        }
    }

    function He(a) {
        for (var b = 0; b < a.length; b++) {
            var c = a[b], d = [c.primary.doc];
            Mf(c.primary.doc, function (a) {
                d.push(a)
            });
            for (var e = 0; e < c.markers.length; e++) {
                var f = c.markers[e];
                -1 == Lg(d, f.doc) && (f.parent = null, c.markers.splice(e--, 1))
            }
        }
    }

    function Ie(a, b, c) {
        this.marker = a, this.from = b, this.to = c
    }

    function Je(a, b) {
        if (a)for (var c = 0; c < a.length; ++c) {
            var d = a[c];
            if (d.marker == b)return d
        }
    }

    function Ke(a, b) {
        for (var c, d = 0; d < a.length; ++d)a[d] != b && (c || (c = [])).push(a[d]);
        return c
    }

    function Le(a, b) {
        a.markedSpans = a.markedSpans ? a.markedSpans.concat([b]) : [b], b.marker.attachLine(a)
    }

    function Me(a, b, c) {
        if (a)for (var e, d = 0; d < a.length; ++d) {
            var f = a[d], g = f.marker, h = null == f.from || (g.inclusiveLeft ? f.from <= b : f.from < b);
            if (h || f.from == b && "bookmark" == g.type && (!c || !f.marker.insertLeft)) {
                var i = null == f.to || (g.inclusiveRight ? f.to >= b : f.to > b);
                (e || (e = [])).push(new Ie(g, f.from, i ? null : f.to))
            }
        }
        return e
    }

    function Ne(a, b, c) {
        if (a)for (var e, d = 0; d < a.length; ++d) {
            var f = a[d], g = f.marker, h = null == f.to || (g.inclusiveRight ? f.to >= b : f.to > b);
            if (h || f.from == b && "bookmark" == g.type && (!c || f.marker.insertLeft)) {
                var i = null == f.from || (g.inclusiveLeft ? f.from <= b : f.from < b);
                (e || (e = [])).push(new Ie(g, i ? null : f.from - b, null == f.to ? null : f.to - b))
            }
        }
        return e
    }

    function Oe(a, b) {
        var c = zb(a, b.from.line) && Of(a, b.from.line).markedSpans, d = zb(a, b.to.line) && Of(a, b.to.line).markedSpans;
        if (!c && !d)return null;
        var e = b.from.ch, f = b.to.ch, g = 0 == ob(b.from, b.to), h = Me(c, e, g), i = Ne(d, f, g), j = 1 == b.text.length, k = Jg(b.text).length + (j ? e : 0);
        if (h)for (var l = 0; l < h.length; ++l) {
            var m = h[l];
            if (null == m.to) {
                var n = Je(i, m.marker);
                n ? j && (m.to = null == n.to ? null : n.to + k) : m.to = e
            }
        }
        if (i)for (var l = 0; l < i.length; ++l) {
            var m = i[l];
            if (null != m.to && (m.to += k), null == m.from) {
                var n = Je(h, m.marker);
                n || (m.from = k, j && (h || (h = [])).push(m))
            } else m.from += k, j && (h || (h = [])).push(m)
        }
        h && (h = Pe(h)), i && i != h && (i = Pe(i));
        var o = [h];
        if (!j) {
            var q, p = b.text.length - 2;
            if (p > 0 && h)for (var l = 0; l < h.length; ++l)null == h[l].to && (q || (q = [])).push(new Ie(h[l].marker, null, null));
            for (var l = 0; p > l; ++l)o.push(q);
            o.push(i)
        }
        return o
    }

    function Pe(a) {
        for (var b = 0; b < a.length; ++b) {
            var c = a[b];
            null != c.from && c.from == c.to && c.marker.clearWhenEmpty !== !1 && a.splice(b--, 1)
        }
        return a.length ? a : null
    }

    function Qe(a, b) {
        var c = eg(a, b), d = Oe(a, b);
        if (!c)return d;
        if (!d)return c;
        for (var e = 0; e < c.length; ++e) {
            var f = c[e], g = d[e];
            if (f && g)a:for (var h = 0; h < g.length; ++h) {
                for (var i = g[h], j = 0; j < f.length; ++j)if (f[j].marker == i.marker)continue a;
                f.push(i)
            } else g && (c[e] = g)
        }
        return c
    }

    function Re(a, b, c) {
        var d = null;
        if (a.iter(b.line, c.line + 1, function (a) {
                if (a.markedSpans)for (var b = 0; b < a.markedSpans.length; ++b) {
                    var c = a.markedSpans[b].marker;
                    !c.readOnly || d && -1 != Lg(d, c) || (d || (d = [])).push(c)
                }
            }), !d)return null;
        for (var e = [{
            from: b,
            to: c
        }], f = 0; f < d.length; ++f)for (var g = d[f], h = g.find(0), i = 0; i < e.length; ++i) {
            var j = e[i];
            if (!(ob(j.to, h.from) < 0 || ob(j.from, h.to) > 0)) {
                var k = [i, 1], l = ob(j.from, h.from), m = ob(j.to, h.to);
                (0 > l || !g.inclusiveLeft && !l) && k.push({
                    from: j.from,
                    to: h.from
                }), (m > 0 || !g.inclusiveRight && !m) && k.push({
                    from: h.to,
                    to: j.to
                }), e.splice.apply(e, k), i += k.length - 1
            }
        }
        return e
    }

    function Se(a) {
        var b = a.markedSpans;
        if (b) {
            for (var c = 0; c < b.length; ++c)b[c].marker.detachLine(a);
            a.markedSpans = null
        }
    }

    function Te(a, b) {
        if (b) {
            for (var c = 0; c < b.length; ++c)b[c].marker.attachLine(a);
            a.markedSpans = b
        }
    }

    function Ue(a) {
        return a.inclusiveLeft ? -1 : 0
    }

    function Ve(a) {
        return a.inclusiveRight ? 1 : 0
    }

    function We(a, b) {
        var c = a.lines.length - b.lines.length;
        if (0 != c)return c;
        var d = a.find(), e = b.find(), f = ob(d.from, e.from) || Ue(a) - Ue(b);
        if (f)return -f;
        var g = ob(d.to, e.to) || Ve(a) - Ve(b);
        return g ? g : b.id - a.id
    }

    function Xe(a, b) {
        var d, c = v && a.markedSpans;
        if (c)for (var e, f = 0; f < c.length; ++f)e = c[f], e.marker.collapsed && null == (b ? e.from : e.to) && (!d || We(d, e.marker) < 0) && (d = e.marker);
        return d
    }

    function Ye(a) {
        return Xe(a, !0)
    }

    function Ze(a) {
        return Xe(a, !1)
    }

    function $e(a, b, c, d, e) {
        var f = Of(a, b), g = v && f.markedSpans;
        if (g)for (var h = 0; h < g.length; ++h) {
            var i = g[h];
            if (i.marker.collapsed) {
                var j = i.marker.find(0), k = ob(j.from, c) || Ue(i.marker) - Ue(e), l = ob(j.to, d) || Ve(i.marker) - Ve(e);
                if (!(k >= 0 && 0 >= l || 0 >= k && l >= 0) && (0 >= k && (ob(j.to, c) > 0 || i.marker.inclusiveRight && e.inclusiveLeft) || k >= 0 && (ob(j.from, d) < 0 || i.marker.inclusiveLeft && e.inclusiveRight)))return !0
            }
        }
    }

    function _e(a) {
        for (var b; b = Ye(a);)a = b.find(-1, !0).line;
        return a
    }

    function af(a) {
        for (var b, c; b = Ze(a);)a = b.find(1, !0).line, (c || (c = [])).push(a);
        return c
    }

    function bf(a, b) {
        var c = Of(a, b), d = _e(c);
        return c == d ? b : Sf(d)
    }

    function cf(a, b) {
        if (b > a.lastLine())return b;
        var d, c = Of(a, b);
        if (!df(a, c))return b;
        for (; d = Ze(c);)c = d.find(1, !0).line;
        return Sf(c) + 1
    }

    function df(a, b) {
        var c = v && b.markedSpans;
        if (c)for (var d, e = 0; e < c.length; ++e)if (d = c[e], d.marker.collapsed) {
            if (null == d.from)return !0;
            if (!d.marker.widgetNode && 0 == d.from && d.marker.inclusiveLeft && ef(a, b, d))return !0
        }
    }

    function ef(a, b, c) {
        if (null == c.to) {
            var d = c.marker.find(1, !0);
            return ef(a, d.line, Je(d.line.markedSpans, c.marker))
        }
        if (c.marker.inclusiveRight && c.to == b.text.length)return !0;
        for (var e, f = 0; f < b.markedSpans.length; ++f)if (e = b.markedSpans[f], e.marker.collapsed && !e.marker.widgetNode && e.from == c.to && (null == e.to || e.to != c.from) && (e.marker.inclusiveLeft || c.marker.inclusiveRight) && ef(a, b, e))return !0
    }

    function gf(a, b, c) {
        Uf(b) < (a.curOp && a.curOp.scrollTop || a.doc.scrollTop) && _d(a, null, c)
    }

    function hf(a) {
        if (null != a.height)return a.height;
        if (!$g(document.body, a.node)) {
            var b = "position: relative;";
            a.coverGutter && (b += "margin-left: -" + a.cm.getGutterElement().offsetWidth + "px;"), Zg(a.cm.display.measure, Wg("div", [a.node], null, b))
        }
        return a.height = a.node.offsetHeight
    }

    function jf(a, b, c, d) {
        var e = new ff(a, c, d);
        return e.noHScroll && (a.display.alignWidgets = !0), de(a.doc, b, "widget", function (b) {
            var c = b.widgets || (b.widgets = []);
            if (null == e.insertAt ? c.push(e) : c.splice(Math.min(c.length - 1, Math.max(0, e.insertAt)), 0, e), e.line = b, !df(a.doc, b)) {
                var d = Uf(b) < a.doc.scrollTop;
                Rf(b, b.height + hf(e)), d && _d(a, null, e.height), a.curOp.forceUpdate = !0
            }
            return !0
        }), e
    }

    function lf(a, b, c, d) {
        a.text = b, a.stateAfter && (a.stateAfter = null), a.styles && (a.styles = null), null != a.order && (a.order = null), Se(a), Te(a, c);
        var e = d ? d(a) : 1;
        e != a.height && Rf(a, e)
    }

    function mf(a) {
        a.parent = null, Se(a)
    }

    function nf(a, b) {
        if (a)for (; ;) {
            var c = a.match(/(?:^|\s+)line-(background-)?(\S+)/);
            if (!c)break;
            a = a.slice(0, c.index) + a.slice(c.index + c[0].length);
            var d = c[1] ? "bgClass" : "textClass";
            null == b[d] ? b[d] = c[2] : new RegExp("(?:^|s)" + c[2] + "(?:$|s)").test(b[d]) || (b[d] += " " + c[2])
        }
        return a
    }

    function of(a, b) {
        if (a.blankLine)return a.blankLine(b);
        if (a.innerMode) {
            var c = w.innerMode(a, b);
            return c.mode.blankLine ? c.mode.blankLine(c.state) : void 0
        }
    }

    function pf(a, b, c) {
        for (var d = 0; 10 > d; d++) {
            var e = a.token(b, c);
            if (b.pos > b.start)return e
        }
        throw new Error("Mode " + a.name + " failed to advance stream.")
    }

    function qf(a, b, c, d, e, f, g) {
        var h = c.flattenSpans;
        null == h && (h = a.options.flattenSpans);
        var l, i = 0, j = null, k = new ze(b, a.options.tabSize);
        for ("" == b && nf(of(c, d), f); !k.eol();) {
            if (k.pos > a.options.maxHighlightLength ? (h = !1, g && tf(a, b, d, k.pos), k.pos = b.length, l = null) : l = nf(pf(c, k, d), f), a.options.addModeClass) {
                var m = w.innerMode(c, d).mode.name;
                m && (l = "m-" + (l ? m + " " + l : m))
            }
            h && j == l || (i < k.start && e(k.start, j), i = k.start, j = l), k.start = k.pos
        }
        for (; i < k.pos;) {
            var n = Math.min(k.pos, i + 5e4);
            e(n, j), i = n
        }
    }

    function rf(a, b, c, d) {
        var e = [a.state.modeGen], f = {};
        qf(a, b.text, a.doc.mode, c, function (a, b) {
            e.push(a, b)
        }, f, d);
        for (var g = 0; g < a.state.overlays.length; ++g) {
            var h = a.state.overlays[g], i = 1, j = 0;
            qf(a, b.text, h.mode, !0, function (a, b) {
                for (var c = i; a > j;) {
                    var d = e[i];
                    d > a && e.splice(i, 1, a, e[i + 1], d), i += 2, j = Math.min(a, d)
                }
                if (b)if (h.opaque)e.splice(c, i - c, a, "cm-overlay " + b), i = c + 2; else for (; i > c; c += 2) {
                    var f = e[c + 1];
                    e[c + 1] = (f ? f + " " : "") + "cm-overlay " + b
                }
            }, f)
        }
        return {styles: e, classes: f.bgClass || f.textClass ? f : null}
    }

    function sf(a, b) {
        if (!b.styles || b.styles[0] != a.state.modeGen) {
            var c = rf(a, b, b.stateAfter = Wb(a, Sf(b)));
            b.styles = c.styles, c.classes ? b.styleClasses = c.classes : b.styleClasses && (b.styleClasses = null)
        }
        return b.styles
    }

    function tf(a, b, c, d) {
        var e = a.doc.mode, f = new ze(b, a.options.tabSize);
        for (f.start = f.pos = d || 0, "" == b && of(e, c); !f.eol() && f.pos <= a.options.maxHighlightLength;)pf(e, f, c), f.start = f.pos
    }

    function wf(a, b) {
        if (!a || /^\s*$/.test(a))return null;
        var c = b.addModeClass ? vf : uf;
        return c[a] || (c[a] = a.replace(/\S+/g, "cm-$&"))
    }

    function xf(a, b) {
        var c = Wg("span", null, null, f ? "padding-right: .1px" : null), e = {
            pre: Wg("pre", [c]),
            content: c,
            col: 0,
            pos: 0,
            cm: a
        };
        b.measure = {};
        for (var g = 0; g <= (b.rest ? b.rest.length : 0); g++) {
            var i, h = g ? b.rest[g - 1] : b.line;
            e.pos = 0, e.addToken = zf, (d || f) && a.getOption("lineWrapping") && (e.addToken = Af(e.addToken)), oh(a.display.measure) && (i = Vf(h)) && (e.addToken = Bf(e.addToken, i)), e.map = [], Df(h, e, sf(a, h)), h.styleClasses && (h.styleClasses.bgClass && (e.bgClass = dh(h.styleClasses.bgClass, e.bgClass || "")), h.styleClasses.textClass && (e.textClass = dh(h.styleClasses.textClass, e.textClass || ""))), 0 == e.map.length && e.map.push(0, 0, e.content.appendChild(mh(a.display.measure))), 0 == g ? (b.measure.map = e.map, b.measure.cache = {}) : ((b.measure.maps || (b.measure.maps = [])).push(e.map), (b.measure.caches || (b.measure.caches = [])).push({}))
        }
        return rg(a, "renderLine", a, b.line, e.pre), e.pre.className && (e.textClass = dh(e.pre.className, e.textClass || "")), e
    }

    function yf(a) {
        var b = Wg("span", "\u2022", "cm-invalidchar");
        return b.title = "\\u" + a.charCodeAt(0).toString(16), b
    }

    function zf(a, b, c, f, g, h) {
        if (b) {
            var i = a.cm.options.specialChars, j = !1;
            if (i.test(b))for (var k = document.createDocumentFragment(), l = 0; ;) {
                i.lastIndex = l;
                var m = i.exec(b), n = m ? m.index - l : b.length - l;
                if (n) {
                    var o = document.createTextNode(b.slice(l, l + n));
                    d && 9 > e ? k.appendChild(Wg("span", [o])) : k.appendChild(o), a.map.push(a.pos, a.pos + n, o), a.col += n, a.pos += n
                }
                if (!m)break;
                if (l += n + 1, "	" == m[0]) {
                    var p = a.cm.options.tabSize, q = p - a.col % p, o = k.appendChild(Wg("span", Ig(q), "cm-tab"));
                    a.col += q
                } else {
                    var o = a.cm.options.specialCharPlaceholder(m[0]);
                    d && 9 > e ? k.appendChild(Wg("span", [o])) : k.appendChild(o), a.col += 1
                }
                a.map.push(a.pos, a.pos + 1, o), a.pos++
            } else {
                a.col += b.length;
                var k = document.createTextNode(b);
                a.map.push(a.pos, a.pos + b.length, k), d && 9 > e && (j = !0), a.pos += b.length
            }
            if (c || f || g || j) {
                var r = c || "";
                f && (r += f), g && (r += g);
                var s = Wg("span", [k], r);
                return h && (s.title = h), a.content.appendChild(s)
            }
            a.content.appendChild(k)
        }
    }

    function Af(a) {
        function b(a) {
            for (var b = " ", c = 0; c < a.length - 2; ++c)b += c % 2 ? " " : "\xa0";
            return b += " "
        }

        return function (c, d, e, f, g, h) {
            a(c, d.replace(/ {3,}/g, b), e, f, g, h)
        }
    }

    function Bf(a, b) {
        return function (c, d, e, f, g, h) {
            e = e ? e + " cm-force-border" : "cm-force-border";
            for (var i = c.pos, j = i + d.length; ;) {
                for (var k = 0; k < b.length; k++) {
                    var l = b[k];
                    if (l.to > i && l.from <= i)break
                }
                if (l.to >= j)return a(c, d, e, f, g, h);
                a(c, d.slice(0, l.to - i), e, f, null, h), f = null, d = d.slice(l.to - i), i = l.to
            }
        }
    }

    function Cf(a, b, c, d) {
        var e = !d && c.widgetNode;
        e && (a.map.push(a.pos, a.pos + b, e), a.content.appendChild(e)), a.pos += b
    }

    function Df(a, b, c) {
        var d = a.markedSpans, e = a.text, f = 0;
        if (d)for (var k, m, n, o, p, q, h = e.length, i = 0, g = 1, j = "", l = 0; ;) {
            if (l == i) {
                m = n = o = p = "", q = null, l = 1 / 0;
                for (var r = [], s = 0; s < d.length; ++s) {
                    var t = d[s], u = t.marker;
                    t.from <= i && (null == t.to || t.to > i) ? (null != t.to && l > t.to && (l = t.to, n = ""), u.className && (m += " " + u.className), u.startStyle && t.from == i && (o += " " + u.startStyle), u.endStyle && t.to == l && (n += " " + u.endStyle), u.title && !p && (p = u.title), u.collapsed && (!q || We(q.marker, u) < 0) && (q = t)) : t.from > i && l > t.from && (l = t.from), "bookmark" == u.type && t.from == i && u.widgetNode && r.push(u)
                }
                if (q && (q.from || 0) == i && (Cf(b, (null == q.to ? h + 1 : q.to) - i, q.marker, null == q.from), null == q.to))return;
                if (!q && r.length)for (var s = 0; s < r.length; ++s)Cf(b, 0, r[s])
            }
            if (i >= h)break;
            for (var v = Math.min(h, l); ;) {
                if (j) {
                    var w = i + j.length;
                    if (!q) {
                        var x = w > v ? j.slice(0, v - i) : j;
                        b.addToken(b, x, k ? k + m : m, o, i + x.length == l ? n : "", p)
                    }
                    if (w >= v) {
                        j = j.slice(v - i), i = v;
                        break
                    }
                    i = w, o = ""
                }
                j = e.slice(f, f = c[g++]), k = wf(c[g++], b.cm.options)
            }
        } else for (var g = 1; g < c.length; g += 2)b.addToken(b, e.slice(f, f = c[g]), wf(c[g + 1], b.cm.options))
    }

    function Ef(a, b) {
        return 0 == b.from.ch && 0 == b.to.ch && "" == Jg(b.text) && (!a.cm || a.cm.options.wholeLineUpdateBefore)
    }

    function Ff(a, b, c, d) {
        function e(a) {
            return c ? c[a] : null
        }

        function f(a, c, e) {
            lf(a, c, e, d), tg(a, "change", a, b)
        }

        var g = b.from, h = b.to, i = b.text, j = Of(a, g.line), k = Of(a, h.line), l = Jg(i), m = e(i.length - 1), n = h.line - g.line;
        if (Ef(a, b)) {
            for (var o = 0, p = []; o < i.length - 1; ++o)p.push(new kf(i[o], e(o), d));
            f(k, k.text, m), n && a.remove(g.line, n), p.length && a.insert(g.line, p)
        } else if (j == k)if (1 == i.length)f(j, j.text.slice(0, g.ch) + l + j.text.slice(h.ch), m); else {
            for (var p = [], o = 1; o < i.length - 1; ++o)p.push(new kf(i[o], e(o), d));
            p.push(new kf(l + j.text.slice(h.ch), m, d)), f(j, j.text.slice(0, g.ch) + i[0], e(0)), a.insert(g.line + 1, p)
        } else if (1 == i.length)f(j, j.text.slice(0, g.ch) + i[0] + k.text.slice(h.ch), e(0)), a.remove(g.line + 1, n); else {
            f(j, j.text.slice(0, g.ch) + i[0], e(0)), f(k, l + k.text.slice(h.ch), m);
            for (var o = 1, p = []; o < i.length - 1; ++o)p.push(new kf(i[o], e(o), d));
            n > 1 && a.remove(g.line + 1, n - 1), a.insert(g.line + 1, p)
        }
        tg(a, "change", a, b)
    }

    function Gf(a) {
        this.lines = a, this.parent = null;
        for (var b = 0, c = 0; b < a.length; ++b)a[b].parent = this, c += a[b].height;
        this.height = c
    }

    function Hf(a) {
        this.children = a;
        for (var b = 0, c = 0, d = 0; d < a.length; ++d) {
            var e = a[d];
            b += e.chunkSize(), c += e.height, e.parent = this
        }
        this.size = b, this.height = c, this.parent = null
    }

    function Mf(a, b, c) {
        function d(a, e, f) {
            if (a.linked)for (var g = 0; g < a.linked.length; ++g) {
                var h = a.linked[g];
                if (h.doc != e) {
                    var i = f && h.sharedHist;
                    (!c || i) && (b(h.doc, i), d(h.doc, a, i))
                }
            }
        }

        d(a, null, !0)
    }

    function Nf(a, b) {
        if (b.cm)throw new Error("This document is already in use.");
        a.doc = b, b.cm = a, C(a), y(a), a.options.lineWrapping || J(a), a.options.mode = b.modeOption, Pc(a)
    }

    function Of(a, b) {
        if (b -= a.first, 0 > b || b >= a.size)throw new Error("There is no line " + (b + a.first) + " in the document.");
        for (var c = a; !c.lines;)for (var d = 0; ; ++d) {
            var e = c.children[d], f = e.chunkSize();
            if (f > b) {
                c = e;
                break
            }
            b -= f
        }
        return c.lines[b]
    }

    function Pf(a, b, c) {
        var d = [], e = b.line;
        return a.iter(b.line, c.line + 1, function (a) {
            var f = a.text;
            e == c.line && (f = f.slice(0, c.ch)), e == b.line && (f = f.slice(b.ch)), d.push(f), ++e
        }), d
    }

    function Qf(a, b, c) {
        var d = [];
        return a.iter(b, c, function (a) {
            d.push(a.text)
        }), d
    }

    function Rf(a, b) {
        var c = b - a.height;
        if (c)for (var d = a; d; d = d.parent)d.height += c
    }

    function Sf(a) {
        if (null == a.parent)return null;
        for (var b = a.parent, c = Lg(b.lines, a), d = b.parent; d; b = d, d = d.parent)for (var e = 0; d.children[e] != b; ++e)c += d.children[e].chunkSize();
        return c + b.first
    }

    function Tf(a, b) {
        var c = a.first;
        a:do {
            for (var d = 0; d < a.children.length; ++d) {
                var e = a.children[d], f = e.height;
                if (f > b) {
                    a = e;
                    continue a
                }
                b -= f, c += e.chunkSize()
            }
            return c
        } while (!a.lines);
        for (var d = 0; d < a.lines.length; ++d) {
            var g = a.lines[d], h = g.height;
            if (h > b)break;
            b -= h
        }
        return c + d
    }

    function Uf(a) {
        a = _e(a);
        for (var b = 0, c = a.parent, d = 0; d < c.lines.length; ++d) {
            var e = c.lines[d];
            if (e == a)break;
            b += e.height
        }
        for (var f = c.parent; f; c = f, f = c.parent)for (var d = 0; d < f.children.length; ++d) {
            var g = f.children[d];
            if (g == c)break;
            b += g.height
        }
        return b
    }

    function Vf(a) {
        var b = a.order;
        return null == b && (b = a.order = Ih(a.text)), b
    }

    function Wf(a) {
        this.done = [], this.undone = [], this.undoDepth = 1 / 0, this.lastModTime = this.lastSelTime = 0, this.lastOp = null, this.lastOrigin = this.lastSelOrigin = null, this.generation = this.maxGeneration = a || 1
    }

    function Xf(a, b) {
        var c = {from: pb(b.from), to: Kd(b), text: Pf(a, b.from, b.to)};
        return cg(a, c, b.from.line, b.to.line + 1), Mf(a, function (a) {
            cg(a, c, b.from.line, b.to.line + 1)
        }, !0), c
    }

    function Yf(a) {
        for (; a.length;) {
            var b = Jg(a);
            if (!b.ranges)break;
            a.pop()
        }
    }

    function Zf(a, b) {
        return b ? (Yf(a.done), Jg(a.done)) : a.done.length && !Jg(a.done).ranges ? Jg(a.done) : a.done.length > 1 && !a.done[a.done.length - 2].ranges ? (a.done.pop(), Jg(a.done)) : void 0
    }

    function $f(a, b, c, d) {
        var e = a.history;
        e.undone.length = 0;
        var g, f = +new Date;
        if ((e.lastOp == d || e.lastOrigin == b.origin && b.origin && ("+" == b.origin.charAt(0) && a.cm && e.lastModTime > f - a.cm.options.historyEventDelay || "*" == b.origin.charAt(0))) && (g = Zf(e, e.lastOp == d))) {
            var h = Jg(g.changes);
            0 == ob(b.from, b.to) && 0 == ob(b.from, h.to) ? h.to = Kd(b) : g.changes.push(Xf(a, b))
        } else {
            var i = Jg(e.done);
            for (i && i.ranges || bg(a.sel, e.done), g = {
                changes: [Xf(a, b)],
                generation: e.generation
            }, e.done.push(g); e.done.length > e.undoDepth;)e.done.shift(), e.done[0].ranges || e.done.shift()
        }
        e.done.push(c), e.generation = ++e.maxGeneration, e.lastModTime = e.lastSelTime = f, e.lastOp = d, e.lastOrigin = e.lastSelOrigin = b.origin, h || rg(a, "historyAdded")
    }

    function _f(a, b, c, d) {
        var e = b.charAt(0);
        return "*" == e || "+" == e && c.ranges.length == d.ranges.length && c.somethingSelected() == d.somethingSelected() && new Date - a.history.lastSelTime <= (a.cm ? a.cm.options.historyEventDelay : 500)
    }

    function ag(a, b, c, d) {
        var e = a.history, f = d && d.origin;
        c == e.lastOp || f && e.lastSelOrigin == f && (e.lastModTime == e.lastSelTime && e.lastOrigin == f || _f(a, f, Jg(e.done), b)) ? e.done[e.done.length - 1] = b : bg(b, e.done), e.lastSelTime = +new Date, e.lastSelOrigin = f, e.lastOp = c, d && d.clearRedo !== !1 && Yf(e.undone)
    }

    function bg(a, b) {
        var c = Jg(b);
        c && c.ranges && c.equals(a) || b.push(a)
    }

    function cg(a, b, c, d) {
        var e = b["spans_" + a.id], f = 0;
        a.iter(Math.max(a.first, c), Math.min(a.first + a.size, d), function (c) {
            c.markedSpans && ((e || (e = b["spans_" + a.id] = {}))[f] = c.markedSpans), ++f
        })
    }

    function dg(a) {
        if (!a)return null;
        for (var c, b = 0; b < a.length; ++b)a[b].marker.explicitlyCleared ? c || (c = a.slice(0, b)) : c && c.push(a[b]);
        return c ? c.length ? c : null : a
    }

    function eg(a, b) {
        var c = b["spans_" + a.id];
        if (!c)return null;
        for (var d = 0, e = []; d < b.text.length; ++d)e.push(dg(c[d]));
        return e
    }

    function fg(a, b, c) {
        for (var d = 0, e = []; d < a.length; ++d) {
            var f = a[d];
            if (f.ranges)e.push(c ? sb.prototype.deepCopy.call(f) : f); else {
                var g = f.changes, h = [];
                e.push({changes: h});
                for (var i = 0; i < g.length; ++i) {
                    var k, j = g[i];
                    if (h.push({
                            from: j.from,
                            to: j.to,
                            text: j.text
                        }), b)for (var l in j)(k = l.match(/^spans_(\d+)$/)) && Lg(b, Number(k[1])) > -1 && (Jg(h)[l] = j[l], delete j[l])
                }
            }
        }
        return e
    }

    function gg(a, b, c, d) {
        c < a.line ? a.line += d : b < a.line && (a.line = b, a.ch = 0)
    }

    function hg(a, b, c, d) {
        for (var e = 0; e < a.length; ++e) {
            var f = a[e], g = !0;
            if (f.ranges) {
                f.copied || (f = a[e] = f.deepCopy(), f.copied = !0);
                for (var h = 0; h < f.ranges.length; h++)gg(f.ranges[h].anchor, b, c, d), gg(f.ranges[h].head, b, c, d)
            } else {
                for (var h = 0; h < f.changes.length; ++h) {
                    var i = f.changes[h];
                    if (c < i.from.line)i.from = nb(i.from.line + d, i.from.ch), i.to = nb(i.to.line + d, i.to.ch); else if (b <= i.to.line) {
                        g = !1;
                        break
                    }
                }
                g || (a.splice(0, e + 1), e = 0)
            }
        }
    }

    function ig(a, b) {
        var c = b.from.line, d = b.to.line, e = b.text.length - (d - c) - 1;
        hg(a.done, c, d, e), hg(a.undone, c, d, e)
    }

    function lg(a) {
        return null != a.defaultPrevented ? a.defaultPrevented : 0 == a.returnValue
    }

    function ng(a) {
        return a.target || a.srcElement
    }

    function og(a) {
        var b = a.which;
        return null == b && (1 & a.button ? b = 1 : 2 & a.button ? b = 3 : 4 & a.button && (b = 2)), p && a.ctrlKey && 1 == b && (b = 3), b
    }

    function tg(a, b) {
        function f(a) {
            return function () {
                a.apply(null, d)
            }
        }

        var c = a._handlers && a._handlers[b];
        if (c) {
            var e, d = Array.prototype.slice.call(arguments, 2);
            yc ? e = yc.delayedCallbacks : sg ? e = sg : (e = sg = [], setTimeout(ug, 0));
            for (var g = 0; g < c.length; ++g)e.push(f(c[g]))
        }
    }

    function ug() {
        var a = sg;
        sg = null;
        for (var b = 0; b < a.length; ++b)a[b]()
    }

    function vg(a, b, c) {
        return rg(a, c || b.type, a, b), lg(b) || b.codemirrorIgnore
    }

    function wg(a) {
        var b = a._handlers && a._handlers.cursorActivity;
        if (b)for (var c = a.curOp.cursorActivityHandlers || (a.curOp.cursorActivityHandlers = []), d = 0; d < b.length; ++d)-1 == Lg(c, b[d]) && c.push(b[d])
    }

    function xg(a, b) {
        var c = a._handlers && a._handlers[b];
        return c && c.length > 0
    }

    function yg(a) {
        a.prototype.on = function (a, b) {
            pg(this, a, b)
        }, a.prototype.off = function (a, b) {
            qg(this, a, b)
        }
    }

    function Eg() {
        this.id = null
    }

    function Gg(a, b, c) {
        for (var d = 0, e = 0; ;) {
            var f = a.indexOf("	", d);
            -1 == f && (f = a.length);
            var g = f - d;
            if (f == a.length || e + g >= b)return d + Math.min(g, b - e);
            if (e += f - d, e += c - e % c, d = f + 1, e >= b)return d
        }
    }

    function Ig(a) {
        for (; Hg.length <= a;)Hg.push(Jg(Hg) + " ");
        return Hg[a]
    }

    function Jg(a) {
        return a[a.length - 1]
    }

    function Lg(a, b) {
        for (var c = 0; c < a.length; ++c)if (a[c] == b)return c;
        return -1
    }

    function Mg(a, b) {
        for (var c = [], d = 0; d < a.length; d++)c[d] = b(a[d], d);
        return c
    }

    function Ng(a, b) {
        var c;
        if (Object.create)c = Object.create(a); else {
            var d = function () {
            };
            d.prototype = a, c = new d
        }
        return b && Og(b, c), c
    }

    function Og(a, b, c) {
        b || (b = {});
        for (var d in a)!a.hasOwnProperty(d) || c === !1 && b.hasOwnProperty(d) || (b[d] = a[d]);
        return b
    }

    function Pg(a) {
        var b = Array.prototype.slice.call(arguments, 1);
        return function () {
            return a.apply(null, b)
        }
    }

    function Sg(a, b) {
        return b ? b.source.indexOf("\\w") > -1 && Rg(a) ? !0 : b.test(a) : Rg(a)
    }

    function Tg(a) {
        for (var b in a)if (a.hasOwnProperty(b) && a[b])return !1;
        return !0
    }

    function Vg(a) {
        return a.charCodeAt(0) >= 768 && Ug.test(a)
    }

    function Wg(a, b, c, d) {
        var e = document.createElement(a);
        if (c && (e.className = c), d && (e.style.cssText = d), "string" == typeof b)e.appendChild(document.createTextNode(b)); else if (b)for (var f = 0; f < b.length; ++f)e.appendChild(b[f]);
        return e
    }

    function Yg(a) {
        for (var b = a.childNodes.length; b > 0; --b)a.removeChild(a.firstChild);
        return a
    }

    function Zg(a, b) {
        return Yg(a).appendChild(b)
    }

    function $g(a, b) {
        if (a.contains)return a.contains(b);
        for (; b = b.parentNode;)if (b == a)return !0
    }

    function _g() {
        return document.activeElement
    }

    function ah(a) {
        return new RegExp("\\b" + a + "\\b\\s*")
    }

    function bh(a, b) {
        var c = ah(b);
        c.test(a.className) && (a.className = a.className.replace(c, ""))
    }

    function ch(a, b) {
        ah(b).test(a.className) || (a.className += " " + b)
    }

    function dh(a, b) {
        for (var c = a.split(" "), d = 0; d < c.length; d++)c[d] && !ah(c[d]).test(b) && (b += " " + c[d]);
        return b
    }

    function eh(a) {
        if (document.body.getElementsByClassName)for (var b = document.body.getElementsByClassName("CodeMirror"), c = 0; c < b.length; c++) {
            var d = b[c].CodeMirror;
            d && a(d)
        }
    }

    function gh() {
        fh || (hh(), fh = !0)
    }

    function hh() {
        var a;
        pg(window, "resize", function () {
            null == a && (a = setTimeout(function () {
                a = null, jh = null, eh(dd)
            }, 100))
        }), pg(window, "blur", function () {
            eh(Hd)
        })
    }

    function kh(a) {
        if (null != jh)return jh;
        var b = Wg("div", null, null, "width: 50px; height: 50px; overflow-x: scroll");
        return Zg(a, b), b.offsetWidth && (jh = b.offsetHeight - b.clientHeight), jh || 0
    }

    function mh(a) {
        if (null == lh) {
            var b = Wg("span", "\u200b");
            Zg(a, Wg("span", [b, document.createTextNode("x")])), 0 != a.firstChild.offsetHeight && (lh = b.offsetWidth <= 1 && b.offsetHeight > 2 && !(d && 8 > e))
        }
        return lh ? Wg("span", "\u200b") : Wg("span", "\xa0", null, "display: inline-block; width: 1px; margin-right: -1px")
    }

    function oh(a) {
        if (null != nh)return nh;
        var b = Zg(a, document.createTextNode("A\u062eA")), c = Xg(b, 0, 1).getBoundingClientRect();
        if (c.left == c.right)return !1;
        var d = Xg(b, 1, 2).getBoundingClientRect();
        return nh = d.right - c.right < 3
    }

    function th(a) {
        if (null != sh)return sh;
        var b = Zg(a, Wg("span", "x")), c = b.getBoundingClientRect(), d = Xg(b, 0, 1).getBoundingClientRect();
        return sh = Math.abs(c.left - d.left) > 1
    }

    function vh(a, b, c, d) {
        if (!a)return d(b, c, "ltr");
        for (var e = !1, f = 0; f < a.length; ++f) {
            var g = a[f];
            (g.from < c && g.to > b || b == c && g.to == b) && (d(Math.max(g.from, b), Math.min(g.to, c), 1 == g.level ? "rtl" : "ltr"), e = !0)
        }
        e || d(b, c, "ltr")
    }

    function wh(a) {
        return a.level % 2 ? a.to : a.from
    }

    function xh(a) {
        return a.level % 2 ? a.from : a.to
    }

    function yh(a) {
        var b = Vf(a);
        return b ? wh(b[0]) : 0
    }

    function zh(a) {
        var b = Vf(a);
        return b ? xh(Jg(b)) : a.text.length
    }

    function Ah(a, b) {
        var c = Of(a.doc, b), d = _e(c);
        d != c && (b = Sf(d));
        var e = Vf(d), f = e ? e[0].level % 2 ? zh(d) : yh(d) : 0;
        return nb(b, f)
    }

    function Bh(a, b) {
        for (var c, d = Of(a.doc, b); c = Ze(d);)d = c.find(1, !0).line, b = null;
        var e = Vf(d), f = e ? e[0].level % 2 ? yh(d) : zh(d) : d.text.length;
        return nb(null == b ? Sf(d) : b, f)
    }

    function Ch(a, b, c) {
        var d = a[0].level;
        return b == d ? !0 : c == d ? !1 : c > b
    }

    function Eh(a, b) {
        Dh = null;
        for (var d, c = 0; c < a.length; ++c) {
            var e = a[c];
            if (e.from < b && e.to > b)return c;
            if (e.from == b || e.to == b) {
                if (null != d)return Ch(a, e.level, a[d].level) ? (e.from != e.to && (Dh = d), c) : (e.from != e.to && (Dh = c), d);
                d = c
            }
        }
        return d
    }

    function Fh(a, b, c, d) {
        if (!d)return b + c;
        do b += c; while (b > 0 && Vg(a.text.charAt(b)));
        return b
    }

    function Gh(a, b, c, d) {
        var e = Vf(a);
        if (!e)return Hh(a, b, c, d);
        for (var f = Eh(e, b), g = e[f], h = Fh(a, b, g.level % 2 ? -c : c, d); ;) {
            if (h > g.from && h < g.to)return h;
            if (h == g.from || h == g.to)return Eh(e, h) == f ? h : (g = e[f += c], c > 0 == g.level % 2 ? g.to : g.from);
            if (g = e[f += c], !g)return null;
            h = c > 0 == g.level % 2 ? Fh(a, g.to, -1, d) : Fh(a, g.from, 1, d)
        }
    }

    function Hh(a, b, c, d) {
        var e = b + c;
        if (d)for (; e > 0 && Vg(a.text.charAt(e));)e += c;
        return 0 > e || e > a.text.length ? null : e
    }

    var a = /gecko\/\d/i.test(navigator.userAgent), b = /MSIE \d/.test(navigator.userAgent), c = /Trident\/(?:[7-9]|\d{2,})\..*rv:(\d+)/.exec(navigator.userAgent), d = b || c, e = d && (b ? document.documentMode || 6 : c[1]), f = /WebKit\//.test(navigator.userAgent), g = f && /Qt\/\d+\.\d+/.test(navigator.userAgent), h = /Chrome\//.test(navigator.userAgent), i = /Opera\//.test(navigator.userAgent), j = /Apple Computer/.test(navigator.vendor), k = /KHTML\//.test(navigator.userAgent), l = /Mac OS X 1\d\D([8-9]|\d\d)\D/.test(navigator.userAgent), m = /PhantomJS/.test(navigator.userAgent), n = /AppleWebKit/.test(navigator.userAgent) && /Mobile\/\w+/.test(navigator.userAgent), o = n || /Android|webOS|BlackBerry|Opera Mini|Opera Mobi|IEMobile/i.test(navigator.userAgent), p = n || /Mac/.test(navigator.platform), q = /win/i.test(navigator.platform), r = i && navigator.userAgent.match(/Version\/(\d*\.\d*)/);
    r && (r = Number(r[1])), r && r >= 15 && (i = !1, f = !0);
    var s = p && (g || i && (null == r || 12.11 > r)), t = a || d && e >= 9, u = !1, v = !1, nb = w.Pos = function (a, b) {
        return this instanceof nb ? (this.line = a, this.ch = b, void 0) : new nb(a, b)
    }, ob = w.cmpPos = function (a, b) {
        return a.line - b.line || a.ch - b.ch
    };
    sb.prototype = {
        primary: function () {
            return this.ranges[this.primIndex]
        }, equals: function (a) {
            if (a == this)return !0;
            if (a.primIndex != this.primIndex || a.ranges.length != this.ranges.length)return !1;
            for (var b = 0; b < this.ranges.length; b++) {
                var c = this.ranges[b], d = a.ranges[b];
                if (0 != ob(c.anchor, d.anchor) || 0 != ob(c.head, d.head))return !1
            }
            return !0
        }, deepCopy: function () {
            for (var a = [], b = 0; b < this.ranges.length; b++)a[b] = new tb(pb(this.ranges[b].anchor), pb(this.ranges[b].head));
            return new sb(a, this.primIndex)
        }, somethingSelected: function () {
            for (var a = 0; a < this.ranges.length; a++)if (!this.ranges[a].empty())return !0;
            return !1
        }, contains: function (a, b) {
            b || (b = a);
            for (var c = 0; c < this.ranges.length; c++) {
                var d = this.ranges[c];
                if (ob(b, d.from()) >= 0 && ob(a, d.to()) <= 0)return c
            }
            return -1
        }
    }, tb.prototype = {
        from: function () {
            return rb(this.anchor, this.head)
        }, to: function () {
            return qb(this.anchor, this.head)
        }, empty: function () {
            return this.head.line == this.anchor.line && this.head.ch == this.anchor.ch
        }
    };
    var vc, hd, id, fc = {
        left: 0,
        right: 0,
        top: 0,
        bottom: 0
    }, yc = null, zc = 0, Yc = null, od = 0, td = 0, ud = null;
    d ? ud = -.53 : a ? ud = 15 : h ? ud = -.7 : j && (ud = -1 / 3);
    var yd, Bd = null, Kd = w.changeEnd = function (a) {
        return a.text ? nb(a.from.line + a.text.length - 1, Jg(a.text).length + (1 == a.text.length ? a.from.ch : 0)) : a.to
    };
    w.prototype = {
        constructor: w, focus: function () {
            window.focus(), _c(this), Xc(this)
        }, setOption: function (a, b) {
            var c = this.options, d = c[a];
            (c[a] != b || "mode" == a) && (c[a] = b, je.hasOwnProperty(a) && Kc(this, je[a])(this, b, d))
        }, getOption: function (a) {
            return this.options[a]
        }, getDoc: function () {
            return this.doc
        }, addKeyMap: function (a, b) {
            this.state.keyMaps[b ? "push" : "unshift"](a)
        }, removeKeyMap: function (a) {
            for (var b = this.state.keyMaps, c = 0; c < b.length; ++c)if (b[c] == a || "string" != typeof b[c] && b[c].name == a)return b.splice(c, 1), !0
        }, addOverlay: Lc(function (a, b) {
            var c = a.token ? a : w.getMode(this.options, a);
            if (c.startState)throw new Error("Overlays may not be stateful.");
            this.state.overlays.push({mode: c, modeSpec: a, opaque: b && b.opaque}), this.state.modeGen++, Pc(this)
        }), removeOverlay: Lc(function (a) {
            for (var b = this.state.overlays, c = 0; c < b.length; ++c) {
                var d = b[c].modeSpec;
                if (d == a || "string" == typeof a && d.name == a)return b.splice(c, 1), this.state.modeGen++, Pc(this), void 0
            }
        }), indentLine: Lc(function (a, b, c) {
            "string" != typeof b && "number" != typeof b && (b = null == b ? this.options.smartIndent ? "smart" : "prev" : b ? "add" : "subtract"), zb(this.doc, a) && ce(this, a, b, c)
        }), indentSelection: Lc(function (a) {
            for (var b = this.doc.sel.ranges, c = -1, d = 0; d < b.length; d++) {
                var e = b[d];
                if (e.empty())e.head.line > c && (ce(this, e.head.line, a, !0), c = e.head.line, d == this.doc.sel.primIndex && ae(this)); else {
                    var f = Math.max(c, e.from().line), g = e.to();
                    c = Math.min(this.lastLine(), g.line - (g.ch ? 0 : 1)) + 1;
                    for (var h = f; c > h; ++h)ce(this, h, a)
                }
            }
        }), getTokenAt: function (a, b) {
            var c = this.doc;
            a = xb(c, a);
            for (var d = Wb(this, a.line, b), e = this.doc.mode, f = Of(c, a.line), g = new ze(f.text, this.options.tabSize); g.pos < a.ch && !g.eol();) {
                g.start = g.pos;
                var h = pf(e, g, d)
            }
            return {start: g.start, end: g.pos, string: g.current(), type: h || null, state: d}
        }, getTokenTypeAt: function (a) {
            a = xb(this.doc, a);
            var f, b = sf(this, Of(this.doc, a.line)), c = 0, d = (b.length - 1) / 2, e = a.ch;
            if (0 == e)f = b[2]; else for (; ;) {
                var g = c + d >> 1;
                if ((g ? b[2 * g - 1] : 0) >= e)d = g; else {
                    if (!(b[2 * g + 1] < e)) {
                        f = b[2 * g + 2];
                        break
                    }
                    c = g + 1
                }
            }
            var h = f ? f.indexOf("cm-overlay ") : -1;
            return 0 > h ? f : 0 == h ? null : f.slice(0, h - 1)
        }, getModeAt: function (a) {
            var b = this.doc.mode;
            return b.innerMode ? w.innerMode(b, this.getTokenAt(a).state).mode : b
        }, getHelper: function (a, b) {
            return this.getHelpers(a, b)[0]
        }, getHelpers: function (a, b) {
            var c = [];
            if (!qe.hasOwnProperty(b))return qe;
            var d = qe[b], e = this.getModeAt(a);
            if ("string" == typeof e[b])d[e[b]] && c.push(d[e[b]]); else if (e[b])for (var f = 0; f < e[b].length; f++) {
                var g = d[e[b][f]];
                g && c.push(g)
            } else e.helperType && d[e.helperType] ? c.push(d[e.helperType]) : d[e.name] && c.push(d[e.name]);
            for (var f = 0; f < d._global.length; f++) {
                var h = d._global[f];
                h.pred(e, this) && -1 == Lg(c, h.val) && c.push(h.val)
            }
            return c
        }, getStateAfter: function (a, b) {
            var c = this.doc;
            return a = wb(c, null == a ? c.first + c.size - 1 : a), Wb(this, a + 1, b)
        }, cursorCoords: function (a, b) {
            var c, d = this.doc.sel.primary();
            return c = null == a ? d.head : "object" == typeof a ? xb(this.doc, a) : a ? d.from() : d.to(), qc(this, c, b || "page")
        }, charCoords: function (a, b) {
            return pc(this, xb(this.doc, a), b || "page")
        }, coordsChar: function (a, b) {
            return a = oc(this, a, b || "page"), tc(this, a.left, a.top)
        }, lineAtHeight: function (a, b) {
            return a = oc(this, {top: a, left: 0}, b || "page").top, Tf(this.doc, a + this.display.viewOffset)
        }, heightAtLine: function (a, b) {
            var c = !1, d = this.doc.first + this.doc.size - 1;
            a < this.doc.first ? a = this.doc.first : a > d && (a = d, c = !0);
            var e = Of(this.doc, a);
            return nc(this, e, {top: 0, left: 0}, b || "page").top + (c ? this.doc.height - Uf(e) : 0)
        }, defaultTextHeight: function () {
            return wc(this.display)
        }, defaultCharWidth: function () {
            return xc(this.display)
        }, setGutterMarker: Lc(function (a, b, c) {
            return de(this.doc, a, "gutter", function (a) {
                var d = a.gutterMarkers || (a.gutterMarkers = {});
                return d[b] = c, !c && Tg(d) && (a.gutterMarkers = null), !0
            })
        }), clearGutter: Lc(function (a) {
            var b = this, c = b.doc, d = c.first;
            c.iter(function (c) {
                c.gutterMarkers && c.gutterMarkers[a] && (c.gutterMarkers[a] = null, Qc(b, d, "gutter"), Tg(c.gutterMarkers) && (c.gutterMarkers = null)), ++d
            })
        }), addLineWidget: Lc(function (a, b, c) {
            return jf(this, a, b, c)
        }), removeLineWidget: function (a) {
            a.clear()
        }, lineInfo: function (a) {
            if ("number" == typeof a) {
                if (!zb(this.doc, a))return null;
                var b = a;
                if (a = Of(this.doc, a), !a)return null
            } else {
                var b = Sf(a);
                if (null == b)return null
            }
            return {
                line: b,
                handle: a,
                text: a.text,
                gutterMarkers: a.gutterMarkers,
                textClass: a.textClass,
                bgClass: a.bgClass,
                wrapClass: a.wrapClass,
                widgets: a.widgets
            }
        }, getViewport: function () {
            return {from: this.display.viewFrom, to: this.display.viewTo}
        }, addWidget: function (a, b, c, d, e) {
            var f = this.display;
            a = qc(this, xb(this.doc, a));
            var g = a.bottom, h = a.left;
            if (b.style.position = "absolute", f.sizer.appendChild(b), "over" == d)g = a.top; else if ("above" == d || "near" == d) {
                var i = Math.max(f.wrapper.clientHeight, this.doc.height), j = Math.max(f.sizer.clientWidth, f.lineSpace.clientWidth);
                ("above" == d || a.bottom + b.offsetHeight > i) && a.top > b.offsetHeight ? g = a.top - b.offsetHeight : a.bottom + b.offsetHeight <= i && (g = a.bottom), h + b.offsetWidth > j && (h = j - b.offsetWidth)
            }
            b.style.top = g + "px", b.style.left = b.style.right = "", "right" == e ? (h = f.sizer.clientWidth - b.offsetWidth, b.style.right = "0px") : ("left" == e ? h = 0 : "middle" == e && (h = (f.sizer.clientWidth - b.offsetWidth) / 2), b.style.left = h + "px"), c && Zd(this, h, g, h + b.offsetWidth, g + b.offsetHeight)
        }, triggerOnKeyDown: Lc(Cd), triggerOnKeyPress: Lc(Fd), triggerOnKeyUp: Ed, execCommand: function (a) {
            return te.hasOwnProperty(a) ? te[a](this) : void 0
        }, findPosH: function (a, b, c, d) {
            var e = 1;
            0 > b && (e = -1, b = -b);
            for (var f = 0, g = xb(this.doc, a); b > f && (g = fe(this.doc, g, e, c, d), !g.hitSide); ++f);
            return g
        }, moveH: Lc(function (a, b) {
            var c = this;
            c.extendSelectionsBy(function (d) {
                return c.display.shift || c.doc.extend || d.empty() ? fe(c.doc, d.head, a, b, c.options.rtlMoveVisually) : 0 > a ? d.from() : d.to()
            }, Dg)
        }), deleteH: Lc(function (a, b) {
            var c = this.doc.sel, d = this.doc;
            c.somethingSelected() ? d.replaceSelection("", null, "+delete") : ee(this, function (c) {
                var e = fe(d, c.head, a, b, !1);
                return 0 > a ? {from: e, to: c.head} : {from: c.head, to: e}
            })
        }), findPosV: function (a, b, c, d) {
            var e = 1, f = d;
            0 > b && (e = -1, b = -b);
            for (var g = 0, h = xb(this.doc, a); b > g; ++g) {
                var i = qc(this, h, "div");
                if (null == f ? f = i.left : i.left = f, h = ge(this, i, e, c), h.hitSide)break
            }
            return h
        }, moveV: Lc(function (a, b) {
            var c = this, d = this.doc, e = [], f = !c.display.shift && !d.extend && d.sel.somethingSelected();
            if (d.extendSelectionsBy(function (g) {
                    if (f)return 0 > a ? g.from() : g.to();
                    var h = qc(c, g.head, "div");
                    null != g.goalColumn && (h.left = g.goalColumn), e.push(h.left);
                    var i = ge(c, h, a, b);
                    return "page" == b && g == d.sel.primary() && _d(c, null, pc(c, i, "div").top - h.top), i
                }, Dg), e.length)for (var g = 0; g < d.sel.ranges.length; g++)d.sel.ranges[g].goalColumn = e[g]
        }), toggleOverwrite: function (a) {
            (null == a || a != this.state.overwrite) && ((this.state.overwrite = !this.state.overwrite) ? ch(this.display.cursorDiv, "CodeMirror-overwrite") : bh(this.display.cursorDiv, "CodeMirror-overwrite"), rg(this, "overwriteToggle", this, this.state.overwrite))
        }, hasFocus: function () {
            return _g() == this.display.input
        }, scrollTo: Lc(function (a, b) {
            (null != a || null != b) && be(this), null != a && (this.curOp.scrollLeft = a), null != b && (this.curOp.scrollTop = b)
        }), getScrollInfo: function () {
            var a = this.display.scroller, b = zg;
            return {
                left: a.scrollLeft,
                top: a.scrollTop,
                height: a.scrollHeight - b,
                width: a.scrollWidth - b,
                clientHeight: a.clientHeight - b,
                clientWidth: a.clientWidth - b
            }
        }, scrollIntoView: Lc(function (a, b) {
            if (null == a ? (a = {
                    from: this.doc.sel.primary().head,
                    to: null
                }, null == b && (b = this.options.cursorScrollMargin)) : "number" == typeof a ? a = {
                    from: nb(a, 0),
                    to: null
                } : null == a.from && (a = {
                    from: a,
                    to: null
                }), a.to || (a.to = a.from), a.margin = b || 0, null != a.from.line)be(this), this.curOp.scrollToPos = a; else {
                var c = $d(this, Math.min(a.from.left, a.to.left), Math.min(a.from.top, a.to.top) - a.margin, Math.max(a.from.right, a.to.right), Math.max(a.from.bottom, a.to.bottom) + a.margin);
                this.scrollTo(c.scrollLeft, c.scrollTop)
            }
        }), setSize: Lc(function (a, b) {
            function d(a) {
                return "number" == typeof a || /^\d+$/.test(String(a)) ? a + "px" : a
            }

            var c = this;
            null != a && (c.display.wrapper.style.width = d(a)), null != b && (c.display.wrapper.style.height = d(b)), c.options.lineWrapping && jc(this);
            var e = c.display.viewFrom;
            c.doc.iter(e, c.display.viewTo, function (a) {
                if (a.widgets)for (var b = 0; b < a.widgets.length; b++)if (a.widgets[b].noHScroll) {
                    Qc(c, e, "widget");
                    break
                }
                ++e
            }), c.curOp.forceUpdate = !0, rg(c, "refresh", this)
        }), operation: function (a) {
            return Jc(this, a)
        }, refresh: Lc(function () {
            var a = this.display.cachedTextHeight;
            Pc(this), this.curOp.forceUpdate = !0, kc(this), this.scrollTo(this.doc.scrollLeft, this.doc.scrollTop), H(this), (null == a || Math.abs(a - wc(this.display)) > .5) && C(this), rg(this, "refresh", this)
        }), swapDoc: Lc(function (a) {
            var b = this.doc;
            return b.cm = null, Nf(this, a), kc(this), $c(this), this.scrollTo(a.scrollLeft, a.scrollTop), tg(this, "swapDoc", this, b), b
        }), getInputField: function () {
            return this.display.input
        }, getWrapperElement: function () {
            return this.display.wrapper
        }, getScrollerElement: function () {
            return this.display.scroller
        }, getGutterElement: function () {
            return this.display.gutters
        }
    }, yg(w);
    var ie = w.defaults = {}, je = w.optionHandlers = {}, le = w.Init = {
        toString: function () {
            return "CodeMirror.Init"
        }
    };
    ke("value", "", function (a, b) {
        a.setValue(b)
    }, !0), ke("mode", null, function (a, b) {
        a.doc.modeOption = b, y(a)
    }, !0), ke("indentUnit", 2, y, !0), ke("indentWithTabs", !1), ke("smartIndent", !0), ke("tabSize", 4, function (a) {
        z(a), kc(a), Pc(a)
    }, !0), ke("specialChars", /[\t\u0000-\u0019\u00ad\u200b\u2028\u2029\ufeff]/g, function (a, b) {
        a.options.specialChars = new RegExp(b.source + (b.test("	") ? "" : "|	"), "g"), a.refresh()
    }, !0), ke("specialCharPlaceholder", yf, function (a) {
        a.refresh()
    }, !0), ke("electricChars", !0), ke("rtlMoveVisually", !q), ke("wholeLineUpdateBefore", !0), ke("theme", "default", function (a) {
        E(a), F(a)
    }, !0), ke("keyMap", "default", D), ke("extraKeys", null), ke("lineWrapping", !1, A, !0), ke("gutters", [], function (a) {
        K(a.options), F(a)
    }, !0), ke("fixedGutter", !0, function (a, b) {
        a.display.gutters.style.left = b ? S(a.display) + "px" : "0", a.refresh()
    }, !0), ke("coverGutterNextToScrollbar", !1, N, !0), ke("lineNumbers", !1, function (a) {
        K(a.options), F(a)
    }, !0), ke("firstLineNumber", 1, F, !0), ke("lineNumberFormatter", function (a) {
        return a
    }, F, !0), ke("showCursorWhenSelecting", !1, Pb, !0), ke("resetSelectionOnContextMenu", !0), ke("readOnly", !1, function (a, b) {
        "nocursor" == b ? (Hd(a), a.display.input.blur(), a.display.disabled = !0) : (a.display.disabled = !1, b || $c(a))
    }), ke("disableInput", !1, function (a, b) {
        b || $c(a)
    }, !0), ke("dragDrop", !0), ke("cursorBlinkRate", 530), ke("cursorScrollMargin", 0), ke("cursorHeight", 1, Pb, !0), ke("singleCursorHeightPerLine", !0, Pb, !0), ke("workTime", 100), ke("workDelay", 100), ke("flattenSpans", !0, z, !0), ke("addModeClass", !1, z, !0), ke("pollInterval", 100), ke("undoDepth", 200, function (a, b) {
        a.doc.history.undoDepth = b
    }), ke("historyEventDelay", 1250), ke("viewportMargin", 10, function (a) {
        a.refresh()
    }, !0), ke("maxHighlightLength", 1e4, z, !0), ke("moveInputWithCursor", !0, function (a, b) {
        b || (a.display.inputDiv.style.top = a.display.inputDiv.style.left = 0)
    }), ke("tabindex", null, function (a, b) {
        a.display.input.tabIndex = b || ""
    }), ke("autofocus", null);
    var me = w.modes = {}, ne = w.mimeModes = {};
    w.defineMode = function (a, b) {
        if (w.defaults.mode || "null" == a || (w.defaults.mode = a), arguments.length > 2) {
            b.dependencies = [];
            for (var c = 2; c < arguments.length; ++c)b.dependencies.push(arguments[c])
        }
        me[a] = b
    }, w.defineMIME = function (a, b) {
        ne[a] = b
    }, w.resolveMode = function (a) {
        if ("string" == typeof a && ne.hasOwnProperty(a))a = ne[a]; else if (a && "string" == typeof a.name && ne.hasOwnProperty(a.name)) {
            var b = ne[a.name];
            "string" == typeof b && (b = {name: b}), a = Ng(b, a), a.name = b.name
        } else if ("string" == typeof a && /^[\w\-]+\/[\w\-]+\+xml$/.test(a))return w.resolveMode("application/xml");
        return "string" == typeof a ? {name: a} : a || {name: "null"}
    }, w.getMode = function (a, b) {
        var b = w.resolveMode(b), c = me[b.name];
        if (!c)return w.getMode(a, "text/plain");
        var d = c(a, b);
        if (oe.hasOwnProperty(b.name)) {
            var e = oe[b.name];
            for (var f in e)e.hasOwnProperty(f) && (d.hasOwnProperty(f) && (d["_" + f] = d[f]), d[f] = e[f])
        }
        if (d.name = b.name, b.helperType && (d.helperType = b.helperType), b.modeProps)for (var f in b.modeProps)d[f] = b.modeProps[f];
        return d
    }, w.defineMode("null", function () {
        return {
            token: function (a) {
                a.skipToEnd()
            }
        }
    }), w.defineMIME("text/plain", "null");
    var oe = w.modeExtensions = {};
    w.extendMode = function (a, b) {
        var c = oe.hasOwnProperty(a) ? oe[a] : oe[a] = {};
        Og(b, c)
    }, w.defineExtension = function (a, b) {
        w.prototype[a] = b
    }, w.defineDocExtension = function (a, b) {
        Jf.prototype[a] = b
    }, w.defineOption = ke;
    var pe = [];
    w.defineInitHook = function (a) {
        pe.push(a)
    };
    var qe = w.helpers = {};
    w.registerHelper = function (a, b, c) {
        qe.hasOwnProperty(a) || (qe[a] = w[a] = {_global: []}), qe[a][b] = c
    }, w.registerGlobalHelper = function (a, b, c, d) {
        w.registerHelper(a, b, d), qe[a]._global.push({pred: c, val: d})
    };
    var re = w.copyState = function (a, b) {
        if (b === !0)return b;
        if (a.copyState)return a.copyState(b);
        var c = {};
        for (var d in b) {
            var e = b[d];
            e instanceof Array && (e = e.concat([])), c[d] = e
        }
        return c
    }, se = w.startState = function (a, b, c) {
        return a.startState ? a.startState(b, c) : !0
    };
    w.innerMode = function (a, b) {
        for (; a.innerMode;) {
            var c = a.innerMode(b);
            if (!c || c.mode == a)break;
            b = c.state, a = c.mode
        }
        return c || {mode: a, state: b}
    };
    var te = w.commands = {
        selectAll: function (a) {
            a.setSelection(nb(a.firstLine(), 0), nb(a.lastLine()), Bg)
        }, singleSelection: function (a) {
            a.setSelection(a.getCursor("anchor"), a.getCursor("head"), Bg)
        }, killLine: function (a) {
            ee(a, function (b) {
                if (b.empty()) {
                    var c = Of(a.doc, b.head.line).text.length;
                    return b.head.ch == c && b.head.line < a.lastLine() ? {
                        from: b.head,
                        to: nb(b.head.line + 1, 0)
                    } : {from: b.head, to: nb(b.head.line, c)}
                }
                return {from: b.from(), to: b.to()}
            })
        }, deleteLine: function (a) {
            ee(a, function (b) {
                return {from: nb(b.from().line, 0), to: xb(a.doc, nb(b.to().line + 1, 0))}
            })
        }, delLineLeft: function (a) {
            ee(a, function (a) {
                return {from: nb(a.from().line, 0), to: a.from()}
            })
        }, delWrappedLineLeft: function (a) {
            ee(a, function (b) {
                var c = a.charCoords(b.head, "div").top + 5, d = a.coordsChar({left: 0, top: c}, "div");
                return {from: d, to: b.from()}
            })
        }, delWrappedLineRight: function (a) {
            ee(a, function (b) {
                var c = a.charCoords(b.head, "div").top + 5, d = a.coordsChar({
                    left: a.display.lineDiv.offsetWidth + 100,
                    top: c
                }, "div");
                return {from: b.from(), to: d}
            })
        }, undo: function (a) {
            a.undo()
        }, redo: function (a) {
            a.redo()
        }, undoSelection: function (a) {
            a.undoSelection()
        }, redoSelection: function (a) {
            a.redoSelection()
        }, goDocStart: function (a) {
            a.extendSelection(nb(a.firstLine(), 0))
        }, goDocEnd: function (a) {
            a.extendSelection(nb(a.lastLine()))
        }, goLineStart: function (a) {
            a.extendSelectionsBy(function (b) {
                return Ah(a, b.head.line)
            }, {origin: "+move", bias: 1})
        }, goLineStartSmart: function (a) {
            a.extendSelectionsBy(function (b) {
                var c = Ah(a, b.head.line), d = a.getLineHandle(c.line), e = Vf(d);
                if (!e || 0 == e[0].level) {
                    var f = Math.max(0, d.text.search(/\S/)), g = b.head.line == c.line && b.head.ch <= f && b.head.ch;
                    return nb(c.line, g ? 0 : f)
                }
                return c
            }, {origin: "+move", bias: 1})
        }, goLineEnd: function (a) {
            a.extendSelectionsBy(function (b) {
                return Bh(a, b.head.line)
            }, {origin: "+move", bias: -1})
        }, goLineRight: function (a) {
            a.extendSelectionsBy(function (b) {
                var c = a.charCoords(b.head, "div").top + 5;
                return a.coordsChar({left: a.display.lineDiv.offsetWidth + 100, top: c}, "div")
            }, Dg)
        }, goLineLeft: function (a) {
            a.extendSelectionsBy(function (b) {
                var c = a.charCoords(b.head, "div").top + 5;
                return a.coordsChar({left: 0, top: c}, "div")
            }, Dg)
        }, goLineUp: function (a) {
            a.moveV(-1, "line")
        }, goLineDown: function (a) {
            a.moveV(1, "line")
        }, goPageUp: function (a) {
            a.moveV(-1, "page")
        }, goPageDown: function (a) {
            a.moveV(1, "page")
        }, goCharLeft: function (a) {
            a.moveH(-1, "char")
        }, goCharRight: function (a) {
            a.moveH(1, "char")
        }, goColumnLeft: function (a) {
            a.moveH(-1, "column")
        }, goColumnRight: function (a) {
            a.moveH(1, "column")
        }, goWordLeft: function (a) {
            a.moveH(-1, "word")
        }, goGroupRight: function (a) {
            a.moveH(1, "group")
        }, goGroupLeft: function (a) {
            a.moveH(-1, "group")
        }, goWordRight: function (a) {
            a.moveH(1, "word")
        }, delCharBefore: function (a) {
            a.deleteH(-1, "char")
        }, delCharAfter: function (a) {
            a.deleteH(1, "char")
        }, delWordBefore: function (a) {
            a.deleteH(-1, "word")
        }, delWordAfter: function (a) {
            a.deleteH(1, "word")
        }, delGroupBefore: function (a) {
            a.deleteH(-1, "group")
        }, delGroupAfter: function (a) {
            a.deleteH(1, "group")
        }, indentAuto: function (a) {
            a.indentSelection("smart")
        }, indentMore: function (a) {
            a.indentSelection("add")
        }, indentLess: function (a) {
            a.indentSelection("subtract")
        }, insertTab: function (a) {
            a.replaceSelection("	")
        }, insertSoftTab: function (a) {
            for (var b = [], c = a.listSelections(), d = a.options.tabSize, e = 0; e < c.length; e++) {
                var f = c[e].from(), g = Fg(a.getLine(f.line), f.ch, d);
                b.push(new Array(d - g % d + 1).join(" "))
            }
            a.replaceSelections(b)
        }, defaultTab: function (a) {
            a.somethingSelected() ? a.indentSelection("add") : a.execCommand("insertTab")
        }, transposeChars: function (a) {
            Jc(a, function () {
                for (var b = a.listSelections(), c = [], d = 0; d < b.length; d++) {
                    var e = b[d].head, f = Of(a.doc, e.line).text;
                    if (f)if (e.ch == f.length && (e = new nb(e.line, e.ch - 1)), e.ch > 0)e = new nb(e.line, e.ch + 1), a.replaceRange(f.charAt(e.ch - 1) + f.charAt(e.ch - 2), nb(e.line, e.ch - 2), e, "+transpose"); else if (e.line > a.doc.first) {
                        var g = Of(a.doc, e.line - 1).text;
                        g && a.replaceRange(f.charAt(0) + "\n" + g.charAt(g.length - 1), nb(e.line - 1, g.length - 1), nb(e.line, 1), "+transpose")
                    }
                    c.push(new tb(e, e))
                }
                a.setSelections(c)
            })
        }, newlineAndIndent: function (a) {
            Jc(a, function () {
                for (var b = a.listSelections().length, c = 0; b > c; c++) {
                    var d = a.listSelections()[c];
                    a.replaceRange("\n", d.anchor, d.head, "+input"), a.indentLine(d.from().line + 1, null, !0), ae(a)
                }
            })
        }, toggleOverwrite: function (a) {
            a.toggleOverwrite()
        }
    }, ue = w.keyMap = {};
    ue.basic = {
        Left: "goCharLeft",
        Right: "goCharRight",
        Up: "goLineUp",
        Down: "goLineDown",
        End: "goLineEnd",
        Home: "goLineStartSmart",
        PageUp: "goPageUp",
        PageDown: "goPageDown",
        Delete: "delCharAfter",
        Backspace: "delCharBefore",
        "Shift-Backspace": "delCharBefore",
        Tab: "defaultTab",
        "Shift-Tab": "indentAuto",
        Enter: "newlineAndIndent",
        Insert: "toggleOverwrite",
        Esc: "singleSelection"
    }, ue.pcDefault = {
        "Ctrl-A": "selectAll",
        "Ctrl-D": "deleteLine",
        "Ctrl-Z": "undo",
        "Shift-Ctrl-Z": "redo",
        "Ctrl-Y": "redo",
        "Ctrl-Home": "goDocStart",
        "Ctrl-Up": "goDocStart",
        "Ctrl-End": "goDocEnd",
        "Ctrl-Down": "goDocEnd",
        "Ctrl-Left": "goGroupLeft",
        "Ctrl-Right": "goGroupRight",
        "Alt-Left": "goLineStart",
        "Alt-Right": "goLineEnd",
        "Ctrl-Backspace": "delGroupBefore",
        "Ctrl-Delete": "delGroupAfter",
        "Ctrl-S": "save",
        "Ctrl-F": "find",
        "Ctrl-G": "findNext",
        "Shift-Ctrl-G": "findPrev",
        "Shift-Ctrl-F": "replace",
        "Shift-Ctrl-R": "replaceAll",
        "Ctrl-[": "indentLess",
        "Ctrl-]": "indentMore",
        "Ctrl-U": "undoSelection",
        "Shift-Ctrl-U": "redoSelection",
        "Alt-U": "redoSelection",
        fallthrough: "basic"
    }, ue.macDefault = {
        "Cmd-A": "selectAll",
        "Cmd-D": "deleteLine",
        "Cmd-Z": "undo",
        "Shift-Cmd-Z": "redo",
        "Cmd-Y": "redo",
        "Cmd-Home": "goDocStart",
        "Cmd-Up": "goDocStart",
        "Cmd-End": "goDocEnd",
        "Cmd-Down": "goDocEnd",
        "Alt-Left": "goGroupLeft",
        "Alt-Right": "goGroupRight",
        "Cmd-Left": "goLineLeft",
        "Cmd-Right": "goLineRight",
        "Alt-Backspace": "delGroupBefore",
        "Ctrl-Alt-Backspace": "delGroupAfter",
        "Alt-Delete": "delGroupAfter",
        "Cmd-S": "save",
        "Cmd-F": "find",
        "Cmd-G": "findNext",
        "Shift-Cmd-G": "findPrev",
        "Cmd-Alt-F": "replace",
        "Shift-Cmd-Alt-F": "replaceAll",
        "Cmd-[": "indentLess",
        "Cmd-]": "indentMore",
        "Cmd-Backspace": "delWrappedLineLeft",
        "Cmd-Delete": "delWrappedLineRight",
        "Cmd-U": "undoSelection",
        "Shift-Cmd-U": "redoSelection",
        fallthrough: ["basic", "emacsy"]
    }, ue.emacsy = {
        "Ctrl-F": "goCharRight",
        "Ctrl-B": "goCharLeft",
        "Ctrl-P": "goLineUp",
        "Ctrl-N": "goLineDown",
        "Alt-F": "goWordRight",
        "Alt-B": "goWordLeft",
        "Ctrl-A": "goLineStart",
        "Ctrl-E": "goLineEnd",
        "Ctrl-V": "goPageDown",
        "Shift-Ctrl-V": "goPageUp",
        "Ctrl-D": "delCharAfter",
        "Ctrl-H": "delCharBefore",
        "Alt-D": "delWordAfter",
        "Alt-Backspace": "delWordBefore",
        "Ctrl-K": "killLine",
        "Ctrl-T": "transposeChars"
    }, ue["default"] = p ? ue.macDefault : ue.pcDefault;
    var we = w.lookupKey = function (a, b, c) {
        function d(b) {
            b = ve(b);
            var e = b[a];
            if (e === !1)return "stop";
            if (null != e && c(e))return !0;
            if (b.nofallthrough)return "stop";
            var f = b.fallthrough;
            if (null == f)return !1;
            if ("[object Array]" != Object.prototype.toString.call(f))return d(f);
            for (var g = 0; g < f.length; ++g) {
                var h = d(f[g]);
                if (h)return h
            }
            return !1
        }

        for (var e = 0; e < b.length; ++e) {
            var f = d(b[e]);
            if (f)return "stop" != f
        }
    }, xe = w.isModifierKey = function (a) {
        var b = uh[a.keyCode];
        return "Ctrl" == b || "Alt" == b || "Shift" == b || "Mod" == b
    }, ye = w.keyName = function (a, b) {
        if (i && 34 == a.keyCode && a["char"])return !1;
        var c = uh[a.keyCode];
        return null == c || a.altGraphKey ? !1 : (a.altKey && (c = "Alt-" + c), (s ? a.metaKey : a.ctrlKey) && (c = "Ctrl-" + c), (s ? a.ctrlKey : a.metaKey) && (c = "Cmd-" + c), !b && a.shiftKey && (c = "Shift-" + c), c)
    };
    w.fromTextArea = function (a, b) {
        function d() {
            a.value = i.getValue()
        }

        if (b || (b = {}), b.value = a.value, !b.tabindex && a.tabindex && (b.tabindex = a.tabindex), !b.placeholder && a.placeholder && (b.placeholder = a.placeholder), null == b.autofocus) {
            var c = _g();
            b.autofocus = c == a || null != a.getAttribute("autofocus") && c == document.body
        }
        if (a.form && (pg(a.form, "submit", d), !b.leaveSubmitMethodAlone)) {
            var e = a.form, f = e.submit;
            try {
                var g = e.submit = function () {
                    d(), e.submit = f, e.submit(), e.submit = g
                }
            } catch (h) {
            }
        }
        a.style.display = "none";
        var i = w(function (b) {
            a.parentNode.insertBefore(b, a.nextSibling)
        }, b);
        return i.save = d, i.getTextArea = function () {
            return a
        }, i.toTextArea = function () {
            d(), a.parentNode.removeChild(i.getWrapperElement()), a.style.display = "", a.form && (qg(a.form, "submit", d), "function" == typeof a.form.submit && (a.form.submit = f))
        }, i
    };
    var ze = w.StringStream = function (a, b) {
        this.pos = this.start = 0, this.string = a, this.tabSize = b || 8, this.lastColumnPos = this.lastColumnValue = 0, this.lineStart = 0
    };
    ze.prototype = {
        eol: function () {
            return this.pos >= this.string.length
        }, sol: function () {
            return this.pos == this.lineStart
        }, peek: function () {
            return this.string.charAt(this.pos) || void 0
        }, next: function () {
            return this.pos < this.string.length ? this.string.charAt(this.pos++) : void 0
        }, eat: function (a) {
            var b = this.string.charAt(this.pos);
            if ("string" == typeof a)var c = b == a; else var c = b && (a.test ? a.test(b) : a(b));
            return c ? (++this.pos, b) : void 0
        }, eatWhile: function (a) {
            for (var b = this.pos; this.eat(a););
            return this.pos > b
        }, eatSpace: function () {
            for (var a = this.pos; /[\s\u00a0]/.test(this.string.charAt(this.pos));)++this.pos;
            return this.pos > a
        }, skipToEnd: function () {
            this.pos = this.string.length
        }, skipTo: function (a) {
            var b = this.string.indexOf(a, this.pos);
            return b > -1 ? (this.pos = b, !0) : void 0
        }, backUp: function (a) {
            this.pos -= a
        }, column: function () {
            return this.lastColumnPos < this.start && (this.lastColumnValue = Fg(this.string, this.start, this.tabSize, this.lastColumnPos, this.lastColumnValue), this.lastColumnPos = this.start), this.lastColumnValue - (this.lineStart ? Fg(this.string, this.lineStart, this.tabSize) : 0)
        }, indentation: function () {
            return Fg(this.string, null, this.tabSize) - (this.lineStart ? Fg(this.string, this.lineStart, this.tabSize) : 0)
        }, match: function (a, b, c) {
            if ("string" != typeof a) {
                var f = this.string.slice(this.pos).match(a);
                return f && f.index > 0 ? null : (f && b !== !1 && (this.pos += f[0].length), f)
            }
            var d = function (a) {
                return c ? a.toLowerCase() : a
            }, e = this.string.substr(this.pos, a.length);
            return d(e) == d(a) ? (b !== !1 && (this.pos += a.length), !0) : void 0
        }, current: function () {
            return this.string.slice(this.start, this.pos)
        }, hideFirstChars: function (a, b) {
            this.lineStart += a;
            try {
                return b()
            } finally {
                this.lineStart -= a
            }
        }
    };
    var Ae = w.TextMarker = function (a, b) {
        this.lines = [], this.type = b, this.doc = a
    };
    yg(Ae), Ae.prototype.clear = function () {
        if (!this.explicitlyCleared) {
            var a = this.doc.cm, b = a && !a.curOp;
            if (b && Ac(a), xg(this, "clear")) {
                var c = this.find();
                c && tg(this, "clear", c.from, c.to)
            }
            for (var d = null, e = null, f = 0; f < this.lines.length; ++f) {
                var g = this.lines[f], h = Je(g.markedSpans, this);
                a && !this.collapsed ? Qc(a, Sf(g), "text") : a && (null != h.to && (e = Sf(g)), null != h.from && (d = Sf(g))), g.markedSpans = Ke(g.markedSpans, h), null == h.from && this.collapsed && !df(this.doc, g) && a && Rf(g, wc(a.display))
            }
            if (a && this.collapsed && !a.options.lineWrapping)for (var f = 0; f < this.lines.length; ++f) {
                var i = _e(this.lines[f]), j = I(i);
                j > a.display.maxLineLength && (a.display.maxLine = i, a.display.maxLineLength = j, a.display.maxLineChanged = !0)
            }
            null != d && a && this.collapsed && Pc(a, d, e + 1), this.lines.length = 0, this.explicitlyCleared = !0, this.atomic && this.doc.cantEdit && (this.doc.cantEdit = !1, a && Lb(a.doc)), a && tg(a, "markerCleared", a, this), b && Cc(a), this.parent && this.parent.clear()
        }
    }, Ae.prototype.find = function (a, b) {
        null == a && "bookmark" == this.type && (a = 1);
        for (var c, d, e = 0; e < this.lines.length; ++e) {
            var f = this.lines[e], g = Je(f.markedSpans, this);
            if (null != g.from && (c = nb(b ? f : Sf(f), g.from), -1 == a))return c;
            if (null != g.to && (d = nb(b ? f : Sf(f), g.to), 1 == a))return d
        }
        return c && {from: c, to: d}
    }, Ae.prototype.changed = function () {
        var a = this.find(-1, !0), b = this, c = this.doc.cm;
        a && c && Jc(c, function () {
            var d = a.line, e = Sf(a.line), f = cc(c, e);
            if (f && (ic(f), c.curOp.selectionChanged = c.curOp.forceUpdate = !0), c.curOp.updateMaxLine = !0, !df(b.doc, d) && null != b.height) {
                var g = b.height;
                b.height = null;
                var h = hf(b) - g;
                h && Rf(d, d.height + h)
            }
        })
    }, Ae.prototype.attachLine = function (a) {
        if (!this.lines.length && this.doc.cm) {
            var b = this.doc.cm.curOp;
            b.maybeHiddenMarkers && -1 != Lg(b.maybeHiddenMarkers, this) || (b.maybeUnhiddenMarkers || (b.maybeUnhiddenMarkers = [])).push(this)
        }
        this.lines.push(a)
    }, Ae.prototype.detachLine = function (a) {
        if (this.lines.splice(Lg(this.lines, a), 1), !this.lines.length && this.doc.cm) {
            var b = this.doc.cm.curOp;
            (b.maybeHiddenMarkers || (b.maybeHiddenMarkers = [])).push(this)
        }
    };
    var Be = 0, De = w.SharedTextMarker = function (a, b) {
        this.markers = a, this.primary = b;
        for (var c = 0; c < a.length; ++c)a[c].parent = this
    };
    yg(De), De.prototype.clear = function () {
        if (!this.explicitlyCleared) {
            this.explicitlyCleared = !0;
            for (var a = 0; a < this.markers.length; ++a)this.markers[a].clear();
            tg(this, "clear")
        }
    }, De.prototype.find = function (a, b) {
        return this.primary.find(a, b)
    };
    var ff = w.LineWidget = function (a, b, c) {
        if (c)for (var d in c)c.hasOwnProperty(d) && (this[d] = c[d]);
        this.cm = a, this.node = b
    };
    yg(ff), ff.prototype.clear = function () {
        var a = this.cm, b = this.line.widgets, c = this.line, d = Sf(c);
        if (null != d && b) {
            for (var e = 0; e < b.length; ++e)b[e] == this && b.splice(e--, 1);
            b.length || (c.widgets = null);
            var f = hf(this);
            Jc(a, function () {
                gf(a, c, -f), Qc(a, d, "widget"), Rf(c, Math.max(0, c.height - f))
            })
        }
    }, ff.prototype.changed = function () {
        var a = this.height, b = this.cm, c = this.line;
        this.height = null;
        var d = hf(this) - a;
        d && Jc(b, function () {
            b.curOp.forceUpdate = !0, gf(b, c, d), Rf(c, c.height + d)
        })
    };
    var kf = w.Line = function (a, b, c) {
        this.text = a, Te(this, b), this.height = c ? c(this) : 1
    };
    yg(kf), kf.prototype.lineNo = function () {
        return Sf(this)
    };
    var uf = {}, vf = {};
    Gf.prototype = {
        chunkSize: function () {
            return this.lines.length
        }, removeInner: function (a, b) {
            for (var c = a, d = a + b; d > c; ++c) {
                var e = this.lines[c];
                this.height -= e.height, mf(e), tg(e, "delete")
            }
            this.lines.splice(a, b)
        }, collapse: function (a) {
            a.push.apply(a, this.lines)
        }, insertInner: function (a, b, c) {
            this.height += c, this.lines = this.lines.slice(0, a).concat(b).concat(this.lines.slice(a));
            for (var d = 0; d < b.length; ++d)b[d].parent = this
        }, iterN: function (a, b, c) {
            for (var d = a + b; d > a; ++a)if (c(this.lines[a]))return !0
        }
    }, Hf.prototype = {
        chunkSize: function () {
            return this.size
        }, removeInner: function (a, b) {
            this.size -= b;
            for (var c = 0; c < this.children.length; ++c) {
                var d = this.children[c], e = d.chunkSize();
                if (e > a) {
                    var f = Math.min(b, e - a), g = d.height;
                    if (d.removeInner(a, f), this.height -= g - d.height, e == f && (this.children.splice(c--, 1), d.parent = null), 0 == (b -= f))break;
                    a = 0
                } else a -= e
            }
            if (this.size - b < 25 && (this.children.length > 1 || !(this.children[0]instanceof Gf))) {
                var h = [];
                this.collapse(h), this.children = [new Gf(h)], this.children[0].parent = this
            }
        }, collapse: function (a) {
            for (var b = 0; b < this.children.length; ++b)this.children[b].collapse(a)
        }, insertInner: function (a, b, c) {
            this.size += b.length, this.height += c;
            for (var d = 0; d < this.children.length; ++d) {
                var e = this.children[d], f = e.chunkSize();
                if (f >= a) {
                    if (e.insertInner(a, b, c), e.lines && e.lines.length > 50) {
                        for (; e.lines.length > 50;) {
                            var g = e.lines.splice(e.lines.length - 25, 25), h = new Gf(g);
                            e.height -= h.height, this.children.splice(d + 1, 0, h), h.parent = this
                        }
                        this.maybeSpill()
                    }
                    break
                }
                a -= f
            }
        }, maybeSpill: function () {
            if (!(this.children.length <= 10)) {
                var a = this;
                do {
                    var b = a.children.splice(a.children.length - 5, 5), c = new Hf(b);
                    if (a.parent) {
                        a.size -= c.size, a.height -= c.height;
                        var e = Lg(a.parent.children, a);
                        a.parent.children.splice(e + 1, 0, c)
                    } else {
                        var d = new Hf(a.children);
                        d.parent = a, a.children = [d, c], a = d
                    }
                    c.parent = a.parent
                } while (a.children.length > 10);
                a.parent.maybeSpill()
            }
        }, iterN: function (a, b, c) {
            for (var d = 0; d < this.children.length; ++d) {
                var e = this.children[d], f = e.chunkSize();
                if (f > a) {
                    var g = Math.min(b, f - a);
                    if (e.iterN(a, g, c))return !0;
                    if (0 == (b -= g))break;
                    a = 0
                } else a -= f
            }
        }
    };
    var If = 0, Jf = w.Doc = function (a, b, c) {
        if (!(this instanceof Jf))return new Jf(a, b, c);
        null == c && (c = 0), Hf.call(this, [new Gf([new kf("", null)])]), this.first = c, this.scrollTop = this.scrollLeft = 0, this.cantEdit = !1, this.cleanGeneration = 1, this.frontier = c;
        var d = nb(c, 0);
        this.sel = vb(d), this.history = new Wf(null), this.id = ++If, this.modeOption = b, "string" == typeof a && (a = ph(a)), Ff(this, {
            from: d,
            to: d,
            text: a
        }), Ib(this, vb(d), Bg)
    };
    Jf.prototype = Ng(Hf.prototype, {
        constructor: Jf, iter: function (a, b, c) {
            c ? this.iterN(a - this.first, b - a, c) : this.iterN(this.first, this.first + this.size, a)
        }, insert: function (a, b) {
            for (var c = 0, d = 0; d < b.length; ++d)c += b[d].height;
            this.insertInner(a - this.first, b, c)
        }, remove: function (a, b) {
            this.removeInner(a - this.first, b)
        }, getValue: function (a) {
            var b = Qf(this, this.first, this.first + this.size);
            return a === !1 ? b : b.join(a || "\n")
        }, setValue: Mc(function (a) {
            var b = nb(this.first, 0), c = this.first + this.size - 1;
            Qd(this, {
                from: b,
                to: nb(c, Of(this, c).text.length),
                text: ph(a),
                origin: "setValue"
            }, !0), Ib(this, vb(b))
        }), replaceRange: function (a, b, c, d) {
            b = xb(this, b), c = c ? xb(this, c) : b, Wd(this, a, b, c, d)
        }, getRange: function (a, b, c) {
            var d = Pf(this, xb(this, a), xb(this, b));
            return c === !1 ? d : d.join(c || "\n")
        }, getLine: function (a) {
            var b = this.getLineHandle(a);
            return b && b.text
        }, getLineHandle: function (a) {
            return zb(this, a) ? Of(this, a) : void 0
        }, getLineNumber: function (a) {
            return Sf(a)
        }, getLineHandleVisualStart: function (a) {
            return "number" == typeof a && (a = Of(this, a)), _e(a)
        }, lineCount: function () {
            return this.size
        }, firstLine: function () {
            return this.first
        }, lastLine: function () {
            return this.first + this.size - 1
        }, clipPos: function (a) {
            return xb(this, a)
        }, getCursor: function (a) {
            var c, b = this.sel.primary();
            return c = null == a || "head" == a ? b.head : "anchor" == a ? b.anchor : "end" == a || "to" == a || a === !1 ? b.to() : b.from()
        }, listSelections: function () {
            return this.sel.ranges
        }, somethingSelected: function () {
            return this.sel.somethingSelected()
        }, setCursor: Mc(function (a, b, c) {
            Fb(this, xb(this, "number" == typeof a ? nb(a, b || 0) : a), null, c)
        }), setSelection: Mc(function (a, b, c) {
            Fb(this, xb(this, a), xb(this, b || a), c)
        }), extendSelection: Mc(function (a, b, c) {
            Cb(this, xb(this, a), b && xb(this, b), c)
        }), extendSelections: Mc(function (a, b) {
            Db(this, Ab(this, a, b))
        }), extendSelectionsBy: Mc(function (a, b) {
            Db(this, Mg(this.sel.ranges, a), b)
        }), setSelections: Mc(function (a, b, c) {
            if (a.length) {
                for (var d = 0, e = []; d < a.length; d++)e[d] = new tb(xb(this, a[d].anchor), xb(this, a[d].head));
                null == b && (b = Math.min(a.length - 1, this.sel.primIndex)), Ib(this, ub(e, b), c)
            }
        }), addSelection: Mc(function (a, b, c) {
            var d = this.sel.ranges.slice(0);
            d.push(new tb(xb(this, a), xb(this, b || a))), Ib(this, ub(d, d.length - 1), c)
        }), getSelection: function (a) {
            for (var c, b = this.sel.ranges, d = 0; d < b.length; d++) {
                var e = Pf(this, b[d].from(), b[d].to());
                c = c ? c.concat(e) : e
            }
            return a === !1 ? c : c.join(a || "\n")
        }, getSelections: function (a) {
            for (var b = [], c = this.sel.ranges, d = 0; d < c.length; d++) {
                var e = Pf(this, c[d].from(), c[d].to());
                a !== !1 && (e = e.join(a || "\n")), b[d] = e
            }
            return b
        }, replaceSelection: function (a, b, c) {
            for (var d = [], e = 0; e < this.sel.ranges.length; e++)d[e] = a;
            this.replaceSelections(d, b, c || "+input")
        }, replaceSelections: Mc(function (a, b, c) {
            for (var d = [], e = this.sel, f = 0; f < e.ranges.length; f++) {
                var g = e.ranges[f];
                d[f] = {from: g.from(), to: g.to(), text: ph(a[f]), origin: c}
            }
            for (var h = b && "end" != b && Od(this, d, b), f = d.length - 1; f >= 0; f--)Qd(this, d[f]);
            h ? Hb(this, h) : this.cm && ae(this.cm)
        }), undo: Mc(function () {
            Sd(this, "undo")
        }), redo: Mc(function () {
            Sd(this, "redo")
        }), undoSelection: Mc(function () {
            Sd(this, "undo", !0)
        }), redoSelection: Mc(function () {
            Sd(this, "redo", !0)
        }), setExtending: function (a) {
            this.extend = a
        }, getExtending: function () {
            return this.extend
        }, historySize: function () {
            for (var a = this.history, b = 0, c = 0, d = 0; d < a.done.length; d++)a.done[d].ranges || ++b;
            for (var d = 0; d < a.undone.length; d++)a.undone[d].ranges || ++c;
            return {undo: b, redo: c}
        }, clearHistory: function () {
            this.history = new Wf(this.history.maxGeneration)
        }, markClean: function () {
            this.cleanGeneration = this.changeGeneration(!0)
        }, changeGeneration: function (a) {
            return a && (this.history.lastOp = this.history.lastOrigin = null), this.history.generation
        }, isClean: function (a) {
            return this.history.generation == (a || this.cleanGeneration)
        }, getHistory: function () {
            return {done: fg(this.history.done), undone: fg(this.history.undone)}
        }, setHistory: function (a) {
            var b = this.history = new Wf(this.history.maxGeneration);
            b.done = fg(a.done.slice(0), null, !0), b.undone = fg(a.undone.slice(0), null, !0)
        }, addLineClass: Mc(function (a, b, c) {
            return de(this, a, "class", function (a) {
                var d = "text" == b ? "textClass" : "background" == b ? "bgClass" : "wrapClass";
                if (a[d]) {
                    if (new RegExp("(?:^|\\s)" + c + "(?:$|\\s)").test(a[d]))return !1;
                    a[d] += " " + c
                } else a[d] = c;
                return !0
            })
        }), removeLineClass: Mc(function (a, b, c) {
            return de(this, a, "class", function (a) {
                var d = "text" == b ? "textClass" : "background" == b ? "bgClass" : "wrapClass", e = a[d];
                if (!e)return !1;
                if (null == c)a[d] = null; else {
                    var f = e.match(new RegExp("(?:^|\\s+)" + c + "(?:$|\\s+)"));
                    if (!f)return !1;
                    var g = f.index + f[0].length;
                    a[d] = e.slice(0, f.index) + (f.index && g != e.length ? " " : "") + e.slice(g) || null
                }
                return !0
            })
        }), markText: function (a, b, c) {
            return Ce(this, xb(this, a), xb(this, b), c, "range")
        }, setBookmark: function (a, b) {
            var c = {
                replacedWith: b && (null == b.nodeType ? b.widget : b),
                insertLeft: b && b.insertLeft,
                clearWhenEmpty: !1,
                shared: b && b.shared
            };
            return a = xb(this, a), Ce(this, a, a, c, "bookmark")
        }, findMarksAt: function (a) {
            a = xb(this, a);
            var b = [], c = Of(this, a.line).markedSpans;
            if (c)for (var d = 0; d < c.length; ++d) {
                var e = c[d];
                (null == e.from || e.from <= a.ch) && (null == e.to || e.to >= a.ch) && b.push(e.marker.parent || e.marker)
            }
            return b
        }, findMarks: function (a, b, c) {
            a = xb(this, a), b = xb(this, b);
            var d = [], e = a.line;
            return this.iter(a.line, b.line + 1, function (f) {
                var g = f.markedSpans;
                if (g)for (var h = 0; h < g.length; h++) {
                    var i = g[h];
                    e == a.line && a.ch > i.to || null == i.from && e != a.line || e == b.line && i.from > b.ch || c && !c(i.marker) || d.push(i.marker.parent || i.marker)
                }
                ++e
            }), d
        }, getAllMarks: function () {
            var a = [];
            return this.iter(function (b) {
                var c = b.markedSpans;
                if (c)for (var d = 0; d < c.length; ++d)null != c[d].from && a.push(c[d].marker)
            }), a
        }, posFromIndex: function (a) {
            var b, c = this.first;
            return this.iter(function (d) {
                var e = d.text.length + 1;
                return e > a ? (b = a, !0) : (a -= e, ++c, void 0)
            }), xb(this, nb(c, b))
        }, indexFromPos: function (a) {
            a = xb(this, a);
            var b = a.ch;
            return a.line < this.first || a.ch < 0 ? 0 : (this.iter(this.first, a.line, function (a) {
                b += a.text.length + 1
            }), b)
        }, copy: function (a) {
            var b = new Jf(Qf(this, this.first, this.first + this.size), this.modeOption, this.first);
            return b.scrollTop = this.scrollTop, b.scrollLeft = this.scrollLeft, b.sel = this.sel, b.extend = !1, a && (b.history.undoDepth = this.history.undoDepth, b.setHistory(this.getHistory())), b
        }, linkedDoc: function (a) {
            a || (a = {});
            var b = this.first, c = this.first + this.size;
            null != a.from && a.from > b && (b = a.from), null != a.to && a.to < c && (c = a.to);
            var d = new Jf(Qf(this, b, c), a.mode || this.modeOption, b);
            return a.sharedHist && (d.history = this.history), (this.linked || (this.linked = [])).push({
                doc: d,
                sharedHist: a.sharedHist
            }), d.linked = [{doc: this, isParent: !0, sharedHist: a.sharedHist}], Ge(d, Fe(this)), d
        }, unlinkDoc: function (a) {
            if (a instanceof w && (a = a.doc), this.linked)for (var b = 0; b < this.linked.length; ++b) {
                var c = this.linked[b];
                if (c.doc == a) {
                    this.linked.splice(b, 1), a.unlinkDoc(this), He(Fe(this));
                    break
                }
            }
            if (a.history == this.history) {
                var d = [a.id];
                Mf(a, function (a) {
                    d.push(a.id)
                }, !0), a.history = new Wf(null), a.history.done = fg(this.history.done, d), a.history.undone = fg(this.history.undone, d)
            }
        }, iterLinkedDocs: function (a) {
            Mf(this, a)
        }, getMode: function () {
            return this.mode
        }, getEditor: function () {
            return this.cm
        }
    }), Jf.prototype.eachLine = Jf.prototype.iter;
    var Kf = "iter insert remove copy getEditor".split(" ");
    for (var Lf in Jf.prototype)Jf.prototype.hasOwnProperty(Lf) && Lg(Kf, Lf) < 0 && (w.prototype[Lf] = function (a) {
        return function () {
            return a.apply(this.doc, arguments)
        }
    }(Jf.prototype[Lf]));
    yg(Jf);
    var jg = w.e_preventDefault = function (a) {
        a.preventDefault ? a.preventDefault() : a.returnValue = !1
    }, kg = w.e_stopPropagation = function (a) {
        a.stopPropagation ? a.stopPropagation() : a.cancelBubble = !0
    }, mg = w.e_stop = function (a) {
        jg(a), kg(a)
    }, pg = w.on = function (a, b, c) {
        if (a.addEventListener)a.addEventListener(b, c, !1); else if (a.attachEvent)a.attachEvent("on" + b, c); else {
            var d = a._handlers || (a._handlers = {}), e = d[b] || (d[b] = []);
            e.push(c)
        }
    }, qg = w.off = function (a, b, c) {
        if (a.removeEventListener)a.removeEventListener(b, c, !1); else if (a.detachEvent)a.detachEvent("on" + b, c); else {
            var d = a._handlers && a._handlers[b];
            if (!d)return;
            for (var e = 0; e < d.length; ++e)if (d[e] == c) {
                d.splice(e, 1);
                break
            }
        }
    }, rg = w.signal = function (a, b) {
        var c = a._handlers && a._handlers[b];
        if (c)for (var d = Array.prototype.slice.call(arguments, 2), e = 0; e < c.length; ++e)c[e].apply(null, d)
    }, sg = null, zg = 30, Ag = w.Pass = {
        toString: function () {
            return "CodeMirror.Pass"
        }
    }, Bg = {scroll: !1}, Cg = {origin: "*mouse"}, Dg = {origin: "+move"};
    Eg.prototype.set = function (a, b) {
        clearTimeout(this.id), this.id = setTimeout(b, a)
    };
    var Fg = w.countColumn = function (a, b, c, d, e) {
        null == b && (b = a.search(/[^\s\u00a0]/), -1 == b && (b = a.length));
        for (var f = d || 0, g = e || 0; ;) {
            var h = a.indexOf("	", f);
            if (0 > h || h >= b)return g + (b - f);
            g += h - f, g += c - g % c, f = h + 1
        }
    }, Hg = [""], Kg = function (a) {
        a.select()
    };
    n ? Kg = function (a) {
        a.selectionStart = 0, a.selectionEnd = a.value.length
    } : d && (Kg = function (a) {
        try {
            a.select()
        } catch (b) {
        }
    }), [].indexOf && (Lg = function (a, b) {
        return a.indexOf(b)
    }), [].map && (Mg = function (a, b) {
        return a.map(b)
    });
    var Xg, Qg = /[\u00df\u3040-\u309f\u30a0-\u30ff\u3400-\u4db5\u4e00-\u9fcc\uac00-\ud7af]/, Rg = w.isWordChar = function (a) {
        return /\w/.test(a) || a > "\x80" && (a.toUpperCase() != a.toLowerCase() || Qg.test(a))
    }, Ug = /[\u0300-\u036f\u0483-\u0489\u0591-\u05bd\u05bf\u05c1\u05c2\u05c4\u05c5\u05c7\u0610-\u061a\u064b-\u065e\u0670\u06d6-\u06dc\u06de-\u06e4\u06e7\u06e8\u06ea-\u06ed\u0711\u0730-\u074a\u07a6-\u07b0\u07eb-\u07f3\u0816-\u0819\u081b-\u0823\u0825-\u0827\u0829-\u082d\u0900-\u0902\u093c\u0941-\u0948\u094d\u0951-\u0955\u0962\u0963\u0981\u09bc\u09be\u09c1-\u09c4\u09cd\u09d7\u09e2\u09e3\u0a01\u0a02\u0a3c\u0a41\u0a42\u0a47\u0a48\u0a4b-\u0a4d\u0a51\u0a70\u0a71\u0a75\u0a81\u0a82\u0abc\u0ac1-\u0ac5\u0ac7\u0ac8\u0acd\u0ae2\u0ae3\u0b01\u0b3c\u0b3e\u0b3f\u0b41-\u0b44\u0b4d\u0b56\u0b57\u0b62\u0b63\u0b82\u0bbe\u0bc0\u0bcd\u0bd7\u0c3e-\u0c40\u0c46-\u0c48\u0c4a-\u0c4d\u0c55\u0c56\u0c62\u0c63\u0cbc\u0cbf\u0cc2\u0cc6\u0ccc\u0ccd\u0cd5\u0cd6\u0ce2\u0ce3\u0d3e\u0d41-\u0d44\u0d4d\u0d57\u0d62\u0d63\u0dca\u0dcf\u0dd2-\u0dd4\u0dd6\u0ddf\u0e31\u0e34-\u0e3a\u0e47-\u0e4e\u0eb1\u0eb4-\u0eb9\u0ebb\u0ebc\u0ec8-\u0ecd\u0f18\u0f19\u0f35\u0f37\u0f39\u0f71-\u0f7e\u0f80-\u0f84\u0f86\u0f87\u0f90-\u0f97\u0f99-\u0fbc\u0fc6\u102d-\u1030\u1032-\u1037\u1039\u103a\u103d\u103e\u1058\u1059\u105e-\u1060\u1071-\u1074\u1082\u1085\u1086\u108d\u109d\u135f\u1712-\u1714\u1732-\u1734\u1752\u1753\u1772\u1773\u17b7-\u17bd\u17c6\u17c9-\u17d3\u17dd\u180b-\u180d\u18a9\u1920-\u1922\u1927\u1928\u1932\u1939-\u193b\u1a17\u1a18\u1a56\u1a58-\u1a5e\u1a60\u1a62\u1a65-\u1a6c\u1a73-\u1a7c\u1a7f\u1b00-\u1b03\u1b34\u1b36-\u1b3a\u1b3c\u1b42\u1b6b-\u1b73\u1b80\u1b81\u1ba2-\u1ba5\u1ba8\u1ba9\u1c2c-\u1c33\u1c36\u1c37\u1cd0-\u1cd2\u1cd4-\u1ce0\u1ce2-\u1ce8\u1ced\u1dc0-\u1de6\u1dfd-\u1dff\u200c\u200d\u20d0-\u20f0\u2cef-\u2cf1\u2de0-\u2dff\u302a-\u302f\u3099\u309a\ua66f-\ua672\ua67c\ua67d\ua6f0\ua6f1\ua802\ua806\ua80b\ua825\ua826\ua8c4\ua8e0-\ua8f1\ua926-\ua92d\ua947-\ua951\ua980-\ua982\ua9b3\ua9b6-\ua9b9\ua9bc\uaa29-\uaa2e\uaa31\uaa32\uaa35\uaa36\uaa43\uaa4c\uaab0\uaab2-\uaab4\uaab7\uaab8\uaabe\uaabf\uaac1\uabe5\uabe8\uabed\udc00-\udfff\ufb1e\ufe00-\ufe0f\ufe20-\ufe26\uff9e\uff9f]/;
    Xg = document.createRange ? function (a, b, c) {
        var d = document.createRange();
        return d.setEnd(a, c), d.setStart(a, b), d
    } : function (a, b, c) {
        var d = document.body.createTextRange();
        return d.moveToElementText(a.parentNode), d.collapse(!0), d.moveEnd("character", c), d.moveStart("character", b), d
    }, d && 11 > e && (_g = function () {
        try {
            return document.activeElement
        } catch (a) {
            return document.body
        }
    });
    var jh, lh, nh, fh = !1, ih = function () {
        if (d && 9 > e)return !1;
        var a = Wg("div");
        return "draggable"in a || "dragDrop"in a
    }(), ph = w.splitLines = 3 != "\n\nb".split(/\n/).length ? function (a) {
        for (var b = 0, c = [], d = a.length; d >= b;) {
            var e = a.indexOf("\n", b);
            -1 == e && (e = a.length);
            var f = a.slice(b, "\r" == a.charAt(e - 1) ? e - 1 : e), g = f.indexOf("\r");
            -1 != g ? (c.push(f.slice(0, g)), b += g + 1) : (c.push(f), b = e + 1)
        }
        return c
    } : function (a) {
        return a.split(/\r\n?|\n/)
    }, qh = window.getSelection ? function (a) {
        try {
            return a.selectionStart != a.selectionEnd
        } catch (b) {
            return !1
        }
    } : function (a) {
        try {
            var b = a.ownerDocument.selection.createRange()
        } catch (c) {
        }
        return b && b.parentElement() == a ? 0 != b.compareEndPoints("StartToEnd", b) : !1
    }, rh = function () {
        var a = Wg("div");
        return "oncopy"in a ? !0 : (a.setAttribute("oncopy", "return;"), "function" == typeof a.oncopy)
    }(), sh = null, uh = {
        3: "Enter",
        8: "Backspace",
        9: "Tab",
        13: "Enter",
        16: "Shift",
        17: "Ctrl",
        18: "Alt",
        19: "Pause",
        20: "CapsLock",
        27: "Esc",
        32: "Space",
        33: "PageUp",
        34: "PageDown",
        35: "End",
        36: "Home",
        37: "Left",
        38: "Up",
        39: "Right",
        40: "Down",
        44: "PrintScrn",
        45: "Insert",
        46: "Delete",
        59: ";",
        61: "=",
        91: "Mod",
        92: "Mod",
        93: "Mod",
        107: "=",
        109: "-",
        127: "Delete",
        173: "-",
        186: ";",
        187: "=",
        188: ",",
        189: "-",
        190: ".",
        191: "/",
        192: "`",
        219: "[",
        220: "\\",
        221: "]",
        222: "'",
        63232: "Up",
        63233: "Down",
        63234: "Left",
        63235: "Right",
        63272: "Delete",
        63273: "Home",
        63275: "End",
        63276: "PageUp",
        63277: "PageDown",
        63302: "Insert"
    };
    w.keyNames = uh, function () {
        for (var a = 0; 10 > a; a++)uh[a + 48] = uh[a + 96] = String(a);
        for (var a = 65; 90 >= a; a++)uh[a] = String.fromCharCode(a);
        for (var a = 1; 12 >= a; a++)uh[a + 111] = uh[a + 63235] = "F" + a
    }();
    var Dh, Ih = function () {
        function c(c) {
            return 247 >= c ? a.charAt(c) : c >= 1424 && 1524 >= c ? "R" : c >= 1536 && 1773 >= c ? b.charAt(c - 1536) : c >= 1774 && 2220 >= c ? "r" : c >= 8192 && 8203 >= c ? "w" : 8204 == c ? "b" : "L"
        }

        function j(a, b, c) {
            this.level = a, this.from = b, this.to = c
        }

        var a = "bbbbbbbbbtstwsbbbbbbbbbbbbbbssstwNN%%%NNNNNN,N,N1111111111NNNNNNNLLLLLLLLLLLLLLLLLLLLLLLLLLNNNNNNLLLLLLLLLLLLLLLLLLLLLLLLLLNNNNbbbbbbsbbbbbbbbbbbbbbbbbbbbbbbbbb,N%%%%NNNNLNNNNN%%11NLNNN1LNNNNNLLLLLLLLLLLLLLLLLLLLLLLNLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLN", b = "rrrrrrrrrrrr,rNNmmmmmmrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrmmmmmmmmmmmmmmrrrrrrrnnnnnnnnnn%nnrrrmrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrmmmmmmmmmmmmmmmmmmmNmmmm", d = /[\u0590-\u05f4\u0600-\u06ff\u0700-\u08ac]/, e = /[stwN]/, f = /[LRr]/, g = /[Lb1n]/, h = /[1n]/, i = "L";
        return function (a) {
            if (!d.test(a))return !1;
            for (var m, b = a.length, k = [], l = 0; b > l; ++l)k.push(m = c(a.charCodeAt(l)));
            for (var l = 0, n = i; b > l; ++l) {
                var m = k[l];
                "m" == m ? k[l] = n : n = m
            }
            for (var l = 0, o = i; b > l; ++l) {
                var m = k[l];
                "1" == m && "r" == o ? k[l] = "n" : f.test(m) && (o = m, "r" == m && (k[l] = "R"))
            }
            for (var l = 1, n = k[0]; b - 1 > l; ++l) {
                var m = k[l];
                "+" == m && "1" == n && "1" == k[l + 1] ? k[l] = "1" : "," != m || n != k[l + 1] || "1" != n && "n" != n || (k[l] = n), n = m
            }
            for (var l = 0; b > l; ++l) {
                var m = k[l];
                if ("," == m)k[l] = "N"; else if ("%" == m) {
                    for (var p = l + 1; b > p && "%" == k[p]; ++p);
                    for (var q = l && "!" == k[l - 1] || b > p && "1" == k[p] ? "1" : "N", r = l; p > r; ++r)k[r] = q;
                    l = p - 1
                }
            }
            for (var l = 0, o = i; b > l; ++l) {
                var m = k[l];
                "L" == o && "1" == m ? k[l] = "L" : f.test(m) && (o = m)
            }
            for (var l = 0; b > l; ++l)if (e.test(k[l])) {
                for (var p = l + 1; b > p && e.test(k[p]); ++p);
                for (var s = "L" == (l ? k[l - 1] : i), t = "L" == (b > p ? k[p] : i), q = s || t ? "L" : "R", r = l; p > r; ++r)k[r] = q;
                l = p - 1
            }
            for (var v, u = [], l = 0; b > l;)if (g.test(k[l])) {
                var w = l;
                for (++l; b > l && g.test(k[l]); ++l);
                u.push(new j(0, w, l))
            } else {
                var x = l, y = u.length;
                for (++l; b > l && "L" != k[l]; ++l);
                for (var r = x; l > r;)if (h.test(k[r])) {
                    r > x && u.splice(y, 0, new j(1, x, r));
                    var z = r;
                    for (++r; l > r && h.test(k[r]); ++r);
                    u.splice(y, 0, new j(2, z, r)), x = r
                } else++r;
                l > x && u.splice(y, 0, new j(1, x, l))
            }
            return 1 == u[0].level && (v = a.match(/^\s+/)) && (u[0].from = v[0].length, u.unshift(new j(0, 0, v[0].length))), 1 == Jg(u).level && (v = a.match(/\s+$/)) && (Jg(u).to -= v[0].length, u.push(new j(0, b - v[0].length, b))), u[0].level != Jg(u).level && u.push(new j(u[0].level, b, b)), u
        }
    }();
    return w.version = "4.4.0", w
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function b(a) {
        for (var b = {}, c = a.split(" "), d = 0; d < c.length; ++d)b[c[d]] = !0;
        return b
    }

    function d(a, b) {
        if (!b.startOfLine)return !1;
        for (; ;) {
            if (!a.skipTo("\\")) {
                a.skipToEnd(), b.tokenize = null;
                break
            }
            if (a.next(), a.eol()) {
                b.tokenize = d;
                break
            }
        }
        return "meta"
    }

    function e(a, b) {
        if (a.backUp(1), a.match(/(R|u8R|uR|UR|LR)/)) {
            var c = a.match(/"([^\s\\()]{0,16})\(/);
            return c ? (b.cpp11RawStringDelim = c[1], b.tokenize = g, g(a, b)) : !1
        }
        return a.match(/(u8|u|U|L)/) ? a.match(/["']/, !1) ? "string" : !1 : (a.next(), !1)
    }

    function f(a, b) {
        for (var c; null != (c = a.next());)if ('"' == c && !a.eat('"')) {
            b.tokenize = null;
            break
        }
        return "string"
    }

    function g(a, b) {
        var c = b.cpp11RawStringDelim.replace(/[^\w\s]/g, "\\$&"), d = a.match(new RegExp(".*?\\)" + c + '"'));
        return d ? b.tokenize = null : a.skipToEnd(), "string"
    }

    function h(b, c) {
        function e(a) {
            if (a)for (var b in a)a.hasOwnProperty(b) && d.push(b)
        }

        "string" == typeof b && (b = [b]);
        var d = [];
        e(c.keywords), e(c.builtin), e(c.atoms), d.length && (c.helperType = b[0], a.registerHelper("hintWords", b[0], d));
        for (var f = 0; f < b.length; ++f)a.defineMIME(b[f], c)
    }

    a.defineMode("clike", function (b, c) {
        function o(a, b) {
            var c = a.next();
            if (k[c]) {
                var d = k[c](a, b);
                if (d !== !1)return d
            }
            if ('"' == c || "'" == c)return b.tokenize = p(c), b.tokenize(a, b);
            if (/[\[\]{}\(\),;\:\.]/.test(c))return n = c, null;
            if (/\d/.test(c))return a.eatWhile(/[\w\.]/), "number";
            if ("/" == c) {
                if (a.eat("*"))return b.tokenize = q, q(a, b);
                if (a.eat("/"))return a.skipToEnd(), "comment"
            }
            if (m.test(c))return a.eatWhile(m), "operator";
            a.eatWhile(/[\w\$_]/);
            var e = a.current();
            return g.propertyIsEnumerable(e) ? (i.propertyIsEnumerable(e) && (n = "newstatement"), "keyword") : h.propertyIsEnumerable(e) ? (i.propertyIsEnumerable(e) && (n = "newstatement"), "builtin") : j.propertyIsEnumerable(e) ? "atom" : "variable"
        }

        function p(a) {
            return function (b, c) {
                for (var e, d = !1, f = !1; null != (e = b.next());) {
                    if (e == a && !d) {
                        f = !0;
                        break
                    }
                    d = !d && "\\" == e
                }
                return (f || !d && !l) && (c.tokenize = null), "string"
            }
        }

        function q(a, b) {
            for (var d, c = !1; d = a.next();) {
                if ("/" == d && c) {
                    b.tokenize = null;
                    break
                }
                c = "*" == d
            }
            return "comment"
        }

        function r(a, b, c, d, e) {
            this.indented = a, this.column = b, this.type = c, this.align = d, this.prev = e
        }

        function s(a, b, c) {
            var d = a.indented;
            return a.context && "statement" == a.context.type && (d = a.context.indented), a.context = new r(d, b, c, null, a.context)
        }

        function t(a) {
            var b = a.context.type;
            return (")" == b || "]" == b || "}" == b) && (a.indented = a.context.indented), a.context = a.context.prev
        }

        var n, d = b.indentUnit, e = c.statementIndentUnit || d, f = c.dontAlignCalls, g = c.keywords || {}, h = c.builtin || {}, i = c.blockKeywords || {}, j = c.atoms || {}, k = c.hooks || {}, l = c.multiLineStrings, m = /[+\-*&%=<>!?|\/]/;
        return {
            startState: function (a) {
                return {tokenize: null, context: new r((a || 0) - d, 0, "top", !1), indented: 0, startOfLine: !0}
            }, token: function (a, b) {
                var c = b.context;
                if (a.sol() && (null == c.align && (c.align = !1), b.indented = a.indentation(), b.startOfLine = !0), a.eatSpace())return null;
                n = null;
                var d = (b.tokenize || o)(a, b);
                if ("comment" == d || "meta" == d)return d;
                if (null == c.align && (c.align = !0), ";" != n && ":" != n && "," != n || "statement" != c.type)if ("{" == n)s(b, a.column(), "}"); else if ("[" == n)s(b, a.column(), "]"); else if ("(" == n)s(b, a.column(), ")"); else if ("}" == n) {
                    for (; "statement" == c.type;)c = t(b);
                    for ("}" == c.type && (c = t(b)); "statement" == c.type;)c = t(b)
                } else n == c.type ? t(b) : (("}" == c.type || "top" == c.type) && ";" != n || "statement" == c.type && "newstatement" == n) && s(b, a.column(), "statement"); else t(b);
                return b.startOfLine = !1, d
            }, indent: function (b, c) {
                if (b.tokenize != o && null != b.tokenize)return a.Pass;
                var g = b.context, h = c && c.charAt(0);
                "statement" == g.type && "}" == h && (g = g.prev);
                var i = h == g.type;
                return "statement" == g.type ? g.indented + ("{" == h ? 0 : e) : !g.align || f && ")" == g.type ? ")" != g.type || i ? g.indented + (i ? 0 : d) : g.indented + e : g.column + (i ? 0 : 1)
            }, electricChars: "{}", blockCommentStart: "/*", blockCommentEnd: "*/", lineComment: "//", fold: "brace"
        }
    });
    var c = "auto if break int case long char register continue return default short do sizeof double static else struct entry switch extern typedef float union for unsigned goto while enum void const signed volatile";
    h(["text/x-csrc", "text/x-c", "text/x-chdr"], {
        name: "clike",
        keywords: b(c),
        blockKeywords: b("case do else for if switch while struct"),
        atoms: b("null"),
        hooks: {"#": d},
        modeProps: {fold: ["brace", "include"]}
    }), h(["text/x-c++src", "text/x-c++hdr"], {
        name: "clike",
        keywords: b(c + " asm dynamic_cast namespace reinterpret_cast try bool explicit new " + "static_cast typeid catch operator template typename class friend private " + "this using const_cast inline public throw virtual delete mutable protected " + "wchar_t alignas alignof constexpr decltype nullptr noexcept thread_local final " + "static_assert override"),
        blockKeywords: b("catch class do else finally for if struct switch try while"),
        atoms: b("true false null"),
        hooks: {"#": d, u: e, U: e, L: e, R: e},
        modeProps: {fold: ["brace", "include"]}
    }), h("text/x-java", {
        name: "clike",
        keywords: b("abstract assert boolean break byte case catch char class const continue default do double else enum extends final finally float for goto if implements import instanceof int interface long native new package private protected public return short static strictfp super switch synchronized this throw throws transient try void volatile while"),
        blockKeywords: b("catch class do else finally for if switch try while"),
        atoms: b("true false null"),
        hooks: {
            "@": function (a) {
                return a.eatWhile(/[\w\$_]/), "meta"
            }
        },
        modeProps: {fold: ["brace", "import"]}
    }), h("text/x-csharp", {
        name: "clike",
        keywords: b("abstract as base break case catch checked class const continue default delegate do else enum event explicit extern finally fixed for foreach goto if implicit in interface internal is lock namespace new operator out override params private protected public readonly ref return sealed sizeof stackalloc static struct switch this throw try typeof unchecked unsafe using virtual void volatile while add alias ascending descending dynamic from get global group into join let orderby partial remove select set value var yield"),
        blockKeywords: b("catch class do else finally for foreach if struct switch try while"),
        builtin: b("Boolean Byte Char DateTime DateTimeOffset Decimal Double Guid Int16 Int32 Int64 Object SByte Single String TimeSpan UInt16 UInt32 UInt64 bool byte char decimal double short int long object sbyte float string ushort uint ulong"),
        atoms: b("true false null"),
        hooks: {
            "@": function (a, b) {
                return a.eat('"') ? (b.tokenize = f, f(a, b)) : (a.eatWhile(/[\w\$_]/), "meta")
            }
        }
    }), h("text/x-scala", {
        name: "clike",
        keywords: b("abstract case catch class def do else extends false final finally for forSome if implicit import lazy match new null object override package private protected return sealed super this throw trait try trye type val var while with yield _ : = => <- <: <% >: # @ assert assume require print println printf readLine readBoolean readByte readShort readChar readInt readLong readFloat readDouble AnyVal App Application Array BufferedIterator BigDecimal BigInt Char Console Either Enumeration Equiv Error Exception Fractional Function IndexedSeq Integral Iterable Iterator List Map Numeric Nil NotNull Option Ordered Ordering PartialFunction PartialOrdering Product Proxy Range Responder Seq Serializable Set Specializable Stream StringBuilder StringContext Symbol Throwable Traversable TraversableOnce Tuple Unit Vector :: #:: Boolean Byte Character CharSequence Class ClassLoader Cloneable Comparable Compiler Double Exception Float Integer Long Math Number Object Package Pair Process Runtime Runnable SecurityManager Short StackTraceElement StrictMath String StringBuffer System Thread ThreadGroup ThreadLocal Throwable Triple Void"),
        multiLineStrings: !0,
        blockKeywords: b("catch class do else finally for forSome if match switch try while"),
        atoms: b("true false null"),
        hooks: {
            "@": function (a) {
                return a.eatWhile(/[\w\$_]/), "meta"
            }
        }
    }), h(["x-shader/x-vertex", "x-shader/x-fragment"], {
        name: "clike",
        keywords: b("float int bool void vec2 vec3 vec4 ivec2 ivec3 ivec4 bvec2 bvec3 bvec4 mat2 mat3 mat4 sampler1D sampler2D sampler3D samplerCube sampler1DShadow sampler2DShadowconst attribute uniform varying break continue discard return for while do if else struct in out inout"),
        blockKeywords: b("for while do if else struct"),
        builtin: b("radians degrees sin cos tan asin acos atan pow exp log exp2 sqrt inversesqrt abs sign floor ceil fract mod min max clamp mix step smootstep length distance dot cross normalize ftransform faceforward reflect refract matrixCompMult lessThan lessThanEqual greaterThan greaterThanEqual equal notEqual any all not texture1D texture1DProj texture1DLod texture1DProjLod texture2D texture2DProj texture2DLod texture2DProjLod texture3D texture3DProj texture3DLod texture3DProjLod textureCube textureCubeLod shadow1D shadow2D shadow1DProj shadow2DProj shadow1DLod shadow2DLod shadow1DProjLod shadow2DProjLod dFdx dFdy fwidth noise1 noise2 noise3 noise4"),
        atoms: b("true false gl_FragColor gl_SecondaryColor gl_Normal gl_Vertex gl_MultiTexCoord0 gl_MultiTexCoord1 gl_MultiTexCoord2 gl_MultiTexCoord3 gl_MultiTexCoord4 gl_MultiTexCoord5 gl_MultiTexCoord6 gl_MultiTexCoord7 gl_FogCoord gl_Position gl_PointSize gl_ClipVertex gl_FrontColor gl_BackColor gl_FrontSecondaryColor gl_BackSecondaryColor gl_TexCoord gl_FogFragCoord gl_FragCoord gl_FrontFacing gl_FragColor gl_FragData gl_FragDepth gl_ModelViewMatrix gl_ProjectionMatrix gl_ModelViewProjectionMatrix gl_TextureMatrix gl_NormalMatrix gl_ModelViewMatrixInverse gl_ProjectionMatrixInverse gl_ModelViewProjectionMatrixInverse gl_TexureMatrixTranspose gl_ModelViewMatrixInverseTranspose gl_ProjectionMatrixInverseTranspose gl_ModelViewProjectionMatrixInverseTranspose gl_TextureMatrixInverseTranspose gl_NormalScale gl_DepthRange gl_ClipPlane gl_Point gl_FrontMaterial gl_BackMaterial gl_LightSource gl_LightModel gl_FrontLightModelProduct gl_BackLightModelProduct gl_TextureColor gl_EyePlaneS gl_EyePlaneT gl_EyePlaneR gl_EyePlaneQ gl_FogParameters gl_MaxLights gl_MaxClipPlanes gl_MaxTextureUnits gl_MaxTextureCoords gl_MaxVertexAttribs gl_MaxVertexUniformComponents gl_MaxVaryingFloats gl_MaxVertexTextureImageUnits gl_MaxTextureImageUnits gl_MaxFragmentUniformComponents gl_MaxCombineTextureImageUnits gl_MaxDrawBuffers"),
        hooks: {"#": d},
        modeProps: {fold: ["brace", "include"]}
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("coffeescript", function (a) {
        function c(a) {
            return new RegExp("^((" + a.join(")|(") + "))\\b")
        }

        function p(a, c) {
            if (a.sol()) {
                null === c.scope.align && (c.scope.align = !1);
                var i = c.scope.offset;
                if (a.eatSpace()) {
                    var j = a.indentation();
                    return j > i && "coffee" == c.scope.type ? "indent" : i > j ? "dedent" : null
                }
                i > 0 && t(a, c)
            }
            if (a.eatSpace())return null;
            var n = a.peek();
            if (a.match("####"))return a.skipToEnd(), "comment";
            if (a.match("###"))return c.tokenize = r, c.tokenize(a, c);
            if ("#" === n)return a.skipToEnd(), "comment";
            if (a.match(/^-?[0-9\.]/, !1)) {
                var p = !1;
                if (a.match(/^-?\d*\.\d+(e[\+\-]?\d+)?/i) && (p = !0), a.match(/^-?\d+\.\d*/) && (p = !0), a.match(/^-?\.\d+/) && (p = !0), p)return "." == a.peek() && a.backUp(1), "number";
                var s = !1;
                if (a.match(/^-?0x[0-9a-f]+/i) && (s = !0), a.match(/^-?[1-9]\d*(e[\+\-]?\d+)?/) && (s = !0), a.match(/^-?0(?![\dx])/i) && (s = !0), s)return "number"
            }
            if (a.match(l))return c.tokenize = q(a.current(), !1, "string"), c.tokenize(a, c);
            if (a.match(m)) {
                if ("/" != a.current() || a.match(/^.*\//, !1))return c.tokenize = q(a.current(), !0, "string-2"), c.tokenize(a, c);
                a.backUp(1)
            }
            return a.match(d) || a.match(h) ? "operator" : a.match(e) ? "punctuation" : a.match(o) ? "atom" : a.match(k) ? "keyword" : a.match(f) ? "variable" : a.match(g) ? "property" : (a.next(), b)
        }

        function q(c, d, e) {
            return function (f, g) {
                for (; !f.eol();)if (f.eatWhile(/[^'"\/\\]/), f.eat("\\")) {
                    if (f.next(), d && f.eol())return e
                } else {
                    if (f.match(c))return g.tokenize = p, e;
                    f.eat(/['"\/]/)
                }
                return d && (a.mode.singleLineStringErrors ? e = b : g.tokenize = p), e
            }
        }

        function r(a, b) {
            for (; !a.eol();) {
                if (a.eatWhile(/[^#]/), a.match("###")) {
                    b.tokenize = p;
                    break
                }
                a.eatWhile("#")
            }
            return "comment"
        }

        function s(b, c, d) {
            d = d || "coffee";
            for (var e = 0, f = !1, g = null, h = c.scope; h; h = h.prev)if ("coffee" === h.type) {
                e = h.offset + a.indentUnit;
                break
            }
            "coffee" !== d ? (f = null, g = b.column() + b.current().length) : c.scope.align && (c.scope.align = !1), c.scope = {
                offset: e,
                type: d,
                prev: c.scope,
                align: f,
                alignOffset: g
            }
        }

        function t(a, b) {
            if (b.scope.prev) {
                if ("coffee" === b.scope.type) {
                    for (var c = a.indentation(), d = !1, e = b.scope; e; e = e.prev)if (c === e.offset) {
                        d = !0;
                        break
                    }
                    if (!d)return !0;
                    for (; b.scope.prev && b.scope.offset !== c;)b.scope = b.scope.prev;
                    return !1
                }
                return b.scope = b.scope.prev, !1
            }
        }

        function u(a, c) {
            var d = c.tokenize(a, c), e = a.current();
            if ("." === e)return d = c.tokenize(a, c), e = a.current(), /^\.[\w$]+$/.test(e) ? "variable" : b;
            "return" === e && (c.dedent += 1), ("->" !== e && "=>" !== e || c.lambda || a.peek()) && "indent" !== d || s(a, c);
            var f = "[({".indexOf(e);
            if (-1 !== f && s(a, c, "])}".slice(f, f + 1)), i.exec(e) && s(a, c), "then" == e && t(a, c), "dedent" === d && t(a, c))return b;
            if (f = "])}".indexOf(e), -1 !== f) {
                for (; "coffee" == c.scope.type && c.scope.prev;)c.scope = c.scope.prev;
                c.scope.type == e && (c.scope = c.scope.prev)
            }
            return c.dedent > 0 && a.eol() && "coffee" == c.scope.type && (c.scope.prev && (c.scope = c.scope.prev), c.dedent -= 1), d
        }

        var b = "error", d = /^(?:->|=>|\+[+=]?|-[\-=]?|\*[\*=]?|\/[\/=]?|[=!]=|<[><]?=?|>>?=?|%=?|&=?|\|=?|\^=?|\~|!|\?)/, e = /^(?:[()\[\]{},:`=;]|\.\.?\.?)/, f = /^[_A-Za-z$][_A-Za-z$0-9]*/, g = /^(@|this\.)[_A-Za-z$][_A-Za-z$0-9]*/, h = c(["and", "or", "not", "is", "isnt", "in", "instanceof", "typeof"]), i = ["for", "while", "loop", "if", "unless", "else", "switch", "try", "catch", "finally", "class"], j = ["break", "by", "continue", "debugger", "delete", "do", "in", "of", "new", "return", "then", "this", "throw", "when", "until"], k = c(i.concat(j));
        i = c(i);
        var l = /^('{3}|\"{3}|['\"])/, m = /^(\/{3}|\/)/, n = ["Infinity", "NaN", "undefined", "null", "true", "false", "on", "off", "yes", "no"], o = c(n), v = {
            startState: function (a) {
                return {
                    tokenize: p,
                    scope: {offset: a || 0, type: "coffee", prev: null, align: !1},
                    lastToken: null,
                    lambda: !1,
                    dedent: 0
                }
            }, token: function (a, b) {
                var c = null === b.scope.align && b.scope;
                c && a.sol() && (c.align = !1);
                var d = u(a, b);
                return c && d && "comment" != d && (c.align = !0), b.lastToken = {
                    style: d,
                    content: a.current()
                }, a.eol() && a.lambda && (b.lambda = !1), d
            }, indent: function (a, b) {
                if (a.tokenize != p)return 0;
                var c = a.scope, d = b && "])}".indexOf(b.charAt(0)) > -1;
                if (d)for (; "coffee" == c.type && c.prev;)c = c.prev;
                var e = d && c.type === b.charAt(0);
                return c.align ? c.alignOffset - (e ? 1 : 0) : (e ? c.prev : c).offset
            }, lineComment: "#", fold: "indent"
        };
        return v
    }), a.defineMIME("text/x-coffeescript", "coffeescript")
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function b(a) {
        for (var b = {}, c = 0; c < a.length; ++c)b[a[c]] = !0;
        return b
    }

    function r(a, b) {
        for (var d, c = !1; null != (d = a.next());) {
            if (c && "/" == d) {
                b.tokenize = null;
                break
            }
            c = "*" == d
        }
        return ["comment", "comment"]
    }

    function s(a, b) {
        return a.skipTo("-->") ? (a.match("-->"), b.tokenize = null) : a.skipToEnd(), ["comment", "comment"]
    }

    a.defineMode("css", function (b, c) {
        function p(a, b) {
            return n = b, a
        }

        function q(a, b) {
            var c = a.next();
            if (e[c]) {
                var d = e[c](a, b);
                if (d !== !1)return d
            }
            return "@" == c ? (a.eatWhile(/[\w\\\-]/), p("def", a.current())) : "=" == c || ("~" == c || "|" == c) && a.eat("=") ? p(null, "compare") : '"' == c || "'" == c ? (b.tokenize = r(c), b.tokenize(a, b)) : "#" == c ? (a.eatWhile(/[\w\\\-]/), p("atom", "hash")) : "!" == c ? (a.match(/^\s*\w*/), p("keyword", "important")) : /\d/.test(c) || "." == c && a.eat(/\d/) ? (a.eatWhile(/[\w.%]/), p("number", "unit")) : "-" !== c ? /[,+>*\/]/.test(c) ? p(null, "select-op") : "." == c && a.match(/^-?[_a-z][_a-z0-9-]*/i) ? p("qualifier", "qualifier") : /[:;{}\[\]\(\)]/.test(c) ? p(null, c) : "u" == c && a.match("rl(") ? (a.backUp(1), b.tokenize = s, p("property", "word")) : /[\w\\\-]/.test(c) ? (a.eatWhile(/[\w\\\-]/), p("property", "word")) : p(null, null) : /[\d.]/.test(a.peek()) ? (a.eatWhile(/[\w.%]/), p("number", "unit")) : a.match(/^\w+-/) ? p("meta", "meta") : void 0
        }

        function r(a) {
            return function (b, c) {
                for (var e, d = !1; null != (e = b.next());) {
                    if (e == a && !d) {
                        ")" == a && b.backUp(1);
                        break
                    }
                    d = !d && "\\" == e
                }
                return (e == a || !d && ")" != a) && (c.tokenize = null), p("string", "string")
            }
        }

        function s(a, b) {
            return a.next(), b.tokenize = a.match(/\s*[\"\')]/, !1) ? null : r(")"), p(null, "(")
        }

        function t(a, b, c) {
            this.type = a, this.indent = b, this.prev = c
        }

        function u(a, b, c) {
            return a.context = new t(c, b.indentation() + d, a.context), c
        }

        function v(a) {
            return a.context = a.context.prev, a.context.type
        }

        function w(a, b, c) {
            return z[c.context.type](a, b, c)
        }

        function x(a, b, c, d) {
            for (var e = d || 1; e > 0; e--)c.context = c.context.prev;
            return w(a, b, c)
        }

        function y(a) {
            var b = a.current().toLowerCase();
            o = k.hasOwnProperty(b) ? "atom" : j.hasOwnProperty(b) ? "keyword" : "variable"
        }

        c.propertyKeywords || (c = a.resolveMode("text/css"));
        var n, o, d = b.indentUnit, e = c.tokenHooks, f = c.mediaTypes || {}, g = c.mediaFeatures || {}, h = c.propertyKeywords || {}, i = c.nonStandardPropertyKeywords || {}, j = c.colorKeywords || {}, k = c.valueKeywords || {}, l = c.fontProperties || {}, m = c.allowNested, z = {};
        return z.top = function (a, b, c) {
            if ("{" == a)return u(c, b, "block");
            if ("}" == a && c.context.prev)return v(c);
            if ("@media" == a)return u(c, b, "media");
            if ("@font-face" == a)return "font_face_before";
            if (/^@(-(moz|ms|o|webkit)-)?keyframes$/.test(a))return "keyframes";
            if (a && "@" == a.charAt(0))return u(c, b, "at");
            if ("hash" == a)o = "builtin"; else if ("word" == a)o = "tag"; else {
                if ("variable-definition" == a)return "maybeprop";
                if ("interpolation" == a)return u(c, b, "interpolation");
                if (":" == a)return "pseudo";
                if (m && "(" == a)return u(c, b, "parens")
            }
            return c.context.type
        }, z.block = function (a, b, c) {
            if ("word" == a) {
                var d = b.current().toLowerCase();
                return h.hasOwnProperty(d) ? (o = "property", "maybeprop") : i.hasOwnProperty(d) ? (o = "string-2", "maybeprop") : m ? (o = b.match(/^\s*:/, !1) ? "property" : "tag", "block") : (o += " error", "maybeprop")
            }
            return "meta" == a ? "block" : m || "hash" != a && "qualifier" != a ? z.top(a, b, c) : (o = "error", "block")
        }, z.maybeprop = function (a, b, c) {
            return ":" == a ? u(c, b, "prop") : w(a, b, c)
        }, z.prop = function (a, b, c) {
            if (";" == a)return v(c);
            if ("{" == a && m)return u(c, b, "propBlock");
            if ("}" == a || "{" == a)return x(a, b, c);
            if ("(" == a)return u(c, b, "parens");
            if ("hash" != a || /^#([0-9a-fA-f]{3}|[0-9a-fA-f]{6})$/.test(b.current())) {
                if ("word" == a)y(b); else if ("interpolation" == a)return u(c, b, "interpolation")
            } else o += " error";
            return "prop"
        }, z.propBlock = function (a, b, c) {
            return "}" == a ? v(c) : "word" == a ? (o = "property", "maybeprop") : c.context.type
        }, z.parens = function (a, b, c) {
            return "{" == a || "}" == a ? x(a, b, c) : ")" == a ? v(c) : "(" == a ? u(c, b, "parens") : ("word" == a && y(b), "parens")
        }, z.pseudo = function (a, b, c) {
            return "word" == a ? (o = "variable-3", c.context.type) : w(a, b, c)
        }, z.media = function (a, b, c) {
            if ("(" == a)return u(c, b, "media_parens");
            if ("}" == a)return x(a, b, c);
            if ("{" == a)return v(c) && u(c, b, m ? "block" : "top");
            if ("word" == a) {
                var d = b.current().toLowerCase();
                o = "only" == d || "not" == d || "and" == d ? "keyword" : f.hasOwnProperty(d) ? "attribute" : g.hasOwnProperty(d) ? "property" : "error"
            }
            return c.context.type
        }, z.media_parens = function (a, b, c) {
            return ")" == a ? v(c) : "{" == a || "}" == a ? x(a, b, c, 2) : z.media(a, b, c)
        }, z.font_face_before = function (a, b, c) {
            return "{" == a ? u(c, b, "font_face") : w(a, b, c)
        }, z.font_face = function (a, b, c) {
            return "}" == a ? v(c) : "word" == a ? (o = l.hasOwnProperty(b.current().toLowerCase()) ? "property" : "error", "maybeprop") : "font_face"
        }, z.keyframes = function (a, b, c) {
            return "word" == a ? (o = "variable", "keyframes") : "{" == a ? u(c, b, "top") : w(a, b, c)
        }, z.at = function (a, b, c) {
            return ";" == a ? v(c) : "{" == a || "}" == a ? x(a, b, c) : ("word" == a ? o = "tag" : "hash" == a && (o = "builtin"), "at")
        }, z.interpolation = function (a, b, c) {
            return "}" == a ? v(c) : "{" == a || ";" == a ? x(a, b, c) : ("variable" != a && (o = "error"), "interpolation")
        }, {
            startState: function (a) {
                return {tokenize: null, state: "top", context: new t("top", a || 0, null)}
            }, token: function (a, b) {
                if (!b.tokenize && a.eatSpace())return null;
                var c = (b.tokenize || q)(a, b);
                return c && "object" == typeof c && (n = c[1], c = c[0]), o = c, b.state = z[b.state](n, a, b), o
            }, indent: function (a, b) {
                var c = a.context, e = b && b.charAt(0), f = c.indent;
                return "prop" != c.type || "}" != e && ")" != e || (c = c.prev), !c.prev || ("}" != e || "block" != c.type && "top" != c.type && "interpolation" != c.type && "font_face" != c.type) && (")" != e || "parens" != c.type && "media_parens" != c.type) && ("{" != e || "at" != c.type && "media" != c.type) || (f = c.indent - d, c = c.prev), f
            }, electricChars: "}", blockCommentStart: "/*", blockCommentEnd: "*/", fold: "brace"
        }
    });
    var c = ["all", "aural", "braille", "handheld", "print", "projection", "screen", "tty", "tv", "embossed"], d = b(c), e = ["width", "min-width", "max-width", "height", "min-height", "max-height", "device-width", "min-device-width", "max-device-width", "device-height", "min-device-height", "max-device-height", "aspect-ratio", "min-aspect-ratio", "max-aspect-ratio", "device-aspect-ratio", "min-device-aspect-ratio", "max-device-aspect-ratio", "color", "min-color", "max-color", "color-index", "min-color-index", "max-color-index", "monochrome", "min-monochrome", "max-monochrome", "resolution", "min-resolution", "max-resolution", "scan", "grid"], f = b(e), g = ["align-content", "align-items", "align-self", "alignment-adjust", "alignment-baseline", "anchor-point", "animation", "animation-delay", "animation-direction", "animation-duration", "animation-fill-mode", "animation-iteration-count", "animation-name", "animation-play-state", "animation-timing-function", "appearance", "azimuth", "backface-visibility", "background", "background-attachment", "background-clip", "background-color", "background-image", "background-origin", "background-position", "background-repeat", "background-size", "baseline-shift", "binding", "bleed", "bookmark-label", "bookmark-level", "bookmark-state", "bookmark-target", "border", "border-bottom", "border-bottom-color", "border-bottom-left-radius", "border-bottom-right-radius", "border-bottom-style", "border-bottom-width", "border-collapse", "border-color", "border-image", "border-image-outset", "border-image-repeat", "border-image-slice", "border-image-source", "border-image-width", "border-left", "border-left-color", "border-left-style", "border-left-width", "border-radius", "border-right", "border-right-color", "border-right-style", "border-right-width", "border-spacing", "border-style", "border-top", "border-top-color", "border-top-left-radius", "border-top-right-radius", "border-top-style", "border-top-width", "border-width", "bottom", "box-decoration-break", "box-shadow", "box-sizing", "break-after", "break-before", "break-inside", "caption-side", "clear", "clip", "color", "color-profile", "column-count", "column-fill", "column-gap", "column-rule", "column-rule-color", "column-rule-style", "column-rule-width", "column-span", "column-width", "columns", "content", "counter-increment", "counter-reset", "crop", "cue", "cue-after", "cue-before", "cursor", "direction", "display", "dominant-baseline", "drop-initial-after-adjust", "drop-initial-after-align", "drop-initial-before-adjust", "drop-initial-before-align", "drop-initial-size", "drop-initial-value", "elevation", "empty-cells", "fit", "fit-position", "flex", "flex-basis", "flex-direction", "flex-flow", "flex-grow", "flex-shrink", "flex-wrap", "float", "float-offset", "flow-from", "flow-into", "font", "font-feature-settings", "font-family", "font-kerning", "font-language-override", "font-size", "font-size-adjust", "font-stretch", "font-style", "font-synthesis", "font-variant", "font-variant-alternates", "font-variant-caps", "font-variant-east-asian", "font-variant-ligatures", "font-variant-numeric", "font-variant-position", "font-weight", "grid", "grid-area", "grid-auto-columns", "grid-auto-flow", "grid-auto-position", "grid-auto-rows", "grid-column", "grid-column-end", "grid-column-start", "grid-row", "grid-row-end", "grid-row-start", "grid-template", "grid-template-areas", "grid-template-columns", "grid-template-rows", "hanging-punctuation", "height", "hyphens", "icon", "image-orientation", "image-rendering", "image-resolution", "inline-box-align", "justify-content", "left", "letter-spacing", "line-break", "line-height", "line-stacking", "line-stacking-ruby", "line-stacking-shift", "line-stacking-strategy", "list-style", "list-style-image", "list-style-position", "list-style-type", "margin", "margin-bottom", "margin-left", "margin-right", "margin-top", "marker-offset", "marks", "marquee-direction", "marquee-loop", "marquee-play-count", "marquee-speed", "marquee-style", "max-height", "max-width", "min-height", "min-width", "move-to", "nav-down", "nav-index", "nav-left", "nav-right", "nav-up", "object-fit", "object-position", "opacity", "order", "orphans", "outline", "outline-color", "outline-offset", "outline-style", "outline-width", "overflow", "overflow-style", "overflow-wrap", "overflow-x", "overflow-y", "padding", "padding-bottom", "padding-left", "padding-right", "padding-top", "page", "page-break-after", "page-break-before", "page-break-inside", "page-policy", "pause", "pause-after", "pause-before", "perspective", "perspective-origin", "pitch", "pitch-range", "play-during", "position", "presentation-level", "punctuation-trim", "quotes", "region-break-after", "region-break-before", "region-break-inside", "region-fragment", "rendering-intent", "resize", "rest", "rest-after", "rest-before", "richness", "right", "rotation", "rotation-point", "ruby-align", "ruby-overhang", "ruby-position", "ruby-span", "shape-image-threshold", "shape-inside", "shape-margin", "shape-outside", "size", "speak", "speak-as", "speak-header", "speak-numeral", "speak-punctuation", "speech-rate", "stress", "string-set", "tab-size", "table-layout", "target", "target-name", "target-new", "target-position", "text-align", "text-align-last", "text-decoration", "text-decoration-color", "text-decoration-line", "text-decoration-skip", "text-decoration-style", "text-emphasis", "text-emphasis-color", "text-emphasis-position", "text-emphasis-style", "text-height", "text-indent", "text-justify", "text-outline", "text-overflow", "text-shadow", "text-size-adjust", "text-space-collapse", "text-transform", "text-underline-position", "text-wrap", "top", "transform", "transform-origin", "transform-style", "transition", "transition-delay", "transition-duration", "transition-property", "transition-timing-function", "unicode-bidi", "vertical-align", "visibility", "voice-balance", "voice-duration", "voice-family", "voice-pitch", "voice-range", "voice-rate", "voice-stress", "voice-volume", "volume", "white-space", "widows", "width", "word-break", "word-spacing", "word-wrap", "z-index", "clip-path", "clip-rule", "mask", "enable-background", "filter", "flood-color", "flood-opacity", "lighting-color", "stop-color", "stop-opacity", "pointer-events", "color-interpolation", "color-interpolation-filters", "color-rendering", "fill", "fill-opacity", "fill-rule", "image-rendering", "marker", "marker-end", "marker-mid", "marker-start", "shape-rendering", "stroke", "stroke-dasharray", "stroke-dashoffset", "stroke-linecap", "stroke-linejoin", "stroke-miterlimit", "stroke-opacity", "stroke-width", "text-rendering", "baseline-shift", "dominant-baseline", "glyph-orientation-horizontal", "glyph-orientation-vertical", "text-anchor", "writing-mode"], h = b(g), i = ["scrollbar-arrow-color", "scrollbar-base-color", "scrollbar-dark-shadow-color", "scrollbar-face-color", "scrollbar-highlight-color", "scrollbar-shadow-color", "scrollbar-3d-light-color", "scrollbar-track-color", "shape-inside", "searchfield-cancel-button", "searchfield-decoration", "searchfield-results-button", "searchfield-results-decoration", "zoom"], j = b(i), k = ["aliceblue", "antiquewhite", "aqua", "aquamarine", "azure", "beige", "bisque", "black", "blanchedalmond", "blue", "blueviolet", "brown", "burlywood", "cadetblue", "chartreuse", "chocolate", "coral", "cornflowerblue", "cornsilk", "crimson", "cyan", "darkblue", "darkcyan", "darkgoldenrod", "darkgray", "darkgreen", "darkkhaki", "darkmagenta", "darkolivegreen", "darkorange", "darkorchid", "darkred", "darksalmon", "darkseagreen", "darkslateblue", "darkslategray", "darkturquoise", "darkviolet", "deeppink", "deepskyblue", "dimgray", "dodgerblue", "firebrick", "floralwhite", "forestgreen", "fuchsia", "gainsboro", "ghostwhite", "gold", "goldenrod", "gray", "grey", "green", "greenyellow", "honeydew", "hotpink", "indianred", "indigo", "ivory", "khaki", "lavender", "lavenderblush", "lawngreen", "lemonchiffon", "lightblue", "lightcoral", "lightcyan", "lightgoldenrodyellow", "lightgray", "lightgreen", "lightpink", "lightsalmon", "lightseagreen", "lightskyblue", "lightslategray", "lightsteelblue", "lightyellow", "lime", "limegreen", "linen", "magenta", "maroon", "mediumaquamarine", "mediumblue", "mediumorchid", "mediumpurple", "mediumseagreen", "mediumslateblue", "mediumspringgreen", "mediumturquoise", "mediumvioletred", "midnightblue", "mintcream", "mistyrose", "moccasin", "navajowhite", "navy", "oldlace", "olive", "olivedrab", "orange", "orangered", "orchid", "palegoldenrod", "palegreen", "paleturquoise", "palevioletred", "papayawhip", "peachpuff", "peru", "pink", "plum", "powderblue", "purple", "rebeccapurple", "red", "rosybrown", "royalblue", "saddlebrown", "salmon", "sandybrown", "seagreen", "seashell", "sienna", "silver", "skyblue", "slateblue", "slategray", "snow", "springgreen", "steelblue", "tan", "teal", "thistle", "tomato", "turquoise", "violet", "wheat", "white", "whitesmoke", "yellow", "yellowgreen"], l = b(k), m = ["above", "absolute", "activeborder", "activecaption", "afar", "after-white-space", "ahead", "alias", "all", "all-scroll", "alternate", "always", "amharic", "amharic-abegede", "antialiased", "appworkspace", "arabic-indic", "armenian", "asterisks", "auto", "avoid", "avoid-column", "avoid-page", "avoid-region", "background", "backwards", "baseline", "below", "bidi-override", "binary", "bengali", "blink", "block", "block-axis", "bold", "bolder", "border", "border-box", "both", "bottom", "break", "break-all", "break-word", "button", "button-bevel", "buttonface", "buttonhighlight", "buttonshadow", "buttontext", "cambodian", "capitalize", "caps-lock-indicator", "caption", "captiontext", "caret", "cell", "center", "checkbox", "circle", "cjk-earthly-branch", "cjk-heavenly-stem", "cjk-ideographic", "clear", "clip", "close-quote", "col-resize", "collapse", "column", "compact", "condensed", "contain", "content", "content-box", "context-menu", "continuous", "copy", "cover", "crop", "cross", "crosshair", "currentcolor", "cursive", "dashed", "decimal", "decimal-leading-zero", "default", "default-button", "destination-atop", "destination-in", "destination-out", "destination-over", "devanagari", "disc", "discard", "document", "dot-dash", "dot-dot-dash", "dotted", "double", "down", "e-resize", "ease", "ease-in", "ease-in-out", "ease-out", "element", "ellipse", "ellipsis", "embed", "end", "ethiopic", "ethiopic-abegede", "ethiopic-abegede-am-et", "ethiopic-abegede-gez", "ethiopic-abegede-ti-er", "ethiopic-abegede-ti-et", "ethiopic-halehame-aa-er", "ethiopic-halehame-aa-et", "ethiopic-halehame-am-et", "ethiopic-halehame-gez", "ethiopic-halehame-om-et", "ethiopic-halehame-sid-et", "ethiopic-halehame-so-et", "ethiopic-halehame-ti-er", "ethiopic-halehame-ti-et", "ethiopic-halehame-tig", "ew-resize", "expanded", "extra-condensed", "extra-expanded", "fantasy", "fast", "fill", "fixed", "flat", "footnotes", "forwards", "from", "geometricPrecision", "georgian", "graytext", "groove", "gujarati", "gurmukhi", "hand", "hangul", "hangul-consonant", "hebrew", "help", "hidden", "hide", "higher", "highlight", "highlighttext", "hiragana", "hiragana-iroha", "horizontal", "hsl", "hsla", "icon", "ignore", "inactiveborder", "inactivecaption", "inactivecaptiontext", "infinite", "infobackground", "infotext", "inherit", "initial", "inline", "inline-axis", "inline-block", "inline-table", "inset", "inside", "intrinsic", "invert", "italic", "justify", "kannada", "katakana", "katakana-iroha", "keep-all", "khmer", "landscape", "lao", "large", "larger", "left", "level", "lighter", "line-through", "linear", "lines", "list-item", "listbox", "listitem", "local", "logical", "loud", "lower", "lower-alpha", "lower-armenian", "lower-greek", "lower-hexadecimal", "lower-latin", "lower-norwegian", "lower-roman", "lowercase", "ltr", "malayalam", "match", "media-controls-background", "media-current-time-display", "media-fullscreen-button", "media-mute-button", "media-play-button", "media-return-to-realtime-button", "media-rewind-button", "media-seek-back-button", "media-seek-forward-button", "media-slider", "media-sliderthumb", "media-time-remaining-display", "media-volume-slider", "media-volume-slider-container", "media-volume-sliderthumb", "medium", "menu", "menulist", "menulist-button", "menulist-text", "menulist-textfield", "menutext", "message-box", "middle", "min-intrinsic", "mix", "mongolian", "monospace", "move", "multiple", "myanmar", "n-resize", "narrower", "ne-resize", "nesw-resize", "no-close-quote", "no-drop", "no-open-quote", "no-repeat", "none", "normal", "not-allowed", "nowrap", "ns-resize", "nw-resize", "nwse-resize", "oblique", "octal", "open-quote", "optimizeLegibility", "optimizeSpeed", "oriya", "oromo", "outset", "outside", "outside-shape", "overlay", "overline", "padding", "padding-box", "painted", "page", "paused", "persian", "plus-darker", "plus-lighter", "pointer", "polygon", "portrait", "pre", "pre-line", "pre-wrap", "preserve-3d", "progress", "push-button", "radio", "read-only", "read-write", "read-write-plaintext-only", "rectangle", "region", "relative", "repeat", "repeat-x", "repeat-y", "reset", "reverse", "rgb", "rgba", "ridge", "right", "round", "row-resize", "rtl", "run-in", "running", "s-resize", "sans-serif", "scroll", "scrollbar", "se-resize", "searchfield", "searchfield-cancel-button", "searchfield-decoration", "searchfield-results-button", "searchfield-results-decoration", "semi-condensed", "semi-expanded", "separate", "serif", "show", "sidama", "single", "skip-white-space", "slide", "slider-horizontal", "slider-vertical", "sliderthumb-horizontal", "sliderthumb-vertical", "slow", "small", "small-caps", "small-caption", "smaller", "solid", "somali", "source-atop", "source-in", "source-out", "source-over", "space", "square", "square-button", "start", "static", "status-bar", "stretch", "stroke", "sub", "subpixel-antialiased", "super", "sw-resize", "table", "table-caption", "table-cell", "table-column", "table-column-group", "table-footer-group", "table-header-group", "table-row", "table-row-group", "telugu", "text", "text-bottom", "text-top", "textarea", "textfield", "thai", "thick", "thin", "threeddarkshadow", "threedface", "threedhighlight", "threedlightshadow", "threedshadow", "tibetan", "tigre", "tigrinya-er", "tigrinya-er-abegede", "tigrinya-et", "tigrinya-et-abegede", "to", "top", "transparent", "ultra-condensed", "ultra-expanded", "underline", "up", "upper-alpha", "upper-armenian", "upper-greek", "upper-hexadecimal", "upper-latin", "upper-norwegian", "upper-roman", "uppercase", "urdu", "url", "vertical", "vertical-text", "visible", "visibleFill", "visiblePainted", "visibleStroke", "visual", "w-resize", "wait", "wave", "wider", "window", "windowframe", "windowtext", "x-large", "x-small", "xor", "xx-large", "xx-small"], n = b(m), o = ["font-family", "src", "unicode-range", "font-variant", "font-feature-settings", "font-stretch", "font-weight", "font-style"], p = b(o), q = c.concat(e).concat(g).concat(i).concat(k).concat(m);
    a.registerHelper("hintWords", "css", q), a.defineMIME("text/css", {
        mediaTypes: d,
        mediaFeatures: f,
        propertyKeywords: h,
        nonStandardPropertyKeywords: j,
        colorKeywords: l,
        valueKeywords: n,
        fontProperties: p,
        tokenHooks: {
            "<": function (a, b) {
                return a.match("!--") ? (b.tokenize = s, s(a, b)) : !1
            }, "/": function (a, b) {
                return a.eat("*") ? (b.tokenize = r, r(a, b)) : !1
            }
        },
        name: "css"
    }), a.defineMIME("text/x-scss", {
        mediaTypes: d,
        mediaFeatures: f,
        propertyKeywords: h,
        nonStandardPropertyKeywords: j,
        colorKeywords: l,
        valueKeywords: n,
        fontProperties: p,
        allowNested: !0,
        tokenHooks: {
            "/": function (a, b) {
                return a.eat("/") ? (a.skipToEnd(), ["comment", "comment"]) : a.eat("*") ? (b.tokenize = r, r(a, b)) : ["operator", "operator"]
            }, ":": function (a) {
                return a.match(/\s*\{/) ? [null, "{"] : !1
            }, $: function (a) {
                return a.match(/^[\w-]+/), a.match(/^\s*:/, !1) ? ["variable-2", "variable-definition"] : ["variable-2", "variable"]
            }, "#": function (a) {
                return a.eat("{") ? [null, "interpolation"] : !1
            }
        },
        name: "css",
        helperType: "scss"
    }), a.defineMIME("text/x-less", {
        mediaTypes: d,
        mediaFeatures: f,
        propertyKeywords: h,
        nonStandardPropertyKeywords: j,
        colorKeywords: l,
        valueKeywords: n,
        fontProperties: p,
        allowNested: !0,
        tokenHooks: {
            "/": function (a, b) {
                return a.eat("/") ? (a.skipToEnd(), ["comment", "comment"]) : a.eat("*") ? (b.tokenize = r, r(a, b)) : ["operator", "operator"]
            }, "@": function (a) {
                return a.match(/^(charset|document|font-face|import|(-(moz|ms|o|webkit)-)?keyframes|media|namespace|page|supports)\b/, !1) ? !1 : (a.eatWhile(/[\w\\\-]/), a.match(/^\s*:/, !1) ? ["variable-2", "variable-definition"] : ["variable-2", "variable"])
            }, "&": function () {
                return ["atom", "atom"]
            }
        },
        name: "css",
        helperType: "less"
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../markdown/markdown"), require("../../addon/mode/overlay")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../markdown/markdown", "../../addon/mode/overlay"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("gfm", function (b, c) {
        function e(a) {
            return a.code = !1, null
        }

        var d = 0, f = {
            startState: function () {
                return {code: !1, codeBlock: !1, ateSpace: !1}
            }, copyState: function (a) {
                return {code: a.code, codeBlock: a.codeBlock, ateSpace: a.ateSpace}
            }, token: function (a, b) {
                if (b.combineTokens = null, b.codeBlock)return a.match(/^```/) ? (b.codeBlock = !1, null) : (a.skipToEnd(), null);
                if (a.sol() && (b.code = !1), a.sol() && a.match(/^```/))return a.skipToEnd(), b.codeBlock = !0, null;
                if ("`" === a.peek()) {
                    a.next();
                    var c = a.pos;
                    a.eatWhile("`");
                    var e = 1 + a.pos - c;
                    return b.code ? e === d && (b.code = !1) : (d = e, b.code = !0), null
                }
                if (b.code)return a.next(), null;
                if (a.eatSpace())return b.ateSpace = !0, null;
                if (a.sol() || b.ateSpace) {
                    if (b.ateSpace = !1, a.match(/^(?:[a-zA-Z0-9\-_]+\/)?(?:[a-zA-Z0-9\-_]+@)?(?:[a-f0-9]{7,40}\b)/))return b.combineTokens = !0, "link";
                    if (a.match(/^(?:[a-zA-Z0-9\-_]+\/)?(?:[a-zA-Z0-9\-_]+)?#[0-9]+\b/))return b.combineTokens = !0, "link"
                }
                return a.match(/^((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]|\([^\s()<>]*\))+(?:\([^\s()<>]*\)|[^\s`*!()\[\]{};:'".,<>?\xab\xbb\u201c\u201d\u2018\u2019]))/i) && "](" != a.string.slice(a.start - 2, a.start) ? (b.combineTokens = !0, "link") : (a.next(), null)
            }, blankLine: e
        }, g = {underscoresBreakWords: !1, taskLists: !0, fencedCodeBlocks: !0};
        for (var h in c)g[h] = c[h];
        return g.name = "markdown", a.defineMIME("gfmBase", g), a.overlayMode(a.getMode(b, "gfmBase"), f)
    }, "markdown")
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../htmlmixed/htmlmixed")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../htmlmixed/htmlmixed"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("htmlembedded", function (b, c) {
        function h(a, b) {
            return a.match(d, !1) ? (b.token = i, f.token(a, b.scriptState)) : g.token(a, b.htmlState)
        }

        function i(a, b) {
            return a.match(e, !1) ? (b.token = h, g.token(a, b.htmlState)) : f.token(a, b.scriptState)
        }

        var f, g, d = c.scriptStartRegex || /^<%/i, e = c.scriptEndRegex || /^%>/i;
        return {
            startState: function () {
                return f = f || a.getMode(b, c.scriptingModeSpec), g = g || a.getMode(b, "htmlmixed"), {
                    token: c.startOpen ? i : h,
                    htmlState: a.startState(g),
                    scriptState: a.startState(f)
                }
            }, token: function (a, b) {
                return b.token(a, b)
            }, indent: function (a, b) {
                return a.token == h ? g.indent(a.htmlState, b) : f.indent ? f.indent(a.scriptState, b) : void 0
            }, copyState: function (b) {
                return {
                    token: b.token,
                    htmlState: a.copyState(g, b.htmlState),
                    scriptState: a.copyState(f, b.scriptState)
                }
            }, innerMode: function (a) {
                return a.token == i ? {state: a.scriptState, mode: f} : {state: a.htmlState, mode: g}
            }
        }
    }, "htmlmixed"), a.defineMIME("application/x-ejs", {
        name: "htmlembedded",
        scriptingModeSpec: "javascript"
    }), a.defineMIME("application/x-aspx", {
        name: "htmlembedded",
        scriptingModeSpec: "text/x-csharp"
    }), a.defineMIME("application/x-jsp", {
        name: "htmlembedded",
        scriptingModeSpec: "text/x-java"
    }), a.defineMIME("application/x-erb", {name: "htmlembedded", scriptingModeSpec: "ruby"})
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../xml/xml"), require("../javascript/javascript"), require("../css/css")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../xml/xml", "../javascript/javascript", "../css/css"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("htmlmixed", function (b, c) {
        function j(a, b) {
            var c = b.htmlState.tagName, g = d.token(a, b.htmlState);
            if ("script" == c && /\btag\b/.test(g) && ">" == a.current()) {
                var h = a.string.slice(Math.max(0, a.pos - 100), a.pos).match(/\btype\s*=\s*("[^"]+"|'[^']+'|\S+)[^<]*$/i);
                h = h ? h[1] : "", h && /[\"\']/.test(h.charAt(0)) && (h = h.slice(1, h.length - 1));
                for (var i = 0; i < f.length; ++i) {
                    var j = f[i];
                    if ("string" == typeof j.matches ? h == j.matches : j.matches.test(h)) {
                        j.mode && (b.token = l, b.localMode = j.mode, b.localState = j.mode.startState && j.mode.startState(d.indent(b.htmlState, "")));
                        break
                    }
                }
            } else"style" == c && /\btag\b/.test(g) && ">" == a.current() && (b.token = m, b.localMode = e, b.localState = e.startState(d.indent(b.htmlState, "")));
            return g
        }

        function k(a, b, c) {
            var f, d = a.current(), e = d.search(b);
            return e > -1 ? a.backUp(d.length - e) : (f = d.match(/<\/?$/)) && (a.backUp(d.length), a.match(b, !1) || a.match(d)), c
        }

        function l(a, b) {
            return a.match(/^<\/\s*script\s*>/i, !1) ? (b.token = j, b.localState = b.localMode = null, j(a, b)) : k(a, /<\/\s*script\s*>/, b.localMode.token(a, b.localState))
        }

        function m(a, b) {
            return a.match(/^<\/\s*style\s*>/i, !1) ? (b.token = j, b.localState = b.localMode = null, j(a, b)) : k(a, /<\/\s*style\s*>/, e.token(a, b.localState))
        }

        var d = a.getMode(b, {
            name: "xml",
            htmlMode: !0,
            multilineTagIndentFactor: c.multilineTagIndentFactor,
            multilineTagIndentPastTag: c.multilineTagIndentPastTag
        }), e = a.getMode(b, "css"), f = [], g = c && c.scriptTypes;
        if (f.push({
                matches: /^(?:text|application)\/(?:x-)?(?:java|ecma)script$|^$/i,
                mode: a.getMode(b, "javascript")
            }), g)for (var h = 0; h < g.length; ++h) {
            var i = g[h];
            f.push({matches: i.matches, mode: i.mode && a.getMode(b, i.mode)})
        }
        return f.push({matches: /./, mode: a.getMode(b, "text/plain")}), {
            startState: function () {
                var a = d.startState();
                return {token: j, localMode: null, localState: null, htmlState: a}
            }, copyState: function (b) {
                if (b.localState)var c = a.copyState(b.localMode, b.localState);
                return {token: b.token, localMode: b.localMode, localState: c, htmlState: a.copyState(d, b.htmlState)}
            }, token: function (a, b) {
                return b.token(a, b)
            }, indent: function (b, c) {
                return !b.localMode || /^\s*<\//.test(c) ? d.indent(b.htmlState, c) : b.localMode.indent ? b.localMode.indent(b.localState, c) : a.Pass
            }, innerMode: function (a) {
                return {state: a.localState || a.htmlState, mode: a.localMode || d}
            }
        }
    }, "xml", "javascript", "css"), a.defineMIME("text/html", "htmlmixed")
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("javascript", function (b, c) {
        function l(a) {
            for (var c, b = !1, d = !1; null != (c = a.next());) {
                if (!b) {
                    if ("/" == c && !d)return;
                    "[" == c ? d = !0 : d && "]" == c && (d = !1)
                }
                b = !b && "\\" == c
            }
        }

        function o(a, b, c) {
            return m = a, n = c, b
        }

        function p(a, b) {
            var c = a.next();
            if ('"' == c || "'" == c)return b.tokenize = q(c), b.tokenize(a, b);
            if ("." == c && a.match(/^\d+(?:[eE][+\-]?\d+)?/))return o("number", "number");
            if ("." == c && a.match(".."))return o("spread", "meta");
            if (/[\[\]{}\(\),;\:\.]/.test(c))return o(c);
            if ("=" == c && a.eat(">"))return o("=>", "operator");
            if ("0" == c && a.eat(/x/i))return a.eatWhile(/[\da-f]/i), o("number", "number");
            if (/\d/.test(c))return a.match(/^\d*(?:\.\d*)?(?:[eE][+\-]?\d+)?/), o("number", "number");
            if ("/" == c)return a.eat("*") ? (b.tokenize = r, r(a, b)) : a.eat("/") ? (a.skipToEnd(), o("comment", "comment")) : "operator" == b.lastType || "keyword c" == b.lastType || "sof" == b.lastType || /^[\[{}\(,;:]$/.test(b.lastType) ? (l(a), a.eatWhile(/[gimy]/), o("regexp", "string-2")) : (a.eatWhile(j), o("operator", "operator", a.current()));
            if ("`" == c)return b.tokenize = s, s(a, b);
            if ("#" == c)return a.skipToEnd(), o("error", "error");
            if (j.test(c))return a.eatWhile(j), o("operator", "operator", a.current());
            a.eatWhile(/[\w\$_]/);
            var d = a.current(), e = i.propertyIsEnumerable(d) && i[d];
            return e && "." != b.lastType ? o(e.type, e.style, d) : o("variable", "variable", d)
        }

        function q(a) {
            return function (b, c) {
                var e, d = !1;
                if (f && "@" == b.peek() && b.match(k))return c.tokenize = p, o("jsonld-keyword", "meta");
                for (; null != (e = b.next()) && (e != a || d);)d = !d && "\\" == e;
                return d || (c.tokenize = p), o("string", "string")
            }
        }

        function r(a, b) {
            for (var d, c = !1; d = a.next();) {
                if ("/" == d && c) {
                    b.tokenize = p;
                    break
                }
                c = "*" == d
            }
            return o("comment", "comment")
        }

        function s(a, b) {
            for (var d, c = !1; null != (d = a.next());) {
                if (!c && ("`" == d || "$" == d && a.eat("{"))) {
                    b.tokenize = p;
                    break
                }
                c = !c && "\\" == d
            }
            return o("quasi", "string-2", a.current())
        }

        function u(a, b) {
            b.fatArrowAt && (b.fatArrowAt = null);
            var c = a.string.indexOf("=>", a.start);
            if (!(0 > c)) {
                for (var d = 0, e = !1, f = c - 1; f >= 0; --f) {
                    var g = a.string.charAt(f), h = t.indexOf(g);
                    if (h >= 0 && 3 > h) {
                        if (!d) {
                            ++f;
                            break
                        }
                        if (0 == --d)break
                    } else if (h >= 3 && 6 > h)++d; else if (/[$\w]/.test(g))e = !0; else if (e && !d) {
                        ++f;
                        break
                    }
                }
                e && !d && (b.fatArrowAt = f)
            }
        }

        function w(a, b, c, d, e, f) {
            this.indented = a, this.column = b, this.type = c, this.prev = e, this.info = f, null != d && (this.align = d)
        }

        function x(a, b) {
            for (var c = a.localVars; c; c = c.next)if (c.name == b)return !0;
            for (var d = a.context; d; d = d.prev)for (var c = d.vars; c; c = c.next)if (c.name == b)return !0
        }

        function y(a, b, c, d, e) {
            var f = a.cc;
            for (z.state = a, z.stream = e, z.marked = null, z.cc = f, z.style = b, a.lexical.hasOwnProperty("align") || (a.lexical.align = !0); ;) {
                var h = f.length ? f.pop() : g ? K : J;
                if (h(c, d)) {
                    for (; f.length && f[f.length - 1].lex;)f.pop()();
                    return z.marked ? z.marked : "variable" == c && x(a, d) ? "variable-2" : b
                }
            }
        }

        function A() {
            for (var a = arguments.length - 1; a >= 0; a--)z.cc.push(arguments[a])
        }

        function B() {
            return A.apply(null, arguments), !0
        }

        function C(a) {
            function b(b) {
                for (var c = b; c; c = c.next)if (c.name == a)return !0;
                return !1
            }

            var d = z.state;
            if (d.context) {
                if (z.marked = "def", b(d.localVars))return;
                d.localVars = {name: a, next: d.localVars}
            } else {
                if (b(d.globalVars))return;
                c.globalVars && (d.globalVars = {name: a, next: d.globalVars})
            }
        }

        function E() {
            z.state.context = {prev: z.state.context, vars: z.state.localVars}, z.state.localVars = D
        }

        function F() {
            z.state.localVars = z.state.context.vars, z.state.context = z.state.context.prev
        }

        function G(a, b) {
            var c = function () {
                var c = z.state, d = c.indented;
                if ("stat" == c.lexical.type)d = c.lexical.indented; else for (var e = c.lexical; e && ")" == e.type && e.align; e = e.prev)d = e.indented;
                c.lexical = new w(d, z.stream.column(), a, null, c.lexical, b)
            };
            return c.lex = !0, c
        }

        function H() {
            var a = z.state;
            a.lexical.prev && (")" == a.lexical.type && (a.indented = a.lexical.indented), a.lexical = a.lexical.prev)
        }

        function I(a) {
            function b(c) {
                return c == a ? B() : ";" == a ? A() : B(b)
            }

            return b
        }

        function J(a, b) {
            return "var" == a ? B(G("vardef", b.length), db, I(";"), H) : "keyword a" == a ? B(G("form"), K, J, H) : "keyword b" == a ? B(G("form"), J, H) : "{" == a ? B(G("}"), ab, H) : ";" == a ? B() : "if" == a ? ("else" == z.state.lexical.info && z.state.cc[z.state.cc.length - 1] == H && z.state.cc.pop()(), B(G("form"), K, J, H, ib)) : "function" == a ? B(ob) : "for" == a ? B(G("form"), jb, J, H) : "variable" == a ? B(G("stat"), V) : "switch" == a ? B(G("form"), K, G("}", "switch"), I("{"), ab, H, H) : "case" == a ? B(K, I(":")) : "default" == a ? B(I(":")) : "catch" == a ? B(G("form"), E, I("("), pb, I(")"), J, H, F) : "module" == a ? B(G("form"), E, ub, F, H) : "class" == a ? B(G("form"), qb, H) : "export" == a ? B(G("form"), vb, H) : "import" == a ? B(G("form"), wb, H) : A(G("stat"), K, I(";"), H)
        }

        function K(a) {
            return M(a, !1)
        }

        function L(a) {
            return M(a, !0)
        }

        function M(a, b) {
            if (z.state.fatArrowAt == z.stream.start) {
                var c = b ? U : T;
                if ("(" == a)return B(E, G(")"), $(eb, ")"), H, I("=>"), c, F);
                if ("variable" == a)return A(E, eb, I("=>"), c, F)
            }
            var d = b ? Q : P;
            return v.hasOwnProperty(a) ? B(d) : "function" == a ? B(ob, d) : "keyword c" == a ? B(b ? O : N) : "(" == a ? B(G(")"), N, Bb, I(")"), H, d) : "operator" == a || "spread" == a ? B(b ? L : K) : "[" == a ? B(G("]"), zb, H, d) : "{" == a ? _(X, "}", null, d) : "quasi" == a ? A(R, d) : B()
        }

        function N(a) {
            return a.match(/[;\}\)\],]/) ? A() : A(K)
        }

        function O(a) {
            return a.match(/[;\}\)\],]/) ? A() : A(L)
        }

        function P(a, b) {
            return "," == a ? B(K) : Q(a, b, !1)
        }

        function Q(a, b, c) {
            var d = 0 == c ? P : Q, e = 0 == c ? K : L;
            return "=>" == b ? B(E, c ? U : T, F) : "operator" == a ? /\+\+|--/.test(b) ? B(d) : "?" == b ? B(K, I(":"), e) : B(e) : "quasi" == a ? A(R, d) : ";" != a ? "(" == a ? _(L, ")", "call", d) : "." == a ? B(W, d) : "[" == a ? B(G("]"), N, I("]"), H, d) : void 0 : void 0
        }

        function R(a, b) {
            return "quasi" != a ? A() : "${" != b.slice(b.length - 2) ? B(R) : B(K, S)
        }

        function S(a) {
            return "}" == a ? (z.marked = "string-2", z.state.tokenize = s, B(R)) : void 0
        }

        function T(a) {
            return u(z.stream, z.state), "{" == a ? A(J) : A(K)
        }

        function U(a) {
            return u(z.stream, z.state), "{" == a ? A(J) : A(L)
        }

        function V(a) {
            return ":" == a ? B(H, J) : A(P, I(";"), H)
        }

        function W(a) {
            return "variable" == a ? (z.marked = "property", B()) : void 0
        }

        function X(a, b) {
            return "variable" == a || "keyword" == z.style ? (z.marked = "property", "get" == b || "set" == b ? B(Y) : B(Z)) : "number" == a || "string" == a ? (z.marked = f ? "property" : z.style + " property", B(Z)) : "jsonld-keyword" == a ? B(Z) : "[" == a ? B(K, I("]"), Z) : void 0
        }

        function Y(a) {
            return "variable" != a ? A(Z) : (z.marked = "property", B(ob))
        }

        function Z(a) {
            return ":" == a ? B(L) : "(" == a ? A(ob) : void 0
        }

        function $(a, b) {
            function c(d) {
                if ("," == d) {
                    var e = z.state.lexical;
                    return "call" == e.info && (e.pos = (e.pos || 0) + 1), B(a, c)
                }
                return d == b ? B() : B(I(b))
            }

            return function (d) {
                return d == b ? B() : A(a, c)
            }
        }

        function _(a, b, c) {
            for (var d = 3; d < arguments.length; d++)z.cc.push(arguments[d]);
            return B(G(b, c), $(a, b), H)
        }

        function ab(a) {
            return "}" == a ? B() : A(J, ab)
        }

        function bb(a) {
            return h && ":" == a ? B(cb) : void 0
        }

        function cb(a) {
            return "variable" == a ? (z.marked = "variable-3", B()) : void 0
        }

        function db() {
            return A(eb, bb, gb, hb)
        }

        function eb(a, b) {
            return "variable" == a ? (C(b), B()) : "[" == a ? _(eb, "]") : "{" == a ? _(fb, "}") : void 0
        }

        function fb(a, b) {
            return "variable" != a || z.stream.match(/^\s*:/, !1) ? ("variable" == a && (z.marked = "property"), B(I(":"), eb, gb)) : (C(b), B(gb))
        }

        function gb(a, b) {
            return "=" == b ? B(L) : void 0
        }

        function hb(a) {
            return "," == a ? B(db) : void 0
        }

        function ib(a, b) {
            return "keyword b" == a && "else" == b ? B(G("form", "else"), J, H) : void 0
        }

        function jb(a) {
            return "(" == a ? B(G(")"), kb, I(")"), H) : void 0
        }

        function kb(a) {
            return "var" == a ? B(db, I(";"), mb) : ";" == a ? B(mb) : "variable" == a ? B(lb) : A(K, I(";"), mb)
        }

        function lb(a, b) {
            return "in" == b || "of" == b ? (z.marked = "keyword", B(K)) : B(P, mb)
        }

        function mb(a, b) {
            return ";" == a ? B(nb) : "in" == b || "of" == b ? (z.marked = "keyword", B(K)) : A(K, I(";"), nb)
        }

        function nb(a) {
            ")" != a && B(K)
        }

        function ob(a, b) {
            return "*" == b ? (z.marked = "keyword", B(ob)) : "variable" == a ? (C(b), B(ob)) : "(" == a ? B(E, G(")"), $(pb, ")"), H, J, F) : void 0
        }

        function pb(a) {
            return "spread" == a ? B(pb) : A(eb, bb)
        }

        function qb(a, b) {
            return "variable" == a ? (C(b), B(rb)) : void 0
        }

        function rb(a, b) {
            return "extends" == b ? B(K, rb) : "{" == a ? B(G("}"), sb, H) : void 0
        }

        function sb(a, b) {
            return "variable" == a || "keyword" == z.style ? (z.marked = "property", "get" == b || "set" == b ? B(tb, ob, sb) : B(ob, sb)) : "*" == b ? (z.marked = "keyword", B(sb)) : ";" == a ? B(sb) : "}" == a ? B() : void 0
        }

        function tb(a) {
            return "variable" != a ? A() : (z.marked = "property", B())
        }

        function ub(a, b) {
            return "string" == a ? B(J) : "variable" == a ? (C(b), B(yb)) : void 0
        }

        function vb(a, b) {
            return "*" == b ? (z.marked = "keyword", B(yb, I(";"))) : "default" == b ? (z.marked = "keyword", B(K, I(";"))) : A(J)
        }

        function wb(a) {
            return "string" == a ? B() : A(xb, yb)
        }

        function xb(a, b) {
            return "{" == a ? _(xb, "}") : ("variable" == a && C(b), B())
        }

        function yb(a, b) {
            return "from" == b ? (z.marked = "keyword", B(K)) : void 0
        }

        function zb(a) {
            return "]" == a ? B() : A(L, Ab)
        }

        function Ab(a) {
            return "for" == a ? A(Bb, I("]")) : "," == a ? B($(L, "]")) : A($(L, "]"))
        }

        function Bb(a) {
            return "for" == a ? B(jb, Bb) : "if" == a ? B(K, Bb) : void 0
        }

        var m, n, d = b.indentUnit, e = c.statementIndent, f = c.jsonld, g = c.json || f, h = c.typescript, i = function () {
            function a(a) {
                return {type: a, style: "keyword"}
            }

            var b = a("keyword a"), c = a("keyword b"), d = a("keyword c"), e = a("operator"), f = {
                type: "atom",
                style: "atom"
            }, g = {
                "if": a("if"),
                "while": b,
                "with": b,
                "else": c,
                "do": c,
                "try": c,
                "finally": c,
                "return": d,
                "break": d,
                "continue": d,
                "new": d,
                "delete": d,
                "throw": d,
                "debugger": d,
                "var": a("var"),
                "const": a("var"),
                let: a("var"),
                "function": a("function"),
                "catch": a("catch"),
                "for": a("for"),
                "switch": a("switch"),
                "case": a("case"),
                "default": a("default"),
                "in": e,
                "typeof": e,
                "instanceof": e,
                "true": f,
                "false": f,
                "null": f,
                undefined: f,
                NaN: f,
                Infinity: f,
                "this": a("this"),
                module: a("module"),
                "class": a("class"),
                "super": a("atom"),
                yield: d,
                "export": a("export"),
                "import": a("import"),
                "extends": d
            };
            if (h) {
                var i = {type: "variable", style: "variable-3"}, j = {
                    "interface": a("interface"),
                    "extends": a("extends"),
                    constructor: a("constructor"),
                    "public": a("public"),
                    "private": a("private"),
                    "protected": a("protected"),
                    "static": a("static"),
                    string: i,
                    number: i,
                    bool: i,
                    any: i
                };
                for (var k in j)g[k] = j[k]
            }
            return g
        }(), j = /[+\-*&%=<>!?|~^]/, k = /^@(context|id|value|language|type|container|list|set|reverse|index|base|vocab|graph)"/, t = "([{}])", v = {
            atom: !0,
            number: !0,
            variable: !0,
            string: !0,
            regexp: !0,
            "this": !0,
            "jsonld-keyword": !0
        }, z = {state: null, column: null, marked: null, cc: null}, D = {name: "this", next: {name: "arguments"}};
        return H.lex = !0, {
            startState: function (a) {
                var b = {
                    tokenize: p,
                    lastType: "sof",
                    cc: [],
                    lexical: new w((a || 0) - d, 0, "block", !1),
                    localVars: c.localVars,
                    context: c.localVars && {vars: c.localVars},
                    indented: 0
                };
                return c.globalVars && "object" == typeof c.globalVars && (b.globalVars = c.globalVars), b
            },
            token: function (a, b) {
                if (a.sol() && (b.lexical.hasOwnProperty("align") || (b.lexical.align = !1), b.indented = a.indentation(), u(a, b)), b.tokenize != r && a.eatSpace())return null;
                var c = b.tokenize(a, b);
                return "comment" == m ? c : (b.lastType = "operator" != m || "++" != n && "--" != n ? m : "incdec", y(b, c, m, n, a))
            },
            indent: function (b, f) {
                if (b.tokenize == r)return a.Pass;
                if (b.tokenize != p)return 0;
                var g = f && f.charAt(0), h = b.lexical;
                if (!/^\s*else\b/.test(f))for (var i = b.cc.length - 1; i >= 0; --i) {
                    var j = b.cc[i];
                    if (j == H)h = h.prev; else if (j != ib)break
                }
                "stat" == h.type && "}" == g && (h = h.prev), e && ")" == h.type && "stat" == h.prev.type && (h = h.prev);
                var k = h.type, l = g == k;
                return "vardef" == k ? h.indented + ("operator" == b.lastType || "," == b.lastType ? h.info + 1 : 0) : "form" == k && "{" == g ? h.indented : "form" == k ? h.indented + d : "stat" == k ? h.indented + ("operator" == b.lastType || "," == b.lastType ? e || d : 0) : "switch" != h.info || l || 0 == c.doubleIndentSwitch ? h.align ? h.column + (l ? 0 : 1) : h.indented + (l ? 0 : d) : h.indented + (/^(?:case|default)\b/.test(f) ? d : 2 * d)
            },
            electricChars: ":{}",
            blockCommentStart: g ? null : "/*",
            blockCommentEnd: g ? null : "*/",
            lineComment: g ? null : "//",
            fold: "brace",
            helperType: g ? "json" : "javascript",
            jsonldMode: f,
            jsonMode: g
        }
    }), a.registerHelper("wordChars", "javascript", /[\\w$]/), a.defineMIME("text/javascript", "javascript"), a.defineMIME("text/ecmascript", "javascript"), a.defineMIME("application/javascript", "javascript"), a.defineMIME("application/x-javascript", "javascript"), a.defineMIME("application/ecmascript", "javascript"), a.defineMIME("application/json", {
        name: "javascript",
        json: !0
    }), a.defineMIME("application/x-json", {
        name: "javascript",
        json: !0
    }), a.defineMIME("application/ld+json", {
        name: "javascript",
        jsonld: !0
    }), a.defineMIME("text/typescript", {
        name: "javascript",
        typescript: !0
    }), a.defineMIME("application/typescript", {name: "javascript", typescript: !0})
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror", require("../xml/xml"))) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../xml/xml"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("markdown", function (b, c) {
        function E(a, b, c) {
            return b.f = b.inline = c, c(a, b)
        }

        function F(a, b, c) {
            return b.f = b.block = c, c(a, b)
        }

        function G(a) {
            return a.linkTitle = !1, a.em = !1, a.strong = !1, a.quote = 0, d || a.f != I || (a.f = M, a.block = H), a.trailingSpace = 0, a.trailingSpaceNewLine = !1, a.thisLineHasContent = !1, null
        }

        function H(a, b) {
            var d = a.sol(), e = b.list !== !1;
            b.list !== !1 && b.indentationDiff >= 0 ? (b.indentationDiff < 4 && (b.indentation -= b.indentationDiff), b.list = null) : b.list !== !1 && b.indentation > 0 ? (b.list = null, b.listDepth = Math.floor(b.indentation / 4)) : b.list !== !1 && (b.list = !1, b.listDepth = 0);
            var f = null;
            if (b.indentationDiff >= 4)return b.indentation -= 4, a.skipToEnd(), j;
            if (a.eatSpace())return null;
            if (f = a.match(B))return b.header = f[0].length <= 6 ? f[0].length : 6, c.highlightFormatting && (b.formatting = "header"), b.f = b.inline, K(b);
            if (b.prevLineHasContent && (f = a.match(C)))return b.header = "=" == f[0].charAt(0) ? 1 : 2, c.highlightFormatting && (b.formatting = "header"), b.f = b.inline, K(b);
            if (a.eat(">"))return b.indentation++, b.quote = d ? 1 : b.quote + 1, c.highlightFormatting && (b.formatting = "quote"), a.eatSpace(), K(b);
            if ("[" === a.peek())return E(a, b, Q);
            if (a.match(x, !0))return o;
            if ((!b.prevLineHasContent || e) && (a.match(y, !1) || a.match(z, !1))) {
                var h = null;
                return a.match(y, !0) ? h = "ul" : (a.match(z, !0), h = "ol"), b.indentation += 4, b.list = !0, b.listDepth++, c.taskLists && a.match(A, !1) && (b.taskList = !0), b.f = b.inline, c.highlightFormatting && (b.formatting = ["list", "list-" + h]), K(b)
            }
            return c.fencedCodeBlocks && a.match(/^```([\w+#]*)/, !0) ? (b.localMode = g(RegExp.$1), b.localMode && (b.localState = b.localMode.startState()), F(a, b, J), c.highlightFormatting && (b.formatting = "code-block"), b.code = !0, K(b)) : E(a, b, b.inline)
        }

        function I(a, b) {
            var c = e.token(a, b.htmlState);
            return (d && null === b.htmlState.tagStart && !b.htmlState.context || b.md_inside && a.current().indexOf(">") > -1) && (b.f = M, b.block = H, b.htmlState = null), c
        }

        function J(a, b) {
            if (a.sol() && a.match(/^```/, !0)) {
                b.localMode = b.localState = null, b.f = M, b.block = H, c.highlightFormatting && (b.formatting = "code-block"), b.code = !0;
                var d = K(b);
                return b.code = !1, d
            }
            return b.localMode ? b.localMode.token(a, b.localState) : (a.skipToEnd(), j)
        }

        function K(a) {
            var b = [];
            if (a.formatting) {
                b.push(q), "string" == typeof a.formatting && (a.formatting = [a.formatting]);
                for (var d = 0; d < a.formatting.length; d++)b.push(q + "-" + a.formatting[d]), "header" === a.formatting[d] && b.push(q + "-" + a.formatting[d] + "-" + a.header), "quote" === a.formatting[d] && (!c.maxBlockquoteDepth || c.maxBlockquoteDepth >= a.quote ? b.push(q + "-" + a.formatting[d] + "-" + a.quote) : b.push("error"))
            }
            if (a.taskOpen)return b.push("meta"), b.length ? b.join(" ") : null;
            if (a.taskClosed)return b.push("property"), b.length ? b.join(" ") : null;
            if (a.linkHref)return b.push(u), b.length ? b.join(" ") : null;
            if (a.strong && b.push(w), a.em && b.push(v), a.linkText && b.push(t), a.code && b.push(j), a.header && (b.push(i), b.push(i + "-" + a.header)), a.quote && (b.push(k), !c.maxBlockquoteDepth || c.maxBlockquoteDepth >= a.quote ? b.push(k + "-" + a.quote) : b.push(k + "-" + c.maxBlockquoteDepth)), a.list !== !1) {
                var e = (a.listDepth - 1) % 3;
                e ? 1 === e ? b.push(m) : b.push(n) : b.push(l)
            }
            return a.trailingSpaceNewLine ? b.push("trailing-space-new-line") : a.trailingSpace && b.push("trailing-space-" + (a.trailingSpace % 2 ? "a" : "b")), b.length ? b.join(" ") : null
        }

        function L(a, b) {
            return a.match(D, !0) ? K(b) : void 0
        }

        function M(b, d) {
            var f = d.text(b, d);
            if ("undefined" != typeof f)return f;
            if (d.list)return d.list = null, K(d);
            if (d.taskList) {
                var g = "x" !== b.match(A, !0)[1];
                return g ? d.taskOpen = !0 : d.taskClosed = !0, c.highlightFormatting && (d.formatting = "task"), d.taskList = !1, K(d)
            }
            if (d.taskOpen = !1, d.taskClosed = !1, d.header && b.match(/^#+$/, !0))return c.highlightFormatting && (d.formatting = "header"), K(d);
            var i = b.sol(), j = b.next();
            if (d.escape)return d.escape = !1, K(d);
            if ("\\" === j)return c.highlightFormatting && (d.formatting = "escape"), d.escape = !0, K(d);
            if (d.linkTitle) {
                d.linkTitle = !1;
                var k = j;
                "(" === j && (k = ")"), k = (k + "").replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
                var l = "^\\s*(?:[^" + k + "\\\\]+|\\\\\\\\|\\\\.)" + k;
                if (b.match(new RegExp(l), !0))return u
            }
            if ("`" === j) {
                var m = d.formatting;
                c.highlightFormatting && (d.formatting = "code");
                var n = K(d), o = b.pos;
                b.eatWhile("`");
                var q = 1 + b.pos - o;
                return d.code ? q === h ? (d.code = !1, n) : (d.formatting = m, K(d)) : (h = q, d.code = !0, K(d))
            }
            if (d.code)return K(d);
            if ("!" === j && b.match(/\[[^\]]*\] ?(?:\(|\[)/, !1))return b.match(/\[[^\]]*\]/), d.inline = d.f = O, p;
            if ("[" === j && b.match(/.*\](\(| ?\[)/, !1))return d.linkText = !0, c.highlightFormatting && (d.formatting = "link"), K(d);
            if ("]" === j && d.linkText) {
                c.highlightFormatting && (d.formatting = "link");
                var t = K(d);
                return d.linkText = !1, d.inline = d.f = O, t
            }
            if ("<" === j && b.match(/^(https?|ftps?):\/\/(?:[^\\>]|\\.)+>/, !1)) {
                d.f = d.inline = N, c.highlightFormatting && (d.formatting = "link");
                var t = K(d);
                return t ? t += " " : t = "", t + r
            }
            if ("<" === j && b.match(/^[^> \\]+@(?:[^\\>]|\\.)+>/, !1)) {
                d.f = d.inline = N, c.highlightFormatting && (d.formatting = "link");
                var t = K(d);
                return t ? t += " " : t = "", t + s
            }
            if ("<" === j && b.match(/^\w/, !1)) {
                if (-1 != b.string.indexOf(">")) {
                    var v = b.string.substring(1, b.string.indexOf(">"));
                    /markdown\s*=\s*('|"){0,1}1('|"){0,1}/.test(v) && (d.md_inside = !0)
                }
                return b.backUp(1), d.htmlState = a.startState(e), F(b, d, I)
            }
            if ("<" === j && b.match(/^\/\w*?>/))return d.md_inside = !1, "tag";
            var w = !1;
            if (!c.underscoresBreakWords && "_" === j && "_" !== b.peek() && b.match(/(\w)/, !1)) {
                var x = b.pos - 2;
                if (x >= 0) {
                    var y = b.string.charAt(x);
                    "_" !== y && y.match(/(\w)/, !1) && (w = !0)
                }
            }
            if ("*" === j || "_" === j && !w)if (i && " " === b.peek()); else {
                if (d.strong === j && b.eat(j)) {
                    c.highlightFormatting && (d.formatting = "strong");
                    var n = K(d);
                    return d.strong = !1, n
                }
                if (!d.strong && b.eat(j))return d.strong = j, c.highlightFormatting && (d.formatting = "strong"), K(d);
                if (d.em === j) {
                    c.highlightFormatting && (d.formatting = "em");
                    var n = K(d);
                    return d.em = !1, n
                }
                if (!d.em)return d.em = j, c.highlightFormatting && (d.formatting = "em"), K(d)
            } else if (" " === j && (b.eat("*") || b.eat("_"))) {
                if (" " === b.peek())return K(d);
                b.backUp(1)
            }
            return " " === j && (b.match(/ +$/, !1) ? d.trailingSpace++ : d.trailingSpace && (d.trailingSpaceNewLine = !0)), K(d)
        }

        function N(a, b) {
            var d = a.next();
            if (">" === d) {
                b.f = b.inline = M, c.highlightFormatting && (b.formatting = "link");
                var e = K(b);
                return e ? e += " " : e = "", e + r
            }
            return a.match(/^[^>]+/, !0), r
        }

        function O(a, b) {
            if (a.eatSpace())return null;
            var d = a.next();
            return "(" === d || "[" === d ? (b.f = b.inline = P("(" === d ? ")" : "]"), c.highlightFormatting && (b.formatting = "link-string"), b.linkHref = !0, K(b)) : "error"
        }

        function P(a) {
            return function (b, d) {
                var e = b.next();
                if (e === a) {
                    d.f = d.inline = M, c.highlightFormatting && (d.formatting = "link-string");
                    var f = K(d);
                    return d.linkHref = !1, f
                }
                return b.match(U(a), !0) && b.backUp(1), d.linkHref = !0, K(d)
            }
        }

        function Q(a, b) {
            return a.match(/^[^\]]*\]:/, !1) ? (b.f = R, a.next(), c.highlightFormatting && (b.formatting = "link"), b.linkText = !0, K(b)) : E(a, b, M)
        }

        function R(a, b) {
            if (a.match(/^\]:/, !0)) {
                b.f = b.inline = S, c.highlightFormatting && (b.formatting = "link");
                var d = K(b);
                return b.linkText = !1, d
            }
            return a.match(/^[^\]]+/, !0), t
        }

        function S(a, b) {
            return a.eatSpace() ? null : (a.match(/^[^\s]+/, !0), void 0 === a.peek() ? b.linkTitle = !0 : a.match(/^(?:\s+(?:"(?:[^"\\]|\\\\|\\.)+"|'(?:[^'\\]|\\\\|\\.)+'|\((?:[^)\\]|\\\\|\\.)+\)))?/, !0), b.f = b.inline = M, u)
        }

        function U(a) {
            return T[a] || (a = (a + "").replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1"), T[a] = new RegExp("^(?:[^\\\\]|\\\\.)*?(" + a + ")")), T[a]
        }

        var d = a.modes.hasOwnProperty("xml"), e = a.getMode(b, d ? {
            name: "xml",
            htmlMode: !0
        } : "text/plain"), f = {
            html: "htmlmixed",
            js: "javascript",
            json: "application/json",
            c: "text/x-csrc",
            "c++": "text/x-c++src",
            java: "text/x-java",
            csharp: "text/x-csharp",
            "c#": "text/x-csharp",
            scala: "text/x-scala"
        }, g = function () {
            var c, g, d = {}, e = {}, h = [];
            for (var i in a.modes)a.modes.propertyIsEnumerable(i) && h.push(i);
            for (c = 0; c < h.length; c++)d[h[c]] = h[c];
            var j = [];
            for (var i in a.mimeModes)a.mimeModes.propertyIsEnumerable(i) && j.push({mime: i, mode: a.mimeModes[i]});
            for (c = 0; c < j.length; c++)g = j[c].mime, e[g] = j[c].mime;
            for (var k in f)(f[k]in d || f[k]in e) && (d[k] = f[k]);
            return function (c) {
                return d[c] ? a.getMode(b, d[c]) : null
            }
        }();
        void 0 === c.highlightFormatting && (c.highlightFormatting = !1), void 0 === c.maxBlockquoteDepth && (c.maxBlockquoteDepth = 0), void 0 === c.underscoresBreakWords && (c.underscoresBreakWords = !0), void 0 === c.fencedCodeBlocks && (c.fencedCodeBlocks = !1), void 0 === c.taskLists && (c.taskLists = !1);
        var h = 0, i = "header", j = "comment", k = "quote", l = "variable-2", m = "variable-3", n = "keyword", o = "hr", p = "tag", q = "formatting", r = "link", s = "link", t = "link", u = "string", v = "em", w = "strong", x = /^([*\-=_])(?:\s*\1){2,}\s*$/, y = /^[*\-+]\s+/, z = /^[0-9]+\.\s+/, A = /^\[(x| )\](?=\s)/, B = /^#+/, C = /^(?:\={1,}|-{1,})$/, D = /^[^#!\[\]*_\\<>` "'(]+/, T = [], V = {
            startState: function () {
                return {
                    f: H,
                    prevLineHasContent: !1,
                    thisLineHasContent: !1,
                    block: H,
                    htmlState: null,
                    indentation: 0,
                    inline: M,
                    text: L,
                    escape: !1,
                    formatting: !1,
                    linkText: !1,
                    linkHref: !1,
                    linkTitle: !1,
                    em: !1,
                    strong: !1,
                    header: 0,
                    taskList: !1,
                    list: !1,
                    listDepth: 0,
                    quote: 0,
                    trailingSpace: 0,
                    trailingSpaceNewLine: !1
                }
            }, copyState: function (b) {
                return {
                    f: b.f,
                    prevLineHasContent: b.prevLineHasContent,
                    thisLineHasContent: b.thisLineHasContent,
                    block: b.block,
                    htmlState: b.htmlState && a.copyState(e, b.htmlState),
                    indentation: b.indentation,
                    localMode: b.localMode,
                    localState: b.localMode ? a.copyState(b.localMode, b.localState) : null,
                    inline: b.inline,
                    text: b.text,
                    escape: !1,
                    formatting: !1,
                    linkTitle: b.linkTitle,
                    em: b.em,
                    strong: b.strong,
                    header: b.header,
                    taskList: b.taskList,
                    list: b.list,
                    listDepth: b.listDepth,
                    quote: b.quote,
                    trailingSpace: b.trailingSpace,
                    trailingSpaceNewLine: b.trailingSpaceNewLine,
                    md_inside: b.md_inside
                }
            }, token: function (a, b) {
                if (b.formatting = !1, a.sol()) {
                    var c = a.match(/^\s*$/, !0) || b.header;
                    if (b.header = 0, c)return b.prevLineHasContent = !1, G(b);
                    b.prevLineHasContent = b.thisLineHasContent, b.thisLineHasContent = !0, b.escape = !1, b.taskList = !1, b.code = !1, b.trailingSpace = 0, b.trailingSpaceNewLine = !1, b.f = b.block;
                    var d = a.match(/^\s*/, !0)[0].replace(/\t/g, "    ").length, e = 4 * Math.floor((d - b.indentation) / 4);
                    e > 4 && (e = 4);
                    var f = b.indentation + e;
                    if (b.indentationDiff = f - b.indentation, b.indentation = f, d > 0)return null
                }
                var g = b.f(a, b);
                return a.start == a.pos ? this.token(a, b) : g
            }, innerMode: function (a) {
                return a.block == I ? {state: a.htmlState, mode: e} : a.localState ? {
                    state: a.localState,
                    mode: a.localMode
                } : {state: a, mode: V}
            }, blankLine: G, getType: K, fold: "markdown"
        };
        return V
    }, "xml"), a.defineMIME("text/x-markdown", "markdown")
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../htmlmixed/htmlmixed"), require("../clike/clike")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../htmlmixed/htmlmixed", "../clike/clike"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function b(a) {
        for (var b = {}, c = a.split(" "), d = 0; d < c.length; ++d)b[c[d]] = !0;
        return b
    }

    function c(a) {
        return function (b, c) {
            return b.match(a) ? c.tokenize = null : b.skipToEnd(), "string"
        }
    }

    function d(a) {
        return 0 == a.length ? e : function (b, c) {
            for (var f = a[0], g = 0; g < f.length; g++)if (b.match(f[g][0]))return c.tokenize = d(a.slice(1)), f[g][1];
            return c.tokenize = e, "string"
        }
    }

    function e(a, b) {
        var e, c = !1, f = !1;
        if ('"' == a.current())return "string";
        if (a.match("${", !1) || a.match("{$", !1))return b.tokenize = null, "string";
        if (a.match(/\$[a-zA-Z_][a-zA-Z0-9_]*/))return a.match("[", !1) && (b.tokenize = d([[["[", null]], [[/\d[\w\.]*/, "number"], [/\$[a-zA-Z_][a-zA-Z0-9_]*/, "variable-2"], [/[\w\$]+/, "variable"]], [["]", null]]])), a.match(/\-\>\w/, !1) && (b.tokenize = d([[["->", null]], [[/[\w]+/, "variable"]]])), "variable-2";
        for (; !(a.eol() || a.match("{$", !1) || a.match(/(\$[a-zA-Z_][a-zA-Z0-9_]*|\$\{)/, !1) && !c);) {
            if (e = a.next(), !c && '"' == e) {
                f = !0;
                break
            }
            c = !c && "\\" == e
        }
        return f && (b.tokenize = null, b.phpEncapsStack.pop()), "string"
    }

    var f = "abstract and array as break case catch class clone const continue declare default do else elseif enddeclare endfor endforeach endif endswitch endwhile extends final for foreach function global goto if implements interface instanceof namespace new or private protected public static switch throw trait try use var while xor die echo empty exit eval include include_once isset list require require_once return print unset __halt_compiler self static parent yield insteadof finally", g = "true false null TRUE FALSE NULL __CLASS__ __DIR__ __FILE__ __LINE__ __METHOD__ __FUNCTION__ __NAMESPACE__ __TRAIT__", h = "func_num_args func_get_arg func_get_args strlen strcmp strncmp strcasecmp strncasecmp each error_reporting define defined trigger_error user_error set_error_handler restore_error_handler get_declared_classes get_loaded_extensions extension_loaded get_extension_funcs debug_backtrace constant bin2hex hex2bin sleep usleep time mktime gmmktime strftime gmstrftime strtotime date gmdate getdate localtime checkdate flush wordwrap htmlspecialchars htmlentities html_entity_decode md5 md5_file crc32 getimagesize image_type_to_mime_type phpinfo phpversion phpcredits strnatcmp strnatcasecmp substr_count strspn strcspn strtok strtoupper strtolower strpos strrpos strrev hebrev hebrevc nl2br basename dirname pathinfo stripslashes stripcslashes strstr stristr strrchr str_shuffle str_word_count strcoll substr substr_replace quotemeta ucfirst ucwords strtr addslashes addcslashes rtrim str_replace str_repeat count_chars chunk_split trim ltrim strip_tags similar_text explode implode setlocale localeconv parse_str str_pad chop strchr sprintf printf vprintf vsprintf sscanf fscanf parse_url urlencode urldecode rawurlencode rawurldecode readlink linkinfo link unlink exec system escapeshellcmd escapeshellarg passthru shell_exec proc_open proc_close rand srand getrandmax mt_rand mt_srand mt_getrandmax base64_decode base64_encode abs ceil floor round is_finite is_nan is_infinite bindec hexdec octdec decbin decoct dechex base_convert number_format fmod ip2long long2ip getenv putenv getopt microtime gettimeofday getrusage uniqid quoted_printable_decode set_time_limit get_cfg_var magic_quotes_runtime set_magic_quotes_runtime get_magic_quotes_gpc get_magic_quotes_runtime import_request_variables error_log serialize unserialize memory_get_usage var_dump var_export debug_zval_dump print_r highlight_file show_source highlight_string ini_get ini_get_all ini_set ini_alter ini_restore get_include_path set_include_path restore_include_path setcookie header headers_sent connection_aborted connection_status ignore_user_abort parse_ini_file is_uploaded_file move_uploaded_file intval floatval doubleval strval gettype settype is_null is_resource is_bool is_long is_float is_int is_integer is_double is_real is_numeric is_string is_array is_object is_scalar ereg ereg_replace eregi eregi_replace split spliti join sql_regcase dl pclose popen readfile rewind rmdir umask fclose feof fgetc fgets fgetss fread fopen fpassthru ftruncate fstat fseek ftell fflush fwrite fputs mkdir rename copy tempnam tmpfile file file_get_contents stream_select stream_context_create stream_context_set_params stream_context_set_option stream_context_get_options stream_filter_prepend stream_filter_append fgetcsv flock get_meta_tags stream_set_write_buffer set_file_buffer set_socket_blocking stream_set_blocking socket_set_blocking stream_get_meta_data stream_register_wrapper stream_wrapper_register stream_set_timeout socket_set_timeout socket_get_status realpath fnmatch fsockopen pfsockopen pack unpack get_browser crypt opendir closedir chdir getcwd rewinddir readdir dir glob fileatime filectime filegroup fileinode filemtime fileowner fileperms filesize filetype file_exists is_writable is_writeable is_readable is_executable is_file is_dir is_link stat lstat chown touch clearstatcache mail ob_start ob_flush ob_clean ob_end_flush ob_end_clean ob_get_flush ob_get_clean ob_get_length ob_get_level ob_get_status ob_get_contents ob_implicit_flush ob_list_handlers ksort krsort natsort natcasesort asort arsort sort rsort usort uasort uksort shuffle array_walk count end prev next reset current key min max in_array array_search extract compact array_fill range array_multisort array_push array_pop array_shift array_unshift array_splice array_slice array_merge array_merge_recursive array_keys array_values array_count_values array_reverse array_reduce array_pad array_flip array_change_key_case array_rand array_unique array_intersect array_intersect_assoc array_diff array_diff_assoc array_sum array_filter array_map array_chunk array_key_exists pos sizeof key_exists assert assert_options version_compare ftok str_rot13 aggregate session_name session_module_name session_save_path session_id session_regenerate_id session_decode session_register session_unregister session_is_registered session_encode session_start session_destroy session_unset session_set_save_handler session_cache_limiter session_cache_expire session_set_cookie_params session_get_cookie_params session_write_close preg_match preg_match_all preg_replace preg_replace_callback preg_split preg_quote preg_grep overload ctype_alnum ctype_alpha ctype_cntrl ctype_digit ctype_lower ctype_graph ctype_print ctype_punct ctype_space ctype_upper ctype_xdigit virtual apache_request_headers apache_note apache_lookup_uri apache_child_terminate apache_setenv apache_response_headers apache_get_version getallheaders mysql_connect mysql_pconnect mysql_close mysql_select_db mysql_create_db mysql_drop_db mysql_query mysql_unbuffered_query mysql_db_query mysql_list_dbs mysql_list_tables mysql_list_fields mysql_list_processes mysql_error mysql_errno mysql_affected_rows mysql_insert_id mysql_result mysql_num_rows mysql_num_fields mysql_fetch_row mysql_fetch_array mysql_fetch_assoc mysql_fetch_object mysql_data_seek mysql_fetch_lengths mysql_fetch_field mysql_field_seek mysql_free_result mysql_field_name mysql_field_table mysql_field_len mysql_field_type mysql_field_flags mysql_escape_string mysql_real_escape_string mysql_stat mysql_thread_id mysql_client_encoding mysql_get_client_info mysql_get_host_info mysql_get_proto_info mysql_get_server_info mysql_info mysql mysql_fieldname mysql_fieldtable mysql_fieldlen mysql_fieldtype mysql_fieldflags mysql_selectdb mysql_createdb mysql_dropdb mysql_freeresult mysql_numfields mysql_numrows mysql_listdbs mysql_listtables mysql_listfields mysql_db_name mysql_dbname mysql_tablename mysql_table_name pg_connect pg_pconnect pg_close pg_connection_status pg_connection_busy pg_connection_reset pg_host pg_dbname pg_port pg_tty pg_options pg_ping pg_query pg_send_query pg_cancel_query pg_fetch_result pg_fetch_row pg_fetch_assoc pg_fetch_array pg_fetch_object pg_fetch_all pg_affected_rows pg_get_result pg_result_seek pg_result_status pg_free_result pg_last_oid pg_num_rows pg_num_fields pg_field_name pg_field_num pg_field_size pg_field_type pg_field_prtlen pg_field_is_null pg_get_notify pg_get_pid pg_result_error pg_last_error pg_last_notice pg_put_line pg_end_copy pg_copy_to pg_copy_from pg_trace pg_untrace pg_lo_create pg_lo_unlink pg_lo_open pg_lo_close pg_lo_read pg_lo_write pg_lo_read_all pg_lo_import pg_lo_export pg_lo_seek pg_lo_tell pg_escape_string pg_escape_bytea pg_unescape_bytea pg_client_encoding pg_set_client_encoding pg_meta_data pg_convert pg_insert pg_update pg_delete pg_select pg_exec pg_getlastoid pg_cmdtuples pg_errormessage pg_numrows pg_numfields pg_fieldname pg_fieldsize pg_fieldtype pg_fieldnum pg_fieldprtlen pg_fieldisnull pg_freeresult pg_result pg_loreadall pg_locreate pg_lounlink pg_loopen pg_loclose pg_loread pg_lowrite pg_loimport pg_loexport http_response_code get_declared_traits getimagesizefromstring socket_import_stream stream_set_chunk_size trait_exists header_register_callback class_uses session_status session_register_shutdown echo print global static exit array empty eval isset unset die include require include_once require_once";
    a.registerHelper("hintWords", "php", [f, g, h].join(" ").split(" ")), a.registerHelper("wordChars", "php", /[\\w$]/);
    var i = {
        name: "clike",
        helperType: "php",
        keywords: b(f),
        blockKeywords: b("catch do else elseif for foreach if switch try while finally"),
        atoms: b(g),
        builtin: b(h),
        multiLineStrings: !0,
        hooks: {
            $: function (a) {
                return a.eatWhile(/[\w\$_]/), "variable-2"
            }, "<": function (a, b) {
                return a.match(/<</) ? (a.eatWhile(/[\w\.]/), b.tokenize = c(a.current().slice(3)), b.tokenize(a, b)) : !1
            }, "#": function (a) {
                for (; !a.eol() && !a.match("?>", !1);)a.next();
                return "comment"
            }, "/": function (a) {
                if (a.eat("/")) {
                    for (; !a.eol() && !a.match("?>", !1);)a.next();
                    return "comment"
                }
                return !1
            }, '"': function (a, b) {
                return b.phpEncapsStack || (b.phpEncapsStack = []), b.phpEncapsStack.push(0), b.tokenize = e, b.tokenize(a, b)
            }, "{": function (a, b) {
                return b.phpEncapsStack && b.phpEncapsStack.length > 0 && b.phpEncapsStack[b.phpEncapsStack.length - 1]++, !1
            }, "}": function (a, b) {
                return b.phpEncapsStack && b.phpEncapsStack.length > 0 && 0 == --b.phpEncapsStack[b.phpEncapsStack.length - 1] && (b.tokenize = e), !1
            }
        }
    };
    a.defineMode("php", function (b, c) {
        function f(a, b) {
            var c = b.curMode == e;
            if (a.sol() && b.pending && '"' != b.pending && "'" != b.pending && (b.pending = null), c)return c && null == b.php.tokenize && a.match("?>") ? (b.curMode = d, b.curState = b.html, "meta") : e.token(a, b.curState);
            if (a.match(/^<\?\w*/))return b.curMode = e, b.curState = b.php, "meta";
            if ('"' == b.pending || "'" == b.pending) {
                for (; !a.eol() && a.next() != b.pending;);
                var f = "string"
            } else if (b.pending && a.pos < b.pending.end) {
                a.pos = b.pending.end;
                var f = b.pending.style
            } else var f = d.token(a, b.curState);
            b.pending && (b.pending = null);
            var i, g = a.current(), h = g.search(/<\?/);
            return -1 != h && (b.pending = "string" == f && (i = g.match(/[\'\"]$/)) && !/\?>/.test(g) ? i[0] : {
                end: a.pos,
                style: f
            }, a.backUp(g.length - h)), f
        }

        var d = a.getMode(b, "text/html"), e = a.getMode(b, i);
        return {
            startState: function () {
                var b = a.startState(d), f = a.startState(e);
                return {html: b, php: f, curMode: c.startOpen ? e : d, curState: c.startOpen ? f : b, pending: null}
            }, copyState: function (b) {
                var i, c = b.html, f = a.copyState(d, c), g = b.php, h = a.copyState(e, g);
                return i = b.curMode == d ? f : h, {
                    html: f,
                    php: h,
                    curMode: b.curMode,
                    curState: i,
                    pending: b.pending
                }
            }, token: f, indent: function (a, b) {
                return a.curMode != e && /^\s*<\//.test(b) || a.curMode == e && /^\?>/.test(b) ? d.indent(a.html, b) : a.curMode.indent(a.curState, b)
            }, blockCommentStart: "/*", blockCommentEnd: "*/", lineComment: "//", innerMode: function (a) {
                return {state: a.curState, mode: a.curMode}
            }
        }
    }, "htmlmixed", "clike"), a.defineMIME("application/x-httpd-php", "php"), a.defineMIME("application/x-httpd-php-open", {
        name: "php",
        startOpen: !0
    }), a.defineMIME("text/x-php", i)
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("sql", function (a, b) {
        function k(a, b) {
            var k = a.next();
            if (i[k]) {
                var n = i[k](a, b);
                if (n !== !1)return n
            }
            if (1 == h.hexNumber && ("0" == k && a.match(/^[xX][0-9a-fA-F]+/) || ("x" == k || "X" == k) && a.match(/^'[0-9a-fA-F]+'/)))return "number";
            if (1 == h.binaryNumber && (("b" == k || "B" == k) && a.match(/^'[01]+'/) || "0" == k && a.match(/^b[01]+/)))return "number";
            if (k.charCodeAt(0) > 47 && k.charCodeAt(0) < 58)return a.match(/^[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?/), 1 == h.decimallessFloat && a.eat("."), "number";
            if ("?" == k && (a.eatSpace() || a.eol() || a.eat(";")))return "variable-3";
            if ("'" == k || '"' == k && h.doubleQuote)return b.tokenize = l(k), b.tokenize(a, b);
            if ((1 == h.nCharCast && ("n" == k || "N" == k) || 1 == h.charsetCast && "_" == k && a.match(/[a-z][a-z0-9]*/i)) && ("'" == a.peek() || '"' == a.peek()))return "keyword";
            if (/^[\(\),\;\[\]]/.test(k))return null;
            if (h.commentSlashSlash && "/" == k && a.eat("/"))return a.skipToEnd(), "comment";
            if (h.commentHash && "#" == k || "-" == k && a.eat("-") && (!h.commentSpaceRequired || a.eat(" ")))return a.skipToEnd(), "comment";
            if ("/" == k && a.eat("*"))return b.tokenize = m, b.tokenize(a, b);
            if ("." != k) {
                if (g.test(k))return a.eatWhile(g), null;
                if ("{" == k && (a.match(/^( )*(d|D|t|T|ts|TS)( )*'[^']*'( )*}/) || a.match(/^( )*(d|D|t|T|ts|TS)( )*"[^"]*"( )*}/)))return "number";
                a.eatWhile(/^[_\w\d]/);
                var o = a.current().toLowerCase();
                return j.hasOwnProperty(o) && (a.match(/^( )+'[^']*'/) || a.match(/^( )+"[^"]*"/)) ? "number" : d.hasOwnProperty(o) ? "atom" : e.hasOwnProperty(o) ? "builtin" : f.hasOwnProperty(o) ? "keyword" : c.hasOwnProperty(o) ? "string-2" : null
            }
            return 1 == h.zerolessFloat && a.match(/^(?:\d+(?:e[+-]?\d+)?)/i) ? "number" : 1 == h.ODBCdotTable && a.match(/^[a-zA-Z_]+/) ? "variable-2" : void 0
        }

        function l(a) {
            return function (b, c) {
                for (var e, d = !1; null != (e = b.next());) {
                    if (e == a && !d) {
                        c.tokenize = k;
                        break
                    }
                    d = !d && "\\" == e
                }
                return "string"
            }
        }

        function m(a, b) {
            for (; ;) {
                if (!a.skipTo("*")) {
                    a.skipToEnd();
                    break
                }
                if (a.next(), a.eat("/")) {
                    b.tokenize = k;
                    break
                }
            }
            return "comment"
        }

        function n(a, b, c) {
            b.context = {prev: b.context, indent: a.indentation(), col: a.column(), type: c}
        }

        function o(a) {
            a.indent = a.context.indent, a.context = a.context.prev
        }

        var c = b.client || {}, d = b.atoms || {
                "false": !0,
                "true": !0,
                "null": !0
            }, e = b.builtin || {}, f = b.keywords || {}, g = b.operatorChars || /^[*+\-%<>!=&|~^]/, h = b.support || {}, i = b.hooks || {}, j = b.dateSQL || {
                date: !0,
                time: !0,
                timestamp: !0
            };
        return {
            startState: function () {
                return {tokenize: k, context: null}
            },
            token: function (a, b) {
                if (a.sol() && b.context && null == b.context.align && (b.context.align = !1), a.eatSpace())return null;
                var c = b.tokenize(a, b);
                if ("comment" == c)return c;
                b.context && null == b.context.align && (b.context.align = !0);
                var d = a.current();
                return "(" == d ? n(a, b, ")") : "[" == d ? n(a, b, "]") : b.context && b.context.type == d && o(b), c
            },
            indent: function (b, c) {
                var d = b.context;
                if (!d)return 0;
                var e = c.charAt(0) == d.type;
                return d.align ? d.col + (e ? 0 : 1) : d.indent + (e ? 0 : a.indentUnit)
            },
            blockCommentStart: "/*",
            blockCommentEnd: "*/",
            lineComment: h.commentSlashSlash ? "//" : h.commentHash ? "#" : null
        }
    }), function () {
        function b(a) {
            for (var b; null != (b = a.next());)if ("`" == b && !a.eat("`"))return "variable-2";
            return null
        }

        function c(a) {
            return a.eat("@") && (a.match(/^session\./), a.match(/^local\./), a.match(/^global\./)), a.eat("'") ? (a.match(/^.*'/), "variable-2") : a.eat('"') ? (a.match(/^.*"/), "variable-2") : a.eat("`") ? (a.match(/^.*`/), "variable-2") : a.match(/^[0-9a-zA-Z$\.\_]+/) ? "variable-2" : null
        }

        function d(a) {
            return a.eat("N") ? "atom" : a.match(/^[a-zA-Z.#!?]/) ? "variable-2" : null
        }

        function f(a) {
            for (var b = {}, c = a.split(" "), d = 0; d < c.length; ++d)b[c[d]] = !0;
            return b
        }

        var e = "alter and as asc between by count create delete desc distinct drop from having in insert into is join like not on or order select set table union update values where ";
        a.defineMIME("text/x-sql", {
            name: "sql",
            keywords: f(e + "begin"),
            builtin: f("bool boolean bit blob enum long longblob longtext medium mediumblob mediumint mediumtext time timestamp tinyblob tinyint tinytext text bigint int int1 int2 int3 int4 int8 integer float float4 float8 double char varbinary varchar varcharacter precision real date datetime year unsigned signed decimal numeric"),
            atoms: f("false true null unknown"),
            operatorChars: /^[*+\-%<>!=]/,
            dateSQL: f("date time timestamp"),
            support: f("ODBCdotTable doubleQuote binaryNumber hexNumber")
        }), a.defineMIME("text/x-mssql", {
            name: "sql",
            client: f("charset clear connect edit ego exit go help nopager notee nowarning pager print prompt quit rehash source status system tee"),
            keywords: f(e + "begin trigger proc view index for add constraint key primary foreign collate clustered nonclustered"),
            builtin: f("bigint numeric bit smallint decimal smallmoney int tinyint money float real char varchar text nchar nvarchar ntext binary varbinary image cursor timestamp hierarchyid uniqueidentifier sql_variant xml table "),
            atoms: f("false true null unknown"),
            operatorChars: /^[*+\-%<>!=]/,
            dateSQL: f("date datetimeoffset datetime2 smalldatetime datetime time"),
            hooks: {"@": c}
        }), a.defineMIME("text/x-mysql", {
            name: "sql",
            client: f("charset clear connect edit ego exit go help nopager notee nowarning pager print prompt quit rehash source status system tee"),
            keywords: f(e + "accessible action add after algorithm all analyze asensitive at authors auto_increment autocommit avg avg_row_length before binary binlog both btree cache call cascade cascaded case catalog_name chain change changed character check checkpoint checksum class_origin client_statistics close coalesce code collate collation collations column columns comment commit committed completion concurrent condition connection consistent constraint contains continue contributors convert cross current current_date current_time current_timestamp current_user cursor data database databases day_hour day_microsecond day_minute day_second deallocate dec declare default delay_key_write delayed delimiter des_key_file describe deterministic dev_pop dev_samp deviance diagnostics directory disable discard distinctrow div dual dumpfile each elseif enable enclosed end ends engine engines enum errors escape escaped even event events every execute exists exit explain extended fast fetch field fields first flush for force foreign found_rows full fulltext function general get global grant grants group groupby_concat handler hash help high_priority hosts hour_microsecond hour_minute hour_second if ignore ignore_server_ids import index index_statistics infile inner innodb inout insensitive insert_method install interval invoker isolation iterate key keys kill language last leading leave left level limit linear lines list load local localtime localtimestamp lock logs low_priority master master_heartbeat_period master_ssl_verify_server_cert masters match max max_rows maxvalue message_text middleint migrate min min_rows minute_microsecond minute_second mod mode modifies modify mutex mysql_errno natural next no no_write_to_binlog offline offset one online open optimize option optionally out outer outfile pack_keys parser partition partitions password phase plugin plugins prepare preserve prev primary privileges procedure processlist profile profiles purge query quick range read read_write reads real rebuild recover references regexp relaylog release remove rename reorganize repair repeatable replace require resignal restrict resume return returns revoke right rlike rollback rollup row row_format rtree savepoint schedule schema schema_name schemas second_microsecond security sensitive separator serializable server session share show signal slave slow smallint snapshot soname spatial specific sql sql_big_result sql_buffer_result sql_cache sql_calc_found_rows sql_no_cache sql_small_result sqlexception sqlstate sqlwarning ssl start starting starts status std stddev stddev_pop stddev_samp storage straight_join subclass_origin sum suspend table_name table_statistics tables tablespace temporary terminated to trailing transaction trigger triggers truncate uncommitted undo uninstall unique unlock upgrade usage use use_frm user user_resources user_statistics using utc_date utc_time utc_timestamp value variables varying view views warnings when while with work write xa xor year_month zerofill begin do then else loop repeat"),
            builtin: f("bool boolean bit blob decimal double float long longblob longtext medium mediumblob mediumint mediumtext time timestamp tinyblob tinyint tinytext text bigint int int1 int2 int3 int4 int8 integer float float4 float8 double char varbinary varchar varcharacter precision date datetime year unsigned signed numeric"),
            atoms: f("false true null unknown"),
            operatorChars: /^[*+\-%<>!=&|^]/,
            dateSQL: f("date time timestamp"),
            support: f("ODBCdotTable decimallessFloat zerolessFloat binaryNumber hexNumber doubleQuote nCharCast charsetCast commentHash commentSpaceRequired"),
            hooks: {"@": c, "`": b, "\\": d}
        }), a.defineMIME("text/x-mariadb", {
            name: "sql",
            client: f("charset clear connect edit ego exit go help nopager notee nowarning pager print prompt quit rehash source status system tee"),
            keywords: f(e + "accessible action add after algorithm all always analyze asensitive at authors auto_increment autocommit avg avg_row_length before binary binlog both btree cache call cascade cascaded case catalog_name chain change changed character check checkpoint checksum class_origin client_statistics close coalesce code collate collation collations column columns comment commit committed completion concurrent condition connection consistent constraint contains continue contributors convert cross current current_date current_time current_timestamp current_user cursor data database databases day_hour day_microsecond day_minute day_second deallocate dec declare default delay_key_write delayed delimiter des_key_file describe deterministic dev_pop dev_samp deviance diagnostics directory disable discard distinctrow div dual dumpfile each elseif enable enclosed end ends engine engines enum errors escape escaped even event events every execute exists exit explain extended fast fetch field fields first flush for force foreign found_rows full fulltext function general generated get global grant grants group groupby_concat handler hard hash help high_priority hosts hour_microsecond hour_minute hour_second if ignore ignore_server_ids import index index_statistics infile inner innodb inout insensitive insert_method install interval invoker isolation iterate key keys kill language last leading leave left level limit linear lines list load local localtime localtimestamp lock logs low_priority master master_heartbeat_period master_ssl_verify_server_cert masters match max max_rows maxvalue message_text middleint migrate min min_rows minute_microsecond minute_second mod mode modifies modify mutex mysql_errno natural next no no_write_to_binlog offline offset one online open optimize option optionally out outer outfile pack_keys parser partition partitions password persistent phase plugin plugins prepare preserve prev primary privileges procedure processlist profile profiles purge query quick range read read_write reads real rebuild recover references regexp relaylog release remove rename reorganize repair repeatable replace require resignal restrict resume return returns revoke right rlike rollback rollup row row_format rtree savepoint schedule schema schema_name schemas second_microsecond security sensitive separator serializable server session share show shutdown signal slave slow smallint snapshot soft soname spatial specific sql sql_big_result sql_buffer_result sql_cache sql_calc_found_rows sql_no_cache sql_small_result sqlexception sqlstate sqlwarning ssl start starting starts status std stddev stddev_pop stddev_samp storage straight_join subclass_origin sum suspend table_name table_statistics tables tablespace temporary terminated to trailing transaction trigger triggers truncate uncommitted undo uninstall unique unlock upgrade usage use use_frm user user_resources user_statistics using utc_date utc_time utc_timestamp value variables varying view views virtual warnings when while with work write xa xor year_month zerofill begin do then else loop repeat"),
            builtin: f("bool boolean bit blob decimal double float long longblob longtext medium mediumblob mediumint mediumtext time timestamp tinyblob tinyint tinytext text bigint int int1 int2 int3 int4 int8 integer float float4 float8 double char varbinary varchar varcharacter precision date datetime year unsigned signed numeric"),
            atoms: f("false true null unknown"),
            operatorChars: /^[*+\-%<>!=&|^]/,
            dateSQL: f("date time timestamp"),
            support: f("ODBCdotTable decimallessFloat zerolessFloat binaryNumber hexNumber doubleQuote nCharCast charsetCast commentHash commentSpaceRequired"),
            hooks: {"@": c, "`": b, "\\": d}
        }), a.defineMIME("text/x-cassandra", {
            name: "sql",
            client: {},
            keywords: f("use select from using consistency where limit first reversed first and in insert into values using consistency ttl update set delete truncate begin batch apply create keyspace with columnfamily primary key index on drop alter type add any one quorum all local_quorum each_quorum"),
            builtin: f("ascii bigint blob boolean counter decimal double float int text timestamp uuid varchar varint"),
            atoms: f("false true"),
            operatorChars: /^[<>=]/,
            dateSQL: {},
            support: f("commentSlashSlash decimallessFloat"),
            hooks: {}
        }), a.defineMIME("text/x-plsql", {
            name: "sql",
            client: f("appinfo arraysize autocommit autoprint autorecovery autotrace blockterminator break btitle cmdsep colsep compatibility compute concat copycommit copytypecheck define describe echo editfile embedded escape exec execute feedback flagger flush heading headsep instance linesize lno loboffset logsource long longchunksize markup native newpage numformat numwidth pagesize pause pno recsep recsepchar release repfooter repheader serveroutput shiftinout show showmode size spool sqlblanklines sqlcase sqlcode sqlcontinue sqlnumber sqlpluscompatibility sqlprefix sqlprompt sqlterminator suffix tab term termout time timing trimout trimspool ttitle underline verify version wrap"),
            keywords: f("abort accept access add all alter and any array arraylen as asc assert assign at attributes audit authorization avg base_table begin between binary_integer body boolean by case cast char char_base check close cluster clusters colauth column comment commit compress connect connected constant constraint crash create current currval cursor data_base database date dba deallocate debugoff debugon decimal declare default definition delay delete desc digits dispose distinct do drop else elseif elsif enable end entry escape exception exception_init exchange exclusive exists exit external fast fetch file for force form from function generic goto grant group having identified if immediate in increment index indexes indicator initial initrans insert interface intersect into is key level library like limited local lock log logging long loop master maxextents maxtrans member minextents minus mislabel mode modify multiset new next no noaudit nocompress nologging noparallel not nowait number_base object of off offline on online only open option or order out package parallel partition pctfree pctincrease pctused pls_integer positive positiven pragma primary prior private privileges procedure public raise range raw read rebuild record ref references refresh release rename replace resource restrict return returning returns reverse revoke rollback row rowid rowlabel rownum rows run savepoint schema segment select separate session set share snapshot some space split sql start statement storage subtype successful synonym tabauth table tables tablespace task terminate then to trigger truncate type union unique unlimited unrecoverable unusable update use using validate value values variable view views when whenever where while with work"),
            builtin: f("abs acos add_months ascii asin atan atan2 average bfile bfilename bigserial bit blob ceil character chartorowid chr clob concat convert cos cosh count dec decode deref dual dump dup_val_on_index empty error exp false float floor found glb greatest hextoraw initcap instr instrb int integer isopen last_day least lenght lenghtb ln lower lpad ltrim lub make_ref max min mlslabel mod months_between natural naturaln nchar nclob new_time next_day nextval nls_charset_decl_len nls_charset_id nls_charset_name nls_initcap nls_lower nls_sort nls_upper nlssort no_data_found notfound null number numeric nvarchar2 nvl others power rawtohex real reftohex round rowcount rowidtochar rowtype rpad rtrim serial sign signtype sin sinh smallint soundex sqlcode sqlerrm sqrt stddev string substr substrb sum sysdate tan tanh to_char text to_date to_label to_multi_byte to_number to_single_byte translate true trunc uid unlogged upper user userenv varchar varchar2 variance varying vsize xml"),
            operatorChars: /^[*+\-%<>!=~]/,
            dateSQL: f("date time timestamp"),
            support: f("doubleQuote nCharCast zerolessFloat binaryNumber hexNumber")
        }), a.defineMIME("text/x-hive", {
            name: "sql",
            keywords: f("select alter $elem$ $key$ $value$ add after all analyze and archive as asc before between binary both bucket buckets by cascade case cast change cluster clustered clusterstatus collection column columns comment compute concatenate continue create cross cursor data database databases dbproperties deferred delete delimited desc describe directory disable distinct distribute drop else enable end escaped exclusive exists explain export extended external false fetch fields fileformat first format formatted from full function functions grant group having hold_ddltime idxproperties if import in index indexes inpath inputdriver inputformat insert intersect into is items join keys lateral left like limit lines load local location lock locks mapjoin materialized minus msck no_drop nocompress not of offline on option or order out outer outputdriver outputformat overwrite partition partitioned partitions percent plus preserve procedure purge range rcfile read readonly reads rebuild recordreader recordwriter recover reduce regexp rename repair replace restrict revoke right rlike row schema schemas semi sequencefile serde serdeproperties set shared show show_database sort sorted ssl statistics stored streamtable table tables tablesample tblproperties temporary terminated textfile then tmp to touch transform trigger true unarchive undo union uniquejoin unlock update use using utc utc_tmestamp view when where while with"),
            builtin: f("bool boolean long timestamp tinyint smallint bigint int float double date datetime unsigned string array struct map uniontype"),
            atoms: f("false true null unknown"),
            operatorChars: /^[*+\-%<>!=]/,
            dateSQL: f("date timestamp"),
            support: f("ODBCdotTable doubleQuote binaryNumber hexNumber")
        })
    }()
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("xml", function (b, c) {
        function k(a, b) {
            function c(c) {
                return b.tokenize = c, c(a, b)
            }

            var d = a.next();
            if ("<" == d)return a.eat("!") ? a.eat("[") ? a.match("CDATA[") ? c(n("atom", "]]>")) : null : a.match("--") ? c(n("comment", "-->")) : a.match("DOCTYPE", !0, !0) ? (a.eatWhile(/[\w\._\-]/), c(o(1))) : null : a.eat("?") ? (a.eatWhile(/[\w\._\-]/), b.tokenize = n("meta", "?>"), "meta") : (i = a.eat("/") ? "closeTag" : "openTag", b.tokenize = l, "tag bracket");
            if ("&" == d) {
                var e;
                return e = a.eat("#") ? a.eat("x") ? a.eatWhile(/[a-fA-F\d]/) && a.eat(";") : a.eatWhile(/[\d]/) && a.eat(";") : a.eatWhile(/[\w\.\-:]/) && a.eat(";"), e ? "atom" : "error"
            }
            return a.eatWhile(/[^&<]/), null
        }

        function l(a, b) {
            var c = a.next();
            if (">" == c || "/" == c && a.eat(">"))return b.tokenize = k, i = ">" == c ? "endTag" : "selfcloseTag", "tag bracket";
            if ("=" == c)return i = "equals", null;
            if ("<" == c) {
                b.tokenize = k, b.state = s, b.tagName = b.tagStart = null;
                var d = b.tokenize(a, b);
                return d ? d + " tag error" : "tag error"
            }
            return /[\'\"]/.test(c) ? (b.tokenize = m(c), b.stringStartCol = a.column(), b.tokenize(a, b)) : (a.match(/^[^\s\u00a0=<>\"\']*[^\s\u00a0=<>\"\'\/]/), "word")
        }

        function m(a) {
            var b = function (b, c) {
                for (; !b.eol();)if (b.next() == a) {
                    c.tokenize = l;
                    break
                }
                return "string"
            };
            return b.isInAttribute = !0, b
        }

        function n(a, b) {
            return function (c, d) {
                for (; !c.eol();) {
                    if (c.match(b)) {
                        d.tokenize = k;
                        break
                    }
                    c.next()
                }
                return a
            }
        }

        function o(a) {
            return function (b, c) {
                for (var d; null != (d = b.next());) {
                    if ("<" == d)return c.tokenize = o(a + 1), c.tokenize(b, c);
                    if (">" == d) {
                        if (1 == a) {
                            c.tokenize = k;
                            break
                        }
                        return c.tokenize = o(a - 1), c.tokenize(b, c)
                    }
                }
                return "meta"
            }
        }

        function p(a, b, c) {
            this.prev = a.context, this.tagName = b, this.indent = a.indented, this.startOfLine = c, (g.doNotIndent.hasOwnProperty(b) || a.context && a.context.noIndent) && (this.noIndent = !0)
        }

        function q(a) {
            a.context && (a.context = a.context.prev)
        }

        function r(a, b) {
            for (var c; ;) {
                if (!a.context)return;
                if (c = a.context.tagName, !g.contextGrabbers.hasOwnProperty(c) || !g.contextGrabbers[c].hasOwnProperty(b))return;
                q(a)
            }
        }

        function s(a, b, c) {
            return "openTag" == a ? (c.tagStart = b.column(), t) : "closeTag" == a ? u : s
        }

        function t(a, b, c) {
            return "word" == a ? (c.tagName = b.current(), j = "tag", x) : (j = "error", t)
        }

        function u(a, b, c) {
            if ("word" == a) {
                var d = b.current();
                return c.context && c.context.tagName != d && g.implicitlyClosed.hasOwnProperty(c.context.tagName) && q(c), c.context && c.context.tagName == d ? (j = "tag", v) : (j = "tag error", w)
            }
            return j = "error", w
        }

        function v(a, b, c) {
            return "endTag" != a ? (j = "error", v) : (q(c), s)
        }

        function w(a, b, c) {
            return j = "error", v(a, b, c)
        }

        function x(a, b, c) {
            if ("word" == a)return j = "attribute", y;
            if ("endTag" == a || "selfcloseTag" == a) {
                var d = c.tagName, e = c.tagStart;
                return c.tagName = c.tagStart = null, "selfcloseTag" == a || g.autoSelfClosers.hasOwnProperty(d) ? r(c, d) : (r(c, d), c.context = new p(c, d, e == c.indented)), s
            }
            return j = "error", x
        }

        function y(a, b, c) {
            return "equals" == a ? z : (g.allowMissing || (j = "error"), x(a, b, c))
        }

        function z(a, b, c) {
            return "string" == a ? A : "word" == a && g.allowUnquoted ? (j = "string", x) : (j = "error", x(a, b, c))
        }

        function A(a, b, c) {
            return "string" == a ? A : x(a, b, c)
        }

        var d = b.indentUnit, e = c.multilineTagIndentFactor || 1, f = c.multilineTagIndentPastTag;
        null == f && (f = !0);
        var i, j, g = c.htmlMode ? {
            autoSelfClosers: {
                area: !0,
                base: !0,
                br: !0,
                col: !0,
                command: !0,
                embed: !0,
                frame: !0,
                hr: !0,
                img: !0,
                input: !0,
                keygen: !0,
                link: !0,
                meta: !0,
                param: !0,
                source: !0,
                track: !0,
                wbr: !0
            },
            implicitlyClosed: {
                dd: !0,
                li: !0,
                optgroup: !0,
                option: !0,
                p: !0,
                rp: !0,
                rt: !0,
                tbody: !0,
                td: !0,
                tfoot: !0,
                th: !0,
                tr: !0
            },
            contextGrabbers: {
                dd: {dd: !0, dt: !0},
                dt: {dd: !0, dt: !0},
                li: {li: !0},
                option: {option: !0, optgroup: !0},
                optgroup: {optgroup: !0},
                p: {
                    address: !0,
                    article: !0,
                    aside: !0,
                    blockquote: !0,
                    dir: !0,
                    div: !0,
                    dl: !0,
                    fieldset: !0,
                    footer: !0,
                    form: !0,
                    h1: !0,
                    h2: !0,
                    h3: !0,
                    h4: !0,
                    h5: !0,
                    h6: !0,
                    header: !0,
                    hgroup: !0,
                    hr: !0,
                    menu: !0,
                    nav: !0,
                    ol: !0,
                    p: !0,
                    pre: !0,
                    section: !0,
                    table: !0,
                    ul: !0
                },
                rp: {rp: !0, rt: !0},
                rt: {rp: !0, rt: !0},
                tbody: {tbody: !0, tfoot: !0},
                td: {td: !0, th: !0},
                tfoot: {tbody: !0},
                th: {td: !0, th: !0},
                thead: {tbody: !0, tfoot: !0},
                tr: {tr: !0}
            },
            doNotIndent: {pre: !0},
            allowUnquoted: !0,
            allowMissing: !0,
            caseFold: !0
        } : {
            autoSelfClosers: {},
            implicitlyClosed: {},
            contextGrabbers: {},
            doNotIndent: {},
            allowUnquoted: !1,
            allowMissing: !1,
            caseFold: !1
        }, h = c.alignCDATA;
        return {
            startState: function () {
                return {tokenize: k, state: s, indented: 0, tagName: null, tagStart: null, context: null}
            },
            token: function (a, b) {
                if (!b.tagName && a.sol() && (b.indented = a.indentation()), a.eatSpace())return null;
                i = null;
                var c = b.tokenize(a, b);
                return (c || i) && "comment" != c && (j = null, b.state = b.state(i || c, a, b), j && (c = "error" == j ? c + " error" : j)), c
            },
            indent: function (b, c, i) {
                var j = b.context;
                if (b.tokenize.isInAttribute)return b.tagStart == b.indented ? b.stringStartCol + 1 : b.indented + d;
                if (j && j.noIndent)return a.Pass;
                if (b.tokenize != l && b.tokenize != k)return i ? i.match(/^(\s*)/)[0].length : 0;
                if (b.tagName)return f ? b.tagStart + b.tagName.length + 2 : b.tagStart + d * e;
                if (h && /<!\[CDATA\[/.test(c))return 0;
                var m = c && /^<(\/)?([\w_:\.-]*)/.exec(c);
                if (m && m[1])for (; j;) {
                    if (j.tagName == m[2]) {
                        j = j.prev;
                        break
                    }
                    if (!g.implicitlyClosed.hasOwnProperty(j.tagName))break;
                    j = j.prev
                } else if (m)for (; j;) {
                    var n = g.contextGrabbers[j.tagName];
                    if (!n || !n.hasOwnProperty(m[2]))break;
                    j = j.prev
                }
                for (; j && !j.startOfLine;)j = j.prev;
                return j ? j.indent + d : 0
            },
            electricInput: /<\/[\s\w:]+>$/,
            blockCommentStart: "<!--",
            blockCommentEnd: "-->",
            configuration: c.htmlMode ? "html" : "xml",
            helperType: c.htmlMode ? "html" : "xml"
        }
    }), a.defineMIME("text/xml", "xml"), a.defineMIME("application/xml", "xml"), a.mimeModes.hasOwnProperty("text/html") || a.defineMIME("text/html", {
        name: "xml",
        htmlMode: !0
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.defineMode("yaml", function () {
        var a = ["true", "false", "on", "off", "yes", "no"], b = new RegExp("\\b((" + a.join(")|(") + "))$", "i");
        return {
            token: function (a, c) {
                var d = a.peek(), e = c.escaped;
                if (c.escaped = !1, "#" == d && (0 == a.pos || /\s/.test(a.string.charAt(a.pos - 1))))return a.skipToEnd(), "comment";
                if (c.literal && a.indentation() > c.keyCol)return a.skipToEnd(), "string";
                if (c.literal && (c.literal = !1), a.sol()) {
                    if (c.keyCol = 0, c.pair = !1, c.pairStart = !1, a.match(/---/))return "def";
                    if (a.match(/\.\.\./))return "def";
                    if (a.match(/\s*-\s+/))return "meta"
                }
                if (a.match(/^(\{|\}|\[|\])/))return "{" == d ? c.inlinePairs++ : "}" == d ? c.inlinePairs-- : "[" == d ? c.inlineList++ : c.inlineList--, "meta";
                if (c.inlineList > 0 && !e && "," == d)return a.next(), "meta";
                if (c.inlinePairs > 0 && !e && "," == d)return c.keyCol = 0, c.pair = !1, c.pairStart = !1, a.next(), "meta";
                if (c.pairStart) {
                    if (a.match(/^\s*(\||\>)\s*/))return c.literal = !0, "meta";
                    if (a.match(/^\s*(\&|\*)[a-z0-9\._-]+\b/i))return "variable-2";
                    if (0 == c.inlinePairs && a.match(/^\s*-?[0-9\.\,]+\s?$/))return "number";
                    if (c.inlinePairs > 0 && a.match(/^\s*-?[0-9\.\,]+\s?(?=(,|}))/))return "number";
                    if (a.match(b))return "keyword"
                }
                return !c.pair && a.match(/^\s*(?:[,\[\]{}&*!|>'"%@`][^\s'":]|[^,\[\]{}#&*!|>'"%@`])[^#]*?(?=\s*:($|\s))/) ? (c.pair = !0, c.keyCol = a.indentation(), "atom") : c.pair && a.match(/^:\s*/) ? (c.pairStart = !0, "meta") : (c.pairStart = !1, c.escaped = "\\" == d, a.next(), null)
            }, startState: function () {
                return {pair: !1, pairStart: !1, keyCol: 0, inlinePairs: 0, inlineList: 0, literal: !1, escaped: !1}
            }
        }
    }), a.defineMIME("text/x-yaml", "yaml")
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function d(a) {
        for (var d = 0; d < a.state.activeLines.length; d++)a.removeLineClass(a.state.activeLines[d], "wrap", b), a.removeLineClass(a.state.activeLines[d], "background", c)
    }

    function e(a, b) {
        if (a.length != b.length)return !1;
        for (var c = 0; c < a.length; c++)if (a[c] != b[c])return !1;
        return !0
    }

    function f(a, f) {
        for (var g = [], h = 0; h < f.length; h++) {
            var i = f[h];
            if (i.empty()) {
                var j = a.getLineHandleVisualStart(i.head.line);
                g[g.length - 1] != j && g.push(j)
            }
        }
        e(a.state.activeLines, g) || a.operation(function () {
            d(a);
            for (var e = 0; e < g.length; e++)a.addLineClass(g[e], "wrap", b), a.addLineClass(g[e], "background", c);
            a.state.activeLines = g
        })
    }

    function g(a, b) {
        f(a, b.ranges)
    }

    var b = "CodeMirror-activeline", c = "CodeMirror-activeline-background";
    a.defineOption("styleActiveLine", !1, function (b, c, e) {
        var h = e && e != a.Init;
        c && !h ? (b.state.activeLines = [], f(b, b.listSelections()), b.on("beforeSelectionChange", g)) : !c && h && (b.off("beforeSelectionChange", g), d(b), delete b.state.activeLines)
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    var b = /[\w$]+/, c = 500;
    a.registerHelper("hint", "anyword", function (d, e) {
        for (var f = e && e.word || b, g = e && e.range || c, h = d.getCursor(), i = d.getLine(h.line), j = h.ch, k = j; k < i.length && f.test(i.charAt(k));)++k;
        for (; j && f.test(i.charAt(j - 1));)--j;
        for (var l = j != k && i.slice(j, k), m = [], n = {}, o = new RegExp(f.source, "g"), p = -1; 1 >= p; p += 2)for (var q = h.line, r = Math.min(Math.max(q + p * g, d.firstLine()), d.lastLine()) + p; q != r; q += p)for (var t, s = d.getLine(q); t = o.exec(s);)(q != h.line || t[0] !== l) && (l && 0 != t[0].lastIndexOf(l, 0) || Object.prototype.hasOwnProperty.call(n, t[0]) || (n[t[0]] = !0, m.push(t[0])));
        return {list: m, from: a.Pos(h.line, j), to: a.Pos(h.line, k)}
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.registerHelper("fold", "brace", function (b, c) {
        function h(f) {
            for (var h = c.ch, i = 0; ;) {
                var j = 0 >= h ? -1 : e.lastIndexOf(f, h - 1);
                if (-1 != j) {
                    if (1 == i && j < c.ch)break;
                    if (g = b.getTokenTypeAt(a.Pos(d, j + 1)), !/^(comment|string)/.test(g))return j + 1;
                    h = j - 1
                } else {
                    if (1 == i)break;
                    i = 1, h = e.length
                }
            }
        }

        var f, g, d = c.line, e = b.getLine(d), i = "{", j = "}", f = h("{");
        if (null == f && (i = "[", j = "]", f = h("[")), null != f) {
            var m, n, k = 1, l = b.lastLine();
            a:for (var o = d; l >= o; ++o)for (var p = b.getLine(o), q = o == d ? f : 0; ;) {
                var r = p.indexOf(i, q), s = p.indexOf(j, q);
                if (0 > r && (r = p.length), 0 > s && (s = p.length), q = Math.min(r, s), q == p.length)break;
                if (b.getTokenTypeAt(a.Pos(o, q + 1)) == g)if (q == r)++k; else if (!--k) {
                    m = o, n = q;
                    break a
                }
                ++q
            }
            if (null != m && (d != m || n != f))return {from: a.Pos(d, f), to: a.Pos(m, n)}
        }
    }), a.registerHelper("fold", "import", function (b, c) {
        function d(c) {
            if (c < b.firstLine() || c > b.lastLine())return null;
            var d = b.getTokenAt(a.Pos(c, 1));
            if (/\S/.test(d.string) || (d = b.getTokenAt(a.Pos(c, d.end + 1))), "keyword" != d.type || "import" != d.string)return null;
            for (var e = c, f = Math.min(b.lastLine(), c + 10); f >= e; ++e) {
                var g = b.getLine(e), h = g.indexOf(";");
                if (-1 != h)return {startCh: d.end, end: a.Pos(e, h)}
            }
        }

        var f, c = c.line, e = d(c);
        if (!e || d(c - 1) || (f = d(c - 2)) && f.end.line == c - 1)return null;
        for (var g = e.end; ;) {
            var h = d(g.line + 1);
            if (null == h)break;
            g = h.end
        }
        return {from: b.clipPos(a.Pos(c, e.startCh + 1)), to: g}
    }), a.registerHelper("fold", "include", function (b, c) {
        function d(c) {
            if (c < b.firstLine() || c > b.lastLine())return null;
            var d = b.getTokenAt(a.Pos(c, 1));
            return /\S/.test(d.string) || (d = b.getTokenAt(a.Pos(c, d.end + 1))), "meta" == d.type && "#include" == d.string.slice(0, 8) ? d.start + 8 : void 0
        }

        var c = c.line, e = d(c);
        if (null == e || null != d(c - 1))return null;
        for (var f = c; ;) {
            var g = d(f + 1);
            if (null == g)break;
            ++f
        }
        return {from: a.Pos(c, e + 1), to: b.clipPos(a.Pos(f))}
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    function f(a, b) {
        var c = a.getRange(e(b.line, b.ch - 1), e(b.line, b.ch + 1));
        return 2 == c.length ? c : null
    }

    function g(b, c, d) {
        var e = b.getLine(c.line), f = b.getTokenAt(c);
        if (/\bstring2?\b/.test(f.type))return !1;
        var g = new a.StringStream(e.slice(0, c.ch) + d + e.slice(c.ch), 4);
        for (g.pos = g.start = f.start; ;) {
            var h = b.getMode().token(g, f.state);
            if (g.pos >= c.ch + 1)return /\bstring2?\b/.test(h);
            g.start = g.pos
        }
    }

    function h(b) {
        for (var c = {
            name: "autoCloseBrackets", Backspace: function (c) {
                if (c.getOption("disableInput"))return a.Pass;
                for (var d = c.listSelections(), g = 0; g < d.length; g++) {
                    if (!d[g].empty())return a.Pass;
                    var h = f(c, d[g].head);
                    if (!h || 0 != b.indexOf(h) % 2)return a.Pass
                }
                for (var g = d.length - 1; g >= 0; g--) {
                    var i = d[g].head;
                    c.replaceRange("", e(i.line, i.ch - 1), e(i.line, i.ch + 1))
                }
            }
        }, h = "", i = 0; i < b.length; i += 2)!function (b, f) {
            b != f && (h += f), c["'" + b + "'"] = function (c) {
                if (c.getOption("disableInput"))return a.Pass;
                for (var j, k, i = c.listSelections(), l = 0; l < i.length; l++) {
                    var o, m = i[l], n = m.head, k = c.getRange(n, e(n.line, n.ch + 1));
                    if (m.empty())if (b == f && k == f)o = c.getRange(n, e(n.line, n.ch + 3)) == b + b + b ? "skipThree" : "skip"; else if (b == f && n.ch > 1 && c.getRange(e(n.line, n.ch - 2), n) == b + b && (n.ch <= 2 || c.getRange(e(n.line, n.ch - 3), e(n.line, n.ch - 2)) != b))o = "addFour"; else if ('"' == b || "'" == b) {
                        if (a.isWordChar(k) || !g(c, n, b))return a.Pass;
                        o = "both"
                    } else {
                        if (!(c.getLine(n.line).length == n.ch || h.indexOf(k) >= 0 || d.test(k)))return a.Pass;
                        o = "both"
                    } else o = "surround";
                    if (j) {
                        if (j != o)return a.Pass
                    } else j = o
                }
                c.operation(function () {
                    if ("skip" == j)c.execCommand("goCharRight"); else if ("skipThree" == j)for (var a = 0; 3 > a; a++)c.execCommand("goCharRight"); else if ("surround" == j) {
                        for (var d = c.getSelections(), a = 0; a < d.length; a++)d[a] = b + d[a] + f;
                        c.replaceSelections(d, "around")
                    } else"both" == j ? (c.replaceSelection(b + f, null), c.execCommand("goCharLeft")) : "addFour" == j && (c.replaceSelection(b + b + b + b, "before"), c.execCommand("goCharRight"))
                })
            }, b != f && (c["'" + f + "'"] = function (b) {
                for (var c = b.listSelections(), d = 0; d < c.length; d++) {
                    var g = c[d];
                    if (!g.empty() || b.getRange(g.head, e(g.head.line, g.head.ch + 1)) != f)return a.Pass
                }
                b.execCommand("goCharRight")
            })
        }(b.charAt(i), b.charAt(i + 1));
        return c
    }

    function i(b) {
        return function (c) {
            if (c.getOption("disableInput"))return a.Pass;
            for (var d = c.listSelections(), e = 0; e < d.length; e++) {
                if (!d[e].empty())return a.Pass;
                var g = f(c, d[e].head);
                if (!g || 0 != b.indexOf(g) % 2)return a.Pass
            }
            c.operation(function () {
                c.replaceSelection("\n\n", null), c.execCommand("goCharLeft"), d = c.listSelections();
                for (var a = 0; a < d.length; a++) {
                    var b = d[a].head.line;
                    c.indentLine(b, null, !0), c.indentLine(b + 1, null, !0)
                }
            })
        }
    }

    var b = "()[]{}''\"\"", c = "[]{}", d = /\s/, e = a.Pos;
    a.defineOption("autoCloseBrackets", !1, function (d, e, f) {
        if (f != a.Init && f && d.removeKeyMap("autoCloseBrackets"), e) {
            var g = b, j = c;
            "string" == typeof e ? g = e : "object" == typeof e && (null != e.pairs && (g = e.pairs), null != e.explode && (j = e.explode));
            var k = h(g);
            j && (k.Enter = i(j)), d.addKeyMap(k)
        }
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../fold/xml-fold")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../fold/xml-fold"], a) : a(CodeMirror)
}(function (a) {
    function d(d) {
        if (d.getOption("disableInput"))return a.Pass;
        for (var e = d.listSelections(), h = [], i = 0; i < e.length; i++) {
            if (!e[i].empty())return a.Pass;
            var j = e[i].head, k = d.getTokenAt(j), l = a.innerMode(d.getMode(), k.state), m = l.state;
            if ("xml" != l.mode.name || !m.tagName)return a.Pass;
            var n = d.getOption("autoCloseTags"), o = "html" == l.mode.configuration, p = "object" == typeof n && n.dontCloseTags || o && b, q = "object" == typeof n && n.indentTags || o && c, r = m.tagName;
            k.end > j.ch && (r = r.slice(0, r.length - k.end + j.ch));
            var s = r.toLowerCase();
            if (!r || "string" == k.type && (k.end != j.ch || !/[\"\']/.test(k.string.charAt(k.string.length - 1)) || 1 == k.string.length) || "tag" == k.type && "closeTag" == m.type || k.string.indexOf("/") == k.string.length - 1 || p && f(p, s) > -1 || g(d, r, j, m, !0))return a.Pass;
            var t = q && f(q, s) > -1;
            h[i] = {
                indent: t,
                text: ">" + (t ? "\n\n" : "") + "</" + r + ">",
                newPos: t ? a.Pos(j.line + 1, 0) : a.Pos(j.line, j.ch + 1)
            }
        }
        for (var i = e.length - 1; i >= 0; i--) {
            var u = h[i];
            d.replaceRange(u.text, e[i].head, e[i].anchor, "+insert");
            var v = d.listSelections().slice(0);
            v[i] = {
                head: u.newPos,
                anchor: u.newPos
            }, d.setSelections(v), u.indent && (d.indentLine(u.newPos.line, null, !0), d.indentLine(u.newPos.line + 1, null, !0))
        }
    }

    function e(b) {
        if (b.getOption("disableInput"))return a.Pass;
        for (var c = b.listSelections(), d = [], e = 0; e < c.length; e++) {
            if (!c[e].empty())return a.Pass;
            var f = c[e].head, h = b.getTokenAt(f), i = a.innerMode(b.getMode(), h.state), j = i.state;
            if ("string" == h.type || "<" != h.string.charAt(0) || h.start != f.ch - 1 || "xml" != i.mode.name || !j.context || !j.context.tagName || g(b, j.context.tagName, f, j))return a.Pass;
            d[e] = "/" + j.context.tagName + ">"
        }
        b.replaceSelections(d)
    }

    function f(a, b) {
        if (a.indexOf)return a.indexOf(b);
        for (var c = 0, d = a.length; d > c; ++c)if (a[c] == b)return c;
        return -1
    }

    function g(b, c, d, e, f) {
        if (!a.scanForClosingTag)return !1;
        var g = Math.min(b.lastLine() + 1, d.line + 500), h = a.scanForClosingTag(b, d, null, g);
        if (!h || h.tag != c)return !1;
        for (var i = e.context, j = f ? 1 : 0; i && i.tagName == c; i = i.prev)++j;
        d = h.to;
        for (var k = 1; j > k; k++) {
            var l = a.scanForClosingTag(b, d, null, g);
            if (!l || l.tag != c)return !1;
            d = l.to
        }
        return !0
    }

    a.defineOption("autoCloseTags", !1, function (b, c, f) {
        if (f != a.Init && f && b.removeKeyMap("autoCloseTags"), c) {
            var g = {name: "autoCloseTags"};
            ("object" != typeof c || c.whenClosing) && (g["'/'"] = function (a) {
                return e(a)
            }), ("object" != typeof c || c.whenOpening) && (g["'>'"] = function (a) {
                return d(a)
            }), b.addKeyMap(g)
        }
    });
    var b = ["area", "base", "br", "col", "command", "embed", "hr", "img", "input", "keygen", "link", "meta", "param", "source", "track", "wbr"], c = ["applet", "blockquote", "body", "button", "div", "dl", "fieldset", "form", "frameset", "h1", "h2", "h3", "h4", "h5", "h6", "head", "html", "iframe", "layer", "legend", "object", "ol", "p", "select", "table", "ul"]
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("./runmode")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "./runmode"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function c(a, d) {
        if (3 == a.nodeType)return d.push(a.nodeValue);
        for (var e = a.firstChild; e; e = e.nextSibling)c(e, d), b.test(a.nodeType) && d.push("\n")
    }

    var b = /^(p|li|div|h\\d|pre|blockquote|td)$/;
    a.colorize = function (b, d) {
        b || (b = document.body.getElementsByTagName("pre"));
        for (var e = 0; e < b.length; ++e) {
            var f = b[e], g = f.getAttribute("data-lang") || d;
            if (g) {
                var h = [];
                c(f, h), f.innerHTML = "", a.runMode(h.join(""), g, f), f.className += " cm-s-default"
            }
        }
    }
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function e(a) {
        var b = a.search(c);
        return -1 == b ? 0 : b
    }

    var b = {}, c = /[^\s\u00a0]/, d = a.Pos;
    a.commands.toggleComment = function (a) {
        for (var b = 1 / 0, c = a.listSelections(), e = null, f = c.length - 1; f >= 0; f--) {
            var g = c[f].from(), h = c[f].to();
            g.line >= b || (h.line >= b && (h = d(b, 0)), b = g.line, null == e ? a.uncomment(g, h) ? e = "un" : (a.lineComment(g, h), e = "line") : "un" == e ? a.uncomment(g, h) : a.lineComment(g, h))
        }
    }, a.defineExtension("lineComment", function (a, f, g) {
        g || (g = b);
        var h = this, i = h.getModeAt(a), j = g.lineComment || i.lineComment;
        if (!j)return (g.blockCommentStart || i.blockCommentStart) && (g.fullLines = !0, h.blockComment(a, f, g)), void 0;
        var k = h.getLine(a.line);
        if (null != k) {
            var l = Math.min(0 != f.ch || f.line == a.line ? f.line + 1 : f.line, h.lastLine() + 1), m = null == g.padding ? " " : g.padding, n = g.commentBlankLines || a.line == f.line;
            h.operation(function () {
                if (g.indent)for (var b = k.slice(0, e(k)), f = a.line; l > f; ++f) {
                    var i = h.getLine(f), o = b.length;
                    (n || c.test(i)) && (i.slice(0, o) != b && (o = e(i)), h.replaceRange(b + j + m, d(f, 0), d(f, o)))
                } else for (var f = a.line; l > f; ++f)(n || c.test(h.getLine(f))) && h.replaceRange(j + m, d(f, 0))
            })
        }
    }), a.defineExtension("blockComment", function (a, e, f) {
        f || (f = b);
        var g = this, h = g.getModeAt(a), i = f.blockCommentStart || h.blockCommentStart, j = f.blockCommentEnd || h.blockCommentEnd;
        if (!i || !j)return (f.lineComment || h.lineComment) && 0 != f.fullLines && g.lineComment(a, e, f), void 0;
        var k = Math.min(e.line, g.lastLine());
        k != a.line && 0 == e.ch && c.test(g.getLine(k)) && --k;
        var l = null == f.padding ? " " : f.padding;
        a.line > k || g.operation(function () {
            if (0 != f.fullLines) {
                var b = c.test(g.getLine(k));
                g.replaceRange(l + j, d(k)), g.replaceRange(i + l, d(a.line, 0));
                var m = f.blockCommentLead || h.blockCommentLead;
                if (null != m)for (var n = a.line + 1; k >= n; ++n)(n != k || b) && g.replaceRange(m + l, d(n, 0))
            } else g.replaceRange(j, e), g.replaceRange(i, a)
        })
    }), a.defineExtension("uncomment", function (a, e, f) {
        f || (f = b);
        var n, g = this, h = g.getModeAt(a), i = Math.min(e.line, g.lastLine()), j = Math.min(a.line, i), k = f.lineComment || h.lineComment, l = [], m = null == f.padding ? " " : f.padding;
        a:if (k) {
            for (var o = j; i >= o; ++o) {
                var p = g.getLine(o), q = p.indexOf(k);
                if (q > -1 && !/comment/.test(g.getTokenTypeAt(d(o, q + 1))) && (q = -1), -1 == q && (o != i || o == j) && c.test(p))break a;
                if (q > -1 && c.test(p.slice(0, q)))break a;
                l.push(p)
            }
            if (g.operation(function () {
                    for (var a = j; i >= a; ++a) {
                        var b = l[a - j], c = b.indexOf(k), e = c + k.length;
                        0 > c || (b.slice(e, e + m.length) == m && (e += m.length), n = !0, g.replaceRange("", d(a, c), d(a, e)))
                    }
                }), n)return !0
        }
        var r = f.blockCommentStart || h.blockCommentStart, s = f.blockCommentEnd || h.blockCommentEnd;
        if (!r || !s)return !1;
        var t = f.blockCommentLead || h.blockCommentLead, u = g.getLine(j), v = i == j ? u : g.getLine(i), w = u.indexOf(r), x = v.lastIndexOf(s);
        if (-1 == x && j != i && (v = g.getLine(--i), x = v.lastIndexOf(s)), -1 == w || -1 == x || !/comment/.test(g.getTokenTypeAt(d(j, w + 1))) || !/comment/.test(g.getTokenTypeAt(d(i, x + 1))))return !1;
        var y = u.lastIndexOf(r, a.ch), z = -1 == y ? -1 : u.slice(0, a.ch).indexOf(s, y + r.length);
        if (-1 != y && -1 != z)return !1;
        z = v.indexOf(s, e.ch);
        var A = v.slice(e.ch).lastIndexOf(r, z - e.ch);
        return y = -1 == z || -1 == A ? -1 : e.ch + A, -1 != z && -1 != y ? !1 : (g.operation(function () {
            g.replaceRange("", d(i, x - (m && v.slice(x - m.length, x) == m ? m.length : 0)), d(i, x + s.length));
            var a = w + r.length;
            if (m && u.slice(a, a + m.length) == m && (a += m.length), g.replaceRange("", d(j, w), d(j, a)), t)for (var b = j + 1; i >= b; ++b) {
                var e = g.getLine(b), f = e.indexOf(t);
                if (-1 != f && !c.test(e.slice(0, f))) {
                    var h = f + t.length;
                    m && e.slice(h, h + m.length) == m && (h += m.length), g.replaceRange("", d(b, f), d(b, h))
                }
            }
        }), !0)
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.registerGlobalHelper("fold", "comment", function (a) {
        return a.blockCommentStart && a.blockCommentEnd
    }, function (b, c) {
        var d = b.getModeAt(c), e = d.blockCommentStart, f = d.blockCommentEnd;
        if (e && f) {
            for (var i, g = c.line, h = b.getLine(g), j = c.ch, k = 0; ;) {
                var l = 0 >= j ? -1 : h.lastIndexOf(e, j - 1);
                if (-1 != l) {
                    if (1 == k && l < c.ch)return;
                    if (/comment/.test(b.getTokenTypeAt(a.Pos(g, l + 1)))) {
                        i = l + e.length;
                        break
                    }
                    j = l - 1
                } else {
                    if (1 == k)return;
                    k = 1, j = h.length
                }
            }
            var o, p, m = 1, n = b.lastLine();
            a:for (var q = g; n >= q; ++q)for (var r = b.getLine(q), s = q == g ? i : 0; ;) {
                var t = r.indexOf(e, s), u = r.indexOf(f, s);
                if (0 > t && (t = r.length), 0 > u && (u = r.length), s = Math.min(t, u), s == r.length)break;
                if (s == t)++m; else if (!--m) {
                    o = q, p = s;
                    break a
                }
                ++s
            }
            if (null != o && (g != o || p != i))return {from: a.Pos(g, i), to: a.Pos(o, p)}
        }
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    function d(b) {
        if (b.getOption("disableInput"))return a.Pass;
        for (var d, c = b.listSelections(), f = [], g = 0; g < c.length; g++) {
            var h = c[g].head, i = b.getTokenAt(h);
            if ("comment" != i.type)return a.Pass;
            var j = a.innerMode(b.getMode(), i.state).mode;
            if (d) {
                if (d != j)return a.Pass
            } else d = j;
            var k = null;
            if (d.blockCommentStart && d.blockCommentContinue) {
                var n, l = i.string.indexOf(d.blockCommentEnd), m = b.getRange(a.Pos(h.line, 0), a.Pos(h.line, i.end));
                if (-1 != l && l == i.string.length - d.blockCommentEnd.length && h.ch >= l); else if (0 == i.string.indexOf(d.blockCommentStart)) {
                    if (k = m.slice(0, i.start), !/^\s*$/.test(k)) {
                        k = "";
                        for (var o = 0; o < i.start; ++o)k += " "
                    }
                } else-1 != (n = m.indexOf(d.blockCommentContinue)) && n + d.blockCommentContinue.length > i.start && /^\s*$/.test(m.slice(0, n)) && (k = m.slice(0, n));
                null != k && (k += d.blockCommentContinue)
            }
            if (null == k && d.lineComment && e(b)) {
                var p = b.getLine(h.line), n = p.indexOf(d.lineComment);
                n > -1 && (k = p.slice(0, n), /\S/.test(k) ? k = null : k += d.lineComment + p.slice(n + d.lineComment.length).match(/^\s*/)[0])
            }
            if (null == k)return a.Pass;
            f[g] = "\n" + k
        }
        b.operation(function () {
            for (var a = c.length - 1; a >= 0; a--)b.replaceRange(f[a], c[a].from(), c[a].to(), "+insert")
        })
    }

    function e(a) {
        var b = a.getOption("continueComments");
        return b && "object" == typeof b ? b.continueLineComment !== !1 : !0
    }

    for (var b = ["clike", "css", "javascript"], c = 0; c < b.length; ++c)a.extendMode(b[c], {blockCommentContinue: " * "});
    a.defineOption("continueComments", null, function (b, c, e) {
        if (e && e != a.Init && b.removeKeyMap("continueComment"), c) {
            var f = "Enter";
            "string" == typeof c ? f = c : "object" == typeof c && c.key && (f = c.key);
            var g = {name: "continueComment"};
            g[f] = d, b.addKeyMap(g)
        }
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    var b = /^(\s*)([*+-]|(\d+)\.)(\s+)/, c = "*+-";
    a.commands.newlineAndIndentContinueMarkdownList = function (d) {
        if (d.getOption("disableInput"))return a.Pass;
        for (var e = d.listSelections(), f = [], g = 0; g < e.length; g++) {
            var i, h = e[g].head, j = d.getStateAfter(h.line).list !== !1;
            if (!e[g].empty() || !j || !(i = d.getLine(h.line).match(b)))return d.execCommand("newlineAndIndent"), void 0;
            var k = i[1], l = i[4], m = c.indexOf(i[2]) >= 0 ? i[2] : parseInt(i[3], 10) + 1 + ".";
            f[g] = "\n" + k + m + l
        }
        d.replaceSelections(f)
    }
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../../mode/css/css")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../../mode/css/css"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    var b = {
        link: 1,
        visited: 1,
        active: 1,
        hover: 1,
        focus: 1,
        "first-letter": 1,
        "first-line": 1,
        "first-child": 1,
        before: 1,
        after: 1,
        lang: 1
    };
    a.registerHelper("hint", "css", function (c) {
        function l(a) {
            for (var b in a)g && 0 != b.lastIndexOf(g, 0) || k.push(b)
        }

        var d = c.getCursor(), e = c.getTokenAt(d), f = a.innerMode(c.getMode(), e.state);
        if ("css" == f.mode.name) {
            var g = e.string, h = e.start, i = e.end;
            /[^\w$_-]/.test(g) && (g = "", h = i = d.ch);
            var j = a.resolveMode("text/css"), k = [], m = f.state.state;
            return "pseudo" == m || "variable-3" == e.type ? l(b) : "block" == m || "maybeprop" == m ? l(j.propertyKeywords) : "prop" == m || "parens" == m || "at" == m || "params" == m ? (l(j.valueKeywords), l(j.colorKeywords)) : ("media" == m || "media_parens" == m) && (l(j.mediaTypes), l(j.mediaFeatures)), k.length ? {
                list: k,
                from: a.Pos(d.line, h),
                to: a.Pos(d.line, i)
            } : void 0
        }
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    function b(a, b, c) {
        var e, d = a.getWrapperElement();
        return e = d.appendChild(document.createElement("div")), e.className = c ? "CodeMirror-dialog CodeMirror-dialog-bottom" : "CodeMirror-dialog CodeMirror-dialog-top", "string" == typeof b ? e.innerHTML = b : e.appendChild(b), e
    }

    function c(a, b) {
        a.state.currentNotificationClose && a.state.currentNotificationClose(), a.state.currentNotificationClose = b
    }

    a.defineExtension("openDialog", function (d, e, f) {
        function j(a) {
            if ("string" == typeof a)k.value = a; else {
                if (h)return;
                h = !0, g.parentNode.removeChild(g)
            }
        }

        c(this, null);
        var l, g = b(this, d, f && f.bottom), h = !1, i = this, k = g.getElementsByTagName("input")[0];
        return k ? (f && f.value && (k.value = f.value), a.on(k, "keydown", function (b) {
            f && f.onKeyDown && f.onKeyDown(b, k.value, j) || (13 == b.keyCode || 27 == b.keyCode) && (k.blur(), a.e_stop(b), j(), i.focus(), 13 == b.keyCode && e(k.value))
        }), f && f.onKeyUp && a.on(k, "keyup", function (a) {
            f.onKeyUp(a, k.value, j)
        }), f && f.value && (k.value = f.value), k.focus(), a.on(k, "blur", j)) : (l = g.getElementsByTagName("button")[0]) && (a.on(l, "click", function () {
            j(), i.focus()
        }), l.focus(), a.on(l, "blur", j)), j
    }), a.defineExtension("openConfirm", function (d, e, f) {
        function l() {
            i || (i = !0, g.parentNode.removeChild(g), j.focus())
        }

        c(this, null);
        var g = b(this, d, f && f.bottom), h = g.getElementsByTagName("button"), i = !1, j = this, k = 1;
        h[0].focus();
        for (var m = 0; m < h.length; ++m) {
            var n = h[m];
            !function (b) {
                a.on(n, "click", function (c) {
                    a.e_preventDefault(c), l(), b && b(j)
                })
            }(e[m]), a.on(n, "blur", function () {
                --k, setTimeout(function () {
                    0 >= k && l()
                }, 200)
            }), a.on(n, "focus", function () {
                ++k
            })
        }
    }), a.defineExtension("openNotification", function (d, e) {
        function j() {
            h || (h = !0, clearTimeout(i), f.parentNode.removeChild(f))
        }

        c(this, j);
        var i, f = b(this, d, e && e.bottom), g = e && (void 0 === e.duration ? 5e3 : e.duration), h = !1;
        a.on(f, "click", function (b) {
            a.e_preventDefault(b), j()
        }), g && (i = setTimeout(j, e.duration))
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function b(b, d, f, g) {
        function j(a) {
            var c = h(b, d);
            if (!c || c.to.line - c.from.line < i)return null;
            for (var e = b.findMarksAt(c.from), f = 0; f < e.length; ++f)if (e[f].__isFold && "fold" !== g) {
                if (!a)return null;
                c.cleared = !0, e[f].clear()
            }
            return c
        }

        if (f && f.call) {
            var h = f;
            f = null
        } else var h = e(b, f, "rangeFinder");
        "number" == typeof d && (d = a.Pos(d, 0));
        var i = e(b, f, "minFoldSize"), k = j(!0);
        if (e(b, f, "scanUp"))for (; !k && d.line > b.firstLine();)d = a.Pos(d.line - 1, 0), k = j(!1);
        if (k && !k.cleared && "unfold" !== g) {
            var l = c(b, f);
            a.on(l, "mousedown", function (b) {
                m.clear(), a.e_preventDefault(b)
            });
            var m = b.markText(k.from, k.to, {replacedWith: l, clearOnEnter: !0, __isFold: !0});
            m.on("clear", function (c, d) {
                a.signal(b, "unfold", b, c, d)
            }), a.signal(b, "fold", b, k.from, k.to)
        }
    }

    function c(a, b) {
        var c = e(a, b, "widget");
        if ("string" == typeof c) {
            var d = document.createTextNode(c);
            c = document.createElement("span"), c.appendChild(d), c.className = "CodeMirror-foldmarker"
        }
        return c
    }

    function e(a, b, c) {
        if (b && void 0 !== b[c])return b[c];
        var e = a.options.foldOptions;
        return e && void 0 !== e[c] ? e[c] : d[c]
    }

    a.newFoldFunction = function (a, c) {
        return function (d, e) {
            b(d, e, {rangeFinder: a, widget: c})
        }
    }, a.defineExtension("foldCode", function (a, c, d) {
        b(this, a, c, d)
    }), a.defineExtension("isFolded", function (a) {
        for (var b = this.findMarksAt(a), c = 0; c < b.length; ++c)if (b[c].__isFold)return !0
    }), a.commands.toggleFold = function (a) {
        a.foldCode(a.getCursor())
    }, a.commands.fold = function (a) {
        a.foldCode(a.getCursor(), null, "fold")
    }, a.commands.unfold = function (a) {
        a.foldCode(a.getCursor(), null, "unfold")
    }, a.commands.foldAll = function (b) {
        b.operation(function () {
            for (var c = b.firstLine(), d = b.lastLine(); d >= c; c++)b.foldCode(a.Pos(c, 0), null, "fold")
        })
    }, a.commands.unfoldAll = function (b) {
        b.operation(function () {
            for (var c = b.firstLine(), d = b.lastLine(); d >= c; c++)b.foldCode(a.Pos(c, 0), null, "unfold")
        })
    }, a.registerHelper("fold", "combine", function () {
        var a = Array.prototype.slice.call(arguments, 0);
        return function (b, c) {
            for (var d = 0; d < a.length; ++d) {
                var e = a[d](b, c);
                if (e)return e
            }
        }
    }), a.registerHelper("fold", "auto", function (a, b) {
        for (var c = a.getHelpers(b, "fold"), d = 0; d < c.length; d++) {
            var e = c[d](a, b);
            if (e)return e
        }
    });
    var d = {rangeFinder: a.fold.auto, widget: "\u2194", minFoldSize: 0, scanUp: !1};
    a.defineOption("foldOptions", null)
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("./foldcode")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "./foldcode"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function c(a) {
        this.options = a, this.from = this.to = 0
    }

    function d(a) {
        return a === !0 && (a = {}), null == a.gutter && (a.gutter = "CodeMirror-foldgutter"), null == a.indicatorOpen && (a.indicatorOpen = "CodeMirror-foldgutter-open"), null == a.indicatorFolded && (a.indicatorFolded = "CodeMirror-foldgutter-folded"), a
    }

    function e(a, c) {
        for (var d = a.findMarksAt(b(c)), e = 0; e < d.length; ++e)if (d[e].__isFold && d[e].find().from.line == c)return !0
    }

    function f(a) {
        if ("string" == typeof a) {
            var b = document.createElement("div");
            return b.className = a + " CodeMirror-guttermarker-subtle", b
        }
        return a.cloneNode(!0)
    }

    function g(c, d, g) {
        var h = c.state.foldGutter.options, i = d;
        c.eachLine(d, g, function (d) {
            var g = null;
            if (e(c, i))g = f(h.indicatorFolded); else {
                var j = b(i, 0), k = h.rangeFinder || a.fold.auto, l = k && k(c, j);
                l && l.from.line + 1 < l.to.line && (g = f(h.indicatorOpen))
            }
            c.setGutterMarker(d, h.gutter, g), ++i
        })
    }

    function h(a) {
        var b = a.getViewport(), c = a.state.foldGutter;
        c && (a.operation(function () {
            g(a, b.from, b.to)
        }), c.from = b.from, c.to = b.to)
    }

    function i(a, c, d) {
        var e = a.state.foldGutter.options;
        d == e.gutter && a.foldCode(b(c, 0), e.rangeFinder)
    }

    function j(a) {
        var b = a.state.foldGutter, c = a.state.foldGutter.options;
        b.from = b.to = 0, clearTimeout(b.changeUpdate), b.changeUpdate = setTimeout(function () {
            h(a)
        }, c.foldOnChangeTimeSpan || 600)
    }

    function k(a) {
        var b = a.state.foldGutter, c = a.state.foldGutter.options;
        clearTimeout(b.changeUpdate), b.changeUpdate = setTimeout(function () {
            var c = a.getViewport();
            b.from == b.to || c.from - b.to > 20 || b.from - c.to > 20 ? h(a) : a.operation(function () {
                c.from < b.from && (g(a, c.from, b.from), b.from = c.from), c.to > b.to && (g(a, b.to, c.to), b.to = c.to)
            })
        }, c.updateViewportTimeSpan || 400)
    }

    function l(a, b) {
        var c = a.state.foldGutter, d = b.line;
        d >= c.from && d < c.to && g(a, d, d + 1)
    }

    a.defineOption("foldGutter", !1, function (b, e, f) {
        f && f != a.Init && (b.clearGutter(b.state.foldGutter.options.gutter), b.state.foldGutter = null, b.off("gutterClick", i), b.off("change", j), b.off("viewportChange", k), b.off("fold", l), b.off("unfold", l), b.off("swapDoc", h)), e && (b.state.foldGutter = new c(d(e)), h(b), b.on("gutterClick", i), b.on("change", j), b.on("viewportChange", k), b.on("fold", l), b.on("unfold", l), b.on("swapDoc", h))
    });
    var b = a.Pos
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function k(a) {
        for (var b in j)j.hasOwnProperty(b) && (a.attrs[b] = j[b])
    }

    function m(b, c) {
        var d = {schemaInfo: i};
        if (c)for (var e in c)d[e] = c[e];
        return a.hint.xml(b, d)
    }

    var b = "ab aa af ak sq am ar an hy as av ae ay az bm ba eu be bn bh bi bs br bg my ca ch ce ny zh cv kw co cr hr cs da dv nl dz en eo et ee fo fj fi fr ff gl ka de el gn gu ht ha he hz hi ho hu ia id ie ga ig ik io is it iu ja jv kl kn kr ks kk km ki rw ky kv kg ko ku kj la lb lg li ln lo lt lu lv gv mk mg ms ml mt mi mr mh mn na nv nb nd ne ng nn no ii nr oc oj cu om or os pa pi fa pl ps pt qu rm rn ro ru sa sc sd se sm sg sr gd sn si sk sl so st es su sw ss sv ta te tg th ti bo tk tl tn to tr ts tt tw ty ug uk ur uz ve vi vo wa cy wo fy xh yi yo za zu".split(" "), c = ["_blank", "_self", "_top", "_parent"], d = ["ascii", "utf-8", "utf-16", "latin1", "latin1"], e = ["get", "post", "put", "delete"], f = ["application/x-www-form-urlencoded", "multipart/form-data", "text/plain"], g = ["all", "screen", "print", "embossed", "braille", "handheld", "print", "projection", "screen", "tty", "tv", "speech", "3d-glasses", "resolution [>][<][=] [X]", "device-aspect-ratio: X/Y", "orientation:portrait", "orientation:landscape", "device-height: [X]", "device-width: [X]"], h = {attrs: {}}, i = {
        a: {
            attrs: {
                href: null,
                ping: null,
                type: null,
                media: g,
                target: c,
                hreflang: b
            }
        },
        abbr: h,
        acronym: h,
        address: h,
        applet: h,
        area: {
            attrs: {
                alt: null,
                coords: null,
                href: null,
                target: null,
                ping: null,
                media: g,
                hreflang: b,
                type: null,
                shape: ["default", "rect", "circle", "poly"]
            }
        },
        article: h,
        aside: h,
        audio: {
            attrs: {
                src: null,
                mediagroup: null,
                crossorigin: ["anonymous", "use-credentials"],
                preload: ["none", "metadata", "auto"],
                autoplay: ["", "autoplay"],
                loop: ["", "loop"],
                controls: ["", "controls"]
            }
        },
        b: h,
        base: {attrs: {href: null, target: c}},
        basefont: h,
        bdi: h,
        bdo: h,
        big: h,
        blockquote: {attrs: {cite: null}},
        body: h,
        br: h,
        button: {
            attrs: {
                form: null,
                formaction: null,
                name: null,
                value: null,
                autofocus: ["", "autofocus"],
                disabled: ["", "autofocus"],
                formenctype: f,
                formmethod: e,
                formnovalidate: ["", "novalidate"],
                formtarget: c,
                type: ["submit", "reset", "button"]
            }
        },
        canvas: {attrs: {width: null, height: null}},
        caption: h,
        center: h,
        cite: h,
        code: h,
        col: {attrs: {span: null}},
        colgroup: {attrs: {span: null}},
        command: {
            attrs: {
                type: ["command", "checkbox", "radio"],
                label: null,
                icon: null,
                radiogroup: null,
                command: null,
                title: null,
                disabled: ["", "disabled"],
                checked: ["", "checked"]
            }
        },
        data: {attrs: {value: null}},
        datagrid: {attrs: {disabled: ["", "disabled"], multiple: ["", "multiple"]}},
        datalist: {attrs: {data: null}},
        dd: h,
        del: {attrs: {cite: null, datetime: null}},
        details: {attrs: {open: ["", "open"]}},
        dfn: h,
        dir: h,
        div: h,
        dl: h,
        dt: h,
        em: h,
        embed: {attrs: {src: null, type: null, width: null, height: null}},
        eventsource: {attrs: {src: null}},
        fieldset: {attrs: {disabled: ["", "disabled"], form: null, name: null}},
        figcaption: h,
        figure: h,
        font: h,
        footer: h,
        form: {
            attrs: {
                action: null,
                name: null,
                "accept-charset": d,
                autocomplete: ["on", "off"],
                enctype: f,
                method: e,
                novalidate: ["", "novalidate"],
                target: c
            }
        },
        frame: h,
        frameset: h,
        h1: h,
        h2: h,
        h3: h,
        h4: h,
        h5: h,
        h6: h,
        head: {attrs: {}, children: ["title", "base", "link", "style", "meta", "script", "noscript", "command"]},
        header: h,
        hgroup: h,
        hr: h,
        html: {attrs: {manifest: null}, children: ["head", "body"]},
        i: h,
        iframe: {
            attrs: {
                src: null,
                srcdoc: null,
                name: null,
                width: null,
                height: null,
                sandbox: ["allow-top-navigation", "allow-same-origin", "allow-forms", "allow-scripts"],
                seamless: ["", "seamless"]
            }
        },
        img: {
            attrs: {
                alt: null,
                src: null,
                ismap: null,
                usemap: null,
                width: null,
                height: null,
                crossorigin: ["anonymous", "use-credentials"]
            }
        },
        input: {
            attrs: {
                alt: null,
                dirname: null,
                form: null,
                formaction: null,
                height: null,
                list: null,
                max: null,
                maxlength: null,
                min: null,
                name: null,
                pattern: null,
                placeholder: null,
                size: null,
                src: null,
                step: null,
                value: null,
                width: null,
                accept: ["audio/*", "video/*", "image/*"],
                autocomplete: ["on", "off"],
                autofocus: ["", "autofocus"],
                checked: ["", "checked"],
                disabled: ["", "disabled"],
                formenctype: f,
                formmethod: e,
                formnovalidate: ["", "novalidate"],
                formtarget: c,
                multiple: ["", "multiple"],
                readonly: ["", "readonly"],
                required: ["", "required"],
                type: ["hidden", "text", "search", "tel", "url", "email", "password", "datetime", "date", "month", "week", "time", "datetime-local", "number", "range", "color", "checkbox", "radio", "file", "submit", "image", "reset", "button"]
            }
        },
        ins: {attrs: {cite: null, datetime: null}},
        kbd: h,
        keygen: {
            attrs: {
                challenge: null,
                form: null,
                name: null,
                autofocus: ["", "autofocus"],
                disabled: ["", "disabled"],
                keytype: ["RSA"]
            }
        },
        label: {attrs: {"for": null, form: null}},
        legend: h,
        li: {attrs: {value: null}},
        link: {
            attrs: {
                href: null,
                type: null,
                hreflang: b,
                media: g,
                sizes: ["all", "16x16", "16x16 32x32", "16x16 32x32 64x64"]
            }
        },
        map: {attrs: {name: null}},
        mark: h,
        menu: {attrs: {label: null, type: ["list", "context", "toolbar"]}},
        meta: {
            attrs: {
                content: null,
                charset: d,
                name: ["viewport", "application-name", "author", "description", "generator", "keywords"],
                "http-equiv": ["content-language", "content-type", "default-style", "refresh"]
            }
        },
        meter: {attrs: {value: null, min: null, low: null, high: null, max: null, optimum: null}},
        nav: h,
        noframes: h,
        noscript: h,
        object: {
            attrs: {
                data: null,
                type: null,
                name: null,
                usemap: null,
                form: null,
                width: null,
                height: null,
                typemustmatch: ["", "typemustmatch"]
            }
        },
        ol: {attrs: {reversed: ["", "reversed"], start: null, type: ["1", "a", "A", "i", "I"]}},
        optgroup: {attrs: {disabled: ["", "disabled"], label: null}},
        option: {attrs: {disabled: ["", "disabled"], label: null, selected: ["", "selected"], value: null}},
        output: {attrs: {"for": null, form: null, name: null}},
        p: h,
        param: {attrs: {name: null, value: null}},
        pre: h,
        progress: {attrs: {value: null, max: null}},
        q: {attrs: {cite: null}},
        rp: h,
        rt: h,
        ruby: h,
        s: h,
        samp: h,
        script: {attrs: {type: ["text/javascript"], src: null, async: ["", "async"], defer: ["", "defer"], charset: d}},
        section: h,
        select: {
            attrs: {
                form: null,
                name: null,
                size: null,
                autofocus: ["", "autofocus"],
                disabled: ["", "disabled"],
                multiple: ["", "multiple"]
            }
        },
        small: h,
        source: {attrs: {src: null, type: null, media: null}},
        span: h,
        strike: h,
        strong: h,
        style: {attrs: {type: ["text/css"], media: g, scoped: null}},
        sub: h,
        summary: h,
        sup: h,
        table: h,
        tbody: h,
        td: {attrs: {colspan: null, rowspan: null, headers: null}},
        textarea: {
            attrs: {
                dirname: null,
                form: null,
                maxlength: null,
                name: null,
                placeholder: null,
                rows: null,
                cols: null,
                autofocus: ["", "autofocus"],
                disabled: ["", "disabled"],
                readonly: ["", "readonly"],
                required: ["", "required"],
                wrap: ["soft", "hard"]
            }
        },
        tfoot: h,
        th: {attrs: {colspan: null, rowspan: null, headers: null, scope: ["row", "col", "rowgroup", "colgroup"]}},
        thead: h,
        time: {attrs: {datetime: null}},
        title: h,
        tr: h,
        track: {
            attrs: {
                src: null,
                label: null,
                "default": null,
                kind: ["subtitles", "captions", "descriptions", "chapters", "metadata"],
                srclang: b
            }
        },
        tt: h,
        u: h,
        ul: h,
        "var": h,
        video: {
            attrs: {
                src: null,
                poster: null,
                width: null,
                height: null,
                crossorigin: ["anonymous", "use-credentials"],
                preload: ["auto", "metadata", "none"],
                autoplay: ["", "autoplay"],
                mediagroup: ["movie"],
                muted: ["", "muted"],
                controls: ["", "controls"]
            }
        },
        wbr: h
    }, j = {
        accesskey: ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"],
        "class": null,
        contenteditable: ["true", "false"],
        contextmenu: null,
        dir: ["ltr", "rtl", "auto"],
        draggable: ["true", "false", "auto"],
        dropzone: ["copy", "move", "link", "string:", "file:"],
        hidden: ["hidden"],
        id: null,
        inert: ["inert"],
        itemid: null,
        itemprop: null,
        itemref: null,
        itemscope: ["itemscope"],
        itemtype: null,
        lang: ["en", "es"],
        spellcheck: ["true", "false"],
        style: null,
        tabindex: ["1", "2", "3", "4", "5", "6", "7", "8", "9"],
        title: null,
        translate: ["yes", "no"],
        onclick: null,
        rel: ["stylesheet", "alternate", "author", "bookmark", "help", "license", "next", "nofollow", "noreferrer", "prefetch", "prev", "search", "tag"]
    };
    k(h);
    for (var l in i)i.hasOwnProperty(l) && i[l] != h && k(i[l]);
    a.htmlSchema = i, a.registerHelper("hint", "html", m)
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.registerHelper("fold", "indent", function (b, c) {
        var d = b.getOption("tabSize"), e = b.getLine(c.line);
        if (/\S/.test(e)) {
            for (var f = function (b) {
                return a.countColumn(b, null, d)
            }, g = f(e), h = null, i = c.line + 1, j = b.lastLine(); j >= i; ++i) {
                var k = b.getLine(i), l = f(k);
                if (l > g)h = i; else if (/\S/.test(k))break
            }
            return h ? {from: a.Pos(c.line, e.length), to: a.Pos(h, b.getLine(h).length)} : void 0
        }
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    function c(a, b) {
        for (var c = 0, d = a.length; d > c; ++c)b(a[c])
    }

    function d(a, b) {
        if (!Array.prototype.indexOf) {
            for (var c = a.length; c--;)if (a[c] === b)return !0;
            return !1
        }
        return -1 != a.indexOf(b)
    }

    function e(c, d, e, f) {
        var g = c.getCursor(), h = e(c, g), i = h;
        if (!/\b(?:string|comment)\b/.test(h.type)) {
            for (h.state = a.innerMode(c.getMode(), h.state).state, /^[\w$_]*$/.test(h.string) || (h = i = {
                start: g.ch,
                end: g.ch,
                string: "",
                state: h.state,
                type: "." == h.string ? "property" : null
            }); "property" == i.type;) {
                if (i = e(c, b(g.line, i.start)), "." != i.string)return;
                if (i = e(c, b(g.line, i.start)), !j)var j = [];
                j.push(i)
            }
            return {list: n(h, j, d, f), from: b(g.line, h.start), to: b(g.line, h.end)}
        }
    }

    function f(a, b) {
        return e(a, l, function (a, b) {
            return a.getTokenAt(b)
        }, b)
    }

    function g(a, b) {
        var c = a.getTokenAt(b);
        return b.ch == c.start + 1 && "." == c.string.charAt(0) ? (c.end = c.start, c.string = ".", c.type = "property") : /^\.[\w$_]*$/.test(c.string) && (c.type = "property", c.start++, c.string = c.string.replace(/\./, "")), c
    }

    function h(a, b) {
        return e(a, m, g, b)
    }

    function n(a, b, e, f) {
        function l(a) {
            0 != a.lastIndexOf(h, 0) || d(g, a) || g.push(a)
        }

        function m(a) {
            "string" == typeof a ? c(i, l) : a instanceof Array ? c(j, l) : a instanceof Function && c(k, l);
            for (var b in a)l(b)
        }

        var g = [], h = a.string;
        if (b && b.length) {
            var o, n = b.pop();
            for (n.type && 0 === n.type.indexOf("variable") ? (f && f.additionalContext && (o = f.additionalContext[n.string]), f && f.useGlobalScope === !1 || (o = o || window[n.string])) : "string" == n.type ? o = "" : "atom" == n.type ? o = 1 : "function" == n.type && (null == window.jQuery || "$" != n.string && "jQuery" != n.string || "function" != typeof window.jQuery ? null != window._ && "_" == n.string && "function" == typeof window._ && (o = window._()) : o = window.jQuery()); null != o && b.length;)o = o[b.pop().string];
            null != o && m(o)
        } else {
            for (var p = a.state.localVars; p; p = p.next)l(p.name);
            for (var p = a.state.globalVars; p; p = p.next)l(p.name);
            f && f.useGlobalScope === !1 || m(window), c(e, l)
        }
        return g
    }

    var b = a.Pos;
    a.registerHelper("hint", "javascript", f), a.registerHelper("hint", "coffeescript", h);
    var i = "charAt charCodeAt indexOf lastIndexOf substring substr slice trim trimLeft trimRight toUpperCase toLowerCase split concat match replace search".split(" "), j = "length concat join splice push pop shift unshift slice reverse sort indexOf lastIndexOf every some filter forEach map reduce reduceRight ".split(" "), k = "prototype apply call bind".split(" "), l = "break case catch continue debugger default delete do else false finally for function if in instanceof new null return switch throw true try typeof var void while with".split(" "), m = "and break catch class continue delete do else extends false finally for if in instanceof isnt new no not null of off on or return switch then throw true try typeof until void while with yes".split(" ")
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.registerHelper("fold", "markdown", function (b, c) {
        function e(c) {
            var d = b.getTokenTypeAt(a.Pos(c, 0));
            return d && /\bheader\b/.test(d)
        }

        function f(a, b, c) {
            var f = b && b.match(/^#+/);
            return f && e(a) ? f[0].length : (f = c && c.match(/^[=\-]+\s*$/), f && e(a + 1) ? "=" == c[0] ? 1 : 2 : d)
        }

        var d = 100, g = b.getLine(c.line), h = b.getLine(c.line + 1), i = f(c.line, g, h);
        if (i === d)return void 0;
        for (var j = b.lastLine(), k = c.line, l = b.getLine(k + 2); j > k && !(f(k + 1, h, l) <= i);)++k, h = l, l = b.getLine(k + 2);
        return {from: a.Pos(c.line, g.length), to: a.Pos(k, b.getLine(k).length)}
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function b(a) {
        a.operation(function () {
            j(a)
        })
    }

    function c(a) {
        a.state.markedSelection.length && a.operation(function () {
            h(a)
        })
    }

    function g(a, b, c, g) {
        if (0 != f(b, c))for (var h = a.state.markedSelection, i = a.state.markedSelectionStyle, j = b.line; ;) {
            var k = j == b.line ? b : e(j, 0), l = j + d, m = l >= c.line, n = m ? c : e(l, 0), o = a.markText(k, n, {className: i});
            if (null == g ? h.push(o) : h.splice(g++, 0, o), m)break;
            j = l
        }
    }

    function h(a) {
        for (var b = a.state.markedSelection, c = 0; c < b.length; ++c)b[c].clear();
        b.length = 0
    }

    function i(a) {
        h(a);
        for (var b = a.listSelections(), c = 0; c < b.length; c++)g(a, b[c].from(), b[c].to())
    }

    function j(a) {
        if (!a.somethingSelected())return h(a);
        if (a.listSelections().length > 1)return i(a);
        var b = a.getCursor("start"), c = a.getCursor("end"), e = a.state.markedSelection;
        if (!e.length)return g(a, b, c);
        var j = e[0].find(), k = e[e.length - 1].find();
        if (!j || !k || c.line - b.line < d || f(b, k.to) >= 0 || f(c, j.from) <= 0)return i(a);
        for (; f(b, j.from) > 0;)e.shift().clear(), j = e[0].find();
        for (f(b, j.from) < 0 && (j.to.line - b.line < d ? (e.shift().clear(), g(a, b, j.to, 0)) : g(a, b, j.from, 0)); f(c, k.to) < 0;)e.pop().clear(), k = e[e.length - 1].find();
        f(c, k.to) > 0 && (c.line - k.from.line < d ? (e.pop().clear(), g(a, k.from, c)) : g(a, k.to, c))
    }

    a.defineOption("styleSelectedText", !1, function (d, e, f) {
        var g = f && f != a.Init;
        e && !g ? (d.state.markedSelection = [], d.state.markedSelectionStyle = "string" == typeof e ? e : "CodeMirror-selectedtext", i(d), d.on("cursorActivity", b), d.on("change", c)) : !e && g && (d.off("cursorActivity", b), d.off("change", c), h(d), d.state.markedSelection = d.state.markedSelectionStyle = null)
    });
    var d = 8, e = a.Pos, f = a.cmpPos
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function e(a) {
        "object" == typeof a && (this.minChars = a.minChars, this.style = a.style, this.showToken = a.showToken, this.delay = a.delay), null == this.style && (this.style = c), null == this.minChars && (this.minChars = b), null == this.delay && (this.delay = d), this.overlay = this.timeout = null
    }

    function f(a) {
        var b = a.state.matchHighlighter;
        clearTimeout(b.timeout), b.timeout = setTimeout(function () {
            g(a)
        }, b.delay)
    }

    function g(a) {
        a.operation(function () {
            var b = a.state.matchHighlighter;
            if (b.overlay && (a.removeOverlay(b.overlay), b.overlay = null), !a.somethingSelected() && b.showToken) {
                for (var c = b.showToken === !0 ? /[\w$]/ : b.showToken, d = a.getCursor(), e = a.getLine(d.line), f = d.ch, g = f; f && c.test(e.charAt(f - 1));)--f;
                for (; g < e.length && c.test(e.charAt(g));)++g;
                return g > f && a.addOverlay(b.overlay = i(e.slice(f, g), c, b.style)), void 0
            }
            var h = a.getCursor("from"), j = a.getCursor("to");
            if (h.line == j.line) {
                var k = a.getRange(h, j).replace(/^\s+|\s+$/g, "");
                k.length >= b.minChars && a.addOverlay(b.overlay = i(k, !1, b.style))
            }
        })
    }

    function h(a, b) {
        return !(a.start && b.test(a.string.charAt(a.start - 1)) || a.pos != a.string.length && b.test(a.string.charAt(a.pos)))
    }

    function i(a, b, c) {
        return {
            token: function (d) {
                return !d.match(a) || b && !h(d, b) ? (d.next(), d.skipTo(a.charAt(0)) || d.skipToEnd(), void 0) : c
            }
        }
    }

    var b = 2, c = "matchhighlight", d = 100;
    a.defineOption("highlightSelectionMatches", !1, function (b, c, d) {
        if (d && d != a.Init) {
            var h = b.state.matchHighlighter.overlay;
            h && b.removeOverlay(h), clearTimeout(b.state.matchHighlighter.timeout), b.state.matchHighlighter = null, b.off("cursorActivity", f)
        }
        c && (b.state.matchHighlighter = new e(c), g(b), b.on("cursorActivity", f))
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    function e(a, b, e, g) {
        var h = a.getLineHandle(b.line), i = b.ch - 1, j = i >= 0 && d[h.text.charAt(i)] || d[h.text.charAt(++i)];
        if (!j)return null;
        var k = ">" == j.charAt(1) ? 1 : -1;
        if (e && k > 0 != (i == b.ch))return null;
        var l = a.getTokenTypeAt(c(b.line, i + 1)), m = f(a, c(b.line, i + (k > 0 ? 1 : 0)), k, l || null, g);
        return null == m ? null : {from: c(b.line, i), to: m && m.pos, match: m && m.ch == j.charAt(0), forward: k > 0}
    }

    function f(a, b, e, f, g) {
        for (var h = g && g.maxScanLineLength || 1e4, i = g && g.maxScanLines || 1e3, j = [], k = g && g.bracketRegex ? g.bracketRegex : /[(){}[\]]/, l = e > 0 ? Math.min(b.line + i, a.lastLine() + 1) : Math.max(a.firstLine() - 1, b.line - i), m = b.line; m != l; m += e) {
            var n = a.getLine(m);
            if (n) {
                var o = e > 0 ? 0 : n.length - 1, p = e > 0 ? n.length : -1;
                if (!(n.length > h))for (m == b.line && (o = b.ch - (0 > e ? 1 : 0)); o != p; o += e) {
                    var q = n.charAt(o);
                    if (k.test(q) && (void 0 === f || a.getTokenTypeAt(c(m, o + 1)) == f)) {
                        var r = d[q];
                        if (">" == r.charAt(1) == e > 0)j.push(q); else {
                            if (!j.length)return {pos: c(m, o), ch: q};
                            j.pop()
                        }
                    }
                }
            }
        }
        return m - e == (e > 0 ? a.lastLine() : a.firstLine()) ? !1 : null
    }

    function g(a, d, f) {
        for (var g = a.state.matchBrackets.maxHighlightLineLength || 1e3, h = [], i = a.listSelections(), j = 0; j < i.length; j++) {
            var k = i[j].empty() && e(a, i[j].head, !1, f);
            if (k && a.getLine(k.from.line).length <= g) {
                var l = k.match ? "CodeMirror-matchingbracket" : "CodeMirror-nonmatchingbracket";
                h.push(a.markText(k.from, c(k.from.line, k.from.ch + 1), {className: l})), k.to && a.getLine(k.to.line).length <= g && h.push(a.markText(k.to, c(k.to.line, k.to.ch + 1), {className: l}))
            }
        }
        if (h.length) {
            b && a.state.focused && a.display.input.focus();
            var m = function () {
                a.operation(function () {
                    for (var a = 0; a < h.length; a++)h[a].clear()
                })
            };
            if (!d)return m;
            setTimeout(m, 800)
        }
    }

    function i(a) {
        a.operation(function () {
            h && (h(), h = null), h = g(a, !1, a.state.matchBrackets)
        })
    }

    var b = /MSIE \d/.test(navigator.userAgent) && (null == document.documentMode || document.documentMode < 8), c = a.Pos, d = {
        "(": ")>",
        ")": "(<",
        "[": "]>",
        "]": "[<",
        "{": "}>",
        "}": "{<"
    }, h = null;
    a.defineOption("matchBrackets", !1, function (b, c, d) {
        d && d != a.Init && b.off("cursorActivity", i), c && (b.state.matchBrackets = "object" == typeof c ? c : {}, b.on("cursorActivity", i))
    }), a.defineExtension("matchBrackets", function () {
        g(this, !0)
    }), a.defineExtension("findMatchingBracket", function (a, b, c) {
        return e(this, a, b, c)
    }), a.defineExtension("scanForBracket", function (a, b, c, d) {
        return f(this, a, b, c, d)
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../fold/xml-fold")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../fold/xml-fold"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function b(a) {
        a.state.tagHit && a.state.tagHit.clear(), a.state.tagOther && a.state.tagOther.clear(), a.state.tagHit = a.state.tagOther = null
    }

    function c(c) {
        c.state.failedTagMatch = !1, c.operation(function () {
            if (b(c), !c.somethingSelected()) {
                var d = c.getCursor(), e = c.getViewport();
                e.from = Math.min(e.from, d.line), e.to = Math.max(d.line + 1, e.to);
                var f = a.findMatchingTag(c, d, e);
                if (f) {
                    if (c.state.matchBothTags) {
                        var g = "open" == f.at ? f.open : f.close;
                        g && (c.state.tagHit = c.markText(g.from, g.to, {className: "CodeMirror-matchingtag"}))
                    }
                    var h = "close" == f.at ? f.open : f.close;
                    h ? c.state.tagOther = c.markText(h.from, h.to, {className: "CodeMirror-matchingtag"}) : c.state.failedTagMatch = !0
                }
            }
        })
    }

    function d(a) {
        a.state.failedTagMatch && c(a)
    }

    a.defineOption("matchTags", !1, function (e, f, g) {
        g && g != a.Init && (e.off("cursorActivity", c), e.off("viewportChange", d), b(e)), f && (e.state.matchBothTags = "object" == typeof f && f.bothTags, e.on("cursorActivity", c), e.on("viewportChange", d), c(e))
    }), a.commands.toMatchingTag = function (b) {
        var c = a.findMatchingTag(b, b.getCursor());
        if (c) {
            var d = "close" == c.at ? c.open : c.close;
            d && b.extendSelection(d.to, d.from)
        }
    }
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    a.overlayMode = function (b, c, d) {
        return {
            startState: function () {
                return {
                    base: a.startState(b),
                    overlay: a.startState(c),
                    basePos: 0,
                    baseCur: null,
                    overlayPos: 0,
                    overlayCur: null,
                    lineSeen: null
                }
            }, copyState: function (d) {
                return {
                    base: a.copyState(b, d.base),
                    overlay: a.copyState(c, d.overlay),
                    basePos: d.basePos,
                    baseCur: null,
                    overlayPos: d.overlayPos,
                    overlayCur: null
                }
            }, token: function (a, e) {
                return (a.sol() || a.string != e.lineSeen || Math.min(e.basePos, e.overlayPos) < a.start) && (e.lineSeen = a.string, e.basePos = e.overlayPos = a.start), a.start == e.basePos && (e.baseCur = b.token(a, e.base), e.basePos = a.pos), a.start == e.overlayPos && (a.pos = a.start, e.overlayCur = c.token(a, e.overlay), e.overlayPos = a.pos), a.pos = Math.min(e.basePos, e.overlayPos), null == e.overlayCur ? e.baseCur : null != e.baseCur && e.overlay.combineTokens || d && null == e.overlay.combineTokens ? e.baseCur + " " + e.overlayCur : e.overlayCur
            }, indent: b.indent && function (a, c) {
                return b.indent(a.base, c)
            }, electricChars: b.electricChars, innerMode: function (a) {
                return {state: a.base, mode: b}
            }, blankLine: function (a) {
                b.blankLine && b.blankLine(a.base), c.blankLine && c.blankLine(a.overlay)
            }
        }
    }
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    function b(a) {
        a.state.placeholder && (a.state.placeholder.parentNode.removeChild(a.state.placeholder), a.state.placeholder = null)
    }

    function c(a) {
        b(a);
        var c = a.state.placeholder = document.createElement("pre");
        c.style.cssText = "height: 0; overflow: visible", c.className = "CodeMirror-placeholder", c.appendChild(document.createTextNode(a.getOption("placeholder"))), a.display.lineSpace.insertBefore(c, a.display.lineSpace.firstChild)
    }

    function d(a) {
        f(a) && c(a)
    }

    function e(a) {
        var d = a.getWrapperElement(), e = f(a);
        d.className = d.className.replace(" CodeMirror-empty", "") + (e ? " CodeMirror-empty" : ""), e ? c(a) : b(a)
    }

    function f(a) {
        return 1 === a.lineCount() && "" === a.getLine(0)
    }

    a.defineOption("placeholder", "", function (c, f, g) {
        var h = g && g != a.Init;
        if (f && !h)c.on("blur", d), c.on("change", e), e(c); else if (!f && h) {
            c.off("blur", d), c.off("change", e), b(c);
            var i = c.getWrapperElement();
            i.className = i.className.replace(" CodeMirror-empty", "")
        }
        f && !c.hasFocus() && d(c)
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function b(a) {
        for (var b = a.display.lineSpace.childNodes.length - 1; b >= 0; b--) {
            var c = a.display.lineSpace.childNodes[b];
            /(^|\s)CodeMirror-ruler($|\s)/.test(c.className) && c.parentNode.removeChild(c)
        }
    }

    function c(b) {
        for (var c = b.getOption("rulers"), d = b.defaultCharWidth(), e = b.charCoords(a.Pos(b.firstLine(), 0), "div").left, f = b.display.scroller.offsetHeight + 30, g = 0; g < c.length; g++) {
            var h = document.createElement("div");
            h.className = "CodeMirror-ruler";
            var i, j = null, k = c[g];
            "number" == typeof k ? i = k : (i = k.column, k.className && (h.className += " " + k.className), k.color && (h.style.borderColor = k.color), k.lineStyle && (h.style.borderLeftStyle = k.lineStyle), k.width && (h.style.borderLeftWidth = k.width), j = c[g].className), h.style.left = e + i * d + "px", h.style.top = "-50px", h.style.bottom = "-20px", h.style.minHeight = f + "px", b.display.lineSpace.insertBefore(h, b.display.cursorDiv)
        }
    }

    function d(a) {
        b(a), c(a)
    }

    a.defineOption("rulers", !1, function (e, f, g) {
        g && g != a.Init && (b(e), e.off("refresh", d)), f && f.length && (c(e), e.on("refresh", d))
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function c(a, c, e, f) {
        if (this.atOccurrence = !1, this.doc = a, null == f && "string" == typeof c && (f = !1), e = e ? a.clipPos(e) : b(0, 0), this.pos = {
                from: e,
                to: e
            }, "string" != typeof c)c.global || (c = new RegExp(c.source, c.ignoreCase ? "ig" : "g")), this.matches = function (d, e) {
            if (d) {
                c.lastIndex = 0;
                for (var h, i, f = a.getLine(e.line).slice(0, e.ch), g = 0; ;) {
                    c.lastIndex = g;
                    var j = c.exec(f);
                    if (!j)break;
                    if (h = j, i = h.index, g = h.index + (h[0].length || 1), g == f.length)break
                }
                var k = h && h[0].length || 0;
                k || (0 == i && 0 == f.length ? h = void 0 : i != a.getLine(e.line).length && k++)
            } else {
                c.lastIndex = e.ch;
                var f = a.getLine(e.line), h = c.exec(f), k = h && h[0].length || 0, i = h && h.index;
                i + k == f.length || k || (k = 1)
            }
            return h && k ? {from: b(e.line, i), to: b(e.line, i + k), match: h} : void 0
        }; else {
            var g = c;
            f && (c = c.toLowerCase());
            var h = f ? function (a) {
                return a.toLowerCase()
            } : function (a) {
                return a
            }, i = c.split("\n");
            if (1 == i.length)this.matches = c.length ? function (e, f) {
                if (e) {
                    var i = a.getLine(f.line).slice(0, f.ch), j = h(i), k = j.lastIndexOf(c);
                    if (k > -1)return k = d(i, j, k), {from: b(f.line, k), to: b(f.line, k + g.length)}
                } else {
                    var i = a.getLine(f.line).slice(f.ch), j = h(i), k = j.indexOf(c);
                    if (k > -1)return k = d(i, j, k) + f.ch, {from: b(f.line, k), to: b(f.line, k + g.length)}
                }
            } : function () {
            }; else {
                var j = g.split("\n");
                this.matches = function (c, d) {
                    var e = i.length - 1;
                    if (c) {
                        if (d.line - (i.length - 1) < a.firstLine())return;
                        if (h(a.getLine(d.line).slice(0, j[e].length)) != i[i.length - 1])return;
                        for (var f = b(d.line, j[e].length), g = d.line - 1, k = e - 1; k >= 1; --k, --g)if (i[k] != h(a.getLine(g)))return;
                        var l = a.getLine(g), m = l.length - j[0].length;
                        if (h(l.slice(m)) != i[0])return;
                        return {from: b(g, m), to: f}
                    }
                    if (!(d.line + (i.length - 1) > a.lastLine())) {
                        var l = a.getLine(d.line), m = l.length - j[0].length;
                        if (h(l.slice(m)) == i[0]) {
                            for (var n = b(d.line, m), g = d.line + 1, k = 1; e > k; ++k, ++g)if (i[k] != h(a.getLine(g)))return;
                            if (h(a.getLine(g).slice(0, j[e].length)) == i[e])return {from: n, to: b(g, j[e].length)}
                        }
                    }
                }
            }
        }
    }

    function d(a, b, c) {
        if (a.length == b.length)return c;
        for (var d = Math.min(c, a.length); ;) {
            var e = a.slice(0, d).toLowerCase().length;
            if (c > e)++d; else {
                if (!(e > c))return d;
                --d
            }
        }
    }

    var b = a.Pos;
    c.prototype = {
        findNext: function () {
            return this.find(!1)
        }, findPrevious: function () {
            return this.find(!0)
        }, find: function (a) {
            function e(a) {
                var d = b(a, 0);
                return c.pos = {from: d, to: d}, c.atOccurrence = !1, !1
            }

            for (var c = this, d = this.doc.clipPos(a ? this.pos.from : this.pos.to); ;) {
                if (this.pos = this.matches(a, d))return this.atOccurrence = !0, this.pos.match || !0;
                if (a) {
                    if (!d.line)return e(0);
                    d = b(d.line - 1, this.doc.getLine(d.line - 1).length)
                } else {
                    var f = this.doc.lineCount();
                    if (d.line == f - 1)return e(f);
                    d = b(d.line + 1, 0)
                }
            }
        }, from: function () {
            return this.atOccurrence ? this.pos.from : void 0
        }, to: function () {
            return this.atOccurrence ? this.pos.to : void 0
        }, replace: function (c) {
            if (this.atOccurrence) {
                var d = a.splitLines(c);
                this.doc.replaceRange(d, this.pos.from, this.pos.to), this.pos.to = b(this.pos.from.line + d.length - 1, d[d.length - 1].length + (1 == d.length ? this.pos.from.ch : 0))
            }
        }
    }, a.defineExtension("getSearchCursor", function (a, b, d) {
        return new c(this.doc, a, b, d)
    }), a.defineDocExtension("getSearchCursor", function (a, b, d) {
        return new c(this, a, b, d)
    }), a.defineExtension("selectMatches", function (b, c) {
        for (var e, d = [], f = this.getSearchCursor(b, this.getCursor("from"), c); (e = f.findNext()) && !(a.cmpPos(f.to(), this.getCursor("to")) > 0);)d.push({
            anchor: f.from(),
            head: f.to()
        });
        d.length && this.setSelections(d, 0)
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function d(a, b) {
        this.cm = a, this.options = this.buildOptions(b), this.widget = this.onClose = null
    }

    function e(a) {
        return "string" == typeof a ? a : a.text
    }

    function f(a, b) {
        function f(a, d) {
            var f;
            f = "string" != typeof d ? function (a) {
                return d(a, b)
            } : c.hasOwnProperty(d) ? c[d] : d, e[a] = f
        }

        var c = {
            Up: function () {
                b.moveFocus(-1)
            }, Down: function () {
                b.moveFocus(1)
            }, PageUp: function () {
                b.moveFocus(-b.menuSize() + 1, !0)
            }, PageDown: function () {
                b.moveFocus(b.menuSize() - 1, !0)
            }, Home: function () {
                b.setFocus(0)
            }, End: function () {
                b.setFocus(b.length - 1)
            }, Enter: b.pick, Tab: b.pick, Esc: b.close
        }, d = a.options.customKeys, e = d ? {} : c;
        if (d)for (var g in d)d.hasOwnProperty(g) && f(g, d[g]);
        var h = a.options.extraKeys;
        if (h)for (var g in h)h.hasOwnProperty(g) && f(g, h[g]);
        return e
    }

    function g(a, b) {
        for (; b && b != a;) {
            if ("LI" === b.nodeName.toUpperCase() && b.parentNode == a)return b;
            b = b.parentNode
        }
    }

    function h(d, h) {
        this.completion = d, this.data = h;
        var i = this, j = d.cm, k = this.hints = document.createElement("ul");
        k.className = "CodeMirror-hints", this.selectedHint = h.selectedHint || 0;
        for (var l = h.list, m = 0; m < l.length; ++m) {
            var n = k.appendChild(document.createElement("li")), o = l[m], p = b + (m != this.selectedHint ? "" : " " + c);
            null != o.className && (p = o.className + " " + p), n.className = p, o.render ? o.render(n, h, o) : n.appendChild(document.createTextNode(o.displayText || e(o))), n.hintId = m
        }
        var q = j.cursorCoords(d.options.alignWithWord ? h.from : null), r = q.left, s = q.bottom, t = !0;
        k.style.left = r + "px", k.style.top = s + "px";
        var u = window.innerWidth || Math.max(document.body.offsetWidth, document.documentElement.offsetWidth), v = window.innerHeight || Math.max(document.body.offsetHeight, document.documentElement.offsetHeight);
        (d.options.container || document.body).appendChild(k);
        var w = k.getBoundingClientRect(), x = w.bottom - v;
        if (x > 0) {
            var y = w.bottom - w.top, z = q.top - (q.bottom - w.top);
            if (z - y > 0)k.style.top = (s = q.top - y) + "px", t = !1; else if (y > v) {
                k.style.height = v - 5 + "px", k.style.top = (s = q.bottom - w.top) + "px";
                var A = j.getCursor();
                h.from.ch != A.ch && (q = j.cursorCoords(A), k.style.left = (r = q.left) + "px", w = k.getBoundingClientRect())
            }
        }
        var B = w.left - u;
        if (B > 0 && (w.right - w.left > u && (k.style.width = u - 5 + "px", B -= w.right - w.left - u), k.style.left = (r = q.left - B) + "px"), j.addKeyMap(this.keyMap = f(d, {
                moveFocus: function (a, b) {
                    i.changeActive(i.selectedHint + a, b)
                }, setFocus: function (a) {
                    i.changeActive(a)
                }, menuSize: function () {
                    return i.screenAmount()
                }, length: l.length, close: function () {
                    d.close()
                }, pick: function () {
                    i.pick()
                }, data: h
            })), d.options.closeOnUnfocus) {
            var C;
            j.on("blur", this.onBlur = function () {
                C = setTimeout(function () {
                    d.close()
                }, 100)
            }), j.on("focus", this.onFocus = function () {
                clearTimeout(C)
            })
        }
        var D = j.getScrollInfo();
        return j.on("scroll", this.onScroll = function () {
            var a = j.getScrollInfo(), b = j.getWrapperElement().getBoundingClientRect(), c = s + D.top - a.top, e = c - (window.pageYOffset || (document.documentElement || document.body).scrollTop);
            return t || (e += k.offsetHeight), e <= b.top || e >= b.bottom ? d.close() : (k.style.top = c + "px", k.style.left = r + D.left - a.left + "px", void 0)
        }), a.on(k, "dblclick", function (a) {
            var b = g(k, a.target || a.srcElement);
            b && null != b.hintId && (i.changeActive(b.hintId), i.pick())
        }), a.on(k, "click", function (a) {
            var b = g(k, a.target || a.srcElement);
            b && null != b.hintId && (i.changeActive(b.hintId), d.options.completeOnSingleClick && i.pick())
        }), a.on(k, "mousedown", function () {
            setTimeout(function () {
                j.focus()
            }, 20)
        }), a.signal(h, "select", l[0], k.firstChild), !0
    }

    var b = "CodeMirror-hint", c = "CodeMirror-hint-active";
    a.showHint = function (a, b, c) {
        if (!b)return a.showHint(c);
        c && c.async && (b.async = !0);
        var d = {hint: b};
        if (c)for (var e in c)d[e] = c[e];
        return a.showHint(d)
    }, a.defineExtension("showHint", function (b) {
        if (!(this.listSelections().length > 1 || this.somethingSelected())) {
            this.state.completionActive && this.state.completionActive.close();
            var c = this.state.completionActive = new d(this, b), e = c.options.hint;
            if (e)return a.signal(this, "startCompletion", this), e.async ? (e(this, function (a) {
                c.showHints(a)
            }, c.options), void 0) : c.showHints(e(this, c.options))
        }
    }), d.prototype = {
        close: function () {
            this.active() && (this.cm.state.completionActive = null, this.widget && this.widget.close(), this.onClose && this.onClose(), a.signal(this.cm, "endCompletion", this.cm))
        }, active: function () {
            return this.cm.state.completionActive == this
        }, pick: function (b, c) {
            var d = b.list[c];
            d.hint ? d.hint(this.cm, b, d) : this.cm.replaceRange(e(d), d.from || b.from, d.to || b.to, "complete"), a.signal(b, "pick", d), this.close()
        }, showHints: function (a) {
            return a && a.list.length && this.active() ? (this.options.completeSingle && 1 == a.list.length ? this.pick(a, 0) : this.showWidget(a), void 0) : this.close()
        }, showWidget: function (b) {
            function l() {
                e || (e = !0, d.close(), d.cm.off("cursorActivity", p), b && a.signal(b, "close"))
            }

            function m() {
                if (!e) {
                    a.signal(b, "update");
                    var c = d.options.hint;
                    c.async ? c(d.cm, n, d.options) : n(c(d.cm, d.options))
                }
            }

            function n(a) {
                if (b = a, !e) {
                    if (!b || !b.list.length)return l();
                    d.widget && d.widget.close(), d.widget = new h(d, b)
                }
            }

            function o() {
                c && (k(c), c = 0)
            }

            function p() {
                o();
                var a = d.cm.getCursor(), b = d.cm.getLine(a.line);
                a.line != g.line || b.length - a.ch != i - g.ch || a.ch < g.ch || d.cm.somethingSelected() || a.ch && f.test(b.charAt(a.ch - 1)) ? d.close() : (c = j(m), d.widget && d.widget.close())
            }

            this.widget = new h(this, b), a.signal(b, "shown");
            var e, c = 0, d = this, f = this.options.closeCharacters, g = this.cm.getCursor(), i = this.cm.getLine(g.line).length, j = window.requestAnimationFrame || function (a) {
                    return setTimeout(a, 1e3 / 60)
                }, k = window.cancelAnimationFrame || clearTimeout;
            this.cm.on("cursorActivity", p), this.onClose = l
        }, buildOptions: function (a) {
            var b = this.cm.options.hintOptions, c = {};
            for (var d in i)c[d] = i[d];
            if (b)for (var d in b)void 0 !== b[d] && (c[d] = b[d]);
            if (a)for (var d in a)void 0 !== a[d] && (c[d] = a[d]);
            return c
        }
    }, h.prototype = {
        close: function () {
            if (this.completion.widget == this) {
                this.completion.widget = null, this.hints.parentNode.removeChild(this.hints), this.completion.cm.removeKeyMap(this.keyMap);
                var a = this.completion.cm;
                this.completion.options.closeOnUnfocus && (a.off("blur", this.onBlur), a.off("focus", this.onFocus)), a.off("scroll", this.onScroll)
            }
        }, pick: function () {
            this.completion.pick(this.data, this.selectedHint)
        }, changeActive: function (b, d) {
            if (b >= this.data.list.length ? b = d ? this.data.list.length - 1 : 0 : 0 > b && (b = d ? 0 : this.data.list.length - 1), this.selectedHint != b) {
                var e = this.hints.childNodes[this.selectedHint];
                e.className = e.className.replace(" " + c, ""), e = this.hints.childNodes[this.selectedHint = b], e.className += " " + c, e.offsetTop < this.hints.scrollTop ? this.hints.scrollTop = e.offsetTop - 3 : e.offsetTop + e.offsetHeight > this.hints.scrollTop + this.hints.clientHeight && (this.hints.scrollTop = e.offsetTop + e.offsetHeight - this.hints.clientHeight + 3), a.signal(this.data, "select", this.data.list[this.selectedHint], e)
            }
        }, screenAmount: function () {
            return Math.floor(this.hints.clientHeight / this.hints.firstChild.offsetHeight) || 1
        }
    }, a.registerHelper("hint", "auto", function (b, c) {
        var e, d = b.getHelpers(b.getCursor(), "hint");
        if (d.length)for (var f = 0; f < d.length; f++) {
            var g = d[f](b, c);
            if (g && g.list.length)return g
        } else if (e = b.getHelper(b.getCursor(), "hintWords")) {
            if (e)return a.hint.fromList(b, {words: e})
        } else if (a.hint.anyword)return a.hint.anyword(b, c)
    }), a.registerHelper("hint", "fromList", function (b, c) {
        for (var d = b.getCursor(), e = b.getTokenAt(d), f = [], g = 0; g < c.words.length; g++) {
            var h = c.words[g];
            h.slice(0, e.string.length) == e.string && f.push(h)
        }
        return f.length ? {list: f, from: a.Pos(d.line, e.start), to: a.Pos(d.line, e.end)} : void 0
    }), a.commands.autocomplete = a.showHint;
    var i = {
        hint: a.hint.auto,
        completeSingle: !0,
        alignWithWord: !0,
        closeCharacters: /[\s()\[\]{};:>,]/,
        closeOnUnfocus: !0,
        completeOnSingleClick: !1,
        container: null,
        customKeys: null,
        extraKeys: null
    };
    a.defineOption("hintOptions", null)
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../../mode/sql/sql")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../../mode/sql/sql"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function f(b) {
        var c = b.doc.modeOption;
        return "sql" === c && (c = "text/x-sql"), a.resolveMode(c).keywords
    }

    function g(a, b) {
        var c = a.length, d = b.substr(0, c);
        return a.toUpperCase() === d.toUpperCase()
    }

    function h(a, b, c, d) {
        for (var e in c)c.hasOwnProperty(e) && (Array.isArray(c) && (e = c[e]), g(b, e) && a.push(d(e)))
    }

    function i(a, c) {
        var d = c.getCursor(), f = c.getTokenAt(d), g = f.string.substr(1), i = e(d.line, f.start), j = c.getTokenAt(i).string;
        b.hasOwnProperty(j) || (j = m(j, c));
        var k = b[j];
        k && h(a, g, k, function (a) {
            return "." + a
        })
    }

    function j(a, b) {
        if (a)for (var c = /[,;]/g, d = a.split(" "), e = 0; e < d.length; e++)b(d[e] ? d[e].replace(c, "") : "")
    }

    function k(a) {
        return a.line + a.ch / Math.pow(10, 6)
    }

    function l(a) {
        return e(Math.floor(a), +a.toString().split(".").pop())
    }

    function m(a, c) {
        for (var f = c.doc, g = f.getValue(), h = a.toUpperCase(), i = "", m = "", n = [], o = {
            start: e(0, 0),
            end: e(c.lastLine(), c.getLineHandle(c.lastLine()).length)
        }, p = g.indexOf(d.QUERY_DIV); -1 != p;)n.push(f.posFromIndex(p)), p = g.indexOf(d.QUERY_DIV, p + 1);
        n.unshift(e(0, 0)), n.push(e(c.lastLine(), c.getLineHandle(c.lastLine()).text.length));
        for (var q = 0, r = k(c.getCursor()), s = 0; s < n.length; s++) {
            var t = k(n[s]);
            if (r > q && t >= r) {
                o = {start: l(q), end: l(t)};
                break
            }
            q = t
        }
        for (var u = f.getRange(o.start, o.end, !1), s = 0; s < u.length; s++) {
            var v = u[s];
            if (j(v, function (a) {
                    var c = a.toUpperCase();
                    c === h && b.hasOwnProperty(i) && (m = i), c !== d.ALIAS_KEYWORD && (i = a)
                }), m)break
        }
        return m
    }

    function n(a, d) {
        b = d && d.tables || {}, c = c || f(a);
        var g = a.getCursor(), j = a.getTokenAt(g), k = j.end, l = [], m = j.string.trim();
        if ("." == m.charAt(0)) {
            if (i(l, a), !l.length) {
                for (; j.start && "." == m.charAt(0);)j = a.getTokenAt(e(g.line, j.start - 1)), m = j.string + m;
                h(l, m, b, function (a) {
                    return a
                })
            }
        } else h(l, m, c, function (a) {
            return a.toUpperCase()
        }), h(l, m, b, function (a) {
            return a
        });
        return {list: l, from: e(g.line, j.start), to: e(g.line, k)}
    }

    var b, c, d = {QUERY_DIV: ";", ALIAS_KEYWORD: "AS"}, e = a.Pos;
    a.registerHelper("hint", "sql", n)
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    a.defineOption("showTrailingSpace", !1, function (b, c, d) {
        d == a.Init && (d = !1), d && !c ? b.removeOverlay("trailingspace") : !d && c && b.addOverlay({
            token: function (a) {
                for (var b = a.string.length, c = b; c && /\s/.test(a.string.charAt(c - 1)); --c);
                return c > a.pos ? (a.pos = c, null) : (a.pos = b, "trailingspace")
            }, name: "trailingspace"
        })
    })
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function c(a, b) {
        return a.line - b.line || a.ch - b.ch
    }

    function g(a, b, c, d) {
        this.line = b, this.ch = c, this.cm = a, this.text = a.getLine(b), this.min = d ? d.from : a.firstLine(), this.max = d ? d.to - 1 : a.lastLine()
    }

    function h(a, c) {
        var d = a.cm.getTokenTypeAt(b(a.line, c));
        return d && /\btag\b/.test(d)
    }

    function i(a) {
        return a.line >= a.max ? void 0 : (a.ch = 0, a.text = a.cm.getLine(++a.line), !0)
    }

    function j(a) {
        return a.line <= a.min ? void 0 : (a.text = a.cm.getLine(--a.line), a.ch = a.text.length, !0)
    }

    function k(a) {
        for (; ;) {
            var b = a.text.indexOf(">", a.ch);
            if (-1 == b) {
                if (i(a))continue;
                return
            }
            {
                if (h(a, b + 1)) {
                    var c = a.text.lastIndexOf("/", b), d = c > -1 && !/\S/.test(a.text.slice(c + 1, b));
                    return a.ch = b + 1, d ? "selfClose" : "regular"
                }
                a.ch = b + 1
            }
        }
    }

    function l(a) {
        for (; ;) {
            var b = a.ch ? a.text.lastIndexOf("<", a.ch - 1) : -1;
            if (-1 == b) {
                if (j(a))continue;
                return
            }
            if (h(a, b + 1)) {
                f.lastIndex = b, a.ch = b;
                var c = f.exec(a.text);
                if (c && c.index == b)return c
            } else a.ch = b
        }
    }

    function m(a) {
        for (; ;) {
            f.lastIndex = a.ch;
            var b = f.exec(a.text);
            if (!b) {
                if (i(a))continue;
                return
            }
            {
                if (h(a, b.index + 1))return a.ch = b.index + b[0].length, b;
                a.ch = b.index + 1
            }
        }
    }

    function n(a) {
        for (; ;) {
            var b = a.ch ? a.text.lastIndexOf(">", a.ch - 1) : -1;
            if (-1 == b) {
                if (j(a))continue;
                return
            }
            {
                if (h(a, b + 1)) {
                    var c = a.text.lastIndexOf("/", b), d = c > -1 && !/\S/.test(a.text.slice(c + 1, b));
                    return a.ch = b + 1, d ? "selfClose" : "regular"
                }
                a.ch = b
            }
        }
    }

    function o(a, c) {
        for (var d = []; ;) {
            var f, e = m(a), g = a.line, h = a.ch - (e ? e[0].length : 0);
            if (!e || !(f = k(a)))return;
            if ("selfClose" != f)if (e[1]) {
                for (var i = d.length - 1; i >= 0; --i)if (d[i] == e[2]) {
                    d.length = i;
                    break
                }
                if (0 > i && (!c || c == e[2]))return {tag: e[2], from: b(g, h), to: b(a.line, a.ch)}
            } else d.push(e[2])
        }
    }

    function p(a, c) {
        for (var d = []; ;) {
            var e = n(a);
            if (!e)return;
            if ("selfClose" != e) {
                var f = a.line, g = a.ch, h = l(a);
                if (!h)return;
                if (h[1])d.push(h[2]); else {
                    for (var i = d.length - 1; i >= 0; --i)if (d[i] == h[2]) {
                        d.length = i;
                        break
                    }
                    if (0 > i && (!c || c == h[2]))return {tag: h[2], from: b(a.line, a.ch), to: b(f, g)}
                }
            } else l(a)
        }
    }

    var b = a.Pos, d = "A-Z_a-z\\u00C0-\\u00D6\\u00D8-\\u00F6\\u00F8-\\u02FF\\u0370-\\u037D\\u037F-\\u1FFF\\u200C-\\u200D\\u2070-\\u218F\\u2C00-\\u2FEF\\u3001-\\uD7FF\\uF900-\\uFDCF\\uFDF0-\\uFFFD", e = d + "-:.0-9\\u00B7\\u0300-\\u036F\\u203F-\\u2040", f = new RegExp("<(/?)([" + d + "][" + e + "]*)", "g");
    a.registerHelper("fold", "xml", function (a, c) {
        for (var d = new g(a, c.line, 0); ;) {
            var f, e = m(d);
            if (!e || d.line != c.line || !(f = k(d)))return;
            if (!e[1] && "selfClose" != f) {
                var c = b(d.line, d.ch), h = o(d, e[2]);
                return h && {from: c, to: h.from}
            }
        }
    }), a.findMatchingTag = function (a, d, e) {
        var f = new g(a, d.line, d.ch, e);
        if (-1 != f.text.indexOf(">") || -1 != f.text.indexOf("<")) {
            var h = k(f), i = h && b(f.line, f.ch), j = h && l(f);
            if (h && "selfClose" != h && j && !(c(f, d) > 0)) {
                var m = {from: b(f.line, f.ch), to: i, tag: j[2]};
                return j[1] ? {open: p(f, j[2]), close: m, at: "close"} : (f = new g(a, i.line, i.ch, e), {
                    open: m,
                    close: o(f, j[2]),
                    at: "open"
                })
            }
        }
    }, a.findEnclosingTag = function (a, b, c) {
        for (var d = new g(a, b.line, b.ch, c); ;) {
            var e = p(d);
            if (!e)break;
            var f = new g(a, b.line, b.ch, c), h = o(f, e.tag);
            if (h)return {open: e, close: h}
        }
    }, a.scanForClosingTag = function (a, b, c, d) {
        var e = new g(a, b.line, b.ch, d ? {from: 0, to: d} : null);
        return o(e, c)
    }
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function c(c, d) {
        var e = d && d.schemaInfo, f = d && d.quoteChar || '"';
        if (e) {
            var g = c.getCursor(), h = c.getTokenAt(g), i = a.innerMode(c.getMode(), h.state);
            if ("xml" == i.mode.name) {
                var l, o, j = [], k = !1, m = /\btag\b/.test(h.type), n = m && /^\w/.test(h.string);
                if (n) {
                    var p = c.getLine(g.line).slice(Math.max(0, h.start - 2), h.start), q = /<\/$/.test(p) ? "close" : /<$/.test(p) ? "open" : null;
                    q && (o = h.start - ("close" == q ? 2 : 1))
                } else m && "<" == h.string ? q = "open" : m && "</" == h.string && (q = "close");
                if (!m && !i.state.tagName || q) {
                    n && (l = h.string), k = q;
                    var r = i.state.context, s = r && e[r.tagName], t = r ? s && s.children : e["!top"];
                    if (t && "close" != q)for (var u = 0; u < t.length; ++u)l && 0 != t[u].lastIndexOf(l, 0) || j.push("<" + t[u]); else if ("close" != q)for (var v in e)!e.hasOwnProperty(v) || "!top" == v || "!attrs" == v || l && 0 != v.lastIndexOf(l, 0) || j.push("<" + v);
                    r && (!l || "close" == q && 0 == r.tagName.lastIndexOf(l, 0)) && j.push("</" + r.tagName + ">")
                } else {
                    var s = e[i.state.tagName], w = s && s.attrs, x = e["!attrs"];
                    if (!w && !x)return;
                    if (w) {
                        if (x) {
                            var y = {};
                            for (var z in x)x.hasOwnProperty(z) && (y[z] = x[z]);
                            for (var z in w)w.hasOwnProperty(z) && (y[z] = w[z]);
                            w = y
                        }
                    } else w = x;
                    if ("string" == h.type || "=" == h.string) {
                        var B, p = c.getRange(b(g.line, Math.max(0, g.ch - 60)), b(g.line, "string" == h.type ? h.start : h.end)), A = p.match(/([^\s\u00a0=<>\"\']+)=$/);
                        if (!A || !w.hasOwnProperty(A[1]) || !(B = w[A[1]]))return;
                        if ("function" == typeof B && (B = B.call(this, c)), "string" == h.type) {
                            l = h.string;
                            var C = 0;
                            /['"]/.test(h.string.charAt(0)) && (f = h.string.charAt(0), l = h.string.slice(1), C++);
                            var D = h.string.length;
                            /['"]/.test(h.string.charAt(D - 1)) && (f = h.string.charAt(D - 1), l = h.string.substr(C, D - 2)), k = !0
                        }
                        for (var u = 0; u < B.length; ++u)l && 0 != B[u].lastIndexOf(l, 0) || j.push(f + B[u] + f)
                    } else {
                        "attribute" == h.type && (l = h.string, k = !0);
                        for (var E in w)!w.hasOwnProperty(E) || l && 0 != E.lastIndexOf(l, 0) || j.push(E)
                    }
                }
                return {list: j, from: k ? b(g.line, null == o ? h.start : o) : g, to: k ? b(g.line, h.end) : g}
            }
        }
    }

    var b = a.Pos;
    a.registerHelper("hint", "xml", c)
}), function (a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../lib/codemirror"), require("../addon/search/searchcursor"), require("../addon/edit/matchbrackets")) : "function" == typeof define && define.amd ? define(["../lib/codemirror", "../addon/search/searchcursor", "../addon/edit/matchbrackets"], a) : a(CodeMirror)
}(function (a) {
    "use strict";
    function f(b, c, e) {
        if (0 > e && 0 == c.ch)return b.clipPos(d(c.line - 1));
        var f = b.getLine(c.line);
        if (e > 0 && c.ch >= f.length)return b.clipPos(d(c.line + 1, 0));
        for (var h, g = "start", i = c.ch, j = 0 > e ? 0 : f.length, k = 0; i != j; i += e, k++) {
            var l = f.charAt(0 > e ? i - 1 : i), m = "_" != l && a.isWordChar(l) ? "w" : "o";
            if ("w" == m && l.toUpperCase() == l && (m = "W"), "start" == g)"o" != m && (g = "in", h = m); else if ("in" == g && h != m) {
                if ("w" == h && "W" == m && 0 > e && i--, "W" == h && "w" == m && e > 0) {
                    h = "w";
                    continue
                }
                break
            }
        }
        return d(c.line, i)
    }

    function g(a, b) {
        a.extendSelectionsBy(function (c) {
            return a.display.shift || a.doc.extend || c.empty() ? f(a.doc, c.head, b) : 0 > b ? c.from() : c.to()
        })
    }

    function h(a, b) {
        a.operation(function () {
            for (var c = a.listSelections().length, e = [], f = -1, g = 0; c > g; g++) {
                var h = a.listSelections()[g].head;
                if (!(h.line <= f)) {
                    var i = d(h.line + (b ? 0 : 1), 0);
                    a.replaceRange("\n", i, null, "+insertLine"), a.indentLine(i.line, null, !0), e.push({
                        head: i,
                        anchor: i
                    }), f = h.line + 1
                }
            }
            a.setSelections(e)
        })
    }

    function i(b, c) {
        for (var e = c.ch, f = e, g = b.getLine(c.line); e && a.isWordChar(g.charAt(e - 1));)--e;
        for (; f < g.length && a.isWordChar(g.charAt(f));)++f;
        return {from: d(c.line, e), to: d(c.line, f), word: g.slice(e, f)}
    }

    function k(a) {
        var b = a.getCursor(), c = a.scanForBracket(b, -1);
        if (c)for (; ;) {
            var e = a.scanForBracket(b, 1);
            if (!e)return;
            if (e.ch == j.charAt(j.indexOf(c.ch) + 1))return a.setSelection(d(c.pos.line, c.pos.ch + 1), e.pos, !1), !0;
            b = d(e.pos.line, e.pos.ch + 1)
        }
    }

    function l(a, b) {
        for (var f, c = a.listSelections(), e = [], g = 0; g < c.length; g++) {
            var h = c[g];
            if (!h.empty()) {
                for (var i = h.from().line, j = h.to().line; g < c.length - 1 && c[g + 1].from().line == j;)j = h[++g].to().line;
                e.push(i, j)
            }
        }
        e.length ? f = !0 : e.push(a.firstLine(), a.lastLine()), a.operation(function () {
            for (var c = [], g = 0; g < e.length; g += 2) {
                var h = e[g], i = e[g + 1], j = d(h, 0), k = d(i), l = a.getRange(j, k, !1);
                b ? l.sort() : l.sort(function (a, b) {
                    var c = a.toUpperCase(), d = b.toUpperCase();
                    return c != d && (a = c, b = d), b > a ? -1 : a == b ? 0 : 1
                }), a.replaceRange(l, j, k), f && c.push({anchor: j, head: k})
            }
            f && a.setSelections(c, 0)
        })
    }

    function n(b, c) {
        b.operation(function () {
            for (var d = b.listSelections(), e = [], f = [], g = 0; g < d.length; g++) {
                var h = d[g];
                h.empty() ? (e.push(g), f.push("")) : f.push(c(b.getRange(h.from(), h.to())))
            }
            b.replaceSelections(f, "around", "case");
            for (var j, g = e.length - 1; g >= 0; g--) {
                var h = d[e[g]];
                if (!(j && a.cmpPos(h.head, j) > 0)) {
                    var k = i(b, h.head);
                    j = k.from, b.replaceRange(c(k.word), k.from, k.to)
                }
            }
        })
    }

    function o(b) {
        var c = b.getCursor("from"), d = b.getCursor("to");
        if (0 == a.cmpPos(c, d)) {
            var e = i(b, c);
            if (!e.word)return;
            c = e.from, d = e.to
        }
        return {from: c, to: d, query: b.getRange(c, d), word: e}
    }

    function p(a, b) {
        var c = o(a);
        if (c) {
            var e = c.query, f = a.getSearchCursor(e, b ? c.to : c.from);
            (b ? f.findNext() : f.findPrevious()) ? a.setSelection(f.from(), f.to()) : (f = a.getSearchCursor(e, b ? d(a.firstLine(), 0) : a.clipPos(d(a.lastLine()))), (b ? f.findNext() : f.findPrevious()) ? a.setSelection(f.from(), f.to()) : c.word && a.setSelection(c.from, c.to))
        }
    }

    var b = a.keyMap.sublime = {fallthrough: "default"}, c = a.commands, d = a.Pos, e = a.keyMap["default"] == a.keyMap.pcDefault ? "Ctrl-" : "Cmd-";
    c[b["Alt-Left"] = "goSubwordLeft"] = function (a) {
        g(a, -1)
    }, c[b["Alt-Right"] = "goSubwordRight"] = function (a) {
        g(a, 1)
    }, c[b[e + "Up"] = "scrollLineUp"] = function (a) {
        var b = a.getScrollInfo();
        if (!a.somethingSelected()) {
            var c = a.lineAtHeight(b.top + b.clientHeight, "local");
            a.getCursor().line >= c && a.execCommand("goLineUp")
        }
        a.scrollTo(null, b.top - a.defaultTextHeight())
    }, c[b[e + "Down"] = "scrollLineDown"] = function (a) {
        var b = a.getScrollInfo();
        if (!a.somethingSelected()) {
            var c = a.lineAtHeight(b.top, "local") + 1;
            a.getCursor().line <= c && a.execCommand("goLineDown")
        }
        a.scrollTo(null, b.top + a.defaultTextHeight())
    }, c[b["Shift-" + e + "L"] = "splitSelectionByLine"] = function (a) {
        for (var b = a.listSelections(), c = [], e = 0; e < b.length; e++)for (var f = b[e].from(), g = b[e].to(), h = f.line; h <= g.line; ++h)g.line > f.line && h == g.line && 0 == g.ch || c.push({
            anchor: h == f.line ? f : d(h, 0),
            head: h == g.line ? g : d(h)
        });
        a.setSelections(c, 0)
    }, b["Shift-Tab"] = "indentLess", c[b.Esc = "singleSelectionTop"] = function (a) {
        var b = a.listSelections()[0];
        a.setSelection(b.anchor, b.head, {scroll: !1})
    }, c[b[e + "L"] = "selectLine"] = function (a) {
        for (var b = a.listSelections(), c = [], e = 0; e < b.length; e++) {
            var f = b[e];
            c.push({anchor: d(f.from().line, 0), head: d(f.to().line + 1, 0)})
        }
        a.setSelections(c)
    }, b["Shift-" + e + "K"] = "deleteLine", c[b[e + "Enter"] = "insertLineAfter"] = function (a) {
        h(a, !1)
    }, c[b["Shift-" + e + "Enter"] = "insertLineBefore"] = function (a) {
        h(a, !0)
    }, c[b[e + "D"] = "selectNextOccurrence"] = function (b) {
        var c = b.getCursor("from"), e = b.getCursor("to"), f = b.state.sublimeFindFullWord == b.doc.sel;
        if (0 == a.cmpPos(c, e)) {
            var g = i(b, c);
            if (!g.word)return;
            b.setSelection(g.from, g.to), f = !0
        } else {
            var h = b.getRange(c, e), j = f ? new RegExp("\\b" + h + "\\b") : h, k = b.getSearchCursor(j, e);
            k.findNext() ? b.addSelection(k.from(), k.to()) : (k = b.getSearchCursor(j, d(b.firstLine(), 0)), k.findNext() && b.addSelection(k.from(), k.to()))
        }
        f && (b.state.sublimeFindFullWord = b.doc.sel)
    };
    var j = "(){}[]";
    c[b["Shift-" + e + "Space"] = "selectScope"] = function (a) {
        k(a) || a.execCommand("selectAll")
    }, c[b["Shift-" + e + "M"] = "selectBetweenBrackets"] = function (b) {
        return k(b) ? void 0 : a.Pass
    }, c[b[e + "M"] = "goToBracket"] = function (b) {
        b.extendSelectionsBy(function (c) {
            var e = b.scanForBracket(c.head, 1);
            if (e && 0 != a.cmpPos(e.pos, c.head))return e.pos;
            var f = b.scanForBracket(c.head, -1);
            return f && d(f.pos.line, f.pos.ch + 1) || c.head
        })
    }, c[b["Shift-" + e + "Up"] = "swapLineUp"] = function (a) {
        for (var b = a.listSelections(), c = [], e = a.firstLine() - 1, f = [], g = 0; g < b.length; g++) {
            var h = b[g], i = h.from().line - 1, j = h.to().line;
            f.push({
                anchor: d(h.anchor.line - 1, h.anchor.ch),
                head: d(h.head.line - 1, h.head.ch)
            }), 0 != h.to().ch || h.empty() || --j, i > e ? c.push(i, j) : c.length && (c[c.length - 1] = j), e = j
        }
        a.operation(function () {
            for (var b = 0; b < c.length; b += 2) {
                var e = c[b], g = c[b + 1], h = a.getLine(e);
                a.replaceRange("", d(e, 0), d(e + 1, 0), "+swapLine"), g > a.lastLine() ? a.replaceRange("\n" + h, d(a.lastLine()), null, "+swapLine") : a.replaceRange(h + "\n", d(g, 0), null, "+swapLine")
            }
            a.setSelections(f), a.scrollIntoView()
        })
    }, c[b["Shift-" + e + "Down"] = "swapLineDown"] = function (a) {
        for (var b = a.listSelections(), c = [], e = a.lastLine() + 1, f = b.length - 1; f >= 0; f--) {
            var g = b[f], h = g.to().line + 1, i = g.from().line;
            0 != g.to().ch || g.empty() || h--, e > h ? c.push(h, i) : c.length && (c[c.length - 1] = i), e = i
        }
        a.operation(function () {
            for (var b = c.length - 2; b >= 0; b -= 2) {
                var e = c[b], f = c[b + 1], g = a.getLine(e);
                e == a.lastLine() ? a.replaceRange("", d(e - 1), d(e), "+swapLine") : a.replaceRange("", d(e, 0), d(e + 1, 0), "+swapLine"), a.replaceRange(g + "\n", d(f, 0), null, "+swapLine")
            }
            a.scrollIntoView()
        })
    }, b[e + "/"] = "toggleComment", c[b[e + "J"] = "joinLines"] = function (a) {
        for (var b = a.listSelections(), c = [], e = 0; e < b.length; e++) {
            for (var f = b[e], g = f.from(), h = g.line, i = f.to().line; e < b.length - 1 && b[e + 1].from().line == i;)i = b[++e].to().line;
            c.push({start: h, end: i, anchor: !f.empty() && g})
        }
        a.operation(function () {
            for (var b = 0, e = [], f = 0; f < c.length; f++) {
                for (var i, g = c[f], h = g.anchor && d(g.anchor.line - b, g.anchor.ch), j = g.start; j <= g.end; j++) {
                    var k = j - b;
                    j == g.end && (i = d(k, a.getLine(k).length + 1)), k < a.lastLine() && (a.replaceRange(" ", d(k), d(k + 1, /^\s*/.exec(a.getLine(k + 1))[0].length)), ++b)
                }
                e.push({anchor: h || i, head: i})
            }
            a.setSelections(e, 0)
        })
    }, c[b["Shift-" + e + "D"] = "duplicateLine"] = function (a) {
        a.operation(function () {
            for (var b = a.listSelections().length, c = 0; b > c; c++) {
                var e = a.listSelections()[c];
                e.empty() ? a.replaceRange(a.getLine(e.head.line) + "\n", d(e.head.line, 0)) : a.replaceRange(a.getRange(e.from(), e.to()), e.from())
            }
            a.scrollIntoView()
        })
    }, b[e + "T"] = "transposeChars", c[b.F9 = "sortLines"] = function (a) {
        l(a, !0)
    }, c[b[e + "F9"] = "sortLinesInsensitive"] = function (a) {
        l(a, !1)
    }, c[b.F2 = "nextBookmark"] = function (a) {
        var b = a.state.sublimeBookmarks;
        if (b)for (; b.length;) {
            var c = b.shift(), d = c.find();
            if (d)return b.push(c), a.setSelection(d.from, d.to)
        }
    }, c[b["Shift-F2"] = "prevBookmark"] = function (a) {
        var b = a.state.sublimeBookmarks;
        if (b)for (; b.length;) {
            b.unshift(b.pop());
            var c = b[b.length - 1].find();
            if (c)return a.setSelection(c.from, c.to);
            b.pop()
        }
    }, c[b[e + "F2"] = "toggleBookmark"] = function (a) {
        for (var b = a.listSelections(), c = a.state.sublimeBookmarks || (a.state.sublimeBookmarks = []), d = 0; d < b.length; d++) {
            for (var e = b[d].from(), f = b[d].to(), g = a.findMarks(e, f), h = 0; h < g.length; h++)if (g[h].sublimeBookmark) {
                g[h].clear();
                for (var i = 0; i < c.length; i++)c[i] == g[h] && c.splice(i--, 1);
                break
            }
            h == g.length && c.push(a.markText(e, f, {sublimeBookmark: !0, clearWhenEmpty: !1}))
        }
    }, c[b["Shift-" + e + "F2"] = "clearBookmarks"] = function (a) {
        var b = a.state.sublimeBookmarks;
        if (b)for (var c = 0; c < b.length; c++)b[c].clear();
        b.length = 0
    }, c[b["Alt-F2"] = "selectBookmarks"] = function (a) {
        var b = a.state.sublimeBookmarks, c = [];
        if (b)for (var d = 0; d < b.length; d++) {
            var e = b[d].find();
            e ? c.push({anchor: e.from, head: e.to}) : b.splice(d--, 0)
        }
        c.length && a.setSelections(c, 0)
    }, b["Alt-Q"] = "wrapLines";
    var m = a.keyMap["sublime-Ctrl-K"] = {auto: "sublime", nofallthrough: !0};
    b[e + "K"] = function (a) {
        a.setOption("keyMap", "sublime-Ctrl-K")
    }, m[e + "Backspace"] = "delLineLeft", c[m[e + "K"] = "delLineRight"] = function (a) {
        a.operation(function () {
            for (var b = a.listSelections(), c = b.length - 1; c >= 0; c--)a.replaceRange("", b[c].anchor, d(b[c].to().line), "+delete");
            a.scrollIntoView()
        })
    }, c[m[e + "U"] = "upcaseAtCursor"] = function (a) {
        n(a, function (a) {
            return a.toUpperCase()
        })
    }, c[m[e + "L"] = "downcaseAtCursor"] = function (a) {
        n(a, function (a) {
            return a.toLowerCase()
        })
    }, c[m[e + "Space"] = "setSublimeMark"] = function (a) {
        a.state.sublimeMark && a.state.sublimeMark.clear(), a.state.sublimeMark = a.setBookmark(a.getCursor())
    }, c[m[e + "A"] = "selectToSublimeMark"] = function (a) {
        var b = a.state.sublimeMark && a.state.sublimeMark.find();
        b && a.setSelection(a.getCursor(), b)
    }, c[m[e + "W"] = "deleteToSublimeMark"] = function (b) {
        var c = b.state.sublimeMark && b.state.sublimeMark.find();
        if (c) {
            var d = b.getCursor(), e = c;
            if (a.cmpPos(d, e) > 0) {
                var f = e;
                e = d, d = f
            }
            b.state.sublimeKilled = b.getRange(d, e), b.replaceRange("", d, e)
        }
    }, c[m[e + "X"] = "swapWithSublimeMark"] = function (a) {
        var b = a.state.sublimeMark && a.state.sublimeMark.find();
        b && (a.state.sublimeMark.clear(), a.state.sublimeMark = a.setBookmark(a.getCursor()), a.setCursor(b))
    }, c[m[e + "Y"] = "sublimeYank"] = function (a) {
        null != a.state.sublimeKilled && a.replaceSelection(a.state.sublimeKilled, null, "paste")
    }, m[e + "G"] = "clearBookmarks", c[m[e + "C"] = "showInCenter"] = function (a) {
        var b = a.cursorCoords(null, "local");
        a.scrollTo(null, (b.top + b.bottom) / 2 - a.getScrollInfo().clientHeight / 2)
    }, c[b["Shift-Alt-Up"] = "selectLinesUpward"] = function (a) {
        a.operation(function () {
            for (var b = a.listSelections(), c = 0; c < b.length; c++) {
                var e = b[c];
                e.head.line > a.firstLine() && a.addSelection(d(e.head.line - 1, e.head.ch))
            }
        })
    }, c[b["Shift-Alt-Down"] = "selectLinesDownward"] = function (a) {
        a.operation(function () {
            for (var b = a.listSelections(), c = 0; c < b.length; c++) {
                var e = b[c];
                e.head.line < a.lastLine() && a.addSelection(d(e.head.line + 1, e.head.ch))
            }
        })
    }, c[b[e + "F3"] = "findUnder"] = function (a) {
        p(a, !0)
    }, c[b["Shift-" + e + "F3"] = "findUnderPrevious"] = function (a) {
        p(a, !1)
    }, c[b["Alt-F3"] = "findAllUnder"] = function (a) {
        var b = o(a);
        if (b) {
            for (var c = a.getSearchCursor(b.query), d = [], e = -1; c.findNext();)d.push({
                anchor: c.from(),
                head: c.to()
            }), c.from().line <= b.from.line && c.from().ch <= b.from.ch && e++;
            a.setSelections(d, e)
        }
    }, b["Shift-" + e + "["] = "fold", b["Shift-" + e + "]"] = "unfold", m[e + "0"] = m[e + "j"] = "unfoldAll", b[e + "I"] = "findIncremental", b["Shift-" + e + "I"] = "findIncrementalReverse", b[e + "H"] = "replace", b.F3 = "findNext", b["Shift-F3"] = "findPrev"
});