/* browserSync.js
   1. Place this in the Gesso theme's task/config folder
   2. Be sure to update the localDev variable
*/

module.exports = function(grunt) {
    var paths = {
        localDev: "localhost:8080", // Set this to your site's localhost
        js: ['<%= pkg.themePath %>/js/**/*.js'],
        html: ['<%= pkg.themePath %>/**/*.{html,php}', '<%= pkg.themePath %>/pattern-lab/source/**/*.json'],
        twig: ['<%= pkg.themePath %>/**/*.twig'],
        images: ['<%= pkg.themePath %>/images/**/*.{png,jpg,jpeg,gif,webp,svg}'],
        css: ['<%= pkg.themePath %>/css/**/*.css'],
        sass: ['<%= pkg.themePath %>/sass/**/*.css']
    };
    grunt.config.merge({
        browserSync: {
            files: [paths.css, paths.twig, paths.html, paths.js, paths.sass],
            options: {
                minify: false,
                notify: false,
                open: true,
                proxy: paths.localDev,
                reloadDelay: 100,
                watchTask: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-browser-sync');
};
