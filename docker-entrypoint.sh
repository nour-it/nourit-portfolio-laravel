#!/bin/bash
set -e

# Initialize the MySQL data directory if it doesn't exist
if [ ! -d /var/lib/mysql/mysql ]; then
    mysqld --initialize-insecure
    service mysql start
    mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}';"
    # service mysql stop
fi

# Start the MySQL server
exec "$@"