# Wordpress Test Bench

## Get Started
1. Run `make` to build images and services.
1. Run `make stop` to stop and clean up services.
1. Run `./wp-cli-init.sh` to initialize wordpress admin and install plugins.
1. Log into wordpress admin, with user & pass 'wordpress'.
1. The `wp-example` wordpress plugin is a git submodule that you can find in `wp-content/plugins`. This plugin has the PHP logic that drives actions and events to push data to the given URL and endpoint on wordpress events.
