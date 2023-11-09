<?php

return [
    'message' => [
        'login' => [
            'success' => 'Login succeeded.',
            'failed' => 'Login failed.'
        ],
        'logout' => [
            'success' => 'Logout succeeded.',
            'failed' => 'Logout failed.'
        ],
        'default' => [
            'success' => 'Action process succeeded.',
            'failed' => 'Some error ocured. Process failed.',

            'post_too_large' => 'Size of attached file should be less :upload_max_filesize B.',
            'unauthenticated' => 'Unauthenticated or Token Expired, Please Login.',
            'too_many_request' => 'Too Many Requests, Please Slow Down.',
            'model_not_found' => 'Oops, Data for :model not found',
            'error_query' => 'There was Issue with the Query',
            'error' => 'There was some internal error',

            'unauthorized' => 'You are not authorized to access this feature.',
        ],

        'register' => [
            'success' => 'Registered! Please verify your email address.',
            'failed' => 'Create data failed.'
        ],

        'read' => [
            'success' => 'Data sucess.',
            'failed' => 'Data failed.'
        ],
        'create' => [
            'success' => 'Data successfully created.',
            'failed' => 'Create data failed.'
        ],
        'update' => [
            'success' => 'Data successfully updated.',
            'failed' => 'Update data failed.'
        ],
        'delete' => [
            'success' => 'Data successfully deleted.',
            'failed' => 'Delete data failed.'
        ],
        'approve' => [
            'success' => 'Data has been approved.',
            'failed' => 'Approve data failed.'
        ],
        'reject' => [
            'success' => 'Data has been rejected.',
            'failed' => 'Reject data failed.'
        ],
    ]
];
