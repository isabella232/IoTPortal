<?php

return [
    'device_statuses' => [
        'registered' => 0,
        'provisioned' => 1
    ],

    'mqtt_methods' => [
        'ota' => 'triggerota',
        'aota' => 'triggeraota',
        'fota' => 'triggerfota',
        'sota' => 'triggersota',
        'cota' => 'triggerconfig',
        'shutdown_device' => 'shutdown_device',
        'reboot_device' => 'reboot_device',
        'decommission_device' => 'decommission_device',
        'file_upload' => 'file_upload'
    ],

    'mqtt_methods_integer_types' => [
        'triggerota' => 0,
        'triggeraota' => 1,
        'triggerfota' => 2,
        'triggersota' => 3,
        'triggerconfig' => 4,
        'shutdown_device' => 5,
        'reboot_device' => 6,
        'decommission_device' => 7,
        'file_upload' => 8
    ],

    'vernemq_hook' => [
        'auth_on_register' => 'auth_on_register',
        'auth_on_subscribe' => 'auth_on_subscribe',
        'auth_on_publish' => 'auth_on_publish',
        'on_register' => 'on_register',
        'on_publish' => 'on_publish',
        'on_subscribe' => 'on_subscribe',
        'on_unsubscribe' => 'on_unsubscribe',
        'on_deliver' => 'on_deliver',
        'on_offline_message' => 'on_offline_message',
        'on_client_wakeup' => 'on_client_wakeup',
        'on_client_offline' => 'on_client_offline',
        'on_client_gone' => 'on_client_gone',
        'auth_on_register_m5' => 'auth_on_register_m5',
        'on_auth_m5' => 'on_auth_m5',
        'auth_on_subscribe_m5' => 'auth_on_subscribe_m5',
        'auth_on_publish_m5' => 'auth_on_publish_m5',
        'on_register_m5' => 'on_register_m5',
        'on_publish_m5' => 'on_publish_m5',
        'on_subscribe_m5' => 'on_subscribe_m5',
        'on_unsubscribe_m5' => 'on_unsubscribe_m5',
        'on_deliver_m5' => 'on_deliver_m5'
    ],

    'aota_configurations_map' => [
        'app' => 'app',
        'command' => 'cmd',
        'tag' => 'containerTag',
        'reboot' => 'deviceReboot',
        'fetch_link' => 'fetch',
        'signature' => 'signature',
        'version' => 'version',
        'server_username' => 'username',
        'server_password' => 'password',
        'docker_registry' => 'dockerRegistry',
        'docker_username' => 'dockerUsername',
        'docker_password' => 'dockerPassword',
        'docker_compose_file' => 'file'
    ],

    'fota_configurations_map' => [
        'bios_version' => 'biosversion',
        'fetch' => 'fetchfetch',
        'manufacturer' => 'manufacturer',
        'path' => 'path',
        'product' => 'product',
        'release_date' => 'releasedate',
        'signature' => 'signature',
        'tool_options' => 'tooloptions',
        'vendor' => 'vendor',
        'server_username' => 'username',
        'server_password' => 'password'
    ],

    'sota_configurations_map' => [
        'command' => 'cmd',
        'fetch' => 'fetch',
        'log' => 'log_to_file',
        'username' => 'username',
        'password' => 'password'
    ],

    'cota_configurations_map' => [
        'command' => 'cmd',
        'fetch' => 'fetch',
        'path' => 'path',
        'signature' => 'signature',
    ],

];