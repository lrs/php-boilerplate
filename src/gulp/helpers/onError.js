const notify = require('gulp-notify')

module.exports = function(err) {
  notify.onError({
    title:    "Gulp: <%= error.title %>",
    subtitle: "Failure!",
    message:  "Error: <%= error.message %>",
    sound:    "Beep"
  })(err)

  // Have to emit 'end' in Gulp task otherwise Gulp pipe will not continue.
  this.emit && this.emit('end')
}
