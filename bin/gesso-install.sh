#!/bin/bash

# sh bin/gesso-install.sh
# Install Gesso
if [ -d "public/wp-content/themes/gesso" ];
then
	echo "Gesso is installed"
else
	echo "Gesso is not found. Installing..."
  git clone https://cpotebnya@bitbucket.org/cpotebnya/component-library.git ./public/wp-content/themes/gesso
  cd ./public/wp-content/themes/gesso
  rm -rf .git &&
  npm install &&
  grunt build
fi

# Install Timber Library
if [ -d "public/wp-content/plugins/timber-library" ];
then
  echo "Timber Library is installed"
else
  echo "Timber Library is not found. Installing..."
  docker-compose run wpcli plugin install timber-library --version=1.9.4 &&
  docker-compose run wpcli plugin activate timber-library &&
  docker-compose run wpcli theme activate gesso
fi

# Create Symlink to Gesso Theme in root folder
if [ -d "theme" ];
then
  echo "Theme folder symlink exists"
else
  echo "Creating symlink to gesso theme in project root"
  cd ./
  ln -s public/wp-content/themes/gesso theme
fi

#Install Patternlab
if [ -d "public/wp-content/themes/gesso/pattern-lab" ];
then
  echo "Patternlab is already installed"
else
  echo
  read -t 10 -p "Would you like to install Patternlab? (y/N)" -n 1 -r
  echo
  if [[ $REPLY =~ ^[Yy]$ ]];
  then
    echo "Installing Patternlab"
    cd ./public/wp-content/themes/gesso
    composer create-project  pattern-lab/edition-drupal-standard pattern-lab
  else
    echo "Skipping Patternlab installation"
  fi
fi
