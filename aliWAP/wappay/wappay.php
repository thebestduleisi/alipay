<?php
namespace aliwap\wappay;
/* *
 * 功能：支付宝手机网站支付接口(alipay.trade.wap.pay)接口调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
 */

header("Content-type: text/html; charset=utf-8");

require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'service/AlipayTradeService.php';

require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'buildermodel/AlipayTradeWapPayContentBuilder.php';
//require dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'./../config.php';

class wappay{
	public function prepay($data){
		//商户订单号，商户网站订单系统中唯一订单号，必填
		$out_trade_no = $data['oid'];

		//订单名称，必填
		$subject = '蓝海工具商城';

		//付款金额，必填
		$total_amount = '0.01';

		//商品描述，可空
		$body = '蓝海工具商城';

		//超时时间
		$timeout_express="1m";
		$config = array (	
			//应用ID,您的APPID。
			'app_id' => "*************",

			//商户私钥，您的原始格式RSA私钥
			'merchant_private_key' => "",
			
			//异步通知地址
			'notify_url' => "https://mayunqq.com/paynotify/alixpay",
			
			//同步跳转
			'return_url' => "https://mayunqq.com/wap",

			//编码格式
			'charset' => "UTF-8",

			//签名方式
			'sign_type'=>"RSA2",

			//支付宝网关
			'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

			//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
			'alipay_public_key' => ""
		);
		$payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
		$payRequestBuilder->setBody($body);
		$payRequestBuilder->setSubject($subject);
		$payRequestBuilder->setOutTradeNo($out_trade_no);
		$payRequestBuilder->setTotalAmount($total_amount);
		$payRequestBuilder->setTimeExpress($timeout_express);
		$payResponse = new \AlipayTradeService($config);
		$result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
		Flight::log($result);
		return $result;
	}
}

?>
