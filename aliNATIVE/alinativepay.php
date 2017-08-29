<?php

require_once 'AlipayTradeService.php';
require_once 'AlipayTradePagePayContentBuilder.php';
class alinativepay{
	public function prepay($data){
		//商户订单号，商户网站订单系统中唯一订单号，必填
		$out_trade_no = trim($data['oid']);

		//订单名称，必填
		$subject = '蓝海工具商城';

		//付款金额，必填
		$total_amount = '0.01';

		//商品描述，可空
		$body = '蓝海工具商城';

		//构造参数
		$payRequestBuilder = new \AlipayTradePagePayContentBuilder();
		$payRequestBuilder->setBody($body);
		$payRequestBuilder->setSubject($subject);
		$payRequestBuilder->setTotalAmount($total_amount);
		$payRequestBuilder->setOutTradeNo($out_trade_no);
		$config = array (	
			//应用ID,您的APPID。
			'app_id' => "2**************",

			//商户私钥
			'merchant_private_key' => "",
			
			//异步通知地址
			'notify_url' => "https://mayunqq.com/paynotify/alinativepay",//完成后台 修改订单
			
			//同步跳转
			'return_url' => "https://mayunqq.com",//支付完成跳转地址

			//编码格式
			'charset' => "UTF-8",

			//签名方式
			'sign_type'=>"RSA2",

			//支付宝网关
			'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

			//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
			'alipay_public_key' => "",
		);
		$aop = new \AlipayTradeService($config);

		/**
		 * pagePay 电脑网站支付请求
		 * @param $builder 业务参数，使用buildmodel中的对象生成。
		 * @param $return_url 同步跳转地址，公网可以访问
		 * @param $notify_url 异步通知地址，公网可以访问
		 * @return $response 支付宝返回的信息
		*/
		$response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

		//输出表单
		return $response;
	}
}
    
?>