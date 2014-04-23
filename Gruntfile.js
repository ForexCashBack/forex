module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        jshint: {
            files: ['Gruntfile.js', 'web/js/**/*.js'],
            options: {
                // options here to override JSHint defaults
                globals: {
                    jQuery: true,
                    console: true,
                    module: true,
                    document: true
                }
            }
        },

        less: {
            development: {
                options: {
                    paths: ["web/css"]
                },
                files: {
                    "web/css/forex.css": "web/css/main.less"
                }
            }
        },phplint: {
            options: {
                swapPath: '/tmp'
            },
            all: ['src/**/*.php']
        },
        phpcs: {
            application: {
                dir: ['src/**/*.php']
            },
            options: {
                standard: 'Symfony2',
                errorSeverity: 0,
                extensions: 'php'
            }
        },

        watch: {
            scripts: {
                files: ['web/js/**'],
                tasks: ['clean:build', 'copy', 'jshint'],
                options: {
                    spawn: true
                }

            },
            less: {
                files: 'web/css/*.less',
                tasks: ['clean:build', 'less', 'copy'],
                options: {
                    spawn: true
                }
            },
            php: {
                files: 'src/**/*.php',
                tasks: ['phplint', 'phpcs'],
                options: {
                    spawn: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks("grunt-phplint");
    grunt.loadNpmTasks("grunt-phpcs");
};
