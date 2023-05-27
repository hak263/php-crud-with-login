
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
 
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo  strpos($_SERVER['REQUEST_URI'],'home')!==false ? 'active' : '';?>">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'],'music')!==false || strpos($_SERVER['REQUEST_URI'],'edit')!==false ) ? 'active' : '';?>">
        <a class="nav-link" href="music.php">Music</a>
      </li>
     
    </ul>
    <span class="navbar-text">      
        <a class="nav-link" href="logout.php">logout</a>   
    </span>
  </div>
</nav>