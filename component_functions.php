<?php

/**
* @param string $carousel_id
* @param array $slides = [
*		[
			'path' => '/images/slide1.jpg',
			'alt' => 'image alt tag',
			'caption' => 'visible slide caption'
		],
		... etc
*	]
**/

function bootstrapCarousel(string $carousel_id, array $slides)
{
	$html = '
	<div id="'.$carousel_id.'" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">';

	for ($cnt=0; $cnt < strlen($slides); $cnt++) {
		$html .= '<li data-target="#'.$carousel_id.'" data-slide-to="'.$cnt.'" class="';
		
		if ($cnt == 0)
			$html .= 'active';

		$html .= '"></li>';
		$cnt++;
	}

	$html .= '
		</ol>
	</div>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">';

	$cnt = 0;
	foreach ($slides as $slide) {
		$html .= '<div class="item ';

		if ($cnt == 0)
			$html .= 'active';

		$html .= '">
			<img src="';

		//no path set means this is just a basic array, where the element is the path and there aren't any alt or captions
		if (!isset($slide['path'])) 
			$html .= $slide;
		else
			$html .= $slide['path'];

		$html .= '" alt="';

		if (isset($slide['alt']))
			$html .= $slide['alt'];

		$html .= '">';
		
		if (isset($slide['caption'])) {
			$html .= '<div class="carousel-caption">
				'.$slide['caption'].'
			</div>';
		}

		$html .= '</div>';
		$cnt++;
	}

	$html .= '</div>';

	return $html;
}

function bootstrapHorizontalForm(string $action, $form_classes, integer $label_col_width, $submit_button_text, $button_glyph, $fields)
{

	$label_col_class = "col-md-".$label_col_width;
	$field_col_width = 12 - $label_col_width;

	$field_col_class = 'col-md-'.$field_col_width; 

	$html = '<form method="post" action="'.$action.'" class="form-horizontal '.$form_classes.'">';

	foreach ($fields as $field) {
		$html .= "<div class='form-group'>";

		$html .= "<label class='".$label_col_class."'>".$field['label']."</label>
					<div class='".$field_col_class."'>";

		if ($field['type'] == 'text' || $field['type'] == 'email' || $field['type'] == 'tel') {
			$html .= "<input type='".$field['type']."' class='form-control' name='".$field['name']."'";

			if (isset($field['placeholder'])) {
				$html .= "placeholder='".$field['placeholder']."'";
			}

			$html .= ">";
		}
		elseif ($field['type'] == 'textarea') {
			$html .= "<textarea class='form-control' name='".$field['name']."'";

			if (isset($field['placeholder'])) {
				$html .= "placeholder='".$field['placeholder']."'";
			}

			$html .= "></textarea>";
		}
		elseif ($field['type'] == 'select') {
			$html .= "<select class='form-control' name='".$field['name']."'";

			if (isset($field['placeholder'])) {
				$html .= "placeholder='".$field['placeholder']."'";
			}

			foreach ($field['options'] as $option) {
				$html .= "<option>".$option."</option>";
			}

			"></select>";
		}

		$html .= "</div>
				</div>";

	}

	$html .= '<button type="submit" class="pull-right btn btn-primary">';

	if (isset($button_glyph))
		$html .= "<span class='glyphicon glyphicon-".$button_glyph."'></span> &nbsp; ";

	$html .= $submit_button_text.'</button>';

	$html .= "</form>";

	return $html;
}

