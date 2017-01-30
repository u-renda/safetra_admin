<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('upload_image')) {
    function upload_image($param, $article = FALSE)
    {
		$CI =& get_instance();
		
        if ($param["error"] == 0)
        {
            $imageFileType = strtolower(pathinfo($param["name"],PATHINFO_EXTENSION));

            $param2 = array();
			$param2['name'] = md5(basename($param["name"]) . date('Y-m-d H:i:s'));
			$param2['target_dir'] = $CI->config->item('upload_url');
            $param2['target_file'] = $CI->config->item('upload_dir') . $param2['name'] . '.' . $imageFileType;
            $param2['imageFileType'] = $imageFileType;
            $param2['tmp_name'] = $param["tmp_name"];
            $param2['tmp_file'] = $param2['target_dir'] . $param2['name'] . '.' . $imageFileType;
            $param2['size'] = $param["size"];
			
            $check_image = check_image($param2, $article);
			
            if ($check_image == 'true')
            {
                return $param2['tmp_file'];
            }
            else
            {
                return array($check_image);
            }
        }
	}
}

if ( ! function_exists('check_image')) {
    function check_image($param, $article)
    {
        $CI =& get_instance();
		$CI->load->library('image_lib');
		
        // Check if image file is a actual image or fake image
        $check = @getimagesize($param["tmp_name"]);

        if($check === FALSE)
        {
            $msg = "File is not an image.";
            return $msg;
        }
        else
        {
            // Check if file already exists
            if (file_exists($param['tmp_file']))
            {
                $msg = "Sorry, file already exists.";
                return $msg;
            }
            else
            {
                // Check file size
                if ($param["size"] > 2097152) // 2MB
                {
                    $msg = "Sorry, your file is too large.";
                    return $msg;
                }
                else
                {
                    // Allow certain file formats
                    if($param['imageFileType'] != "jpg" && $param['imageFileType'] != "png" && $param['imageFileType'] != "jpeg" && $param['imageFileType'] != "gif" )
                    {
                        $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        return $msg;
                    }
                    else
                    {
                        // Save original
                        $save_resize = move_uploaded_file($param["tmp_name"], $param['target_file']);
                        
                        if ($save_resize == TRUE)
                        {
							if ($article == TRUE)
							{
								// Resize image for article
								$config['image_library'] = 'gd2';
								$config['source_image']	= $param['target_file'];
								$config['new_image'] = $CI->config->item('upload_dir') . $param['name'] . '_slides.' . $param['imageFileType'];
								$config['maintain_ratio'] = FALSE;
								$config['width'] = 1140;
								$config['height'] = 430;
							
								$CI->image_lib->initialize($config);
							
								if ( ! $CI->image_lib->resize())
								{
									return $CI->image_lib->display_errors();
								}
								else
								{
									list($image_width, $image_height) = getimagesize($param['target_file']);
									
									$config['width'] = 1140;
									$config['height'] = 430;
									$config['x_axis'] = ($image_width - $config['width']) / 2;
									$config['y_axis'] = ($image_height - $config['height']) / 2;
									
									$CI->image_lib->initialize($config);
									
									if ( ! $CI->image_lib->crop())
									{
										return $CI->image_lib->display_errors();
									}
								}
							}
							
                            $msg = 'true';
                            return $msg;
                        }
                        else
                        {
                            $msg = "Sorry, there was an error uploading your file.";
                            return $msg;
                        }
                    }
                }
            }
        }
    }
}