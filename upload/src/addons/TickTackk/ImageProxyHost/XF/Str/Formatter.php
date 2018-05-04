<?php

namespace TickTackk\ImageProxyHost\XF\Str;

/**
 * Class Formatter
 *
 * @package TickTackk\ImageProxyHost
 */
class Formatter extends XFCP_Formatter
{
    /**
     * @param $type
     * @param $url
     *
     * @return null|string
     */
    public function getProxiedUrlIfActive($type, $url)
    {
        $return = parent::getProxiedUrlIfActive($type, $url);
        if ($type === 'image')
        {
            $options = \XF::app()->options();
            $proxyHost = $options->bfp_proxyhost;
            $ignoreSSLImages = $options->bfp_ignoressl;

            $linkClassTarget = $this->getLinkClassTarget($url);

            if ($linkClassTarget['type'] === 'external' && $ignoreSSLImages && substr($url, 0, 8) === 'https://')
            {
                return $url;
            }

            if (!empty($proxyHost))
            {
                return rtrim($proxyHost, '/') . '/' . ltrim(strstr($return, 'proxy.php'), '/');
            }
        }

        return $return;
    }
}