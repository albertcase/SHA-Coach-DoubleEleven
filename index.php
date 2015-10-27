<?php
session_start();
if (!isset($_SESSION['openid'])) {
	Header("Location:http://oauth.curio.im/v1/wx/web/auth/c267f514-04c8-416c-a692-14497ee002bb");
	exit;
}
//判断是否关注
$info = file_get_contents("http://api.curio.im/v2/wx/users/".$_SESSION['openid']."?access_token=08ecb2077e158fd621a1f175e22442e8");
$info = json_decode($info, true);

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>COACH双十一献礼</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="format-detection" content="telephone=no">
	<!--禁用手机号码链接(for iPhone)-->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui" />
	<!--自适应设备宽度-->
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--控制全屏时顶部状态栏的外，默认白色-->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="Keywords" content="">
	<meta name="Description" content="...">

	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery_pxloader_tween.js"></script>
	<script type="text/javascript" src="http://wechatjs.curio.im/api/v1/js/fc123d81-e5c7-4404-98bb-93936d8469fc/wechat.js"></script>
</head>
<body>

<article id="dreambox">
<div class="loading">
	<img src="imgs/loading.png" width="100%" class="car">

	<div class="spinner">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
	</div>
	<p>目前涌入的小伙伴过多<br>页面正在跳转中，请耐心等待。</p>
</div>

<div id="wechat">
	<img sourcesrc="imgs/share_tips.png" src="" width="50%" />
</div>

	<section class="con">
		<a href="javascript:;" class="logo">
			<img sourcesrc="imgs/logo.png" src="" width="100%" />
		</a>

		<section class="content">
			<section class="ticket">
				<img sourcesrc="imgs/coupon-bg.png" src="" width="100%" />
				<div class="coupon">
					<div class="fresh_tips"><button id="freshBtn">刷新</button><label>已刮开 <span id="drawPercent">0%</span> 区域。</label></div>
					<div id="lotteryContainer"></div>
					<img sourcesrc="imgs/coupon-1.png" src="" width="100%" class="opacity" />
				</div>

				<div class="coupon" id="sharebeceive">
					<img sourcesrc="imgs/coupon-3.png" src="" width="100%" />
				</div>
			</section>

			<footer class="footer">
				<a href="javascript:;" class="beceive_btn btnleft disabled">
					<img sourcesrc="imgs/btn-1.png" src="" width="100%" />
				</a>
				<a href="javascript:;" class="share_btn btnright disabled">
					<img sourcesrc="imgs/btn-2.png" src="" width="100%" />
				</a>
			</footer>
		</section>

		<section class="content" id="qrcode">
			<img sourcesrc="imgs/qrcode.png" src="" />
		</section>
		
	</section>
	
</article>

<img sourcesrc="imgs/bg.jpg" class="bg" src="" />
<script type="text/javascript" src="js/loading.js"></script>
<script type="text/javascript" src="js/lottery.js"></script>

<!-- 横屏代码 -->
<div id="orientLayer" class="mod-orient-layer">
    <div class="mod-orient-layer__content">
        <i class="icon mod-orient-layer__icon-orient"></i>
        <div class="mod-orient-layer__desc">为了更好的体验，请使用竖屏浏览</div>
    </div>
</div>

<script type="text/javascript">
	$(".share_btn").click(function(){
		if($(this).hasClass("disabled"))return false;
		$("#wechat").show();
	})
	var subscribe = "<?php echo $info['data']['subscribe']?>";
	$(".beceive_btn").click(function(){
		if($(this).hasClass("disabled"))return false;

		if(subscribe == 1){
			var i = Math.floor(Math.random()*3)+1;
			addCard(i);
		}else{
			$(".content").hide();
			$("#qrcode").show();
		}
	})

	$("#wechat").click(function(){
		$("#wechat").hide();
	})



	loading(LoadingImg);


</script>
<?php
$access_token = '08ecb2077e158fd621a1f175e22442e8';
$api_url = 'http://api.curio.im/v2/wx/card/js/add/json?access_token='. $access_token;
// 参数数组
$data[] = array(
        'card_id' => 'pKCDxjnxlQzpd2YQLHNDfWuXC1w8',
		'code' => '',
		'openid' => ''
);
$data[] = array(
        'card_id' => 'pKCDxjsEKY-TWadO9JmZ2UDas6uo',
		'code' => '',
		'openid' => ''
);
$data[] = array(
        'card_id' => 'pKCDxjgwbyOA66F2FPTI2BWY83BQ',
		'code' => '',
		'openid' => ''
);
 
$ch = curl_init ();
// print_r($ch);
curl_setopt ( $ch, CURLOPT_URL, $api_url );
curl_setopt ( $ch, CURLOPT_POST, 1 );
curl_setopt ( $ch, CURLOPT_HEADER, 0 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($data) );
$return = curl_exec ( $ch );
curl_close ( $ch );
$return = json_decode($return,true);
$cardList = $return['data']['cardList'];
?>
<script>
var cardListJSON = <?php echo json_encode($cardList)?>;
function addCard(i) {
    wx.addCard({
        cardList: [{
        	cardId: cardListJSON[i-1].cardId,
            cardExt: '{"timestamp":"'+cardListJSON[i-1].cardExt.timestamp+'","signature":"'+cardListJSON[i-1].cardExt.signature+'"}'
        }],
        success: function(res) {
            var cardList = res.cardList;
            alert(JSON.stringfiy(res));
        },
        fail: function(res) {
            alert(JSON.stringfiy(res));
        },
        complete: function(res) {
            alert(JSON.stringfiy(res));
        },
        cancel: function(res) {
            alert(JSON.stringfiy(res));
        },
        trigger: function(res) {
            alert(JSON.stringfiy(res));
        }
	}); 

};
</script>
</body>
</html>
