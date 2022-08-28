<span language="eng">Others</span><span language="mm">အခြား</span>


        $(".owl-carousel").owlCarousel({
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 5000,
            smartSpeed: 700,
            items: 5,
            nav:true,
            loop:true,
            lazyLoad:true
        });

{{-- Rating Code  use ratingFunction --}}
<div class="mt-3">
    <label class="form-label" for="customRange1"><span language="eng">Rating</span><span
            language="mm">အဆင့်သတ်မှတ်ပါ</span></label>

    <input type="range" min="1" max="4" class="form-range cmtRating d-none"
        autocompleted="none" value="3">
</div>
<div class="d-flex ratingIconContainer justify-content-around fs-3 text-warning">
    <p><i class="ratIcon-1 fa-solid fa-face-frown rounded rounded-circle"></i></p>
    <p><i class="ratIcon-2 fa-solid fa-face-meh rounded rounded-circle"></i></p>
    <p><i
            class="ratIcon-3 fa-solid fa-face-smile-beam rounded rounded-circle border border-4 scaletwo"></i>
    </p>
    <p><i class="ratIcon-4 fa-solid fa-face-grin-hearts rounded rounded-circle"></i></p>
</div>
<p class="text-end">Rating : <span id="ratText"><span language="eng">good</span><span
    language="mm">ကောင်းသော</span></span></p>
