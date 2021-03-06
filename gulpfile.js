'use strict';

var gulp        = require('gulp');
var sass        = require('gulp-sass');
var notify      = require('gulp-notify');
var sourcemaps  = require('gulp-sourcemaps');
var gutil       = require('gulp-util');
var uglify      = require('gulp-uglify');
var concat      = require('gulp-concat');
var browserify  = require('browserify');
var source      = require('vinyl-source-stream');
var buffer      = require('vinyl-buffer');
var args        = require('yargs').argv;
var destPath    = 'assets';
var production  = args.env === 'production';

gulp.task('styles', function() {
  var input = 'site/scss/style.scss';
  var options = {
        errLogToConsole : true,
        compass: true,
        outputStyle : (production) ? 'compressed' : 'expanded'
      };
  var output = gulp.src(input)
  .pipe(sourcemaps.init())
  .pipe(sass(options).on('error', sass.logError))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(destPath +'/css'))
  .pipe(notify({message: "Styled", onLast: true}));

  return output;
});

gulp.task('panel-styles', function() {
  var input = 'site/scss/panel.scss';
  var options = {
        errLogToConsole : true,
        compass: true,
        outputStyle : (production) ? 'compressed' : 'expanded'
      };
  var output = gulp.src(input)
  .pipe(sourcemaps.init())
  .pipe(sass(options).on('error', sass.logError))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(destPath +'/css'))
  .pipe(notify({message: "Styled", onLast: true}));

  return output;
});

gulp.task('scripts', function() {
  var output = browserify('./site/js/main.js',{debug: true})
  .bundle()
  .pipe(source('main.js'))
  .pipe(buffer());
  if (production){
    output.pipe(sourcemaps.init({loadMaps: true}))
    .pipe(uglify())
    .on('error', gutil.log)
    .pipe(sourcemaps.write('./'));
  }
  output.pipe(gulp.dest(destPath + '/js/'))
  .pipe(notify({message: "Scripted", onLast: true}));

  return output;
});

gulp.task('watch', function() {
  gulp.watch('./site/scss/*.scss', ['styles']);
  gulp.watch('./site/scss/setup/*.scss', ['styles']);
  gulp.watch('./site/scss/panel-style/*.scss', ['panel-styles']);
  gulp.watch('./site/scss/site-specific/*.scss', ['styles']);
  gulp.watch('./site/js/*.js', ['scripts']);
});

gulp.task('build', ['styles', 'panel-styles', 'scripts']);
gulp.task('default', ['styles', 'panel-styles', 'scripts','watch']);