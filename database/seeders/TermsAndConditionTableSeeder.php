<?php

namespace Database\Seeders;

use App\Models\Pages\TermAndCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsAndConditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermAndCondition::insert([
            [
                'title' => 'Terms and Conditions',
                'content' => '
              <p><strong>TERMS OF SERVICE</strong></p>

 <p>&nbsp;</p>

 <p><em>These Terms of Service were last updated on January 28, 2022.</em></p>

 <p>&nbsp;</p>

 <p style="text-align:justify">Thank you for using OfferForm. These Terms of Service (&ldquo;Terms&rdquo;) cover your use and access to the products, services, software, platform and website (collectively, the &ldquo;Services&rdquo;) provided by OfferForm and any of our affiliates. By using our Services, you agree to be bound by these Terms. If you are using our Services as the employee or agent of an organization, you are agreeing to these Terms on behalf of that organization.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>ACCEPTANCE OF TERMS</strong></li>
 </ol>

 <p style="text-align:justify">By agreeing to these Terms, you agree to resolve disputes with OfferForm through binding arbitration and you waive certain rights to participate in class actions, as detailed in the Dispute Resolution section of these Terms.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><strong>1.1 Applicability</strong></p>

 <p style="text-align:justify">By registering for and/or using the Services in any manner, including, but not limited to, visiting or browsing the OfferForm website (the &ldquo;Site&rdquo;), you agree to these Terms, and all other operating rules, policies and procedures that may be published from time to time on the Site by us, each of which is incorporated by reference and each of which may be updated from time to time without notice to you.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><strong>1.2 Additional Terms</strong></p>

 <p style="text-align:justify">Certain of the Services may be subject to additional terms and conditions specified by us from time to time; your use of such Services is subject to those additional terms and conditions, which are incorporated into these Terms of Service by reference.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><strong>1.3 All Users</strong></p>

 <p style="text-align:justify">These Terms apply to all users of the Services, including, without limitation, users who are contributors of content or provide tutoring services, registered or otherwise. All rights not expressly granted to you under these Terms of Service are reserved to OfferForm.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>ELIGIBILITY</strong></li>
 </ol>

 <p style="text-align:justify">You represent and warrant that you are at least 13 years of age. If you are under the age of 13, you may not, under any circumstances or for any reason, register an account or use our Site and/or Services. &nbsp;OfferForm may, in our sole discretion, refuse to offer the Services to any person and change the eligibility requirements or criteria at any time. You are solely responsible for ensuring that these Terms of Service &nbsp;are in compliance with all laws, rules and regulations applicable to you and the right to access the Services is revoked where these Terms and/or use of the Services is prohibited or to the extent offer, sale or provision of the Services conflicts with any applicable law, rule or regulation.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>PAID ACCOUNT</strong></li>
 </ol>

 <p style="text-align:justify">To use our Services, you must register for an account (&ldquo;Account&rdquo;). You must provide accurate and complete information and keep your Account information updated. To ensure uninterrupted service and to enable you to conveniently purchase additional products and Services, OfferForm will store and update (e.g. upon expiration) your payment method on file. If we are unable to charge your designated payment method for any reason, we reserve the right to automatically downgrade your paid plan to a lower-priced plan or to suspend your paid membership until your designated payment method can be charged again. Please note that it is your responsibility to maintain current billing information on file with OfferForm.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">You are solely responsible for the activity that occurs on your Account, including keeping your Account password secure. You may not use another person&rsquo;s user account without permission. You must notify us immediately of a breach of security or unauthorized use of your Account. You should never publish, distribute, or post login information of your Account.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>COMMUNICATION CONSENT</strong></li>
 </ol>

 <p style="text-align:justify">By creating an Account, you agree that you may receive communications from OfferForm, such as newsletters, special offers, and account reminders and updates. You may remove yourself from promotional communications by clicking the &ldquo;Unsubscribe&rdquo; link in the footer of promotional emails; however, you cannot opt out of essential communications regarding your Account.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>PAYMENTS, CREDITS, AND REFUNDS</strong></li>
 </ol>

 <p style="text-align:justify">Unless specified otherwise, all fees are quoted in U.S. Dollars and all payments will be processed in U.S. Dollars. All users agree to remit payment for access to the Services and you authorize to charge your means of payment for those fees. When you remit payment, you agree to not use an invalid or unauthorized payment method. All payments must be paid in full. Upon completing a transaction to pay for our Services, you will be presented with a confirmation screen verifying the transaction details you wish to process. It is your responsibility to verify that all transaction information and other details are correct. We have no liability for transactions which are incorrect as a result of inaccurate data entry in the course of the use of our Services. Once a payment has been made, it cannot be cancelled. We do not accept any responsibility for refusal or reversal of payments, which shall be a matter between you and your payment provider.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>NON-PAID ACCOUNT USERS: CONSENT AND PERMITTED USE</strong></li>
 </ol>

 <p style="text-align:justify">OfferForm is designed for paid Account users to give access to non-paid account users (the &ldquo;Homebuyer(s)&rdquo;) to fill out and review forms, documents and materials by using our Services. If a Homebuyer uses our forms, documents or materials, we collect and store the information that they enter in the course of generating a completed form. OfferForm has also partnered with certain third-party Vendors (see below) to make the real-estate purchasing process smoother. Homebuyers may opt to have their Personal Information shared with our third-party Vendors. &ldquo;Personal Information&rdquo; means personally identifiable information, such as email address, name, physical address, telephone number and IP address. If a Homebuyer opts to have their Personal Information shared, we will collect and store such information. OfferForm will not personal identifiable information other than upon request. However, OfferForm reserves the right to delete personal identifiable information of Homebuyers who do not opt to have their Personal Information shared with Vendors at any time.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">Please keep in mind that if you, a Homebuyer, opt to have OfferForm disclose personally identifiable information or personally sensitive data through the Services to Vendors, this information may be collected and used by those Vendors. OfferForm encourages you to review the Terms and privacy policies of our Vendors so that you can understand how those entities collect, use and share your information. OfferForm is not responsible for the Terms of Service, privacy policies, privacy practices, or content on websites or services outside of those we operate.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>THIRD PARTY VENDORS</strong></li>
 </ol>

 <p style="text-align:justify">OfferForm has partnered with third-party vendors (&ldquo;Vendors&rdquo;) to make the real estate purchasing process smoother for Homebuyers. Vendors are provided for the convenience of the Homebuyer to help them identify and locate a resource that may be helpful to them. OfferForm does not own nor control any Vendor. If you opt to have Personal Information shared with a Vendor, OfferForm will not be responsible for any act or omission of a Vendor if you use the services provided by that Vendor. OfferForm reserves the right, in its sole discretion, to change which Vendors we share Personal Information with, for any reason whatsoever and at any time without prior notice.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>TERMINATION OF ACCOUNT AND ACCESS RESTRICTION</strong></li>
 </ol>

 <p style="text-align:justify">OfferForm reserves the right, in its sole discretion, to suspend, terminate or ban your access to the Services, for any reason whatsoever and at any time without prior notice. For example, OfferForm may suspend or terminate your use of the Services if you violate these Terms, use our Services illegally, disrupt the Services or disrupt others&rsquo; use of the Services.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">If OfferForm terminates your Account, we will provide you with notice at the email address associated with your Account. OfferForm reserves the right to modify or discontinue, either temporarily or permanently, any part of its Services with notice. You agree that OfferForm will not be liable to you or to any third party for any modification, suspension, or discontinuance of your access to the Services.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>NO UNLAWFUL USE</strong></li>
 </ol>

 <p style="text-align:justify">You agree to only use the Services if doing so complies with the laws of your jurisdiction(s). The availability of our Services in your jurisdiction(s) is not an invitation or authorization by OfferForm to access or use our Site or Services in a manner that violates your local laws and regulations. By using our Services, you accept sole responsibility to ensure that you or anyone else who accesses your account to use our Site and Services does not violate any applicable laws in your jurisdiction(s). You may not access, or attempt to access, information that OfferForm has not intentionally made available to you via the Site or Services. Your paid Account, use of, and access to, the Services does not entitle you to resell any OfferForm content without prior express written consent from OfferForm.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>LINKS TO THIRD PARTY SITES</strong></li>
 </ol>

 <p style="text-align:justify">At times, our Site may contain links (&ldquo;Linked Site(s)&rdquo;) to third party resources and business on the Internet. These Linked Sites are provided for your convenience to help you identify and locate other Internet resources that may be of interest to you. OfferForm does not control or monitor the contents of any Linked Site, including but not limited to, any further link contained in a Linked Site, and any changes or updates to a Linked Site. These Terms do not apply to your interaction with Linked Sites. You should review the Terms of Service of any Linked Site. OfferForm will not be responsible for any act or omission of a third-party if you use the services provided on a Linked Site.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>INTELLECTUAL PROPERTY RIGHTS; LICENSE GRANT</strong></li>
 </ol>

 <p style="text-align:justify"><span style="background-color:white"><span style="color:black">OfferForm retains all right, title and interest in and to its products and Services, including but not limited to, software, images, text, graphics, illustrations, copyrights, photographs, document and form templates, and all related intellectual property rights. Except as otherwise provided in the Terms, you may not, and may not permit others to:</span></span></p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><span style="background-color:white"><span style="color:black">reproduce, modify, translate, enhance, decompile, disassemble, reverse engineer or create derivative works of any of our products and Services;</span></span></li>
 </ol>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><span style="background-color:white"><span style="color:black">sell, license, sublicense, rent, lease, distribute, copy, publicly display, publish, adapt or edit any of our products and Services; or</span></span></li>
 </ol>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><span style="background-color:white"><span style="color:black">circumvent or disable any security or technological features of our products and Services.</span></span></li>
 </ol>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><span style="background-color:white"><span style="color:black">The design, text, graphics, selection and arrangement of our forms, documents, guidance and all other content of our products and Services are copyright &copy; OfferForm.</span></span></p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><span style="background-color:white"><span style="color:black">Subject to your compliance with these Terms, you are hereby granted a non-exclusive, limited, non-transferable, revocable license to use the Services as we intend for them to be used. As an OfferForm user, you are the owner of and are fully authorized to keep, for your own personal records, electronic or physical copies of documents you have created on OfferForm. Resale or unauthorized copying, use, storage, display or distribution of forms, documents or other materials copied or downloaded from our Service is strictly prohibited. Use of these materials is for your personal or business use. Any resale or redistribution of our forms, documents or materials requires the express written consent of OfferForm. Any rights not expressly granted in these Terms are reserved by OfferForm.</span></span></p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>DISCLAIMER OF REPRESENTATIONS AND LIABILITY</strong></li>
 </ol>

 <p style="text-align:justify">The information, forms, documents, products and Services made available through OfferForm may include inaccuracies or typographical errors. OfferForm reserves the right at any time to modify, improve or suspend features of our Services. Your use of our Services is at your own risk.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">TO THE FULLEST EXTENT PERMITTED BY LAW, OFFERFORM AND ITS AFFILIATES MAKE NO WARRANTIES, EITHER EXPRESS OR IMPLIED, ABOUT THE SERVICES. THE SERVICES ARE PROVIDED &quot;AS IS&rdquo; AND &ldquo;AS AVAILABLE.&quot; OFFERFORM ALSO DISCLAIMS ANY WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. TO THE FULLEST EXTENT PERMITTED BY LAW, IN NO EVENT WILL OFFERFORM AND ITS AFFILIATES BE LIABLE FOR ANY INDIRECT, SPECIAL, INCIDENTAL, PUNITIVE, EXEMPLARY OR CONSEQUENTIAL DAMAGES OR ANY LOSS OF USE, DATA, BUSINESS, OR PROFITS, REGARDLESS OF LEGAL THEORY, WHETHER OR NOT OFFERFORM HAS BEEN WARNED OF THE POSSIBILITY OF SUCH DAMAGES, AND EVEN IF A REMEDY FAILS OF ITS ESSENTIAL PURPOSE. TO THE FULLEST EXTENT PERMITTED BY LAW, OFFERFORM&rsquo;S AGGREGATE LIABILITY TO YOU FOR ALL CLAIMS RELATING TO THE SERVICES SHALL IN NO EVENT EXCEED THE GREATER OF $500 OR THE AMOUNT PAID BY YOU TO OFFERFORM FOR THE 12 MONTHS PRECEDING THE SERVICES IN QUESTION. THE PARTIES EXPRESSLY AGREE AND ACKNOWLEDGE THAT THE FOREGOING DISCLAIMERS AND LIMITATIONS OF LIABILITY FORM AN ESSENTIAL BASIS OF THE BARGAIN BETWEEN THE PARTIES.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>RELEASE AND INDEMNITY</strong></li>
 </ol>

 <p style="text-align:justify">By using our Services, you, on behalf of yourself and your heirs, executors, agents, representatives, and assigns, fully release, forever discharge, and hold OfferForm, its partners (including any third-party companies engaged by OfferForm), officers, employees, directors and agents, harmless from any and all losses, damages, expenses, including reasonable attorneys&#39; fees, rights, claims, and actions of any kind and injury (including death) arising out of or relating to your use of the Services. You agree that this release has been freely and voluntarily consented to and you confirm that you fully understand what you are agreeing to.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">You agree to indemnify and hold OfferForm, its partners (including any third-party companies engaged by OfferForm), officers, employees, directors and agents harmless from any and all losses, damages, expenses, including reasonable attorneys&#39; fees, rights, claims, actions of any kind and injury (including death) arising out of any third-party claims relating to your use of the Service, your violation of these Terms or your violation of any rights of another.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>DISPUTE RESOLUTION</strong></li>
 </ol>

 <p style="text-align:justify"><strong>This Dispute Resolution section applies only if you live in the United States.</strong> Most disputes can be resolved, so before bringing a formal legal case, please first try contacting us.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><strong>14.1 Arbitration</strong></p>

 <p style="text-align:justify">If we cannot resolve the dispute amicably, you and OfferForm agree to resolve any claims related to these Terms (or any of our other legal terms) through final and binding arbitration, regardless of the type of claim or legal theory. If one of us brings a claim in court that should be arbitrated and the other party refuses to arbitrate it, the other party can ask the court to compel arbitration. Either party can also ask a court to halt court proceedings while an arbitration proceeding is ongoing.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><strong>14.2 The Arbitration Process</strong></p>

 <p style="text-align:justify">Any disputes that involve a claim of less than $10,000.00 (US Dollars) must be resolved exclusively through binding non-appearance-based arbitration. A party electing arbitration must initiate proceedings by filing an arbitration demand with the American Arbitration Association (&ldquo;AAA&rdquo;). The arbitration proceedings shall be governed by the AAA Commercial Arbitration Rules, Consumer Due Process Protocol, and Supplementary Procedures for Resolution of Consumer-Related Disputes. The parties agree that the following rules will apply to the proceedings: (a) the arbitration will be conducted by telephone, online, or based solely on written submissions (at the choice of the party seeking relief); (b) the arbitration must not involve any personal appearance by the parties or witnesses (unless the parties agree otherwise); and (c) any judgment on the arbitrator&rsquo;s rendered award may be entered in any court with competent jurisdiction. Disputes that involve a claim of more than $10,000 USD must be resolved per the AAA&rsquo;s rules about whether the arbitration hearing has to be in-person.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify"><strong>14.3 No Class Actions</strong></p>

 <p style="text-align:justify">We both agree that we can only bring claims against the other on an individual basis. This means: (a) neither of us can bring a claim as a plaintiff or class member in a class action, consolidated action, or representative action; (b) an arbitrator can&rsquo;t combine multiple people&rsquo;s claims into a single case (or preside over any consolidated, class, or representative action); and (c) an arbitrator&rsquo;s decision or award in one person&rsquo;s case can only impact that user, not other users, and can&rsquo;t be used to decide other users&rsquo; disputes. If a court decides that this &ldquo;No class actions&rdquo; clause isn&rsquo;t enforceable or valid, then this &ldquo;Dispute Resolution&rdquo; section will be null and void, but the rest of the Terms and Conditions will still apply.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>GOVERNING LAW AND JURISDICTION</strong></li>
 </ol>

 <p style="text-align:justify">These Terms and Conditions shall be governed by, and construed in accordance, with the laws of the State of Oregon, including conflicts of law rules, and the United States of America. You agree that any dispute rising from, or relating to, the subject matter of these Terms and Conditions shall be governed by the exclusive jurisdiction and venue of the state and Federal courts of Oregon.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>ATTORNEYS FEES</strong></li>
 </ol>

 <p style="text-align:justify">In the event of any dispute with regard to this Agreement, the prevailing party shall be entitled to receive from the non-prevailing party and the non-prevailing party shall pay upon demand all reasonable attorneys fees and expenses for the prevailing party.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>MODIFICATIONS</strong></li>
 </ol>

 <p style="text-align:justify">OfferForm reserves the right, in our sole discretion, to modify or replace any of these Terms of Service, or change, suspend, or discontinue the Services, temporarily or permanently, at any time by posting a notice on the Site or by sending you notice through the Services, via email or by another appropriate means of electronic communication. We may also impose limits on certain features, services, or restrict access to parts or all of the Services without notice or liability. While we will provide timely notice of modifications, it is also your responsibility to check these Terms of Service periodically for changes.</p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">Your continued use of our Services following notification of any changes to these Terms constitutes acceptance of those changes, which will apply to your continued use of the Services going forward.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>ENTIRE AGREEMENT</strong></li>
 </ol>

 <p style="text-align:justify">These Terms constitute the entire agreement between you and OfferForm with respect to the Services, including use of our Site, and supersede all prior or contemporaneous communications and proposals (whether oral, written or electronic) between you and use with respect to the Services.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>WAIVER, SEVERABILITY AND ASSIGNMENT</strong></li>
 </ol>

 <p style="text-align:justify">OfferForm&rsquo;s failure to enforce a provision is not a waiver of its right to do so later. If any provision
 of these Terms is found unenforceable, the remaining provisions will remain in full effect and an enforceable term will be substituted reflecting
  the intent of the unenforceable language as closely as possible. You may not assign any of your rights under these Terms, and any such attempt will
   be void. OfferForm may assign its rights to any of its affiliates or subsidiaries, or to any successor in interest of any business associated with the Services.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>ACCOUNT DELETION</strong></li>
 </ol>

 <p style="text-align:justify">You can stop using our Services at any time for any reason. You may delete your user account by using our
 Site or by notifying us at <span style="color:red"><a href="mailto:cody@offerform.me">cody@offerform.me</a>. </span>When you decide to delete your user account, we will delete your data,
 although this may not take place immediately.</p>

 <p style="text-align:justify">&nbsp;</p>

 <ol>
 	<li style="text-align:justify"><strong>HOW TO CONTACT US</strong></li>
 </ol>

 <p style="text-align:justify">For questions or clarifications regarding our Terms of Service and/or any other matters related to our Services,
  please contact us at <span style="color:red"><a href="mailto:cody@offerform.me">cody@offerform.me</a>.</span></p>

 <p style="text-align:justify">&nbsp;</p>

 <p style="text-align:justify">Our mailing address is:</p>

 <p style="text-align:justify"><span style="color:red"><a href="mailto:cody@offerform.me">cody@offerform.me</a></span></p>
                '
            ]

        ]);
    }
}
