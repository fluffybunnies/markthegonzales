
dir=$1
branch=$2

echo "post-gitsync.sh $dir $branch"

chown -R www-data $dir/web/wp-content/uploads
chown -R www-data $dir/web/wp-content/plugins