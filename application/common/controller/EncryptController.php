<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/20
 * Time: 下午4:24
 */
namespace app\common\controller;

class EncryptController extends AsController
{
    //RSA私钥加密
    public function rsaPrivateKeyEncrypt($data){
        $encrypted = '';
        openssl_private_encrypt($data,$encrypted,$this->pi_key);//私钥加密
        $encrypted = base64_encode($encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
        return $encrypted;
    }
    //RSA私钥解密
    public function rsaPrivateKeyDecrypt($encrypted){
        openssl_private_decrypt(base64_decode($encrypted),$decrypted,$this->pi_key);//私钥解密
        return $decrypted;
    }
    //RSA公钥加密
    public function rsaPublicKeyEncrypt($data){
        $encrypted = '';
        openssl_public_encrypt($data,$encrypted,$this->pu_key);//公钥加密
        $encrypted = base64_encode($encrypted);
        return $encrypted;
    }
    //RSA公钥解密
    public function rsaPublicKeyDecrypt($encrypted){
        openssl_public_decrypt(base64_decode($encrypted),$decrypted,$this->pu_key);//私钥加密的内容通过公钥可用解密出来
        return $decrypted;
    }
    public function passwordEncrypt($password,$salt){
        return sha1(md5($password.'ThinkAS').md5($salt));
    }
}