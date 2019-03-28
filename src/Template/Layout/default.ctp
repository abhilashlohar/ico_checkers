<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->request->webroot; ?>assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" data-gr-c-s-loaded="true">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="#">ICO Checkers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <?php if($this->request->session()->read('Auth.User.role')=="Admin"){ ?>
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    News
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?= $this->Html->link(__('Add'), ['controller' => 'news', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                    <?= $this->Html->link(__('List'), ['controller' => 'news', 'action' => 'index'],['class'=>'dropdown-item']) ?>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Earn Money
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?= $this->Html->link(__('Add'), ['controller' => 'tasks', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                    <?= $this->Html->link(__('List'), ['controller' => 'tasks', 'action' => 'index'],['class'=>'dropdown-item']) ?>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ICO
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?= $this->Html->link(__('Apply'), ['controller' => 'icos', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                    <?= $this->Html->link(__('List'), ['controller' => 'icos', 'action' => 'index'],['class'=>'dropdown-item']) ?>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Airdrops
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?= $this->Html->link(__('Add'), ['controller' => 'airdrops', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                    <?= $this->Html->link(__('List'), ['controller' => 'airdrops', 'action' => 'index'],['class'=>'dropdown-item']) ?>
                  </div>
                </li>
            <?php } ?>

            
		        <li class="nav-item">
              <a class="nav-link" href="<?= $this->url->build(['controller'=>'users','action'=>'logout']) ?>">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    </div>
    
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo $this->request->webroot; ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->request->webroot; ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
