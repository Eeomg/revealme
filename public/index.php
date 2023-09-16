<?php

    use Mvc\Portfolio\core\App;
    use Mvc\Portfolio\core\AjaxHandiling;
    use Mvc\Portfolio\core\registry;
    use Mvc\Portfolio\core\validation;
    use Mvc\Portfolio\core\database\PdoDp;

    include "../vendor/autoload.php";

    registry::set('dbconn',new PdoDp('revealme'));

    registry::set('validation',new validation());

    session_start();

    new App();
    
?>
