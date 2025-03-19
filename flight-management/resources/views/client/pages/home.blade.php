@extends('layout.client')
@section('content')




    <div class="container">

      <div class="container-search">


        <h1 class="container-search__text"> Its more than just a trip </h1>


                <form id="flightForm" class="container-searching" action="{{ route('booking.index') }}">
                    <select class="form-select" aria-label="Default select example" name="origin_ap">

                        <option value="" selected> Chọn Nơi Đi <i class="fa-solid fa-plane-departure"></i> </option>
                        @forelse ($origin_aps as $airport)
                                    <option value="{{$airport->id}}">{{$airport->city->name}}</option>
                                @empty
                                    <option value="">Không có dữ liệu</option>
                        @endforelse
                    </select>

                    <select class="form-select" aria-label="Default select example" name="destination_ap">
                        <option  value="" selected>Chọn Nơi Đến</option>
                        @forelse ($destination_aps as $airport)
                                    <option value="{{$airport->id}}">{{$airport->city->name}}</option>
                                @empty
                                    <option value="">Không có dữ liệu</option>
                        @endforelse
                    </select>

                        <input type="text" name="flight_time"  id="flight_time" class="date-searching flatpickr my-auto" placeholder="Chọn ngày đi">

                        <select class="form-select" aria-label="Default select example" name="quantity">
                       
                       @for ($i = 1; $i <= 100; $i++)
                               <option value="{{ $i }}">{{ $i }}</option>
                           @endfor
                       </select>

                    <button type="submit" class="btn-searching">Tìm Vé</button>
                </form>

            </div>

            <div class="swiper-slide">
              <img src="{{ asset('img/BMT.jpg') }}" class="img" alt="">
              <p class="text-swiper">Buôn Ma Thuột (Buôn Mê Thuột) thuộc tỉnh Đắk Lắk và là thành phố lớn nhất ở vùng đất Tây Nguyên. Đây cũng là đô thị miền núi có dân số đông nhất Việt Nam. Thế nên có thể nói, chỉ cần đến đây là bạn có thể nạp thêm cho mình nhiều điều thú vị về văn hóa của Tây Nguyên độc đáo.</p>

            </div>
            <div class="swiper-slide">
              <img src="{{ asset('img/CM.jpg') }}" class="img" alt="">
              <p class="text-swiper">Nhắc đến Cà Mau, du khách không chỉ thương nhớ đến vùng đất phương Nam, nơi rừng U Minh Hạ đi vào lịch sử, mà còn là nơi đầu tàu ngọn sóng của mũi cực Nam Tổ quốc. Vùng đất Miền Tây thơ mộng, hữu tình với những danh lam thắng cảnh xinh đẹp làm ngất lòng du khách, luôn mang một sự thu hút riêng để bất cứ ai cũng muốn chiêm ngưỡng bức tranh hài hòa của rừng bạt ngàn.</p>
            </div>


          </div>
          <div class="swiper-pagination"></div>


          <div class="swiper mySwiper">
            <span>Các thành phố nổi bật <a href="">See All</a></span>
            <div class="swiper-wrapper">




              <div class="swiper-slide">
                <img src="{{ asset('img/HCM.jpg') }}" class="pic__swiper" alt="">
                <p class="text-swiper">Thành phố Hồ Chí Minh (viết tắt TP.HCM), còn được gọi là Sài Gòn, là thành phố lớn nhất Việt Nam về quy mô dân số và là trung tâm kinh tế, giải trí, một trong hai trung tâm văn hóa và giáo dục quan trọng tại Việt Nam. Thành phố Hồ Chí Minh là thành phố trực thuộc trung ương thuộc loại đô thị đặc biệt của Việt Nam. </p>
              </div>

              <div class="swiper-slide">
                <img src="{{ asset('img/HN.jpg') }}" class="img" alt="">
                <p class="text-swiper">Hà Nội sở hữu nét đẹp đa diện, dung hoà giữa hiện đại và truyền thống - chưa từng khiến du khách cảm thấy nhàm chán. Sau mỗi hành trình ở thủ đô, dù là lần đầu tiên vi vu hay đã “quen mặt” với mọi ngóc ngách, #teamKlook đều góp nhặt được đa dạng trải nghiệm vui chơi, giải trí, khám phá thiên nhiên, văn hoá, lịch sử, ẩm thực…; mà mỗi kỷ niệm đều rất đỗi đặc trưng và khó quên. Nếu vẫn chưa biết phải bắt đầu khám phá Hà Nội từ đâu thì hãy để mách bạn các địa điểm du lịch “chuẩn không cần chỉnh” ở Hà Nội nhé. </p>

              </div>
              <div class="swiper-slide">
                <img src="{{ asset('img/CT.jpg') }}" class="img" alt="">
                <p class="text-swiper">Cần Thơ khoác cho mình vẻ đẹp bình dị, mộc mạc mà rất đỗi nên thơ như tà áo bà ba của những người con gái chèo xuồng trên bến Ninh Kiều. Mảnh đấy phương Nam với sông nước giăng giăng, với những cánh đồng thẳng cánh cò bay, với tôm cá đầy ghe…tất cả những điều nho nhỏ ấy đã hun đúc nên nét duyên thầm quyến rũ của vùng đất này. Không phải ngẫu nhiên mà thiên nhiên và cả nền văn hóa sông nước Cần Thơ nhiều lần ...

                </p>

              </div>

              <div class="swiper-slide">
                <img src="{{ asset('img/BMT.jpg') }}" class="img" alt="">
                <p class="text-swiper">Buôn Ma Thuột (Buôn Mê Thuột) thuộc tỉnh Đắk Lắk và là thành phố lớn nhất ở vùng đất Tây Nguyên. Đây cũng là đô thị miền núi có dân số đông nhất Việt Nam. Thế nên có thể nói, chỉ cần đến đây là bạn có thể nạp thêm cho mình nhiều điều thú vị về văn hóa của Tây Nguyên độc đáo.</p>

              </div>
              <div class="swiper-slide">
                <img src="{{ asset('img/CM.jpg') }}" class="img" alt="">
                <p class="text-swiper">Nhắc đến Cà Mau, du khách không chỉ thương nhớ đến vùng đất phương Nam, nơi rừng U Minh Hạ đi vào lịch sử, mà còn là nơi đầu tàu ngọn sóng của mũi cực Nam Tổ quốc. Vùng đất Miền Tây thơ mộng, hữu tình với những danh lam thắng cảnh xinh đẹp làm ngất lòng du khách, luôn mang một sự thu hút riêng để bất cứ ai cũng muốn chiêm ngưỡng bức tranh hài hòa của rừng bạt ngàn.</p>
              </div>


            </div>
            <div class="swiper-pagination"></div>



          </div>



        </div>
      </div>


      <div class="testimonials">
        <h2>What <span class="brand">HustLang</span> users are saying</h2>
        <div class="testimonial">
          <div class="testimonial-card">
            <img src="avatar1.jpg" alt="Yifei Chen">
            <h3>Yifei Chen</h3>
            <p class="location">Seoul, South Korea | April 2019</p>
            <div class="rating">★★★★★</div>
            <p class="comment">What a great experience using Hustlang! I booked all of my flights for my gap year through Hustlang and never had any issues. When I had to cancel a flight because of an emergency, Hustlang support helped me...</p>
          </div>
          <div class="testimonial-card">
            <img src="avatar2.jpg" alt="Kaori Yamaguchi">
            <h3>Kaori Yamaguchi</h3>
            <p class="location">Honolulu, Hawaii | February 2017</p>
            <div class="rating">★★★★☆</div>
            <p class="comment">My family and I visit HCM city every year, and we usually book our flights using other services. Hustlang was recommended to us by a long-time friend, and I'm so glad we tried it out! The process was easy and...</p>
          </div>
          <div class="testimonial-card">
            <img src="avatar3.jpg" alt="Anthony Lewis">
            <h3>Anthony Lewis</h3>
            <p class="location">Berlin, Germany | April 2019</p>
            <div class="rating">★★★★★</div>
            <p class="comment">When I was looking to book my flight to Can Tho from Ha Noi, Hustlang had the best browsing experience so I figured I'd give it a try. It was my first time using Hustlang, but I'd definitely recommend it to a friend and...</p>
          </div>
        </div>
      </div>


    </div>









  </div>





</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    freeMode: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
</script>


@endsection

@push('head')
    <link href="{{ asset('css/client/page/home.css') }}" rel="stylesheet">
    <script defer src="{{asset('js/client/home.js')}}"></script>

@endpush
