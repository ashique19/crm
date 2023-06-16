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
        <h1>Terms of Service</h1>
      </div>
    </div>
  </div>
</div>

@endsection


@section('content')

<div class="row">
      <div class="col-md-12 wow fadeInLeft animated animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms;">
       
   <p>This Web Agreement is between {{ env('APP_DOMAIN') }} and the person whose signs {{ env('APP_DOMAIN') }}'s service order and set up form incorporating this Agreement by reference. This Agreement governs Customer's use of {{ env('APP_DOMAIN') }}'s Web service.</p>
				
				<h4><a id="services">Services</a></h4>
				<p>Subject to the terms of this Agreement, and contingent on Customer's satisfaction of {{ env('APP_DOMAIN') }}'s credit approval requirements, {{ env('APP_DOMAIN') }} agrees to provide the web services described in the Order for the fees stated in the Order.</p>

				
				<h4><a id="term">Term</a></h4>
				<p>The initial service term of the Agreement shall begin on the date that {{ env('APP_DOMAIN') }} generates an e-mail message to Customer announcing the activation of the Customer's account and shall continue for the number of months stated in the Order. Upon expiration of the Initial Term, this Agreement shall automatically renew for up to three successive renewal terms of the same length as the Initial Term unless {{ env('APP_DOMAIN') }} or Customer provides the other with written notice of non-renewal at least thirty (30) days prior to the expiration of the Initial Term or then-current Renewal Term, as applicable. The Initial Term and any Renewal Term may be referred to collectively in this Agreement as the "Term."</p>
				
				<h4><a id="payments">Payments</a></h4>
				<p class="margin-top-15"><strong>(a) Fees.</strong></p>
				<p>Fees are payable in advance on the first day of each billing cycle. Customer's billing cycle shall be monthly or annually as indicated on the Order, beginning on the Service Commencement Date. {{ env('APP_DOMAIN') }} may require payment for the first billing cycle before beginning service. If the Order provides for credit/debit card billing, Customer authorizes {{ env('APP_DOMAIN') }} to bill subsequent fees to the credit/debit card on or after the first day of each successive billing cycle during the Term of this Agreement; otherwise {{ env('APP_DOMAIN') }} will invoice Customer via electronic mail to the Primary Customer Contact listed on the Order. Invoiced fees may be issued on or before the 1st day of each billing cycle, and the fees shall be due on the 14th day following invoice date, but in no event earlier than the first day of each billing cycle.</p>

				<p>Payments must be made in United States dollars. Customer is responsible for providing {{ env('APP_DOMAIN') }} with changes to billing information (such as credit card expiration, change in billing address) At its option, {{ env('APP_DOMAIN') }} may accrue charges to be made to a credit/debit card until such charges exceed $10.00. {{ env('APP_DOMAIN') }} may charge interest on overdue amounts at the lesser of 1.5% per month or the maximum non-usurious rate under applicable law. {{ env('APP_DOMAIN') }} may suspend the service without notice if payment for the service is overdue. Fees not disputed within sixty (60) days of due date are conclusively deemed accurate. Customer agrees to pay {{ env('APP_DOMAIN') }}'s reasonable reinstatement fee following a suspension of service for non-payment, and to pay {{ env('APP_DOMAIN') }}'s reasonable costs of collection of overdue amounts, including collection agency fees, attorney fees and court costs.</p>
				<p><strong>(b) Fee Increases.</strong></p>
				<p>{{ env('APP_DOMAIN') }} may increase its fees for services effective the first day of a Renewal Term by giving notice to Customer of the new fees at least forty five (45) days prior to the beginning of the Renewal Term, and if Customer does not give a notice of non-renewal as provided in Section 2 above, the Customer shall be deemed to have accepted the new fee for that Renewal Term and any subsequent Renewal Terms (unless the fees are increased in the same manner for a subsequent Renewal Term).</p>
				<p><strong>(c) Taxes.</strong></p>
				<p>At {{ env('APP_DOMAIN') }}'s request Customer shall remit to {{ env('APP_DOMAIN') }} all sales, VAT or similar tax imposed on the provision of the services (but not in the nature of an income tax on {{ env('APP_DOMAIN') }}), regardless of whether {{ env('APP_DOMAIN') }} fails to collect the tax at the time the related services are provided.</p>
				<p><strong>(d) Early Termination.</strong></p>

				<p>Customer acknowledges that the amount of the fee for the service is based on Customer's agreement to pay the fee for the entire Initial Term, or Renewal Term, as applicable. In the event {{ env('APP_DOMAIN') }} terminates the Agreement for Customer's breach of the Agreement in accordance with Section 9 (Termination), or Customer terminates the service other than in accordance with Section 9 (Termination) for {{ env('APP_DOMAIN') }}'s breach, the unpaid fees for each billing cycle remaining in the Initial Term or then-current Renewal Term, as applicable, are due on the business day following termination of the Agreement.</p>
				
				
				<h4><a id="aup">Law/AUP</a></h4>
				<p>Customer agrees to use the service in compliance with applicable law and {{ env('APP_DOMAIN') }} Acceptable Use Policy posted at http://www.{{ env('APP_DOMAIN') }}/aup.html, which is hereby incorporated by reference in this Agreement. Customer agrees that {{ env('APP_DOMAIN') }} may, in its reasonable commercial judgment consistent with industry standards, amend the AUP from time to time to further detail or describe reasonable restrictions and conditions on Customer's use of the Services. Amendments to the AUP are effective on the earlier of {{ env('APP_DOMAIN') }}'s notice to Customer that an amendment has been made, or the first day of any Renewal Term that begins subsequent to the amendment. Customer agrees to cooperate with {{ env('APP_DOMAIN') }}'s reasonable investigation of any suspected violation of the AUP. In the event of a dispute between {{ env('APP_DOMAIN') }} and Customer regarding the interpretation of the AUP, {{ env('APP_DOMAIN') }}'s commercially reasonable interpretation of the AUP shall govern.</p>
				
				<h4><a id="ci">Customer Information</a></h4>

				<p>Customer represents and warrants to {{ env('APP_DOMAIN') }} that the information he, she or it has provided and will provide to {{ env('APP_DOMAIN') }} for purposes of establishing and maintaining the service is accurate. If Customer is an individual, Customer represents and warrants to {{ env('APP_DOMAIN') }} that he or she is at least 18 years of age. {{ env('APP_DOMAIN') }} may rely on the instructions of the person listed as the Primary Customer Contact on the Order with regard to Customer's account until Customer has provided a written notice changing the Primary Customer Contract.</p>
				
				
				<h4><a id="id">Indemnification</a></h4>
				<p>Customer agrees to indemnify and hold harmless {{ env('APP_DOMAIN') }}, {{ env('APP_DOMAIN') }}'s affiliates, and each of their respective officers, directors, agents, and employees from and against any and all claims, demands, liabilities, obligations, losses, damages, penalties, fines, punitive damages, amounts in interest, expenses and disbursements of any kind and nature whatsoever (including reasonable attorneys fees) brought by a third party under any theory of legal liability arising out of or related to the actual or alleged use of Customer's services in violation of applicable law or the AUP by Customer or any person using Customer's log on information, regardless of whether such person has been authorized to use the services by Customer.</p>
				
				
				<h4><a id="dw">Disclaimer of Warranties</a></h4>

				<p>{{ env('APP_DOMAIN') }} DOES NOT WARRANT OR REPRESENT THAT THE SERVICES WILL BE UNINTERRUPTED, ERROR-FREE, OR COMPLETELY SECURE. TO THE EXTENT PERMITTED BY APPLICABLE LAW {{ env('APP_DOMAIN') }} DISCLAIMS ANY AND ALL WARRANTIES INCLUDING THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NONINFRINGEMENT. TO THE EXTENT PERMITTED BY APPLICABLE LAW, ALL SERVICES ARE PROVIDED ON AN "AS IS" BASIS.</p>
				
				
				<h4><a id="ld">Limitation of Damages</a></h4>
				<p>NEITHER PARTY SHALL BE LIABLE TO THE OTHER FOR ANY LOST PROFITS, OR ANY INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL OR PUNITIVE LOSS OR DAMAGE OF ANY KIND, OR FOR DAMAGES THAT COULD HAVE BEEN AVOIDED BY THE USE OF REASONABLE DILIGENCE, ARISING IN CONNECTION WITH THE AGREEMENT, EVEN IF THE PARTY HAS BEEN ADVISED OR SHOULD BE AWARE OF THE POSSIBILIY OF SUCH DAMAGES.</p>
				<p>NOTWITHSTANDING ANYTHING ELSE IN THE AGREEMENT TO THE CONTRARY, THE MAXIMUM AGGREGATE LIABILITY OF {{ env('APP_DOMAIN') }} AND ANY OF ITS EMPLOYEES, AGENTS OR AFFILIATES, UNDER ANY THEORY OF LAW (INCLUDING BREACH OF CONTRACT, TORT, STRICT LIABILITY, AND INFRINGEMENT) SHALL BE A PAYMENT OF MONEY NOT TO EXCEED THE AMOUNT PAYABLE BY CUSTOMER FOR THREE MONTHS OF SERVICE.</p>
				

				
				<h4><a id="st">Suspension/Termination</a></h4>
				<p class="margin-top-15"><strong>(a) Suspension of Service.</strong></p>
				<p>Customer agrees that {{ env('APP_DOMAIN') }} may suspend services to Customer without notice and without liability if: (i) {{ env('APP_DOMAIN') }} reasonably believes that the services are being used in violation of the AUP; (ii) Customer fails to cooperate with any reasonable investigation of any suspected violation of the AUP; (iii) * {{ env('APP_DOMAIN') }} reasonably believes that the suspension of service is necessary to protect its network or its other customers, or (iv) as requested by a law enforcement or regulatory agency. Customer shall pay {{ env('APP_DOMAIN') }}'s reasonable reinstatement fee if service is reinstituted following a suspension of service under this subsection.</p>
				<p><strong>(b) Termination.</strong></p>
				<p>The Agreement may be terminated by Customer prior to the expiration of the Initial Term or any Renewal Term without further notice and without liability if {{ env('APP_DOMAIN') }} fails in a material way to provide the service in accordance with the terms of the Agreement and does not cure the failure within ten (10) days of Customer's written notice describing the failure in reasonable detail. The Agreement may be terminated by {{ env('APP_DOMAIN') }} prior to the expiration of the Initial Term or any Renewal Term without further notice and without liability as follows: (i) upon ten (10) days notice if Customer is overdue on the payment of any amount due under the Agreement; (ii) Customer materially violates any other provision of the Agreement, including the AUP, and fails to cure the violation within thirty (30) days of a written notice from {{ env('APP_DOMAIN') }} describing the violation in reasonable detail; (iii) upon one (1) days notice if Customer's Service is used in violation of a material term of the AUP more than once, or (iv) upon one (1) days notice if Customer violates Section 5 (Customer Information) of this Agreement. Either party may terminate this agreement upon ten (10) days advance notice if the other party admits insolvency, makes an assignment for the benefit of its creditors, files for bankruptcy or similar protection, is unable to pay debts as they become due, has a trustee or receiver appointed over all or a substantial portion of its assets, or enters into an agreement for the extension or readjustment of all or substantially all of its obligations.</p>
				

				
				<h4><a id="rci">Requests for Customer Information</a></h4>
				<p>Customer agrees that {{ env('APP_DOMAIN') }} may, without notice to Customer, (i) report to the appropriate authorities any conduct by Customer or any of Customer's customers or end users that {{ env('APP_DOMAIN') }} believes violates applicable law, and (ii) provide any information that it has about Customer or any of its customers or end users in response to a formal or informal request from a law enforcement or regulatory agency or in response to a formal request in a civil action that on its face meets the requirements for such a request.</p>
				
				
				<h4><a id="buc">Back Up Copy</a></h4>
				<p>Customer agrees to maintain a current copy of all content hosted by {{ env('APP_DOMAIN') }} nothwithstanding any agreement by {{ env('APP_DOMAIN') }} to provide back up services.</p>
				

				
				<h4><a id="changes">Changes to {{ env('APP_DOMAIN') }}'s Network</a></h4>
				<p>Upgrades and other changes in {{ env('APP_DOMAIN') }}'s network, including, but not limited to changes in its software, hardware, and service providers, may affect the display or operation of Customer's hosted content and/or applications. {{ env('APP_DOMAIN') }} reserves the right to change its network in its commercially reasonable discretion, and {{ env('APP_DOMAIN') }} shall not be liable for any resulting harm to Customer.</p>
				
				
				<h4><a id="notices">Notices</a></h4>
				<p> Notices to {{ env('APP_DOMAIN') }} under the Agreement shall be given via electronic mail to the e-mail address posted for customer support on http://www.{{ env('APP_DOMAIN') }}. Notices to Customer shall be given via electronic mail to the individual listed as the Primary Customer Contact on the Order. Notices are deemed received on the day transmitted, or if that day is not a business day, on the first business day following the day delivered. Customer may change his, her or its notice address by a notice given in accordance with this Section.</p>
				

				
				<h4><a id="fm">Force Majeure</a></h4>
				<p>{{ env('APP_DOMAIN') }} shall not be in default of any obligation under the Agreement if the failure to perform the obligation is due to any event beyond {{ env('APP_DOMAIN') }}'s control, including, without limitation, significant failure of a portion of the power grid, significant failure of the Internet, natural disaster, war, riot, insurrection, epidemic, strikes or other organized labor action, terrorist activity, or other events of a magnitude or type for which precautions are not generally taken in the industry.</p>
				
				
				<h4><a id="gld">Governing Law/Disputes</a></h4>
				<p>The Agreement shall be governed by the laws of the State of Florida, exclusive of its choice of law principles, and the laws of the United States of America, as applicable. The Agreement shall not be governed by the United Nations Convention on the International Sale of Goods. EXCLUSIVE VENUE FOR ALL DISPUTES ARISING OUT OF OR RELATING TO THE AGREEMENT SHALL BE THE STATE AND FEDERAL COURTS IN PINELLAS COUNTY, FLORIDA, AND EACH PARTY AGREES NOT TO DISPUTE SUCH PERSONAL JURISDICTION AND WAIVES ALL OBJECTIONS THERETO.</p>
				

				
				<h4><a id="misc">Miscellaneous</a></h4>
				<p>Each party acknowledges and agrees that the other party retains exclusive ownership and rights in its trademarks, service marks, trade secrets, inventions, copyrights, and other intellectual property. Neither party may use the other party's name or trade mark without the other party's prior written consent. The parties intend for their relationship to be that of independent contractors and not a partnership, joint venture, or employer/employee. Neither party will represent itself to be agent of the other. Each party acknowledges that it has no power or authority to bind the other on any agreement and that it will not represent to any person that it has such power or authority. This Agreement may be amended only by a formal written agreement signed by both parties. The terms on Customer's purchase order or other business forms are not binding on {{ env('APP_DOMAIN') }} unless they are expressly incorporated into a formal written agreement signed by both parties. A party's failure or delay in enforcing any provision of the Agreement will not be deemed a waiver of that party's rights with respect to that provision or any other provision of the Agreement. A party's waiver of any of its right under the Agreement is not a waiver of any of its other rights with respect to a prior, contemporaneous or future occurrence, whether similar in nature or not. The captions in the Agreement are not part of the Agreement, but are for the convenience of the parties. The following provisions will survive expiration or termination of the Agreement: Fees, indemnity obligations, provisions limiting liability and disclaiming warranties, provisions regarding ownership of intellectual property, these miscellaneous provisions, and other provisions that by their nature are intended to survive termination of the Agreement. There are no third party beneficiaries to the Agreement. Neither insurers nor the customers of resellers are third party beneficiaries to the Agreement. Customer may not transfer the Agreement without {{ env('APP_DOMAIN') }}'s prior written consent. {{ env('APP_DOMAIN') }}'s approval for assignment is contingent on the assignee meeting {{ env('APP_DOMAIN') }}'s credit approval criteria. {{ env('APP_DOMAIN') }} may assign the Agreement in whole or in part.</p>
			
				<p>This Agreement together with the Order and AUP constitutes the complete and exclusive agreement between the parties regarding its subject matter and supercedes and replace any prior understanding or communication, written or oral. </p>     

      </div>
    </div>

@endsection
