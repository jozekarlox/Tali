<?php

http_response_code(404);
include(dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'erro' . DIRECTORY_SEPARATOR . '404.html');
die();

?>