
dir=$1
branch=$2

echo "post-gitsync.sh $dir $branch"

chown -R www-data $dir/web/public-out

#chown -R www-data $dir/web/wp-content/uploads
#chown -R www-data $dir/web/wp-content/tmp_uploads
#chown -R www-data $dir/web/wp-content/plugins
chown -R www-data $dir/web/wp-content # let wp create a test file in this dir
chown www-data $dir/web/wp-admin/includes/file.php # wp compares owner of this file to a newly created one in get_filesystem_method()

# reset:
# rm -fr /var/www/markthegonzales/web/wp-content/plugins/mailchimp-for-wp && chown -R root /var/www/markthegonzales/ && /root/sire/_common/gitsync.sh '/var/www/markthegonzales' 'master'
# http://www.markthegonzales.com/wp-admin/update.php?action=install-plugin&plugin=mailchimp-for-wp&_wpnonce=ce4bc0ddec