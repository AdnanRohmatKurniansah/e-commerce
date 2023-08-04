<footer class="footer-area section_gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 d-flex justify-content-center col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6>About Us</h6>
          @php
              $footer = \App\Models\Footer::all();
          @endphp
          <p>
            {{ $footer[0]->about }}
          </p>
        </div>
      </div>
      <div class="col-lg-4 d-flex justify-content-left col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6>Contact me</h6>
          @php
              $contacts = \App\Models\Contact::all();
          @endphp
          <div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							{!! $contacts[0]->pnumber !!}
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							{!! $contacts[0]->email !!}
						</div>
					</div>
        </div>
      </div>
      <div class="col-lg-4 d-flex justify-content-left col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6>Follow Us</h6>
          <p>Let us be social</p>
          <div class="footer-social d-flex align-items-center">
            @php
                $sosmeds = \App\Models\Sosmed::orderBy('id', 'desc')->get()
            @endphp
            @foreach ($sosmeds as $sosmed)
              <a href="{{ $sosmed->link }}" target="_blank"><i style="font-size: 18px" class="fa fa-{{ $sosmed->icon }}"></i></a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
      <p class="footer-text m-0">
      Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="{{ $footer[0]->link }}" target="_blank">{{ $footer[0]->copyright }}.</a>
      </p>
    </div>
  </div>
</footer>