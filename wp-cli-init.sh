#!/bin/sh

# wp-cli alias for docker instance
alias wp="docker-compose run --rm wpcli"

# wordpress variables
WP_USER="wordpress"
WP_PW="wordpress"
WP_THEME_DIR="dummy-theme"
WP_THEME_NAME="dummy-theme"
WP_EMAIL="test@test.com"
WP_DB_NAME="wordpress"
WP_DESCRIPTION="Yet another decoupled wordpress install"

# wordpress db commands
# wp db drop --yes
# wp db create --yes

# Setup wordpress admin
wp core install --url=localhost:8000 --title=$WP_THEME_NAME --admin_user=$WP_USER --admin_password=$WP_PW --admin_email=$WP_EMAIL

# wordpress theme activation
# wp theme activate $WP_THEME_DIR --yes

# if plugins aren't activated, make sure wp-content directory is
# recursively owned by http user
# sudo chown -v -R http:http ./wp-content

# wordpress plugin list
wp plugin list

# wordpress plugin activation
wp plugin activate --all

# wordpress permalink structure
wp rewrite structure "/%postname%/"

# wp acf sync
