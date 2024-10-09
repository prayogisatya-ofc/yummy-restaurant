<!-- Menu Section -->
<section id="menu" class="menu section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Our Menu</h2>
        <p><span>Check Our</span> <span class="description-title">Yummy Menu</span></p>
    </div><!-- End Section Title -->

    <div class="container">

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

            @foreach ($categories as $key => $category)
            <li class="nav-item">
                <a class="nav-link {{ $key == 0 ? 'active show' : '' }}" data-bs-toggle="tab" data-bs-target="#menu-{{ $category->uuid }}">
                    <h4>{{ $category->title }}</h4>
                </a>
            </li>
            @endforeach

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

            @foreach ($categories as $key => $category)
            <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="menu-{{ $category->uuid }}">

                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>{{ $category->title }}</h3>
                </div>

                <div class="row gy-5">

                    @foreach ($category->menus->where('status', 'active') as $menu)
                    <div class="col-lg-4 menu-item">
                        <a href="{{ asset('storage/' . $menu->image) }}" class="glightbox">
                            <img src="{{ asset('storage/' . $menu->image) }}" class="menu-img img-fluid" alt="">
                        </a>
                        <h4>{{ $menu->name }}</h4>
                        <p class="ingredients">
                            {{ $menu->description }}
                        </p>
                        <p class="price">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach

                </div>
            </div>
            @endforeach

        </div>

    </div>

</section><!-- /Menu Section -->