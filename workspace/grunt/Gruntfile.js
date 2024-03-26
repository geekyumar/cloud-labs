module.exports = (grunt)=>{
    grunt.initConfig({
        concat: {
            options: {
              separator: '\n',
                 banner: '/* Concatenated by Cloud Labs */\n',
            },

            customjs: {
              src: '../js/*.js',
              dest: '../../htdocs/grunt-js/common.js',
            },

            appjs: {
              src: '../js/app/*.js',
              dest: '../../htdocs/grunt-js/app.js',
            }
          },

          cssmin: {
            css: {
                files: [
                  {
                    expand: true,
                    cwd: '../css/',
                    src: ['*.css'],
                   //TODO: change the location of the css file below properly before execution.
                   dest: '../../htdocs/grunt-css/',
                    ext: '.css'
                  }
                ]

              // files: [{
              //   mergeIntoShorthands: false,
              //   roundingPrecision: -1,
              //   src: '../css/**/*.css',
              //   dest: '../../htdocs/grunt-css/style.min.css'
              // }]
            }
          },

          // uglify: {
          //     js: {
          //       files:{
          //         '../../htdocs/grunt-js/app.min.js':['../js/**/*.js']
          //       }
          //     }
          // },

          obfuscator: {
            options: {
                banner: '// JS Obfuscated by Cloud Labs for Increased Security.\n',
                debugProtection: true,
                debugProtectionInterval: true,
            },
            customjs: {
                options: {
                    // options for each sub task
                },
                files: {
                    '../../htdocs/grunt-js/common.o.js': ['../../htdocs/grunt-js/common.js'],
                }
            },
            
            appjs: {
              options: {
                  // options for each sub task
              },
              files: {
                  '../../htdocs/grunt-js/app.o.js': ['../../htdocs/grunt-js/app.js'],
              }
          },
        },  

          watch: {
            css: {
              files: ['../css/**/*.css', '../js/**/*.js'],
              tasks: ['concat', 'concat:appjs', 'cssmin:css', 'obfuscator:appjs'],
              options: {
                spawn: false,
              },
            },
        }
  
  
    })

    grunt.loadNpmTasks('grunt-contrib-concat')
    grunt.loadNpmTasks('grunt-contrib-cssmin')
    grunt.loadNpmTasks('grunt-contrib-watch')
    // grunt.loadNpmTasks('grunt-contrib-uglify')
    grunt.loadNpmTasks('grunt-contrib-obfuscator');
    grunt.registerTask('default', ['concat', 'cssmin', 'obfuscator:appjs', 'watch'])
    grunt.registerTask('obfuscate-customjs', 'obfuscator:customjs')

}
