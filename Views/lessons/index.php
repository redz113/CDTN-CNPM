
<style>
    /* Sidebar */
#sidebar-wrapper{
  z-index:1;
  padding-top: 20px;
  position: absolute;
  width:0;
  height:100%;
  overflow-y:hidden;
  background: #FFF;
  opacity:0.9;
	transition:all .5s;
	display:flex;
	align-items:start;
}

/* Main Content */
#page-content-wrapper{
  width: 100%;	
  position: absolute;
  padding:15px;
	transition:all .5s;
}

#menu-toggle{
	transition:all .3s;
	font-size:2em;
}
/* Change the width of the sidebar to display it*/
#wrapper.menuDisplayed #sidebar-wrapper{
  width:250px;
}

#wrapper.menuDisplayed #page-content-wrapper{
  padding-left:250px;
}

/* Sidebar styling */
.sidebar-nav{
  padding:0;
  list-style:none; 
	transition:all .5s;
	width:100%;
	text-align:left;
}

.sidebar-nav li{
  /* line-height:40px;   */
	width:100%;
	transition:all .3s;
	padding:10px;
}

.sidebar-nav li a {
  display:block;
  text-decoration:none;
  color:#000;
}

.sidebar-nav li:hover{
  background:#777;
}
</style>

<div class="modal modal-courses">
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <?php 
            foreach($lessons as $lesson){
                echo "<li><a href='./?ctl=lessons&act=index&courseId=" . $_GET['courseId'] . "&id=" . $lesson['id'] . "'>" . $lesson['name'] . "</a></li>";
            } 
        ?>
        <!-- <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li> -->
      </ul>
    </div>
    
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <a href="#" class="btn" id="menu-toggle"><i class="bx bx-menu"></i></a>
            <?php
                require_once "./Controllers/LessonsController.php";
                $controllerObj  = new LessonsController();
                $controllerObj->show(); 
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script>
    $(document).ready(function(){
    $("#menu-toggle").click(function(e){
        e.preventDefault();
        $("#wrapper").toggleClass("menuDisplayed");
    });
    });
</script>