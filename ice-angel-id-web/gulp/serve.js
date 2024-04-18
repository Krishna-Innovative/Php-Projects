'use strict';

var gulp = require('gulp');
var browserSync = require('browser-sync');

function browserSyncInit(baseDir, files, browser) {
  browser = browser === undefined ? 'default' : browser;

  browserSync.instance = browserSync.init(files, {
    startPath: '/index.html',
    ghostMode: false,
    server: {
      baseDir: baseDir
    },
    browser: browser
  });

}

gulp.task('serve', ['watch'], function () {
  browserSyncInit([
    'app',
    '.tmp'
  ], [
    'app/*.html',
    'app/styles/**/*.css',
    '.tmp/styles/**/*.css',
    'app/scripts/**/*.js',
    'app/partials/**/*.html',
    'app/images/**/*'
  ]);
});

gulp.task('serve:dist:dev', ['build:web'], function () {
  browserSyncInit('dist');
});

gulp.task('serve:dist:release', ['release:web'], function () {
  browserSyncInit('dist');
});
