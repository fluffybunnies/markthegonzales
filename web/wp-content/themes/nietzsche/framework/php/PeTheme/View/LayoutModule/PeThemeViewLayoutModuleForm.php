<?php

class PeThemeViewLayoutModuleForm extends PeThemeViewLayoutModule {

	public function name() {
		return __("Contact Form",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Contact Form",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "content" =>
				  array(
						"label" => __("Intro Text",'nietzsche'),
						"type" => "Editor",
						"description" => __("Text shown before the form fields.",'nietzsche'),
						"default" => sprintf(__('<p>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.</p>','nietzsche'),"\n")
						),
				  "address" =>
				  array(
						"label" => __("Address",'nietzsche'),
						"type" => "Editor",
						"description" => __("Text appropriate for displaying your address.",'nietzsche'),
						"default" => sprintf(__('<h5>AKUMA STUDIOS</h5>%s<p>Suite 11b<br>%s175 Broadway<br>%sNew York NY10015</p>','nietzsche'),"\n","\n","\n")
						),
				  "contact_details" =>
				  array(
						"label" => __("Contact Details",'nietzsche'),
						"type" => "Editor",
						"description" => __("Text appropriate for displaying contact Details.",'nietzsche'),
						"default" => sprintf(__('<a href="mailto:howdy@akumastudios.com" class="email">howdy@akumastudios.com</a>%s<a href="#" class="phone">+12 345 678 90</a>','nietzsche'),"\n")
						),
				  "submit" =>
				  array(
						"label" => __("Submit Label",'nietzsche'),
						"type" => "Text",
						"description" => __("Label of the form submit button.",'nietzsche'),
						"default" => __('Submit Form','nietzsche')
						),
				  "msgOK" =>
				  array(
						"label" => __("Confirmation",'nietzsche'),
						"type" => "Editor",
						"description" => __("Text shown when form is successfully submitted.",'nietzsche'),
						"default" => __('<strong>Your Message Has Been Sent!</strong> Thank you for contacting us.','nietzsche')
						),
				  "msgKO" =>
				  array(
						"label" => __("Errors",'nietzsche'),
						"type" => "Editor",
						"description" => __("Text shown when there are validation errors.",'nietzsche'),
						"default" => __('<strong>Oops, An error has ocurred!</strong> See the marked fields above to fix the errors.','nietzsche')
						),
				  "fields" => 
				  array(
						"label"=>__("Fields",'nietzsche'),
						"type"=>"Items",
						"section"=>__("Header",'nietzsche'),
						"description" => __("Add one or more fields to the form.",'nietzsche'),
						"button_label" => __("Add New Field",'nietzsche'),
						"sortable" => true,
						"auto" => __("Layer",'nietzsche'),
						"unique" => false,
						"editable" => false,
						"legend" => true,
						"fields" => 
						array(
							  array(
									"label" => __("Type",'nietzsche'),
									"name" => "type",
									"type" => "select",
									"options" => 
									array(
										  __("Text",'nietzsche') => "text",
										  __("TextArea",'nietzsche') => "textarea"
										  ),
									"width" => 100,
									"default" => "text"
									),
							  array(
									"label" => __("Label",'nietzsche'),
									"name" => "label",
									"type" => "text",
									"width" => 150, 
									"default" => __("Name",'nietzsche')
									),
							  array(
									"label" => __("Name",'nietzsche'),
									"name" => "name",
									"type" => "text",
									"width" => 100, 
									"default" => "Name"
									),
							  array(
									"label" => __("Required",'nietzsche'),
									"name" => "required",
									"type" => "select",
									"width" => 150,
									"options" => 
									array(
										  __("Required",'nietzsche') => "required",
										  __("Not Required",'nietzsche') => ""
										  ),
									"default" => "required"
									)
							  ),
						"default" => 
						array(
							  array(
									"type" => "text",
									"label" => __("Name",'nietzsche'),
									"name" => "author",
									"required" => "required"
									),
							  array(
									"type" => "text",
									"label" => __("Address",'nietzsche'),
									"name" => "address",
									"required" => ""
									),
							  array(
									"type" => "text",
									"label" => __("Phone",'nietzsche'),
									"name" => "phone",
									"required" => ""
									),
							  array(
									"type" => "text",
									"label" => __("Email",'nietzsche'),
									"name" => "email",
									"required" => "required"
									),
							  array(
									"type" => "text",
									"label" => __("Website",'nietzsche'),
									"name" => "website",
									"required" => ""
									),
							  array(
									"type" => "textarea",
									"label" => __("Message",'nietzsche'),
									"name" => "message",
									"required" => "required"
									)
							  )
						)
				  );
		
	}

	public function setTemplateData() {
		peTheme()->template->data($this->data,empty($this->conf->bid) ? 1 : $this->conf->bid);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","form");
	}

	public function tooltip() {
		return __("Use this block to add a contact form to your layout. This block consists of a form with configurable input fields.",'nietzsche');
	}


}

?>
