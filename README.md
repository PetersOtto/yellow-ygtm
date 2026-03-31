# yellow-ygtm
Ygtm is a cookie consent extension for the Google Tag Manager. 

EDIT: Not ready to use.

## Code
### Cookie Remove Code (Footer)

```
<?php 
if ($this->yellow->extension->isExisting('googletagmanager')) {
    echo $this->yellow->extension->get("googletagmanager")->getJsCookieDeleteCode();
} 
?>
```

### Google Tag Manager »js« Code
Put it at top of your `<head>` tag

```
<?php 
if ($this->yellow->extension->isExisting('googletagmanager')) {
    echo $this->yellow->extension->get("googletagmanager")->getJsGtmCode();
} 
?>
```

### Google Tag Manager »iframe« Code
Put it at top of your `<body>` tag

```
<?php 
if ($this->yellow->extension->isExisting('googletagmanager')) {
    echo $this->yellow->extension->get("googletagmanager")->getIframeGtmCode();
} 
?>
```

### Cookie Consent Banner
Put it at top of your `<body>` tag, directly after the Google Tag Manager »iframe« code. 
```
<?php 
if ($this->yellow->extension->isExisting('googletagmanager')) {
    $path = $this->yellow->page->getUrl();
    echo $this->yellow->extension->get("googletagmanager")->getCookieConstentBanner();
    echo $this->yellow->extension->get("googletagmanager")->setCookieForCookieConsent($path);
} 
?>
```

### Generate Form For »PrivacyPolicy«
Put it into your Privacy Policy Markdown file.

```
[gtmform]
```


