# Wordpress Test Bench

## Get Started
1. Run `make` to build images and services.
1. Run `make stop` to stop and clean up services.
1. In another terminal, run `./wp-cli-init.sh` to initialize wordpress admin and install plugins.
1. Log into wordpress admin, with user & pass 'wordpress'.
1. The `wordpress-react-plugin-boiler` wordpress plugin is a git submodule that you can find in `wp/wp-content/plugins`. This is a boilerplate plugin to get you started quickly with WordPress plugin development utiliing React/Redux tools.
