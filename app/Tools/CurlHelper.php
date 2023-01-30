<?php 
namespace App\Tools;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Storage;

class CurlHelper{

    public function __construct($url, $data){
        $this->url = $url;
        $this->data = $data;
    }

    public function postJWT(){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        $auth = "Authorization: Bearer " . $this->makeJWT();
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, [$auth]);
        return curl_exec($this->ch);
    }
    public function post(){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        return curl_exec($this->ch);
    }
    public function postJson(){ //modulo de procesamiento
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, ["content-type: application/json", "accept: application/json"]);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 300);
        set_time_limit(180);
        return curl_exec($this->ch);
    }
    public function noWaitPost(){ // modulo de registro de eventos
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 1);
        return curl_exec($this->ch);
    }
    private function getParams(){
        $params = "";
        foreach($this->data as $key => $element){
            $params.=$key."=".urlencode($element)."&";
        }
        return substr($params, 0, strlen($params) -1);
    }
    public function get(){
        $params = "?" . $this->getParams();
        $url = $this->url . $params;
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        return curl_exec($this->ch);
    }

    /* BEARER_TOKEN */
    public function success(){
        return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }
    public function makeJWT(){
        //$key_path = "C:/xampp/htdocs/ece-saas/storage/app/certs/certificados.key";
        $key_path = env('KEY_CERT');;
        $myfile = fopen($key_path, "r");
        $privateKey = fread($myfile,filesize($key_path));
        fclose($myfile);
        //$cert_path = "C:/xampp/htdocs/ece-saas/storage/app/certs/certificados.crt";
        $cert_path = env('PUB_CERT');
        $myfile = fopen($cert_path, "r");
        $publicKey = fread($myfile,filesize($cert_path));
        fclose($myfile);

        /* ===== Making Header ===== */
        $header = [
            "cert"=>$publicKey
        ];

        /* ===== Making payload ===== */
        $payload = [
            'data' => "test",//$request->input("data"),
            'iat' => time(),
            'exp' => time()+3600,
        ];
        //dd($payload);
        /* ===== Making JWT ===== */
        return JWT::encode($payload, $privateKey, 'RS512', null, $header);
    }
}