Image Proxy Host for XenForo 2.0.0 Alpha+
=========================================

Description
-----------

This add-on allows you to not proxy external images which are already using HTTPS or set a host for image proxy links.

Requirements
------------

- PHP 5.6.0+

Options
-------

#### Image and link proxy

| Name                            | Description                                                                                                                                                                                                                                                                                                                                                                |
| ------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Ignore https images             | If you are using proxy functionality only so that your site can run under ssl, check this box to bypass proxying of images which come from a source which is delivered via https. Note that if the source image redirects to an insecure source or the https certificate of the source image is invalid, you may still have issues with your site appearing to be insecure |
| Host for serving proxied images | If you specify a host here, it will be appended to "proxy..php" when displaying proxied images. You may want to do this if you wish your proxied images to be served from a separate cache or cdn from your normal website.                                                                                                                                                |

Credits
-------

Original add-on for XenForo 1 developed by by [Jim Boy](https://xenforo.com/community/members/25006/)

License
-------

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/ticktackk/ImageProxyHostForXF2/blob/master/LICENSE.md) file for details.