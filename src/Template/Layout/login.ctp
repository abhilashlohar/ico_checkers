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

    <!-- Custom CSS -->
    <link href="<?php echo $this->request->getAttribute("webroot"); ?>assets/css/signin.css" rel="stylesheet">
    <link href="<?php echo $this->request->getAttribute("webroot"); ?>ic_style-1.css" rel="stylesheet">
</head>
<body class="text-center ic_body">
    
    <?= $this->fetch('content') ?>
    
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
