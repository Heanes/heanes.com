/**
 * @doc 应用函数
 * @author Heanes
 * @time 2015-06-09 10:13:32
 */

/* 右下角导航事件响应 */
//添加要加载执行的事件:
//addLoadEvent(gotoTop('goto_top', false , 1000));
//addLoadEvent(gotoBottom('goto_bottom', false , 100));
/*
 var clientHeight=document.documentElement.clientHeight || document.body.clientHeight;
 alert(clientHeight);//839
 var scrollHeight=document.documentElement.scrollHeight || document.body.scrollHeight;
 alert(scrollHeight);//2030
 var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
 alert(scrollTop);//1191
 */
/**
 * 回到顶部功能
 * 第一个参数是按钮id；
 * 第二个参数是一个布尔值，true是一直显示按钮，false是当滚动距离不为0时，显示按钮；
 * 第三个参数是滚动高度，默认为1000
 */
function gotoTop(id, show,height) {
    var oTop = document.getElementById(id);
    var bShow = show;
    if (!bShow) {
        oTop.style.display = 'none';
        setTimeout(btnShow(height), 50);
    }
    oTop.onclick = scrollToTop;
    function scrollToTop() {
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var iSpeed = Math.floor(-scrollTop / 2);
        if (scrollTop <= 0) {
            if (!bShow) {
                oTop.style.display = 'none';
            }
            return;
        }
        document.documentElement.scrollTop = document.body.scrollTop = scrollTop + iSpeed;
        setTimeout(arguments.callee, 50);
    }
    function btnShow(height) {
        height = height!=null? height:1000;
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        if (scrollTop >= height) {
            oTop.style.display = 'block';
        } else {
            oTop.style.display = 'none';
        }
        setTimeout(arguments.callee, 50);
    }
}
/**
 * 回到底部功能
 * 第一个参数是按钮id；
 * 第二个参数是一个布尔值，true是一直显示按钮，false是当滚动距离不为0时，显示按钮；
 * 第三个参数是滚动高度，默认为1000
 */
function gotoBottom(id, show,height) {
    var oTop = document.getElementById(id);
    var bShow = show;
    if (!bShow) {
        oTop.style.display = 'block';
        setTimeout(btnShow(height), 50);
    }
    oTop.onclick = scrollToBottom;
    function scrollToBottom() {
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
        var iSpeed = Math.floor(-scrollTop / 2);
        if (scrollTop <= 0) {
            if (!bShow) {
                oTop.style.display = 'none';
            }
            return;
        }
        document.documentElement.scrollTop = document.body.scrollHeight = scrollHeight + iSpeed;
        setTimeout(arguments.callee, 50);
    }
    function btnShow(height) {
        height = height!=null? height:100;
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var clientHeight=document.documentElement.clientHeight || document.body.clientHeight;
        var scrollHeight=document.documentElement.scrollHeight || document.body.scrollHeight;
        if (scrollTop + clientHeight >= scrollHeight-height) {
            oTop.style.display = 'none';
        } else {
            oTop.style.display = 'block';
        }
        setTimeout(arguments.callee, 50);
    }
}

//监听load事件，防止冲突;
function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {//判断类型是否为'function',注意typeof返回的是字符串
        window.onload = func;
    } else {
        window.onload = function() {
            oldonload();//调用之前覆盖的onload事件的函数---->由于我对js了解不多,这里我暂时理解为通过覆盖onload事件的函数来实现加载多个函数
            func();
        }
    }
}


/*
 * 为低版本IE添加placeholder效果
 *
 * 使用范例：
 * [html]
 * <input id="captcha" name="captcha" type="text" placeholder="验证码" value="" >
 * [javascrpt]
 * $("#captcha")placeholder();
 *
 * 生效后提交表单时，placeholder的内容会被提交到服务器，提交前需要把值清空
 * 范例：
 * $('[data-placeholder="placeholder"]').val("");
 * $("#form").submit();
 *
 */
(function($) {
    $.fn.placeholder = function() {
        var isPlaceholder = 'placeholder' in document.createElement('input');
        return this.each(function() {
            if(!isPlaceholder) {
                $el = $(this);
                $el.focus(function() {
                    if($el.attr("placeholder") === $el.val()) {
                        $el.val("");
                        $el.attr("data-placeholder", "");
                    }
                }).blur(function() {
                    if($el.val() === "") {
                        $el.val($el.attr("placeholder"));
                        $el.attr("data-placeholder", "placeholder");
                    }
                }).blur();
            }
        });
    };
})(jQuery);
