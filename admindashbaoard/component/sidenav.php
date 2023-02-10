<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
	 $url = "https://";   
else  
	 $url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   
// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    
$myFile = pathinfo($url); 
?>
<div class="sidebar" data-color="green" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#a" class="simple-text logo-normal">
          &nbsp;
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php 
			if ($myFile['basename']=="forms" || $myFile['basename']=="index.php") {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./index.php">
              <i class="material-icons">dashboard</i>
              <p>dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php 
			if (strpos(strtolower($myFile['basename']), 'addadmin.php') !== false) {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./addadmin.php">
              <i class="material-icons">person_add</i>
              <p>Add Admin</p>
            </a>
          </li>

		  <li class="nav-item <?php 
			if (strpos(strtolower($myFile['basename']), 'adminreport.php') !== false || strpos(strtolower($myFile['basename']), 'archive.php') !== false  || strpos(strtolower($myFile['basename']), 'unarchive.php') !== false  ) {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./adminreport.php">
              <i class="material-icons">list</i>
              <p>Admin Report</p>
            </a>
          </li>

          <li class="nav-item <?php
			if (strpos(strtolower($myFile['basename']), 'msg_settings.php') !== false) {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./msg_settings.php">
              <i class="material-icons">settings</i>
              <p>Message Config</p>
            </a>
          </li>

		  <!--<li class="nav-item <?php/* 
			if (strpos(strtolower($myFile['basename']), 'resultreport.php') !== false || strpos(strtolower($myFile['basename']), 'archive.php') !== false  || strpos(strtolower($myFile['basename']), 'unarchive.php') !== false  ) {
				echo "active";
			}
			*/?>">
            <a class="nav-link" href="./resultreport.php">
              <i class="material-icons">list</i>
              <p>Result Config</p>
            </a>
          </li>-->

		  <li class="nav-item <?php
			if (strpos(strtolower($myFile['basename']), 'addquestion.php') !== false) {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./addquestion.php">
              <i class="material-icons">person_add</i>
              <p>Add Question</p>
            </a>
          </li>

		  
		  <li class="nav-item <?php
			if (strpos(strtolower($myFile['basename']), 'questions.php') !== false) {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./questions.php">
              <i class="material-icons">list</i>
              <p>Questions List</p>
            </a>
          </li>


		  <li class="nav-item <?php 
			if (strpos(strtolower($myFile['basename']), 'userreport.php') !== false || strpos(strtolower($myFile['basename']), 'archive.php') !== false  || strpos(strtolower($myFile['basename']), 'unarchive.php') !== false  ) {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./userreport.php">
              <i class="material-icons">view_list</i>
              <p>User Report</p>
            </a>
          </li>


		  <li class="nav-item <?php 
			if (strpos(strtolower($myFile['basename']), 'changepassword.php') !== false || strpos(strtolower($myFile['basename']), 'archive.php') !== false  || strpos(strtolower($myFile['basename']), 'unarchive.php') !== false  ) {
				echo "active";
			}
			?>">
            <a class="nav-link" href="./changepassword.php">
              <i class="material-icons">edit</i>
              <p>Change Password</p>
            </a>
          </li>

		  <li class="nav-item ">
            <a class="nav-link" href="./logout.php">
              <i class="material-icons">person_add_disabled</i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>