<?php
ob_end_flush();

echo $twig->render($template_file_name, $context);