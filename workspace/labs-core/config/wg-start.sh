#!/bin/sh
set -e

# Other initialization steps if needed
# ...

# Start WireGuard
wg-quick up wg0
tail -f /dev/null

# Keep the container running
exec "$@"
