<?php
return array(
	//'配置项'=>'配置值'

	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'jianli', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'wm_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
	'PICTURE_UPLOAD_DRIVER'=>'Qiniu', 
	'UPLOAD_LOCAL_CONFIG'=>array(),

	'UPLOAD_SITEIMG_QINIU_PRIVATE' => array ( 
        'maxSize' => 10 * 1024 * 1024,//文件大小
        'rootPath' => './',
        'saveName' => array ('uniqid', ''),
        'driver' => 'Qiniu',
        'driverConfig' => array (
            'secretKey' => 'owci_k7IXF3wqigsE0R4Pd3dJiI-mzhbe-2eudd8', 
            'accessKey' => 'QtJB6Q6oEYvvf7t01ldKceZxQebG-V7Zjr6KGQbb',
            'domain' => 'loop.wawmam.com',
            'bucket' => 'loop'
        )
    ),

    'UPLOAD_SITEIMG_QINIU_PUBLIC' => array ( 
        'maxSize' => 10 * 1024 * 1024,//文件大小
        'rootPath' => './',
        'saveName' => array ('uniqid', ''),
        'driver' => 'Qiniu',
        'driverConfig' => array (
            'secretKey' => 'owci_k7IXF3wqigsE0R4Pd3dJiI-mzhbe-2eudd8', 
            'accessKey' => 'QtJB6Q6oEYvvf7t01ldKceZxQebG-V7Zjr6KGQbb',
            'domain' => 'open.wawmam.com',
            'bucket' => 'open'
        )
    ),

	'DOWNLOAD_NUM_ALLOW' => 2,

	// 加密解密 密钥
	'CRYPT_KEY' => 'maker',

	/**
	 *  Email config
	 */
	'MAKER_EMAIL' => array(
        'SMTP_HOST'   => 'smtp.163.com', //SMTP服务器
        'SMTP_PORT'   => '465', //SMTP服务器端口
        'SMTP_USER'   => 'maker68@163.com', //SMTP服务器用户名
        'SMTP_PASS'   => '369ZhanG66', //SMTP服务器密码
        'FROM_EMAIL'  => 'maker68@163.com', //发件人EMAIL
        'FROM_NAME'   => '知图网', //发件人名称
        'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
        'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
	),

	// 积分
	'SCORE' =>	array(
		'LOGIN' => 5,
		'REGISTER' => 10,
		'PROFILE'  => 10
		),

);