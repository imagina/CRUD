<ul class="">
    @foreach($children as $child)
        <li>

            <label>
                <input type="checkbox" class="flat-blue jsInherit"
                       name="{{ $field['name'] }}[]"
                       value="{{ $child->id }}"

                       @if( ( old( $field["name"] ) && in_array($child->id, old( $field["name"])) ) || (isset($field['value']) && in_array($child->id, $field['value']->pluck('id', 'id')->toArray())))
                       checked = "checked"
                        @endif > {!! $child->{$field['attribute']} !!}
            </label>


            @if(count($child->children))
                @include('iblog::admin.fields.categories_checklist_child',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>