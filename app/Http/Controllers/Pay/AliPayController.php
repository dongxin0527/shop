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
    public $privateKey = 'MIIEpQIBAAKCAQEA337bJ8iDOz1ioEEaNnZFsji2dS4Yo9jmd82VPop/15HxzxvT6Un9PuU103EVnOcDMw78ocEya1TxHeoaaXcA9+feZx1KY2iVyxN2nZORGDtiahYKOriFK5LwLI+/8QRow1hNxDxa9RxWJniGawbZPyaFibH1X6LxoW20Bl/wMHgJK++O+3JmFvdvdPPASyDnAqcu5NOuptQautblFTp1+TfmrihirhZ87jxKMCdzpsxXeoYEPRYQxvHG4uyJZTkt9+xk5mRW/TgRLZyH/gJOtBbVK/RLgtrgSDC50wrEbsa+WQTi7uhlJIIk4BIfVT4lvxfhlwZKRlj2O9TjJtTspQIDAQABAoIBAC11TfovjJG2EKNr2nsNX2u6oVIASD67VVU02ZBY91vPcZGgpV+kDwCF+obBT5YUXtA50iTMeQbfxhNBlJGzBN1nqhLrIEBL+3vMv6mZZD+7hG7zgK0k7uFIB9Xofy/0p6JkCZ1KcW29j8BPb3fBctqnaS3ypmgHaoJdH+rUBLS2tDCDiEo4GDLXoilxBrxYyuipre8i5nHtQV25P0uWig8BLGeVy8l6AjxNldiLsED9/KeTtJCC6g8nj8WK8vnZW6qfSeeTkTD//gGy4lOcc/dVDPetsMXr+Z/kEwXOdOew+SIWQDBgKTmraFFdFArT2cyOC37tu77A2R5lCD0BWNkCgYEA+f+F/v7rGU9VN46FmVV53ioi5F3rc2iivr3ypSV+92BNLJUQovf/cudSvEoiXYqeKe1F8o1G7U216zSRB+M+kjygSxWAwo0tMj2e7pSBxWTowOS+5VelFpwEQ53ugQsb/2idjIu8UdwKkSGn0UYOw5MDfz89w5HO0Fi06Z5m3KsCgYEA5Nxy60CfEUPuLFtJsrSsKEZ43zu5OeH6I9BwngYg3T9ScbhCIHDNkS81GmX4oFVKdEWvr0b1/4VXEp+/eeMmGOit19mePFqCpqxfY76QfAYRJqmQHSjaTgjcoQlVXVnzoaaNx7jbdhNpSfuJWe4AUdce3nbLbrCcR6AY5SzUu+8CgYEAi84z9zhD7XGKLHmNiQReFLnnrWJAi9fWO2kqSuS/LkQypF3wYdLijjWC9T1YHouoi7XfShdrtMWimJhbCtgwY8N3uMWbrjEZN2FygeWW9PbLmyPRBZyP/Cbf05h8irnVvG2avcBfXj/5wNPbb5MIKqMKb5zEQ5xE1grlkUg+KeUCgYEAtzZn5T8RWHAKToYyJJcQrxljkEouiVEHv/4Q+eCsFJKpvJImlfPYDV8+Ysi5VhmRhi13bJkhPBKR1z39umUGzbAP45m6XFSU/TtHDgGzhyYQOuRJk55tzUS4404mgZoOOR2tqPKq9gaqJmjw1wZ6SQovEycEyrMmGQzogSb3kw8CgYEAwEHiETolhBOjjvyhLvZpcAkpzgWAe1PIc82Pb8Slp37P7LVRMmyACL9NayZKQxLWb11cYHhpzx3gGh99iMaVrrzMu/CwrpL88imRhOCmKsvtwwv+7RXQaSXlsUNr2gGUO/Kdq0MVmYxl3oZ4xH6lNNJBj5c+6/hsK1ywFZTvOwA=';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyOsizgmZekCHdV3P571m+0MBkQyGmcpuj5oUYzZG7svbCWvop045id+O+yj8d+tajj9b53pwHh1QS75E8DJUeYDdQ2l/X1dQZ7p3ZNDgRoJMMiKGUPRXRdg9Lh505cN+DDOEDOnYWLBsHGBvGAeDBkJw8CsoNGvjDvPwA/8uDueWxeRGkYFMV7AQyF7+i91n8mcqzXteyz5gdG+Q62W4Ui25vbgjexgX+Ugv5G2ghelJAQB5UTtX5OqC1xFWWms4opw04h6eUC6ZVickOI4CkDxHj1xa3sav1R0e/HeMjTK+nPRCgbJngspR6Cbiqgne47Jvfm/2bF34DZdjsrAuKQIDAQAB';
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
        file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res === false){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        }
        //验证订单交易状态
        // if($_POST['trade_status']=='TRADE_SUCCESS'){
        //     //更新订单状态
        //     $oid = $_POST['out_trade_no'];     //商户订单号
        //     $info = [
        //         'is_pay'        => 1,       //支付状态  0未支付 1已支付
        //         'pay_amount'    => $_POST['total_amount'] * 100,    //支付金额
        //         'pay_time'      => strtotime($_POST['gmt_payment']), //支付时间
        //         'plat_oid'      => $_POST['trade_no'],      //支付宝订单号
        //         'plat'          => 1,      //平台编号 1支付宝 2微信 
        //     ];
        //     // OrderModel::where(['oid'=>$oid])->update($info);
        // }
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
