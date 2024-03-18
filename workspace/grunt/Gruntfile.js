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

          watch: {
            css: {
              files: ['../css/**/*.css', '../js/**/*.js'],
              tasks: ['concat:css', 'cssmin', 'uglify'],
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
    grunt.registerTask('default', ['concat', 'cssmin', 'uglify', 'watch'])

}
