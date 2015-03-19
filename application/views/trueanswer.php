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



</head>
<body>
<div class="weixin_share_hidden">
    <img src="<?=$this->config->base_url()?>public/images/share_icon.jpg">
</div>
<div class="main">
    <div class="content" id="content" data-q="n" data-style="questioner" data-a="n" data-share="n">
        <!-- 抽优惠券 显示结果 -->
        <section class="screen" id="screen_5">
            <div class="s5_box">
                <img class="block" src="<?=$this->config->base_url()?>public/images/block.png">
                <div class="s5_gift_cost" id="s5_gift_cost"><span class="coupon_cost"><?=$ctype;?></span>元现金券</div>
                <div class="s5_txt" id="s5_txt">答对了！算你懂我<br>送你丝芙兰<span class="coupon_cost"><?=$ctype;?></span>元现金券，<br>让我们一起美下去!<br>优惠券代码：<span class="coupon_code"><?=$code;?></span></div>
            </div>
            <a class="btn_s5_home btn_common" id="btn_s5_home" href="http://www.sephora.cn/">去官网使用</a>
            <div class="btn_s5_ques btn_common" id="btn_s5_ques" onclick="location.href='<?=$this->config->base_url()?>question';">我也要出题</div>
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
        //var aaa = window.location.hash;
        //alert(aaa)
    })
</script>
</body>

</html>