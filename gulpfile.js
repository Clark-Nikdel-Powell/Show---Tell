// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

// Compile Our Sass
gulp.task('sass', function () {
    return gulp.src('./css/pre/style.scss')
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(gulp.dest('./css'));
});

// Default Task
gulp.task('default', ['sass']);
