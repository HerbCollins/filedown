<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>午马网注册邮箱确认函</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- w3cplus.com Baidu tongji analytics -->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?177319b798978621f83845b12c86fa29";
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hm, s);
	})();
</script>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td bgcolor="#009688"  style="text-align:center;padding:20px;">
							<img src="http://open.wawmam.com/wm.png" style="width:40px">
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 18px;">
										<span>尊敬的<?php if(isset($username)) echo $username; {?></span>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										欢迎您注册 <a href="https://www.wawmam.com" style="color:#153643;" target="_blank">知图网</a>，在这里有数千款简历、PPT模板、PSD文件、Keynote模板等资源供您下载使用，现在您需要点击下方的按钮或者链接验证您的邮箱（如果不是您本人操作，请忽略此邮件）。
									</td>
								</tr>
								<tr>
									<td><a href="<?php echo $url; ?>" style="display:inline-block;padding:10px 28px; background-color: #009688;color:#ffffff;text-decoration: none;">点击验证</a></td>

								</tr>
								<tr><td><a href="<?php echo $url; ?>" style="display:inline-block;padding:10px 0px;color:#009688;text-decoration: none;"><?php echo $url; ?></a></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#009688" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&reg; 知图网 <?php echo date()?><br/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>


</body>
</html>