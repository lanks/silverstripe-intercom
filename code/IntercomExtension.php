<?php
/*
 * class IntercomExtension
 */

class IntercomExtension extends Extension {
    function onAfterInit () {
        if (($member = Member::currentUser ()) &&
            ($app_id = SiteConfig::current_site_config ()->IntercomAppID)) {
            $created = strtotime($member->Created);
            Requirements::customScript (<<<JS
                window.intercomSettings = {
                // TODO: The current logged in user's email address.
                email: "$member->Email",
                // TODO: The current logged in user's sign-up date as a Unix timestamp.
                created_at: $created,
                app_id: "$app_id"
  };    

JS
            );
            Requirements::customScript (<<<JS
                (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://api.intercom.io/api/js/library.js';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}};})()
JS
            );
        }
    }
}
