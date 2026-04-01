# yellow-ygtm
Ygtm is a cookie consent extension for the Google Tag Manager. 

EDIT: Not ready to use.

<p align="center"><img src="01-yellow-ygtm.png?raw=true" alt="Bildschirmfoto"></p>

## My target
Unfortunately, I couldn't find an extension that would let me integrate Google Tag Manager into my Yellow installation. So I decided to write my own extension.

## Before installation
I hope the extension is GDPR-compliant, but I can't guarantee it! Please check it after installation. 

## How to install an extension
Download ZIP file and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update)
After installation, you'll need to add some code to your layout files and the CSS file.

## Code
### Cookie Remove Code (Footer)

```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    echo $this->yellow->extension->get("ygtm")->getJsCookieDeleteCode();
} 
?>
```

### Google Tag Manager »js« Code
Put it at top of your `<head>` tag

```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    echo $this->yellow->extension->get("ygtm")->getJsGtmCode();
} 
?>
```

### Google Tag Manager »iframe« Code
Put it at top of your `<body>` tag

```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    echo $this->yellow->extension->get("ygtm")->getIframeGtmCode();
} 
?>
```

### Cookie Consent Banner
Put it at top of your `<body>` tag, directly after the Google Tag Manager »iframe« code. 
```
<?php 
if ($this->yellow->extension->isExisting('ygtm')) {
    $path = $this->yellow->page->getUrl();
    echo $this->yellow->extension->get("ygtm")->getCookieConstentBanner();
    echo $this->yellow->extension->get("ygtm")->setCookieForCookieConsent($path);
} 
?>
```

### Generate Form For »PrivacyPolicy«
Put it into your Privacy Policy Markdown file.

```
[gtmform]
```

### CSS 
You can create your own css code. The following is a example for the Stockholm Theme (Standard Yellow Theme).
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







