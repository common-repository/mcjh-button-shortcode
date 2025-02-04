<?php
function mcjh_cta_getDarkColor($hex) {
	$rgb = mcjh_cta_hex2rgb ( $hex );
	$hsl = mcjh_cta_rgb2Hsl ( $rgb [0], $rgb [1], $rgb [2] );
	if ($hsl [2] - 0.45 >= 0) {
		$hsl [2] = $hsl [2] - 0.45;
	} else {
		return $hex;
	}
	$rgb_new = mcjh_cta_hsl2Rgb ( $hsl [0], $hsl [1], $hsl [2] );
	$hex_new = mcjh_cta_rgb2hex ( $rgb_new );

	return $hex_new;
}
function mcjh_cta_is_hexadecimal($color) {
	// enlarge color codes with three positions
	if (preg_match ( '/^#[a-f0-9]{3}$/i', $color )) {
		$color = str_replace ( "#", "", $color );
		$color_args = str_split ( $color );
		$color = "";
		foreach ( $color_args as $value ) {
			$color .= $value . $value;
		}
		$color = "#" . $color;
	} elseif (preg_match ( '/^[a-f0-9]{3}$/i', $color )) {
		$color_args = str_split ( $color );
		$color = "";
		foreach ( $color_args as $value ) {
			$color .= $value . $value;
		}
		$color = "#" . $color;
	} // Check for a hex color string without hash 'c1c2b4'
	 
	// Check for a hex color string '#c1c2b4'
	if (preg_match ( '/^#[a-f0-9]{6}$/i', $color )) {
		return $color;
	}  // Check for a hex color string without hash 'c1c2b4'
	else if (preg_match ( '/^[a-f0-9]{6}$/i', $color )) {
		return '#' . $color;
	}
	return false;
}
function mcjh_cta_hex2rgb($hex) {
	$hex = str_replace ( "#", "", $hex );

	if (strlen ( $hex ) == 3) {
		$r = hexdec ( substr ( $hex, 0, 1 ) . substr ( $hex, 0, 1 ) );
		$g = hexdec ( substr ( $hex, 1, 1 ) . substr ( $hex, 1, 1 ) );
		$b = hexdec ( substr ( $hex, 2, 1 ) . substr ( $hex, 2, 1 ) );
	} else {
		$r = hexdec ( substr ( $hex, 0, 2 ) );
		$g = hexdec ( substr ( $hex, 2, 2 ) );
		$b = hexdec ( substr ( $hex, 4, 2 ) );
	}
	$rgb = array (
			$r,
			$g,
			$b
	);
	return $rgb; // returns an array with the rgb values
}
function mcjh_cta_rgb2hex($rgb) {
	$hex = "#";
	$hex .= str_pad ( dechex ( $rgb [0] ), 2, "0", STR_PAD_LEFT );
	$hex .= str_pad ( dechex ( $rgb [1] ), 2, "0", STR_PAD_LEFT );
	$hex .= str_pad ( dechex ( $rgb [2] ), 2, "0", STR_PAD_LEFT );

	return $hex; // returns the hex value including the number sign (#)
}
function mcjh_cta_rgb2Hsl($r, $g, $b) {
	$oldR = $r;
	$oldG = $g;
	$oldB = $b;
	$r /= 255;
	$g /= 255;
	$b /= 255;
	$max = max ( $r, $g, $b );
	$min = min ( $r, $g, $b );
	$h;
	$s;
	$l = ($max + $min) / 2;
	$d = $max - $min;
	if ($d == 0) {
		$h = $s = 0; // achromatic
	} else {
		$s = $d / (1 - abs ( 2 * $l - 1 ));
		switch ($max) {
			case $r :
				$h = 60 * fmod ( (($g - $b) / $d), 6 );
				if ($b > $g) {
					$h += 360;
				}
				break;
			case $g :
				$h = 60 * (($b - $r) / $d + 2);
				break;
			case $b :
				$h = 60 * (($r - $g) / $d + 4);
				break;
		}
	}
	return array (
			round ( $h, 2 ),
			round ( $s, 2 ),
			round ( $l, 2 )
	);
}
function mcjh_cta_hsl2Rgb($h, $s, $l) {
	$r;
	$g;
	$b;
	$c = (1 - abs ( 2 * $l - 1 )) * $s;
	$x = $c * (1 - abs ( fmod ( ($h / 60), 2 ) - 1 ));
	$m = $l - ($c / 2);
	if ($h < 60) {
		$r = $c;
		$g = $x;
		$b = 0;
	} else if ($h < 120) {
		$r = $x;
		$g = $c;
		$b = 0;
	} else if ($h < 180) {
		$r = 0;
		$g = $c;
		$b = $x;
	} else if ($h < 240) {
		$r = 0;
		$g = $x;
		$b = $c;
	} else if ($h < 300) {
		$r = $x;
		$g = 0;
		$b = $c;
	} else {
		$r = $c;
		$g = 0;
		$b = $x;
	}
	$r = ($r + $m) * 255;
	$g = ($g + $m) * 255;
	$b = ($b + $m) * 255;
	return array (
			floor ( $r ),
			floor ( $g ),
			floor ( $b )
	);
}