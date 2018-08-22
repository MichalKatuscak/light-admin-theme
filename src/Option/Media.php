<?php

namespace LightAdminTheme\Option;

class Media implements OptionInterface
{
    public function render($args)
    {
        echo $this->getHtml($args);
    }

    private function getHtml($args)
    {
        ob_start();

        echo '
        <div class="upload">
            <img data-src="' . wp_get_attachment_url($args["value"]) . '" src="' . wp_get_attachment_url($args["value"]) . '"
             id="' . $args["group"] . '-' . $args["option"] . '_preview"
             style="width:auto;height:auto;max-width:200px;max-height:200px" />
            <div>
                <input type="hidden" name="' . $args["group"] . '[' . $args["option"] . ']" id="' . $args["group"] . '-' . $args["option"] . '" value="' . $args["value"] . '" />
                <button type="submit" class="upload_image_button button">Media</button>
            </div>
        </div>';

        $my_saved_attachment_post_id = $args["value"];

        ?>
        <script type='text/javascript'>

            jQuery(document).ready(function ($) {

                // Uploading files
                var file_frame;
                var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

                jQuery('.upload_image_button').unbind("click").on('click', function (event) {

                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if (file_frame) {
                        // Set the post ID to what we want
                        file_frame.uploader.uploader.param('post_id', set_to_post_id);
                        // Open frame
                        file_frame.open();
                        return;
                    } else {
                        // Set the wp.media post id so the uploader grabs the ID we want when initialised
                        wp.media.model.settings.post.id = set_to_post_id;
                    }

                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: 'Select a image to upload',
                        button: {
                            text: 'Use this image',
                        },
                        multiple: false	// Set to true to allow multiple files to be selected
                    });

                    // When an image is selected, run a callback.
                    file_frame.on('select', function () {
                        // We set multiple to false so only get one image from the uploader
                        attachment = file_frame.state().get('selection').first().toJSON();

                        // Do something with attachment.id and/or attachment.url here
                        $('#<?php echo $args["group"] . '-' . $args["option"];?>_preview').attr('src', attachment.url);
                        $('#<?php echo $args["group"] . '-' . $args["option"];?>').val(attachment.id);

                        // Restore the main post ID
                        wp.media.model.settings.post.id = wp_media_post_id;
                    });

                    // Finally, open the modal
                    file_frame.open();
                });

                // Restore the main ID when the add media button is pressed
                jQuery('a.add_media').on('click', function () {
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
            });

        </script><?php

        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}