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
	<?= $this->Html->css(['custom'],['type' => 'text/css','media' => 'all']) ?>
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
		
              <li class="nav-item active">
                <a class="nav-link" href="#">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
		
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
			  <?php if($user_role=='Admin' || $user_role=='Staff'){ ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  News
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?= $this->Html->link(__('Add'), ['controller' => 'news', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                  <?= $this->Html->link(__('List'), ['controller' => 'news', 'action' => 'index'],['class'=>'dropdown-item']) ?>
				</div>
              </li>
			  <?php }else{ ?>
			  <li class="nav-item">
                <a href="<?= $this->Url->Build('/news-updates')?>" class="nav-link">News</a>
              </li>
			  <?php } 
			  if($user_role=='Admin' || $user_role=='Staff'){ 
			  ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Earn Money
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?= $this->Html->link(__('Add'), ['controller' => 'tasks', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                  <?= $this->Html->link(__('List'), ['controller' => 'tasks', 'action' => 'index'],['class'=>'dropdown-item']) ?>
				  <?= $this->Html->link(__('Proof Approval'), ['controller' => 'tasks', 'action' => 'proofApproval'],['class'=>'dropdown-item']) ?>
                </div>
              </li>
			  <?php }else{ ?>
			  <li class="nav-item">
                <a href="<?= $this->Url->Build('/earn-money') ?>" class="nav-link">Earn Money</a>
              </li>
			  <?php } if($user_role=='Admin' || $user_role=='Staff'){ ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  ICO
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?= $this->Html->link(__('Apply'), ['controller' => 'icos', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                  <?= $this->Html->link(__('List'), ['controller' => 'icos', 'action' => 'index'],['class'=>'dropdown-item']) ?>
                </div>
              </li>
			  <?php }  if($user_role=='Admin' || $user_role=='Staff'){  ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Airdrops
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?= $this->Html->link(__('Add'), ['controller' => 'airdrops', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                  <?= $this->Html->link(__('List'), ['controller' => 'airdrops', 'action' => 'index'],['class'=>'dropdown-item']) ?>
                </div>
              </li>
              <?php }else{ ?>
			  <li class="nav-item">
                <a href="<?= $this->url->build('/airdrop');?>" class="nav-link">Airdrops</a>
              </li>
			  <?php } if(empty($user_id)){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= $this->url->build(['controller'=>'users','action'=>'login']) ?>">Login</a>
                </li>
              <?php }else{?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= $this->url->build(['controller'=>'users','action'=>'logout']) ?>">Logout</a>
                </li>
              <?php }?>
			  <li class="float-left">
					236<?php echo $this->Html->Image('109969157-thin-line-wallet-icon-on-white-background.jpg',['width'=>'25','height'=>'25','class'=>'wallet'])?>
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
