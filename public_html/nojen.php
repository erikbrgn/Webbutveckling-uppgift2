<?php include 'template/head-tag-content.php';?>
<div class="wrapper">
    <?php include 'template/nav.php';?>
    <?php include 'template/header.php';?>
    <?php include 'template/section.php';?>
    <div class="main">
        <h2>Nöjena</h2>
        <p>Nöjena och grejs.</p>
        <ul>
            <li>Spexet</li>
            <li>Revyn</li>
            <li>Showen</li>
            <li>Kabarén</li>
            <li>Operan</li>
            <li>Cirkusen</li>
            <li>Barnevalen</li>
            <li>Filmen</li>
        </ul>
        <div class=slideshow>
            <div class="mySlideMain k-fade">
                <img src="assets/img/Karneval2010063.jpg">
                <div class="text-slideshow">Showen</div>
            </div>
            <div class="mySlideMain k-fade">
                <img src="assets/img/Karnevalen06 06.jpg">
                <div class="text-slideshow">Operan?</div>
            </div>
            <div class="mySlideMain k-fade">
                <img src="assets/img/Karnevalen06 18.jpg">
                <div class="text-slideshow">Cirkusen</div>
            </div>
            <div class="mySlideMain k-fade">
                <img src="assets/img/Karneval2010081.jpg">
                <div class="text-slideshow">Kabarén</div>
            </div>
            <a class="prev" onclick="plusSlidesMain(-1)">&#10094;</a>
            <a class="next" onclick="plusSlidesMain(1)">&#10095;</a>
        </div>
    </div>

    <?php include 'template/side.php';?>
    <?php include 'template/footer.php';?>
</div>
<?php include 'template/lightbox.php';?>
<?php include 'template/resources.php';?>