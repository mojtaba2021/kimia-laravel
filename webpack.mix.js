const mix = require('laravel-mix');

//Admin
//CSS
mix.sass('resources/assets/admin/scss/admin.scss', 'public/assets/admin/css')

//JS
    .js('resources/assets/admin/script/admin.js', 'public/assets/admin/script')

    .copy('resources/assets/admin/script/datatables-translates', 'public/assets/admin/script/datatables-translates')
    .copy('resources/assets/admin/libs/', 'public/assets/admin/libs/')


//Site
//CSS
    .sass('resources/assets/site/scss/app.scss', 'public/assets/site/css')

//JS
    .js('resources/assets/site/script/app.js', 'public/assets/site/script')
/// images

.copy('resources/assets/site/images/', 'public/assets/site/images/')
.copy('resources/assets/site/videos/', 'public/assets/site/videos/');
// mix.copyDirectory('resources/assets/site/images/', 'public/assets/site/images/');
