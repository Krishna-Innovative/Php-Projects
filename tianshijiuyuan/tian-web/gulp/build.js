'use strict';

var gulp = require('gulp');
var argv = require('yargs').argv;
var rename = require('gulp-rename');

var $ = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'main-bower-files', 'uglify-save-license', 'del']
});

function handleError(err) {
  console.error(err.toString());
  this.emit('end');
}

gulp.task('styles:sass', function () {
  return gulp.src('app/styles/*.scss')
    .pipe($.sass())
    .on('error', handleError)
    .pipe($.autoprefixer(['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera', 'Android']))
    .pipe(gulp.dest('.tmp/styles'))
    .pipe($.size());
});

gulp.task('styles:less', function () {
  return gulp.src('app/styles/main.less')
    .pipe($.less())
    .on('error', handleError)
    .pipe($.autoprefixer(['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera', 'Android']))
    .pipe(gulp.dest('.tmp/styles'))
    .pipe($.size());
});

gulp.task('styles', ['styles:sass', 'styles:less']);

gulp.task('scripts', function () {
  return gulp.src('app/scripts/**/*.js')
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'))
    .pipe($.size());
});

gulp.task('languages', function () {
  return gulp.src('app/languages/**/*')
    .pipe(gulp.dest('dist/languages'))
    .pipe($.size());
});

gulp.task('partials', function () {
  return gulp.src('app/partials/**/*.html')
    .pipe($.minifyHtml({
      empty: true,
      spare: true,
      quotes: true
    }))
    .pipe($.ngHtml2js({
      moduleName: 'iaApp',
      prefix: 'partials/'
    }))
    .pipe(gulp.dest('.tmp/partials'))
    .pipe($.size());
});

gulp.task('images:copy', function () {
  return gulp.src('app/images/*')
    .pipe(gulp.dest('dist/images'))
    .pipe($.size());
});

gulp.task('images:optimize', function () {
  return gulp.src('app/images/*')
    .pipe($.imagemin({
      optimizationLevel: 3,
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest('dist/images'))
    .pipe($.size());
});

gulp.task('html:dev', ['styles', 'scripts', 'partials', 'languages', 'wiredep'], function () {
  var assets;

  return gulp.src('app/*.html')
    .pipe($.inject(gulp.src('.tmp/partials/**/*.js'), {
      read: false,
      starttag: '<!-- inject:partials -->',
      addRootSlash: false,
      addPrefix: '../'
    }))
    .pipe(assets = $.useref.assets())
    .pipe(assets.restore())
    .pipe($.useref())
    .pipe(gulp.dest('dist'))
    .pipe($.size());
});

gulp.task('html:release', ['styles', 'scripts', 'partials', 'languages', 'wiredep'], function () {
  var jsFilter = $.filter('app/scripts/**/*.js');
  var allJsFilter = $.filter('**/*.js');
  var cssFilter = $.filter('**/*.css');
  var assets;

  return gulp.src('app/*.html')
    .pipe($.inject(gulp.src('.tmp/partials/**/*.js'), {
      read: false,
      starttag: '<!-- inject:partials -->',
      addRootSlash: false,
      addPrefix: '../'
    }))
    .pipe(assets = $.useref.assets())
    .pipe($.rev())
    .pipe(jsFilter)
    .pipe($.ngAnnotate({
      add: true,
      remove: true,
      single_quotes: true
    }))
    .pipe(jsFilter.restore())
    .pipe(allJsFilter)
    .pipe($.ngAnnotate({
      add: true,
      single_quotes: true
    }))
    .pipe($.uglify({preserveComments: $.uglifySaveLicense}))
    .pipe(allJsFilter.restore())
    .pipe(cssFilter)
    .pipe($.csso())
    .pipe(cssFilter.restore())
    .pipe(assets.restore())
    .pipe($.useref())
    .pipe($.revReplace())
    .pipe(gulp.dest('dist'))
    .pipe($.size());
});

gulp.task('images', function () {
  return gulp.src('app/images/*')
    .pipe($.imagemin({
      optimizationLevel: 3,
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest('dist/images'))
    .pipe($.size());
});

gulp.task('fonts', function () {
  var sources = $.mainBowerFiles();
  sources.push('app/fonts/**/*');

  return gulp.src(sources)
    .pipe($.filter('**/*.{eot,svg,ttf,woff,woff2}'))
    .pipe($.flatten())
    .pipe(gulp.dest('dist/fonts'))
    .pipe($.size());
});

gulp.task('webfiles', function () {
  return gulp.src(['app/favicon.ico', 'app/robots.txt', 'app/sitemap.xml', 'app/.htaccess'])
    .pipe(gulp.dest('dist'))
    .pipe($.size());
});

gulp.task('resources', function () {
  return gulp.src(['app/res/**/*'])
    .pipe(gulp.dest('dist/res'))
    .pipe($.size());
});

gulp.task('manifest', function(){
  return gulp.src(['dist/**/*'])
    .pipe($.appcache({
      hash: true,
      preferOnline: true,
      network: ['http://*', 'https://*', '*'],
      filename: 'app.manifest',
      exclude: 'app.manifest'
    }))
    .pipe(gulp.dest('dist'));
});

gulp.task('clean:cache', function (cb) {
  return $.cache.clearAll(cb);
});

gulp.task('clean:web', function (cb) {
  $.del(['.tmp', 'dist'], cb);
});

gulp.task('build:web', $.sequence(
  'clean:web',
  ['html:dev', 'images:copy', 'fonts', 'languages', 'webfiles', 'resources']
));

gulp.task('release:web', $.sequence(
  'clean:web',
  ['html:release', 'images:optimize', 'fonts', 'languages', 'webfiles', 'resources']
));

gulp.task('config',function () {
  return gulp.src('app/config.' + argv.target + '.js')
             .pipe(rename('config.js'))
             .pipe(gulp.dest('app/'));
});
