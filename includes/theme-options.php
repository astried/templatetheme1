<?php

if( !class_exists('ORANGUTAN_THEME_OPTION_CLASS') )
{

class ORANGUTAN_THEME_OPTION_CLASS
{
	static function init()
	{
		add_action("admin_menu", array( __CLASS__ , "add_theme_menu_item" ) );

		add_action('admin_init', array( __CLASS__ , 'theme_settings' ) );
	}

	function add_theme_menu_item()
	{
		add_theme_page(	"Theme Customization", 
						"Theme Customization", 
						"manage_options", 
						'orut_theme-options', 
						array( __CLASS__ , "theme_option_page" ), 
						null, 
						99
					);
	}


	//admin-init hook to create settings section with title “New Theme Options Section”.
	function theme_settings()
	{
		/*
		register_setting( 'orut_theme-options-slider', 
							'orut_slider_uploader',
							array(__CLASS__, 'settings_sanitize')
						);

		add_settings_section( 'orut_first_section', 
								'Theme Options Section',
								array( __CLASS__ , 'theme_section_description' ),
								'orut_theme-options-slider'
							);		

		add_settings_field(	'orut_slider_image',
							'Profile picture',
							array( __CLASS__ , 'slider_image'),
							'orut_theme-options-slider',
							'orut_first_section'
							);
		*/

		/*
		register_setting( 'orut_theme-options-grp', 
							'orut_profile_picture',
							array(__CLASS__, 'settings_sanitize')
						);

		register_setting( 'orut_theme-options-grp', 
							'orut_social_link_github',
							array(__CLASS__, 'settings_sanitize')
						);

		add_settings_section( 'orut_first_section', 
								'Theme Options Section',
								array( __CLASS__ , 'theme_section_description' ),
								'orut_theme-options-grp'
							);

		add_settings_field(	'orut_profile_picture',
							'Profile picture',
							array( __CLASS__ , 'profile_picture'),
							'orut_theme-options-grp',
							'orut_first_section'
							);

		add_settings_field(	'orut_profile_heading',
							'Profile Title',
							array( __CLASS__ , 'profile_heading'),
							'orut_theme-options-grp',
							'orut_first_section'
							);

		add_settings_field(	'orut_profile_subheading',
							'Profile Sub Title',
							array( __CLASS__ , 'profile_subheading'),
							'orut_theme-options-grp',
							'orut_first_section'
							);		

		add_settings_field(	"orut_social_link_github", 
							"Github", 
							array( __CLASS__ , "social_link_github"), 
							'orut_theme-options-grp', 
							'orut_first_section'
							);

		*/
	}	

	function settings_sanitize($input)
	{
		return $input;
	}	

	function theme_option_page()
	{
		if( isset($_POST['submit']) )
		{
			foreach( $_POST as $key => $val )
			{
				//echo $key . " " . $val . "<br>";

				if($key != 'submit'){
					$oldval = get_option($key);
					
					if( !$oldval )
					{
	 				   add_option( $key, $val);
					}else{
	 				   update_option( $key, $val);					
					}

				}
			}

			foreach( $_POST as $key => $val ){
				unset($_POST[$key]);
			}
		}else{

		}

		include_once 'form-customization.php';
	}

	function theme_section_description()
	{
		echo '<p>Theme Options Section</p>';
	}

	function social_link_github()
	{
		//php code to take input from text field for twitter URL.
		?>
		<input type="text" name="orut_social_link_github" id="orut_social_link_github" value="<?php echo get_option('orut_social_link_github'); ?>" />
		<?php
	}

	function profile_heading()
	{
		//php code to take input from text field for twitter URL.
		?>
		<input type="text" name="orut_profile_heading" id="orut_profile_heading" value="<?php echo get_option('orut_profile_heading'); ?>" />
		<?php
	}

	function profile_subheading()
	{
		//php code to take input from text field for twitter URL.
		?>
		<input type="text" name="orut_profile_subheading" id="orut_profile_subheading" value="<?php echo get_option('orut_profile_subheading'); ?>" />
		<?php
	}

	function profile_picture()
	{
		//php code to take input file name for logo image.
		?>
		<input type="file" name="orut_profile_picture" />
		<?php echo get_option('orut_profile_picture'); ?>
		<?php
	}


}//ENDOFCLASS

}

ORANGUTAN_THEME_OPTION_CLASS::init();
?>