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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
	  <?php $managerMenuArray = ['Home.index'];
			$managerNewsMenuArray = ['News.add','News.index','News.view','News.edit','News.userNews'];
			$managerTaskMenuArray = ['Tasks.add','Tasks.index','Tasks.view','Tasks.edit','Tasks.proofApproval','Tasks.earnMoney','Tasks.taskSubmit']; 
			$managerIcosMenuArray = ['Icos.add','Icos.index'];
			$managerAirMenuArray = ['Airdrops.add','Airdrops.index','Airdrops.airdropUserView']; 			
	  ?>
        <ul class="navbar-nav ml-auto">
		 <?php if($user_role=='Admin' || $user_role=='Staff'){ ?>
          <li class="nav-item <?= (isset($activeMenu) && in_array($activeMenu, $managerMenuArray))?'active':'' ?>">
            <a href="<?= $this->Url->Build('/Dashboard')?>" class="nav-link">Home</a>
          </li>
		 <?php } if($user_role=='Admin' || $user_role=='Staff'){ ?>
            <li class="nav-item dropdown <?= (isset($activeMenu) && in_array($activeMenu, $managerNewsMenuArray))?'active':'' ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                News
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'news', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'news', 'action' => 'index'],['class'=>'dropdown-item']) ?>
				      </div>
            </li>
			<li class="nav-item dropdown <?= (isset($activeMenu) && in_array($activeMenu, $managerTaskMenuArray))?'active':'' ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Earn Money
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'tasks', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'tasks', 'action' => 'index'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
			
            <li class="nav-item dropdown <?= (isset($activeMenu) && in_array($activeMenu, $managerIcosMenuArray))?'active':'' ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ICO
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Apply'), ['controller' => 'icos', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'icos', 'action' => 'index'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
			 <li class="nav-item dropdown <?= (isset($activeMenu) && in_array($activeMenu, $managerAirMenuArray))?'active':'' ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Airdrops
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'airdrops', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'airdrops', 'action' => 'index'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
			    <?php }else{ ?> <!-- Else statement -->
  			    <li class="nav-item <?= (isset($activeMenu) && in_array($activeMenu, $managerNewsMenuArray))?'active':'' ?>">
              <a href="<?= $this->Url->Build('/news-updates')?>" class="nav-link">News</a>
            </li>
            <li class="nav-item">
              <a href="<?= $this->Url->Build('/earn-money')?>" class="nav-link">Earn Money</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manage Tasks
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'tasks', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'tasks', 'action' => 'index'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
            <li class="nav-item <?= (isset($activeMenu) && in_array($activeMenu, $managerAirMenuArray))?'active':'' ?>">
              <a href="<?= $this->url->build('/airdrop');?>" class="nav-link">Airdrops</a>
            </li>
            
			    <?php $managerReferIcosMenuArray = ['Refers.index']; ?>
            <li class="nav-item <?= (isset($activeMenu) && in_array($activeMenu, $managerReferIcosMenuArray))?'active':'' ?>">
              <a href="<?= $this->url->build('/Refer-and-Earn');?>" class="nav-link">Refer and Earn</a>
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

          <li class="nav-item wallte">
            <a href="JavaScript:void();" class="nav-link">Wallet: 236</a>
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
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
