set -e

echo "167.48.0.5    mysql.umarfarooq.cloud" >> /etc/hosts
echo "167.48.0.6    adminer.umarfarooq.cloud" >> /etc/hosts

service apache2 start
rm /init.sh
tail -f /dev/null
