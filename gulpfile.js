const elixir = require('laravel-elixir');
require('laravel-elixir-sass-compass');

elixir.config.assetsPath = './resources/assets/';
elixir.config.publicPath = './public/assets/';

var paths = {
    destination : elixir.config.publicPath,
    source      : elixir.config.assetsPath,
    npm         : './node_modules/'
};

var fontExtensions = ['eot', 'svg', 'ttf', 'woff', 'woff2'];

elixir(function(mix) {

    fontExtensions.forEach(function(ext) {
        mix.copy(
            paths.npm + 'bootstrap/dist/fonts/glyphicons-halflings-regular.' + ext,
            paths.destination + 'fonts/glyphicons-halflings-regular.' + ext
        );
        mix.copy(
            paths.npm + 'font-awesome/fonts/fontawesome-webfont.' + ext,
            paths.destination + 'fonts/fontawesome-webfont.' + ext
        );
    });

    mix.copy(
        paths.npm + 'font-awesome/fonts/FontAwesome.otf',
        paths.destination + 'fonts/FontAwesome.otf'
    );

    mix.scripts([
        paths.npm + 'jquery/dist/jquery.min.js',

        paths.npm + 'bootstrap/dist/js/bootstrap.min.js',
        paths.npm + 'bootstrap/js/alert.js',
        paths.npm + 'jquery-countdown/dist/jquery.countdown.min.js',

        paths.source + 'plugins/datetimepicker/jquery.datetimepicker.js',
        paths.source + 'plugins/jquery-ui/jquery-ui.min.js',
        paths.source + 'plugins/autosize.min.js',

        paths.source + 'js/script.js'

    ], paths.destination + 'js/app.js');

    mix.sass([
        paths.source + 'sass/fonts.scss',

        // paths.bower + 'bootstrap/dist/css/bootstrap.min.css',
        paths.source + 'plugins/paper/bootstrap.min.css',
        // paths.bower + 'bootstrap/dist/css/bootstrap-theme.min.css',

        paths.npm + 'font-awesome/css/font-awesome.min.css',
        paths.source + 'plugins/datetimepicker/jquery.datetimepicker.css',

        paths.source + 'sass/style.scss'

    ], paths.destination + 'css/app.css');
});
