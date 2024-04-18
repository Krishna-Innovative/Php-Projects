'use strict';

var gulp = require('gulp');

gulp.task('wiredep', function () {
  var wiredep = require('wiredep').stream;

  return gulp.src('app/*.html')
    .pipe(wiredep({
      directory: 'app/bower_components',
      exclude: []
    }))
    .pipe(gulp.dest('app'));
});
