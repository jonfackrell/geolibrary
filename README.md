# UIC GeoLibrary Omeka Theme

This is an [Omeka Classic](https://omeka.org/classic/) theme designed for the [UIC GeoLibrary](http://geolibrary.org/)

## Installation

1. Download the theme files
2. Upload the files to a new folder within the `themes` directory of your Omeka installation

## Usage

This theme was built using [Tailwind CSS](https://tailwindcss.com/). In order to work with Tailwind, you must first install [Node.js](https://nodejs.org) on your workstation. Once Node.js has been installed, you can navigate to the theme directory and install the node dependencies using the following command:

```
npm install
```

### CSS Changes

Tailwind allows you to use CSS utility classes in your HTML and covers most CSS properties. However, it also allows you to build component classes and regular CSS. To learn more about Tailwind head over to [https://tailwindcss.com/docs](https://tailwindcss.com/docs).

You can add your own styles to /assets/css/app.css

There are 3 commands to help compile the CSS into app.min.css which is used in the theme layout.

```
// Run the compiler without any minification. This is best used when developing.

npx mix 
```
```
// Even more useful this command will watch style.css for changes and 
// recompile using npm run dev automatically.

npx mix watch 
```
```
// Runs the compiler and excludes any unused utilities. This is best 
// used when changes have been finalized and you are ready to upload to the server.

npx mix --production 
```

Because `npx mix --production` will purge any utility classes not found in the php files, if you would like to use any Tailwind classes in the database, then you can put them in one of two places.

1. In custom.php there is a commented section where you can place a list of classes.
2. Because Simple Pages are the most likely place where classes will be stored in the database, I have just placed html pages in the simple-pages directory. This file contains the content of the Contribute page within Omeka.

## Homepage Link Boxes
The link boxes on the homepage are hard coded links to Collection pages. The links on these boxes can be updated in the file /geolibrary/common/link-box.php

## Navigation

The top nav bar will show up to 1 level in the dropdowns.

The collection navigator can potentially show unlimited levels of navigation. For browsing collections it will be best to link to the browse page limited to the collection like so: 

```
http://geolibrary.org/items/browse?collection={ID}
```

Currently, the submenu will filter out top level navigation items with the names 'About' and 'Suggest Materials'.