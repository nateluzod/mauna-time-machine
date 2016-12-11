<?php

$now = $_SERVER['REQUEST_TIME'];

copy('http://www.esrl.noaa.gov/gmd/webdata/mlo/webcam/northcam.jpg', '../public/img/' . $now . '.jpg');
