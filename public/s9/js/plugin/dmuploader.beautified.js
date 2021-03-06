!function(t) {
    var upload_bo;
    var n = "dmUploader", i = {
        url: document.URL,
        method: "POST",
        extraData: {},
        maxFileSize: 0,
        allowedTypes: "*",
        extFilter: null,
        dataType: null,
        fileName: "file",
        onInit: function() {},
        onFallbackMode: function() {
            message;
        },
        onNewFile: function(e, t) {},
        onBeforeUpload: function(e) {},
        onComplete: function() {},
        onUploadProgress: function(e, t) {},
        onUploadSuccess: function(e, t) {},
        onUploadError: function(e, t) {},
        onFileTypeError: function(e) {},
        onFileSizeError: function(e) {},
        onFileExtError: function(e) {},
    }, o = function(e, n) {
        return this.element = t(e), this.settings = t.extend({}, i, n), this.checkBrowser() ? (this.init(), 
        !0) : !1;
    };
    o.prototype.checkBrowser = function() {
        return void 0 === window.FormData ? (this.settings.onFallbackMode.call(this.element, "该浏览器不支持该上传插件，将无法使用上传功能！"), 
        !1) : this.element.find("input[type=file]").length > 0 ? !0 : this.checkEvent("drop", this.element) && this.checkEvent("dragstart", this.element) ? !0 : (this.settings.onFallbackMode.call(this.element, "浏览器不支持拖放！"), 
        !1);
    }, o.prototype.checkEvent = function(e, t) {
        var t = t || document.createElement("div"), e = "on" + e, n = e in t;
        return n || (t.setAttribute || (t = document.createElement("div")), t.setAttribute && t.removeAttribute && (t.setAttribute(e, ""), 
        n = "function" == typeof t[e], "undefined" != typeof t[e] && (t[e] = void 0), t.removeAttribute(e))), 
        t = null, n;
    }, o.prototype.init = function() {
        var e = this;
        e.queue = new Array(), e.queuePos = -1, e.queueRunning = !1, e.element.on("drop", function(t) {
            t.preventDefault();
            var n = t.originalEvent.dataTransfer.files;
            e.queueFiles(n);
        }), e.element.find("input[type=file]").on("change", function(n) {
            var i = n.target.files;
            e.queueFiles(i), t(this).val("");
        }), this.settings.onInit.call(this.element);
    }, o.prototype.queueFiles = function(e) {
        for (var n = this.queue.length, i = 0; i < e.length; i++) {
            var o = e[i];
            if (this.settings.maxFileSize > 0 && o.size > this.settings.maxFileSize) this.settings.onFileSizeError.call(this.element, o); else if ("*" == this.settings.allowedTypes || o.type.match(this.settings.allowedTypes)) {
                if (null != this.settings.extFilter) {
                    var s = this.settings.extFilter.toLowerCase().split(";"), u = o.name.toLowerCase().split(".").pop();
                    if (t.inArray(u, s) < 0) {
                        this.settings.onFileExtError.call(this.element, o);
                        continue;
                    }
                }
                this.queue.push(o);
                var l = this.queue.length - 1;
                this.settings.onNewFile.call(this.element, l, o);
            } else this.settings.onFileTypeError.call(this.element, o);
        }
        return this.queueRunning ? !1 : this.queue.length == n ? !1 : (this.processQueue(), 
        !0);
    }, o.prototype.processQueue = function() {
        var n = this;
        if (n.queuePos++, n.queuePos >= n.queue.length) return n.settings.onComplete.call(n.element), 
        n.queuePos = n.queue.length - 1, void (n.queueRunning = !1);
        var i = n.queue[n.queuePos], o = new FormData();
        o.append(n.settings.fileName, i), t.each(n.settings.extraData, function(e, t) {
            o.append(e, t);
        }), n.settings.onBeforeUpload.call(n.element, n.queuePos), n.queueRunning = !0, 
        
        upload_bo = t.ajax({
            url: n.settings.url,
            type: n.settings.method,
            dataType: n.settings.dataType,
            data: o,
            cache: !1,
            contentType: !1,
            processData: !1,
            forceSync: !1,
            xhr: function() {
                var i = t.ajaxSettings.xhr();
                return i.upload && i.upload.addEventListener("progress", function(t) {
                    var i = 0, o = t.loaded || t.position, s = t.total || e.totalSize;
                    t.lengthComputable && (i = Math.ceil(o / s * 100)), n.settings.onUploadProgress.call(n.element, n.queuePos, i);
                }, !1), i;
            },
            success: function(e, t, i) {
                n.settings.onUploadSuccess.call(n.element, n.queuePos, e);
            },
            error: function(e, t, i) {
                n.settings.onUploadError.call(n.element, n.queuePos, i);
            },
            complete: function(e, t) {
                n.processQueue();
            }
        });
    }, t.fn.dmUploader = function(e) {
        return this.each(function() {
            t.data(this, n) || t.data(this, n, new o(this, e));
        });
    }, t(document).on("dragenter", function(e) {
        e.stopPropagation(), e.preventDefault();
    }), t(document).on("dragover", function(e) {
        e.stopPropagation(), e.preventDefault();
    }), t(document).on("drop", function(e) {
        e.stopPropagation(), e.preventDefault();
    }),$(document).on("click",'#cancel',function(e) {
            if(confirm('是否取消本次上传')){
            upload_bo.abort();
            $('.hg_gdt').hide();
            }else{return false;}
    });
}(jQuery);