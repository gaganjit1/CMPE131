<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>

</head>
<body>	

<?php $page=basename($_SERVER['PHP_SELF']); ?>

<div id="menu">
<div class="nav">
  <li ><a <?php if ($page == "index.php") { echo 'class="active"';} ?> href="/">Home</a></li>
  <li> <a <?php if ($page == "about.php") { echo 'class="active"';} ?> href="/about.php">About</a></li>
  <li> <a <?php if ($page == "solutions.php") { echo 'class="active"';} ?> href="/solutions.php">Solutions</a></li>
  <li> <a <?php if ($page == "contact.php") { echo 'class="active"';} ?> href="/contact.php">Contact</a></li>
  <!--<li><a href="/survey.php">Survey</a></li>-->
  <li ><a <?php if ($page == "admin.php") { echo 'class="active"';} ?> href="/admin.php">Admin</a></li>
</div>
</div><!--/menu--> 