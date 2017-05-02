<?php
namespace App\Wechat;
use Zend\Diactoros\Response\JsonResponse;
use \EasyWeChat\Foundation\Application;
/**
 * Created by PhpStorm.
 * User: fanyk
 * Date: 2017/5/2
 * Time: 15:02
 */

class MenuController{


    public function index()
    {
        $menus=app('db')->select('wechatmenu',['menuname','url']);

        $wechat = new Application($this->getOptions());
        $menu=$wechat->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);




        return view('wechatmenu',['menus'=>$menus]);
    }
    protected function getOptions()
    {
        return [
            'debug'  => true,

            'app_id'  => getenv('WECHAT_APPID'),         // AppID
            'secret'  => getenv('WECHAT_SECRET'),//'',     // AppSecret
            'token'   => 'icpcar',          // Token
            'aes_key' => '',
            'guzzle' => [
                'timeout' => 5.0, //
                'verify' => false,
            ],
        ];
    }
}