'use strict';

var gulp = require('gulp');
var path = require('path');
var androidBuildTools = require('./android-build-tools.js');
var keystoreConfig = require('../apk-sign.config.json');
var $ = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'del']
});

gulp.task('clean:phonegap', function (cb) {
  $.del([
    'phonegap-project/www',
    'phonegap-project/plugins/*.json'
  ], { force: true }, cb);
});

gulp.task('clean:phonegap:android', function (cb) {
  $.del('phonegap-project/platforms/android', cb);
});

gulp.task('phonegap:copy-files-except-index', function () {
  return gulp.src('dist/**/*')
    .pipe(gulp.dest('phonegap-project/www'));
});

gulp.task('phonegap:copy-index', function () {
  return gulp.src('dist/index.html')
    .pipe($.replace('<!-- inject:cordova --><!-- endinject -->', '<script src="cordova.js"></script>'))
    .pipe(gulp.dest('phonegap-project/www'));
});

gulp.task('phonegap:copy-files', $.sequence(
  'phonegap:copy-files-except-index',
  'phonegap:copy-index'
));

gulp.task('phonegap:copy-extra-settings', function () {
	return gulp.src('phonegap-project/*.gradle')
	    .pipe(gulp.dest('phonegap-project/platforms/android'));
	});


gulp.task('phonegap:add-platform:android', $.shell.task(
		'cordova -d platform add android',
		  { cwd: 'phonegap-project' }
		));

gulp.task('phonegap:add-platform:ios', $.shell.task(
		'cordova -d platform add ios@4.0.x --usegit',
		  { cwd: 'phonegap-project' }
		));

gulp.task('run:ios', $.sequence(
  'build:web',
  'phonegap:copy-files',
  'phonegap:add-platform:ios',
  'phonegap:run:ios'
));

gulp.task('run:android', $.sequence(
  'build:web',
  'phonegap:copy-files',
  'phonegap:add-platform:android',
  'phonegap:run:android'
));

gulp.task('phonegap:execute-build:android:release', $.shell.task(
  'cordova build android --release --verbose',
  { cwd: 'phonegap-project' }
));

gulp.task('phonegap:execute-build:ios:release', $.shell.task(
  'cordova build ios --release --verbose',
  { cwd: 'phonegap-project' }
));

gulp.task('phonegap:run:android', $.shell.task(
  'cordova run android --verbose',
  { cwd: 'phonegap-project' }
));

gulp.task('phonegap:run:ios', $.shell.task(
  'cordova run ios --verbose',
  { cwd: 'phonegap-project' }
));

gulp.task('sign-apk', function () {
  var buildDir = 'phonegap-project/platforms';
  var keystorePath = path.relative(buildDir, keystoreConfig.keystore);
  var zipalign = path.join(androidBuildTools.latest, 'zipalign');

  return gulp.src(buildDir + '/*_unsigned.apk')
    .pipe($.shell(
      [
        'jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore ' + keystorePath + ' -storepass ' + keystoreConfig.password + ' -keypass ' + keystoreConfig.alias.password + ' -signedjar <%= signedUnaligned(file.path) %> <%= file.path %> ' + keystoreConfig.alias.name,
        'jarsigner -verify -verbose -certs <%= signedUnaligned(file.path) %>',
        zipalign + ' -f -v 4 <%= signedUnaligned(file.path) %> <%= final(file.path) %>',
        'rm <%= signedUnaligned(file.path) %>'
      ],
      {
        templateData: {
          signedUnaligned: function (s) {
            return s.replace(/_unsigned\.apk/, '_signed_unaligned.apk');
          },
          final: function (s) {
            return s.replace(/_unsigned\.apk/, '.apk');
          }
        },
        cwd: buildDir
      }
    ));
});

gulp.task('copy:apk', function() {
    var antBuildDir = 'phonegap-project/platforms/android/build/outputs/apk/';
    return gulp.src(antBuildDir + '/*-unsigned.apk')
        .pipe($.rename('iCEAngelID_release_unsigned.apk'))
        .pipe(gulp.dest('phonegap-project/platforms'));
});

gulp.task('add:platforms', $.sequence(
		  'phonegap:add-platform:ios',
		  'phonegap:add-platform:android'
));

gulp.task('release:phonegap', $.sequence(
  ['clean:phonegap', 'release:web'],
  'phonegap:copy-files',
  'phonegap:execute-build:ios:release',
  'phonegap:execute-build:android:release',
  'copy:apk',
  'sign-apk'
));

