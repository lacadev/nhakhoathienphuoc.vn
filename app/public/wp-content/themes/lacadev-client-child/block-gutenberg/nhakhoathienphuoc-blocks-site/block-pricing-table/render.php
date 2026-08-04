<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Pricing Table Block — render.php
 * Tab danh mục + bảng dịch vụ, dữ liệu đọc từ trang quản trị "Bảng Giá"
 * (Carbon Fields option 'pricing_categories', xem theme-options.php). Các
 * thông tin bổ sung (trust badges, CTA, ghi chú) là attributes của block.
 *
 * @package lacadev-client-child
 */

require_once __DIR__ . '/icon-render.php';

// ── Nội dung ────────────────────────────────────────────────────────────────
$section_badge = $attributes['sectionBadge'] ?? '';
$section_title = $attributes['sectionTitle'] ?? '';
$subtitle      = $attributes['subtitle']     ?? '';
$trust_badges  = $attributes['trustBadges']  ?? [];
$disclaimer    = $attributes['disclaimerText'] ?? '';
$cta_text      = $attributes['ctaText'] ?? '';
$cta_link      = $attributes['ctaLink'] ?? '';

$categories = carbon_get_theme_option( 'pricing_categories' );
$categories = is_array( $categories ) ? $categories : [];

// ── Appearance attributes ──────────────────────────────────────────────────
$bg_color   = preg_match( '/^#[0-9a-fA-F]{6}$/', $attributes['bgColor'] ?? '' )
    ? $attributes['bgColor']
    : '#ffffff';
$bg_opacity = max( 0, min( 100, intval( $attributes['bgOpacity'] ?? 100 ) ) );
$r = hexdec( substr( $bg_color, 1, 2 ) );
$g = hexdec( substr( $bg_color, 3, 2 ) );
$b = hexdec( substr( $bg_color, 5, 2 ) );
$bg_rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . ( $bg_opacity / 100 ) . ')';

// ── Unique ID per instance — KHÔNG dùng `static` (không giữ giá trị giữa các
// lần include render.php khi block xuất hiện ≥ 2 lần/trang, xem bug đã sửa ở
// block-projects-slider). wp_unique_id() dùng static bên trong hàm core thật.
$instance  = wp_unique_id();
$table_id  = 'pricing-table-' . $instance;

$wrapper_attrs = get_block_wrapper_attributes( [
    'class' => 'block-pricing-table',
    'style' => sprintf( 'background-color:%s;', esc_attr( $bg_rgba ) ),
] );
?>

