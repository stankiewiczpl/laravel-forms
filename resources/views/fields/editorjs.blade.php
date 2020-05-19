@if  ($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div <?= $options['wrapperAttrs'] ?> >
            @endif
            @endif

            @if($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
            @endif

            @if($showField)
                {{--
                {!! Form::hidden($type,  'editor_blocks[]['.$name.']', $options['value'], $options['attr']) !!}
                --}}
                @include('laravel-form-builder::help_block')
            @endif
            @include('laravel-form-builder::errors')

            @if($showLabel && $showField)
                @if($options['wrapper'] !== false)
        </div>
    @endif
@endif

<div id="editor_{{$name}}"></div>
<input type="text" name="{{$name}}" value="">

@push('js')


    <script>
        $(function () {
            var editor = new EditorJS({

                holderId: 'editor_{{transform_key($name)}}',
                placeholder: '...zacznij pisać.....',

                tools: {
                    header: {
                        class: Header,
                        inlineToolbar: ['link'],
                        config: {
                            placeholder: 'Header'
                        },
                        shortcut: 'CMD+SHIFT+H'
                    },
                    image: {
                        class: ImageTool,
                        config: {
                            endpoints: {
                                byFile: 'editor.image.upload', // Your backend file uploader endpoint
                                // byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by Url
                            },
                            additionalRequestData : {
                                _token :'{{ csrf_token() }}'
                            }
                        }
                    },

                    list: {
                        class: List,
                        inlineToolbar: true,
                        shortcut: 'CMD+SHIFT+L'
                    },

                    checklist: {
                        class: Checklist,
                        inlineToolbar: true,
                    },
                    personality: {
                        class: Personality,
                        inlineToolbar: true,
                        config: {
                            endpoint: 'editor.image.upload'
                        },
                        additionalRequestData : {
                            _token :'{{ csrf_token() }}'
                        }
                    },

                    quote: {
                        class: Quote,
                        inlineToolbar: true,
                        config: {
                            quotePlaceholder: 'Enter a quote',
                            captionPlaceholder: 'Quote\'s author',
                        },
                        shortcut: 'CMD+SHIFT+O'
                    },

                    warning: Warning,

                    //   marker: {
                    //       class: Marker,
                    //      shortcut: 'CMD+SHIFT+M'
                    //   },

                    code: {
                          class: CodeTool,
                          shortcut: 'CMD+SHIFT+C'
                       },

                    // delimiter: Delimiter,

                    //    inlineCode: {
                    //        class: InlineCode,
                    //        shortcut: 'CMD+SHIFT+C'
                    //    },

                     linkTool: LinkTool,

                    embed: {
                        class: Embed,
                        inlineToolbar: true,
                        config: {
                            services: {
                                youtube: true,
                                coub: true
                            }
                        }
                    },

                      table: {
                          class: Table,
                         inlineToolbar: true,
                         shortcut: 'CMD+ALT+T'
                      },

                },

                data:  {!! $options['value'] !!},

                onChange: function () {
                    editor.save().then(function (savedData) {
                        $('input[name={{$name}}]').val(JSON.stringify(savedData));
                       // $('input[name="editor_blocks[][{{ $name }}]"]').val(JSON.stringify(savedData));
                        //    console.log($('input[name={{$name}}]').val());
                    });
                },
                onReady : function () {
                    editor.save().then(function (savedData) {
                        $('input[name={{$name}}]').val(JSON.stringify(savedData));
                       // $('input[name="editor_blocks[][{{ $name }}]"]').val(JSON.stringify(savedData));
                        //    console.log($('input[name={{$name}}]').val());
                    });
                }

            });

        });


    </script>

@endpush
