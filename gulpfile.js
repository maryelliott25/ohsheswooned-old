// Include gulp
var gulp         = require('gulp'),
    
    autoprefixer = require('gulp-autoprefixer'),
    changed      = require('gulp-changed'),
    concat       = require('gulp-concat'),
    jshint       = require('gulp-jshint'),
    livereload   = require('gulp-livereload'),
    merge        = require('merge-stream'),
    sass         = require('gulp-sass'),
    scsslint     = require('gulp-scss-lint');

var SRC = 'src';
var DEST = 'oss';

//Copy
gulp.task('copy', function () {
    var source = ['./src/**', '!./src/assets/js/**', '!./src/assets/scss/**'];
    return gulp.src(source)
        .pipe(changed(DEST))
        .pipe(gulp.dest(DEST))
        .pipe(livereload());
});

// Lint Task
gulp.task('scripts', function() {
    var dest = DEST + '/js';

    var vendor = gulp.src(['./src/assets/js/libs/jquery-1.11.1.js', './src/assets/js/libs/*.js'])
        .pipe(changed(dest))
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(dest));

    var app = gulp.src('./src/assets/js/src/*.js')
        .pipe(changed(dest))
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(concat('app.js'))
        .pipe(gulp.dest(dest));

    return merge(vendor, app).pipe(livereload());
});

// Compile Our Sass
gulp.task('sass', function() {
    return gulp.src('./src/assets/scss/*.scss')
        .pipe(scsslint())
        .pipe(sass({
            includePaths: require('node-bourbon').includePaths
        }))
        .pipe(autoprefixer({
            browers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest(DEST))
        .pipe(livereload());
});

// Watch Files For Changes
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('./src/**/*.php', ['copy']);
    gulp.watch('./src/assets/js/**/*.js', ['scripts']);
    gulp.watch('./src/assets/scss/*.scss', ['sass']);
});

// Default Task
gulp.task('default', ['copy', 'scripts', 'sass', 'watch']);