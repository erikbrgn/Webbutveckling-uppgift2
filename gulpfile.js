var gulp = require('gulp');
// Requires the gulp-sass plugin
var sass = require('gulp-sass');
var watch = require('gulp-watch');

var paths = {
    styles: {
        src: 'src/scss/*.scss',
        dest: 'assets/css/'
    },
    scripts: {
        src: 'src/scripts/*.js',
        dest: 'assets/scripts/'
    }
};

gulp.task('sass', function () {
    return gulp.src(paths.styles.src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(paths.styles.dest));
});

gulp.task('watch', function () {
    gulp.watch('src/scss/**/*.scss', ['sass']);
});