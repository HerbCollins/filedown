<?php
namespace Admin\Controller;

class FileController extends BaseController{
	public function index(){
	}

	public function upload(){
		$this->display();
	}

	public function statistics(){
		$word = D('File')->where('cate_id = 2')->count();
		$this->assign('wordcount' , $word);

		$psd  = D('File')->where('cate_id = 3')->count();
		$this->assign('psdcount' , $psd);

		$excel= D('File')->where('cate_id = 4')->count();
		$this->assign('excelcount' , $excel);

		$ppt  = D('File')->where('cate_id = 5')->count();
		$this->assign('pptcount' , $ppt);


		$this->display();
	}

	public function get_heart_line(){
		if(IS_AJAX){
			$word_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%d') as day , COUNT(*) as value FROM `wm_heart`,`wm_file` WHERE `wm_heart`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 2 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`updated_at`) AND `wm_heart`.`status` = 1 GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%Y-%m-%d')";
			$rst['word'] = D()->query($word_sql);

			$psd_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%d') as day , COUNT(*) as value FROM `wm_heart`,`wm_file` WHERE `wm_heart`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 3 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`updated_at`) AND `wm_heart`.`status` = 1 GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%Y-%m-%d')";
			$rst['psd'] = D()->query($psd_sql);

			$excel_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%d') as day , COUNT(*) as value FROM `wm_heart`,`wm_file` WHERE `wm_heart`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 4 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`updated_at`) AND `wm_heart`.`status` = 1 GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%Y-%m-%d')";
			$rst['excel'] = D()->query($excel_sql);


			$ppt_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%d') as day , COUNT(*) as value FROM `wm_heart`,`wm_file` WHERE `wm_heart`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 5 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`updated_at`) AND `wm_heart`.`status` = 1 GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_heart`.`updated_at`),'%Y-%m-%d')";
			$rst['ppt'] = D()->query($ppt_sql);
			$rst['status'] = 1;
			$this->ajaxReturn($rst);
		}else{
			$this->error();
		}
	}

	public function get_download_line(){
		if(IS_AJAX){
			$word_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%d') as day , COUNT(*) as value FROM `wm_download`,`wm_file` WHERE `wm_download`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 2 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`download_at`) GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%Y-%m-%d')";
			$rst['word'] = D()->query($word_sql);

			$psd_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%d') as day , COUNT(*) as value FROM `wm_download`,`wm_file` WHERE `wm_download`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 3 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`download_at`) GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%Y-%m-%d')";
			$rst['psd'] = D()->query($psd_sql);

			$excel_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%d') as day , COUNT(*) as value FROM `wm_download`,`wm_file` WHERE `wm_download`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 4 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`download_at`) GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%Y-%m-%d')";
			$rst['excel'] = D()->query($excel_sql);


			$ppt_sql =  "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%d') as day , COUNT(*) as value FROM `wm_download`,`wm_file` WHERE `wm_download`.`fid` = `wm_file`.`id` AND `wm_file`.`cate_id` = 5 AND date_sub(curdate(), INTERVAL 7 DAY) <= date(`download_at`) GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(`wm_download`.`download_at`),'%Y-%m-%d')";
			$rst['ppt'] = D()->query($ppt_sql);
			$rst['status'] = 1;
			$this->ajaxReturn($rst);
		}else{
			$this->error();
		}
	}

	public function add(){
		$this->display();
	}

	public function edit(){

	}

	public function delete(){

	}

	public function config(){
		$M 		= M('File');
		$count  = $M->where('status = 1')->count();

		$page   = new \Think\Page($count , 15);
		$show   = $page->show();

		$list   = $M->where('status = 1')->order('id DESC')->limit($page->firstRow.','.$page->listRows)->select();

		$this->assign('lists' , $list);
		$this->upload_all();
		$this->assign('page' , $show);
		$this->display();
	}

	function get_allfiles($path,&$files) {  
	    if(is_dir($path)){  
	        $dp = dir($path);  
	        while ($file = $dp ->read()){  
	            if($file !="." && $file !=".."){  
	                $this->get_allfiles($path."/".$file, $files);  
	            }  
	        }  
	        $dp ->close();  
	    }  
	    if(is_file($path)){  
	        $files[] =  $path;  
	    }  
	}  
	     
	function get_filenamesbydir($dir){  
	    $files =  array();  
	    $this->get_allfiles($dir,$files);  
	    return $files;  
	} 

	public function upload_all(){

		$dir= "G:\\BaiduYunDownload\\jianli_img";
		$dir_file= "G:\\BaiduYunDownload\\jianli_doc";

		$filenames = $this->get_filenamesbydir($dir);  

		$filedocs = $this->get_filenamesbydir($dir_file);  

		for ($i=0; $i < count($filedocs); $i++) { 
			$file[$i]['cover'] = iconv('gbk' , 'utf-8' ,$filenames[$i]);
			$file[$i]['doc'] = iconv('gbk' , 'utf-8' , $filedocs[$i]);
		}

		$this->assign('files',$file);
	}

	public function uploadFile()
    {
    	if(IS_AJAX){
    		$cover = I('post.cover');
    		$first_cover = I('post.first_cover');
    		$cate_id	= I('post.cate_id');
    		$page 		= I('post.page');

	    	if(empty($cover) || empty($_FILES)){
	    		$this->ajaxReturn(array('status' => 0 , 'message' => '文件没有上传！'));
	    	}
			$file  = QiniuUploadFile();
			$info = $file['file'];
	        if($info){
	        	$save['first_cover'] = $first_cover;
	        	$save['cover']    = $cover;
	        	$save['cate_id']  = $cate_id;
	        	$save['page']	  = $page;
	        	$save['filename'] = $info['savename'];
	        	$save['savename'] = $info['name'];
	        	$save['type']	  = $info['type'];
	        	$save['size']	  = $info['size'];
	        	$save['md5']	  = $info['md5'];
	        	$save['sha1']	  = $info['sha1'];
	        	$save['ext']	  = $info['ext'];
	        	$save['savepath'] = $info['url'];
	        	$save['heart'] 	  = 0;
	        	$save['download'] = 0;
	        	$save['status']	  = 1;
	        	$D = D('File');
	        	$rst = $D->fileSave($save);
	        	if($rst){
	        		$this->ajaxReturn(array('status' => 1 , 'message' => '上传成功'));
	        	}else{
	        		$this->ajaxReturn(array('status' => 0 , 'message' => '上传失败'));
	        	}
	        } else {
	        	$this->ajaxReturn(array('status' => 0 , 'message' => '云存储失败'));
	        } 
    	}else{
    		$this->error();
    	}
    }

    public function uploadCover(){
    	if(IS_AJAX){
    		$cover = $_FILES;
    		if(empty($cover)){
    			$this->ajaxReturn(array('status' => 0 , 'message' => '没有封面文件'));
    		}

    		$cover = QiniuUploadCover();
    		$info = $cover['cover'];
    		if($info){

	        	$save['filename'] = $info['savename'];
	        	$save['savename'] = $info['name'];
	        	$save['type']	  = $info['type'];
	        	$save['size']	  = $info['size'];
	        	$save['md5']	  = $info['md5'];
	        	$save['sha1']	  = $info['sha1'];
	        	$save['ext']	  = $info['ext'];
	        	$save['savepath'] = $info['url'];
	        	$save['heart'] 	  = 0;
	        	$save['download'] = 0;
	        	$save['status']	  = 1;
	        	$D = D('Covers');
	        	$rst = $D->coverSave($save);
    			$this->ajaxReturn(array('status' => 1, 'message' => '上传成功' , 'id' => $rst , 'path' => $save['savepath']));
    		}else{
    			$this->ajaxReturn(array('status' => 0, 'message' => '上传失败'));
    		}
    	}else{
    		$this->error();
    	}
    }
}
?>