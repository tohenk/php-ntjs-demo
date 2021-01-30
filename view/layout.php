<?php $stylesheets = include_stylesheets() ?>
<?php $javascripts = include_javascripts() ?>
<?php $script = include_script() ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Toha &lt;tohenk@yahoo.com&gt;">
<title><?php echo $title ?></title>
<?php echo $stylesheets ?>
</head>
<body>
<?php echo $content ?>
<?php echo $javascripts ?>
<?php echo $script ?>
</body>
</html>
