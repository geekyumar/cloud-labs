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


# Start WireGuard
wg-quick up wg0
service apache2 start
service ssh start
tail -f /dev/null


# Keep the container running
exec "$@"
