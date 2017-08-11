<?php
include 'user.php';
function is_login(){
    $uid = session('user_id');
    if(is_numeric($uid)){
        return true;
    }else{
        return false;
    }
}

function get_uid(){
    return session('user_id');
}

function is_vip(){
    return session('is_vip');
}

//七牛上传函数
/*
 * $size 上传文件大小
 * $bucket 空间名称
 * $domin 空间默认域名
 */
function QiniuUploadFile(){
    $config= C ( 'UPLOAD_SITEIMG_QINIU_PRIVATE' );
    $Upload = new \Think\Upload($config);
    $info = $Upload->upload($_FILES);
    if($info){
        return $info;
    }
    else{
        return $Upload->getError();
    }
}

function QiniuUploadCover(){
    $config= C ( 'UPLOAD_SITEIMG_QINIU_PUBLIC' );
    $Upload = new \Think\Upload($config);
    $info = $Upload->upload($_FILES);
    if($info){
        return $info;
    }
    else{
        return $Upload->getError();
    }
}

//删除七牛上的文件
/*
 * $file 删除的文件
 * $bucket 空间名称
 * $domin 空间默认域名
 */
function QiniuDel($file){
    $config= C ( 'UPLOAD_SITEIMG_QINIU' );
    $Upload = new \Think\Upload\Driver\Qiniu\QiniuStorage($config['driverConfig']);
    $info = $Upload->del($file);
    if(is_array($info)){
       return true;
   }
    else{
        return false;
    }
}

function Qiniu_Encode($str) // URLSafeBase64Encode
{
    $find = array('+', '/');
    $replace = array('-', '_');
    return str_replace($find, $replace, base64_encode($str));
}
function Qiniu_Sign($url) { //$info里面的url
    $setting = C ( 'UPLOAD_SITEIMG_QINIU_PRIVATE' );
    $duetime = NOW_TIME + 3600;//下载凭证有效时间
    $DownloadUrl = $url . '?e=' . $duetime;
    $Sign = hash_hmac ( 'sha1', $DownloadUrl, $setting ["driverConfig"] ["secretKey"], true );
    $EncodedSign = Qiniu_Encode ( $Sign );
    $Token = $setting ["driverConfig"] ["accessKey"] . ':' . $EncodedSign;
    $RealDownloadUrl = $DownloadUrl . '&token=' . $Token;
    return $RealDownloadUrl;
}

function encode($value){

    $crypt_key = C('CRYPT_KEY')?C('CRYPT_KEY'):'maker';

    $crypt = new \Org\Util\Crypt($crypt_key);
    return $crypt->encode($value);

}

function decode($value){

    $crypt_key = C('CRYPT_KEY')?C('CRYPT_KEY'):'maker';
    
    $crypt = new \Org\Util\Crypt($crypt_key);
    return $crypt->decode($value);
}

function getImgPath($id){
    if(!$id)
        return false;
    return D('Common/Covers')->getImgPath($id);
}

/**
 *  $id  文件编号
 *
 */
function getFirstImg($id){
    $id = decode($id);
    if(!$id || !is_numeric($id)){
        return false;
    }
    return D('Common/Covers')->getFirstImgPath($id);
}

function getImages($ids){
    if(!$ids)
        return false;
    $paths = D('Common/Covers')->getImages($ids);
    $imgs = "";
    foreach ($paths as $path) {
        $imgs .= '<img src="' . $path['savepath'] . '?  
imageView2/0/q/100|watermark/1/image/aHR0cDovL29wZW4ud2F3bWFtLmNvbS93YXdtYW0ucG5n/dissolve/48/gravity/SouthEast/dx/10/dy/10|imageslim" />';
    }
    return $imgs;
}

function b2k($size){
    return sprintf('%.1f' , $size/1024)."Kb";
}

function b2m($size){
    return sprintf('%.1f',$size/1024/1024)."M";
}

function getRecommend(){
    return D('Common/File')->recommend();
}


/**
 * 系统邮件发送函数
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 */
function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
    $config = C('MAKER_EMAIL');
    vendor("PHPMailer.PHPMailer");
    $mail = new \PHPMailer();
    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();  // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = 'ssl';                 // 使用安全协议
    $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
    $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
    $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
    $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
    $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
    $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject    = $subject;
    $mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if(is_array($attachment)){ // 添加附件
        foreach ($attachment as $file){
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return  $mail->Send() ? true : $mail->ErrorInfo;
}

/**
 *  非法字符串过滤
 */
function fliter($str){
    if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$str)){
        return false;
    }else{
        return $str;
    }
}

/**
 * 验证邮箱格式
 */
function is_email($email){
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if ( preg_match( $pattern, $email) ){
        return true;
    }else{
        return false;
    }
}

function is_exist_email($email){
    return D('Common/Ucenter')->is_exist_email($email);
}

function is_uid($uid){
    return D('Common/Ucenter')->is_uid($uid);
}

function is_checked_uid($uid){
    return D('Common/Ucenter')->is_checked_uid($uid);
}

function scoreAdd($uid , $score){
    return D('Common/Ucenter')->scoreAdd($uid , $score);
}

function today_left_second(){
    return strtotime(date("Y-m-d",strtotime("+1 day"))) - time();
}
?>