<?php
echo '<div class="nav">
<button id="hamburger" class="hamburger" onclick="toggleMenu();"></button>
<div class="brand-container">
    <h1 class="brand-title"><a href="index.html" style="color:#fec771">Karnevalen</a></h1>
</div>
<div class="empty"></div>
<div id="link-container" class="link-container">
    <ul class="menu">
        <li><a href="bli-karnevalist.html">Bli Karnevalist</a>
            <ul class="dropdown-container">
                <li><a href="ansok.html">Ansök</a></li>
                <li><a href="sektioner.html">Sektioner</a>
                    <ul>
                        <li><a href="administer-it.html">AdministerIT</a></li>
                        <li><a href="biljonsen.html">Biljonsen</a></li>
                        <li><a href="bladderiet.html">Blädderiet</a></li>
                        <li><a href="dansen.html">Dansen</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="om-karnevalen.html">Om Karnevalen</a>
            <ul class="dropdown-container">
                <li><a href="nojen.html">Nöjen</a></li>
                <li><a href="artister.html">Artister</a></li>
                <li><a href="taget.html">Tåget</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="hitta-oss.html">Hitta hit</a></li>
            </ul>
        </li>
        <li><a href="reservera-biljetter.html">Reservera biljetter</a></li>
    </ul>
</div>

</div>';
?>