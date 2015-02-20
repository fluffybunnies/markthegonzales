
dir=$1
branch=$2

echo "post-gitsync.sh $dir $branch"

chown www-data $dir/web/public-out

chown -R www-data $dir/web/wp-content/uploads
chown -R www-data $dir/web/wp-content/tmp_uploads
chown -R www-data $dir/web/wp-content/plugins
# why do i need these...? grrr
chown -R www-data $dir/web/wp-content
#chown -R www-data $dir/web/wp-admin/*


# this works:
# chown -R www-data /var/www/markthegonzales/web/wp-admin/*

# this works:
# 

# this doesnt:
# chown www-data /var/www/markthegonzales/web/wp-admin/*
# chown -R www-data /var/www/markthegonzales/web/wp-admin
# chown www-data /var/www/markthegonzales/web/wp-admin
# find /var/www/markthegonzales/web/wp-admin/ | xargs chown www-data
# find /var/www/markthegonzales/web/wp-admin -type d | xargs chown www-data
# chown -R www-data /var/www/markthegonzales/web/wp-admin/* && chown -R root user && chown -R root network && chown -R root maint && chown -R root js && chown -R root includes && chown -R root images && chown -R root css
# chown -R www-data /var/www/markthegonzales/web/wp-admin/* && find /var/www/markthegonzales/web/wp-admin/ | xargs chown -R root
# chown -R www-data /var/www/markthegonzales/web/wp-admin/* && chown root /var/www/markthegonzales/web/wp-admin/*
# chown -R www-data user && chown -R www-data network && chown -R www-data maint && chown -R www-data js && chown -R www-data includes && chown -R www-data images && chown -R www-data css

# reset:
# rm -fr /var/www/markthegonzales/web/wp-content/plugins/mailchimp-for-wp && chown -R root /var/www/markthegonzales/ && /root/sire/_common/gitsync.sh '/var/www/markthegonzales' 'master'
# http://www.markthegonzales.com/wp-admin/update.php?action=install-plugin&plugin=mailchimp-for-wp&_wpnonce=ce4bc0ddec