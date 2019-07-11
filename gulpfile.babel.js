'use strict';

// Import configuration
import config from './gulpfile.config.js'

// Import Gulp and plugins
import { dest, parallel, series, src, watch } from 'gulp';    // Automate development workflow
import sass from 'gulp-sass';                                 // Compile Sass files
import cleanCss from 'gulp-clean-css';                        // Minify css files
import concat from 'gulp-concat';                             // Concatenate files
import htmlmin from 'gulp-htmlmin';                           // Minify html files
import phpmin from 'gulp-php-minify';                         // Minify php files
import imagemin from 'gulp-imagemin';                         // Minify images
import gulpif from 'gulp-if';                                 // Conditional filter

// Import general utilities
import browserSync from 'browser-sync';                       // Live reloading of browser for testing
import merge from 'merge-stream';                             // Merge an arbitrary number of streams
import del from 'del';                                        // Delete files and folders
import yargs from 'yargs';                                    // Parsing of command line arguments

// Constants & Variables
const PRODUCTION = yargs.argv.prod                            // True = production mode; false = development
var server = browserSync.create();                            // Create instance of browser sync
sass.compiler = require('node-sass');


/**
 * Copy files to WordPress theme.
 * 
 */
export const copy = () => {
  return src(config.srcCopyPath)
    .pipe(dest(config.destCopyPath));
}

export const clean = (done) => {
  del(config.destPathFiles, { force: true });
  done();
}

/**
 * Merge css stylesheet with compiled scss.
 *
 */
export const styles = () => {
  console.log('Running Styles');
  var sassStream,
      cssStream
  
  // CSS stylesheet
  cssStream = src(config.srcPathCSS);

  // Compile SCSS
  sassStream = src(config.srcPathSCSS)
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpif(PRODUCTION, cleanCss({ compatibility: 'ie8' })));
  
  // Merge into one file and copy to theme
  return merge(sassStream, cssStream)
    .pipe(concat('style.css'))
    .pipe(dest(config.destCopyPath));
}

/**
 * Minify html and php files
 *
 */
export const html = () => {
  return src(config.srcPathTemplate)
    .pipe(gulpif(PRODUCTION, htmlmin({ collapseWhitespace: true })))
    .pipe(dest(config.destCopyPath));
}

export const php = () => {
  return src(config.srcPathPHP)
    .pipe(gulpif(PRODUCTION, phpmin()))
    .pipe(dest(config.destCopyPath));
}

/**
 * Minify image files
 *  
 */
export const images = () => {
  return src(config.srcPathImage,{ base: 'src' })
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(dest(config.destPathFiles));
}

/**
 * Reload browser.
 *
 * @param {function} done (call back function)
 */
export const reload = (done) => {
  server.reload();
  done();
}


/**
 * Watch for changes to source files.
 *
 */
export const watchForChange = () => {
  // watch(config.srcCopyPath, series(styles, reload));
  watch(config.srcPathTemplate, series(html, reload));
  watch(config.srcPathCSS, series(styles, reload));
  watch(config.srcPathSCSS, series(styles, reload));
  watch(config.srcPathPHP, series(php, reload));
  watch(config.srcPathImage, series(images, reload));
}

/**
 * Start up server.
 *
 * @param {function} done (call back function)
 */
export const serve = (done) => {
  server.init({
    proxy: config.projectURL,
    open: true
  });
  done();
}

/**
 * Start up server and watch for changes to source files.
 *
 */
export default series(clean, styles, html, php, images, serve, watchForChange);

