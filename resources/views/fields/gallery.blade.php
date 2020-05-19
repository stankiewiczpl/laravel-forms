@if ($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {{$options['wrapperAttrs']}} >
    @endif
@endif

@if ($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif
            {{--
            <input type="file"
                   accept="image/*"
                   class="filepond_{{$name}} invisible"
                   name="gallery[{{ $name }}][files][]"
                   data-max-file-size="3MB"
                   data-label-file-loading="ładowanie"
                   data-label-idle='Przeciągnij zdjęcia lub <span class="filepond--label-action"> wybierz </span>'
                   >

            <input type="file" accept="image/*" class="filepond_{{$name}} invisible" name="gallery[{{ $name }}][files][]" data-max-file-size="3MB" data-label-file-loading="ładowanie" data-label-idle='Przeciągnij zdjęcia lub <span class="filepond--label-action"> wybierz </span>'>
            <input type="text" name="gallery[{{$name}}][order]">
             --}}


            <input type="file" accept="image/*" class="filepond_{{$name}} invisible" name="{{ $name }}[files][]" data-max-file-size="3MB" data-label-file-loading="ładowanie" data-label-idle='Przeciągnij zdjęcia lub <span class="filepond--label-action"> wybierz </span>'>
            <input type="hidden" name="{{ $name }}[order]">

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif

@push('js')

    <script>
        $(function () {
            $('.filepond_{{$name}}').filepond({
                acceptedFileTypes: ['image/png', 'image/jpeg'],
                imagePreviewHeight: 150,
                allowReorder: true,
                allowMultiple: true,
                itemInsertLocation: 'after',
                labelFileProcessing: 'wysyłanie',
                labelFileProcessingComplete: 'wysyłanie ukończone',
                labelTapToUndo: 'kliknij, aby cofnąć',
                labelTapToCancel: 'kliknij, aby wstrzymać',
                server: {
                    process: '{{route('gallery.image.upload')}}',
                    revert: '{{route('gallery.image.delete')}}',
                    remove: (source, load, error) => {
                        console.log('File removing:' + source);
                        $.ajax({
                            url: '{{route('gallery.image.delete')}}',
                            type: 'DELETE',
                            data: {uuid:source},
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function (result) {
                                load();
                            }
                        });

                    },
                    fetch: '{{route('gallery.image.delete')}}',
                    load: '{{route('gallery.image.preview')}}/',
                    restore: '{{route('gallery.image.preview')}}/',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'collection': '{{ $name }}',
                    }
                },
                files: [
                        @if(($options['value']) instanceof \Kalnoy\Nestedset\Collection)
                        @foreach($options['value'] as $value)
                    {
                        source: '{{$value->uuid}}',
                        options: {
                            type: 'local'
                        }
                    },
                    @endforeach
                    @endif

                ],
                onreorderfiles: function (elements) {
                    let newOrder = _.values(_.mapValues(elements, function (element) {
                        return element.serverId;
                    }));
                   // $('input[name="gallery[{{$name}}][order]"]').val(newOrder);
                    $('input[name="{{$name}}[order]"]').val(newOrder);

                }
            });
            $('.filepond_{{$name}}').removeClass('invisible');
        });
    </script>
@endpush
