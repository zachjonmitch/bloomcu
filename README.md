# BloomCU Wordpress Theme

* Name: Base Theme
* Author: BloomCU
* Version: 4.1.1

## Download
Download this repository at:
`git clone git@bitbucket.org:bloomcu/project-penn.git`


## Build Tools
To develop with this theme you will need to install the following:

* [node](https://nodejs.org/)

## Development
In the theme folder run the following commands:

*`npm install`
*
*`npm run watch`
* For Mac `npm run watch-mac`
*
* If running `watch` fails, try using the `build` commands below instead
* For Development `npm run build`
* For Production `npm run prod`

This will download the npm packages, then start the local browser sync server in your browser.

## Sample Database
This will be provided upon request.

## Media files
Go to your website's .htaccess file and add the following script to the very top of your file.

	# Attempt to load files from production if
	# they're not in our local version
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteRule wp-content/uploads/(.*) \
	https://penneast.bloomcudev.com/wp-content/uploads/$1 [NC,L]
	
## Editing Theme guide

1. Create your own branch with your name [dev-yourname] to push changes to this repo. 
2. When adding new SCSS (CSS,CSS3, etc..) and JS codes, this must be done in the `assets/source` folder. 
3. Utlilize the webpack "npm run build or npm run watch" 
   so that your new codes (SCSS and JS) are automatically compiled into the main "base.js" and "base.css" files found in `assets/dist` folder.