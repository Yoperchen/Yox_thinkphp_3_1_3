<?php
/**
 * 管理员登录
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class LoginAction extends Action {
    public function index(){
		$this->display();
    }
    //登录
    public function login(){
        $id=$this->_param('id','htmlspecialchars,strip_tags');
        $password=$this->_param('password','htmlspecialchars,strip_tags');
    
        if(!empty($id)&&!empty($password)){
            $Admin_model=D('Admin');
            $result= $Admin_model->login($id , $password);
            if($result['status']==1){
                $this->success('登录成功', U('/Index/index@admin'));
            }else{
                $this->error($result['message']);
            }
        }else{
            $this->display();
        }
    }
    /**
     * 注册
     */
    public function register()
    {
        die();
        $email = $this->_param('email','htmlspecialchars,strip_tags');
        $name = $this->_param('name','htmlspecialchars,strip_tags');
        $mobile = $this->_param('mobile','htmlspecialchars,strip_tags');
        $password = $this->_param('password','htmlspecialchars,strip_tags');
        $signup_confirm_password = $this->_param('signup_confirm_password','htmlspecialchars,strip_tags');
        if($password!=$signup_confirm_password)$this->error('密码前后不一致',U('Yo81009/Admin/site_register'));
        if(!empty($password)){
            $data=array();
            //    		$data['site_name']=;
            $data['email']=$email;
            $data['name']=$name;
            $data['mobile']=$mobile;
            $data['password']=$password;
            $result = D('User')->register($data);
            if($result['status']==1){
                $this->success($result['message'],U('Yo81008/Index/index'));
            }else{
                $this->error($result['message'],U('Yo81008/Index/index'));
            }
    
        }
        $this->display();
    }
}