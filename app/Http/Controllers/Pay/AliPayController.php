<?php

namespace App\Http\Controllers\Pay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AliPayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath = '';  //路径
    public $aliPubKey = '';  //路径
    public $privateKey = 'MIIEogIBAAKCAQEAtgX4h9oUVD3DPiMQCpGISXfxqtB0/P1q6fhiaTDmQubj28IPiX1bUbHgIGhGvey9lQNLlEV4Up2U9VZ3/Jg5i/uBsexRnmKuRU7jBKbQsIyCgQZgVzZpgUQqCdwZJQuRZ3OyfV73X9lApGRYIitCdOOU0ywnrMeQDFoKZcJMtb6h8Re0k6DHrBbbbvSvCFnls0jvyBTY+cGIuv/A+LpDJb1YpvmmZJUYX5o487dJpX+HT25oVafUnu+qv6+3JptSy8AJKwSwqE2rcEgwRhJikcsCe29EACqi4uk0+bR7hJQLaxnbHnhPGYuBA5SEbCJgXvJqvWIcHlTtNsDvy5owbQIDAQABAoIBAAW12j4o0UpzRZTFdNNgDW6AnMxHDeSB7sC4Uh4Ksq6Wn79dLy+ZByxg8C8UFmQO8UOjftN/+m5dEzc/JzR9chC6Ky9xwn29isoR131l3lYrkkyJ7qvNwTGU+dylUwSegElGj+ru98PCBQ0jOMCZqtQP77NQR05cVGCO0pSuq8lnzA46pnsal3y4exu4vDWLW9dc13TqX62hlQJoP0vSJIDrmcsQ7BIBoEEbbTAOxpJedImIoi5i+iZcohH8MLXNQcDV/CKOHwo5WnCcrBgTgV2pwyEOQ+d7cyUmU912jS9unvaUrU8ZA5XW0b04PyCqIQh5lhhJUerNVTghpJn64+ECgYEA4WG91V8QaOlUnRQIsIDh9U1Px5SNlSBI8QZLKrZFWnZdhv3j1+NN28urjxNgxbRIviHc2KXU29JFhI4aSh9jnJX3mnN1PVizOj39/LgEgwCC9RoEjpC97+GMKDNsMtduPvazdtmUfaOQXn5gWzCeIXKZ9J2dlPvJyTAAdXm6AasCgYEAzsBSUAuXBTJTsmBrgTvRapS0kpDvSNRVZmZauZzsZs88ngdgn1K/e/0Pv1tcqabgQrRlRRnD9qP5yLtDaMu0R+ElcqJcc0SY3YcR1VRUauCUp20yTx3S+KiGwpcqEiQ08Km8kZ6/n8xX01Mmq5v7kUaqUgfvFg+1+INoOx0lLkcCgYBLgNX6nB1AOCKbeLGsh5Cq/9phLvf7ZFRrQkN+LI+xTYPpjDZ/BWv43RM9HC3ILaxM3cVBYtSbS6b0UDKocDmLpIXNXS6CfauVMF1dAzynsk0s1Sl/pSesK/ArK4bsxVTujPD0ONHRATGFJmsbQX9IDz9aPk8jMPKZjpYoxL22fwKBgF/Akl6f/4FYnYqvPRrNKV/DHx4CIdAJBsQ2Ay6TjqjOsbQ+lnEzUZuKyBBHr9KihppeEci+9hL0PmrIz59pOEVR8JX2u/pmeqWeOJQkSjR1bmNcH0Ck/2BKLJ9SgxmDy0DqW3rVmsnXSZWFnRM9WnUd1SPIqOH+xLgjo9I83UthAoGAdddvGRYYSmdsmP0U5C37mmV46SYSlemb2qCWmh0T/wQrr54gCVfrNoChS3gXMPf3vSEhRtG6bpbntjUSz/8y95/qV/y0ysoLhp2KdA95xVE3/GIeNR3ldaAXPtM9hgixfseAgAMbdoaBRcz1O8hHIYdqvL9Jch67lyu8i+XANHs=';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtgX4h9oUVD3DPiMQCpGISXfxqtB0/P1q6fhiaTDmQubj28IPiX1bUbHgIGhGvey9lQNLlEV4Up2U9VZ3/Jg5i/uBsexRnmKuRU7jBKbQsIyCgQZgVzZpgUQqCdwZJQuRZ3OyfV73X9lApGRYIitCdOOU0ywnrMeQDFoKZcJMtb6h8Re0k6DHrBbbbvSvCFnls0jvyBTY+cGIuv/A+LpDJb1YpvmmZJUYX5o487dJpX+HT25oVafUnu+qv6+3JptSy8AJKwSwqE2rcEgwRhJikcsCe29EACqi4uk0+bR7hJQLaxnbHnhPGYuBA5SEbCJgXvJqvWIcHlTtNsDvy5owbQIDAQAB';
    public function __construct()
    {
        $this->app_id = '2016092900620874';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('APP_URL').'/notify_url';
        $this->return_url = env('APP_URL').'/return_url';
    }
    
    
    /**
     * 订单支付
     * @param $oid
     */
    public function pay(Request $request)
    {
        
        $total = $request->input('total');
        $oid = $request->input('oid');
    	// file_put_contents(storage_path('logs/alipay.log'),"\nqqqq\n",FILE_APPEND);
    	// die();
        //验证订单状态 是否已支付 是否是有效订单
        //$order_info = OrderModel::where(['oid'=>$oid])->first()->toArray();
        //判断订单是否已被支付
        // if($order_info['is_pay']==1){
        //     die("订单已支付，请勿重复支付");
        // }
        //判断订单是否已被删除
        // if($order_info['is_delete']==1){
        //     die("订单已被删除，无法支付");
        // }
        // $oid = time().mt_rand(1000,1111);  //订单编号
        //业务参数
        $bizcont = [
            'subject'           => 'Lening-Order: ' .$oid,
            'out_trade_no'      => $oid,
            'total_amount'      => $total,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;
        
        header("Location:".$url);
    }
    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
    	if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
    		$priKey=$this->privateKey;
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
    	}else{
    		$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
    	}
        
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝同步通知回调
     */
    public function aliReturn(Request $request)
    {
        // header('Refresh:2;url=/order/list');
        $res = $request->all();
        dd($res);
        echo "订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转';
//        echo '<pre>';print_r($_GET);echo '</pre>';die;
//        //验签 支付宝的公钥
//        if(!$this->verify($_GET)){
//            die('簽名失敗');
//        }
//
//        //验证交易状态
////        if($_GET['']){
////
////        }
////
//
//        //处理订单逻辑
//        $this->dealOrder($_GET);
    }
    /**
     * 支付宝异步通知
     */
    public function aliNotify()
    {
        $data = json_encode($_POST);
        $log_str = '>>>> '.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res === false){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }
        //验证订单交易状态
        if($_POST['trade_status']=='TRADE_SUCCESS'){
            //更新订单状态
            $oid = $_POST['out_trade_no'];     //商户订单号
            $info = [
                'is_pay'        => 1,       //支付状态  0未支付 1已支付
                'pay_amount'    => $_POST['total_amount'] * 100,    //支付金额
                'pay_time'      => strtotime($_POST['gmt_payment']), //支付时间
                'plat_oid'      => $_POST['trade_no'],      //支付宝订单号
                'plat'          => 1,      //平台编号 1支付宝 2微信 
            ];
            // OrderModel::where(['oid'=>$oid])->update($info);
        }
        //处理订单逻辑
        $this->dealOrder($_POST);
        echo 'success';
    }
    //验签
    function verify($params) {
        $sign = $params['sign'];

        if($this->checkEmpty($this->aliPubKey)){
            $pubKey= $this->publicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }else {
            //读取公钥文件
            $pubKey = file_get_contents($this->aliPubKey);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }
        
        
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        
        if(!$this->checkEmpty($this->aliPubKey)){
            openssl_free_key($res);
        }
        return $result;
    }
    /**
     * 处理订单逻辑 更新订单 支付状态 更新订单支付金额 支付时间
     * @param $data
     */
    public function dealOrder($data)
    {
        //加积分
        //减库存
    }
}
