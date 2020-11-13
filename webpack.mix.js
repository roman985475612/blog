const mix = require('laravel-mix');

// admin
mix.styles([
	'resources/assets/admin/bootstrap/css/bootstrap.min.css',
	'resources/assets/admin/bootstrap/css/bootstrap.min.css.map',
	'resources/assets/admin/font-awesome/4.5.0/css/font-awesome.min.css',
	'resources/assets/admin/ionicons/2.0.1/css/ionicons.min.css',
	'resources/assets/admin/plugins/iCheck/minimal/_all.css',
	'resources/assets/admin/plugins/datepicker/datepicker3.css',
	'resources/assets/admin/plugins/select2/select2.min.css',
	'resources/assets/admin/plugins/datatables/dataTables.bootstrap.css',
	'resources/assets/admin/dist/css/AdminLTE.min.css',
	'resources/assets/admin/dist/css/skins/_all-skins.min.css',
	'resources/assets/admin/dist/css/custom.css',
], 'public/css/admin.css');

mix.scripts([
	'resources/assets/admin/plugins/jQuery/jquery-2.2.3.min.js',
	'resources/assets/admin/bootstrap/js/bootstrap.min.js',
	'resources/assets/admin/plugins/select2/select2.full.min.js',
	'resources/assets/admin/plugins/datepicker/bootstrap-datepicker.js',
	'resources/assets/admin/plugins/datatables/jquery.dataTables.min.js',
	'resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js',
	'resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js',
	'resources/assets/admin/plugins/fastclick/fastclick.js',
	'resources/assets/admin/plugins/iCheck/icheck.min.js',
	'resources/assets/admin/dist/js/app.min.js',
	'resources/assets/admin/dist/js/demo.js',
	'resources/assets/admin/dist/js/custom.js',
], 'public/js/admin.js');

mix.copy('resources/assets/admin/bootstrap/fonts', 'public/fonts');
mix.copy('resources/assets/admin/dist/fonts', 'public/fonts');
mix.copy('resources/assets/admin/dist/img', 'public/img');
mix.copy('resources/assets/admin/plugins/iCheck/minimal/blue.png', 'public/css');

// front
mix.styles([
	'resources/assets/front/css/bootstrap.min.css',
    'resources/assets/front/css/font-awesome.min.css',
    'resources/assets/front/css/animate.min.css',
    'resources/assets/front/css/owl.carousel.css',
    'resources/assets/front/css/owl.theme.css',
    'resources/assets/front/css/owl.transitions.css',
    'resources/assets/front/css/style.css',
    'resources/assets/front/css/responsive.css',
], 'public/css/front.css')

mix.scripts([
	'resources/assets/front/js/jquery-1.11.3.min.js',
	'resources/assets/front/js/bootstrap.min.js',
	'resources/assets/front/js/owl.carousel.min.js',
	'resources/assets/front/js/jquery.stickit.min.js',
	'resources/assets/front/js/menu.js',
	'resources/assets/front/js/scripts.js',
], 'public/js/front.js')

mix.copy('resources/assets/front/fonts', 'public/fonts')
mix.copy('resources/assets/front/images', 'public/images')