<section <?php echo $wrapper_attrs; ?> id="<?php echo esc_attr( $table_id ); ?>">
    <div class="block-pricing-table__inner">

        <?php if ( $section_badge || $section_title || $subtitle ) : ?>
            <div class="block-pricing-table__header">
                <?php if ( $section_badge ) : ?>
                    <span class="block-pricing-table__badge"><?php echo esc_html( $section_badge ); ?></span>
                <?php endif; ?>
                <?php if ( $section_title ) : ?>
                    <h2 class="block-pricing-table__title"><?php echo esc_html( $section_title ); ?></h2>
                <?php endif; ?>
                <?php if ( $subtitle ) : ?>
                    <p class="block-pricing-table__subtitle"><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( empty( $categories ) ) : ?>
            <p class="block-pricing-table__empty">
                <?php esc_html_e( 'Chưa có dữ liệu bảng giá. Vào wp-admin → Bảng Giá để thêm danh mục và dịch vụ.', 'laca' ); ?>
            </p>
        <?php else : ?>

            <?php if ( count( $categories ) > 1 ) : ?>
                <div class="block-pricing-table__tabs" role="tablist">
                    <?php foreach ( $categories as $cat_index => $category ) :
                        $cat_name = $category['category_name'] ?? '';
                        if ( ! $cat_name ) continue;
                    ?>
                        <button
                            type="button"
                            role="tab"
                            class="block-pricing-table__tab<?php echo 0 === $cat_index ? ' is-active' : ''; ?>"
                            data-tab-index="<?php echo esc_attr( $cat_index ); ?>"
                            aria-selected="<?php echo 0 === $cat_index ? 'true' : 'false'; ?>"
                        ><?php echo esc_html( $cat_name ); ?></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php foreach ( $categories as $cat_index => $category ) :
                $services = $category['category_services'] ?? [];
                if ( empty( $services ) ) continue;
            ?>
                <div
                    class="block-pricing-table__panel<?php echo 0 === $cat_index ? ' is-active' : ''; ?>"
                    data-panel-index="<?php echo esc_attr( $cat_index ); ?>"
                >
                    <div class="block-pricing-table__table-wrap">
                        <table class="block-pricing-table__table">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e( 'Dịch vụ', 'laca' ); ?></th>
                                    <th><?php esc_html_e( 'Mô tả', 'laca' ); ?></th>
                                    <th><?php esc_html_e( 'Đơn vị', 'laca' ); ?></th>
                                    <th><?php esc_html_e( 'Giá (VNĐ)', 'laca' ); ?></th>
                                    <th><?php esc_html_e( 'Bảo hành', 'laca' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $services as $service ) : ?>
                                    <tr>
                                        <td class="block-pricing-table__service-name"><?php echo esc_html( $service['service_name'] ?? '' ); ?></td>
                                        <td><?php echo esc_html( $service['service_desc'] ?? '' ); ?></td>
                                        <td><?php echo esc_html( $service['service_unit'] ?? '' ); ?></td>
                                        <td class="block-pricing-table__service-price"><?php echo esc_html( $service['service_price'] ?? '' ); ?></td>
                                        <td><?php echo esc_html( $service['service_warranty'] ?? '' ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <?php if ( ! empty( $trust_badges ) ) : ?>
            <div class="block-pricing-table__badges">
                <?php foreach ( $trust_badges as $badge ) :
                    $badge_icon  = $badge['icon']        ?? null;
                    $badge_title = $badge['title']       ?? '';
                    $badge_desc  = $badge['description'] ?? '';
                    if ( ! $badge_title && ! $badge_desc ) continue;
                ?>
                    <div class="block-pricing-table__badge-item">
                        <div class="block-pricing-table__badge-icon"><?php echo lcdc_render_icon( $badge_icon ); ?></div>
                        <div class="block-pricing-table__badge-body">
                            <h5 class="block-pricing-table__badge-title"><?php echo esc_html( $badge_title ); ?></h5>
                            <p class="block-pricing-table__badge-desc"><?php echo esc_html( $badge_desc ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ( $disclaimer || $cta_text ) : ?>
            <div class="block-pricing-table__footer">
                <?php if ( $disclaimer ) : ?>
                    <p class="block-pricing-table__disclaimer"><?php echo esc_html( $disclaimer ); ?></p>
                <?php endif; ?>
                <?php if ( $cta_text ) : ?>
                    <?php if ( $cta_link ) : ?>
                        <a href="<?php echo esc_url( $cta_link ); ?>" class="block-pricing-table__cta"><?php echo esc_html( $cta_text ); ?></a>
                    <?php else : ?>
                        <button type="button" class="block-pricing-table__cta"><?php echo esc_html( $cta_text ); ?></button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
if ( count( $categories ) > 1 ) :
    $js = sprintf( '
(function () {
    function init_%1$s() {
        var root = document.getElementById("%2$s");
        if (!root) return;
        var tabs = Array.prototype.slice.call(root.querySelectorAll(".block-pricing-table__tab"));
        var panels = Array.prototype.slice.call(root.querySelectorAll(".block-pricing-table__panel"));
        if (!tabs.length || !panels.length) return;

        tabs.forEach(function (tab) {
            tab.addEventListener("click", function () {
                var index = tab.getAttribute("data-tab-index");
                tabs.forEach(function (t) {
                    var active = t.getAttribute("data-tab-index") === index;
                    t.classList.toggle("is-active", active);
                    t.setAttribute("aria-selected", active ? "true" : "false");
                });
                panels.forEach(function (p) {
                    p.classList.toggle("is-active", p.getAttribute("data-panel-index") === index);
                });
            } );
        } );
    }
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init_%1$s);
    } else {
        init_%1$s();
    }
})();',
        $instance,
        $table_id
    );
    wp_add_inline_script( 'theme-js-bundle', $js );
endif;
