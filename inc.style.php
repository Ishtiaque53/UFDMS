<header>
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