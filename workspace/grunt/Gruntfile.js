module.exports = (grunt)=>{
    grunt.initConfig({
        concat: {
            options: {
              separator: '\n',
                 banner: '/* Concatenated by Grunt Project Runner */\n',
            },
            css: {
              src: '../css/**/*.css',
              dest: '../../htdocs/concat-css/style.css',
            }
          },

          cssmin: {
            css: {
              files: [{
                mergeIntoShorthands: false,
                roundingPrecision: -1,
                src: '../css/**/*.css',
                dest: '../../htdocs/minify-css/style.min.css'
              }]
            }
          },

          uglify: {
              js: {
                files:{
                  '../../htdocs/grunt-js/script.min.js':['../js/**/*.js']
                }
              }
          },

          obfuscator: {
            options: {
                banner: '// JS Obfuscated by grunt-contrib-obfuscator.\n',
                debugProtection: true,
                debugProtectionInterval: true,
            },
            js: {
                options: {
                    // options for each sub task
                },
                files: {
                    '../../htdocs/grunt-js/script.o.js': ['../js/script.js']
                }
            }
        },  

          watch: {
            css: {
              files: ['../css/**/*.css', '../js/**/*.js'],
              tasks: ['concat:css', 'cssmin', 'uglify', 'obfuscator'],
              options: {
                spawn: false,
              },
            },
        }
  
  
    })

    grunt.loadNpmTasks('grunt-contrib-concat')
    grunt.loadNpmTasks('grunt-contrib-cssmin')
    grunt.loadNpmTasks('grunt-contrib-watch')
    grunt.loadNpmTasks('grunt-contrib-uglify')
    grunt.loadNpmTasks('grunt-contrib-obfuscator');
    grunt.registerTask('default', ['concat', 'cssmin', 'uglify', 'obfuscator', 'watch'])

}
