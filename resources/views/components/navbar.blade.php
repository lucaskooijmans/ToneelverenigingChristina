<div>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</div>

<nav>
    <a href="/" tabindex="0" class="brand-link" title="Homepagina van Toneelvereniging Christina">
        <div class="brand">
            <img src="/images/logoBasic.png" alt="Logo van toneelvereniging Christina">

            <div class="brandtext">
                Toneelvereniging<br>Christina
            </div>
        </div>
    </a>
    <div class="post-buttons">
        <button class="menu-button" onclick="toggleNavbar()" tabindex="-1" aria-hidden="true"
            title="Open het navigatiemenu">Menu</button>
        @auth
            @if (auth()->user()->isAdmin())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button" tabindex="1">Log uit</button>
                </form>
            @endif
        @endauth
    </div>
    
    <div class="links">
        <div class="link-category">
            <h2 aria-hidden="true" class="cursive">Algemeen</h2>
            <a href="/" tabindex="0">Home</a>
            <a href="/voorstellingen" tabindex="0">Voorstellingen</a>
            <a href="/nieuws" tabindex="0">Nieuws</a>
        </div>
        <div class="link-category">
            <h2 aria-hidden="true" class="cursive">Over ons</h2>
            <a href="/historie" tabindex="0">Historie</a>
            <a href="/gallery" tabindex="0">Galerij</a>
            <a href="/boardmembers" tabindex="0">Bestuursleden</a>
            <a href="/sponsors" tabindex="0">Onze Sponsoren</a>
        </div>
        <div class="link-category">
            <h2 aria-hidden="true" class="cursive">Steun ons</h2>
            <a href="/doneren" tabindex="0">Doneren</a>
            <a href="/inschrijven" tabindex="0">Inschrijven</a>
        </div>
        <div class="link-category">
            <h2 class="cursive">Overig</h2>
            <a href="/contact" tabindex="0">Contact</a>
        </div>
    </div>
    <div class="social-media">
        <a href="https://www.facebook.com/toneelvereniging.christina.ravenswaaij/" target="_blank"
            title="Facebookpagina van Toneelvereniging Christina" tabindex="0">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="https://www.instagram.com/toneelravenswaaij" target="_blank"
            title="Instagrampagina van Toneelvereniging Christina" tabindex="0">
            <i class="fa-brands fa-instagram"></i>
        </a>
    </div>
</nav>

<div class="cookies">
    <p>Deze website maakt gebruik van cookies om de gebruikerservaring te verbeteren. Door op accepteren te klikken ga
        je akkoord met het gebruik van cookies.</p>
    <button onclick="acceptCookies()" class="button green-button"><i class="fas fa-check"></i> Accepteren</button>
</div>
<script src="/navbar.js"></script>
