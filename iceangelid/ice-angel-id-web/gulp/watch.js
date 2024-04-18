'use strict';

var gulp = require('gulp');

gulp.task('watch', ['wiredep', 'styles'], function () {
  gulp.watch('app/styles/**/*.{scss,less}', ['styles']);
  gulp.watch('app/scripts/**/*.js', ['scripts']);
  gulp.watch('app/images/**/*', ['images']);
  gulp.watch('bower.json', ['wiredep']);
});
