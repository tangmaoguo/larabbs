<?php
namespace App\Handlers;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
class SlugTranslateHandler{
    public function translate($text){
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $from = 'zh';
        $to = 'en';
        $appid =config('services.baidu_translate.APP_ID');
        $secKey =config('services.baidu_translate.SEC_KEY');
        $salt = rand(10000,99999);

        $sign = self::buildSign($text, $appid, $salt, $secKey); //签名
        //生成一个url-encode的请求字符串
        $query = http_build_query([
                'q' =>$text,
                'from'=>$from,
                'to'=>$to,
                'salt'=>$salt,
                'sign'=>$sign,
                'appid'=>$appid
            ]
        );


        //发起http请求
        $client = new Client;
        $response = $client->request('get',$api.$query);
        $result = json_decode($response->getBody(), true);

        if(isset($result['trans_result'][0]['dst'])){
            return Str::slug($result['trans_result'][0]['dst']);
        }
    }

    private function buildSign($query, $appID, $salt, $secKey){
        $str = $appID . $query . $salt . $secKey;
        $ret = md5($str);
        return $ret;
    }
}
