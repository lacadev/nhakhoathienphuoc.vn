<?php

/**
 * Theme footer partial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPEmergeTheme
 */

/**
 * Icon SVG inline dùng riêng cho footer.php — không phụ thuộc font ngoài
 * (Material Symbols qua Google Fonts từng bị lỗi không tải được, chỉ hiện
 * chữ thô thay vì icon). Chỉ định nghĩa đúng icon footer cần dùng.
 */
if (!function_exists('nkt_footer_icon')) {
	function nkt_footer_icon(string $name): string
	{
		$icons = [
			'location_on' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle>',
			'call'        => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>',
			'mail'        => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22 6 12 13 2 6"></polyline>',
			'schedule'    => '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>',
			'thumb_up'    => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>',
			'play_circle' => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>',
			'chat'        => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>',
		];

		if (!isset($icons[$name])) {
			return '';
		}

		return '<svg class="lcdc-icon" width="1em" height="1em" style="width:1em;height:1em;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $icons[$name] . '</svg>';
	}
}

$footer_company     = getOption('company');
$footer_phones      = getOption('phone_numbers');
$footer_addresses   = getOption('address_locations');
$footer_email       = getOption('email');
$footer_hours       = getOption('hour_working');
$footer_service_title = getOption('service_footer_title') ?: __('Dịch Vụ', 'laca');
$footer_service_items = getOption('service_footer_items');
$footer_policy_title  = getOption('policy_footer_title') ?: __('Liên Kết', 'laca');
$footer_policy_items  = getOption('policy_footer_items');

$footer_first_phone = '';
if (!empty($footer_phones) && is_array($footer_phones)) {
	foreach ($footer_phones as $p) {
		if (!empty($p['phone'])) {
			$footer_first_phone = $p['phone'];
			break;
		}
	}
}
?>
<footer class="footer" role="contentinfo" data-aos="fade-up">
	<div class="footer__main">
		<div class="container">
			<div class="footer__grid">

				<!-- Logo + mô tả + social -->
				<div class="footer__col footer__col--brand">
					<div class="footer__brand">
						<?php
						$logo_footer = getOption('logo_footer');
						$logo_footer_url = wp_get_attachment_image_url($logo_footer, 'full');
						if ($logo_footer_url):
							?>
							<img src="<?php echo esc_url($logo_footer_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="footer__logo-img">
						<?php endif; ?>
						<span class="footer__brand-name"><?php echo esc_html(get_bloginfo('name')); ?></span>
					</div>

					<?php if ($footer_company): ?>
						<p class="footer__desc"><?php echo esc_html($footer_company); ?></p>
					<?php endif; ?>

					<div class="footer__socials">
						<a href="#" class="footer__social-link" aria-label="Facebook"><?php echo nkt_footer_icon('thumb_up'); ?></a>
						<a href="#" class="footer__social-link" aria-label="Youtube"><?php echo nkt_footer_icon('play_circle'); ?></a>
						<a href="#" class="footer__social-link" aria-label="Zalo"><?php echo nkt_footer_icon('chat'); ?></a>
					</div>
				</div>

				<!-- Dịch Vụ -->
				<?php if (!empty($footer_service_items)): ?>
					<div class="footer__col">
						<h3 class="footer__title"><?php echo esc_html($footer_service_title); ?></h3>
						<ul class="footer__menu-list">
							<?php foreach ($footer_service_items as $item): ?>
								<li class="footer__menu-item">
									<a href="<?php echo esc_url($item['url'] ?? '#'); ?>" class="footer__menu-link"><?php echo esc_html($item['name'] ?? ''); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<!-- Liên Kết -->
				<?php if (!empty($footer_policy_items)): ?>
					<div class="footer__col">
						<h3 class="footer__title"><?php echo esc_html($footer_policy_title); ?></h3>
						<ul class="footer__menu-list">
							<?php foreach ($footer_policy_items as $item): ?>
								<li class="footer__menu-item">
									<a href="<?php echo esc_url($item['url'] ?? '#'); ?>" class="footer__menu-link"><?php echo esc_html($item['name'] ?? ''); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<!-- Liên Hệ -->
				<div class="footer__col">
					<h3 class="footer__title"><?php esc_html_e('Liên Hệ', 'laca'); ?></h3>
					<ul class="footer__contact-list">
						<?php if (!empty($footer_addresses) && is_array($footer_addresses)): ?>
							<?php foreach ($footer_addresses as $addr): ?>
								<?php if (!empty($addr['address'])): ?>
									<li class="footer__contact-item">
										<?php echo nkt_footer_icon('location_on'); ?>
										<span><?php echo nl2br(esc_html($addr['address'])); ?></span>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if ($footer_first_phone): ?>
							<li class="footer__contact-item">
								<?php echo nkt_footer_icon('call'); ?>
								<a href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $footer_first_phone)); ?>"><?php echo esc_html($footer_first_phone); ?></a>
							</li>
						<?php endif; ?>

						<?php if ($footer_email): ?>
							<li class="footer__contact-item">
								<?php echo nkt_footer_icon('mail'); ?>
								<a href="mailto:<?php echo esc_attr($footer_email); ?>"><?php echo esc_html($footer_email); ?></a>
							</li>
						<?php endif; ?>

						<?php if ($footer_hours): ?>
							<li class="footer__contact-item">
								<?php echo nkt_footer_icon('schedule'); ?>
								<span><?php echo esc_html($footer_hours); ?></span>
							</li>
						<?php endif; ?>
					</ul>
				</div>

			</div>
			<!-- END footer__grid -->

			<div class="footer__bottom">
				<p class="footer__copyright">
					&copy; <?php echo esc_html(date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>. <?php esc_html_e('Tất cả quyền được bảo lưu.', 'laca'); ?>
				</p>
			</div>

		</div>
	</div>
	<!-- END footer__main -->
</footer>
<!-- footer end -->

<!-- FAB gọi nhanh -->
<?php if ($footer_first_phone): ?>
	<a class="footer__fab" href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $footer_first_phone)); ?>" aria-label="<?php esc_attr_e('Gọi ngay', 'laca'); ?>">
		<?php echo nkt_footer_icon('call'); ?>
	</a>
<?php endif; ?>

</div>
<!-- container-wrapper end -->

<?php wp_footer(); ?>
</body>

</html>
