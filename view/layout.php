<?php $stylesheets = include_stylesheets() ?>
<?php $javascripts = include_javascripts() ?>
<?php $script = include_script() ?>
<?php echo <<<EOF
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<title>PHP-NTJS Demo</title>
$stylesheets
</head>
<body>
$content
$javascripts
$script
</body>
</html>
EOF; ?>