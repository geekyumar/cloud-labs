#!/bin/sh
set -e

# Other initialization steps if needed
# ...

# Start WireGuard
wg-quick up wg0
service apache2 restart
tail -f /dev/null


# Keep the container running
exec "$@"
