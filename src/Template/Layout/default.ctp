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
  <?= $this->fetch('css') ?>
  <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<?= $this->Html->css(['custom'],['type' => 'text/css','media' => 'all']) ?>
</head>
<body class="bg-light" data-gr-c-s-loaded="true" style="font-family: 'Nunito', sans-serif;">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark static-top ic_header_bg" style="background: linear-gradient(to right, #9668a6, #e58ea0);">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="<?= $this->Url->Build('/')?>">
        <?php echo $this->Html->Image('/img/logo.png',['style' => 'height: 35px;']); ?>
      </a>

      <!-- Menu button in mobile -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php
          /*For User role*/
          (in_array($menuActive, ["Users.dashboard"])) ? $HomeActive = "active": "";
          (in_array($menuActive, ["News.add", "News.index", "News.view"])) ? $NewsActive = "active": "";
          (in_array($menuActive, ["Tasks.add", "Tasks.index", "Tasks.view", "Tasks.edit"])) ? $TasksActive = "active": "";
          (in_array($menuActive, ["Icos.index"])) ? $IcosActive = "active": "";
          (in_array($menuActive, ["Airdrops.add", "Airdrops.index"])) ? $AirActive = "active": "";
          (in_array($menuActive, ["Users.index"])) ? $usActive = "active": "";
          (in_array($menuActive, ["Users.brodcast"])) ? $us2Active = "active": "";
		  

          /*For Admin role*/
          (in_array($menuActive, ["News.userNews","News.userView"])) ? $nActive = "active": "";
          (in_array($menuActive, ["Tasks.earnMoney"])) ? $tActive = "active": "";
          (in_array($menuActive, ["Tasks.add", "Tasks.index"])) ? $mtActive = "active": "";
          (in_array($menuActive, ["Airdrops.airdropUserView", "Airdrops.userView"])) ? $arActive = "active": "";
          (in_array($menuActive, ["Refers.index"])) ? $rfActive = "active": "";
		  (in_array($menuActive, ["Users.userProfile"])) ? $uActive = "active": "";
          ?>

		      <?php if($user_role=='Admin' || $user_role=='Staff'){ ?>
            <li class="nav-item <?php echo @$HomeActive; ?>">
              <a href="<?= $this->Url->Build('/Dashboard')?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown <?php echo @$NewsActive; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                News
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'news', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'news', 'action' => 'index'],['class'=>'dropdown-item']) ?>
				      </div>
            </li>
			<li class="nav-item dropdown <?php echo @$TasksActive; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Earn Money
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'Tasks', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'Tasks', 'action' => 'index'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
            <li class="nav-item <?php echo @$IcosActive; ?>">
              <a href="<?= $this->Url->Build('/ICO-Applications')?>" class="nav-link">ICO-Applications</a>
            </li>
			<li class="nav-item <?php echo @$usActive; ?>">
              <a href="<?= $this->Url->Build(['controller' => 'Users', 'action' => 'index'])?>" class="nav-link">User</a>
            </li>
			<li class="nav-item dropdown <?php echo @$AirActive; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Airdrops
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'Airdrops', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'Airdrops', 'action' => 'index'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
			<li class="nav-item <?php echo @$us2Active; ?>">
              <a href="<?= $this->Url->Build(['controller' => 'Users', 'action' => 'brodcast'])?>" class="nav-link">Email Brodcast</a>
            </li>
			    <?php } else { ?> <!-- Else statement -->
  			    <li class="nav-item <?php echo @$nActive; ?>">
              <a href="<?= $this->Url->Build('/News-Updates')?>" class="nav-link">News</a>
            </li>
            <li class="nav-item <?php echo @$tActive; ?>">
              <a href="<?= $this->Url->Build('/Earn-Money')?>" class="nav-link">Earn Money</a>
            </li>
            <li class="nav-item dropdown <?php echo @$mtActive; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manage Tasks
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'tasks', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'tasks', 'action' => 'index'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
            <li class="nav-item <?php echo @$arActive; ?>">
              <a href="<?= $this->url->build('/Airdrops-Feed');?>" class="nav-link">Airdrops</a>
            </li>
            <li class="nav-item <?php echo @$rfActive; ?>">
              <a href="<?= $this->url->build('/Refer-and-Earn');?>" class="nav-link">Refer and Earn</a>
            </li>
			<li class="nav-item <?php echo @$uActive; ?>">
              <a href="<?= $this->Url->Build('/profile')?>" class="nav-link">My Profile</a>
            </li>
            <li class="nav-item">
              <a href="JavaScript:void();" class="nav-link">Wallet: 236</a>
            </li>
  			  <?php } ?>
              
  			  <?php if(empty($user_id)){ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $this->url->build(['controller'=>'users','action'=>'login']) ?>">Login</a>
            </li>
          <?php }else{ ?> <!-- Else statement -->
            <li class="nav-item">
              <a class="nav-link" href="<?= $this->url->build(['controller'=>'users','action'=>'logout']) ?>">Logout</a>
            </li>
          <?php } ?>
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
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/bootstrap.bundle.min.js"></script>
	<?= $this->fetch('script') ?>
</body>
</html>
