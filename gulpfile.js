const gulp         = require('gulp')
const plumber      = require('gulp-plumber')
const concat       = require('gulp-concat')
const replace      = require('gulp-replace')
const runSeq       = require('run-sequence')
const gulpIf       = require('gulp-if')
const sass         = require('gulp-sass')
const autoPrefixer = require('gulp-autoprefixer')
const cssClean     = require('gulp-clean-css')
const browserify   = require('browserify')
const tsify        = require('tsify')
const source       = require('vinyl-source-stream')
const babel        = require('gulp-babel')
const uglify       = require('gulp-uglify')
const imageMin     = require('gulp-imagemin')
const maps         = require('gulp-sourcemaps')
const csslint      = require('gulp-csslint')
const eslint       = require('gulp-eslint')
const del          = require('del')
const gutil        = require('gulp-util')

const opts         = require('./src/gulp/config/options')
const jsConcat     = require('./src/gulp/config/jsConcat')
const onError      = require('./src/gulp/helpers/onError')

// Preprocess and optionally minimize ./src/sass/main.scss -> ./public/assets/css
gulp.task('sass', () => {
  return gulp.src('./src/sass/main.scss')
    .pipe(plumber({ errorHandler: onError }))
    .pipe(
      gulpIf(
        !opts.dist,
        maps.init()
      )
    )
    .pipe(sass(opts.sass))
    .pipe(autoPrefixer(opts.autoPrefix))
    .pipe(
      gulpIf(
        opts.dist,
        cssClean(opts.cssClean)
      )
    )
    .pipe(
      gulpIf(
        !opts.dist,
        maps.write('../maps')
      )
    )
    .pipe(gulp.dest('./public/assets/css/'))
})

// Concat and optionally minify required js files to  -> ./public/assets/js
gulp.task('js', () => {
  return gulp.src(jsConcat)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(
      gulpIf(
        !opts.dist,
        maps.init()
      )
    )
    .pipe(concat('main.js'))
    .pipe(replace(/\t/g, '  '))
    .pipe(
      gulpIf(
        opts.dist,
        uglify(opts.uglify)
      )
    )
    .pipe(
      gulpIf(
        !opts.dist,
        maps.write('../maps')
      )
    )
    .pipe(gulp.dest('./public/assets/js/'))
})

// Compile typescript files to JS.
gulp.task('ts', () => {
  return browserify({
    basedir: '.',
    debug: false,
    entries: './src/ts/index.ts',
    cache: {},
    packageCache: {}
  })
  .plugin(tsify)
  .bundle()
  .on('error', onError) // Browserify method 'on' to handle bundle errors.
  .pipe(plumber({ errorHandler: onError }))
  .pipe(source('typescript.js'))
  .pipe(gulp.dest('./src/temp/'))
})

// Clear Twig cache
gulp.task('clear', () => {
  return del('./storage/cache/twig/**/*')
    .then(() => {
      gutil.log('Twig cache cleared.')
    })
    .catch (ex => {
      gutil.log(`An error occured clearing Twig cache: ${ex.message}`)
    })
})

// Watch for changes in ./src or ./app/views
gulp.task('watches', () => {
  gulp.watch('./src/sass/**/*.scss', ['sass'])
  gulp.watch('./src/ts/**/*.ts', () => { runSeq('ts', 'js') })
  gulp.watch('./app/views/**/*.twig', ['clear'])
})

// Copy static files
// files
gulp.task('static-files', () => {
  return gulp.src(['./src/static/files/*.*', './src/static/files/.*', '!./src/static/files/*.exclude.*'])
    .pipe(plumber({ errorHandler: onError }))
    .pipe(gulp.dest('./public/'))
})
// fonts
gulp.task('static-fonts', () => {
  return gulp.src('./vendor/bower_components/font-awesome/fonts/*.*')
    .pipe(plumber({ errorHandler: onError }))
    .pipe(gulp.dest('./public/assets/fonts/'))
})
// img
gulp.task('static-images', () => {
  return gulp.src(['./src/static/img/*.*', '!./src/static/img/*.exclude.*'])
    .pipe(plumber({ errorHandler: onError }))
    .pipe(imageMin())
    .pipe(gulp.dest('./public/assets/img/'))
})
// js
gulp.task('static-js', () => {
  return gulp.src(['./src/static/js/*.js', '!./src/static/js/*.exclude.*'])
    .pipe(plumber({ errorHandler: onError }))
    .pipe(babel())
    .pipe(uglify(opts.uglify))
    .pipe(gulp.dest('./public/assets/js/'))
})
// combine
gulp.task('statics', () => {
  return runSeq(
    'static-files',
    'static-js',
    'static-images',
    'static-fonts'
    )
})

// Optional checks.
// Lint CSS
gulp.task('csslint', () => {
  return gulp.src('./public/assets/css/*.css')
  .pipe(csslint('.csslintrc'))
  .pipe(csslint.formatter())
})

// Lint JS
const isFixed = file => {
  // Has ESLint fixed the file contents?
  return file.eslint != null && file.eslint.fixed
}

gulp.task('eslint', () => {
  return gulp.src('./public/assets/js/**/*.js')
  .pipe(eslint('.eslintrc.json', { fix: true }))
	.pipe(eslint.format())
  // if fixed, write the file to dest
	.pipe(
    gulpIf(
      isFixed,
      gulp.dest('./public/assets/js')
    )
  )
})
gulp.task('checks', ['csslint', 'eslint'], () => {})

// Default tasks
if (opts.dist) {
  gulp.task('default', () => {
    return runSeq(
      ['statics', 'clear', 'sass', 'ts'],
      'js',
      'clear'
    )
  })
} else {
  gulp.task('default', () => {
    return runSeq(
      ['sass', 'ts'],
      'js',
      'clear',
      'watches'
    )})
}
