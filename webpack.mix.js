const mix = require('laravel-mix');

mix.webpackConfig({
  resolve: {
    alias: {
      '@': __dirname + '/resources/js'
    }
  },
});

// アセットパイプライン
mix
    .js('resources/js/app.js', 'public/js')
    .copyDirectory('resources/img', 'public/img');

// `$ yarn production` のときだけバージョニング
if (mix.inProduction()) {
    mix.version();
}
