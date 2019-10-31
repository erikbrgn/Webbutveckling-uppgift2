var gulp = require('gulp');
// Requires the gulp-sass plugin
var sass = require('gulp-sass');
var watch = require('gulp-watch');

var paths = {
    styles: {
        src: 'public_html/src/scss/*.scss',
        dest: 'public_html/assets/css/'
    },
    scripts: {
        src: 'public_html/src/scripts/*.js',
        dest: 'public_html/assets/scripts/'
    }
};

gulp.task('sass', function () {
    return gulp.src(paths.styles.src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(paths.styles.dest));
});

gulp.task('watch', function () {
    return gulp.watch('public_html/src/scss/**/*.scss', gulp.series('sass'));
});