#bin/bash

while [ true ]
do
      # Set the filename as unix timestamp
      NF=$(date +%s)

      # Get the file and copy it to tmp
      wget http://www.esrl.noaa.gov/gmd/webdata/mlo/webcam/northcam.jpg && mv northcam.jpg $NF.jpg

      # Run everything from tmp directory from here
      # mkdir tmp
      # cd tmp

      # Push the file to S3
      file="$NF.jpg"
      key_id=$AWS_ACCESS_KEY_ID
      key_secret=$AWS_SECRET_KEY
      bucket="mauna-time-machine"
      content_type="application/octet-stream"
      date="$(LC_ALL=C date -u +"%a, %d %b %Y %X %z")"
      md5="$(openssl md5 -binary < "$file" | base64)"

      sig="$(printf "PUT\n$md5\n$content_type\n$date\n/$bucket/$file" | openssl sha1 -binary -hmac "$key_secret" | base64)"

      curl -T $file http://$bucket.s3.amazonaws.com/$path \
          -H "Date: $date" \
          -H "Authorization: AWS $key_id:$sig" \
          -H "Content-Type: $content_type" \
          -H "Content-MD5: $md5"

      # Remove the file so we don't clutter up the server
      rm -rf $NF.jpg

      sleep 15m
done
