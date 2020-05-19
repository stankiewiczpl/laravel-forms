<input type="file"
           class="filepond_{{\Illuminate\Support\Str::slug($name)}}"
           name="{{$name}}"
           data-max-file-size="3MB"
           data-label-file-loading="ładowanie"
           data-label-idle='Przeciągnij zdjęcia lub <span class="filepond--label-action"> wybierz </span>'
           data-max-files="4">


<input type="hidden" name="sortOrder">

@push('js')
    <script>
        $(function () {

            $('.filepond_{{\Illuminate\Support\Str::slug($name)}}').filepond({
                imagePreviewHeight: 150,
                allowReorder: true,
                allowMultiple: true,
                itemInsertLocation: 'after',
                labelFileProcessing: 'wysyłanie',
                labelFileProcessingComplete: 'wysyłanie ukończone',
                labelTapToUndo: 'kliknij, aby cofnąć',
                labelTapToCancel: 'kliknij, aby wstrzymać',
                server: {
                    process: '{{route('image.upload')}}',
                    revert: '{{route('image.delete')}}',
                    remove: (source, load, error) => {
                        console.log('File removing:' + source);
                        $.ajax({
                            url: '{{route('image.delete')}}',
                            type: 'DELETE',
                            data: source,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                load();
                            }
                        });

                    },
                    fetch: '{{route('image.delete')}}',
                    load: '{{route('image.preview')}}/',
                    restore: '{{route('image.preview')}}/',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                files: [
                    @if(($options['value']) instanceof \Kalnoy\Nestedset\Collection)
                        @foreach($options['value'] as $value)
                        {
                            source: '{{$value->id}}',
                            options: {
                                type: 'local'
                            }
                        },
                        @endforeach
                    @endif

            ],
                onreorderfiles: function (elements) {
                    let newOrder = _.values(_.mapValues(elements , function(element) { return element.serverId; }));
                    $('input[name="sortOrder"]').val(newOrder);

                }
            });
        });
    </script>
@endpush
