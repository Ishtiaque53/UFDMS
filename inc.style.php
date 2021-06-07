<header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <div class="navbar">
        <div class="container">
            <a class="logo" href="#"><span>UNIT FUEL DISPENSING AND<br>MANAGEMENT SYSTEM</span></a>
            
            <img id="mobile-cta" class="mobile-menu" src="Images/menu_icon.svg" alt="Open Navigation">

            <nav class="navbar-nav">
                <img id="mobile-exit" class="mobile-menu-exit" src="Images/exit.svg" alt="Exit">
                <ul class="primary-nav">
                    <li class="current"><a href=<?php echo $_COOKIE['home'] ?>>Home</a></li>
                    <li class="current"><a href="aboutus.php">About Us</a></li>
                    <li class="contact-cta"><a href="contact.php">Contact Us</a></li>
                    <li class="logout-cta"><a href="logout.php">Log Out</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="label label-pill label-danger count" style="border-radius:3px;"></span> Notifications</a>
                        <ul class="dropdown-menu"></ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<script>
    const mobileBtn = document.getElementById('mobile-cta');
        nav = document.querySelector('nav')
        mobileBtnExit = document.getElementById('mobile-exit');

    mobileBtn.addEventListener('click', () => {
        nav.classList.add('menu-btn');
    })

    mobileBtnExit.addEventListener('click', () => {
        nav.classList.remove('menu-btn');
    })
</script>
<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 

 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script>
    $('.dropdown > a').click(function(){
        $('.dropdown > ul').toggleClass('dropdown-menu');
    });
</script>