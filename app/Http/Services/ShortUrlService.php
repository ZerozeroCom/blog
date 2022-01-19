<?php
namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

use Throwable;

class ShortUrlService{

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    public function makeShortUrl($url){

        try{
            $accesstoken = env('URL_ACCESS_TOKEN');
            $data = [
                'url' => $url
            ];
            Log::channel('url_shorten')->info('postData',['data' => $data]);
            $response = $this->client->request(
                'POST',
                "https://api.pics.ee/v1/links/?access_token=$accesstoken",
                [
                    'headers' =>['Content-Type' => 'application/json'],
                    'body' => json_encode($data)
                ]
            );
            $contents = $response->getBody()->getContents();
            Log::channel('url_shorten')->info('responseData',['data' => $contents]);
            $contents = json_decode($contents);
        } catch(Throwable $th){
            report($th);
            return $url;
        }

        return $contents->data->picseeUrl;
    }

}
