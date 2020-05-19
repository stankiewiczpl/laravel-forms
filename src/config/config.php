<?php

return [
    'editorjs' => [
        'render' => [
            'tools' => [
                'header' => [
                    'text' => [
                        'type' => 'string',
                        'allowedTags' => ''
                    ],
                    'level' => [
                        'type' => 'int',
                        'canBeOnly' => [2, 3, 4]
                    ]
                ],
                'embed' => [
                    'service' => ['type' => 'string'],
                    'source' => ['type' => 'string'],
                    'embed' => ['type' => 'string'],
                    'width' => ['type' => 'integer'],
                    'height' => ['type' => 'integer'],
                    'caption' => ['type' => 'string']
                ],
                'warning' => [
                    'title' => [
                        'type' => 'string',
                        'allowedTags' => ''
                    ],
                    'message' => [
                        'type' => 'string',
                        'allowedTags' => ''
                    ]
                ],
                'paragraph' => [
                    'text' => [
                        'type' => 'string',
                        'allowedTags' => 'i,b,u,a[href]'
                    ]
                ],
                'image' => [
                    'file' => [
                        'type' => 'array',
                        'data' => [
                            'url' => ['type' => 'string'],
                            'id' => ['type' => 'integer', 'required' => false]
                        ]
                    ],
                    'caption' => [
                        'type' => 'string'
                    ],
                    'stretched' => ['type' => 'boolean'],
                    'withBackground' => ['type' => 'boolean'],
                    'withBorder' => ['type' => 'boolean'],
                ],
                'linkTool' => [
                    'link' => 'string',
                    'meta' => [
                        'type' => 'array',
                        'data' => [
                            'url' => [
                                'type' => 'string'
                            ],
                            'domain' => [
                                'type' => 'string'
                            ],
                            'title' => [
                                'type' => 'string'
                            ],
                            'description' => [
                                'type' => 'string'
                            ],
                            'image' => [
                                'type' => 'array',
                                'data' => [
                                    'url' => [
                                        'type' => 'string'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'list' => [
                    'style' => [
                        'type' => 'string',
                        'canBeOnly' => ['ordered', 'unordered']
                    ],
                    'items' => [
                        'type' => 'array',
                        'data' => [
                            '-' => [
                                'type' => 'string',
                                'allowedTags' => 'i,b,u'
                            ]
                        ]
                    ]
                ],
                'checklist' => [
                    'items' => [
                        'type' => 'array',
                        'data' => [
                            '-' => [
                                'type' => 'array',
                                'data' => [
                                    'text' => [
                                        'type' => 'string',
                                        'allowedTags' => 'i,b,u'
                                    ],
                                    'checked' => [
                                        'type' => 'boolean'
                                    ]
                                ]
                            ],
                        ]
                    ]
                ],
                'quote' => [
                    'text' => [
                        'type' => 'string',
                        'allowedTags' => 'i,b,u'
                    ],
                    'caption' => [
                        'type' => 'string'
                    ],
                    'alignment' => [
                        'type' => 'string',
                        'canBeOnly' => ['left', 'center']
                    ]
                ],
                'table' => [
                    'header' => [
                        'type' => 'array',
                        'data' => [
                            'description' => [
                                'type' => 'string'
                            ],
                            'author' => [
                                'type' => 'string'
                            ]
                        ]
                    ],
                    'rows' => [
                        'type' => 'array',
                        'data' => [
                            '-' => [
                                'type' => 'array',
                                'data' => [
                                    '-' => [
                                        'type' => 'string'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'editor' => [
            'tools' => [
                'header' => [
                    'class' => 'Header',
                    'inlineToolbar' => ['link'],
                    'config' => [
                        'placeholder' => 'Header'
                    ],
                    'shortcut' => 'CMD+SHIFT+H'
                ],
                'image' => [
                    'class' => 'SimpleImage',
                    'inlineToolbar' => ['link'],
                ],

                'list' => [
                    'class' => 'List',
                    'inlineToolbar' => true,
                    'shortcut' => 'CMD+SHIFT+L'
                ],

                'checklist' => [
                    'class' => 'Checklist',
                    'inlineToolbar' => true,
                ],
                'personality' => [
                    'class' => 'Personality',
                    'inlineToolbar' => true,
                    'config' => [
                        'endpoint' => 'http=>//localhost=>8008/uploadFile'
                    ]
                ],

                'quote' => [
                    'class' => 'Quote',
                    'inlineToolbar' => true,
                    'config' => [
                        'quotePlaceholder' => 'Enter a quote',
                        'captionPlaceholder' => 'Quote\'s author',
                    ],
                    'shortcut' => 'CMD+SHIFT+O'
                ],

                'warning' => 'Warning',

                'marker' => [
                    'class' => 'Marker',
                    'shortcut' => 'CMD+SHIFT+M'
                ],

                'code' => [
                    'class' => 'CodeTool',
                    'shortcut' => 'CMD+SHIFT+C'
                ],

                'delimiter' => 'Delimiter',

                'inlineCode' => [
                    'class' => 'InlineCode',
                    'shortcut' => 'CMD+SHIFT+C'
                ],

                'linkTool' => 'LinkTool',

                'embed' => 'Embed',

                'table' => [
                    'class' => 'Table',
                    'inlineToolbar' => true,
                    'shortcut' => 'CMD+ALT+T'
                ],

            ],
        ]
    ]

];
