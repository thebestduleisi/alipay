<?php
namespace alipay;
define('AliPath',dirname(__FILE__).'/');
if(file_exists(AliPath.'aop/AopClient.php')){
	include AliPath.'aop/AopClient.php';
}
if(file_exists(AliPath.'aop/request/AlipayTradeAppPayRequest.php')){
	include AliPath.'aop/request/AlipayTradeAppPayRequest.php';
}
//用于阿里app支付
class aliapp{
	//
    public function init($data){
		$aop = new \AopClient;
		$aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
		$aop->appId = "*****";//appid
		$aop->rsaPrivateKey = '';//应用私钥
		$aop->format = "json";
		$aop->charset = "UTF-8";
		$aop->signType = "RSA2";
		$aop->alipayrsaPublicKey = '';//支付宝公钥

		//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
		$request = new \AlipayTradeAppPayRequest();

		//SDK已经封装掉了公共参数，这里只需要传入业务参数
		$bizcontent = "{\"body\":\"".$data['body']."\"," 
						. "\"subject\": \"".$data['title']."\"," 
						. "\"out_trade_no\": \"".$data['oid']."\"," 
						. "\"timeout_express\": \"30m\"," 
						. "\"total_amount\": \"".$data['total']."\"," 
						. "\"product_code\":\"QUICK_MSECURITY_PAY\"," 
						. "}";


		$request->setNotifyUrl("https://mayunqq.com/paynotify/alixpay");//异步通知地址
		$request->setBizContent($bizcontent);
		//这里和普通的接口调用不同，使用的是sdkExecute
		$response = $aop->sdkExecute($request);
		//htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
		//echo htmlspecialchars($response);//就是orderString 可以直接给客户端请求，无需再做处理。

		return str_replace("amp;","",htmlspecialchars($response));
    }
}