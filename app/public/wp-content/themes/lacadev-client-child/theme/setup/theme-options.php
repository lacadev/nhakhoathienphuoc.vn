<?php
/**
 * Theme Options.
 *
 * Here, you can register Theme Options using the Carbon Fields library.
 *
 * @link    https://carbonfields.net/docs/containers-theme-options/
 *
 * @package LacaDevClientChild
 */

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

$optionsPage = Container::make('theme_options', __('Laca Theme', 'laca'))
	->set_page_file('app-theme-options.php')
	->set_page_menu_position(3.1)
	->add_tab(__('Branding | Thương hiệu', 'laca'), [
		Field::make('html', 'branding_intro', __('', 'laca'))
			->set_html('<div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:6px;padding:14px 16px;margin:8px 0"><p style="margin:0 0 8px;font-weight:600;color:#0369a1">🔧 Thương hiệu</p><p style="margin:0;font-size:13px;color:#374151">Thiết lập màu sắc và logo dùng chung cho toàn bộ website. Các màu và logo ở đây sẽ hiển thị đồng bộ trên mọi trang, mọi giao diện của site.</p></div>'),

		Field::make('color', 'primary_color', __('Primary color', 'laca'))
			->set_width(33.33),
		Field::make('color', 'secondary_color', __('Secondary color', 'laca'))
			->set_width(33.33),
		Field::make('color', 'bg_color', __('Background color', 'laca'))
			->set_width(33.33),

		Field::make('image', 'logo', __('Logo', 'laca'))
			->set_width(33.33),
		Field::make('image', 'logo_footer', __('Logo Footer', 'laca'))
			->set_width(33.33),
		Field::make('image', 'default_image', __('Default image | Hình ảnh mặc định', 'laca'))
			->set_width(33.33),
	])

	->add_tab(__('Contact | Liên hệ', 'laca'), [
		Field::make('html', 'contact_intro', __('', 'laca'))
			->set_html('<div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:6px;padding:14px 16px;margin:8px 0"><p style="margin:0 0 8px;font-weight:600;color:#0369a1">🔧 Liên hệ</p><p style="margin:0;font-size:13px;color:#374151">Nhập thông tin liên hệ của công ty (địa chỉ, số điện thoại, hotline, giờ làm việc, mạng xã hội). Các thông tin này sẽ tự động hiển thị ở footer và các khối liên hệ trên site.</p></div>'),

		Field::make('html', 'info', __('', 'laca'))
			->set_html('----<i> Information | Thông tin </i>----'),

		Field::make('text', 'address' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'Address | Địa chỉ'),
		Field::make('textarea', 'googlemap' . currentLanguage(), __('', 'laca'))
			->set_attribute('placeholder', 'Google map'),

		Field::make('complex', 'phone_numbers' . currentLanguage(), __('Số hotline', 'laca'))->set_width(50)
			->set_layout('tabbed-vertical')
			->add_fields([
				Field::make('text', 'name', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Tên hotline'),
				Field::make('text', 'phone', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Số điện thoại'),
			])->set_header_template('<% if (name) { %><%- name %><% } %>'),

		Field::make('complex', 'address_locations' . currentLanguage(), __('Địa điểm', 'laca'))->set_width(50)
			->set_layout('tabbed-vertical')
			->add_fields([
				Field::make('text', 'branch', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Branch | Chi nhánh'),
				Field::make('textarea', 'address', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Address | Địa chỉ'),
			])->set_header_template('<% if (branch) { %><%- branch %><% } %>'),

		Field::make('text', 'email' . currentLanguage(), __('', 'laca'))->set_width(33.33)
			->set_attribute('placeholder', 'Email'),
		Field::make('text', 'phone_number' . currentLanguage(), __('', 'laca'))->set_width(33.33)
			->set_attribute('placeholder', 'Phone number | Số điện thoại'),
		Field::make('text', 'hour_working' . currentLanguage(), __('', 'laca'))->set_width(33.33)
			->set_attribute('placeholder', 'Hour working | Giờ làm việc'),
		Field::make('html', 'socials', __('', 'laca'))
			->set_html('----<i> Socials | Mạng xã hội </i>----'),
		Field::make('text', 'facebook' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'facebook'),
		Field::make('text', 'linkedin' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'linkedin'),
		Field::make('text', 'instagram' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'instagram'),
		Field::make('text', 'tiktok' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'tiktok'),
		Field::make('text', 'youtube' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'youtube'),
		Field::make('text', 'zalo' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'zalo'),

		Field::make('html', 'footer_menu_info', __('', 'laca'))
			->set_html('----<i> Footer | Chân trang </i>----'),

		Field::make('textarea', 'company' . currentLanguage(), __('', 'laca'))
			->set_attribute('placeholder', 'Company description | Mô tả ngắn về công ty (hiển thị dưới logo ở footer)'),

		Field::make('text', 'service_footer_title' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'Service column title | Tiêu đề cột Dịch Vụ (mặc định: "Dịch Vụ")'),
		Field::make('complex', 'service_footer_items' . currentLanguage(), __('Dịch Vụ', 'laca'))->set_width(50)
			->set_layout('tabbed-vertical')
			->add_fields([
				Field::make('text', 'name', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Tên mục'),
				Field::make('text', 'url', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Đường dẫn (URL)'),
			])->set_header_template('<% if (name) { %><%- name %><% } %>'),

		Field::make('text', 'policy_footer_title' . currentLanguage(), __('', 'laca'))->set_width(50)
			->set_attribute('placeholder', 'Policy column title | Tiêu đề cột Liên Kết (mặc định: "Liên Kết")'),
		Field::make('complex', 'policy_footer_items' . currentLanguage(), __('Liên Kết', 'laca'))->set_width(50)
			->set_layout('tabbed-vertical')
			->add_fields([
				Field::make('text', 'name', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Tên mục'),
				Field::make('text', 'url', __('', 'laca'))->set_width(50)
					->set_attribute('placeholder', 'Đường dẫn (URL)'),
			])->set_header_template('<% if (name) { %><%- name %><% } %>'),
	])

	->add_tab(__('Scripts', 'laca'), [
		Field::make('html', 'scripts_intro', __('', 'laca'))
			->set_html('<div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:6px;padding:14px 16px;margin:8px 0"><p style="margin:0 0 8px;font-weight:600;color:#0369a1">🔧 Scripts</p><p style="margin:0;font-size:13px;color:#374151">Chèn mã theo dõi vào đầu (header) hoặc cuối (footer) trang, ví dụ Google Analytics, Facebook Pixel. Lưu ý: nhập sai định dạng mã có thể làm lỗi hiển thị toàn bộ website, chỉ dán mã bạn tin tưởng.</p></div>'),

		Field::make('header_scripts', 'crb_header_script', __('Header Script', 'laca')),
		Field::make('footer_scripts', 'crb_footer_script', __('Footer Script', 'laca')),
	])

	->add_tab(__('AI Translation | Dịch thuật AI', 'laca'), [
		Field::make('html', 'ai_intro', __('', 'laca'))
			->set_html('Cấu hình API Key để kích hoạt tính năng tự động dịch nội dung bằng trí tuệ nhân tạo. Bạn nên ưu tiên dùng Gemini hoặc Groq vì có gói miễn phí rất tốt.'),

		Field::make('text', 'ai_gemini_key', __('Gemini API Key', 'laca'))
			->set_help_text('Model: Gemini 1.5 Pro/Flash. Lấy tại: <a href="https://aistudio.google.com/app/apikey" target="_blank">Google AI Studio</a>'),

		Field::make('text', 'ai_groq_key', __('Groq API Key', 'laca'))
			->set_help_text('Model: Llama 3/3.1. Lấy tại: <a href="https://console.groq.com/keys" target="_blank">Groq Console</a>'),

		Field::make('text', 'ai_deepseek_key', __('DeepSeek API Key', 'laca'))
			->set_help_text('Model: DeepSeek Chat. Lấy tại: <a href="https://platform.deepseek.com/" target="_blank">DeepSeek Platform</a>'),

		Field::make('text', 'ai_openai_key', __('OpenAI API Key', 'laca'))
			->set_help_text('Model: GPT-4o, GPT-4o-mini. Lấy tại: <a href="https://platform.openai.com/" target="_blank">OpenAI Platform</a>'),

		Field::make('text', 'ai_anthropic_key', __('Anthropic API Key', 'laca'))
			->set_help_text('Model: Claude 3.5 Sonnet/Haiku. Lấy tại: <a href="https://console.anthropic.com/" target="_blank">Anthropic Console</a>'),

		Field::make('select', 'ai_default_provider', __('Bô xử lý ưu tiên', 'laca'))
			->set_options([
				'gemini' => 'Google Gemini (Khuyên dùng)',
				'groq' => 'Groq (Llama 3 - Tốc độ cực nhanh)',
				'deepseek' => 'DeepSeek (Giá rẻ/Chất lượng cao)',
				'openai' => 'OpenAI GPT',
				'anthropic' => 'Anthropic Claude',
			])
			->set_default_value('gemini'),
	])

	->add_tab(__('🛒 Block Marketplace', 'laca'), [
		Field::make('html', 'block_marketplace', __('', 'laca'))
			->set_html(static function () {
				return class_exists('\App\Settings\BlockMarketplace')
					? \App\Settings\BlockMarketplace::renderPage()
					: '<div style="background:#fef2f2;border:1px solid #fecaca;border-radius:6px;padding:14px 16px;color:#991b1b">Không tìm thấy class BlockMarketplace.</div>';
			}),
	]);

/**
 * Bảng Giá — menu riêng, quản lý danh mục dịch vụ (tab) + từng dịch vụ
 * (dịch vụ/mô tả/đơn vị/giá/bảo hành). Dùng chung toàn site — block
 * "Bảng Giá" chỉ đọc và hiển thị, không chọn nguồn. Các thông tin bổ sung
 * (cam kết, bảo hành, tư vấn, CTA...) được nhập ngay trong block, không ở đây.
 */
$pricingOptionsPage = Container::make('theme_options', __('Bảng Giá', 'laca'))
	->set_page_file('app-pricing-options.php')
	->set_page_menu_position(3.2)
	->add_tab(__('Danh mục & Dịch vụ', 'laca'), [
		Field::make('html', 'pricing_intro', __('', 'laca'))
			->set_html('<div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:6px;padding:14px 16px;margin:8px 0"><p style="margin:0 0 8px;font-weight:600;color:#0369a1">🔧 Bảng Giá</p><p style="margin:0;font-size:13px;color:#374151">Mỗi danh mục là 1 tab trên bảng giá (VD: Răng sứ thẩm mỹ). Trong mỗi danh mục, thêm từng dịch vụ với đầy đủ mô tả/đơn vị/giá/bảo hành. Dùng block "Bảng Giá" để hiển thị dữ liệu này ở bất kỳ trang nào.</p></div>'),

		Field::make('complex', 'pricing_categories', __('Danh mục dịch vụ', 'laca'))
			->set_layout('tabbed-vertical')
			->add_fields([
				Field::make('text', 'category_name', __('Tên danh mục (tab)', 'laca'))
					->set_attribute('placeholder', 'VD: Răng sứ thẩm mỹ'),
				Field::make('complex', 'category_services', __('Dịch vụ', 'laca'))
					->set_layout('tabbed-vertical')
					->add_fields([
						Field::make('text', 'service_name', __('Tên dịch vụ', 'laca'))->set_width(50),
						Field::make('text', 'service_unit', __('Đơn vị', 'laca'))->set_width(50)
							->set_attribute('placeholder', 'VD: Răng'),
						Field::make('text', 'service_desc', __('Mô tả', 'laca')),
						Field::make('text', 'service_price', __('Giá (VNĐ)', 'laca'))->set_width(50)
							->set_attribute('placeholder', 'VD: 1.500.000'),
						Field::make('text', 'service_warranty', __('Bảo hành', 'laca'))->set_width(50)
							->set_attribute('placeholder', 'VD: 5 năm'),
					])
					->set_header_template('<% if (service_name) { %><%- service_name %><% } %>'),
			])
			->set_header_template('<% if (category_name) { %><%- category_name %><% } %>'),
	]);
