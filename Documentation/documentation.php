<?php
header('Content-Type: application/x-yaml');
echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vand-api/documentation.json');