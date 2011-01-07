<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <!-- Title -->
  <title><?php echo $title . ' &bull; ' . page_name($page); ?></title>
  <!-- Metas -->
  <meta http-equiv="Content-Language" content="fr" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <meta name="Title" lang="fr" content="<?php echo $title; ?>" />
  <meta name="Identifier-url" content="http://www.<website-url>.com/" />
  <meta name="Description" lang="fr" content="<?php echo $description; ?>" />
  <meta name="Abstract" content="" />
  <meta name="keywords" lang="fr" content="" />
  <meta name="Category" content="" />
  <meta name="Date-Creation-yyyymmdd" content="2010/12/31" />
  <meta name="Date-Revision-yyyymmdd" content="2010/12/31" />
  <meta name="Copyright" content="©Copyright : <?php echo $title; ?>" />
  <meta name="Distribution" content="Global" />
  <meta name="Rating" content="General" />
  <meta name="Robots" content="index, follow" />
  <meta name="Revisit-After" content="10 days" />
  <link rel="shortcut icon" href="images/favicon.ico" />
  <!-- Style -->
  <link href="styles/main.css" rel="stylesheet" type="text/css"/>
  <link href="styles/view.css" rel="stylesheet" type="text/css"/>
  <link href="styles/comments.css" rel="stylesheet" type="text/css"/>
  <link href="styles/rate.css" rel="stylesheet" type="text/css"/>
  <!-- JavaScript -->
  <script src="javascripts/rate.js" type="text/javascript"></script>
  <script src="http://code.jquery.com/jquery-1.4.4.min.js" type="text/javascript"></script>
</head>
<body>
  <div id="content">
  <div class='viewcloudscript'>
    <div class='inner'>
      <div class='title'><?php echo $title; ?></div>
        <div class='username'><a href="#"><?php echo $description; ?></a></div>
    </div>

    <div class='tabs'>
      <ul>
        <li><a href='#'><img src='images/teach.png' /> Liste</a></li>
        <li class='active'><a href='#'><img src='images/details.png' /> Details</a></li>
        <li><a href='#'><img src='images/comment.png' /> 1 Commentaire(s)</a></li>
        <li><a href='#'><img src='images/settings.png' /> Admin</a></li>
      </ul>
    </div>
  </div>