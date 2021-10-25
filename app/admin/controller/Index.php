<?php
namespace app\admin\controller;

use app\admin\validate\LoginValidate;
use app\common\controller\Backend;
use think\exception\ValidateException;
use think\facade\Env;
use think\facade\Validate;
use think\facade\View;
use think\Hook;

class Index extends Backend
{

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name. '--'. app('http')->getName();
    }

    /**
     * 后台主页
     */
    public function index(){

        //左侧菜单
        $fixedmenu = $referermenu = [];
        $menulist = $navlist = '';
            /*list($menulist, $navlist, $fixedmenu, $referermenu) = $this->auth->getSidebar([
                'dashboard' => 'hot',
                'addon'     => ['new', 'red', 'badge'],
                'auth/rule' => __('Menu'),
                'general'   => ['new', 'purple'],
            ], $this->view->site['fixedpage']);*/

        $action = $this->request->request('action');
        if ($this->request->isPost()) {
            if ($action == 'refreshmenu') {
                $this->success('', null, ['menulist' => $menulist, 'navlist' => $navlist]);
            }
        }
        View::assign('menulist', $menulist);
        View::assign('navlist', $navlist);
        View::assign('fixedmenu', $fixedmenu);
        View::assign('referermenu', $referermenu);
        View::assign('title', __('Home'));

        $config = [
            'site' => [
                'name' => '后台',
                'cdnurl' => Env::get('admin.static_path', '/static'),
                'version'=> time()
            ],
            'language' => 'zh-cn',
        ];
        $admin = [
            'username' => 'admin',
            'nickname' => 'nickname',
            'avatar' => config('admin.default_avatar'),
            'login_time' => 1635153075,
        ];

        View::assign('config',$config);
        View::assign('admin',$admin);

        return view();
    }

    /**
     * 管理员登陆
     * @return \think\response\View
     */
    public function login(){

        $url = $this->request->get('url', 'index/index');
        /*if ($this->auth->isLogin()) {
            $this->success(__("你已经登陆，不需要再次登陆"), $url);
        }*/


        if ($this->request->isPost()) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            $keeplogin = $this->request->post('keeplogin');
            $token = $this->request->post('__token__');

            $data = [
                'username' => $username,
                'password' => $password,
                '__token__' => $token,
            ];
            if (config('admin.login_captcha')) {
                $rule['captcha'] = 'require|captcha';
                $data['captcha'] = $this->request->post('captcha');
            }

            try {
                validate(LoginValidate::class)->check($data);
            }catch (ValidateException $e){
                $this->error($e->getError(),url(),['token'=>$this->request->buildToken()]);
            }

            $this->success(__('Login successful'), $url, ['url' => $url, 'id' => 1, 'username' => $username, 'avatar' => 1]);


        }



        $modulename = app('http')->getName();
        $controllername = $this->request->controller();
        $actionname = $this->request->action();

        $config = [
            'site' => [
                'cdnurl' => Env::get('admin.static_path', '/static'),
                'version'=> time()
            ],
            'modulename'     => $modulename,
            'controllername' => $controllername,
            'actionname'     => $actionname,
            'moduleurl'      => rtrim(url("/{$modulename}", [], false), '/'),
            'language' => 'zh-cn',
        ];

        View::assign('config',$config);

        $background = config('admin.login_background');
        View::assign('background',$background);

        return view();

    }


    /**
     * 退出登录
     */
    public function logout()
    {
        if ($this->request->isPost()) {
            $this->auth->logout();
            $this->success(__('Logout successful'), 'index/login');
        }
        $html = "<form id='logout_submit' name='logout_submit' action='' method='post'>" . token() . "<input type='submit' value='ok' style='display:none;'></form>";
        $html .= "<script>document.forms['logout_submit'].submit();</script>";

        return $html;
    }
}
