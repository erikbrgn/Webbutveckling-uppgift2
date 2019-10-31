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
            <h2>Ansök till Kanalkarnevalen</h2>


            <form id="form" method="POST" action="#">
                <div class="form-field select">
                    <label class="field-label" for="sektioner">Önskad sektion</label>
<<<<<<< HEAD
                    <select name="sektioner" size=>
=======
                    <select name="sektioner" required size=>
>>>>>>> 3326e5372ed6577c4a907104d8769d5046b19cdc
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
<<<<<<< HEAD
                    <input type="text" value name="firstname">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="lastname">Efternamn</label>
                    <input type="text" value name="lastname">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="email">E-mail</label>
                    <input type="text" value name="email">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="telephoneNumber">Telefonnummer</label>
                    <input type="text" value name="telephoneNumber">
                </div>
                <input type="submit" value="Ansök" disabled>
=======
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
>>>>>>> 3326e5372ed6577c4a907104d8769d5046b19cdc
            </form>

        </div>
        <?php include 'template/side.php';?>
        <?php include 'template/footer.php';?>
    </div>
<<<<<<< HEAD

=======
    <?php include 'template/lightbox.php';?>
>>>>>>> 3326e5372ed6577c4a907104d8769d5046b19cdc
    <?php include 'template/resources.php';?>
</body>

</html>