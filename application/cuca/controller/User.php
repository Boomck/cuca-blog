<?php
namespace app\cuca\controller;
use think\Controller;
use think\Db;
use app\cuca\model\User as UserModel;
use app\cuca\validate\User as UserValidate;
use app\cuca\model\Essay as EssayModel;
use app\cuca\model\Comment as CommentModel;
use think\Image;
use think\Session;
use think\Validate;

class User extends Controller
{
    public function index()
    {
        $result = EssayModel::all();
        $name = Session::get('username');
        if ($name)
        {
            $this->assign("username",$name);
        }
        else
        {
            $this->assign("username",null);
        }
        foreach ($result as $val)
        {
            $val['imagepath'] = explode('&',$val['imagepath']);
        }
        $this->assign('essay',$result);
        return $this->fetch('blog');
    }

    public function login(){
        return $this->fetch('Login');
    }

    public function register(){
        return $this->fetch('register');
    }

    public function personal(){
        $name = Session::get('username');
        if ($name)
        {
            $this->assign("username",$name);
        }
        else
        {
            $this->assign("username",null);
        }
        $comment = CommentModel::all(['username'=>$name]);
        $this->assign("comment",$comment);
        return $this->fetch('personal');
    }

    //注册
    public function insert(){
        $data = input('post.');
        $val = new UserValidate();
        if (!$val->check($data))
        {
            $this->error($val->getError());
            exit;
        }
        $user1 = new UserModel();
        $result = $user1->where('username',$data['username'])->find();
        if (!$result)
        {
            $data['password'] = md5($data['password']);
            $user = new UserModel($data);
            $ret = $user->allowField(true)->save();
            if ($ret){
                $this->success('注册成功','User/index');
            }
            else
            {
                $this->error("注册失败");
            }
        }
        else
        {
            $this->error("用户名已存在");
        }

    }

    //二维码
    public function show_captcha(){
        $captcha = new \think\captcha\Captcha();
        $captcha->imageW = 137;
        $captcha->imageH = 59;
        $captcha->fontSize = 20;
        $captcha->length = 4;
        $captcha->useNoise = true;
        return $captcha->entry();
    }

    //登陆
    public function check()
    {
        $data = input("post.");
        if (captcha_check($data['captcha']))
        {
            $user = new UserModel();
            $result = $user->where('username',$data["username"])->find();
            if ($result)
            {
                if ($result['password'] == md5($data['password']))
                {
                    session('username',$data['username']);
                    $this->success("登陆成功",'User/index');
                }
                else
                {
                    dump($result['password']);
                    echo '<br>';
                    dump(md5($data['password']));
                    $this->error("密码错误");
                }
            }
            else
            {
                $this->error("用户不存在");
                exit;
            }
        }
        else
        {
            $this->error("验证码错误");
        }

    }

    //退出
    public function destroy(){
        session('username',null);
        $this->assign("username",null);
        return $this->index();
    }

    //插入文章
    public function insertessay(){
        $data = input('post.');
        //检验数据
        $rule = [
          'content' => 'max:200'
        ];
        $msg = [
          'content.max' => '文章长度不得超过200字'
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($data))
        {
            $this->error($validate->getError());
            exit;
        }
        $files = request()->file('imagepath');
//        //检测文件路径是否存在，不存在则创建并给予777权限
//        if(!file_exists(ROOT_PATH.'public'.DS.'uploads')){
//            mkdir(ROOT_PATH.'public'.DS.'uploads',0777,true);
//            echo  "wenjian chuangjian chenggong";
//        }
        foreach ($files as $file)
        {
//            $image = Image::open($file);
//            if ($image->width()>1000)
//            {
//                $info = $image->thumb(640,360)->save(ROOT_PATH.'public'.DS.'uploads');
//                dump($info);
//            }
//            else
//            {
//                $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
//            }
            $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
            if ($info)
            {
                //输出jpg
//                echo $info->getExtension();
                //输出文件名
//                echo $info->getFilename();
                //输出保存路径
//                echo $info->getSaveName();
                $data['imagepath'] = $data['imagepath'].'/tp5/public/uploads/'.$info->getSaveName()."&";
            }
            else
            {
                echo $file->getError();
            }
        }
        //修改图片路径
        $data['imagepath'] = substr($data['imagepath'],0,strlen($data['imagepath'])-1);
        $data['imagepath'] = str_replace('\\','/',$data['imagepath']);
        //数据存储数据库
        $essay = new EssayModel($data);
        $ret = $essay->allowField(true)->save();
        if ($ret)
        {
            $this->success("分享成功","User/index");
        }
        else
        {
            $this->error("分享失败");
        }
    }

