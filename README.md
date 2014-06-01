# AKAI Wordpress Webpage

## Requirements

* apache + php 5.4
* npm
* ruby (for deploy with wordmove)
* mysql

## Stack

* [YeoPress generator](wesleytodd/YeoPress) - used only on beginning
* [WordMove](https://github.com/welaika/wordmove) - easily deploy Wordpress to staging/production servers
* [grunt-wp-theme](https://github.com/10up/grunt-wp-theme) - configure theme with grunt, and .sass files

## Installation

```
g clone akai-wordpress
cd akai-wordpress

bundle install
wordmove pull -e staging # not necessary. You need to have Movefile configured (not included in the git repo) if you want to do this!

cp local-config.sample.php local-config.php
vi local-config.php # configure database access
# do the same also with .htaccess.sample (rename it to .htaccess)

# now, see if wordpress is running up correctly

cd wp-content/themes/akai-new
npm install
grunt 

# if everything went okay, now if you can work on the theme or anything =)
# Remember to read "Theme configuration" section below in this README.

```

## Usage

#### Install a plugin

`yo wordpress:plugin`

#### Theme configuration

```
cd wp-content/themes/akai-new && grunt server
# Now you can edit akai-new theme.

# Don't manually edit ./assets/css/*.css and ./assets/js/*.js files!
# Grunt will automatically compile ./assets/ files from ./assets/css/src/*.sass and ./assets/js/src/*.js files.
```
