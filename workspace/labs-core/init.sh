#!/bin/sh
set -e

# Other initialization steps if needed
# ...

#!/bin/bash

# Check if username is provided as an argument
if [ $# -eq 0 ]; then
    exit 1
fi

# Assign the first argument to the variable
USERNAME=$1

# Add a new user
useradd -m -s /bin/bash $USERNAME

# Add the new user to the sudo group
usermod -aG sudo $USERNAME

# Set a password for the new user with the provided username and string
echo "$USERNAME:${USERNAME}@user" | chpasswd

# Set a password for the root user with the provided username and string
echo "root:${USERNAME}@root" | chpasswd

chown $USERNAME /home/$USERNAME

www_directory="/home/$USERNAME/www"
apache_directory="/home/$USERNAME/sites-available"

# Check if the directory exists
if [ -d "$www_directory" ]; then
    echo "Directory 'www' exists. removing existing '/var/www' and linking..."
    rm -rf /var/www
    ln -s $www_directory /var/
    echo "remove existing '/var/www' and linking done."
else
    echo "Directory does not exist. moving and linking 'www' to home..."
    mv /var/www /home/$USERNAME/
    ln -s $www_directory /var/www
    echo "moving and linking 'www' done."
fi

if [ -d "$apache_directory" ]; then
    echo "Directory 'sites-available' exists. removing existing '/etc/apache2/sites-available' and linking..."
    rm -rf /etc/apache2/sites-available
    ln -s $apache_directory /etc/apache2/
    echo "remove existing '/etc/apache2/sites-available' and linking done."
else
    echo "Directory does not exist. moving and linking 'sites-available' to home..."
    mv /etc/apache2/sites-available /home/$USERNAME/
    ln -s $apache_directory /etc/apache2/sites-available
    echo "moving and linking 'sites-available' done."
fi


# Managing services's IP to local DNS
echo "167.0.0.4    vpn.umarfarooq.cloud" >> /etc/hosts
echo "167.0.0.5    mysql.umarfarooq.cloud" >> /etc/hosts
echo "167.0.0.6    adminer.umarfarooq.cloud" >> /etc/hosts

# changing permissions of the home folder to the user's account
chown -R $USERNAME /home/$USERNAME

# Start WireGuard
wg-quick up wg0
service apache2 start
service ssh start
rm /root/init.sh

tail -f /dev/null
