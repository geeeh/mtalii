@extends('layouts.app')

@section('content')

@include('partials.carousel')
<div class="about">
    <div class="what-we-do">
      <div class="info-div-1">
          <h2 class="header">What We Do</h2>
          <p>
              Just like you, we love to travel and experience new places! However the trouble of planning, let alone the strain of finding the right deal that fits our budget is just a nightmare!
          </p>

          <div class="col-sm-6 video">
              <video width="500" controls>
                  <source src="mov_bbb.mp4" type="video/mp4">
                  <source src="mov_bbb.ogg" type="video/ogg">
                  Your browser does not support HTML5 video.
              </video>
          </div>

          <hr />

          <p>
              Remember the trip you have always wanted to take with your friends? The first time I organised a group trip to Mombasa I almost gave up.
              </p>
          <p>
              We were to drive there so all we wanted was a good villa for a group of 10 friends and that was my biggest headache: I had to write 58 emails to different providers and reply to 58 conversations that were replied at different times!
          </p>
      </div>
    </div>

    <div class="more-what-we-do row">
        <div class="col-sm-5">
            <h6 class="story-header">A little story</h6>
            <p>
                After a couple of private trips we formed a tour company(twenty something experiences). A company targeting young travellers: and the struggle of getting to you lovers of travel was big.
            </p>
            <p>
                We had very fresh deals eg a 2day trip to masinga resort all inclusive at ksh 2500! You will find out that the small tour companies provide real and authentic deals at very little prices- they just dont have a way to reach you and you dont know how to trust brands you dont know.
            </p>
            <p>
                These are just a few reasons why Mtalii is here!
                Mtalii is born of a simple idea: Providing a trusted platform that brings together travellers and hospitality service providers while allowing travellers to share experiences. Give us a chance to serve you!
            </p>
        </div>
        <div class="col-sm-6 video">
            <video width="500" controls>
                <source src="mov_bbb.mp4" type="video/mp4">
                <source src="mov_bbb.ogg" type="video/ogg">
                Your browser does not support HTML5 video.
              </video>
        </div>
    </div>

    <div class="info-div-2">
        <div class="why">
            <h2 class="header">Why try Mtalii</h2>
            <ul>
                <li>We verify all the providers offering deals on our site and we only pay them after you have checked in for your trip otherwise we refund you as per t&c</li>
                <li>We offer variety & affordability;Search for deals by either destination, price  or date then refine to your choice and simply book.</li>
                <li>Get help planning your trip; (works best for groups) all you have to do is write to us your requirements for the trip: your budget and the preferred dates, We will then let all service providers registered on our site bid for your job -You're the boss after all</li>
                <li>Visit our shop and get all aids on a trip be it car hire, camping equipment, curios and art ,apparel , tour guides and maps</li>

                <li>Our customer service team is always ready for your questions in our customer care chatroom. Talk to us !</li>

                <li>Love writing? Share your experiences on our blog section and let other people know more about the places you have visited. I the C.E.O will be sharing my travel experiences too.</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <p>
            <i>You can help us match the best deals, offers to you and inform you by registering and completing your profile on our site.</i>
            Our promise: <i>We will make sure that you have the easiest time before travel, in your trip and after the trip, try us!</i>
        </p>
    </div>
</div>

    <div class="container-fluid contanct-info">
        <span class="thumbnail-header">Contact Information</span>
        <div class="row">
            <div class="col-sm-3">
                <div class="thumbnail">
                    <div class="caption">
                        <h5>Theo Mwangangi</h5>
                        <p>Technical manager</p>
                        <div><img src="/imgs/phone-call.svg"> <span>+254720142141</span></div>
                        <div><img src="/imgs/mail.svg"> <span>theo@gmail.com</span></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <div class="caption">
                        <h5>Lenny murerwa</h5>
                        <p>Chief Financial Oficer</p>
                        <div>
                            <img src="/imgs/phone-call.svg"> <span>+254720142141</span>
                        </div>
                        <div>
                            <img src="/imgs/mail.svg"> <span>theo@gmail.com</span></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="thumbnail">
                    <div class="caption">
                        <h5>Eayern mutuma</h5>
                        <p>Chief Marketing officer</p>
                        <div><img src="/imgs/phone-call.svg"> <span>+254720142141</span></div>
                        <div><img src="/imgs/mail.svg"> <span>theo@gmail.com</span></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <div class="caption">
                        <h5>Lenah Amdany</h5>
                        <p>Chief Operating Oficer</p>
                        <div class="full">
                            <div><img src="/imgs/phone-call.svg"> <span>+254720142141</span></div>
                            <div><img src="/imgs/mail.svg"> <span>theo@gmail.com</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <div class="caption">
                        <h5>Faith Mukami </h5>
                        <p>Public Relations Manager</p>
                        <div><img src="/imgs/phone-call.svg"> <span>+254720142141</span></div>
                        <div><img src="/imgs/mail.svg"> <span>theo@gmail.com</span></div>
                    </div>
                </div>
            </div>
        </div>
</div>
@include('partials.footer')
@endsection
