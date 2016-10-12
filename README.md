# Html to Jpeg with Php and html2canvas
Multiple html pages convert to jpeg with html2canvas and PHP. 
You can easily convert your html or php pages to jpeg with this library.

##Usage

You need to create 2 php file.I named "index.php" and "download.php". You must be define your html pages on index.php and after that you should call download function on download.php.You can easily change file names with library config.

###Index.php

Add to html2canvas and jquery scripts.
```html

  <script src="https://code.jquery.com/jquery-2.x-git.min.js"></script>
  <script src="http://eray.info/demo/html-to-jpeg-php/js/html2canvas.js"></script>

```

Add php codes into to body
```php
 include('HtmlToJpeg.php');
 $html2Jpeg = new HtmlToJpeg();
 $html2Jpeg->config["action"] = "download.php";
 $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");
 $html2Jpeg->renderView("test.html");
 echo $html2Jpeg->output();
```

###Download.php

```php
include "HtmlToJpeg.php";
$html2jpeg = new HtmlToJpeg();
$html2jpeg->download();//starting download
```

Thats it!





