var navOffsetTop;
setInterval(function() {
    var date3= new Date((new Date().getTime()) - 1419043380000);
    var days=Math.floor(date3/(24*3600*1000))
    var leave1=date3%(24*3600*1000)
    var hours=Math.floor(leave1/(3600*1000))
    var leave2=leave1%(3600*1000)
    var minutes=Math.floor(leave2/(60*1000))
    var leave3=leave2%(60*1000)
    var seconds=Math.round(leave3/1000)
    document.querySelector("#run-time").innerHTML=(days+"天"+hours+"小时"+minutes+"分钟"+seconds+"秒")
} , 1000);

document.addEventListener('DOMContentLoaded',function(){
    checkElementFade();
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?136ddc5fd444ca501e348fd4f3c3dae8";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    pjax = new Pjax({ elements:["a[pjax]",".page-navigator a"],selectors: [".article-list"],scrollTo:true});
    initProtectArticle();
    initReadMore();
    initComment();
    /* var ap = new APlayer({
    element: document.getElementById('aplayer'),
    narrow: false,
    autoplay: false,
    showlrc: 0,
    mutex: true,
    theme: '#FFFFFF',
    mode: 'order',
    preload: 'metadata',
    listmaxheight: '513px',
    music: [
            {
                title: '回レ！雪月花',
                author: '原田ひとみ / 茅野愛衣 / 小倉唯',
                url: 'https://api.imjad.cn/cloudmusic/?type=song&id=28018274&br=128000&raw=1',
                pic: 'https://p1.music.126.net/UrbsnGXM8_cc3nLd3Ru3zw==/18541064580889962.jpg'
            },
            {
                title: '恋爱サーキュレーション',
                author: '花澤香菜',
                url: 'https://api.imjad.cn/cloudmusic/?type=song&id=579954&br=128000&raw=1',
                pic: 'https://p1.music.126.net/hWrYLdhzF4waj4WL1dFPmg==/642114790633458.jpg'
            },
        ]
    });  
    document.querySelector('.aplayer-list').classList.add('aplayer-list-hide'); */
    
    document.addEventListener('pjax:success',function(){
        checkElementFade();
        initProtectArticle();
        initComment();
        initReadMore();
        var codeBlocks=document.querySelectorAll('pre code');
        [].forEach.call(codeBlocks, function(e){
        　　hljs.highlightBlock(e);
        });
    });
    
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?136ddc5fd444ca501e348fd4f3c3dae8";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
    
        var codeBlocks=document.querySelectorAll('pre code');
        [].forEach.call(codeBlocks, function(e){
        　　hljs.highlightBlock(e);
        });
        
});

