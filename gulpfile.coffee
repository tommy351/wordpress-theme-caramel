gulp = require 'gulp'
stylus = require 'gulp-stylus'
nib = require 'nib'
coffee = require 'gulp-coffee'
uglify = require 'gulp-uglify'
wrap = require 'gulp-wrap'
gutil = require 'gulp-util'
clean = require 'gulp-clean'
rename = require 'gulp-rename'
path = require 'path'

script = 'coffee/**/*.coffee'

gulp.task 'stylus', ->
  gulp.src 'styl/style.styl'
    .pipe stylus
      use: [nib()]
    .pipe gulp.dest './'
    .on 'error', gutil.log

gulp.task 'coffee', ->
  gulp.src script
    .pipe coffee
      bare: true
    .pipe wrap '(function($){<%= contents %>})(jQuery)'
    .pipe gulp.dest 'js/'
    .on 'error', gutil.log

gulp.task 'minify', ['coffee'], ->
  gulp.src 'js/**/!(*.min).js'
    .pipe uglify()
    .pipe rename
      suffix: '.min'
    .pipe gulp.dest 'js/'
    .on 'error', gutil.log

gulp.task 'watch', ->
  gulp.watch 'styl/**/*.styl', ['stylus']
  gulp.watch script, ['coffee']

gulp.task 'clean', ->
  gulp.src 'js/**/*.js',
      read: false
    .pipe clean()

gulp.task 'default', ['stylus', 'coffee', 'minify']