@extends('layouts.app')
@section('title')
<title>Website Wizard</title>
@endsection

@section('styles')
<style>
.form-section {
  display: none;
}
.form-section.current {
  display: inherit;
}

.card-input-element+.card {
  color: var(--primary);
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 2px solid transparent;
  border-radius: 4px;
}

.card-input-element+.card:hover {
  cursor: pointer;
}

.card-input-element:checked+.card {
  border: 2px solid var(--primary);
  -webkit-transition: border .3s;
  -o-transition: border .3s;
  transition: border .3s;
}

.card-input-element:checked+.card::after {
  content: '\e5ca';
  color: #AFB8EA;
  font-family: 'Material Icons';
  font-size: 24px;
  -webkit-animation-name: fadeInCheckbox;
  animation-name: fadeInCheckbox;
  -webkit-animation-duration: .5s;
  animation-duration: .5s;
  -webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    position: absolute;
    top: 0px;
    right: 0px;
}

</style>
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title text-center"> Set Up Your Website</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">
    <div class="col-8 mx-auto">
        <div class="card">
         <div class="card-body">  
              @if(count($errors))
                <div class="form-group">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
              @endif     
                <form class="demo-form" action="{{ route('account.website.wizard.post') }}" method="post">
                  @CSRF
                  <div class="form-section">
                        <div class="row">
                            <div class="col-md-12 mx-auto">
                            
                            <div class="alert alert-info" role="alert">
                                Please enter the following information as you would like for it to be displayed on your website.
                            </div>
                            
                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Business Name <span class="text-danger">*</span></label>
                                           <input type="text" id="business_name" name="business_name" class="form-control required" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                           <label>Business Address <span class="text-danger">*</span></label>
                                           <input type="text" id="business_address" name="business_address" class="form-control required" placeholder="Enter Address">
                                        </div>                      
                                        <div class="row">
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                 <label>City <span class="text-danger">*</span></label>
                                                 <input type="text" id="business_city" name="business_city" class="form-control required" placeholder="Enter City">
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                 <label>State Or Province <span class="text-danger">*</span></label>
                                                 <input type="text" id="business_state" name="business_state" class="form-control required" placeholder="Enter State">
                                              </div>
                                           </div>
                                        </div>                      
                                     </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Business Phone</label>
                                           <input type="text" id="business_phone" name="business_phone" class="form-control" data-mask="(999) 999-9999" placeholder="Enter Phone (optional)">
                                        </div>                                         
                                        <div class="form-group">
                                           <label>Address 2</label>
                                           <input type="text" id="business_address_2" name="business_address_2" class="form-control" placeholder="Enter Address 2 (optional)">
                                        </div>
                                        <div class="row">
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                 <label>Zip Or Postal Code <span class="text-danger">*</span></label>
                                                 <input data-parsley-type="number" type="text" id="business_zip" name="business_zip" class="form-control required" placeholder="Enter Zip Code">
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                 <label>Country <span class="text-danger">*</span></label>
                                                 <select id="business_country" name="business_country" class="form-control required">
                                                    <option value="">Select</option>
                                                    @foreach($countries as $country)
                                                      <option value="{{ $country->id }}">
                                                        {{$country->name}}
                                                      </option>
                                                    @endforeach
                                                 </select>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="business_email">Business Email</label>
                                         <input type="email" id="business_email" name="business_email" class="form-control"  placeholder="Enter Email">
                                      </div>  
                                </div>
                            </div>
                        </div>
                        </div>
                  </div>
                  <div class="form-section">
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <div class="form-group">     
                                        <label>Site Domain <span class="text-danger">*</span></label>                                    
                                        <div class="input-group">
                                            <input type="text" class="form-control required" placeholder="subdomain" id="subdomain" name="subdomain">
                                            <div class="input-group-append">
                                               <span class="input-group-text">.{{ env('APP_DOMAIN') }}</span>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label>Site Primary Domain <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control required" placeholder="primary domain" id="primary_domain" name="primary_domain">
                                    </div>                                       
                                    <div class="form-group">
                                        <label>Site Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control required" placeholder="Type something" id="title" name="title">
                                    </div> 
                                    <div class="form-group">
                                        <label>Description Search Engines Should Use <span class="text-danger">*</span></label>
                                        <div>
                                            <textarea class="form-control required" rows="5" id="description" name="description"></textarea>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label>Keyword Phrases Search Engines Should Use (comma Separated) <span class="text-danger">*</span></label>
                                        <div>
                                            <textarea class="form-control required" rows="5" id="keywords" name="keywords"></textarea>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                  </div>

                  <div class="form-section">
                      <div class="row">
                        @if(!$websiteTheme->isEmpty())
                        @foreach($websiteTheme as $theme)
                            <div class="col-lg-4">
                              <label>
                                <input type="radio" name="theme_id" class="card-input-element d-none required" value="{{$theme->id}}">
                                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                  <img class="card-img img-fluid" src="{{ url('storage/themes/'.$theme->screenshot) }} " alt="Card image">
                                </div>
                              </label>
                            </div>
                        @endforeach
                        @else
                        <ul class="parsley-errors-list filled">
                          <li class="parsley-required">Theme is required.</li>
                        </ul>
                        @endif
                      </div>
                  </div>

                  <div class="form-navigation mt-3">
                    <button type="button" class="previous btn btn-info pull-left">&lt; Previous</button>
                    <button type="button" class="next btn btn-info pull-right">Next &gt;</button>
                    @if(!$websiteTheme->isEmpty())
                    <input type="submit" class="btn btn-default pull-right">
                    @endif
                    <span class="clearfix"></span>
                  </div>

                </form>
            </div>        
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript"></script>
    <!-- Parsley js -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>

<script type="text/javascript">
      var inp1 = document.getElementById("subdomain");
      inp1.oninput = function () {
          document.getElementById("primary_domain").disabled = this.value != "";
          $('#primary_domain').removeClass('required');
      };
      var inp2 = document.getElementById("primary_domain");
      inp2.oninput = function () {
          document.getElementById("subdomain").disabled = this.value != "";
          $('#subdomain').removeClass('required');
      };
</script>

<script type="text/javascript">
  $(function () {
     var $sections = $('.form-section');

        function navigateTo(index) {
          // Mark the current section with the class 'current'
          $sections
            .removeClass('current')
            .eq(index)
              .addClass('current');
          // Show only the navigation buttons that make sense for the current section:
          $('.form-navigation .previous').toggle(index > 0);
          var atTheEnd = index >= $sections.length - 1;
          $('.form-navigation .next').toggle(!atTheEnd);
          $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex() {
          // Return the current index by looking at which section has the class 'current'
          return $sections.index($sections.filter('.current'));
        }

        // Previous button is easy, just go back
        $('.form-navigation .previous').click(function() {
          navigateTo(curIndex() - 1);
        });

        // Next button goes forward iff current block validates
        $('.form-navigation .next').click(function() {
          $('.demo-form').parsley().whenValidate({
            group: 'block-' + curIndex()
          }).done(function() {
            navigateTo(curIndex() + 1);
          });
        });

        // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
        $sections.each(function(index, section) {
          $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });
        navigateTo(0); // Start at the beginning
      });

          // image gallery
          // init the state from the input
          $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
              $(this).addClass('image-checkbox-checked');
            }
            else {
              $(this).removeClass('image-checkbox-checked');
            }
          });

          // sync the state to the input
          $(".image-checkbox").on("click", function (e) {
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked",!$checkbox.prop("checked"))

            e.preventDefault();
          });  
        
</script>    
   
@endsection