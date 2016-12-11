#!/bin/bash

NF=$(date +%s)

wget http://www.esrl.noaa.gov/gmd/webdata/mlo/webcam/northcam.jpg && mv northcam.jpg public/img/$NF.jpg
