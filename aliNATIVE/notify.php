<?php

require_once 'AlipayTradeService.php';
class notify{
	public function checksign($data){
		$config = array (	
			//应用ID,您的APPID。
			'app_id' => "***********",

			//商户私钥
			'merchant_private_key' => "",
			
			//异步通知地址
			'notify_url' => "https://mayunqq.com/paynotify/alinativepay",//异步通知 后台操作订单
			
			//同步跳转
			'return_url' => "https://mayunqq.com",//支付完成跳转的页面

			//编码格式
			'charset' => "UTF-8",

			//签名方式
			'sign_type'=>"RSA2",

			//支付宝网关
			'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

			//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
			'alipay_public_key' => "",
		);
		$alipaySevice = new \AlipayTradeService($config); 
		$result = $alipaySevice->check($data);
		return $result;
	}
}
?>