<?php

namespace Hazzard\Cookie;

interface CookieJarInterface
{
    /**
     * Set a cookie.
     *
     * @param  string $name
     * @param  string $value
     * @param  int    $minutes
     * @param  string $path
     * @param  string $domain
     * @param  bool   $secure
     * @param  bool   $httpOnly
     * @return bool
     */
    public function set($name, $value, $minutes = 0, $path = null, $domain = null, $secure = false, $httpOnly = true);

    /**
     * Retrieve a cookie.
     *
     * @param   string $name
     * @param   mixed  $default
     * @return  mixed
     */
    public function get($key, $default = null);

    /**
     * Set a cookie that lasts "forever" (five years).
     *
     * @param  string $name
     * @param  string $value
     * @param  string $path
     * @param  string $domain
     * @param  bool   $secure
     * @param  bool   $httpOnly
     * @return bool
     */
    public function forever($name, $value, $path = null, $domain = null, $secure = false, $httpOnly = true);

    /**
     * Expire a cookie.
     *
     * @param  string $name
     * @param  string $path
     * @param  string $domain
     * @return bool
     */
    public function forget($name, $path = null, $domain = null);
}
