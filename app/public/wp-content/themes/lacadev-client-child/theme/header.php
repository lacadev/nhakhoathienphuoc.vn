<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Theme header partial.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPEmergeTheme
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">

<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<link rel="apple-touch-icon" sizes="57x57" href="<?php theAsset('favicon/apple-icon-57x57.png'); ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php theAsset('favicon/apple-icon-60x60.png'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php theAsset('favicon/apple-icon-72x72.png'); ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php theAsset('favicon/apple-icon-76x76.png'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php theAsset('favicon/apple-icon-114x114.png'); ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php theAsset('favicon/apple-icon-120x120.png'); ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php theAsset('favicon/apple-icon-144x144.png'); ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php theAsset('favicon/apple-icon-152x152.png'); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php theAsset('favicon/apple-icon-180x180.png'); ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php theAsset('favicon/android-icon-192x192.png'); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php theAsset('favicon/favicon-32x32.png'); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php theAsset('favicon/favicon-96x96.png'); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php theAsset('favicon/favicon-16x16.png'); ?>">
	<link rel="manifest" href="<?php theAsset('favicon/manifest.json'); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php theAsset('favicon/ms-icon-144x144.png'); ?>">
	<meta name="theme-color" content="#ffffff">
	<?php
	$critical_css_path = get_template_directory() . '/dist/styles/critical.css';
	if (file_exists($critical_css_path)) {
		echo '<style id="critical-css">' . file_get_contents($critical_css_path) . '</style>';
	}
	?>
	<style>
		:root {
			/* Theme colors — mặc định theo bảng màu Deep Green của Nha Khoa Thiện Phước,
			   admin có thể đổi lại tại Laca Theme → Thương hiệu */
			--primary-color:
				<?php echo carbon_get_theme_option('primary_color') ?: '#0d631b'; ?>
			;
			--second-color:
				<?php echo carbon_get_theme_option('secondary_color') ?: '#2a6b2c'; ?>
			;
			--bg-color:
				<?php echo carbon_get_theme_option('bg_color') ?: '#f8faf8'; ?>
			;
		}

		/* Icon SVG inline dùng chung cho toàn bộ block — kích thước icon vẫn
		   điều khiển qua font-size ở từng nơi dùng (SVG ăn theo 1em). */
		.lcdc-icon {
			display: inline-block;
			width: 1em;
			height: 1em;
			vertical-align: middle;
			flex-shrink: 0;
		}
	</style>
</head>

<body <?php body_class(); ?>>
	<?php
	app_shim_wp_body_open();
	?>

	<!-- Skip to content link for accessibility -->
	<a class="skip-link screen-reader-text" href="#main-content">
		<?php esc_html_e('Skip to content', 'laca'); ?>
	</a>

	<?php
	if (is_home() || is_front_page()):
		echo '<h1 class="site-name screen-reader-text">' . esc_html(get_bloginfo('name')) . '</h1>';
	endif;
	?>

	<div class="wrapper">
		<?php if (!is_404()): ?>
			<header class="header" id="header">
				<div class="header__inner">

					<!-- Logo — bên trái -->
					<div class="header__logo">
						<?php
						$logo_id = carbon_get_theme_option('logo');
						$logo_url = wp_get_attachment_image_url($logo_id, 'full');
						?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo-link">
							<?php if ($logo_url): ?>
								<img src="<?php echo esc_url($logo_url); ?>" class="header__logo-img"
									alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
							<?php endif; ?>
							<span class="header__logo-text"><?php echo esc_html(get_bloginfo('name')); ?></span>
						</a>
					</div>

					<!-- Menu chính — giữa/phải -->
					<nav class="header__nav" aria-label="<?php esc_attr_e('Main menu', 'laca'); ?>">
						<?php
						wp_nav_menu([
							'theme_location' => 'main-menu',
							'menu_class' => 'header__menu-list',
							'container' => false,
							'items_wrap' => '<ul class="%2$s">%3$s</ul>',
							'walker' => new Laca_Menu_Walker(),
							'fallback_cb' => false,
						]);
						?>
					</nav>

					<!-- CTA đặt lịch -->
					<a href="#dat-lich" class="header__cta-btn">
						<?php esc_html_e('ĐẶT LỊCH NGAY', 'laca'); ?>
					</a>

					<!-- Hamburger (mobile) -->
					<div class="header__hamburger" id="btn-hamburger" aria-label="<?php esc_attr_e('Mở menu', 'laca'); ?>"
						role="button" tabindex="0" aria-expanded="false" aria-controls="header-overlay">
						<span></span>
						<span></span>
						<span></span>
					</div>

				</div>

				<!-- Mobile overlay: full menu via wp_nav_menu -->
				<div class="header__overlay" id="header-overlay" aria-hidden="true">
					<div class="header__overlay-backdrop"></div>
					<div class="header__overlay-panel">
						<button class="header__overlay-close" id="btn-overlay-close"
							aria-label="<?php esc_attr_e('Đóng menu', 'laca'); ?>">
							<span></span>
							<span></span>
						</button>
						<nav class="header__overlay-nav" aria-label="<?php esc_attr_e('Main menu mobile', 'laca'); ?>">
							<?php
							wp_nav_menu([
								'theme_location' => 'main-menu',
								'menu_class' => 'header__overlay-menu-list',
								'container' => false,
								'items_wrap' => '<ul class="%2$s">%3$s</ul>',
								'walker' => new Laca_Menu_Walker(),
							]);
							?>
						</nav>
						<a href="#dat-lich" class="header__overlay-cta">
							<?php esc_html_e('ĐẶT LỊCH NGAY', 'laca'); ?>
						</a>
					</div>
				</div>
			</header>
		<?php endif; ?>
