<?php
/*
 * class Intercom
 */

class Intercom extends DataExtension {
    static $db = array (
        'IntercomAppID' => "Varchar"
    );
    
    public function updateCMSFields (FieldList $fields) {
        $fields->addFieldToTab('Root.Main', new TextField
                    ('IntercomAppID', 'Intercom App ID'));
    }
}
