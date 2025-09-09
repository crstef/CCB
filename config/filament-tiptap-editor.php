<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Profiles
    |--------------------------------------------------------------------------
    |
    | Profiles allow you to configure different sets of tools for different
    | contexts. You can use multiple profiles in the same form.
    |
    */
    'profiles' => [
        'default' => [
            'blocks' => [
                'heading',
                'paragraph',
                'ordered-list',
                'bullet-list',
                'checked-list',
                'blockquote',
                'hr',
                'code-block',
                'table',
                'media',
                'oembed',
            ],
            'marks' => [
                'bold',
                'italic',
                'strike',
                'underline',
                'superscript',
                'subscript',
                'small',
                'text-color',
                'highlight',
                'align-left',
                'align-center',
                'align-right',
                'align-justify',
                'link',
            ],
        ],
        'simple' => [
            'blocks' => [
                'paragraph',
                'ordered-list',
                'bullet-list',
                'blockquote',
                'hr',
            ],
            'marks' => [
                'bold',
                'italic',
                'link',
            ],
        ],
        'minimal' => [
            'blocks' => [
                'paragraph',
            ],
            'marks' => [
                'bold',
                'italic',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Direction
    |--------------------------------------------------------------------------
    |
    | Set the default direction for the editor.
    |
    */
    'direction' => 'ltr',

    /*
    |--------------------------------------------------------------------------
    | Merge Tags
    |--------------------------------------------------------------------------
    |
    | Merge tags allow you to add custom tags to the editor that can be
    | merged into the content. This is useful for dynamic content.
    |
    */
    'merge_tags' => [],

    /*
    |--------------------------------------------------------------------------
    | Output
    |--------------------------------------------------------------------------
    |
    | The output format for the editor. Can be 'html', 'json', or 'text'.
    |
    */
    'output' => 'html',

    /*
    |--------------------------------------------------------------------------
    | Accepted File Types
    |--------------------------------------------------------------------------
    |
    | The accepted file types for media uploads.
    |
    */
    'accepted_file_types' => [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/svg+xml',
        'image/gif',
        'application/pdf',
    ],

    /*
    |--------------------------------------------------------------------------
    | Disk
    |--------------------------------------------------------------------------
    |
    | The disk to use for media uploads.
    |
    */
    'disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Directory
    |--------------------------------------------------------------------------
    |
    | The directory to use for media uploads.
    |
    */
    'directory' => 'uploads',

    /*
    |--------------------------------------------------------------------------
    | Extensions
    |--------------------------------------------------------------------------
    |
    | The extensions to enable for the editor.
    |
    */
    'extensions' => [
        'typography',
        'text-align',
        'focus',
        'dropcursor',
        'gapcursor',
    ],

    /*
    |--------------------------------------------------------------------------
    | Editor Class
    |--------------------------------------------------------------------------
    |
    | The CSS class to add to the editor.
    |
    */
    'editor_class' => 'prose prose-sm sm:prose-base lg:prose-lg xl:prose-xl mx-auto focus:outline-none',

    /*
    |--------------------------------------------------------------------------
    | Bubble Menu Tools
    |--------------------------------------------------------------------------
    |
    | The tools to show in the bubble menu.
    |
    */
    'bubble_menu_tools' => [
        'bold',
        'italic',
        'strike',
        'link',
        'code',
        'small',
        'underline',
        'superscript',
        'subscript',
        'align-left',
        'align-center',
        'align-right',
    ],

    /*
    |--------------------------------------------------------------------------
    | Floating Menu Tools
    |--------------------------------------------------------------------------
    |
    | The tools to show in the floating menu.
    |
    */
    'floating_menu_tools' => [
        'heading',
        'bullet-list',
        'ordered-list',
        'checked-list',
        'blockquote',
        'hr',
        'code-block',
        'table',
        'media',
        'oembed',
    ],
];
