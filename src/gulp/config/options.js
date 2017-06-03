const gutil = require('gulp-util')

module.exports = {
  dist: gutil.env.type === 'production',
  sass: {
    outputStyle: 'expanded'
  },
  autoPrefix: {
    cascade: false
  },
  cssClean: {
    keepSpecialComments: 0
  },
  uglify: {
    mangle: true,
    compress: {
      drop_console: true,
      drop_debugger: true
    }
  }
}
