<?php

/* INFORMATIONS DE CONNEXION A LA BDD */
define('DB_NAME', 'ecommerce');
define('DB_USER', 'ecom');
define('DB_PWD', 'ecom');


/* CONSTANTES DES REGEX UTILISEES */
define('REGEX_NAME', "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,50}$/u");
define('REGEX_PHONE', "/^0[1-9]([-. ]?[0-9]{2}){4}$/u");

?>