<?php create_script('Bootstrap')
    ->includeDependency('BootstrapIcons')
    ->includeScript() ?>
<?php use_stylesheet('css/demo.css') ?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container">
    <a class="navbar-brand" href="https://ntlab.id/demo/php-ntjs">PHP-NTJS Demo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsDemo" aria-controls="navbarsDemo" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsDemo">
      <ul class="navbar-nav me-auto"></ul>
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="https://github.com/tohenk/php-ntjs-demo">Source Code</a></li>
        <li class="nav-item"><a class="nav-link" href="https://github.com/tohenk/php-ntjs"><span class="bi-github"></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3 my-5">Code Javascript Everywhere!</h1>
      <p class="lead"><code>PHP-NTJS</code> allows to dynamically manage your javascripts, stylesheets, and scripts so you can focus on your code. You can code your javascript using PHP class, or write directly in the PHP code, even on template. The code for button below is created using PHP class <code>Demo\Script\MyDemo</code>.</p>
      <p><a class="btn btn-primary btn-lg clickme" href="#" role="button"><span class="bi-cursor"></span> Click Me</a></p>
    </div>
  </div>
  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2>JQuery and Bootstrap</h2>
        <p>Support for popular javascript like <a href="https://jquery.com">JQuery</a> and <a href="https://getbootstrap.com">Bootstrap</a>.</p>
        <pre>
&lt;?php create_script('JQuery')
    -&gt;includeDependencies(['Bootstrap.Dialog.Message'])
    -&gt;add(&lt;&lt;&lt;EOL
$.ntdlg.message('welcome-msg', 'Howdy', 'Welcome everyone!', $.ntdlg.ICON_INFO);
EOL
    ) ?&gt;
        </pre>
        <p><a class="btn btn-secondary demo1" href="#" role="button">Welcome</a></p>
      </div>
      <div class="col-md-4">
        <h2>CDN</h2>
        <p>To speed up your page, <code>CDN</code> can be enabled, <code>PHP-NTJS</code> will automatically do it for you. Just loads needed <a href="https://github.com/tohenk/ntjs-web-assets/blob/master/cdn.json">CDN information</a> and assets will loaded from CDN.</p>
      </div>
      <div class="col-md-4">
        <h2>Minified Output</h2>
        <p>On production, you can enable script output compression either by using JSMin or JShrink. On development, you can add script debug information to easily locate problematic code.</p>
      </div>
    </div>
    <hr>
  </div> <!-- /container -->
</main>
<footer class="container"><p>&copy; 2021 NTLAB.ID</p></footer>
<?php create_script('MyDemo')
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