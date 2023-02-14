<?php 
//get root folder
$protocol = $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
$root = $protocol . $_SERVER['SERVER_NAME'].'/sponsor';

//get root for includes folder within site root  
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$doc_includes = $doc_root.'/sponsor/includes/';

//get page path to synch active class in nav
$uri = $_SERVER['REQUEST_URI'];
$uri = strtok($uri, "?");
$page = str_replace('/sponsor/', '', $uri);

//add contact form app
include 'email.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title><?php echo $title; ?></title>

    <!-- CSS -->
    <link href="<?php echo $root; ?>/assets/css/styles.css" rel="stylesheet">

    <?php if (file_exists($doc_includes.'googleAnalytics.php')) include $doc_includes.'googleAnalytics.php'; ?>

  </head>

  <body class="<?php $pageClassName; ?>">
  
    <!-- HEADER -->
  
    <header class="fixed-top flex-column flex-md-row align-items-center p-0 px-md-4 mb-0 bg-white border-bottom box-shadow">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="http://www.klrn.org/home/"><img id="logo_klrn" src="<?php echo $root; ?>/assets/img/logo-klrn.png"></a>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
              <li id="home" class="nav-item<?php if ($page == '') echo ' active'; ?>">
                <a class="nav-link" href="<?php echo $root; ?>">Home</a>
              </li>
              <li id="faq" class="nav-item<?php if ($page == 'faq/') echo ' active'; ?>">
                <a class="nav-link" href="<?php echo $root; ?>/faq/">FAQ</a>
              </li>
              <li id="examples" class="nav-item<?php if ($page == 'examples/') echo ' active'; ?>">
                <a class="nav-link" href="<?php echo $root; ?>/examples/">Examples</a>
              </li>
              <li id="media-kit" class="nav-item">
                <a class="nav-link" href="<?php echo $root; ?>/downloads/2020-KLRN-Media-Kit.pdf">Media Kit</a>
              </li>  
              <li id="sponsors" class="nav-item<?php if ($page == 'examples/') echo ' active'; ?>">
                <a class="nav-link" href="<?php echo $root; ?>/our-sponsors/">Our Sponsors</a>
              </li>              
            </ul>
            <a href="#footer" id="become_sponsor" class="scroll btn btn-primary">Become a Sponsor</a>
          </div>
        </nav>
      </div>  
    </header>