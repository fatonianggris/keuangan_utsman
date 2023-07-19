<head>
	<?php $user = $this->session->userdata('sias-finance'); ?>
	<base href="">
	<meta charset="utf-8" />
	<title>Keuangan Utsman | Sekolah Utsman</title>
	<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="sekolahutsman.sch.id" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/css/pages/fonts/dropify.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!-- Popup CSS -->
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/magnific-popup/dist/magnific-popup.css" rel="stylesheet">

	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/finance/dist/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/finance/dist/assets/media/logos/favicon.ico" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/owlcarousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/owlcarousel/dist/assets/owl.theme.default.css">
	<style>
		.g-recaptcha {
			display: inline-block;
		}
		#recaptcha_delete > div {
			margin: 0 auto .5em;
		}

		.select2-container {
			box-sizing: border-box;
			display: block;
			margin: 0;
			position: relative;
			vertical-align: middle;
		}

		.select2-container--default .select2-selection--single,
		.select2-container--default .select2-selection--multiple {
			display: flex;
			align-items: center;
			justify-content: space-between;
			border: 1px solid #E4E6EF;
			outline: none !important;
			border-radius: 0.42rem;
			height: auto;
			line-height: 0;
			padding: 0.23rem 0.42rem;
			background: #FFFFFF;
		}

		.was-validated .form-control:valid,
		.form-control.is-valid {
			border-color: #1BC5BD;
			padding-right: calc(0.5em + 0.3rem);
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%231BC5BD' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
			background-repeat: no-repeat;
			background-position: right calc(0.375em + 0.325rem) center;
			background-size: calc(0.75em + 0.65rem) calc(0.75em + 0.65rem);
		}

		.was-validated .form-control:invalid,
		.form-control.is-invalid {
			border-color: #F64E60;
			padding-right: calc(0.5em + 0.3rem);
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23F64E60' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23F64E60' stroke='none'/%3e%3c/svg%3e");
			background-repeat: no-repeat;
			background-position: right calc(0.375em + 0.325rem) center;
			background-size: calc(0.75em + 0.65rem) calc(0.75em + 0.65rem);
		}


		.blockquote {
			margin-bottom: 1rem;
			font-size: 1rem;
		}


		.select2-container--default.select2-container--disabled .select2-selection--multiple,
		.select2-container--default.select2-container--disabled .select2-selection--single {
			cursor: not-allowed;
			background-color: #f3f6f9;
			opacity: 1;
		}

		.container-xxl,
		.container-xl,
		.container-lg,
		.container-md,
		.container-sm,
		.container {
			max-width: 99%;
		}

		.dataTables_scrollBody::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
			background-color: #F5F5F5;
			border-radius: 10px;
		}

		.dataTables_scrollBody::-webkit-scrollbar {
			width: 6px;
			background-color: #F5F5F5;
		}

		.dataTables_scrollBody::-webkit-scrollbar-thumb {
			background-color: #777;
			border-radius: 10px;
		}

		.table.table-separate th:last-child,
		.table.table-separate td:last-child {
			padding-right: 5px !important;
		}

		.table.table-separate th:first-child,
		.table.table-separate td:first-child {
			padding-left: 5px !important;
		}

		.dropdown-menu>li>a,
		.dropdown-menu>.dropdown-item {
			outline: none !important;
			display: inline-block;
			flex-grow: 1;
		}

		scroller::-webkit-scrollbar {
			display: none;
		}

		.swal2-container .swal2-html-container {
			max-height: max-content;
			overflow: auto;
		}

		.form-control-lg-swal {
			height: calc(1.5em + 1.65rem + 2px);
			font-size: 1.08rem;
			line-height: 1.5;
			border-radius: 0.42rem;
		}

		.modal-file {
			position: fixed;
			top: 0;
			left: 0;
			z-index: 1070;
			display: none;
			width: 100%;
			height: 100%;
			overflow: hidden;
			outline: 0;
		}

		.dz-preview .dz-image img {
			width: 100% !important;
			height: 100% !important;
			object-fit: cover;
		}

		.border {
			border: 2px solid #adaeb4 !important;
		}
	</style>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<?php if ($user[0]->id_role_struktur == 7) { ?>
		<script>
			var OneSignal = window.OneSignal || [];
			var initConfig = {
				appId: "246685aa-0505-4c25-8fe1-be7e51500fd4",
				safari_web_id: "web.onesignal.auto.5f0d689b-f65a-4365-8770-a9853d53b981",
				notifyButton: {
					enable: true,
					size: 'medium',
					/* One of 'small', 'medium', or 'large' */
					theme: 'default',
					/* One of 'default' (red-white) or 'inverse" (white-red) */
					position: 'bottom-left',
					text: {
						'tip.state.unsubscribed': 'Kilk untuk mendapatkan notifikasi',
						'tip.state.subscribed': "Anda telah mengaktifkan notifikasi",
						'tip.state.blocked': "Anda memblokir notifikasi",
						'message.prenotify': 'Kilk untuk mendapatkan notifikasi',
						'message.action.subscribed': "Terima kasih telah menambahkan notifikasi!",
						'message.action.resubscribed': "Anda telah mengaktifkan notifikasi",
						'message.action.unsubscribed': "Anda tidak akan mendapatkan notifikasi",
						'dialog.main.title': 'KELOLA NOTIFIKASI',
						'dialog.main.button.subscribe': 'AKTIFKAN',
						'dialog.main.button.unsubscribe': 'NON-AKTIFKAN',
						'dialog.blocked.title': 'Unblock Notifikasi',
						'dialog.blocked.message': "Ikuti intruksi untuk mengaktifkan notifikasi:"
					},
				},
			};
			OneSignal.push(function() {
				OneSignal.SERVICE_WORKER_PARAM = {
					scope: '/push/onesignal/'
				};
				OneSignal.SERVICE_WORKER_PATH = 'push/onesignal/OneSignalSDKWorker.js'
				OneSignal.SERVICE_WORKER_UPDATER_PATH = 'push/onesignal/OneSignalSDKUpdaterWorker.js'
				OneSignal.init(initConfig);
			});
		</script>
	<?php } else { ?>
		<script>
			var OneSignal = window.OneSignal || [];
			var initConfig = {
				appId: "affc3d22-cafb-4334-9814-91c150a08ea2",
				safari_web_id: "web.onesignal.auto.1774e9e6-150a-4896-aace-e43262a3e2ec",
				notifyButton: {
					enable: true,
					size: 'medium',
					/* One of 'small', 'medium', or 'large' */
					theme: 'default',
					/* One of 'default' (red-white) or 'inverse" (white-red) */
					position: 'bottom-left',
					text: {
						'tip.state.unsubscribed': 'Kilk untuk mendapatkan notifikasi',
						'tip.state.subscribed': "Anda telah mengaktifkan notifikasi",
						'tip.state.blocked': "Anda memblokir notifikasi",
						'message.prenotify': 'Kilk untuk mendapatkan notifikasi',
						'message.action.subscribed': "Terima kasih telah menambahkan notifikasi!",
						'message.action.resubscribed': "Anda telah mengaktifkan notifikasi",
						'message.action.unsubscribed': "Anda tidak akan mendapatkan notifikasi",
						'dialog.main.title': 'KELOLA NOTIFIKASI',
						'dialog.main.button.subscribe': 'AKTIFKAN',
						'dialog.main.button.unsubscribe': 'NON-AKTIFKAN',
						'dialog.blocked.title': 'Unblock Notifikasi',
						'dialog.blocked.message': "Ikuti intruksi untuk mengaktifkan notifikasi:"
					},
				},
			};
			OneSignal.push(function() {
				OneSignal.SERVICE_WORKER_PARAM = {
					scope: '/push/onesignal/'
				};
				OneSignal.SERVICE_WORKER_PATH = 'push/onesignal/OneSignalSDKWorker.js'
				OneSignal.SERVICE_WORKER_UPDATER_PATH = 'push/onesignal/OneSignalSDKUpdaterWorker.js'
				OneSignal.init(initConfig);
			});
		</script>
	<?php } ?>
</head>
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/scripts.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
<script>
	var HOST_URL = "<?php echo base_url(); ?>";
</script>

<!--end::Global Theme Bundle-->
