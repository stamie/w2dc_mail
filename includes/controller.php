<?php
/*
Plugin Name: W2DC Mail plugin
Plugin URI:  https://sosprogramozas.hu/termek/w2dc-mailster-plugin/
Description:  It connects to Mailster and Web 2.0 Directory plugins 
Version: 1.1
Author: S.O.S. Programozas
Author URI: https://sosprogramozas.hu
License: GPLv2 or later
 
*/
?>
<script type="text/javascript" id="controllers">
(function ($) {
    var submitButton  = $("p.submit").html();
    var htmlNewsletter = '<div class="w2dc-submit-section-adv">' +
                            '<label>' +
                                '<input type="checkbox" name="w2dc_mailster_newsletter" value="1"><?= " ".__('Subscribe to newsletter', 'w2dc_mail') ?>' +
                                '</label>'+
                        '</div>';


    $("p.submit").remove();
    var html =  $(".w2dc-create-listing-form").html().replace("</form>", "") + 
                htmlNewsletter + 
                submitButton + 
                "</form>";

    $(".w2dc-create-listing-form").html(html);

})(jQuery);
</script>