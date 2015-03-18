<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="apple-mobile-web-app-title" content="丝芙兰力挺你家闺蜜！让你们都美美哒！">
    <title>姐最满意自己哪一部分？速速来答题，赢走我的真金犒赏。</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="<?=$this->config->base_url()?>public/css/reset.css">
    <link rel="stylesheet" href="<?=$this->config->base_url()?>public/css/common.css">
    <link rel="stylesheet" type="text/css" href="<?=$this->config->base_url()?>public/css/main.css">
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>



</head>
<body>
<div class="weixin_share_hidden">
    <img src="<?=$this->config->base_url()?>public/images/share_icon.jpg">
</div>
<div class="main">
    <div class="content" id="content" data-q="n" data-style="questioner" data-a="n" data-share="n">
        <!-- 秘已准备就绪，分享 -->
        <section class="screen" id="screen_4">
            <a href="#" class="btn_share btn_common" id="btn_s4_share">分享</a>
            <div class="libao s4_libao">
                <img src="<?=$this->config->base_url()?>public/images/gift.png">
            </div>
            <!-- 点击分享后，分享引导和提示 -->
            <div class="s4_share_guide dn">
                <div class="libao s4_libao">
                    <img src="<?=$this->config->base_url()?>public/images/gift.png">
                </div>
                <div class="btn_share btn_common" id="btn_s4_back">返回</div>
            </div>
            <!-- 分享失败或者取消提示 -->
            <div class="answer_error dn" id="answer_error">
                <div class="error_box">
                    <p>分享失败或被取消</p>
                    <div class="error_close btn_common">
                        重新分享
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>



<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/zepto.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/fastclick.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/zepto.cookie.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/common.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/main.js"></script>
<script type="text/javascript">
    $(function(){
        Sephora.init();
        // 微信配置
        wx.config({
            debug: true,
            appId: "wx949efd128cd9bf73",
            timestamp: '<?php echo $timestamp;?>',
            nonceStr: '<?php echo $nonceStr;?>',
            signature: '<?php echo $signature;?>',
            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 功能列表，我们要使用JS-SDK的什么功能
        });

        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
        wx.ready(function() {
            // 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
            wx.onMenuShareTimeline({
                title: '速速来答题，赢走我的真金犒赏。', // 分享标题
                link: '<?=$this->config->base_url()?>q/<?=$qid;?>', // 分享链接
                imgUrl: '<?=$this->config->base_url()?>public/images/icon.jpg', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    $("#answer_error").removeClass("dn");
                }
            });
            // 获取“分享给朋友”按钮点击状态及自定义分享内容接口
            wx.onMenuShareAppMessage({
                title: '速速来答题，赢走我的真金犒赏。', // 分享标题
                desc: '姐最满意自己哪一部分？速速来答题，赢走我的真金犒赏。', // 分享描述
                link: '<?=$this->config->base_url()?>q/<?=$qid;?>', // 分享链接
                imgUrl: '<?=$this->config->base_url()?>public/images/icon.jpg', // 分享图标
                type: 'link', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    $("#answer_error").removeClass("dn");
                }
            });
        });
    })
</script>
</body>

</html>