#!/bin/bash

touch /tmp/dump.sh && chmod 777 /tmp/dump.sh
echo '#!/bin/bash' >> /tmp/dump.sh
echo 'mysqldump -u root -p school_db > /docker-entrypoint-initdb.d/database.sql' >> /tmp/dump.sh
echo 'chmod 777  /docker-entrypoint-initdb.d/database.sql' >> /tmp/dump.sh