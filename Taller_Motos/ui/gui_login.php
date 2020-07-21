<?php

require_once('ln/ln_security.php');
require_once('db/db_admin.php');


class Gui_login
{

    var $ln_security;
    var $estado;


    function __construct($config)
    {
        
        $this->ln_security = new ln_security();

        if ($config) {
            $this->config = $config;
        }

$this->ln_security->check_tipo_login($this->config['url']);
        
    }

    
    function get_header()
    {
        $data = new db_admin();

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta name="google" content="notranslate">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mighty motors</title>
            <link rel="stylesheet" href="assets/css/all.min.css">
            <link rel="stylesheet" href="assets/css/styles_login.css">
            <script src="assets/js/b99e675b6e.js"></script>
            <link rel="icon"  type="image/png" href="<?=$admin->get_admin()['logo']?>">

            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <script src="assets/js/jquery-3.4.1.js"></script>
            <script src="assets/js/popper.min.js" ></script>
            <script src="assets/js/bootstrap.min.js" ></script>
        </head>

        <body translate="no">
        <?php
    }

    function get_footer()

    {
        ?>

            <script src="assets/js/main_login.js"></script>

        </body>

        </html>
<?php
    }
}

?>