/* ===========================================================================
 Barebones Gulpfile
 ============================================================================= */

// Gulp
var gulp = require('gulp'),
    cssnano = require('cssnano'),
    cssimport = require('postcss-import'),
    svgSprite = require('gulp-svg-sprite'),
    autoprefixer = require('autoprefixer'),
    $ = require( 'gulp-load-plugins' )(),

    // Environment variable to set dev or prod
    env = (function() {
    		var env = 'dev';

    		/** Test if there was a different value from CLI to env
    			Ex: gulp styles --env=production */
    		process.argv.some(function( key ) {
    			var matches = key.match( /^\-{2}env\=([A-Za-z]+)$/ );

    			if ( matches && matches.length === 2 ) {
    				env = matches[1];
    				return true;
    			}
    		});

    		return env;
    	} ()),

    // Paths
    paths = {
        scss: 'src/sass/**/*.scss',
        css_dest: 'assets/css/',
		scripts: 'src/scripts/partials/**/*.js',
		js_dest: 'assets/js'
    },

    // JS Configurations
    jsConfig = require('./src/scripts/config.json');

    // SVG Config
    svgConfig = {
        shape: {
            dimension           : {                         // Dimension related options
                maxWidth        : 16,                     // Max. shape width
                maxHeight       : 16,                     // Max. shape height
                precision       : 2,                        // Floating point precision
                attributes      : true,                    // Width and height attributes on embedded shapes
            }
        },
        mode: {
            symbol: { // symbol mode to build the SVG
                dest: 'svg', // destination foldeer
                sprite: 'sprite.svg' //sprite name
            },
            css: {
                dest: './css/',
                layout: "vertical",
                bust: true,
                render: {
                    scss: {
                        dest: "../../src/sass/svg/_sprite.scss"
                    }
                }
            }
      },
      svg: {
        xmlDeclaration: false, // strip out the XML attribute
        doctypeDeclaration: false // don't include the !DOCTYPE declaration
      }
    };

// SVG
gulp.task('svg', function() {
    var stream = gulp.src('src/svg/*')
    .pipe(svgSprite(svgConfig));

    return stream.on("error", function(e) {
        console.error(e);
        errors = true;
    }).pipe(gulp.dest('assets'));
});

// CSS
gulp.task('styles', ['svg'], function() {

    var stream = gulp.src(paths.scss)
        .pipe($.if(env === 'dev', $.sourcemaps.init()))
        .pipe($.sass()).on("error", function(e) {
            console.error(e.toString());
        })
        .pipe($.postcss([
            autoprefixer(),
            cssimport()
        ]))
        .pipe($.if(env === 'prod', $.postcss([
            cssnano()
        ])))
        .pipe($.if(env === 'dev', $.sourcemaps.write()));

        return stream.on("error", function(e) {
            console.error(e);
        }).pipe(gulp.dest(paths.css_dest));
});

// JS: Authoring
gulp.task('scripts', function() {

    gulp.src(jsConfig.dependencies.concat(paths.scripts))
            .pipe($.expectFile({ errorOnFailure: true }, [jsConfig.dependencies, paths.scripts]))
                .on('error', function(err) {
                    console.error(err);
                })
            .pipe($.concat(jsConfig.outputFileName))
            .pipe($.if(env === 'dev', $.sourcemaps.init()))
            .pipe($.if(env === 'prod', $.uglify()))
            .pipe($.rename({suffix: '.min'}))
            .pipe($.if(env === 'dev', $.sourcemaps.write()))
            .pipe(gulp.dest(paths.js_dest));
});

// Move public dependencies to the correct directory
gulp.task('public', function() {
    gulp.src(jsConfig.public)
        .pipe($.expectFile({ errorOnFailure: true }, jsConfig.public))
            .on('error', function(err) {
                console.error(err);
            })
        .pipe($.if(env === 'prod', $.uglify()))
        .pipe(gulp.dest('assets/js/vendor'));
});

gulp.task('fonts', function() {
    gulp.src('src/components/font-awesome/fonts/**/*')
        .pipe(gulp.dest('assets/fonts'));
});

// JS Hint
gulp.task('jshint', function() {
    gulp.src('src/scripts/**/*.js')
        .pipe($.jshint())
        .pipe($.jshint.reporter( "jshint-stylish" ))
        .pipe($.jshint.reporter( "fail" ));
});

// Env to Prod
gulp.task( "envProduction", function() {
	env = 'prod';
});

gulp.task( "deploy", function() {
    var config = require('./sftp-config.json');
    
    return gulp.src([
        '*/**',
        '!node_modules',
        '!node_modules/**',
        '!src',
        '!src/**',
        '!deploy',
        '!sftp-config.json'
    ])
     .pipe($.sftp({
         host: config.host,
         user: config.user,
         pass: config.password,
         port: config.port,
         remotePath: '/wp-content/themes/behavioral-policy'
     }));
});

// Local/Dev
gulp.task('default', ['styles', 'scripts', 'public', 'fonts', 'jshint']);

// Production
gulp.task('prod', ['envProduction', 'styles', 'scripts', 'public', 'fonts']);