document.addEventListener('scroll',checkElementFade);
setTimeout(function() {document.addEventListener('scroll',checkTopbarShow);}, 1500);
function initComment(){
    var sendCommentElement=document.querySelector('#submit-comment');
    if(sendCommentElement){
        sendCommentElement.addEventListener('click',function(e){
            //主题支持到IE11 所以没用fetch
            document.querySelector('.warning_tip').style.height="0";
            document.querySelector('.warning_tip').style.opacity="0";
            e.target.innerHTML="<span class=\"mdi mdi-cube-send\"></span>&nbsp提交中";
            var form = document.querySelector('form');
            var data = new FormData(form);
            var req = new XMLHttpRequest();
            req.open('POST', form.action, true);
            req.send(data);
            req.onreadystatechange = function(){
                if(req.readyState == 4){
                    if(req.status == 200){
                        if(req.responseText.indexOf("Error")!=-1){
                            document.querySelector('.warning_tip').style.height="auto";
                            document.querySelector('.warning_tip').style.opacity="1";
                            document.querySelector('.warning_tip').style.backgroundColor="#bb0909";
                            document.querySelector('.warning_tip').innerHTML="发送失败 可能是您的发言太频繁或联系方式有误";
                            document.querySelector('.submit').innerHTML="<span class=\"mdi mdi-send\"></span>&nbsp;提交评论";
                        }else{
                            document.querySelector('.warning_tip').style.height="auto";
                            document.querySelector('.warning_tip').style.opacity="1";
                            document.querySelector('.warning_tip').style.backgroundColor="green";
                            document.querySelector('.warning_tip').innerHTML="发送成功";
                            document.querySelector('.submit').innerHTML="<span class=\"mdi mdi-send\"></span>&nbsp;提交评论";
                            var e = document.createElement('li');
                            e.innerHTML = '<div class="comment-element" id="comment-TMP"><div class="comment-container"><div class="comment-author-avatar"><a href="' + data.get('url') + '"><img class="avatar" src="https://gravatar.cat.net/avatar/' + data.get('mail').MD5(32) + '?s=55&amp;r=G&amp;d=" alt="' + data.get('author') + '" width="55" height="55"></a></div><div class="comment-author-info"><div class="comment-meta"><span class="comment-author-name"><a href="' + data.get('url') + '" rel="external nofollow">' + data.get('author') + '</a></span><a class="comment-time" href="#">' + new Date().toLocaleDateString() + '</a></div><div class="comment-content"><p>' + data.get('text') + '</p></div></div></div></div>';
                            e.className="comment-body comment-parent comment-odd";
                            document.querySelector('.comment-list').append(e);
                        }
                    }else{
                        
                    }
                }
            }
        });
    }
}
function initReadMore(){
    var readMoreLink=document.querySelectorAll('.more a');
        [].forEach.call(readMoreLink, function(e){
        e.addEventListener('click',function(e){
        e.preventDefault();
        var stxt=e.target.parentNode.parentNode;
        e.target.text=" 少女折寿中...";
        if(e.target.protectedArticle==true){
            var form = e.target.parentNode.parentNode.querySelector('form.protected');
            var data = new FormData(form);
            var req = new XMLHttpRequest();
            req.open('POST', form.action, true);
            req.send(data);
            req.onreadystatechange = function(){
                if(req.readyState == 4 && req.status == 200){
                    if(req.responseText.indexOf("错误")==-1){
                        loadMoreArticle(stxt,e);
                    }else{
                        alert('密码错误！');
                        e.target.text=" 解锁文章";
                        return;
                    }
                }
            }
        }else{
            loadMoreArticle(stxt,e);
        }
            
    　　})
    });
}
function loadMoreArticle(stxt,e){
    var req = new XMLHttpRequest();
                        req.open('GET',e.target.href + "?ajaxload", true);
                        req.send();
                        req.onreadystatechange = function(){
                            if(req.readyState == 4){
                                if(req.status == 200){
                                    stxt.innerHTML=req.responseText;
                                    loadCommentReply(stxt.querySelector('.respond'));
                                    var codeBlocks=stxt.querySelectorAll('pre code');
                                    [].forEach.call(codeBlocks, function(e){
                                    　　hljs.highlightBlock(e);
                                    });
                                    var sendCommentElement=stxt.querySelector('#submit-comment');
                                    if(sendCommentElement){
                                        sendCommentElement.addEventListener('click',function(e){
                                            //主题支持到IE11 所以没用fetch
                                            stxt.querySelector('.warning_tip').style.height="0";
                                            stxt.querySelector('.warning_tip').style.opacity="0";
                                            stxt.querySelector('.submit').innerHTML="<span class=\"mdi mdi-cube-send\"></span>&nbsp提交中";
                                            var form = stxt.querySelector('form');
                                            var data = new FormData(form);
                                            var req = new XMLHttpRequest();
                                            req.open('POST', form.action, true);
                                            req.send(data);
                                            req.onreadystatechange = function(){
                                                if(req.readyState == 4){
                                                    if(req.status == 200){
                                                        if(req.responseText.indexOf("Error")!=-1){
                                                            stxt.querySelector('.warning_tip').style.height="auto";
                                                            stxt.querySelector('.warning_tip').style.opacity="1";
                                                            stxt.querySelector('.warning_tip').style.backgroundColor="#bb0909";
                                                            stxt.querySelector('.warning_tip').innerHTML="发送失败 可能是您的发言太频繁或联系方式有误";
                                                            stxt.querySelector('.submit').innerHTML="<span class=\"mdi mdi-send\"></span>&nbsp;提交评论";
                                                        }else{
                                                            stxt.querySelector('.warning_tip').style.height="auto";
                                                            stxt.querySelector('.warning_tip').style.opacity="1";
                                                            stxt.querySelector('.warning_tip').style.backgroundColor="green";
                                                            stxt.querySelector('.warning_tip').innerHTML="发送成功";
                                                            stxt.querySelector('.submit').innerHTML="<span class=\"mdi mdi-send\"></span>&nbsp;提交评论";
                                                            var e = stxt.createElement('li');
                                                            e.innerHTML = '<div class="comment-element" id="comment-TMP"><div class="comment-container"><div class="comment-author-avatar"><a href="' + data.get('url') + '"><img class="avatar" src="https://gravatar.cat.net/avatar/' + data.get('mail').MD5(32) + '?s=55&amp;r=G&amp;d=" alt="' + data.get('author') + '" width="55" height="55"></a></div><div class="comment-author-info"><div class="comment-meta"><span class="comment-author-name"><a href="' + data.get('url') + '" rel="external nofollow">' + data.get('author') + '</a></span><a class="comment-time" href="#">' + new Date().toLocaleDateString() + '</a></div><div class="comment-content"><p>' + data.get('text') + '</p></div></div></div></div>';
                                                            e.className="comment-body comment-parent comment-odd";
                                                            stxt.querySelector('.comment-list').append(e);
                                                        }
                                                    }else{
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }else{
                                }
                            }
                        }
}
function checkElementFade(){
    var articleElements=document.querySelectorAll('.article,.page-navigator,.footer,.shuoshuo');
    [].forEach.call(articleElements, function(e){
        if(e.getBoundingClientRect().top < window.innerHeight){
            e.style.opacity="1";
            e.classList.add("animated");
            e.classList.add("fadeInUp");
        };
    });
}
function checkTopbarShow(e){
    var navElement = document.querySelector('.nav');
    
    if(!navOffsetTop){navOffsetTop=navElement.offsetParent.offsetTop+navElement.offsetTop}
    if (window.scrollY >= navOffsetTop){
        navElement.classList.add('FloatNav');
        document.querySelector('.middle').className="middle";
        document.querySelector('.info').style.paddingBottom="51px";
    }else{
        navElement.classList.remove('FloatNav');
        document.querySelector('.info').style.paddingBottom="0";
    }
}
function biggerFont(targetid){
    var target=document.querySelector('#' + targetid);
    target.style.fontSize= (target.style.fontSize=='') ? '15px' : target.style.fontSize;
    target.style.fontSize=(parseInt(target.style.fontSize)+1) + "px"; 
}

function initProtectArticle(){
    var protectedArticles=document.querySelectorAll('form.protected');
    [].forEach.call(protectedArticles, function(e){
    　　e.querySelector('input[name=protectPassword]').placeholder="输入密码以解锁...";
    　　e.parentNode.querySelector('.more>a').innerHTML=" 解锁文章";
    　　e.parentNode.querySelector('.more>a').protectedArticle=true;
    });
}

String.prototype.MD5 = function (bit)
{
    var sMessage = this;
    function RotateLeft(lValue, iShiftBits) { return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits)); } 
    function AddUnsigned(lX,lY)
    {
        var lX4,lY4,lX8,lY8,lResult;
        lX8 = (lX & 0x80000000);
        lY8 = (lY & 0x80000000);
        lX4 = (lX & 0x40000000);
        lY4 = (lY & 0x40000000);
        lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF); 
        if (lX4 & lY4) return (lResult ^ 0x80000000 ^ lX8 ^ lY8); 
        if (lX4 | lY4)
        { 
            if (lResult & 0x40000000) return (lResult ^ 0xC0000000 ^ lX8 ^ lY8); 
            else return (lResult ^ 0x40000000 ^ lX8 ^ lY8); 
        } else return (lResult ^ lX8 ^ lY8); 
    } 
    function F(x,y,z) { return (x & y) | ((~x) & z); } 
    function G(x,y,z) { return (x & z) | (y & (~z)); } 
    function H(x,y,z) { return (x ^ y ^ z); } 
    function I(x,y,z) { return (y ^ (x | (~z))); } 
    function FF(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function GG(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function HH(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function II(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function ConvertToWordArray(sMessage)
    { 
        var lWordCount; 
        var lMessageLength = sMessage.length; 
        var lNumberOfWords_temp1=lMessageLength + 8; 
        var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64; 
        var lNumberOfWords = (lNumberOfWords_temp2+1)*16; 
        var lWordArray=Array(lNumberOfWords-1); 
        var lBytePosition = 0; 
        var lByteCount = 0; 
        while ( lByteCount < lMessageLength )
        { 
            lWordCount = (lByteCount-(lByteCount % 4))/4; 
            lBytePosition = (lByteCount % 4)*8; 
            lWordArray[lWordCount] = (lWordArray[lWordCount] | (sMessage.charCodeAt(lByteCount)<<lBytePosition)); 
            lByteCount++; 
        } 
        lWordCount = (lByteCount-(lByteCount % 4))/4; 
        lBytePosition = (lByteCount % 4)*8; 
        lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition); 
        lWordArray[lNumberOfWords-2] = lMessageLength<<3; 
        lWordArray[lNumberOfWords-1] = lMessageLength>>>29; 
        return lWordArray; 
    } 
    function WordToHex(lValue)
    { 
        var WordToHexValue="",WordToHexValue_temp="",lByte,lCount; 
        for (lCount = 0;lCount<=3;lCount++)
        { 
            lByte = (lValue>>>(lCount*8)) & 255; 
            WordToHexValue_temp = "0" + lByte.toString(16); 
            WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2); 
        } 
        return WordToHexValue; 
    } 
    var x=Array(); 
    var k,AA,BB,CC,DD,a,b,c,d 
    var S11=7, S12=12, S13=17, S14=22; 
    var S21=5, S22=9 , S23=14, S24=20; 
    var S31=4, S32=11, S33=16, S34=23; 
    var S41=6, S42=10, S43=15, S44=21; 
    // Steps 1 and 2. Append padding bits and length and convert to words 
    x = ConvertToWordArray(sMessage); 
    // Step 3. Initialise 
    a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476; 
    // Step 4. Process the message in 16-word blocks 
    for (k=0;k<x.length;k+=16)
    { 
        AA=a; BB=b; CC=c; DD=d; 
        a=FF(a,b,c,d,x[k+0], S11,0xD76AA478); 
        d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756); 
        c=FF(c,d,a,b,x[k+2], S13,0x242070DB); 
        b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE); 
        a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF); 
        d=FF(d,a,b,c,x[k+5], S12,0x4787C62A); 
        c=FF(c,d,a,b,x[k+6], S13,0xA8304613); 
        b=FF(b,c,d,a,x[k+7], S14,0xFD469501); 
        a=FF(a,b,c,d,x[k+8], S11,0x698098D8); 
        d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF); 
        c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1); 
        b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE); 
        a=FF(a,b,c,d,x[k+12],S11,0x6B901122); 
        d=FF(d,a,b,c,x[k+13],S12,0xFD987193); 
        c=FF(c,d,a,b,x[k+14],S13,0xA679438E); 
        b=FF(b,c,d,a,x[k+15],S14,0x49B40821); 
        a=GG(a,b,c,d,x[k+1], S21,0xF61E2562); 
        d=GG(d,a,b,c,x[k+6], S22,0xC040B340); 
        c=GG(c,d,a,b,x[k+11],S23,0x265E5A51); 
        b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA); 
        a=GG(a,b,c,d,x[k+5], S21,0xD62F105D); 
        d=GG(d,a,b,c,x[k+10],S22,0x2441453); 
        c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681); 
        b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8); 
        a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6); 
        d=GG(d,a,b,c,x[k+14],S22,0xC33707D6); 
        c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87); 
        b=GG(b,c,d,a,x[k+8], S24,0x455A14ED); 
        a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905); 
        d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8); 
        c=GG(c,d,a,b,x[k+7], S23,0x676F02D9); 
        b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A); 
        a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942); 
        d=HH(d,a,b,c,x[k+8], S32,0x8771F681); 
        c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122); 
        b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C); 
        a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44); 
        d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9); 
        c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60); 
        b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70); 
        a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6); 
        d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA); 
        c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085); 
        b=HH(b,c,d,a,x[k+6], S34,0x4881D05); 
        a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039); 
        d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5); 
        c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8); 
        b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665); 
        a=II(a,b,c,d,x[k+0], S41,0xF4292244); 
        d=II(d,a,b,c,x[k+7], S42,0x432AFF97); 
        c=II(c,d,a,b,x[k+14],S43,0xAB9423A7); 
        b=II(b,c,d,a,x[k+5], S44,0xFC93A039); 
        a=II(a,b,c,d,x[k+12],S41,0x655B59C3); 
        d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92); 
        c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D); 
        b=II(b,c,d,a,x[k+1], S44,0x85845DD1); 
        a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F); 
        d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0); 
        c=II(c,d,a,b,x[k+6], S43,0xA3014314); 
        b=II(b,c,d,a,x[k+13],S44,0x4E0811A1); 
        a=II(a,b,c,d,x[k+4], S41,0xF7537E82); 
        d=II(d,a,b,c,x[k+11],S42,0xBD3AF235); 
        c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB); 
        b=II(b,c,d,a,x[k+9], S44,0xEB86D391); 
        a=AddUnsigned(a,AA); b=AddUnsigned(b,BB); c=AddUnsigned(c,CC); d=AddUnsigned(d,DD); 
    }
    if(bit==32)
    {
        return WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
    }
    else
    {
        return WordToHex(b)+WordToHex(c);
    }
}

function loadCommentReply(responseElement){
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = responseElement, input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = responseElement,
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
}