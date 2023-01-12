/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Fragment } = wp.element;
const { withFilters, TabPanel, Panel, PanelBody, PanelRow, Button } = wp.components;
export const Sidebar = () => {
	return (
		<Fragment>
			<Panel className="community-section sidebar-section">
				<PanelBody
					opened={ true }
				>
					<h2>{ __( 'Web Creators Community', 'gadgeto' ) }</h2>
					<p>{ __( 'Join our community of fellow thebase users creating effective websites! Share your site, ask a question and help others.', 'gadgeto' ) }</p>
					<a href="https://www.facebook.com/groups/webcreatorcommunity" target="_blank" class="sidebar-link">{ __( 'Join our Facebook Group', 'gadgeto' ) }</a>
				</PanelBody>
			</Panel>
			<Panel className="support-section sidebar-section">
				<PanelBody
					opened={ true }
				>
					<h2>{ __( 'Support', 'gadgeto' ) }</h2>
					<p>{ __( 'Have a question, we are happy to help! Get in touch with our support team.', 'gadgeto' ) }</p>
					<a href="https://basetheme.net/free-support/" target="_blank" class="sidebar-link">{ __( 'Submit a Ticket', 'gadgeto' ) }</a>
				</PanelBody>
			</Panel>
		</Fragment>
	);
};

export default withFilters( 'thebase_theme_sidebar' )( Sidebar );