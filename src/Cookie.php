<?php

namespace Hazzard\Cookie;

class Cookie
{
    /**
     * The cookie jar instance.
     *
     * @var \Hazzard\Cookie\CookieJar
     */
    protected static $cookieJar;

    /**
     * Get the cookie jar instance.
     *
     * @return \Hazzard\Cookie\CookieJar
     */
    public static function getCookieJar()
    {
        if (!isset(static::$cookieJar)) {
            static::$cookieJar = new CookieJar;
        }
    }

    /**
     * Call static cookie jar methods dynamically.
     *
     * @param  string $method
     * @param  array  $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        $mailer = static::getCookieJar();

        return call_user_func_array([$mailer, $method], $arguments);
    }
}
