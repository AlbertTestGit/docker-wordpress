<?php
if(isset($PostID) && isset($_POST['tabs_r_save_data_action']) ) {
			if (!wp_verify_nonce($_POST['wpsm_tabs_security'], 'wpsm_tabs_nonce_save_settings_values')) {
				die();
			}
			$TotalCount = count($_POST['tabs_title']);
			$All_data = array();
			if($TotalCount) {
				for($i=0; $i < $TotalCount; $i++) {
					$tabs_title = stripslashes(sanitize_text_field($_POST['tabs_title'][$i]));
					$tabs_title_icon = sanitize_text_field($_POST['tabs_title_icon'][$i]);
					$enable_single_icon = sanitize_text_field($_POST['enable_single_icon'][$i]);
					$tabs_desc = stripslashes(wp_kses_post($_POST['tabs_desc'][$i]));
					$tabs_desc = str_replace('\\', '&#92;', $tabs_desc);
					$All_data[] = array(
						'tabs_title' => $tabs_title,
						'tabs_title_icon' => $tabs_title_icon,
						'enable_single_icon' => $enable_single_icon,
						'tabs_desc' => $tabs_desc,
					);
				}
				update_post_meta($PostID, 'wpsm_tabs_r_data', serialize($All_data));
				update_post_meta($PostID, 'wpsm_tabs_r_count', $TotalCount);
			} else {
				$TotalCount = -1;
				update_post_meta($PostID, 'wpsm_tabs_r_count', $TotalCount);
				$All_data = array();
				update_post_meta($PostID, 'wpsm_tabs_r_data', serialize($All_data));
			}
		}
 ?>