<Html>
<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-2.x-git.min.js"></script>

</head>
<body>
    <?php
        include('HtmlToJpeg.php');

        $html2Jpeg = new HtmlToJpeg();


        $html2Jpeg->renderView("test.html");
        $html2Jpeg->renderView("test.html");
        $html2Jpeg->renderView("test.html");
        $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");
        $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");
        $html2Jpeg->renderView("test.html");
        $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");
        $html2Jpeg->renderView("test.html");
        $html2Jpeg->renderView("test.html");
        $html2Jpeg->renderHtml("<h1>Test</h1><div style='width:200px;height:300px;background:blue'></div>");

        //Form creating
        echo $html2Jpeg->output();
    ?>
</body>
</Html>
