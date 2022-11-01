<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/
  
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailMessage;
use DB;
use Exception;

class EmailMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        // check if table email_messages is empty

            try{
                if(DB::table('email_messages')->count() == 0){
                    DB::table('email_messages')->insert([

                        [
                            'subject' => 'Sales enquiry / Survey date confirmation',
                            'message' => 'Thank you for booking in a home survey with urbanpods, we can not wait to get started! <br><br> 
                            The date and time have been agreed as [sales_date_time] <br><br> 
                            Please login to our order tracking portal via the link below to approve this date and time or to suggest a more suitable alternative:<br>
                            [login_url] <br>

                            The survey can take anything from 30mins to 1hour. <br><br> 
                            In the meantime, if you have any questions, please contact us on 01506 854844 (option1). <br><br>
                            Thanks, <br> 
                            Urbanpods Team',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Survey Information',
                            'message' => 'Thank you very much for your time and allowing us to visit your property, it was great to meet you! <br><br> 
                            The surveyor will return with your urbanpod design and cost within 48hours. <br><br> 
                            In the meantime if you have any questions regarding the survey that has taken ,please contact us on 01506854844 (option 1)',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Proposal',
                            'message' => 'Hi [user_name], <br><br> 
                            How are you guys? <br><br>
                             Apologies again for the time this has taken, we got really bogged down with surveys last week, so have not had much office time at all to catch up!! <br> Ok, so I am pleased to attach the following to this email for you: <br><br> 
                               1. 3D design proposals <br> 
                               2. Overall schedule of costs <br> 
                               3. Some pictures of recent and similar projects <br><br>
                               I have therefore also listed below the following key items we have discussed at our appointment, this is just to help describe what has been included within both the design and schedule, these are: <br><br>
                                 1. The pod selected is the (Enter model) Urbanpod. <br>
                                 2. We have discussed the permitted development rights and have advised that the pod should be (enter location). <br>
                                 3. We have advised that it would be worth (enter any additonal works required for positioning). <br>
                                 4. We have discussed the window and door arrangement and i have come up with the suggestion of (enter window and door arrangement suggestions). <br>
                                 5. (enter any provisions for external pod surroundings). <br>
                                 6. (enter any provisions for canopy). <br>
                                 7. We have allowed for our (enter timber details). <br>
                                 8. We have allowed for (enter timber protection details). <br>
                                 9. We are to allow for power and ethernet cabling to the pod. <br>
                                Overall, we offer a full turnkey finish as standard, which is: <br> The actual pod unit (as per attached drawing) <br> Painted finish internally <br> Internally 3 double sockets<br>
                                4. ceiling lights <br> 
                                2 canopy lights to the external <br> Composite grey decking <br> Karndean floor finish internally <br> Infrared ceiling heating system <br> On the summary of costs sheet I have highlighted the areas in Yellow that make up to the total cost of the spreadsheet, so you can see how much each additional item will cost. <br> Any questions, just let me know, we can do as many revisions and changes as you wish. <br><br>
                                Hope that is all ok! <br>
                                Thanks again, <br>
                                Urbanpods Team <br>
                                (attach cost schedule)',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],

                        [
                            'subject' => '1st Invoice',
                             'message' => 'Your payment request has been sent, please make your first instalment to start your wonderful journey with Urbanpods!',
                            // 'message' => 'Good Afternoon  [user_name], <br><br>
                            // I have attached a copy of your invoice  [invoice_number]  for your  [invoice_preferred_model_pod] pod. <br><br>
                            // Your initial payment of 30% to guarantee the manufacture and diary slot is now due for payment, Can you please arrange to transfer the following payment - as per your order confirmation. <br><br> &#163;  [received_payment_with_discount]  payment by direct bank transfer <br><br>
                            // Or if paying via card <br> &#163;  [received_payment_via_card]   (this includes the 1.5% charge of) &#163;  [received_payment_with_discount]  <br><br>
                            // Payment can either be made direct into our company bank account. <br><br>
                            // Bank Details to allow a direct transfer.<br><br>
                            // PLEASE NOTE<br>
                            // The following bank details will never alter unless Ross informs you in person',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Welcome onboard',
                            'message' => 'We are glad to have you guys on board!<br><br>
                            We can not wait to get started; your installation is booked in for [installation_date_time]. <br><br>
                            We understand you are just as excited as we are to install your urbanpod, we are here with you every step of the way. During this exciting lead in time to your installation, our sales team will be in contact 4 weeks prior to the installation whereby we will invite you to come through to our showroom to discuss the finer details of your pod, things like floor colours, plug socket positions and paint colours or generally any finer detail you would like to tweek prior to your installation. <br><br>
                            We hope that is all ok, any questions at all, please contact 01506 854844 (option1). <br><br>
                            Thanks, <br>
                            Urbanpods Team',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => '2nd Invoice',
                            'message' => 'Good Afternoon [user_name],  <br><br>
                            I have attached a copy of your invoice  [invoice_number]  for your  [invoice_preferred_model_pod] pod.  <br><br>
                            Your initial payment of 30% to guarantee the manufacture and diary slot is now due for payment. Can yu please arrange to transfer the following payment -- as per your order confirmation. <br><br> &#163; [received_payment_with_discount] payment by direct bank transfer <br><br>
                            Or if paying via card <br> &#163;  [received_payment_via_card]   (this includes the 1.5% charge of) &#163;  [received_payment_with_discount].  <br><br>
                            Payment can either be made direct into our company bank account. <br><br>
                            Bank Details to allow a direct transfer.<br><br>
                            PLEASE NOTE<br>
                            The following bank details will never alter unless Ross informs you in person <br><br>
                            Invoice linl: [invoice_link]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Showroom Visit',
                            'message' => 'We are nearly there for the commencement of your urbanpod installation!<br><br>
                            It is now a good time to book you in for a showroom visit to discuss the finer details of your pod, things like floor coverings, lighting and socket positions and any finer elements of questions you may have<br><br>.
                            We have this slot available [installation_date_time] <br><br>
                            Thanks, <br>
                            Urbanpods Team' ,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => '3rd Invoice',
                            'message' => 'Good Afternoon [user_name],  <br><br>
                            I have attached a copy of your invoice  [invoice_number]  for your  [invoice_preferred_model_pod] pod.  <br><br>
                            Your third payment of 20% is now due for payment. Can you please arrange to transfer the following payment - as per your order confirmation.
                            <br><br> &#163; [received_payment_with_discount] payment by direct bank transfer <br><br>
                            Or if paying via card <br> &#163;  [received_payment_via_card]   (this includes the 1.5% charge of) &#163;  [received_payment_with_discount]  <br><br>
                            Payment can either be made direct into our company bank account. <br><br>
                            Bank Details to allow a direct transfer.<br><br>
                            PLEASE NOTE<br>
                            The following bank details will never alter unless Ross informs you in person',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Your installation has commenced',
                            'message' => 'Your pod has started, your highly skilled urbanpod team have set off with your installation! We understand that during this time things can get busy around the house, questions may arise and you might even have some concerns.......... we are with you! If you have any questions, or queries relating to the installation and progress or you just want to chat to us, please call us on 01506 854844 (option1) or email to customercare@urbanpods.co.uk <br><br>
                            Thanks,<br>
                            Urbanpods Team',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => '“Your installation progress” email should be sent 5 days after the installation date',
                            'message' => 'Your installation is well underway! we are on track to achieve the original timescale, however, things can slip or be held up, in the unlikely event this does happen........... we will be in touch!<br><br> Your installation team will like to have a moment of your time to discuss the installation at completion stage, we carry out a thorough check list on site and your team would like to demo the pod! <br><br>
                            Thanks,<br>
                            Urbanpods Team',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Guarantee and Manual',
                            'message' => 'Hi  [user_name]  ,<br><br> I have attached the following to this email for you:<br><br> Warranty / guarantee<br><br> Electrical certificate<br><br> The rectification period begins at this stage, this means we will come back to site at the end of the 6 month period to make good any defects, normally popped nails, some cracks in plaster is what we would expect from a timber frame structure. Of course if there is anything major or anything that alarms you, let us know asap.<br><br> I have also attached the electrical certificate covering the installation, you do not have to do anything with this, just keep safe.<br><br> All good and enjoy your pod, any questions, just let us know! <br><br>
                            Thanks again,<br>
                            Urbanpods Team',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => '4th Invoice',
                            'message' => 'Good Afternoon [user_name],  <br><br>
                            I have attached a copy of your invoice  [invoice_number]  for your  [invoice_preferred_model_pod] pod.  <br><br>
                            Your fourth payment of 10% is now due for payment. Can you please arrange to transfer the following payment - as per your order confirmation.
                            <br><br> &#163; [received_payment_with_discount] payment by direct bank transfer <br><br>
                            Or if paying via card <br> &#163;  [received_payment_via_card]   (this includes the 1.5% charge of) &#163;  [received_payment_with_discount].  <br><br>
                            Payment can either be made direct into our company bank account. <br><br>
                            Bank Details to allow a direct transfer.<br><br>
                            PLEASE NOTE<br>
                            The following bank details will never alter unless Ross informs you in person',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Aftercare email',
                            'message' => 'We hope you have enjoyed your urbanpos over the last 6 months, this is just an email to say that your rectification periods is about to end, please call or email the office to book in a time ceonvenient for our team to attend to put right any faults or defects.<br><br> Did you know we also offer a exterior timber varnish service, we can wish and varnish the exterior of your pod at the same time as carrying out the remedial work, our cost is &#163;350',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Payment received',
                            'message' => 'Hi [user_name], <br> 
                            We can confirm that your payment has now been received.<br><br>
                            Thanks,<br>
                            Urbanpods Team',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Home survey',
                            'message' => 'Thank you for booking in a home survey [sales_date_time] .<br><br>',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => '5th Invoice',
                            'message' => 'Good Afternoon [user_name],  <br><br>
                            Showroom Extras Invoice',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'subject' => 'Rectification Period End Date',
                            'message' => 'Good Afternoon [user_name],   <br><br>
                            Customer care email',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                    ]);
                } else { echo "<br>[Email Message Table is not empty] "; }

            }catch(Exception $e) {
                echo $e->getMessage();
            }
            
    }
}
