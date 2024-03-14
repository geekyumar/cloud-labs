module.exports = (grunt)=>{
    grunt.initConfig({
        concat: {
            options: {
              separator: '\n',
                 banner: '/* Concatenated by Grunt Project Runner */\n',
            },
            css: {
              src: 'css/*.css',
              dest: '../../htdocs/concat-css/style.css',
            }
          },

          cssmin: {
            css: {
              files: [{
                mergeIntoShorthands: false,
                roundingPrecision: -1,
                src: 'css/*.css',
                dest: '../../htdocs/minify-css/style.min.css'
              }]
            }
          },

          watch: {
            css: {
              files: ['css/**/*.css'],
              tasks: ['concat:css', 'cssmin'],
              options: {
                spawn: false,
              },
            },
        }
  
  
    })

    grunt.loadNpmTasks('grunt-contrib-concat')
    grunt.loadNpmTasks('grunt-contrib-cssmin')
    grunt.loadNpmTasks('grunt-contrib-watch')
    grunt.registerTask('default', ['concat', 'cssmin', 'watch'])

}
