'use strict';

var gulp = require('gulp');
var clean = require('gulp-clean');
require('require-dir')('./gulp');

gulp.task('fonts', function() {
    return gulp.src(['app/bower_components/font-awesome/fonts/fontawesome-webfont.*',
			         'app/fonts/glyphicons*',
			         'app/fonts/iceangel*',
			         'app/fonts/roboto*'
    				])
            .pipe(gulp.dest('dist/fonts/'));
});

gulp.task('clean', function(){
  return gulp.src(['dist/*'], {read:false})
  .pipe(clean());
});

gulp.task('default', ['serve']);
