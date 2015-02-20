
dir=$1
branch=$2

echo "post-gitsync.sh $dir $branch"

chown -R www-data $dir/web/wp-content/uploads
chown -R www-data $dir/web/wp-content/tmp_uploads
chown -R www-data $dir/web/wp-content/plugins
# why?
#chown -R www-data $dir/web/wp-content
#chown -R www-data $dir/web/wp-admin
#chown -R www-data $dir/web/wp-includes

#chown -R www-data $dir/web/wp-admin/includes/file.php

# this works: chown -R www-data /var/www/markthegonzales/web/wp-admin/*
# this doesnt: chown -R www-data /var/www/markthegonzales/web/wp-admin
