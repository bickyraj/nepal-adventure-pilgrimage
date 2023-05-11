
<!-- Newsletter -->
<div class="bg-light py-10">
    <div class="container">
        <div class="grid lg:grid-cols-2 gap-8">
            <div>
                <h2 class="mb-2 font-display uppercase text-4xl text-primary">Join our Newsletter</h2>
                <div>Sign up today and get special offer</div>
            </div>
            <div>
                <form class="flex flex-wrap" id="email-subscribe-form">
                    <label for="emailsub" class="sr-only">Email</label>
                    <input type="email" id="emailsub" name="email" class="text-xl p-4 mb-1 lg:mb-0 lg:mr-2 border-accent rounded-lg" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-accent">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- Newsletter -->

<!-- Footer -->
<footer class="text-primary" style="background: #ededed;">
    <div class="container" style="margin-bottom: 15px;">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <a href="{{ route('front.makeapayment') }}" class="btn btn-accent">Make a Payment</a>
        </div>
    </div>
    <div class="container fs-sm">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <div class="mb-4">
               <iframe width="270px" height="280px" src="https://www.youtube.com/embed/xcXRsM7N1U4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="mb-4">
                 <h2 class="font-display text-2xl text-primary">Thailand Office</h2>
                <ul class="icon-list">
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" /></svg>
                        <span class="text-sm">Thailand</span></li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" /></svg>
                        <a class="text-sm" href="tel:+66818464735">+66818464735</a></li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" /></svg>
                        <a class="text-sm" href="mailto:{{ Setting::get('email') }}">{{ Setting::get('email') }}</a></li>
                </ul>
            </div>
            <div class="mb-4">
                 <h2 class="font-display text-2xl text-primary">France Office</h2>
                <ul class="icon-list">
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" /></svg>
                        <span class="text-sm">France</span></li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" /></svg>
                        <a class="text-sm" href="tel:+33 670794972">+33 670794972</a></li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" /></svg>
                        <a class="text-sm" href="mailto:{{ Setting::get('email') }}">{{ Setting::get('email') }}</a></li>
                </ul>
            </div>
            <div class="col-span-2 lg:col-span-1">
                <h2 class="font-display text-2xl text-primary">Head Office, Nepal</h2>
                <ul class="icon-list">
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" /></svg>
                        <span class="text-sm">{{ Setting::get('address') }}</span></li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" /></svg>
                        <a class="text-sm" href="tel:{{ Setting::get('mobile1') }}">{{ Setting::get('mobile1') }}</a></li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" /></svg>
                        <a class="text-sm" href="mailto:{{ Setting::get('email') }}">{{ Setting::get('email') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <ul class="social-links flex-wrap mb-4">
                <li class="mb-1">
                    <a href="{{ Setting::get('facebook') }}" target="_blank">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebook" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ Setting::get('twitter') }}" target="_blank">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#twitter" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ Setting::get('instagram') }}" target="_blank">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#instagram" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ Setting::get('whatsapp') }}">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ Setting::get('viber') }}">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                        </svg>
                    </a>
                </li>
            </ul>
           <div class="mb-2 affiliations">
                <div class="mb-2 text-xs">Recommended By</div>
                <ul>
                    <li class="mr-1 p-2"><a href="https://www.tripadvisor.com/AttractionProductReview-g293890-d24129515-14_Day_Private_Everest_Base_Camp_Trek_fro_Kathmandu-Kathmandu_Kathmandu_Valley_Bag.html" target="_blank"><img class="lazy" src="{{ asset('assets/front/img/viator.png') }}"
                                alt="Viator"></a></li>

                </ul>
            </div>
            <div class="mb-2 affiliations">
                <div class="mb-2 text-xs">We are affiliated to</div>
                <ul>
                    <li class="mr-1 p-2"><a href="#"><img class="lazy" src="{{ asset('assets/front/img/ng.png') }}"
                                alt="Nepal Government Ministry of Culture, Tourism & Civil Aviation"></a></li>
                    <li class="mr-1 p-2"><a href="#"><img class="lazy" src="{{ asset('assets/front/img/ntb.svg') }}" alt="Nepal Tourism Board"></a></li>
                    <li class="mr-1 p-2"><a href="https://www.taan.org.np/"><img class="lazy" src="{{ asset('assets/front/img/taan.svg') }}"
                                alt="Trekking Agencies' Association of Nepal"></a></li>
                    <li class="p-2"><a href="#"><img class="lazy" src="{{ asset('assets/front/img/nma.svg') }}" alt="Nepal Mountaineering Association"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-xs text-center">
        <div class="container md:flex justify-between">
            <div class="mb-2">
                &copy; {{ date('Y') }}. All right Reserved.
            </div>
            <div class="mb-4">
                Powered by
                <a href="https://thirdeyesystem.com">Third Eye Systems</a>
            </div>
            <div class="payments">
                <img src="{{ asset('assets/front/img/payment.svg') }}" alt="">
            </div>
        </div>
    </div>
</footer><!-- Footer -->
{{--
<div class="footer-tab">
    <ul class="social-links flex-wrap mb-4">
                <li class="mb-1">
                    <a href="{{ Setting::get('whatsapp') }}">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ Setting::get('viber') }}">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                        </svg>
                    </a>
                </li>
                 <li class="mb-1">
                    <a href="tel:{{ Setting::get('mobile1') }}">
                        <svg>
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="#">
                        Book a Trip
                    </a>
                </li>

            </ul>
</div>
--}}
@push('scripts')
<script type="text/javascript">
  $(function() {

    $('#email-subscribe-form').on('submit', function(event) {
      event.preventDefault();
      var form = $(this);
      var formData = form.serialize();

      $.ajax({
        url: "{{ route('front.email-subscribers.store') }}",
        type: "POST",
        data: formData,
        dataType: "json",
        async: "false",
        success: function(res) {
          if (res.status == 1) {
            toastr.success(res.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          var status = jqXHR.status;
          if (status == 404) {
              toastr.warning("Element not found.");
          } else if (status == 422) {
              toastr.info(jqXHR.responseJSON.errors.email[0]);
          }
        }
      });

    });
  });
</script>



@endpush
