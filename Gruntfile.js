module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        sourceMap: false,
        outputStyle: 'expanded',
      },
      dist: {
        files: {
          'assets/css/chooko.dev.css': 'assets/scss/chooko.scss',
          'assets/css/chooko-unresponsive.dev.css': 'assets/scss/chooko-unresponsive.scss',
        }
      }
    },

    postcss: {
      options: {
        processors: [
          require('autoprefixer')({browsers: 'last 2 versions'}),
        ]
      },
      dist: {
        src: 'assets/css/*.dev.css'
      }
    },

    csscomb: {
      dist: {
        options: {
          config: 'assets/css/csscomb.json'
        },
        files: {
          'css/chooko.dev.css': 'assets/css/chooko.dev.css',
          'css/chooko-unresponsive.dev.css': 'assets/css/chooko-unresponsive.dev.css',
        }
      }
    },

    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1
      },
      target: {
        files: {
          'css/chooko.min.css': 'css/chooko.dev.css',
          'css/chooko-unresponsive.min.css': 'css/chooko-unresponsive.dev.css',
        }
      }
    },

    clean: ['assets/css/*.css'],

    jshint: {
      files: ['Gruntfile.js', 'assets/js/chooko.js'],
      options: {
        globals: {
          jQuery: true
        }
      }
    },

    concat: {
     options: {
      separator: '\n\n',
     },
     dist: {
      src: [
        'assets/js/chooko.js',
        'assets/js/superfish.js',
      ],
      dest: 'js/chooko.dev.js',
     },
    },

    uglify: {
      build: {
        src: 'js/chooko.dev.js',
        dest: 'js/chooko.min.js'
      }
    },

    makepot: {
      target: {
        options: {
          domainPath: '/languages/',
          potFilename: 'chooko-lite.pot',
          type: 'wp-theme'
        }
      }
    },

    watch: {
        scss: {
            files: ['assets/scss/*.scss'],
            tasks: ['sass', 'postcss', 'csscomb', 'cssmin', 'clean'],
            options: {
              interrupt: true,
            },
          },
        js: {
            files: ['assets/js/*.js'],
            tasks: ['jshint', 'concat', 'uglify'],
            options: {
              interrupt: true,
            },
          },
        pot: {
            files: ['*.php', '**/*.php', '**/**/*.php'],
            tasks: ['makepot'],
            options: {
              interrupt: true,
            },
          }
    },


});

grunt.registerTask('default', ['sass', 'postcss', 'csscomb', 'cssmin', 'clean', 'jshint', 'concat', 'uglify', 'makepot']);

};
