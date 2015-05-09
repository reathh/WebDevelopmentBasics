<html>
<head>
    <title>The blog!</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style.css"/>
</head>
<body>
<main id="default">
    <?=$this->getLayoutData('body');?>
</main>
<aside>
    <h3>Tags</h3>
    <?=$this->getLayoutData('tags');?>
</aside>
</body>
</html>