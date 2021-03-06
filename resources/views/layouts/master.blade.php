
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Matthieu MARTIN, and Bootstrap contributors">
    <title>Ecommerce</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    {{-- Custom SCSS styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('meta_csrf')

    @yield('extra_head_scripts')

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
  </head>
  <body>
    <div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="{{ route('cart.index') }}">Panier <span class="badge badge-pill badge-success">{{ Cart::count() }}</span></a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{ route('products.index') }}">E-COMMERCE</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        @include('partials.search')
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      @foreach (App\Category::all() as $category)
        <a class="p-2 text-muted" href="{{ route('products.index', ['category' => $category->slug ]) }}">{{ $category->name }}</a>  
      @endforeach
    </nav>
  </div>
</div>
<main role="main" class="container">
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if (session('duplicate'))
    <div class="alert alert-danger">
      {{ session('duplicate') }}
    </div>
  @endif

  @if (request()->input('query'))
  <div class='alert alert-{{ $products->count() > 0 ? 'success' : 'danger' }}'>
      {{ $products->count() }} résultat{{ $products->count() > 1 ? 's' : ''}} trouvé{{ $products->count() > 1 ? 's' : ''}} la recherche "{{ request()->input('query') }}"
    </div>
  @endif

  @yield('content')

</main><!-- /.container -->

<footer class="blog-footer col-md-12 d-flex flex-row justify-content-center mt-4">
  <p class="text-center">Example site made by CodingStuff.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
  @yield('extra_body_scripts')
</body>
</html>
