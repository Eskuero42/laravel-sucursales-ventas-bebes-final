  <!-- Top Bar
  ============================================= -->
  <div id="top-bar" class="py-2 border-bottom bg-white">
      <div class="container">
          <div class="d-flex justify-content-between align-items-center">

              <div class="position-absolute start-50 translate-middle-x" id="logo">
                  <a href="{{route('principal')}}">
                      <img class="logo-default" src="{{ asset('frontend/images/bebBus/logos/logobebBus2.png') }}"
                          alt="BeBbus Logo" style="height: 40px;">
                  </a>
              </div>

              <div class="d-flex align-items-center ms-auto">

                  <div class="hover-baby-sky">
                      <div class="header-misc-icon">
                          <a href="#"><i class="bi-heart fs-5"></i></a>
                      </div>
                  </div>

                  <div class="hover-baby-sky">
                      <div class="header-misc-icon">
                          <a href="{{ route('login') }}"><i class="bi-people fs-5"></i></a>
                      </div>
                  </div>

                  <div class="align-items-center hover-baby-sky">
                      <div id="top-cart" class="header-misc-icon">
                          <a href="carrito.html" id="top-cart-trigger">
                              <i class="uil uil-shopping-bag fs-5"></i>
                              <span class="top-cart-number">5</span>
                          </a>
                          <div class="top-cart-content">
                              <div class="top-cart-title">
                                  <h4>Carrito de Compras</h4>
                              </div>
                              <div class="top-cart-items">
                                  <div class="top-cart-item">
                                      <div class="top-cart-item-image">
                                          <a href="#"><img
                                                  src="{{ asset('frontend/images/shop/small/1.jpg') }}"></a>
                                      </div>
                                      <div class="top-cart-item-desc">
                                          <div class="top-cart-item-desc-title">
                                              <a href="#">Polera azul con cuello redondo y botón</a>
                                              <span class="top-cart-item-price d-block">$19.99</span>
                                          </div>
                                          <div class="top-cart-item-quantity">x 2</div>
                                      </div>
                                  </div>
                                  <div class="top-cart-item">
                                      <div class="top-cart-item-image">
                                          <a href="#"><img
                                                  src="{{ asset('frontend/images/shop/small/6.jpg') }}"></a>
                                      </div>
                                      <div class="top-cart-item-desc">
                                          <div class="top-cart-item-desc-title">
                                              <a href="#">Vestido de mezclilla azul claro</a>
                                              <span class="top-cart-item-price d-block">$24.99</span>
                                          </div>
                                          <div class="top-cart-item-quantity">x 3</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="top-cart-action">
                                  <span class="top-checkout-price">$114.95</span>
                                  <a href="carrito.html" class="button button-3d button-small m-0">Ver Carrito</a>
                              </div>
                          </div>
                      </div>
                  </div>


              </div>

          </div>
      </div>
  </div>

  <!-- Header
  ============================================= -->
  <header id="header" class="bg-light">
      <div id="header-wrap" class="border-top border-f5 bg-baby-sky">
          <div class="container">
              <div class="header-row">

                  <div class="primary-menu-trigger">
                      <button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
                          <span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
                      </button>
                  </div>

                  <nav class="primary-menu with-arrows ms-lg-4 order-lg-first order-last">
                      <ul class="menu-container">
                          <li class="menu-item">
                              <a class="menu-link text-white hover-baby-gold p-3" href="#">
                                  @php
                                      $selectedSucursal = getSelectedSucursal();
                                  @endphp
                                  <div>
                                      <i class="bi-shop text-white"></i> 
                                      {{ $selectedSucursal ? $selectedSucursal->nombre : 'Todas las Sucursales' }}
                                  </div>
                              </a>
                              <ul class="sub-menu-container bg-baby-sky">
                                  <li class="menu-item">
                                      <a class="menu-link text-white hover-baby-gold p-3" href="{{ url()->current() }}">
                                          <div>Todas las Sucursales</div>
                                      </a>
                                  </li>
                                  @foreach (userObtenerSucursales() as $sucursal)
                                      <li class="menu-item">
                                          <a class="menu-link text-white hover-baby-gold p-3" href="{{ url()->current() }}?sucursal_id={{ $sucursal->id }}">
                                              <div>{{ $sucursal->nombre }}</div>
                                          </a>
                                      </li>
                                  @endforeach
                              </ul>
                          </li>
  
                          @foreach (userObtenerCategorias(request('sucursal_id')) as $categoria)
                              <li class="menu-item">
                                  <a class="menu-link text-white hover-baby-gold p-3" href="{{ route('user.categorias.listar', $categoria->id) }}">
                                      <div><i class="bi-record-fill text-white"></i> {{ $categoria->nombre }}</div>
                                  </a>
                                  @if (isset($categoria->categorias_hijos) && $categoria->categorias_hijos->isNotEmpty())
                                      <ul class="sub-menu-container bg-baby-sky">
                                          @foreach ($categoria->categorias_hijos as $hijo)
                                              <li class="menu-item">
                                                  <a class="menu-link text-white hover-baby-gold p-3" href="{{ route('user.categorias.listar', $hijo->id) }}">
                                                      <div>{{ $hijo->nombre }}</div>
                                                  </a>
                                                  @if (isset($hijo->categorias_hijos) && $hijo->categorias_hijos->isNotEmpty())
                                                      <ul class="sub-menu-container bg-baby-sky">
                                                          @foreach ($hijo->categorias_hijos as $nieto)
                                                              <li class="menu-item">
                                                                  <a class="menu-link text-white hover-baby-gold p-3"
                                                                      href="{{ route('user.categorias.listar', $nieto->id) }}">
                                                                      <div>{{ $nieto->nombre }}</div>
                                                                  </a>
                                                              </li>
                                                          @endforeach
                                                      </ul>
                                                  @endif
                                              </li>
                                          @endforeach
                                      </ul>
                                  @endif
                              </li>
                          @endforeach
                      </ul>
                  </nav>
              </div>
          </div>
      </div>
      <div class="header-wrap-clone"></div>
  </header>

  <!-- #header end -->
