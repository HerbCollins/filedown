$('#datepicker').dcalendarpicker({
	format:'yyyy-mm-dd'
});

function edit(k){
	obj = $(k);
	var ops = obj.parent();
	var ppNode = obj.parent().parent('.edit-zone');
	var c_v    = ppNode.children('.current-value');
	var ipt    = ppNode.find('.get_new');
	var options = '<a href="javascript:void(0);" onclick="save(this)"><i class="fa fa-fw fa-save"></i></a><a href="javascript:void(0);" onclick="cancle(this)"><i class="fa fa-fw fa-times-circle"></i></a>';
	ops.html(options);
	c_v.hide();
	ipt.show();
}

function save(k){
	obj = $(k);
	var ops = obj.parent();
	var ppNode = obj.parent().parent('.edit-zone');
	var c_v    = ppNode.children('.current-value');
	var ipt    = ppNode.find('.get_new');
	var datas  = ipt.val();
	if(datas == c_v.text()){
		cancle(k);
		return false;
	}
	if(datas.length == 0){
		cancle(k);
		return false;
	}
	var _url = ipt.data('save');
	data = {
		'value':datas
	}
	$.ajax({
		url:_url,
		type:"post",
		dataType:"json",
		data:data,
		success:function(rst){
			message(rst.message , rst.status);
			if(rst.status == 1){
				c_v.text(datas);
				cancle(k);
			}
		},
		error:function(e){
			message("error" , 0);
		}
	})
}

function cancle(k){
	obj = $(k);
	var ops = obj.parent();
	var ppNode = obj.parent().parent('.edit-zone');
	var c_v    = ppNode.children('.current-value');
	var ipt    = ppNode.find('.get_new');
	var options = '<a href="javascript:void(0);" onclick="edit(this)"><i class="fa fa-fw fa-edit"></i></a>';
	ops.html(options);

	c_v.show();
	ipt.hide();
}

function edit_avatar(){
	var avatars = $('.avatar_select_zone');
	avatars.show();
	avatars.find('img').on('click',function(){
		var src = $(this).attr('src');
		$('#current_avatar_img').attr('src',src);
		avatars.hide();
		var _url = $(this).data('save');
		var data = $(this).data('avatar');
		$.ajax({
			data:{'avatar':data},
			url:_url,
			dataType:"json",
			type:"post",
			success:function(data){
				message(data.message , data.status);
			},
			error:function(e){
				message(e.responseText)
			}
		})
	});
}

$("#changepwd").submit(function(){
	var method 		= $(this).attr('method');
	var datas  		= $(this).serialize();
	var _url   		= $(this).attr('action');
	var org_pwd		= $("#org_pwd").val();
	var new_pwd		= $("#newpwd").val();
	var check_pwd 	= $("#checkpwd").val();
	if(org_pwd.length == 0 || new_pwd.length == 0 || check_pwd.length == 0){
		message('密码不能为空！',0);
		return false;
	}
	if(org_pwd == new_pwd){
		message('原密码与新密码一致！',0);
		return false;
	}

	if(new_pwd !== check_pwd){
		message('新密码与确认密码不一致，请修改检查！',0);
		return false;
	}

	if(new_pwd.length < 6){
		message('新密码长度太短，至少要6位',0);
		return false;
	}

	$.ajax({
		data:datas,
		url:_url,
		type:method,
		dataType:"json",
		beforeSend:function(){
			$(this).find("button").attr('disabled',true).html('<i class="fa fa-fw fa-circle-o-notch fa-spin"></i> 正在更新密码');
		},
		success:function(data){
			message(data.message , data.status);
			$(this).find("button").attr('disabled',false).html('更改');
			if(data.status){
				setTimeout(function(){
					window.location.href = data.path;
				},2000);
			}
		},
		error:function(){
			message('出错了，未修改成功，请稍后重试！',0);
		}
	})
	return false;
})