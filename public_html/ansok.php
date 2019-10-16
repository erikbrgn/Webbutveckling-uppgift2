    <div class="wrapper">
        <?php include 'template/nav.php';?>
        <?php include 'template/header.php';?>
        <?php include 'template/section.php';?>
        <div class="main">
            <h2>Ansök till Kanalkarnevalen</h2>


            <form id="form" method="POST" action="#">
                <div class="form-field select">
                    <label class="field-label" for="sektioner">Önskad sektion</label>
                    <select name="sektioner" required size=>
                        <option value selected></option>
                        <option value="administer-it">Administer IT</option>
                        <option value="biljonsen">Biljonsen</option>
                        <option value="bladderiet">Blädderiet</option>
                        <option value="dansen">Dansen</option>
                        <option value="nojen">Nöjen</option>
                        <option value="taget">Tåget</option>
                    </select>
                </div>
                <div class="form-field input">
                    <label class="field-label" for="firstname">Förnamn</label>
                    <input type="text" value name="firstname" required pattern="^[^\d]+$">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="lastname">Efternamn</label>
                    <input type="text" value name="lastname" required pattern="^[^\d]+$">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="email">E-mail</label>
                    <input type="email" value name="email" required>
                </div>
                <div class="form-field input">
                    <label class="field-label" for="telephoneNumber">Telefonnummer</label>
                    <input type="tel" value name="telephoneNumber" required>
                </div>
                <input type="submit" value="Ansök">
            </form>

        </div>
        <?php include 'template/side.php';?>
        <?php include 'template/footer.php';?>
    </div>
    <?php include 'template/lightbox.php';?>
    <?php include 'template/resources.php';?>