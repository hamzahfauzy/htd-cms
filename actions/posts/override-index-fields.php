<?php

unset($fields['name']);
unset($fields['type_as']);
unset($fields['thumb_url']);
unset($fields['template']);
unset($fields['content']);

$fields['categories'] = [
    'label' => 'categories',
    'type'  => 'text',
    'search' => false
];

$fields['created_at'] = [
    'label' => 'date',
    'type'  => 'text'
];

return $fields;