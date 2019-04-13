<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $this->fetch('title') ?>
  </title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo $this->request->getAttribute("webroot"); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $this->request->getAttribute("webroot"); ?>ic_style.css" rel="stylesheet">
    
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<?= $this->Html->css(['custom'],['type' => 'text/css','media' => 'all']) ?>
</head>
<body class="bg-light" data-gr-c-s-loaded="true" style="font-family: 'Poppins', sans-serif;">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark static-top ic_header_bg" style="background: linear-gradient(to right, #9668a6, #e58ea0);">
    <div class="container">
      <a class="navbar-brand" href="<?= $this->Url->Build('/')?>">
        <?php echo $this->Html->Image('/img/logo.png',['style' => 'height: 35px;']); ?>
      </a>
      
    </div>
  </nav>
    
    <!-- Page Content -->
    <div class="container">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    </div>
    
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
