<?php

namespace TickTackk\ImageProxyHost\XF\Str;

class Formatter extends XFCP_Formatter
{
    /**
     * @param string $type Type of the URL that is being passed. XenForo supports image or link
     * @param string $url The URL that is being proxified.
     *
     * @return string
     */
    public function getProxiedUrlIfActive($type, $url)
    {
        $proxiedUrl = parent::getProxiedUrlIfActive($type, $url);

        if (\XF::$versionId < 2010010) // XF 2.0 support
        {
            $proxiedUrl = $this->applyTckImageProxyHost($type, $url, $proxiedUrl);
        }

        return $proxiedUrl;
    }

    /**
     * @param string $type Type of the URL that is being passed. XenForo supports image or link
     * @param string $url The URL that is being proxified.
     * @param array $options Additional options
     *
     * @return string|null Returns null if invalid/disabled proxy type is provided
     */
    public function getProxiedUrlIfActiveExtended($type, $url, array $options = [])
    {
        $proxiedUrl = parent::getProxiedUrlIfActiveExtended($type, $url, $options);

        if ($proxiedUrl !== null)
        {
            $proxiedUrl = $this->applyTckImageProxyHost($type, $url, $proxiedUrl);
        }

        return $proxiedUrl;
    }

    /**
     * @param string $type Type of the URL that is being passed. XenForo supports image or link
     * @param string $originalUrl The URL that is being proxified.
     * @param string $proxiedUrl The URL that has been proxified
     *
     * @return string The final url
     */
    protected function applyTckImageProxyHost($type, $originalUrl, $proxiedUrl)
    {
        $linkClassTarget = $this->getLinkClassTarget($originalUrl);

        if ($type !== 'image' || $linkClassTarget['type'] !== 'external')
        {
            return $proxiedUrl;
        }

        $options = \XF::app()->options();
        $proxyHost = $options->bfp_proxyhost;
        $ignoreSSLImages = \boolval($options->bfp_ignoressl);

        if ($ignoreSSLImages && \strtolower(\parse_url($originalUrl, \PHP_URL_SCHEME)) === 'https')
        {
            return $originalUrl;
        }

        if (empty($proxyHost))
        {
            return $proxiedUrl;
        }

        $proxyHost = \rtrim($proxyHost, '/');
        $proxiedUrl = \ltrim($proxiedUrl, '/');

        return "{$proxyHost}/{$proxiedUrl}";
    }
}