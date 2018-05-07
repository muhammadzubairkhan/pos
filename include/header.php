<!-- HEADER SECTION -->
<div class="navbar-header">
    <a class="navbar-brand" href="home.php">POS</a>
</div>

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>

<!-- Top Navigation: Left Menu -->
<ul class="nav navbar-nav navbar-left navbar-top-links">
    <li><a href="home.php"><i class="fa fa-home fa-fw"></i> Home</a></li>
</ul>

<?php
if($admin == true)
{
?>

<!-- Top Navigation: Right Menu -->
<ul class="nav navbar-right navbar-top-links">
    <li class="dropdown">
        <a href="session_destroy.php">
            <i class="fa fa-user fa-fw"></i> Logged in as: Admin (Click to logout)
        </a>
    </li>
</ul>


<?php
}
else if($admin == false)
{
?>

<!-- Top Navigation: Right Menu -->
<ul class="nav navbar-right navbar-top-links">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> General User
        </a>
    </li>
</ul>

<?php
}
?>
