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
git clone akai-wordpress
cd akai-wordpress

bundle install
wordmove pull --all -e production # not necessary. Will pull all files, uploads, database from production. You need to have Movefile configured (not included in the git repo) if you want to do this!

cp local-config.sample.php local-config.php
vi local-config.php # configure database access

# do the same also with .htaccess.sample (rename it to .htaccess)
cp .htaccess.sample .htaccess
vi .htaccess # configure .htaccess, f.e. you can change "RewriteBase /" to "RewriteBase /akai/" if you're running it on "http://localhost/akai/" address

# now, see if wordpress is running up correctly

# if you want to change something in the theme's *.sass files, then you need to run grunt after every change:
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

#### Upload changes to production

```
wordmove push [--all|--db|-t] -e production # choose all/db/t depending what you want to upload: all files and database / database / theme files .
# remember, when you push files to production, there's no way back to undo it!
```
