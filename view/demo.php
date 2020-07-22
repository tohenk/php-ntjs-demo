<?php create_script('Bootstrap')
    ->includeScript() ?>
<?php use_stylesheet('css/demo.css') ?>
<?php echo <<<EOF
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="https://ntlab.id/demo/php-ntjs">PHP-NTJS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDemo" aria-controls="navbarsDemo" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsDemo">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="https://github.com/tohenk/php-ntjs-demo">View Source</a></li>
    </ul>
    <ul class="navbar-nav pull-right">
      <li class="nav-item"><a class="nav-link" href="https://github.com/tohenk/php-ntjs"><span class="fab fa-github"></span></a></li>
    </ul>
  </div>
</nav>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Code Javascript Everywhere!</h1>
      <p class="lead"><code>PHP-NTJS</code> allows to dynamically manage your javascripts, stylesheets, and scripts so you can focus on your code. You can code your javascript using PHP class, or write directly in the PHP code, even on template. The code for button below is created using PHP class <code>Demo\Script\MyDemo</code>.</p>
      <p><a class="btn btn-primary btn-lg clickme" href="#" role="button"><span class="fas fa-mouse-pointer"></span> Click Me</a></p>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2>JQuery and Bootstrap</h2>
        <p>Support for popular javascript like <a href="https://jquery.com">JQuery</a> and <a href="https://getbootstrap.com">Bootstrap</a></p>
        <pre>
&lt;?php create_script('Bootstrap')-&gt;includeScript(); ?&gt;
&lt;?php create_script('JQuery')
    -&gt;includeDependecies(array('Bootstrap.Dialog.Message'));
    -&gt;add(&lt;&lt;&lt;EOL
$.ntdlg.message('welcome-msg', 'Howdy', 'Welcome everyone!', $.ntdlg.ICON_INFO);
EOL
    ); ?&gt;
        </pre>
        <p><a class="btn btn-secondary demo1" href="#" role="button">Welcome</a></p>
      </div>
      <div class="col-md-4">
        <h2>CDN</h2>
        <p>To speed up your page, <code>CDN</code> can be enabled, <code>PHP-NTJS</code> will automatically do it for you. Just loads needed <a href="https://github.com/tohenk/php-ntjs/blob/master/cdn.json">CDN information</a> and assets will loaded from CDN.</p>
      </div>
      <div class="col-md-4">
        <h2>Minified Output</h2>
        <p>On production, you can enable script output compression either by using JSMin or JShrink. On development, you can add script debug information to easily locate problematic code.</p>
      </div>
    </div>

    <hr>

  </div> <!-- /container -->

</main>

<footer class="container">
  <p>&copy; 2020 NTLAB.ID</p>
</footer>
EOF ?>
<?php create_script('MyDemo')
    ->includeScript()
    ->add(<<<EOF
$('a.clickme').on('click', function(e) {
    e.preventDefault();
    $.mydemo.show();
});
$('a.demo1').on('click', function(e) {
    e.preventDefault();
    $.ntdlg.message('welcome-msg', 'Howdy', 'Welcome everyone!', $.ntdlg.ICON_INFO);
});
EOF
    ) ?>