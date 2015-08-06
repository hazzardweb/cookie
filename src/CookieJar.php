<?php

namespace Hazzard\Cookie;

class CookieJar implements CookieJarInterface
{
    /**
     * The default path (if specified).
     *
     * @var string
     */
    protected $path = '/';

    /**
     * The default domain (if specified).
     *
     * @var string
     */
    protected $domain = null;

    /**
     * Encrypter instance.
     *
     * @var \Hazzard\Encryption\Encrypter
     */
    protected $encrypter;

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
    public function set($name, $value, $minutes = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        list($path, $domain) = $this->getPathAndDomain($path, $domain);

        $time = ($minutes == 0) ? 0 : time() + ($minutes * 60);

        if (isset($this->encrypter)) {
            $value = $this->encrypter->encrypt($value);
        }

        return setcookie($name, $value, $time, $path, $domain, $secure, $httpOnly);
    }

    /**
     * Retrieve a cookie.
     *
     * @param   string $name
     * @param   mixed  $default
     * @return  mixed
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $_COOKIE)) {
            $value = $_COOKIE[$key];

            if (isset($this->encrypter)) {
                $value = $this->encrypter->decrypt($value);
            }

            return $value;
        }

        return $default;
    }

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
    public function forever($name, $value, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        return $this->set($name, $value, 2628000, $path, $domain, $secure, $httpOnly);
    }

    /**
     * Expire a cookie.
     *
     * @param  string $name
     * @param  string $path
     * @param  string $domain
     * @return bool
     */
    public function forget($name, $path = null, $domain = null)
    {
        return $this->set($name, null, -2628000, $path, $domain);
    }

    /**
     * Get the path and domain, or the default values.
     *
     * @param  string $path
     * @param  string $domain
     * @return array
     */
    protected function getPathAndDomain($path, $domain)
    {
        return array($path ?: $this->path, $domain ?: $this->domain);
    }

    /**
     * Set the default path and domain for the jar.
     *
     * @param  string $path
     * @param  string $domain
     * @return $this
     */
    public function setDefaultPathAndDomain($path, $domain)
    {
        list($this->path, $this->domain) = array($path, $domain);

        return $this;
    }

    /**
     * Set encrypter.
     *
     * @param  \Hazzard\Encryption\Encrypter $encrypter
     * @return $this
     */
    public function setEncrypter($encrypter)
    {
        $this->encrypter = $encrypter;

        return $this;
    }
}
