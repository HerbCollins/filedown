<?php
function is_full_download($uid){
	if($downloaded = cookie('download_num_today_'.$uid)){
		if($downloaded < C('DOWNLOAD_NUM_ALLOW')){

			$downloaded++;
			// 剩余时间
			cookie('download_num_today_'.$uid,$downloaded , today_left_second());
			return false;
		}else{
			return ture;
		}
	}else{
		cookie('download_num_today_'.$uid, 1 , today_left_second());
		return false;
	}
}

function sum_arraykey($array , $key = ''){
	if(!is_array($array)){
		return false;
	}
	if(empty($key)){
		return false;
	}
	$sum = 0;
	foreach($array as $v){
		$sum += $v[$key];
	}

	return $sum;

}
?>