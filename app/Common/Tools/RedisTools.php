<?php
/**
 * Created by PhpStorm.
 * User: jeffrey
 * Date: 2018/3/11
 * Time: 11:15
 */

namespace App\Common\Tools;

use Illuminate\Support\Facades\Redis;
class RedisTools
{

    public static function getRefreshTokenKey($did) {
        $prefix  = config('app.refresh_token_key_prefix','refresh_token_');
        return $prefix.$did;
    }

    public static function getWxRefreshTokenKey($did) {
        $prefix  = config('app.wx_refresh_token_key_prefix','wx_refresh_token_');
        return $prefix.$did;
    }
    public static function setex($key,$ttl_minutes,$value) {
        return Redis::setex($key,$ttl_minutes*60,$value);
    }

    public static function get($key) {
        return Redis::get($key);
    }

    public static function setRefreshToken($did,$ttl_minutes,$value) {
        return static::setex(static::getRefreshTokenKey($did),$ttl_minutes,$value);
    }

    public static function getRefreshToken($did) {
        return Redis::get(static::getRefreshTokenKey($did));
    }

    public static function setWxRefreshToken($did,$ttl_minutes,$value) {
        return static::setex(static::getWxRefreshTokenKey($did),$ttl_minutes,$value);
    }

    public static function getWxRefreshToken($did) {
        return Redis::get(static::getWxRefreshTokenKey($did));
    }

}