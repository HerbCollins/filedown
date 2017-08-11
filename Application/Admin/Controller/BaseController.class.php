<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        // if(!is_login() || 1 != get_uid()){
        // 	$this->redirect('Ucenter/Member/login');
        // }
    }
}