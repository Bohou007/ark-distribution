/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Fragment } = wp.element;

export const RecommendedTab = () => {
	return (
		<Fragment>
			<p>{ __( 'This area is for Recommended Plugins.', 'gadgeto' ) }</p>
		</Fragment>
	);
};

export default RecommendedTab;