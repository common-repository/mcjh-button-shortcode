<?php
class mcjh_cta_button {
	private $text;
	private $link;
	private $color;
	private $title;
	private $onclick;
	private $target;
	private $css;
	private $buttonId;
	private $tcolor;
	private $style;
	private $rounded;
	
	private $preparedParts = array (
			"container" => array (),
			"a" => array (),
			"text" => array (),
			"icon" => array () 
	);
	
	private $colorArray = array (
			"blue",
			"darkblue",
			"green",
			"darkgreen",
			"orange",
			"pink",
			"purple",
			"yellow",
			"red",
			"grey",
			"lightgrey",
			"darkgrey",
			"gold" 
	);
	// hold existing target values
	private $targetArray = array (
			"_blank",
			"_self",
			"_parent",
			"_top" 
	);
	// hold existing jsPlaceHolders
	private $jsPlaceHolder = array (
			"buttonid" => "",
			"link" => "",
			"pageid" => "",
			"pageurl" => "",
			"text" => "" 
	);
	private $styleArray = array (
			"blockleft",
			"blockright",
			"blockcenter",
			"inline",
			"floatleft",
			"floatright" 
	);
	function __construct($text, $link, $color, $title, $onclick, $target, $css, $buttonId, $tcolor, $style, $rounded) {
		if (! in_array ( $this->target, $this->targetArray )) {
			$target = "_blank";
		}
		$this->text = $text;
		$this->link = $link;
		$this->color = $color;
		$this->title = $title;
		$this->onclick = $onclick;
		$this->target = $target;
		$this->css = $css;
		$this->tcolor = $tcolor;
		$this->style = $style;
		$this->rounded = $rounded;
		
		$this->setJsPlaceholders ();
	}
	private function setJsPlaceholders() {
		$this->jsPlaceHolder ["link"] = $this->link;
		$this->jsPlaceHolder ["pageid"] = get_the_ID ();
		$this->jsPlaceHolder ["text"] = $this->text;
		$this->jsPlaceHolder ["pageurl"] = get_bloginfo ( 'url' );
		$this->jsPlaceHolder ["buttonid"] = $this->mcjh_ctabutton_generate_button_id ();
	}
	private function mcjh_ctabutton_generate_button_id() {
		// define srcid
		$srcid = "";
		if (! is_admin ()) {
			$srcid = get_the_ID ();
		} else {
			$srcid = 'admin';
		}
		
		// handle empty title attribute
		if ($this->title == "" || empty ( $this->title )) {
			$this->title = $this->text;
		}
		
		$text_id = str_ireplace ( " ", "", $this->text );
		$link_id_find = array (
				".",
				":",
				" ",
				"/" 
		);
		$link_id = str_ireplace ( $link_id_find, "", $this->link );
		// build html_id
		$button_html_id = $link_id . "_" . $srcid . "_" . $this->color . '_' . $this->buttoncounter;
		
		return $button_html_id;
	}
	private function mcjh_ctabutton_generate_tcolor() {
		if (! empty ( $this->tcolor ) && mcjh_cta_is_hexadecimal ( $this->tcolor )) {
			$tcolor = mcjh_cta_is_hexadecimal ( $this->tcolor );
			return " style='color:$tcolor'";
		}
		return "";
	}
	
	/**
	 * Replaces the js placeholders by the defined value and then creates the html onclick string to be used in the final output.
	 *
	 * @return string
	 */
	private function mcjh_ctabutton_generate_onclick_string() {
		if ($this->onclick != "") {
			foreach ( $this->jsPlaceHolder as $index => $value ) {
				if (! empty ( $value )) {
					$placeholder = "{" . $index . "}";
					$this->onclick = str_replace ( $placeholder, "'" . $value . "'", $this->onclick );
				}
			}
			
			return 'onClick="' . $this->onclick . '" ';
		}
		return "";
	}
	
	/**
	 * Generate color class
	 *
	 * @return string
	 */
	private function mcjh_ctabutton_generate_color_class() {
		if (in_array ( $this->color, $this->colorArray )) {
			return 'mcjh-' . $this->color;
		} else if (mcjh_cta_is_hexadecimal ( $this->color ) !== false) {
			return "mcjh-custom";
		}
		return "mcjh-green";
	}
	private function mcjh_ctabutton_generate_rounded_class() {
		if ($this->rounded == "true") {
			return "ctabutton-rounded";
		} else
			return "";
	}
	
	/**
	 * Generates the inline colorstyle
	 *
	 * @return string
	 */
	private function mcjh_ctabutton_generate_inline_color_style() {
		if (mcjh_cta_is_hexadecimal ( $this->color ) !== false) {
			$this->color = mcjh_cta_is_hexadecimal ( $this->color );
			$this->preparedParts["a"]["style"][]="background-color:$this->color";
			$this->preparedParts["a"]["style"][]="border:1px solid " . mcjh_cta_getDarkColor ( $this->color );
			return "style='background-color:$this->color;border:1px solid " . mcjh_cta_getDarkColor ( $this->color ) . "' ";
		}
		return "";
	}
	
	private function mcjh_ctabutton_generate_a_classes(){
		$this->preparedParts["a"]["class"][]="ctabutton";
		$this->preparedParts["a"]["class"][]=$this->mcjh_ctabutton_generate_color_class();
		$this->preparedParts["a"]["class"][]=$this->mcjh_ctabutton_generate_rounded_class ();
	}
	
	private function mcjh_ctabutton_generate_style_class() {
		$class = "ctabutton-blockleft";
		$this->style = str_replace ( " ", "", $this->style );
		if (in_array ( $this->style, $this->styleArray )) {
			$class = "ctabutton-" . $this->style;
		}
		$this->preparedParts["container"]["class"][]="ctabutton-container";
		$this->preparedParts["container"]["class"][]=$class;
		return $class;
	}
	
	function draw() {
		$this->mcjh_ctabutton_generate_style_class();
		$this->mcjh_ctabutton_generate_a_classes();
		
		$output = "";
		if (! empty ( $this->css )) {
			$output .= "<style>";
			$output .= str_replace ( "{buttonid}", "#" . $this->jsPlaceHolder ["buttonid"], $this->css );
			$output .= "</style>";
		}
		$output .= '<div class="'.implode(" ",$this->preparedParts["container"]["class"]).'" >' . PHP_EOL;
		$output .= '<a '.$this->mcjh_ctabutton_generate_inline_color_style().' class="'.implode(" ",$this->preparedParts["a"]["class"]).'" id="' . $this->mcjh_ctabutton_generate_button_id () . '" href="' . $this->link . '" target="' . $this->target . '" title="' . $this->title . '" ' . $this->mcjh_ctabutton_generate_onclick_string () . ' >';
		$output .= '<span' . $this->mcjh_ctabutton_generate_tcolor () . '>' . $this->text . '</span>';
		$output .= '</a>' . PHP_EOL;
		$output .= '</div>' . PHP_EOL;
		return $output;
	}
}