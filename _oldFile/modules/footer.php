<?php

  $urlactive = $_SERVER["PHP_SELF"];
  if($urlactive == "/modules/footer.php"){
    header('Location: /index');
  } 
?>

<footer>
    <?php include ROOT . '/include/config.php' ?>
    <script src="/js/code.js"></script>
    <div class="bloc_footer">
        <div class="contact_footer">
            <p> Contact :</p>
            <ul>
                <li> <?php echo TEL ?> </li>
                <li> <?php echo MAIL ?> </li>
            </ul>
        </div>

        <img src="/img/logo2.png" alt="Logo de l'association ALOAS" id="logo_footer">

        <img src="/img/logoIUT.png" alt="Logo de l'IUT Lyon1">
    </div>

    <p id="copyright">© RIVIERE Anton | MICONI Nathan | DUSSUD Florian | ROYER Yannis</p>
</footer>