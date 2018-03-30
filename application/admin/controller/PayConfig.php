<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 17:16
 */

namespace app\admin\controller;


use app\common\model\WxMchConfig;

class PayConfig extends Base
{
    public function index(){
        $wxconfig=new WxMchConfig();;
        $wxres=$wxconfig->findBaseInfo('secret_key,sub_mch_id,is_specially,cacert_path',['token'=>$this->token]);
        $this->assign('wxconfig',$wxres);
        return $this->fetch();
    }
}