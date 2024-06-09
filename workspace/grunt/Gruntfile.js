module.exports = (grunt)=>{
    grunt.initConfig({
        concat: {
            options: {
              separator: '\n',
                 banner: '/* Concatenated by Cloud Labs */\n',
            },

            appjs: {
              src: '../js/**/*.js',
              dest: '../../htdocs/js/app.js',
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
      
            appjs: {
              options: {
                  // options for each sub task
              },
              files: {
                  '../../htdocs/js/app.o.js': ['../../htdocs/js/app.js'],
              }
          },
        },  

          watch: {
            css: {
              files: ['../js/**/*.js'],
              tasks: ['concat', 'obfuscator'],
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
    grunt.registerTask('default', ['concat', 'obfuscator', 'watch'])

}
