// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

// Compile Our Sass
gulp.task('build-styles', function () {
    return gulp.src('./css/pre/style.scss')
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(gulp.dest('./css'));
});

gulp.task('build-scripts', function () {
    return gulp.src(['./js/pre/vendor/**/*.js', './js/pre/*.js'])
        .pipe(concat('sat_gallery.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./js'));
});

// Default Task
gulp.task('default', ['build-styles', 'build-scripts']);