    //查看单个分享
    public function loadsingle($id){
        $name = Session::get('username');
        if ($name)
        {
            $this->assign("username",$name);
        }
        else
        {
            $this->assign("username",null);
        }
        //获取文章
        $essay = EssayModel::get($id);
        $essay['imagepath'] = explode('&',$essay['imagepath']);
        $this->assign("essay",$essay);
        //获取评论
        $comment = CommentModel::all(['essayid'=>$id]);
//        $comment->where('essayid',$id)->select();
        $this->assign("comment",$comment);
        return $this->fetch("single");
    }

    //加点赞
    public function addlikecount($id){
        $essay = EssayModel::get($id);
        $essay->likecount++;
        $essay->save();
        return $essay->likecount;
    }

    //添加评论
    public function insertcomment(){
        $data = input("post.");
        $rule = [
            'content' => 'max:100'
        ];
        $msg = [
            'content.max' => '评论长度不得超过100字'
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($data))
        {
            $this->error($validate->getError());
            exit;
        }
//        dump($data);
        $comment = new CommentModel($data);
        $ret = $comment->allowField(true)->save();
        if ($ret)
        {
            $this->success("评论成功");
        }
        else
        {
            $this->error("评论失败");
        }
    }

    //API
    //key请去聚合数据获取
    public function API(){
        $data = input('get.');
        $state = $data['state'];
        $city = $data['city'];
        $date = $data['date'];
        $url = "http://v.juhe.cn/historyWeather/province";
        $url .= "?"."key=";//获取省份id

        $cu = curl_init();
        curl_setopt($cu,CURLOPT_URL,"$url");
        curl_setopt($cu,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($cu,CURLOPT_HEADER,0);

        $out = curl_exec($cu);
        curl_close($cu);

        $out = json_decode($out);
        $out = $out->result;
        $out = (array)$out;

        foreach($out as $ss)
        {
            if($state == $ss->province)
            {
                $state = $ss->id;
            }
        }

        $url = "http://v.juhe.cn/historyWeather/citys";
        $url .= "?"."province_id=33&key=";//获取城市id  这里的33就是省份id

        $cu = curl_init();
        curl_setopt($cu,CURLOPT_URL,"$url");
        curl_setopt($cu,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($cu,CURLOPT_HEADER,0);

        $out = curl_exec($cu);
        curl_close($cu);

        $out = json_decode($out);
        $out = $out->result;
        $out = (array)$out;

        foreach($out as $ss)
        {
            if($city == $ss->city_name)
            {
                $city = $ss->id;
            }
        }

        $url1 = "http://v.juhe.cn/historyWeather/weather";
        $url1.= "?"."city_id=".$city."&weather_date=".$date."&key=22bbb489d09c94402fb9f613b128f687";//使用城市id和日期进行查询

        $cu = curl_init();
        curl_setopt($cu,CURLOPT_URL,"$url1");
        curl_setopt($cu,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($cu,CURLOPT_HEADER,0);

        $out = curl_exec($cu);
        curl_close($cu);
        return $out;
    }

    //搜索
    public function search(){
        $data = input('get.');
        //获取文章
        $essay = EssayModel::all();
        foreach ($essay as $value)
        {
            $value['content'] = str_replace($data['search'],"<text class=\"s\">".$data['search']."</text>",$value['content']);
            $value['imagepath'] = explode('&',$value['imagepath']);
        }
        $this->assign('essay',$essay);
        $name = Session::get('username');
        if ($name)
        {
            $this->assign("username",$name);
        }
        else
        {
            $this->assign("username",null);
        }
        return $this->fetch('blog');
    }
}