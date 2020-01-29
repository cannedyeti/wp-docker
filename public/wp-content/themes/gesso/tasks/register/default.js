module.exports = function (grunt) {
  grunt.registerTask('default', [
    'gessoBuild',
    'gessoBrowserSync',
    'gessoWatch'
  ]);
};
