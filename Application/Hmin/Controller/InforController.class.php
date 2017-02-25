<?php
namespace Hmin\Controller;
use Hmin\Model\LogsModel;
class InforController extends SmileController {
    /**
     * 1. 签到获取积分
     * 2. 积分可九宫格抽奖
     * 3. 完善个人基本信息（忘记密码后，方便找回）
     */
    //===1=================================================================
    public function sign(){
        //昨天结束 -- 今天开始
        $startday = date('Y-m-d 23:59:59', time() - 24 * 60 * 60);
        $start_time = strtotime($startday) + 1; //2016-11-30 00:00:00
        //今天结束 -- 明天开始
        $nightime = date('Y-m-d 23:59:59',time());
        $night_time = strtotime($nightime); //2016-11-30 23:59:59
        //现在时间 -- 签到时间
        $nowtime = date('Y-m-d H:i:s', time());
        $now_time=strtotime($nowtime);

        $where = "sign_uid=".$this->Uid." AND sign_mon =".(int)date('Ym',time());
        $sels  = M('users_sign')->where($where)->find();
        $data['sign_uid'] = $this->Uid;
        $data['sign_mon'] = (int)date('Ym',time()); //201701
        $data['sign_day'] = (int)date('d',time());  //19
        $sign_get_score = 2;                        //签到获得积分
        $sign_con_num   = 7;                        //连续签到7天   可领额外积分
        $sign_con_score = 5;                        //连续签到{$sign_num}天    可获得该积分

        if((int)($sels['sign_num']+1)>=$sign_con_num){
            $rs['signScore'] = $data['sign_score'] = (int)($sels['sign_score'] + $sign_con_score);
        }else{
            $rs['signScore'] = $data['sign_score'] = (int)($sels['sign_score'] + $sign_get_score);
        }
        $_SESSION['SML_USER']['score'] = $rs['signScore'];
        if((int)$sels['sign_day']==($data['sign_day']-1)){
            $rs['signNum'] = $data['sign_num'] = (int)$sels['sign_num']+1;
        }else{
            $rs['signNum'] = $data['sign_num'] = 1;
        }
        $data['sign_date']      = date('Y-m-d H:i:s',time());
        if(empty($sels)){
            $data['sign_days']  = $sels['sign_days'].','.$data['sign_day'];
            M('users_sign')->add($data);
            $rs['signRs'] = 1;
            echo json_encode($rs);
        }else{
            if($data['sign_day']==(int)$sels['sign_day']){
                $rs['signScore'] = $sels['sign_score'];
                $rs['signRs'] = -1;
                echo json_encode($rs);
            }else{
                $data['sign_days'] = $sels['sign_days'].','.$data['sign_day'];
                unset($data['sign_date']);
                M('users_sign')->where($where)->save($data);
                $rs['signRs'] = 1;
                echo json_encode($rs);
            }
        }
    }
    
    //===3=================================================================
    public function toFontIcon(){
//        var_dump(session('SML_USER'));
//        die();
        $this->display('icon');
    }
    public function toFontFa(){
        $this->display('fa');
    }
    //个人信息
    public function inforMsg(){
        $this->display('inforMsg');
    }
    public function message(){
        //$data['content'] = "查看了个人设置";
        //$da = D('Logs')->autoLogTreeTime($data);
        $this->Tree = M('log_treetime')->where("uid=".(int)$this->Uid)->find();
        $this->display();
    }
    public function messagedo(){
        if(IS_POST){
            $res = M('users')->where("id=".(int)$this->Uid)->save(I('post.'));
            if($res){
                $result = M('users')->where("id=".(int)$this->Uid)->find();
                session('SML_USER',$result);
                $this->success('信息提交成功！');
            }else{
                $this->error('信息提交失败！');
            }
        }
    }
    //个人设置
    public function perfect(){
        $this->display();
    }
    
    //个人设置 - 修改密码
    public function upwd(){
        if(IS_POST){
            $data = SMLMd5(I('post.password'));
            $where ="id=".(int)$this->Uid;
            if(M("users")->where($where)->save($data)){
                $this->ajaxReturn(1);
            }else{$this->ajaxReturn(2);}
        }
    }
    //个人设置 - 头像上传
    public function upimg(){
        if(IS_POST){
            $Img = $_POST['data'];
            $id = (int)$this->Uid; //谁上传的
//            ==============================================
            if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $Img, $result)){
                $type = $result[2];//获取后缀名
                //对图片进行操作 主要的图片文件类型：jpg/png/gif/bmp/jepg
                if(!in_array($type, array('jpg', 'gif', 'png','bmp', 'jpeg'))){
                    $this->ajaxReturn(3);//类型错误
                }else{
                    //判断文件的大小
                    //if($Img["size"]>3000){ echo 4;//大小错误 exit; //终止后边的程序执行 }
                    
                    $date = date('Y-m-d',time());   //日期目录
                    $rootpath = "./Uploads/assets/{$date}";
                    if(!is_dir($rootpath)){
                        mkdir($rootpath);
                    }
                    //修改图片的名称 以时间戳命名 百万分之一
                    $imgname  = $date."/".$id."-".time().rand(10000, 99999).".".$type;
                    $savepath = "./Uploads/assets/".$imgname;

                    if(file_put_contents($savepath, base64_decode(str_replace($result[1], '',$Img )))){
                        $res = M('users')->where("id=".$id)->setField('pic',$imgname);
                        if($res>0){
                            session('SML_USER')['pic'] = $imgname;
                            $this->ajaxReturn(1);
                        }else{
                            $this->ajaxReturn(2);//上传失败
                        }
                    }else{
                        $this->ajaxReturn(5);//文件写入失败
                    }
                }
            }
        }
    }

}