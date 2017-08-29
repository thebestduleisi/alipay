<?php
	define('AliPath',dirname(__FILE__).'/');
	require AliPath."aop/AopClient.php";
	class notifyapp{
		public function checksign($data){
			$aop = new \AopClient;
			$aop->alipayrsaPublicKey = '';//支付宝公钥
			$flag = $aop->rsaCheckV1($data, NULL, "RSA2");
			return $flag;
		}
	}
		
?>