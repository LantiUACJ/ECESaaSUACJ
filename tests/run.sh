#!/bin/bash
sudo yum update -y > /dev/null 2> /dev/null < /dev/null &
cd /
cd var/www/html/ECESaaSUACJ
sudo rm .env
echo removed 
sudo aws s3 cp s3://s3intercambio2/ECESaaSUACJ/.env /var/www/html/ECESaaSUACJ/
sudo chown -R ec2-user ./composer.lock
echo composerpreview
sudo -u ec2-user composer update > composer.txt  > /dev/null 2> /dev/null < /dev/null &
php artisan migrate --force > migrate.txt > /dev/null 2> /dev/null < /dev/null &
aws s3 cp composer.txt s3://s3intercambio2/ECESaaSUACJ/logs/
aws s3 cp migrate.txt s3://s3intercambio2/ECESaaSUACJ/logs/
echo artisan
echo success!