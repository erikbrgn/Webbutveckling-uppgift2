<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'template/head-tag-content.php';?>
</head>

<body>
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
            <div class="mySlideMain fade">
                    <img src="assets/img/Karneval2010063.jpg" onclick="openModal();currentSlideModal(1)">
                    <div class="text-slideshow">Showen</div>
                </div>
                <div class="mySlideMain fade">
                    <img src="assets/img/Karnevalen06 06.jpg" onclick="openModal();currentSlideModal(2)">
                    <div class="text-slideshow">Operan?</div>
                </div>
                <div class="mySlideMain fade">
                    <img src="assets/img/Karnevalen06 18.jpg" onclick="openModal();currentSlideModal(3)">
                    <div class="text-slideshow">Cirkusen</div>
                </div>
                <div class="mySlideMain fade">
                    <img src="assets/img/Karneval2010081.jpg" onclick="openModal();currentSlideModal(4)">
                    <div class="text-slideshow">Kabarén</div>
                </div>
                <a class="prev" onclick="plusSlidesMain(-1)">&#10094;</a>
                <a class="next" onclick="plusSlidesMain(1)">&#10095;</a>
            </div>

            <div id="myModal" class="modal">
                <span class="close cursor" onclick="closeModal()">&times;</span>
                <div class="modalContent">
                    <div class="mySlideModal fade">
                        <img src="assets/img/Karneval2010063.jpg">
                    </div>
                    <div class="mySlideModal fade">
                        <img src="assets/img/Karnevalen06 06.jpg">
                    </div>
                    <div class="mySlideModal fade">
                        <img src="assets/img/Karnevalen06 18.jpg">
                    </div>
                    <div class="mySlideModal fade">
                        <img src="assets/img/Karneval2010081.jpg">
                    </div>
                    

                    <a class="prev" onclick="plusSlidesModal(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlidesModal(1)">&#10095;</a>

                    <div class="column">
                        <img class="demo" src="assets/img/Karneval2010063.jpg" onclick="currentSlideModal(1)" alt="Show">
                    </div>

                    <div class="column">
                        <img class="demo" src="assets/img/Karnevalen06 06.jpg" onclick="currentSlideModal(2)" alt="Opera">
                    </div>

                    <div class="column">
                        <img class="demo" src="assets/img/Karnevalen06 18.jpg" onclick="currentSlideModal(3)" alt="Cirkus">
                    </div>

                    <div class="column">
                        <img class="demo" src="assets/img/Karneval2010081.jpg" onclick="currentSlideModal(4)" alt="Kabare">
                    </div>
                </div>
            </div>
            
        </div>

        <?php include 'template/side.php';?>
        <?php include 'template/footer.php';?>
    </div>

    <?php include 'template/resources.php';?>
</body>

</html>