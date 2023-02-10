<!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="./">&nbsp;</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <!-- <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <li class="nav-item" title="My User ID">
                <span style="color:green;font-weight:bold;">User Name:</span> <span style="color:green;font-weight:normal;"><?php echo $_SESSION["adminusername"];?>&nbsp;&nbsp;</span>
              </li>
			  <li class="nav-item" title="My User ID">
                <span style="color:green;font-weight:bold;">User ID:</span> <span style="color:green;font-weight:normal;"><?php echo $_SESSION["adminuserid"];?></span>
              </li>			  
            </ul>
          </div>
        </div>
      </nav>