<!-- Modal -->
<div class="modal fade" id="teamAccountSetup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content ">
            <div class="modal-header border-0 ms-auto pb-0">
                <a href="javascript:void(0)"
                   class="text-decoration-none"
                   data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30 svg-hover-black" alt="">
                </a>
            </div>
            <div class="modal-body firstTimeSetupChecklist px-5">

                <h4 class="fw-bold text-primary-light text-capitalize"><img class="w-25 me-4" src="{{asset('img/menu-icons/site-logo.svg')}}" alt=""> team account set up!</h4>

                <h6 class="fw-bold text-primary-light text-capitalize mt-2"> Being part of a team gives you acess to your teams forms.</h6>

                <div class="listing mt-5 showUSerORTeamPopup">
                    <ul class="list-group list-group-flush pb-4 px-3">
                        <li class="list-group-item border-0 mb-3">
                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                            <a href="#" class="text-decoration-none text-dark ">Enter your personal info on your profile page.</a>
                        </li>

                        <li class="list-group-item border-0 mb-3">
                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                            <a href="#" class="text-decoration-none text-dark ">If you have a video bio, be sure to upload or link it to your profile.</a>
                        </li>

                        <li class="list-group-item border-0 mb-3">
                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                            <a href="#" class="text-decoration-none text-dark ">Be sure to link your social media profiles for your buyers and your branding.  </a>
                        </li>

                        <li class="list-group-item border-0 mb-3">
                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                            <a href="#" class="text-decoration-none text-dark "> Pick what plan you would like to be on “Free” or ‘Premium”</a>
                        </li>

                        <li class="list-group-item border-0 mb-3">
                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                            <a href="#" class="text-decoration-none text-dark ">Go to your Offerforms start customizing and sending out forms! Dont forget you can share forms with your team members or us forms they have created!</a>
                        </li>

                    </ul>
                </div>

                <div class="first-time-user-popup-video">
                    <video width="100%" height="220" class="rounded-3" controls>
                        <source src="{{asset('video/first-time-user-popup/first-time-user-popup.mp4')}}" type="video/mp4">
                        {{--                        <source src="mov_bbb.ogg" type="video/ogg">--}}
                    </video>
                </div>

            </div>
        </div>
    </div>
</div>
