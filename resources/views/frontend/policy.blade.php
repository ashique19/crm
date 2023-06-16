@extends('layouts.app')

@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:type" content="website" />    
@endsection

@section('splash')

<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Privacy Policy</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')

    <div class="row">
      <div class="col-md-12 wow fadeInLeft animated animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms;">
            
  <p>This Privacy Policy describes the information we collect from you, what we do with the information, and our information security practices. If you have any questions about our Privacy Policy, please <a href="{{route('contact')}}">contact us</a></p>
			
				<h4><a id="info">Information</a></h4>

				<p>When you sign up for our service, we will ask you to provide contact information such as your name, address, telephone numbers, e-mail addresses, and payment information such as credit card number and expiration date.</p>
				<p>We may ask you to complete user surveys, and to provide certain demographic information, such as age, gender, special interests, etc. You do not have to provide this type of information to use our service if you do not want to.</p>
				<p>If you contact us for customer support, we may also ask you for information about your operating system, software and other technical matters.</p>
				<p>When you visit our Web site we will capture your IP Address, time of and duration of visit, and time and duration of the pages on our Web site that you view. We may tie this information to the personally identifiable information we have about you.</p>
				<p>We will also place a cookie that will identify you to us as a repeat visitor or a customer when you visit our Web site. See <a href="#cookie">"What is a Cookie"</a> below. We may tie this cookie to the personally identifiable information we have about you. [If we send you an e-mail, we may include a marker that will allow to identify e-mail that is opened and viewed.</p>

				<h4><a id="pii">Use of Personally Identifiable Information</a></h4>
				<p>We will use your personally identifiable information only as follows:</p>
				<ul class="list-1">
					<li>For payment purposes and to provide customer support;</li>
					<li>To announce special offers or provide other information from time to time via e-mail. We may also send e-mail announcing special offers by our third parties, but we will not provide the third parties with your e-mail address or other personally identifiable information. If you do not wish to receive these e-mails, you may opt out of future e-mails at any time by following the instructions included in the e-mail.</li>

					<li>To improve our service and the marketing of our service. For example, we may use the information we gather from user surveys, demographic data, and web site visits to help us improve or target our Web site and customize your visit. We will not provide any personally identifiable information about you to any other person other than:
						<ul>
							<li>a law enforcement or regulatory agency at their request; </li>
							<li>a person or company who acquires our business; </li>
							<li>third parties who perform services on our behalf (such as payment processing), subject to the third party agreeing with us that it will keep your personally dentifiable information confidential; or As otherwise needed to protect or enforce or rights or the rights of others. </li>
						</ul>
					</li>
				</ul>

				<p><strong>We absolutely do not transfer or sell your information for inclusion on third party e-mail or other marketing lists.</strong></p>

				
				<h4><a id="npii">Use of Non-Personally Identifiable Information</a></h4>
				<p>We may share aggregate statistical data about our customers with third parties, such as advertisers or suppliers. This aggregate statistical data will not identify you personally.</p>

				
				<h4><a id="cookie">What is a Cookie?</a></h4>

				<p>A "cookie" is an alphanumeric identifier that is unique to your browser. The cookie will identify your browser to us when you visit our web site so that we may customize your visit.</p>

				
				<h4><a id="cp">Children's Privacy</a></h4>
				<p class="bottom25">Our service is not available to children under the age of 13, and we will not intentionally maintain information about anyone under the age of 13.</p>
       

      </div>
    </div>


@endsection
