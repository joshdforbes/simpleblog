module.exports = function(grunt) {



    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    'public/assets/css/styles.css': 'public/assets/less/styles.less'
                }
            }
        },

        concat: {
            dist: {
                src: [
                    'public/assets/js/global.js'
                ],
                dest: 'public/assets/js/build/production.js',
            }
        },

        uglify: {
            build: {
                src: 'public/assets/js/build/production.js',
                dest: 'public/assets/js/build/production.min.js'
            }
        },

        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'public/assets/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'public/assets/images/build/'
                }]
            }
        },

        watch: {
            php: {
                files: ['**/*.php'],
                options: {
                    livereload: true,
                }
            },
            scripts: {
                files: ['public/assets/js/*.js', 'public/assets/css/*.less'],
                tasks: ['concat', 'uglify', 'less'],
                options: {
                    livereload: true,
                },
            }
        }

    });

    
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('default', ['concat', 'uglify', 'imagemin', 'less', 'watch']);

};