
dir=$1
branch=$2

echo "post-gitsync.sh $dir $branch"

chown -R www-data $dir/web/wp-content/uploads
chown -R www-data $dir/web/wp-content/tmp_uploads
chown -R www-data $dir/web/wp-content/plugins
# why? possibly due to list_files()?
chown -R www-data $dir/web/*
#chown -R www-data $dir/web/wp-admin/includes/file.php
