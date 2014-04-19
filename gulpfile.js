var gulp = require('gulp'),
  stylus = require('gulp-stylus'),
  nib = require('nib');

gulp.task('stylus', function(){
  gulp.src('styl/style.styl')
    .pipe(stylus({
      use: [nib()]
    }))
    .pipe(gulp.dest('./'));
});

gulp.task('dev', function(){
  gulp.watch('styl/**/*.styl', ['stylus']);
});

gulp.task('default', ['stylus']);