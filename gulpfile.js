'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
  return gulp.src('./src/scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./public/'));
});

gulp.task('watch', function () {
  gulp.watch('./src/scss/*.scss', ['sass']);
});

gulp.task('default', ['watch']);