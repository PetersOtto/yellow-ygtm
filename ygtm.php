<?php
// GoogleTagManager extension
// Status: experimental

class YellowYgtm
{
    const VERSION = "0.9.3";
    public $yellow;         //access to API

    public function onLoad($yellow)
    {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("ygtmCookieOkay", "Alle Cookies erlauben");
        $this->yellow->system->setDefault("ygtmCookieNotOkay", "Nur notwendige Cookies erlauben");
        $this->yellow->system->setDefault("ygtmBannerText", "<p>Diese Seite verwendet Cookies.<br>In unserer <a href=\"#\" target=\"_blank\" rel=\"noopener noreferrer\">Datenschutzerklärung</a> finden Sie alle Informationen dazu.");
        $this->yellow->system->setDefault("ygtmGtmId", "GTM-ID");
    }


    // Google Tag Manager »js« Code
    // Put this code on top of the <head>
    public function getJsGtmCode()
    {
        $gtmId = $this->yellow->system->get("ygtmGtmId");
        $output = null;

        if (isset($_COOKIE['cookieConsent'])) {
            if ((($_COOKIE['cookieConsent']) == "OkayBanner") || (($_COOKIE['cookieConsent']) == "OkayPrivacyPolicy")) {
                $output = "<!-- Google Tag Manager -->\n";
                $output .= "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':";
                $output .= "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],";
                $output .= "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=";
                $output .= "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f)";
                $output .= "})(window,document,'script','dataLayer','$gtmId');</script>\n";
                $output .= "<!-- End Google Tag Manager -->";
            }
        }
        return $output;
    }

    // Google Tag Manager »Iframe« Code
    // Put this code on top of the <body>
    public function getIframeGtmCode()
    {
        $gtmId = $this->yellow->system->get("ygtmGtmId");
        $output = null;

        if (isset($_COOKIE['cookieConsent'])) {
            if ((($_COOKIE['cookieConsent']) == "OkayBanner") || (($_COOKIE['cookieConsent']) == "OkayPrivacyPolicy")) {
                $output = "<!-- Google Tag Manager (noscript) -->\n";
                $output .= "<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=$gtmId\"";
                $output .= "height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>\n";
                $output .= "<!-- End Google Tag Manager (noscript) -->";
            }
        }
        return $output;
    }

    // Generate Cookie Consent Banner
    public function getCookieConstentBanner()
    {
        $output = null;
        $gtmOkay = $this->yellow->system->get("ygtmCookieOkay");
        $gtmNotOkay = $this->yellow->system->get("ygtmCookieNotOkay");
        $gtmBannerText = $this->yellow->system->get("ygtmBannerText");
        ;
        if (!isset($_COOKIE['cookieConsent'])) {
            $output = "<div id=\"tag-gtm\">\n";
            $output .= "$gtmBannerText\n";
            $output .= "<form method=\"post\">\n";
            $output .= "<button type=\"submit\" name=\"set_cookieConsentOkayBanner\">$gtmOkay</button>\n";
            $output .= "<button type=\"submit\" name=\"set_cookieConsentNotOkayBanner\">$gtmNotOkay</button>\n";
            $output .= "</form>\n";
            $output .= "</div>";
        }
        return $output;
    }


    // Set Cookie For Cookie Consent
    public function setCookieForCookieConsent($path)
    {
        function setCookieYgtm($value, $path)
        {
            setcookie('cookieConsent', $value, time() + (3600 * 24 * 7));
            header('Location:' . $path);
            exit;
        }

        if (isset($_POST['set_cookieConsentOkayBanner'])) {
            $value = "OkayBanner";
            setCookieYgtm($value, $path);
        }
        if (isset($_POST['set_cookieConsentNotOkayBanner'])) {
            $value = "NotOkayBanner";
            setCookieYgtm($value, $path);
        }
        if (isset($_POST['set_cookieConsentOkayPrivacyPolicy'])) {
            $value = "OkayPrivacyPolicy";
            $pathGtmForm = $path . "#gtmform";
            setCookieYgtm($value, $pathGtmForm);
        }
        if (isset($_POST['set_cookieConsentNotOkayPrivacyPolicy'])) {
            $value = "NotOkayPrivacyPolicy";
            $pathGtmForm = $path . "#gtmform";
            setCookieYgtm($value, $pathGtmForm);
        }
    }


    // Handle page content of shortcut
    // Generate Form For »PrivacyPolicy«
    public function onParseContentElement($page, $name, $text, $attributes, $type)
    {
        $output = null;

        $gtmOkay = $this->yellow->system->get("ygtmCookieOkay");
        $gtmNotOkay = $this->yellow->system->get("ygtmCookieNotOkay");

        if ($name == "gtmform" && ($type == "block")) {
            $output = "<div id=\"gtmform\">\n";
            $output .= "<form method=\"post\">\n";
            $output .= "<button type=\"submit\" name=\"set_cookieConsentOkayPrivacyPolicy\">$gtmOkay</button>\n";
            $output .= "<button type=\"submit\" name=\"set_cookieConsentNotOkayPrivacyPolicy\">$gtmNotOkay</button>\n";
            $output .= "</form>\n";
            $output .= "</div>\n";
        }
        return $output;
    }


    // Delete All Cookies »PrivacyPolicy«
    public function getJsCookieDeleteCode()
    {

        $output = null;

        if ((isset($_COOKIE['cookieConsent'])) && (($_COOKIE['cookieConsent']) == "NotOkayPrivacyPolicy")) {
            $output = "<!-- Start - Remove All Cookies -->\n";
            $output .= "<script>\n";
            $output .= "function deleteAllCookiesExcept(exceptCookieName) {\n";
            $output .= "const cookies = document.cookie.split(';');\n";
            $output .= "cookies.forEach(cookie => {\n";
            $output .= "const name = cookie.trim().split('=')[0];\n";
            $output .= "if (name !== exceptCookieName) {\n";
            $output .= "document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';\n";
            $output .= "}\n";
            $output .= "});\n";
            $output .= "}\n";
            $output .= "deleteAllCookiesExcept('cookieConsent');\n";
            $output .= "</script>\n";
            $output .= "<!-- End - Remove All Cookies -->";
        }
        return $output;
    }

}
