/* gessoBroswerSync.js
   1. Place this in the Gesso theme's task/register folder
   2. Be sure to add this task to your default Grunt task, insert BEFORE the default watch task
*/

module.exports = function (grunt) {
  grunt.registerTask('gessoBrowserSync', [
    'browserSync'
  ]);
};
