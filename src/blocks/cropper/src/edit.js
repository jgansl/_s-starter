// @ts-nocheck
/**
 * WordPress components that create the necessary UI elements for the block
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-components/
 */
import { TextControl } from '@wordpress/components';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';
import { FocalPointPicker } from '@wordpress/components';
//import { useState } from '@wordpress/element';
// import { Panel, PanelBody, PanelRow } from '@wordpress/components';
// import { more } from '@wordpress/icons';
import { __experimentalZStack as ZStack } from '@wordpress/components';


/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	// const [ focalPoint, setFocalPoint ] = useState( {
	// 	 x: 0.5,
	// 	 y: 0.5,
	// } );

	const url = 'https://picsum.photos/1920/1920.webp';

	/* Example function to render the CSS styles based on Focal Point Picker value */
	const style = {
		backgroundImage: `url(${ url })`,
		backgroundPosition: `${ attributes.x * 100 }% ${ attributes.y * 100 }%`,
	};

function xsetAttributes(e) {
	console.log(e)
	// console.log(attributes)
	// setFocalPoint(e)
	setAttributes( { x: e.x, y: e.y } )
}

	return (
		<div { ...blockProps }>

			<ZStack offset={ 20 } isLayered>
            <p>TextA</p>
            <p>TextB</p>
            <p>TextC</p>
			</ZStack>
			<TextControl
				value={ attributes.message }
				onChange={ ( val ) => {
					// console.log(val)
					setAttributes( { message: val } ) 
					// console.log(attributes)
				}}
			/>
			{/* if select then show */}
			<FocalPointPicker
					url={ url }
					value={ attributes }
				//  onDragStart={ intSsetAttributes }
				//  onDrag={ intSsetAttributes }
					onChange={ setAttributes }
			/>
			<div style={ style } />
		</div>
	);
}
