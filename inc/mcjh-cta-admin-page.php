<?php
/* --------------------------------- Create Menu Page ---------------------------------- */
function mcjh_ctabutton_shortcode_menus() {
	add_menu_page ( 'mcjh Shortcode Button', 'mcjh Shortcode Buttons', 'edit_posts', 'mcjh-cta-button-shortcode-plugin', 'mcjh_build_plugin_settings' );
}
add_action ( "admin_menu", "mcjh_ctabutton_shortcode_menus" );

/* --------------------------------- Render Menu Page ---------------------------------- */
function mcjh_build_plugin_settings() {
	?>
<style>
input, select, textarea {
	min-width: 360px;
}
</style>
<div>
	<h2 class="icon">mcjh Shortcode Buttons</h2>

	<hr>
	<h3>Generator</h3>
	<form id="shortcode_form">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">Color</th>
					<td><select id="color" name="color">
							<option value="green">green</option>
							<option value="darkgreen">dark green</option>
							<option value="blue">blue</option>
							<option value="darkblue">dark blue</option>
							<option value="grey">grey</option>
							<option value="darkgrey">dark grey</option>
							<option value="orange">orange</option>
							<option value="pink">pink</option>
							<option value="purple">purple</option>
							<option value="red">red</option>
							<option value="yellow">yellow</option>
							<option value="gold">gold</option>
							<option value="custom">custom</option>
					</select></td>
				</tr>
				<tr>
					<th scope="row">Custom Color</th>
					<td>
						<fieldset>
							<input id="customcolor" name="customcolor" type="text"
								placeholder="#rrggbb" value="000000" disabled>

						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Text</th>
					<td>
						<fieldset>
							<input name="text" type="text" placeholder="Your Buttontext">
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Link</th>
					<td>
						<fieldset>
							<input name="link" type="text" placeholder="Your Button-Link">
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Link-Title</th>
					<td>
						<fieldset>
							<input name="title" type="text"
								placeholder="A title for your link">
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Target</th>
					<td>
						<fieldset>
							<select name="target">
								<option value="_blank">_blank (new window or tab)</option>
								<option value="_self">_self (same window or tab)</option>
								<option value="_parent">_parent (parent window or tab)</option>
								<option value="_top">_top (whole window)</option>
							</select>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">onClick</th>
					<td>
						<ul>
							<li><span><strong>{link}</strong></span> will be replaced by the
								button-link</li>
							<li><span><strong>{pageid}</strong></span> will be replaced by
								the page id that contains this button</li>
							<li><span><strong>{pageurl}</strong></span> will be replaced by
								the page url that contains this button</li>
							<li><span><strong>{text}</strong></span> will be replaced by the
								button text</li>
							<li><span><strong>{buttonid}</strong></span> will be replaced by
								the button id</li>
						</ul> <em>Important:</em> The Placeholders bring their own
						quotationmarks, so do not set quotationmarks by yourself!!!
						<fieldset>
							<input name="onclick" type="text"
								placeholder="your javascript action">
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Style behavior in text</th>
					<td>
						<fieldset>
							<select name="style">
								<option value="blockleft">block left</option>
								<option value="blockcenter">block center</option>
								<option value="blockright">block right</option>
								<option value="inline">inline</option>
								<option value="floatleft">float left</option>
								<option value="floatright">float right</option>
							</select>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">rounded corners</th>
					<td>
						<fieldset>
							<select name="rounded">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Text Color</th>
					<td>
						<fieldset>
							<input id="tcolor" name="tcolor" type="text"
								placeholder="a hexadec code">
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Custom css</th>
					<td><span><strong>{buttonid}</strong></span> will be replaced by
						the button id as an id selector
						<fieldset>
							<textarea name="css"
								placeholder="custom css styles for this button classes"></textarea>
						</fieldset></td>
				</tr>
			</tbody>
		</table>
	</form>
	<table class="form-table">
		<tbody>
			<tr>
				<button class="button button-primary"
					onclick="generate_cta_button_shortcode()">Generate</button>
			</tr>
			<tr>
				<th scope="row">Shortcode</th>
				<td>
					<fieldset>
						<input id="output" type="text" onclick="select()" readonly>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row">Preview</th>
				<td>
					<div id="preview" style="height: 70px;"></div>
				</td>
			</tr>
		</tbody>
	</table>

	<div>
		Color picker implemented with the Color Picker - jQuery plugin powered
		by <a href="www.eyecon.ro">Stefan Petre</a>
	</div>
	<button onclick="jQuery('#old_docs').toggle()">show old documentation
		(deprecated since 1.5.4)</button>

</div>

<div id="old_docs" class="mcjh-cta-button-shortcode-wrap"
	style="display: none">

	<div id="index">
		<div id="index-ct">
			<strong><?php
	
	_e ( 'Content Directory' )?></strong><br />
			<ul>
				<li><a href="#CreateButton"><?php
	
	_e ( 'Create a default Button', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#ChangeText"><?php
	
	_e ( 'Change the text', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#ChangeTitle"><?php
	
	_e ( 'Change the title', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#ChangeLink"><?php
	
	_e ( 'Change the hyperlink', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#ChangeColor"><?php
	
	_e ( 'Change the color', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#ColorsList"><?php
	
	_e ( 'Available Colors', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#EnableTracking"><?php
	
	_e ( 'Enable Tracking', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#Help"><?php
	
	_e ( 'Help and FAQ', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#ForPros"><?php
	
	_e ( 'Some Information for Pros', 'mcjh-cta-buttons' )?></a></li>
				<li><a href="#Motivation"><?php
	
	_e ( "The Developer's Motivation", 'mcjh-cta-buttons' )?></a></li>
			</ul>
		</div>
	</div>
	<a id="CreateButton"></a>
	<div id="createButton" class="mcjh-settings">
		<strong><?php
	
	_e ( 'Create a default Button...', 'mcjh-cta-buttons' )?></strong><br />
		<p><?php
	
	_e ( '...by using [createButton] in your Text-Editor.', 'mcjh-cta-buttons' )?></p>
        <?php
	
	echo do_shortcode ( '[createButton]' );
	?>
        <ul>
			<li><?php
	
	_e ( 'default-color: green', 'mcjh-cta-buttons' )?></li>
			<li><?php
	
	_e ( 'default-text: Click here', 'mcjh-cta-buttons' )?></li>
			<li><?php
	
	_e ( 'default-hyperlink: to your Wordpress-Site', 'mcjh-cta-buttons' )?></li>
		</ul>
	</div>
	<a id="ChangeText"></a>
	<div id="change_Text" class="mcjh-settings">
		<strong><?php
	
	_e ( 'Change the text of your Button...' )?></strong>
		<p><?php
	
	_e ( '...by adding <em>text="new text"</em> after <em>createButton</em> to your shortcode:', 'mcjh-cta-buttons' )?></p>
		<p>[createButton text="new text"]</p>
         <?php
	
	echo do_shortcode ( '[createButton text="new text"]' );
	?>
        </div>
	<a id="ChangeTitle"></a>
	<div id="change_Text" class="mcjh-settings">
		<strong><?php
	
	_e ( 'Change the link title of your Button...' )?></strong>
		<p><?php
	
	_e ( '...by adding <em>title="a title"</em> after <em>createButton</em> to your shortcode:', 'mcjh-cta-buttons' )?></p>
		<p>[createButton title="a title"]</p>
         <?php
	
	echo do_shortcode ( '[createButton title="a title"]' );
	?>
        </div>
	<a id="ChangeLink"></a>
	<div id="change_Hyperlink" class="mcjh-settings">
		<strong><?php
	
	_e ( 'Change the hyperlink of your Button..', 'mcjh-cta-buttons' )?>.</strong>
		<p><?php
	
	_e ( '...by adding <em>link="http://www.google.com"</em> after <em>createButton</em> to your shortcode:', 'mcjh-cta-buttons' )?></p>
		<p>[createButton text="new text" link="http://www.google.com"]</p>
         <?php
	
	echo do_shortcode ( '[createButton text="new text" link="http://www.google.com"]' );
	?>
        </div>
	<a id="ChangeColor"></a>
	<div id="change_Color" class="mcjh-settings">
		<strong><?php
	
	_e ( 'Change the color of your Button...', 'mcjh-cta-buttons' )?></strong>
		<p><?php
	
	_e ( '...by adding <em>color="blue"</em> after <em>createButton</em> to your shortcode:', 'mcjh-cta-buttons' )?></p>
		<p>[createButton text="new text" link="http://www.google.de"
			color="blue"]</p>
         <?php
	
	echo do_shortcode ( '[createButton text="new text" link="http://www.google.de" color="blue"]' );
	?>
		<p>
			<strong><?php
	
	_e ( "OR:", 'mcjh-cta-buttons' )?></strong>
		</p>
		<p><?php
	
	_e ( "Use any valid hexadecimal color code!", 'mcjh-cta-buttons' )?></p>
		<p>[createButton text="new text" link="http://www.google.de"
			color="#112233"]</p>
        
          <?php
	
	echo do_shortcode ( '[createButton text="new text" link="http://www.google.de" color="#112233"]' );
	?>
        </div>
	<a id="ColorsList"></a>
	<div id="colors_listed" class="mcjh-settings">
		<strong><?php
	
	_e ( 'All button-colors', 'mcjh-cta-buttons' )?></strong>
		<p>
		
		
		<table>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="blue"]' );
	?></td>
				<td>color="blue"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="darkblue"]' );
	?></td>
				<td>color="darkblue"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="green"]' );
	?></td>
				<td>color="green"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="darkgreen"]' );
	?></td>
				<td>color="darkgreen"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="grey"]' );
	?></td>
				<td>color="grey" / color="lightgrey"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="darkgrey"]' );
	?></td>
				<td>color="darkgrey"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="orange"]' );
	?></td>
				<td>color="orange"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="pink"]' );
	?></td>
				<td>color="pink"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="purple"]' );
	?></td>
				<td>color="purple"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="red"]' );
	?></td>
				<td>color="red"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="yellow"]' );
	?></td>
				<td>color="yellow"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="gold"]' );
	?></td>
				<td>color="gold"</td>
			</tr>
			<tr>
				<td><?php
	
	echo do_shortcode ( '[createButton color="#123456"]' );
	?></td>
				<td>color="#123456"<br /><?php
	
	_e ( "or any other valid hexadecimal color code!", 'mcjh-cta-buttons' )?></td>
			</tr>
		</table>

		</p>
	</div>
	<a id="EnableTracking"></a>
	<div id="enable_tracking" class="mcjh-settings">
		<strong><?php
	
	_e ( 'Enable tracking variables as url-query...', 'mcjh-cta-buttons' )?></strong>
		<p><?php
	
	_e ( '...by adding <em>enableTracking="true"</em> after <em>createButton</em> to your shortcode:', 'mcjh-cta-buttons' )?></p>
		<p>[createButton text="new text" link="http://www.google.de"
			color="blue" enableTracking="true"]</p>
         <?php
	
	echo do_shortcode ( '[createButton text="new text" link="http://www.google.de" color="blue" enableTracking="true"]' );
	?>
        </div>
	<a id="Help"></a>
	<div id="first_aid" class="mcjh-settings">
		<strong><?php
	
	_e ( 'First Aid Assistant', 'mcjh-cta-buttons' )?></strong>
		<p><?php
	
	_e ( 'It might happen, that something does not work the way it is expected to. In this case, please follow these steps:', 'mcjh-cta-buttons' )?></p>
		<p>
		
		
		<ol class="first-aid">
			<li><strong><?php
	
	_e ( "Keep calm and don't panic!", 'mcjh-cta-buttons' )?></strong></li>
			<li><strong><?php
	
	_e ( "The button doesn't even appeare: </strong>Check your shortcode for typing errors. It might say [CraeteButon] instead of [createButton]", 'mcjh-cta-buttons' )?></li>
			<li><strong><?php
	
	_e ( 'There is just the first word of my text: </strong>Check your text. You might forgott some quotationmarks.', 'mcjh-cta-buttons' )?></li>
			<li><strong><?php
	
	_e ( "The hyperlink doesn't work: </strong>Make sure you did not forgett a 'http://' in front of your URL", 'mcjh-cta-buttons' )?></li>
			<li><strong><?php
	
	_e ( "The button doesn't show my defined color: </strong> Have a look at the colors list.", 'mcjh-cta-buttons' )?></li>
			<li><strong><?php
	
	_e ( "I can't even read this list: </strong> ...a fail in the matrix!", 'mcjh-cta-buttons' )?></li>
		</ol>
		</p>
	</div>
	<a id="ForPros"></a>
	<div id="for_pros" class="mcjh-settings">
		<strong><?php
	
	_e ( "Some Information for Pros", 'mcjh-cta-buttons' )?></strong>
		<p><?php
	
	_e ( "Well, there is nothing interessting for pros. So sorry, dude!", 'mcjh-cta-buttons' )?></p>

	</div>
	<a id="Motivation"></a>
	<div id="motivation" class="mcjh-settings">
		<strong><?php
	
	_e ( "The Developer's Motivation", 'mcjh-cta-buttons' )?></strong>
		<p>
         <?php
	
	_e ( "I worked a lot with Wordpress and its plugins in my old company.", 'mcjh-cta-buttons' )?><br />
         <?php
	
	_e ( 'While relaunching our website we wanted to add some so called "cta buttons" (=call to action)', 'mcjh-cta-buttons' )?>.<br />
         <?php
	
	_e ( "They should offer a simple shortcode-system and an easy way for monitoring their success with allready existing tools.", 'mcjh-cta-buttons' )?><br />
        <?php
	
	_e ( " We tried many different plugins, but the results never were realy satisfying. Instead, we had compatibility issues.", 'mcjh-cta-buttons' )?><br />
         <?php
	
	_e ( "After finishing my apprenticeship, I needed those damn cta-Buttons again for my own website. So I startet experimenting around. And in the end, I wrote this little plugin.", 'mcjh-cta-buttons' )?>
		</p>
		<p> <?php
	
	_e ( "Have a nice day", 'mcjh-cta-buttons' )?></p>
		<p>
			<em><?php
	
	_e ( "Marcus C. J. Hartmann", 'mcjh-cta-buttons' )?><em>
		
		</p>
	</div>
<?php
}