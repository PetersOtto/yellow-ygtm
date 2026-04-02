# yellow-ygtm
Ygtm is a cookie consent extension for the Google Tag Manager. 

<p align="center"><img src="01-yellow-ygtm.png?raw=true" alt="Bildschirmfoto"></p>

## My target
Unfortunately, I couldn't find an extension that would let me integrate Google Tag Manager into my Yellow installation. So I decided to write my own extension.

## Alternative
Please take a look at this extension as well. Maybe it's more your cup of tee? I'm not sure, though, if »GlowCookies« is still being developed.
* https://github.com/GiovanniSalmeri/yellow-analytics

## Before installation
I hope the extension is GDPR-compliant, but I can't guarantee it! Please check this yourself after installation. 

## How to install an extension
Download ZIP file and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update). After installation, you'll need to add some code to your layout files and the CSS file.

## system.ini
Please take a look at the `/system/extension/system.ini` file. Here you can change the explanatory text and the button labels.

## Code
### Cookie Remove Code (Footer)
This code must be placed in the `/system/layouts/footer.html`, preferably right above the `<\body>` tag.

```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    echo $this->yellow->extension->get("ygtm")->getJsCookieDeleteCode();
} 
?>
```

### Google Tag Manager »js« Code
This code must be placed in the `/system/layouts/header.html`, preferably right below the `<head>` tag.

```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    echo $this->yellow->extension->get("ygtm")->getJsGtmCode();
} 
?>
```

### Google Tag Manager »iframe« Code
This code must be placed in the `/system/layouts/header.html`, preferably right below the `<body>` tag.

```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    echo $this->yellow->extension->get("ygtm")->getIframeGtmCode();
} 
?>
```

### Cookie Consent Banner
This code must be placed in the `/system/layouts/header.html`, preferably right below the `<body>` tag. (directly after the Google Tag Manager »iframe« code.)

```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    $pathBase = $this->yellow->page->getBase(true);
    $pathUrl = $this->yellow->page->getUrl(true);
    echo $this->yellow->extension->get("ygtm")->getCookieConstentBanner();
    echo $this->yellow->extension->get("ygtm")->setCookieForCookieConsent($pathBase, $pathUrl);
} 
?>
```

### Generate Form For »PrivacyPolicy«
Put this code into your Privacy Policy Markdown file. You will then receive two buttons to enable or disable cookies.

```
[ygtmform]
```

### CSS 
You can create your own css code. The following is a example for the Stockholm theme (Standard Yellow Theme).
Put this code at the end of the `\system\theme\stockholm.css` .

```
/* Custom */

#ygtm-banner {
    background-color: var(--bg);
    border: var(--border) solid 1px;
    padding: 1rem;
    position: fixed;
    bottom: 0;
    right: 0;
    margin: 1rem;
    border-radius: 10px;
}

#ygtm-banner p {
    padding-bottom: 1rem;
    margin: 0;
}

#ygtm-banner button {
    margin-top: 0.5rem;
    background-color: var(--bg);
    color: var(--text);
    border: var(--border) solid 1px;
    padding-bottom: 1rem;
    padding: 6px 8px;
    border-radius: 5px;
    display: inline-block;
    cursor: pointer;
}

#ygtm-banner button:hover {
    border-color: var(--link);
    color: var(--link);
}

#ygtm-form button {
    margin-top: 0.5rem;
    background-color: var(--bg);
    color: var(--text);
    border: var(--border) solid 1px;
    padding-bottom: 1rem;
    padding: 6px 8px;
    border-radius: 5px;
    display: inline-block;
    cursor: pointer;
}

#ygtm-form button:hover {
    border-color: var(--link);
    color: var(--link);
}
```

## Acknowledgements
* Thank you [Datenstrom](https://datenstrom.se/de/) for the great »Yellow CMS«






