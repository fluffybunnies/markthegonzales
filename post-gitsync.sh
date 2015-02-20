
dir=$1
branch=$2

echo "post-gitsync.sh $dir $branch"

chown -R www-data $dir/web/wp-content/uploads
chown -R www-data $dir/web/wp-content/tmp_uploads
chown -R www-data $dir/web/wp-content/plugins

chown -R www-data $dir/web/wp-content
# whyyy????...
#chown -R www-data $dir/web/wp-admin
