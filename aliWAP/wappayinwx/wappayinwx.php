<?php

/* *
 * 功能：支付宝手机网站支付接口(alipay.trade.wap.pay)接口调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
 */
header("Content-type: text/html; charset=utf-8");
require_once 'AopClient.php';
require_once 'AlipayTradeWapPayRequest.php';
class wappayinwx{
	public function prepay($data){
		$aop = new \AopClient ();
		$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
		$aop->appId = '**********************';
		$aop->rsaPrivateKey = '';//应用私钥
		$aop->alipayrsaPublicKey='';//对应的支付宝的应用公钥
		$aop->apiVersion = '1.0';
		$aop->postCharset='UTF-8';
		$aop->format='json';
		$aop->signType='RSA2';
		$request = new \AlipayTradeWapPayRequest ();
		$request->setBizContent("{" .
		"    \"body\":\"test\"," .
		"    \"subject\":\"test\"," .
		"    \"out_trade_no\":\"".$data['oid']."\"," .
		"    \"timeout_express\":\"90m\"," .
		"    \"total_amount\":0.01," .
		"    \"product_code\":\"QUICK_WAP_WAY\"" .
		"  }");
		$request->setNotifyUrl("https://api.lanhaitools.com/paynotify/alixpay");
		$request->setReturnUrl("https://api.lanhaitools.com/wap");
		$result = $aop->pageExecute ( $request); 
		return $result;
	}
}

?>
