module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            dist: {
                src: [
                    'public/js/libs/*.js',
                    'public/js/global.js'
                ],
                dest: 'public/assets/js/build/production.js',
            }
        }

    });

    
    grunt.loadNpmTasks('grunt-contrib-concat');

   
    grunt.registerTask('default', ['concat']);

};