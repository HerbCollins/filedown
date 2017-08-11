
	function message(message,status){
		if(status == 0){
			msg = '<span class="fa fa-fw fa-3x fa-times-circle msg-error"></span><p class="msg-error">'+message+'</p>';
		}else if(status == 1){
			msg = '<span class="fa fa-fw fa-3x fa-check-circle msg-success"></span><p class="msg-success">'+message+'</p>';
		}else if(status == 2){
			msg = '<span class="fa fa-fw fa-3x fa-warning msg-warning"></span><p class="msg-warning">'+message+'</p>';
		}else{
			msg = '<span class="fa fa-fw fa-3x fa-info"></span><p>'+message+'</p>';
		}
		
		var notification = new NotificationFx({
			message : msg,
			layout : 'bar',
			effect : 'slidetop',
			type : 'notice', // notice, warning or error
			onClose : function() {
				// bttn.disabled = false;
			}
		});

		// show the notification
		notification.show();

	}