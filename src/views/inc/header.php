<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="website to show your projects">
  <title><?= $title ?></title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= assets("admin/plugins/fontawesome-free/css/all.min.css") ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= assets("admin/dist/css/adminlte.min.css") ?>">
  <style>
    a:hover{
      cursor: pointer;
    }
  </style>
</head>
<body style="background-color:#ddd">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-nav navbar-expand navbar-dark navbar-light mb-3 ml-auto">
    <!-- Left navbar links -->
    <ul class=" navbar navbar-nav navbar-expand">
      <li class="nav-item d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-sm-inline-block">
        <a href="/Profile/index/<?= $_SESSION['userId']?>" class="nav-link">Profile</a>
      </li>
      <li class="nav-item d-sm-inline-block">
        <a href="/Profile/settings/" class="nav-link">Settings</a>
      </li>
      <li class="nav-item d-sm-inline-block">
        <a href="/home/logout" class="nav-link">Log Out</a>
      </li>
    </ul>
    <?php 
      if(isset($data['friends']) && (isset($data['myprofile']) &&  $data['myprofile'] == 4 ) ){
    ?>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenterwaitingfriends">
          <i class="fa fa-users"></i>
        
          <span class="badge badge-danger navbar-badge"><?=  (isset($data['friends']['waitingfriends'])) ? count($data['friends']['waitingfriends']) : 0 ?></span>
        </a>
      </li>
    </ul>
    <?php } ?>
  </nav>
  <!-- /.navbar -->