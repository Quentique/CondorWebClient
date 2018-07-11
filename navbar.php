<style>
.topnav {
  overflow: hidden;
  background-color: #333;
  height: 100%;
}

.topnav a, .fa-bars {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 1.4rem 1.6rem;
  text-decoration: none;
  font-size: 1.7rem;
  line-height: 2rem;
}

.topnav a:first-child {
	font-size: 2.4rem;
}

.topnav a:hover, .fa-bars:hover {
  background-color: #ddd;
  color: black;
}

.active {
  background-color: <?php echo $_SESSION['color'];?>;
  color: white;
}

.topnav .fa-bars {
  display: none;
  background: transparent;
}

@media screen and (max-width: 768px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav .fa-bars {
    float: right;
    display: block;
  }

  .topnav.responsive {position: relative;}
  .topnav.responsive .fa-bars {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a, .fa-bars {
    float: none;
   display: block;
    text-align: left;
  }
  .fa-home, .fa-bars {
	  font-size: 2em;
  }
}
</style>
<nav class="topnav" id="myTopnav">
  <a data-id="" href="index_content.php" class="fa fa-home fa-* active"><i></i></a>
  <a data-id="post" href="posts.php" >Actualités</a>
  <a data-id="event" href="events.php">Évènements</a>
  <a data-id="cantine" href="canteen.php">Cantine</a>
  <a data-id="cvl" href="cvl.php" >CVL & MDL</a>
  <a data-id="maps" href="maps.php" >Plans</a>
  <a data-id="transport" href="transport.php">Transports</a>
 <!-- <a href="javascript:void(0);" class="nav-button" >
<i></i>
  </a> -->
  <button  class="fa fa-bars fa-*" type="button" role="button" aria-label="open/close navigation" onclick="myFunction()"><i></i></button>
</nav>
<br/><br/>
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>