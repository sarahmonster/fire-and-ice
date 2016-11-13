/*
 * Function to convert an existing feColorMatrix element to a duotone.
 * Borrowed from https://ines.io/blog/dynamic-duotone-svg-jade
 */
function convertToDuotone( lightColor, darkColor) {
	// First, get the feColorMatrix element.
	var matrix = document.querySelector( 'feColorMatrix' );
	var value = [];
	// Now, do some math to determine our values.
	value = value.concat( [lightColor[0]/256 - darkColor[0]/256, 0, 0, 0, darkColor[0]/256] );
	value = value.concat( [lightColor[1]/256 - darkColor[1]/256, 0, 0, 0, darkColor[1]/256] );
	value = value.concat( [lightColor[2]/256 - darkColor[2]/256, 0, 0, 0, darkColor[2]/256] );
	value = value.concat( [0, 0, 0, 1, 0] );
	// Finally, set those values on the feColorMatrix element.
	matrix.setAttribute( 'values', value.join(' ') );
}

/*
 * Once everything's loaded, let's re-calculate the values for our fecolorMatrix.
 * This effectively re-colours the image based on our two input colours.
 */
window.onload = function () {
	convertToDuotone( [237,52,99], [44,49,94] );
}
