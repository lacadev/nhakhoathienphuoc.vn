import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import {
	PanelBody,
	PanelRow,
	TextControl,
	TextareaControl,
	RangeControl,
	ColorPicker,
	Button,
	ExternalLink,
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { useInserterPreview, BlockPreviewMock } from '../../utils/preview';
import { IconInput } from '../../utils/icon-input';

export default function Edit( { attributes, setAttributes } ) {
	const isPreview = useInserterPreview( attributes );
	const {
		sectionBadge,
		sectionTitle,
		subtitle,
		trustBadges,
		disclaimerText,
		ctaText,
		ctaLink,
		bgColor,
		bgOpacity,
	} = attributes;

	const blockProps = useBlockProps( {
		className: 'wp-block-lacadev-pricing-table-block',
	} );

	if ( isPreview ) {
		return (
			<BlockPreviewMock
				kicker={ __( 'Pricing', 'laca' ) }
				title={ sectionTitle || __( 'Bảng giá dịch vụ', 'laca' ) }
				columns={ 1 }
			/>
		);
	}

	const updateBadge = ( index, key, value ) => {
		const next = trustBadges.map( ( badge, i ) =>
			i === index ? { ...badge, [ key ]: value } : badge
		);
		setAttributes( { trustBadges: next } );
	};

	const addBadge = () => {
		setAttributes( {
			trustBadges: [
				...trustBadges,
				{
					icon: { type: 'svg', svg: '', imageId: 0, imageUrl: '' },
					title: __( 'Tiêu đề', 'laca' ),
					description: __( 'Mô tả ngắn.', 'laca' ),
				},
			],
		} );
	};

	const removeBadge = ( index ) => {
		setAttributes( {
			trustBadges: trustBadges.filter( ( _, i ) => i !== index ),
		} );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Dữ liệu bảng giá', 'laca' ) }
					initialOpen={ true }
				>
					<p style={ { fontSize: 13, color: '#555' } }>
						{ __(
							'Danh mục và dịch vụ hiển thị ở đây được quản lý tại trang "Bảng Giá" — không sửa được trực tiếp trong block này.',
							'laca'
						) }
					</p>
					<ExternalLink
						href={
							window.location.origin +
							'/wp-admin/admin.php?page=app-pricing-options.php'
						}
					>
						{ __( 'Mở trang Bảng Giá →', 'laca' ) }
					</ExternalLink>
				</PanelBody>

				<PanelBody
					title={ __( 'Tiêu đề section', 'laca' ) }
					initialOpen={ true }
				>
					<TextControl
						label={ __( 'Nhãn nhỏ (badge)', 'laca' ) }
						value={ sectionBadge }
						onChange={ ( v ) =>
							setAttributes( { sectionBadge: v } )
						}
					/>
					<TextControl
						label={ __( 'Tiêu đề', 'laca' ) }
						value={ sectionTitle }
						onChange={ ( v ) =>
							setAttributes( { sectionTitle: v } )
						}
					/>
					<TextControl
						label={ __( 'Mô tả ngắn', 'laca' ) }
						value={ subtitle }
						onChange={ ( v ) => setAttributes( { subtitle: v } ) }
					/>
				</PanelBody>

				<PanelBody
					title={ __( 'Cam kết / Bảo hành / Tư vấn', 'laca' ) }
					initialOpen={ false }
				>
					{ trustBadges.map( ( badge, index ) => (
						<div
							key={ index }
							style={ {
								borderBottom: '1px solid #ddd',
								marginBottom: 12,
								paddingBottom: 12,
							} }
						>
							<PanelRow>
								<IconInput
									icon={
										typeof badge.icon === 'string' ||
										! badge.icon
											? { type: 'svg', svg: '' }
											: badge.icon
									}
									onChange={ ( v ) =>
										updateBadge( index, 'icon', v )
									}
								/>
							</PanelRow>
							<PanelRow>
								<TextControl
									label={ __( 'Tiêu đề', 'laca' ) }
									value={ badge.title }
									onChange={ ( v ) =>
										updateBadge( index, 'title', v )
									}
								/>
							</PanelRow>
							<PanelRow>
								<TextareaControl
									label={ __( 'Mô tả', 'laca' ) }
									value={ badge.description }
									onChange={ ( v ) =>
										updateBadge( index, 'description', v )
									}
								/>
							</PanelRow>
							<Button
								isDestructive
								variant="secondary"
								onClick={ () => removeBadge( index ) }
								style={ { marginTop: 4 } }
							>
								{ __( 'Xóa', 'laca' ) }
							</Button>
						</div>
					) ) }
					<Button variant="primary" onClick={ addBadge }>
						{ __( '+ Thêm mục', 'laca' ) }
					</Button>
				</PanelBody>

				<PanelBody
					title={ __( 'CTA & Ghi chú', 'laca' ) }
					initialOpen={ false }
				>
					<TextControl
						label={ __( 'Nội dung nút CTA', 'laca' ) }
						value={ ctaText }
						onChange={ ( v ) => setAttributes( { ctaText: v } ) }
					/>
					<TextControl
						label={ __(
							'Đường dẫn nút CTA (để trống nếu không cần link)',
							'laca'
						) }
						value={ ctaLink }
						onChange={ ( v ) => setAttributes( { ctaLink: v } ) }
					/>
					<TextareaControl
						label={ __( 'Ghi chú dưới bảng giá', 'laca' ) }
						value={ disclaimerText }
						onChange={ ( v ) =>
							setAttributes( { disclaimerText: v } )
						}
					/>
				</PanelBody>

				<PanelBody
					title={ __( 'Giao diện', 'laca' ) }
					initialOpen={ false }
				>
					<p style={ { marginBottom: 4 } }>
						{ __( 'Màu nền section', 'laca' ) }
					</p>
					<ColorPicker
						color={ bgColor }
						onChange={ ( v ) => setAttributes( { bgColor: v } ) }
						enableAlpha={ false }
					/>
					<RangeControl
						label={ __( 'Độ mờ nền (%)', 'laca' ) }
						value={ bgOpacity }
						min={ 0 }
						max={ 100 }
						step={ 5 }
						onChange={ ( v ) => setAttributes( { bgOpacity: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="lacadev/pricing-table-block"
					attributes={ attributes }
				/>
			</div>
		</>
	);
}
