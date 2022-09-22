@foreach($categories as $category)
<div class="accordion-group">
    <div class="accordion-heading"> <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
            @if(session()->get('language') == 'hindi') {{ $category->category_name_hin }} @else {{ $category->category_name_en }} @endif </a> </div>
    <!-- /.accordion-heading -->
    <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
        <div class="accordion-inner">

            @php
            $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
            @endphp

            @foreach($subcategories as $subcategory)
            <ul>
                <li><a href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
                        @if(session()->get('language') == 'hindi') {{ $subcategory->subcategory_name_hin }} @else {{ $subcategory->subcategory_name_en }} @endif</a></li>

            </ul>
            @endforeach


        </div>
        <!-- /.accordion-inner -->
    </div>
    <!-- /.accordion-body -->
</div>
<!-- /.accordion-group -->
@endforeach