# yellow-ygtm
Ygtm is a cookie consent extension for the Google Tag Manager. 

EDIT: Not ready to use.

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


