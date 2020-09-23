// common
const gulp = require('gulp');
const { series } = require('gulp');
const browserSync = require('browser-sync').create();
const rename = require('gulp-rename');
const clean = require('gulp-clean');
//html
const htmlmin = require('gulp-htmlmin');
// css
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
// img
const imagemin = require('gulp-imagemin');
// js
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const minify = require('gulp-babel-minify');

// Clean assets
function clear() {
  return gulp
    .src('./assets/*', {
      read: false
    })
    .pipe(clean());
}

// html
function html() {
  return gulp
    .src('./src/**/*.html')
    .pipe(htmlmin({ collapseWhitespace: true, removeComments: true }))
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream());
}

// image
function img() {
  return gulp
    .src('./src/images/**/*')
    .pipe(imagemin())
    .pipe(gulp.dest('./assets/images'));
}

// css
function css() {
  return gulp
    .src('./src/styles/**/main.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer('last 2 versions'))
    .pipe(
      rename({
        extname: '.min.css'
      })
    )
    .pipe(cleanCSS())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
}

// JS function

function js() {
  return gulp
    .src('./src/scripts/**/*.js')
    .pipe(concat('main.js'))
    .pipe(
      babel({
        plugins: ['@babel/transform-runtime']
      })
    )
    .pipe(
      minify({
        mangle: {
          keepClassName: true
        }
      })
    )
    .pipe(
      rename({
        extname: '.min.js'
      })
    )
    .pipe(gulp.dest('./assets/scripts/'))
    .pipe(browserSync.stream());
}

// BrowserSync

function server() {
  browserSync.init({
    server: {
      baseDir: './'
    },
    port: 3000
  });

  gulp.watch('./src/*.html', html);
  gulp.watch('./src/images/*', img);
  gulp.watch('./src/styles/*', css);
  gulp.watch('./src/scripts/*', js);
  gulp.watch('./**/*.html').on('change', browserSync.reload);
}

// just watch the changes
function watch() {
  gulp.watch('./src/*.html', html);
  gulp.watch('./src/images/*', img);
  gulp.watch('./src/styles/*', css);
  gulp.watch('./src/scripts/*', js);
}

exports.html = html;
exports.css = css;
exports.img = img;
exports.js = js;

exports.clear = clear;
exports.build = series(js, css, html);
exports.server = server;
exports.watch = watch;
