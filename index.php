<Html>
<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-2.x-git.min.js"></script>
    <script src="http://eray.info/demo/html-to-jpeg-php/js/html2canvas.js"></script>

    <style>
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("img/loader.gif") center no-repeat #fff;
        }
    </style>

</head>
<body>
    <div class="se-pre-con"></div>
    <?php
        include('HtmlToJpeg.php');

        $html2Jpeg = new HtmlToJpeg();

        //Example code
            $html2Jpeg->renderView("test.html");
            $html2Jpeg->renderView("test.html");
            $html2Jpeg->renderView("test.html");
            $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");
            $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");
            $html2Jpeg->renderView("test.html");
            $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");


        //Form creating
        echo $html2Jpeg->output();
    ?>
</body>
</Html>
