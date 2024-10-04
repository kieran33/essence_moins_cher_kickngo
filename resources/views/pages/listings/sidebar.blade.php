<div class="sidebar">
    <div class="card">
    <div class="card-body">
            <h4 class="card-title mb-3">{{trans('words.search_listing')}}</h4>
            {!! Form::open(array('url' => 'entreprise/','method'=>'get','class'=>'','id'=>'search','role'=>'form')) !!}
            <div class="form-group">
                <span class="fal fa-search form-icon"></span>
                <input class="form-control form--control" type="text" name="search_text" value="{{isset($_GET['search_text'])?$_GET['search_text']:''}}" placeholder="{{trans('words.search')}}..." value="">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form--control typeahead-cat" placeholder="{{trans('words.category')}}">
                <span class="fal fa-search form-icon"></span>
                <input type="hidden" name="cat_id">
            </div>
                <div class="form-group">
                    <select class="select-picker" name="sub_cat_id" data-width="100%" data-size="5" data-live-search="true">
                        <option value="">{{trans('words.select_subcategory')}}</option>                             
                        @foreach(\App\Models\SubCategories::get() as $subcategory) 
                        <option value="{{$subcategory->id}}">{{$subcategory->sub_category_name}}</option> 
                        @endforeach                                                     
                    </select>
                </div>
            <button class="primary_item_btn border-0 w-100" type="submit">{{trans('words.search')}}</button>
           {!! Form::close() !!} 
        </div>
    </div>    
     
    
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-3">{{trans('words.filter_by_ratings')}}</h2>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" id="fiveStarRadio" name="radio-stacked" value="5" @if(isset($_GET['rate']) AND $_GET['rate']==5) checked @endif>
                <label class="custom-control-label" for="fiveStarRadio">
                    <div class="star-rating line-height-24 font-size-15" data-rating="5"></div>
                </label>
            </div>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" id="fourStarRadio" name="radio-stacked" value="4" @if(isset($_GET['rate']) AND $_GET['rate']==4) checked @endif>
                <label class="custom-control-label" for="fourStarRadio">
                    <div class="star-rating line-height-24 font-size-15" data-rating="4"></div>
                </label>
            </div>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" id="threeStarRadio" name="radio-stacked" value="3" @if(isset($_GET['rate']) AND $_GET['rate']==3) checked @endif>
                <label class="custom-control-label" for="threeStarRadio">
                    <div class="star-rating line-height-24 font-size-15" data-rating="3"></div>
                </label>
            </div>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" id="twoStarRadio" name="radio-stacked" value="2" @if(isset($_GET['rate']) AND $_GET['rate']==2) checked @endif>
                <label class="custom-control-label" for="twoStarRadio">
                    <div class="star-rating line-height-24 font-size-15" data-rating="2"></div>
                </label>
            </div>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" id="oneStarRadio" name="radio-stacked" value="1" @if(isset($_GET['rate']) AND $_GET['rate']==1) checked @endif>
                <label class="custom-control-label" for="oneStarRadio">
                    <div class="star-rating line-height-24 font-size-15" data-rating="1"></div>
                </label>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>