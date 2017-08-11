<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
/**
 * 图片模型
 * 负责图片的上传
 */
class FileModel extends Model{

    public function fileSave($map){
        $this->update_cache($map['cate_id']);
        return M('File')->add($map);
    }

    private function update_cache( $cate_id){
        if($cate_id == 1){
            $list = D('File')->where('status = 1')->field('id,cate_id,page,first_cover,heart,download')->select();
            S('Jianli_list' , $list);
        }else{
            $map['cate_id'] = $cate_id;
            $map['status']  = 1;
            $list = D('File')->where($map)->field('id,cate_id,page,first_cover,heart,download')->select();
            
            S('Jianli_'.$cate_id.'_list' , $list);


            $lists = D('File')->where('status = 1')->field('id,cate_id,page,first_cover,heart,download')->select();
            S('Jianli_list' , $lists);
        }
    }
}