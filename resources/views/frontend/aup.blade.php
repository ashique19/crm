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
        <h1>Acceptable Use Policy</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')


   <div class="row">
      <div class="col-md-12 wow fadeInLeft animated animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms;">
   <p>This Acceptable Use Policy, hereafter refereed to as AUP, governs the use of {{ env('APP_DOMAIN') }} web service. Violation of this AUP may result in suspension or termination of your service. In the event of a dispute between you and {{ env('APP_DOMAIN') }} regarding the interpretation of this AUP, {{ env('APP_DOMAIN') }} interpretation, in its reasonable commercial judgment, shall govern. If you have any questions regarding this AUP, <a href="{{route('contact')}}">contact us</a>.</p> 
				
				<h4>Offensive Content</h4>
				<p>You may not publish or transmit via {{ env('APP_DOMAIN') }} service any content that {{ env('APP_DOMAIN') }} reasonably believes:</p>
				
				<ul class="list-1">
					<li>constitutes child pornography;</li> 
					<li>constitutes pornography;</li> 
					<li>is excessively violent, incites violence, threatens violence, or contains harassing content or hate speech;</li> 
					<li>is unfair or deceptive under the consumer protection laws of any jurisdiction, including chain letters and pyramid schemes;</li> 
					<li>is defamatory or violates a person's privacy;</li> 
					<li>creates a risk to a person's safety or health, creates a risk to public safety or health, compromises national security, or interferes with a investigation by law enforcement;</li> 
					<li>improperly exposes trade secrets or other confidential or proprietary information of another person;</li> 
					<li>is intended to assist others in defeating technical copyright protections;</li> 
					<li>clearly infringes on another person's trade or service mark, patent, or other property right;</li> 
					<li>promotes illegal drugs, violates export control laws, relates to illegal gambling, or illegal arms trafficking;</li> 
					<li>is otherwise illegal or solicits conduct that is illegal under laws applicable to you or to {{ env('APP_DOMAIN') }}, LLC; or</li> 
					<li>is otherwise malicious, fraudulent, or may result in retaliation against {{ env('APP_DOMAIN') }} by offended viewers.</li> 
				</ul>

				<p>Content published or transmitted via {{ env('APP_DOMAIN') }} service includes Web content, e-mail, bulletin board postings, chat, and any other type of posting or transmission that relies on any Internet service provided by {{ env('APP_DOMAIN') }}.</p> 
				
				
				<h4>Security</h4>
				<p>You must take reasonable security precautions. You must protect the confidentiality of your password, and you should change your password periodically.</p> 
				
				
				<h4><br>Bulk Commercial E-Mail</h4>			
				<p>You must obtain {{ env('APP_DOMAIN') }}, advance approval for any bulk commercial e-mail, which will not be given unless you are able to demonstrate all of the following to {{ env('APP_DOMAIN') }}, reasonable satisfaction:</p>
				<ul class="list-1">
					<li>Your intended recipients have given their consent to receive e-mail via some affirmative means, such as an opt-in procedure;</li> 
					<li>Your procedures for soliciting consent include reasonable means to ensure that the person giving consent is the owner of the e-mail address for which the consent is given;</li> 
					<li>You retain evidence of the recipient's consent in a form that may be promptly produced on request, and you honor recipient's and {{ env('APP_DOMAIN') }}, requests to produce consent evidence within 72 hours of receipt of the request.</li> 
					<li>The body of the e-mail must describe how the e-mail address was obtained, for example, "You opted in to receive this e-mail promotion from our Web site or from one of our partner sites," and information on how to request evidence of the consent, for example, "If you would like to learn more about how we received your e-mail address please contact us at abuse@**yourdomain.com**.</li> 
					<li>You have procedures in place that allow a recipient to easily revoke their consent such as a link in the body of the e-mail, or instructions to reply with the word "Remove" in the subject line. Revocations of consent are honored within 72 hours, and you notify recipients that their revocation of their consent will be honored in 72 hours;</li> 
					<li>You must post an abuse@**yourdomain.com** e-mail address on the first page of any Web site associated with the e-mail, you must register that address at abuse.net, and you must promptly respond to messages sent to that address;</li> 
					<li>You must have a Privacy Policy posted for each domain associated with the mailing;</li> 
					<li>You have the means to track anonymous complaints;</li> 
					<li>You may not obscure the source of your e-mail in any manner. Your e-mail must include the recipients e-mail address in the body of the message or in the TO line of the e-mail; and</li> 
					<li>You otherwise comply with the CAN SPAM Act and other applicable law.</li> 
				</ul>

				<p>These policies apply to messages sent using your {{ env('APP_DOMAIN') }} service, or to messages sent from any network by you or any person on your behalf that directly or indirectly refer the recipient to a site hosted via your {{ env('APP_DOMAIN') }} service. In addition, you may not use a third party e-mail service that does not practice similar procedures for all its customers.</p> 

				<p>{{ env('APP_DOMAIN') }} may test and otherwise monitor your compliance with its requirements, including requesting opt-in information from a random sample of your list at any time.</p> 
				
				
				<h4>Revision Notice</h4> 
				<p>Customer agrees that {{ env('APP_DOMAIN') }} may, in its reasonable commercial judgment consistent with industry standards, amend the AUP from time to time to further detail or describe reasonable restrictions and conditions on Customer's use of the Services. Amendments to the AUP are effective on the earlier of {{ env('APP_DOMAIN') }}, notice to Customer that an amendment has been made, or the first day of any Renewal Term that begins subsequent to the amendment. Customer agrees to cooperate with {{ env('APP_DOMAIN') }}, reasonable investigation of any suspected violation of the AUP. In the event of a dispute between {{ env('APP_DOMAIN') }} and Customer regarding the interpretation of the AUP, {{ env('APP_DOMAIN') }}, commercially reasonable interpretation of the AUP shall govern. You must comply with the rules of any other network you access or participate in using your {{ env('APP_DOMAIN') }}'s services.</p> 
				
				
				<h4>Material Protected by Copyright</h4> 
				<p>You may not publish, distribute, or otherwise copy in any manner any music, software, art, or other work protected by copyright law unless:</p>
				
				<ul class="list-1">
					<li>you have been expressly authorized by the owner of the copyright for the work to copy the work in that manner;</li> 
					<li>you are otherwise permitted by established United States copyright law to copy the work in that manner.</li> 
				 </ul>

				<p>{{ env('APP_DOMAIN') }} will terminate the service of repeat copyright infringers.</p> 
				
				
				<h4>Other</h4>
				<p>You must have valid and current information on file with your domain name registrar for any domain hosted on the {{ env('APP_DOMAIN') }} network.</p> 
				
				
				<h4>Disclaimer</h4>
				<p class="bottom25">{{ env('APP_DOMAIN') }} is under no duty, and does not by this AUP undertake a duty, to monitor or police our customers' activities and disclaims any responsibility for any misuse of the {{ env('APP_DOMAIN') }} network.</p>   
      </div>
    </div>



@endsection
