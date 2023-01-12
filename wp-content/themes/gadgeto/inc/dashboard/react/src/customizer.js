/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Fragment } = wp.element;
import map from 'lodash/map';
const { withFilters, TabPanel, Panel, PanelBody, PanelRow, Button } = wp.components;

export const CustomizerLinks = () => {
	const headerLinks = [
		{
			title: __( 'Global Colors', 'gadgeto' ),
			description: __( 'Setup the base color scheme for your site.', 'gadgeto' ),
			focus: 'thebase_customizer_general_colors',
			type: 'section',
			setting: false
		},
		{
			title: __( 'Branding', 'gadgeto' ),
			description: __( 'Upload your logo and favicon.', 'gadgeto' ),
			focus: 'title_tagline',
			type: 'section',
			setting: false
		},
		{
			title: __( 'Typography', 'gadgeto' ),
			description: __( 'Choose the perfect font family, style and sizes.', 'gadgeto' ),
			focus: 'thebase_customizer_general_typography',
			type: 'section',
			setting: false
		},
		{
			title: __( 'Header Layout', 'gadgeto' ),
			description: __( 'Add elements and arrange them how you want.', 'gadgeto' ),
			focus: 'thebase_customizer_header',
			type: 'panel',
			setting: false
		},
		{
			title: __( 'Page Layout', 'gadgeto' ),
			description: __( 'Define your sites general page look and feel for page title, and content style.', 'gadgeto' ),
			focus: 'thebase_customizer_page_layout',
			type: 'section',
			setting: false
		},
		{
			title: __( 'Footer Layout', 'gadgeto' ),
			description: __( 'Customize the columns and place widget areas in unlimited configurations', 'gadgeto' ),
			focus: 'thebase_customizer_footer_layout',
			type: 'section',
			setting: false
		},
	];
	return (
		<Fragment>
			<h2 className="section-header">{ __( 'Customize Your Site', 'gadgeto' ) }</h2>
			{/* <h3 className="section-sub-head">{ __( 'Header Builder', 'gadgeto' ) }</h3> */}
			<div className="two-col-grid">
				{ map( headerLinks, ( link ) => {
					return (
						<div className="link-item">
							<h4>{ link.title }</h4>
							<p>{ link.description }</p>
							<div className="link-item-foot">
								<a href={ `${thebaseDashboardParams.adminURL}customize.php?autofocus%5B${ link.type }%5D=${ link.focus }` }>
									{ __( 'Customize', 'gadgeto' ) }
								</a>
							</div>
						</div>
					);
				} ) }
			</div>
		</Fragment>
	);
};

export default withFilters( 'thebase_theme_customizer' )( CustomizerLinks );